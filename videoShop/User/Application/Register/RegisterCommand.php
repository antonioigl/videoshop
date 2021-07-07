<?php


namespace videoShop\User\Application\Register;


class RegisterCommand
{
    /**
     * @var string
     */
    private string $email;
    /**
     * @var string
     */
    private string $username;
    /**
     * @var string
     */
    private string $password;
    /**
     * @var array
     */
    private array $roles;

    /**
     * RegisterCommand constructor.
     * @param string $email
     * @param string $username
     * @param string $password
     * @param array $roles
     */
    public function __construct(
        string $email,
        string $username,
        string $password,
        array $roles
    )
    {
        $this->email = $email;
        $this->username = $username;
        $this->password = $password;
        $this->roles = $roles;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return array
     */
    public function getRoles(): array
    {
        return $this->roles;
    }
}