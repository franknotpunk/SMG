<?php


namespace SGM\ValueObjects;

use InvalidArgumentException;

final class Url
{
    public function __construct(private string $value)
    {
        if (!filter_var($value, FILTER_VALIDATE_URL)) {
            throw new InvalidArgumentException("Invalid URL: $value");
        }
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
