<?php

namespace App\Containers\Leon\Data\Structs;

use Illuminate\Support\Collection;

class ChecklistFlight
{
    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $opsNotes;

    /**
     * @var string
     */
    private $salesNotes;

    /**
     * @var CheckListItem[]
     */
    private $items;

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
    public function getOpsNotes(): string
    {
        return $this->opsNotes;
    }

    /**
     * @param string $opsNotes
     */
    public function setOpsNotes(string $opsNotes): void
    {
        $this->opsNotes = $opsNotes;
    }

    /**
     * @return string
     */
    public function getSalesNotes(): string
    {
        return $this->salesNotes;
    }

    /**
     * @param string $salesNotes
     */
    public function setSalesNotes(string $salesNotes): void
    {
        $this->salesNotes = $salesNotes;
    }

    /**
     *
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @param CheckListItem[] $items
     */
    public function setItems(array $items): void
    {
        $this->items = collect($items);
    }

    /**
     * @return CheckListItem|null
     */
    public function getArrivalHandling()
    {
        return $this->filterByType('HandlingChecklistItem')
            ->last();
    }

    /**
     * @return CheckListItem|null
     */
    public function getDepartureHandling()
    {
        return $this->filterByType('HandlingChecklistItem')
            ->first();
    }

    /**
     * @return CheckListItem|null
     */
    public function getArrivalSlot()
    {
        return $this->filterByType('SlotChecklistItem')
            ->last();
    }

    /**
     * @return CheckListItem|null
     */
    public function getDepartureSlot()
    {
        return $this->filterByType('SlotChecklistItem')
            ->first();
    }

    /**
     * @return CheckListItem|null
     */
    public function getArrivalPermits()
    {
        return $this->filterByType('PermitsChecklistItem')
            ->last();
    }

    /**
     * @return CheckListItem|null
     */
    public function getDeparturePermits()
    {
        return $this->filterByType('PermitsChecklistItem')
            ->first();
    }

    /**
     * @param string $type
     * @return Collection
     */
    private function filterByType(string $type): Collection
    {
        return $this->getItems()->filter(function ($value, $key) use ($type) {
            return $value->getType() === $type;
        });
    }
}
