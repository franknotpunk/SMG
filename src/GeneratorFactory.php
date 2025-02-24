<?php

namespace SGM;

use InvalidArgumentException;
use SGM\Generators\GeneratorInterface;
use SGM\Generators\XmlGenerator;
use SGM\Generators\JsonGenerator;
use SGM\Generators\CsvGenerator;

final class GeneratorFactory
{
    public function create(string $format): GeneratorInterface
    {
        return match ($format) {
            'xml' => new XmlGenerator(),
            'json' => new JsonGenerator(),
            'csv' => new CsvGenerator(),
            default => throw new InvalidArgumentException("Unsupported format: $format"),
        };
    }
}
