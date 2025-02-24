<?php


namespace SGM\Generators;

use SGM\Page;

final class CsvGenerator implements GeneratorInterface
{
    public function generate(array $pages): string
    {
        $output = fopen('php://temp', 'r+');
        fputcsv($output, ['loc', 'lastmod', 'priority', 'changefreq']);

        foreach ($pages as $page) {
            fputcsv($output, [
                $page->loc->getValue(),
                $page->lastmod->format('Y-m-d'),
                $page->priority->getValue(),
                $page->changefreq->getValue(),
            ]);
        }

        rewind($output);
        $csv = stream_get_contents($output);
        fclose($output);

        return $csv;
    }
}
