<?php

namespace App\Containers\Leon\Data\Structs;

class HandlingAgent
{
    /**
     * @var int
     */
    private $type;

    /**
     * @var int
     */
    private $nid;

    /**
     * @var string
     */
    private $approved;

    /**
     * @var bool
     */
    private $isFavorite;

    /**
     * @var string
     */
    private $name;

    /**
     * @var bool
     */
    private $recommended;

    /**
     * @var string
     */
    private $note;

    /**
     * @return int
     */
    public function getType(): int
    {
        return $this->type;
    }

    /**
     * @param int $type
     */
    public function setType(int $type): void
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
    public function getApproved(): string
    {
        return $this->approved;
    }

    /**
     * @param string $approved
     */
    public function setApproved(string $approved): void
    {
        $this->approved = $approved;
    }

    /**
     * @return bool
     */
    public function isFavorite(): bool
    {
        return $this->isFavorite;
    }

    /**
     * @param bool $isFavorite
     */
    public function setIsFavorite(bool $isFavorite): void
    {
        $this->isFavorite = $isFavorite;
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

    /**
     * @return bool
     */
    public function isRecommended(): bool
    {
        return $this->recommended;
    }

    /**
     * @param bool $recommended
     */
    public function setRecommended(bool $recommended): void
    {
        $this->recommended = $recommended;
    }

    /**
     * @return string
     */
    public function getNote(): string
    {
        return $this->note;
    }

    /**
     * @param string $note
     */
    public function setNote(string $note): void
    {
        $this->note = $note;
    }
}
