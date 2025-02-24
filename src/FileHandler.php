<?php

namespace SGM;

use SGM\Exceptions\FileWriteException;

final class FileHandler
{
    public function createDirectory(string $path): void
    {
        if (!is_dir($path)) {
            mkdir($path, 0755, true);
        }
    }

    public function writeFile(string $path, string $content): void
    {
        if (!file_put_contents($path, $content)) {
            throw new FileWriteException("Failed to write file: $path");
        }
    }
}
