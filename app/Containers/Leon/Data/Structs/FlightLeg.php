<?php

namespace App\Containers\Leon\Data\Structs;

use Illuminate\Support\Collection;

class FlightLeg
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
     * @var bool|null
     */
    private $cnl;

    /**
     * @var string|null
     */
    private $trActivityType;

    /**
     * @var string|null
     */
    private $flightRules;

    /**
     * @var string|null
     */
    private $icaoType;

    /**
     * @var int|null
     */
    private $paxNumber;

    /**
     * @var string|null
     */
    private $trStatus;

    /**
     * @var int
     */
    private $oprNid;

    /**
     * @var int
     */
    private $tripNid;

    /**
     * @var int|null
     */
    private $distance;

    /**
     * @var Schedule
     */
    private $schedule;

    /**
     * @var Collection
     */
    private $crew;

    /**
     * @var ChecklistFlight|null
     */
    private $checklist;

    /**
     * FlightLeg constructor.
     */
    public function __construct()
    {
        $this->crew = new Collection();
    }

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
     * @return bool|null
     */
    public function getCnl(): ?bool
    {
        return $this->cnl;
    }

    /**
     * @param bool|null $cnl
     */
    public function setCnl(?bool $cnl): void
    {
        $this->cnl = $cnl;
    }

    /**
     * @return null|string
     */
    public function getTrActivityType(): ?string
    {
        return $this->trActivityType;
    }

    /**
     * @param null|string $trActivityType
     */
    public function setTrActivityType(?string $trActivityType): void
    {
        $this->trActivityType = $trActivityType;
    }

    /**
     * @return null|string
     */
    public function getFlightRules(): ?string
    {
        return $this->flightRules;
    }

    /**
     * @param null|string $flightRules
     */
    public function setFlightRules(?string $flightRules): void
    {
        $this->flightRules = $flightRules;
    }

    /**
     * @return null|string
     */
    public function getIcaoType(): ?string
    {
        return $this->icaoType;
    }

    /**
     * @param null|string $icaoType
     */
    public function setIcaoType(?string $icaoType): void
    {
        $this->icaoType = $icaoType;
    }

    /**
     * @return int|null
     */
    public function getPaxNumber(): ?int
    {
        return $this->paxNumber;
    }

    /**
     * @param int|null $paxNumber
     */
    public function setPaxNumber(?int $paxNumber): void
    {
        $this->paxNumber = $paxNumber;
    }

    /**
     * @return null|string
     */
    public function getTrStatus(): ?string
    {
        return $this->trStatus;
    }

    /**
     * @param null|string $trStatus
     */
    public function setTrStatus(?string $trStatus): void
    {
        $this->trStatus = $trStatus;
    }

    /**
     * @return int
     */
    public function getOprNid(): int
    {
        return $this->oprNid;
    }

    /**
     * @param int $oprNid
     */
    public function setOprNid(int $oprNid): void
    {
        $this->oprNid = $oprNid;
    }

    /**
     * @return int
     */
    public function getTripNid(): int
    {
        return $this->tripNid;
    }

    /**
     * @param int $tripNid
     */
    public function setTripNid(int $tripNid): void
    {
        $this->tripNid = $tripNid;
    }

    /**
     * @return int|null
     */
    public function getDistance(): ?int
    {
        return $this->distance;
    }

    /**
     * @param int|null $distance
     */
    public function setDistance(?int $distance): void
    {
        $this->distance = $distance;
    }

    /**
     * @return Schedule
     */
    public function getSchedule(): Schedule
    {
        return $this->schedule;
    }

    /**
     * @param Schedule $schedule
     */
    public function setSchedule(Schedule $schedule): void
    {
        $this->schedule = $schedule;
    }

    /**
     * @return Collection
     */
    public function getCrew(): Collection
    {
        return $this->crew;
    }

    /**
     * @param Collection $crew
     */
    public function setCrew(Collection $crew): void
    {
        $this->crew = $crew;
    }

    /**
     * @return ChecklistFlight|null
     */
    public function getChecklist(): ?ChecklistFlight
    {
        return $this->checklist;
    }

    /**
     * @param ChecklistFlight|null $checklist
     */
    public function setChecklist(?ChecklistFlight $checklist): void
    {
        $this->checklist = $checklist;
    }
}
