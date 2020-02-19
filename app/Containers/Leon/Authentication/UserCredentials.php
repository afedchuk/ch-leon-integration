<?php

namespace App\Containers\Leon\Authentication;

use Illuminate\Support\Facades\Config;

/**
 * Class UserCredentials
 * @package App\Containers\Leon\Authentication
 */
class UserCredentials
{
    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $code;

    /**
     * UserCredentials constructor.
     */
    public function __construct()
    {
        $this->username = Config::get('leon-container.user_credentials.username');
        $this->password = Config::get('leon-container.user_credentials.password');
        $this->code     = Config::get('leon-container.user_credentials.operator_code');
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
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
}
