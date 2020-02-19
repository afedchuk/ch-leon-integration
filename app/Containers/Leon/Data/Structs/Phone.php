<?php

namespace App\Containers\Leon\Data\Structs;

class Phone
{
    /**
     * @var string
     */
    private $type;

    /**
     * @var string|null
     */
    private $workPhone;

    /**
     * @var string|null
     */
    private $privatePhone;

    /**
     * @var string|null
     */
    private $surname;

    /**
     * @var string|null
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
     * @return null|string
     */
    public function getWorkPhone(): ?string
    {
        return $this->workPhone;
    }

    /**
     * @param null|string $workPhone
     */
    public function setWorkPhone(?string $workPhone): void
    {
        $this->workPhone = $workPhone;
    }

    /**
     * @return null|string
     */
    public function getPrivatePhone(): ?string
    {
        return $this->privatePhone;
    }

    /**
     * @param null|string $privatePhone
     */
    public function setPrivatePhone(?string $privatePhone): void
    {
        $this->privatePhone = $privatePhone;
    }

    /**
     * @return null|string
     */
    public function getSurname(): ?string
    {
        return $this->surname;
    }

    /**
     * @param null|string $surname
     */
    public function setSurname(?string $surname): void
    {
        $this->surname = $surname;
    }

    /**
     * @return null|string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param null|string $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }
}
