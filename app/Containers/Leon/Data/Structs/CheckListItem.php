<?php

namespace App\Containers\Leon\Data\Structs;

use App\Containers\Leon\Constants\CheckListItemStatus;

class CheckListItem
{
    /**
     * @var int
     */
    private $nid;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $checklistStatus;

    /**
     * @var string|null
     */
    private $statusDescription;

    /**
     * @var string
     */
    private $notes;

    /**
     * @var string
     */
    private $requestChangeType;

    /**
     * @var string
     */
    private $requestedItems;

    /**
     * @var HandlingAgent|null
     */
    private $handlingAgent;

    /**
     * @var bool
     */
    private $statusEditable;

    /**
     * @var string
     */
    private $time;

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
    public function getChecklistStatus(): string
    {
        return $this->checklistStatus;
    }

    /**
     * @param string $checklistStatus
     */
    public function setChecklistStatus(string $checklistStatus): void
    {
        $this->checklistStatus = $checklistStatus;

        if (isset(CheckListItemStatus::STATUS_DESCRIPTIONS[$this->checklistStatus])) {
            $this->setStatusDescription(CheckListItemStatus::STATUS_DESCRIPTIONS[$this->checklistStatus]);
        }
    }

    /**
     * @return null|string
     */
    public function getStatusDescription(): ?string
    {
        return $this->statusDescription;
    }

    /**
     * @param null|string $statusDescription
     */
    public function setStatusDescription(?string $statusDescription): void
    {
        $this->statusDescription = $statusDescription;
    }

    /**
     * @return string
     */
    public function getNotes(): string
    {
        return $this->notes;
    }

    /**
     * @param string $notes
     */
    public function setNotes(string $notes): void
    {
        $this->notes = $notes;
    }

    /**
     * @return string
     */
    public function getRequestChangeType(): string
    {
        return $this->requestChangeType;
    }

    /**
     * @param string $requestChangeType
     */
    public function setRequestChangeType(string $requestChangeType): void
    {
        $this->requestChangeType = $requestChangeType;
    }

    /**
     * @return string
     */
    public function getRequestedItems(): string
    {
        return $this->requestedItems;
    }

    /**
     * @param string $requestedItems
     */
    public function setRequestedItems(string $requestedItems): void
    {
        $this->requestedItems = $requestedItems;
    }

    /**
     * @return HandlingAgent|null
     */
    public function getHandlingAgent(): ?HandlingAgent
    {
        return $this->handlingAgent;
    }

    /**
     * @param HandlingAgent|null $handlingAgent
     */
    public function setHandlingAgent(?HandlingAgent $handlingAgent): void
    {
        $this->handlingAgent = $handlingAgent;
    }

    /**
     * @return bool
     */
    public function isStatusEditable(): bool
    {
        return $this->statusEditable;
    }

    /**
     * @param bool $statusEditable
     */
    public function setStatusEditable(bool $statusEditable): void
    {
        $this->statusEditable = $statusEditable;
    }

    /**
     * @return string
     */
    public function getTime(): string
    {
        return $this->time;
    }

    /**
     * @param string $time
     */
    public function setTime(string $time): void
    {
        $this->time = $time;
    }
}
