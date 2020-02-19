<?php

namespace App\Containers\Messagebus\Clients;

use App\Containers\Messagebus\Contracts\MessageClientInterface;
use App\Containers\Messagebus\Events\MessageSentEvent;
use App\Containers\Messagebus\Extensions\JsonDecodeExtension;
use App\Ship\Parents\Clients\MessageClient;
use Enqueue\AmqpLib\AmqpConnectionFactory;
use Enqueue\AmqpLib\AmqpContext;
use Enqueue\Consumption\ChainExtension;
use Enqueue\Consumption\Extension\LimitConsumptionTimeExtension;
use Enqueue\Consumption\Extension\SignalExtension;
use Enqueue\Consumption\QueueConsumer;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Interop\Amqp\AmqpQueue;
use Interop\Amqp\AmqpTopic;
use Interop\Amqp\Impl\AmqpBind;
use Interop\Amqp\AmqpMessage;
use Interop\Queue\PsrProcessor;

/**
 * Class AmqpClient
 * @package App\Containers\Messagebus\Clients
 */
class AmqpClient extends MessageClient implements MessageClientInterface
{
    /**
     * @var AmqpContext
     */
    private $context;

    /**
     * @var AmqpTopic
     */
    private $exchange;

    /**
     * @var QueueConsumer
     */
    private $queueConsumer;

    /**
     * AmqpClient constructor.
     */
    public function __construct()
    {
        //
    }

    /**
     * @return AmqpContext
     */
    public function getContext(): AmqpContext
    {
        if ($this->context === null) {
            $this->context = $this->createContext();
        }

        return $this->context;
    }

    /**
     * @return AmqpTopic
     */
    public function getExchange(): AmqpTopic
    {
        if ($this->exchange === null) {
            $this->exchange = $this->createExchange();
        }

        return $this->exchange;
    }

    /**
     * @return QueueConsumer
     */
    public function getQueueConsumer(): QueueConsumer
    {
        if ($this->queueConsumer === null) {
            $this->queueConsumer = $this->createQueueConsumer();
        }

        return $this->queueConsumer;
    }

    /**
     * @param string $key
     * @param array|string $message
     * @param string $applicationId
     * @throws \Interop\Queue\Exception
     * @throws \Interop\Queue\InvalidDestinationException
     * @throws \Interop\Queue\InvalidMessageException
     */
    public function send(string $key, $message, string $applicationId = self::DEFAULT_APPLICATION_ID): void
    {
        $context = $this->getContext();

        $message    = $this->createMessage($message);
        $routingKey = $this->normalizeRoutingKey($applicationId, $key);

        $message->setRoutingKey($routingKey);
        $context->createProducer()
            ->send($this->getExchange(), $message);

        Log::info('Messagebus. Message has been sent to the queue: {queue}', [
            'queue' => $routingKey,
        ]);

        event(new MessageSentEvent($message));
    }

    /**
     * @param string $name
     * @param PsrProcessor|callable $processor
     * @throws \Interop\Queue\Exception
     */
    public function subscribe(string $name, $processor): void
    {
        $queue = $this->createQueue($name, $name);
        $this->getQueueConsumer()->bind($queue, $processor);
    }

    /**
     * @param int $timeout
     * @throws \Exception
     */
    public function consume(int $timeout = 5): void
    {
        if ($timeout === 0) {
            $timeout = 5;
        }

        $chain = new ChainExtension([
            new JsonDecodeExtension(),
            new SignalExtension(),
            new LimitConsumptionTimeExtension(new \DateTime('now + ' . $timeout . ' minute')),
        ]);

        $this->getQueueConsumer()->consume($chain);
    }

