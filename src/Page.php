<?php


namespace SGM;

use DateTimeImmutable;
use SGM\ValueObjects\Url;
use SGM\ValueObjects\Priority;
use SGM\ValueObjects\ChangeFrequency;

final readonly class Page
{
    public function __construct(
        public Url               $loc,
        public DateTimeImmutable $lastmod,
        public Priority          $priority,
        public ChangeFrequency   $changefreq
    )
    {
    }
}
