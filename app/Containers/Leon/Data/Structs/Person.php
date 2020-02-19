<?php

namespace App\Containers\Leon\Data\Structs;

class Person
{
    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $code;

    /**
     * @var string|null
     */
    private $surname;

    /**
     * @var string|null
     */
    private $knownAs;

    /**
     * @var bool|null
     */
    private $deleted;

    /**
     * @var int
     */
    private $nid;

    /**
     * @var string|null
     */
    private $name;

    /**
     * @var string|null
     */
    private $email;

    /**
     * @var int|null
     */
    private $contactNid;

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
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param string $code
     */
    public function setCode(string $code): void
    {
        $this->code = $code;
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
    public function getKnownAs(): ?string
    {
        return $this->knownAs;
    }

    /**
     * @param null|string $knownAs
     */
    public function setKnownAs(?string $knownAs): void
    {
        $this->knownAs = $knownAs;
    }

    /**
     * @return bool|null
     */
    public function getDeleted(): ?bool
    {
        return $this->deleted;
    }

    /**
     * @param bool|null $deleted
     */
    public function setDeleted(?bool $deleted): void
    {
        $this->deleted = $deleted;
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

    /**
     * @return null|string
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param null|string $email
     */
    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return int|null
     */
    public function getContactNid(): ?int
    {
        return $this->contactNid;
    }

    /**
     * @param int|null $contactNid
     */
    public function setContactNid(?int $contactNid): void
    {
        $this->contactNid = $contactNid;
    }
}
