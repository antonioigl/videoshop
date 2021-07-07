<?php


namespace videoShop\Movie\Application\Update;


class UpdateMovieResponse
{
    /**
     * @var bool
     */
    private bool $status;

    /**
     * RegisterResponse constructor.
     * @param bool $status
     */
    public function __construct(bool $status)
    {
        $this->status = $status;
    }

    /**
     * @return bool
     */
    public function isStatus(): bool
    {
        return $this->status;
    }
}