<?php


namespace videoShop\Shared\ValueObjects;


abstract class IntValueObject implements \JsonSerializable
{
    /**
     * @var int
     */
    protected int $value;

    /**
     * IntValueObject constructor.
     * @param int $value
     */
    public function __construct(int $value)
    {
        $this->value = $value;
        $this->validateValue();
    }

    /**
     * @return mixed
     */
    abstract function validateValue();

    /**
     * @return int
     */
    public function value(): int
    {
        return $this->value;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return get_object_vars($this);
    }

    /**
     * @return array|mixed
     */
    public function jsonSerialize()
    {
        return $this->toArray();
    }
}
