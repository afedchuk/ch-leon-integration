<?php

namespace App\Containers\Leon\Data\Structs;

class Aircraft
{
    /**
     * @var string
     */
    private $type;

    /**
     * @var int|null
     */
    private $maxPaxNumber;

    /**
     * @var int
     */
    private $acftNid;

    /**
     * @var string
     */
    private $acftTypeId;

    /**
     * @var string
     */
    private $registration;

    /**
     * @var string|null
     */
    private $icao;

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
     * @return int|null
     */
    public function getMaxPaxNumber(): ?int
    {
        return $this->maxPaxNumber;
    }

    /**
     * @param int|null $maxPaxNumber
     */
    public function setMaxPaxNumber(?int $maxPaxNumber): void
    {
        $this->maxPaxNumber = $maxPaxNumber;
    }

    /**
     * @return int
     */
    public function getAcftNid(): int
    {
        return $this->acftNid;
    }

    /**
     * @param int $acftNid
     */
    public function setAcftNid(int $acftNid): void
    {
        $this->acftNid = $acftNid;
    }

    /**
     * @return string
     */
    public function getAcftTypeId(): string
    {
        return $this->acftTypeId;
    }

    /**
     * @param string $acftTypeId
     */
    public function setAcftTypeId(string $acftTypeId): void
    {
        $this->acftTypeId = $acftTypeId;
    }

    /**
     * @return string
     */
    public function getRegistration(): string
    {
        return $this->registration;
    }

    /**
     * @param string $registration
     */
    public function setRegistration(string $registration): void
    {
        $this->registration = $registration;
    }

    /**
     * @return null|string
     */
    public function getIcao(): ?string
    {
        return $this->icao;
    }

    /**
     * @param null|string $icao
     */
    public function setIcao(?string $icao): void
    {
        $this->icao = $icao;
    }
}
