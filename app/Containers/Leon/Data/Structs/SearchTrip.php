<?php

namespace App\Containers\Leon\Data\Structs;

class SearchTrip
{
    /**
     * @var string
     */
    private $type;

    /**
     * @var string|null
     */
    private $label;

    /**
     * @var int
     */
    private $nid;

    /**
     * @var string
     */
    private $tripNo;

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
     * @return null|string
     */
    public function getLabel(): ?string
    {
        return $this->label;
    }

    /**
     * @param null|string $label
     */
    public function setLabel(?string $label): void
    {
        $this->label = $label;
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
    public function getTripNo(): string
    {
        return $this->tripNo;
    }

    /**
     * @param string $tripNo
     */
    public function setTripNo(string $tripNo): void
    {
        $this->tripNo = $tripNo;
    }
}
