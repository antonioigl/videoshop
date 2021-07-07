<?php


namespace videoShop\Movie\Domain;


class MovieBuilder
{


    private ?int $id;
    private string $title;
    private string $description;
    private ?int $user;

    public function __construct(?int $id, string $title, string $description, ?int $user)
    {
        $this->id = $id ?: null;
        $this->title = $title;
        $this->description = $description;
        $this->user = $user ?: null;
    }

    public static function create(string $title, string $description): self
    {
        return new self(null, $title, $description, null);
    }

    public function withId(int $id) {
        $this->id = $id;
        return $this;
    }

    /**
     * @return Movie
     */
    public function build(): Movie
    {
        return new Movie($this->id, $this->title, $this->description, $this->user);
    }

}