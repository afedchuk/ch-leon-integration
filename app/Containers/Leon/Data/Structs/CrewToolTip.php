<?php

namespace App\Containers\Leon\Data\Structs;

class CrewToolTip
{
    /**
     * @var string
     */
    private $type;

    /**
     * @var int
     */
    private $loginNid;

    /**
     * @var Phone|null
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
    public function getLoginNid(): int
    {
        return $this->loginNid;
    }

    /**
     * @param int $loginNid
     */
    public function setLoginNid(int $loginNid): void
    {
        $this->loginNid = $loginNid;
    }

    /**
     * @return Phone|null
     */
    public function getPhone(): ?Phone
    {
        return $this->phone;
    }

    /**
     * @param Phone|null $phone
     */
    public function setPhone(?Phone $phone): void
    {
        $this->phone = $phone;
    }
}
