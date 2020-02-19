<?php

namespace App\Containers\Leon\Data\Structs;

class Position
{
    /**
     * @var string
     */
    private $type;

    /**
     * @var int
     */
    private $nid;

    /**
     * @var string
     */
    private $posType;

    /**
     * @var int
     */
    private $order;

    /**
     * @var bool
     */
    private $isDefault;

    /**
     * @var string
     */
    private $name;

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return int
     */
    public function getNid(): int
    {
        return $this->nid;
    }

    /**
     * @param int $nid
     */
    public function setNid(int $nid): void
    {
        $this->nid = $nid;
    }

    /**
     * @return string
     */
    public function getPosType(): string
    {
        return $this->posType;
    }

    /**
     * @param string $posType
     */
    public function setPosType(string $posType): void
    {
        $this->posType = $posType;
    }

    /**
     * @return int
     */
    public function getOrder(): int
    {
        return $this->order;
    }

    /**
     * @param int $order
     */
    public function setOrder(int $order): void
    {
        $this->order = $order;
    }

    /**
     * @return bool
     */
    public function isDefault(): bool
    {
        return $this->isDefault;
    }

    /**
     * @param bool $isDefault
     */
    public function setIsDefault(bool $isDefault): void
    {
        $this->isDefault = $isDefault;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }
}
