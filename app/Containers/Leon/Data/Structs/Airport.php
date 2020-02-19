<?php

namespace App\Containers\Leon\Data\Structs;

class Airport
{
    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $id;

    /**
     * @var string|null
     */
    private $icao;

    /**
     * @var string|null
     */
    private $iata;

    /**
     * @var string|null
     */
    private $city;

    /**
     * @var int
     */
    private $locationNid;

    /**
     * @var string|null
     */
    private $faa;

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
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId(string $id): void
    {
        $this->id = $id;
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

    /**
     * @return null|string
     */
    public function getIata(): ?string
    {
        return $this->iata;
    }

    /**
     * @param null|string $iata
     */
    public function setIata(?string $iata): void
    {
        $this->iata = $iata;
    }

    /**
     * @return null|string
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * @param null|string $city
     */
    public function setCity(?string $city): void
    {
        $this->city = $city;
    }

    /**
     * @return int
     */
    public function getLocationNid(): int
    {
        return $this->locationNid;
    }

    /**
     * @param int $locationNid
     */
    public function setLocationNid(int $locationNid): void
    {
        $this->locationNid = $locationNid;
    }

    /**
     * @return null|string
     */
    public function getFaa(): ?string
    {
        return $this->faa;
    }

    /**
     * @param null|string $faa
     */
    public function setFaa(?string $faa): void
    {
        $this->faa = $faa;
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
