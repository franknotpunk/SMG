<?php


namespace SGM\Generators;

use SGM\Page;

interface GeneratorInterface
{
    public function generate(array $pages): string;
}
