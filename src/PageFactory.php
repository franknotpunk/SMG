<?php

namespace SGM;

use Exception;
use SGM\Exceptions\InvalidPageException;
use SGM\ValueObjects\Url;
use SGM\ValueObjects\Priority;
use SGM\ValueObjects\ChangeFrequency;
use DateTimeImmutable;

final class PageFactory
{
    /**
     * @throws Exception
     */
    public function createFromArray(array $data): Page
    {
        $this->validatePageData($data);

        return new Page(
            new Url($data['loc']),
            new DateTimeImmutable($data['lastmod']),
            new Priority($data['priority'] ?? 0.5),
            new ChangeFrequency($data['changefreq'] ?? 'weekly')
        );
    }

    private function validatePageData(array $data): void
    {
        if (!filter_var($data['loc'], FILTER_VALIDATE_URL)) {
            throw new InvalidPageException("Invalid URL: {$data['loc']}");
        }

        if (!isset($data['lastmod']) || !strtotime($data['lastmod'])) {
            throw new InvalidPageException("Invalid lastmod: {$data['lastmod']}");
        }

        if (isset($data['priority']) && ($data['priority'] < 0 || $data['priority'] > 1)) {
            throw new InvalidPageException("Priority must be between 0 and 1.");
        }

        $allowedFrequencies = ['always', 'hourly', 'daily', 'weekly', 'monthly', 'yearly', 'never'];
        if (isset($data['changefreq']) && !in_array($data['changefreq'], $allowedFrequencies, true)) {
            throw new InvalidPageException("Invalid changefreq: {$data['changefreq']}");
        }
    }
}
