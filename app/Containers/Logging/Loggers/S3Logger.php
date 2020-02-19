<?php

namespace App\Containers\Logging\Loggers;

use Carbon\Carbon;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

/**
 * Class S3Logger
 * @package App\Containers\Logging\Loggers
 */
class S3Logger
{
    const TYPE_RESPONSES = 'responses';
    const TYPE_MESSAGES = 'messages';

    /**
     * @var string Internal reference number
     */
    private $reference;

    /**
     * @var string Application ID
     */
    private $connector;

    /**
     * @var string Transaction UID
     */
    private $transactionUid;

    /**
     * @var string Session UID
     */
    private $sessionUid;

    /**
     * @var Filesystem
     */
    private $disk;

    /**
     * @var int Timestamp
     */
    private $timestamp;

    /**
     * S3Logger constructor.
     */
    public function __construct()
    {
        $this->reference      = 'NONE';
        $this->connector      = strtoupper(Config::get('logging-container.application_id'));
        $this->transactionUid = uniqid();
        $this->sessionUid     = uniqid();
        $this->timestamp      = time();
        $this->disk           = Storage::disk('s3');
    }

    /**
     * @param string $reference
     */
    public function setReference(string $reference): void
    {
        $this->reference = $reference;

        $this->transactionUid = uniqid();
    }

    /**
     * @param string $type
     * @param string $data
     */
    public function append(string $type, string $data)
    {
        try {
            $this->disk->append(
                $this->getFileLocation($type) . $this->getFileName(),
                $data
            );
        } catch (\Exception $exception) {
            Log::warning("S3 Logger: " . $exception->getMessage());
        }
    }

    /**
     * @param string $type
     * @return string
     */
    private function getFileLocation(string $type): string
    {
        return $type . DIRECTORY_SEPARATOR . Carbon::now()->toDateString() . DIRECTORY_SEPARATOR;
    }

    /**
     * @return string
     */
    private function getFileName(): string
    {
        return implode('.', [
                str_replace('/', '', $this->reference),
                $this->connector,
                $this->sessionUid,
                $this->transactionUid,
                $this->timestamp,
            ]) . '.log';
    }
}
