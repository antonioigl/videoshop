<?php


namespace videoShop\User\Domain;


class User
{
    /**
     * @var int|null
     */
    private ?int $id;
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
     * @var string
     */
    private string $email;

    /**
     * User constructor.
     * @param int|null $id
     * @param string $username
     * @param string $email
     * @param string $password
     * @param array $roles
     */
    public function __construct(?int $id, string $username, string $email,  string $password, array $roles)
    {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->roles = $roles;
        $this->email = $email;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

}