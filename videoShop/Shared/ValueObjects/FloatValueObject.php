<?php


namespace videoShop\Shared\ValueObjects;


abstract class FloatValueObject implements \JsonSerializable
{
    /**
     * @var float
     */
    protected float $value;

    /**
     * FloatValueObject constructor.
     * @param float $value
     */
    public function __construct(float $value)
    {
        $this->value = $value;
        $this->validateValue();
    }

    /**
     * @return mixed
     */
    abstract function validateValue();

    /**
     * @return float
     */
    public function value(): float
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
