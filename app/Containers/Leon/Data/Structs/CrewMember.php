<?php

namespace App\Containers\Leon\Data\Structs;

use Illuminate\Support\Collection;

class CrewMember
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
     * @var Person|null
     */
    private $person;

    /**
     * @var Position|null
     */
    private $position;

    /**
     * @var Phone
     */
    private $phone;

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
     * @return Person|null
     */
    public function getPerson(): ?Person
    {
        return $this->person;
    }

    /**
     * @param Person|null $person
     */
    public function setPerson(?Person $person): void
    {
        $this->person = $person;
    }

    /**
     * @return Position|null
     */
    public function getPosition(): ?Position
    {
        return $this->position;
    }

    /**
     * @param Position|null $position
     */
    public function setPosition(?Position $position): void
    {
        $this->position = $position;
    }

    /**
     * @return Phone
     */
    public function getPhone(): ?Phone
    {
        return $this->phone;
    }

    /**
     * @param Phone $phone
     */
    public function setPhone(Phone $phone): void
    {
        $this->phone = $phone;
    }
}
