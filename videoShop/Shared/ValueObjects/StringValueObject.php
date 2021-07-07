<?php


namespace videoShop\Shared\ValueObjects;

abstract class StringValueObject implements \JsonSerializable
{
    /**
     * @var string
     */
    protected string $value;

    /**
     * StringValueObject constructor.
     * @param string $value
     */
    public function __construct(string $value)
    {
        $this->value = $value;
        $this->validateValue();
    }

    /**
     * @return mixed
     */
    abstract function validateValue();

    /**
     * @return string
     */
    public function value(): string
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
