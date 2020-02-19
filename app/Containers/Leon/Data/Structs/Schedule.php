<?php

namespace App\Containers\Leon\Data\Structs;

use Carbon\Carbon;

class Schedule
{
    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $startTime;

    /**
     * @var string
     */
    private $endTime;

    /**
     * @var Carbon
     */
    private $date;

    /**
     * @var int
     */
    private $acftNid;

    /**
     * @var string
     */
    private $flightNo;

    /**
     * @var string
     */
    private $acftTypeId;

    /**
     * @var string
     */
    private $icao;

    /**
     * @var string
     */
    private $icaoName;

    /**
     * @var Airport
     */
    private $adep;

    /**
     * @var Airport
     */
    private $ades;

    /**
     * @var Aircraft
     */
    private $aircraftStruct;

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
    public function getStartTime(): string
    {
        return $this->startTime;
    }

    /**
     * @param string $startTime
     */
    public function setStartTime(string $startTime): void
    {
        $this->startTime = $startTime;
    }

    /**
     * @return string
     */
    public function getEndTime(): string
    {
        return $this->endTime;
    }

    /**
     * @param string $endTime
     */
    public function setEndTime(string $endTime): void
    {
        $this->endTime = $endTime;
    }

    /**
     * @return Carbon
     */
    public function getDate(): Carbon
    {
        return $this->date;
    }

    /**
     * @param Carbon $date
     */
    public function setDate(Carbon $date): void
    {
        $this->date = $date;
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
    public function getFlightNo(): string
    {
        return $this->flightNo;
    }

    /**
     * @param string $flightNo
     */
    public function setFlightNo(string $flightNo): void
    {
        $this->flightNo = $flightNo;
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
    public function getIcao(): string
    {
        return $this->icao;
    }

    /**
     * @param string $icao
     */
    public function setIcao(string $icao): void
    {
        $this->icao = $icao;
    }

    /**
     * @return string
     */
    public function getIcaoName(): string
    {
        return $this->icaoName;
    }

    /**
     * @param string $icaoName
     */
    public function setIcaoName(string $icaoName): void
    {
        $this->icaoName = $icaoName;
    }

    /**
     * @return Airport
     */
    public function getAdep(): Airport
    {
        return $this->adep;
    }

    /**
     * @param Airport $adep
     */
    public function setAdep(Airport $adep): void
    {
        $this->adep = $adep;
    }

    /**
     * @return Airport
     */
    public function getAdes(): Airport
    {
        return $this->ades;
    }

    /**
     * @param Airport $ades
     */
    public function setAdes(Airport $ades): void
    {
        $this->ades = $ades;
    }

    /**
     * @return Aircraft|null
     */
    public function getAircraftStruct(): ?Aircraft
    {
        return $this->aircraftStruct;
    }

    /**
     * @param Aircraft $aircraftStruct
     */
    public function setAircraftStruct(Aircraft $aircraftStruct): void
    {
        $this->aircraftStruct = $aircraftStruct;
    }
}
