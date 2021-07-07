<?php


namespace videoShop\User\Domain;


class UserBuilder
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
    private string $email;
    /**
     * @var string
     */
    private string $password;
    /**
     * @var array
     */
    private array $roles;


    /**
     * UserBuilder constructor.
     * @param int|null $id
     * @param string $username
     * @param string $email
     * @param string $password
     * @param array $roles
     */
    public function __construct(?int $id, string $username, string $email, string $password, array $roles)
    {

        $this->id = $id ?: null;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->roles = $roles;
    }

    /**
     * @param string $username
     * @param string $email
     * @param string $password
     * @param array $roles
     * @return static
     */
    public static function create(string $username, string $email,  string $password, array $roles): self
    {
        return new self(null, $username, $email, $password,  $roles);
    }

    public function withId(int $id) {
        $this->id = $id;
    }

    /**
     * @return User
     */
    public function build(): User
    {
        return new User($this->id, $this->username, $this->email, $this->password, $this->roles);
    }
}