    /**
     * @return AmqpContext
     */
    private function createContext(): AmqpContext
    {
        // connect to AMQP broker
        $factory = new AmqpConnectionFactory([
            'host'               => Config::get('messagebus-container.connections.amqp.host'),
            'port'               => Config::get('messagebus-container.connections.amqp.port'),
            'vhost'              => Config::get('messagebus-container.connections.amqp.vhost'),
            'user'               => Config::get('messagebus-container.connections.amqp.user'),
            'pass'               => Config::get('messagebus-container.connections.amqp.pass'),
            'ssl_on'             => Config::get('messagebus-container.connections.amqp.ssl_on'),
            'connection_timeout' => Config::get('messagebus-container.connections.amqp.connection_timeout'),
        ]);

        return $factory->createContext();
    }

    /**
     * @return AmqpTopic
     */
    private function createExchange(): AmqpTopic
    {
        $name    = Config::get('messagebus-container.exchange_name');
        $context = $this->getContext();

        $exchange = $context->createTopic($name);
        $exchange->setType(AmqpTopic::TYPE_TOPIC);
        $exchange->addFlag(AmqpTopic::FLAG_DURABLE);
        $context->declareTopic($exchange);

        return $exchange;
    }

    /**
     * @param string $name
     * @param string $routingKey
     * @return AmqpQueue
     * @throws \Interop\Queue\Exception
     */
    private function createQueue(string $name, string $routingKey): AmqpQueue
    {
        $context = $this->getContext();

        $applicationId = Config::get('messagebus-container.application_id');
        $name          = $this->normalizeName($applicationId, $name);
        $routingKey    = $this->normalizeRoutingKey($applicationId, $routingKey);

        $queue = $context->createQueue($name);
        $queue->addFlag(AmqpQueue::FLAG_DURABLE);
        $context->declareQueue($queue);

        $context->bind(
            new AmqpBind($this->getExchange(), $queue, $routingKey)
        );

        return $queue;
    }

    /**
     * @return QueueConsumer
     */
    private function createQueueConsumer()
    {
        $context  = $this->getContext();
        $consumer = new QueueConsumer($context);

        return $consumer;
    }

    /**
     * @param string $id
     * @param string $name
     * @return string
     */
    private function normalizeName(string $id, string $name)
    {
        return sprintf(
            "%s.cm.%s.%s",
            Config::get('app.env'),
            $id,
            $name
        );
    }

    /**
     * @param string $id
     * @param string $key
     * @return string
     */
    private function normalizeRoutingKey(string $id, string $key)
    {
        return $this->normalizeName($id, $key);
    }

    /**
     * @param $body
     * @return AmqpMessage
     */
    private function createMessage($body): AmqpMessage
    {
        $message     = $this->getContext()->createMessage();
        $contentType = $message->getContentType();

        if (is_scalar($body) || null === $body) {
            $contentType = $contentType ?: 'text/plain';
            $body        = (string)$body;
        } elseif (is_array($body)) {
            if ($contentType && 'application/json' !== $contentType) {
                throw new \LogicException(sprintf('Content type "application/json" only allowed when body is array'));
            }

            // only array of scalars is allowed.
            /*array_walk_recursive($body, function ($value) {
                if (!is_scalar($value) && null !== $value) {
                    throw new \LogicException(sprintf(
                        'The message\'s body must be an array of scalars. Found not scalar in the array: %s',
                        is_object($value) ? get_class($value) : gettype($value)
                    ));
                }
            });*/

            $contentType = 'application/json';
            $body        = json_encode($body);
        } elseif ($body instanceof \JsonSerializable) {
            if ($contentType && 'application/json' !== $contentType) {
                throw new \LogicException(sprintf('Content type "application/json" only allowed when body is array'));
            }

            $contentType = 'application/json';
            $body        = json_encode($body);
        } else {
            throw new \InvalidArgumentException(sprintf(
                'The message\'s body must be either null, scalar, array or object (implements \JsonSerializable). Got: %s',
                is_object($body) ? get_class($body) : gettype($body)
            ));
        }

        $message->setContentType($contentType);
        $message->setBody($body);

        return $message;
    }
}
