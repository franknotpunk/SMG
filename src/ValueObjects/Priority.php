<?php


namespace SGM\ValueObjects;

use InvalidArgumentException;

final class Priority
{
    public function __construct(private float $value)
    {
        if ($value < 0 || $value > 1) {
            throw new InvalidArgumentException("Priority must be between 0 and 1.");
        }
    }

    public function getValue(): float
    {
        return $this->value;
    }
}
