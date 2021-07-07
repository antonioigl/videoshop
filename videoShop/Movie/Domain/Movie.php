<?php


namespace videoShop\Movie\Domain;


class Movie
{
    /**
     * @var int|null
     */
    private ?int $id;
    /**
     * @var string
     */
    private string $title;
    /**
     * @var string
     */
    private string $description;
    /**
     * @var int|null
     */
    private ?int $user;

    public function __construct(?int $id, string $title, string $description, ?int $user)
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->user = $user;
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
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return int|null
     */
    public function getUser(): ?int
    {
        return $this->user;
    }
}