<?php


namespace SGM\ValueObjects;

use InvalidArgumentException;

final class ChangeFrequency
{
    private const ALLOWED_VALUES = ['always', 'hourly', 'daily', 'weekly', 'monthly', 'yearly', 'never'];

    public function __construct(private string $value)
    {
        if (!in_array($value, self::ALLOWED_VALUES, true)) {
            throw new InvalidArgumentException("Invalid change frequency: $value");
        }
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
