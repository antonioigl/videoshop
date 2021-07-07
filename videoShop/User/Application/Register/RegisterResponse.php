<?php


namespace videoShop\User\Application\Register;


class RegisterResponse
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