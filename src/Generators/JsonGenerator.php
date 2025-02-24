<?php


namespace SGM\Generators;

use SGM\Page;

final class JsonGenerator implements GeneratorInterface
{
    public function generate(array $pages): string
    {
        $data = array_map(function (Page $page) {
            return [
                'loc' => $page->loc->getValue(),
                'lastmod' => $page->lastmod->format('Y-m-d'),
                'priority' => $page->priority->getValue(),
                'changefreq' => $page->changefreq->getValue(),
            ];
        }, $pages);

        return json_encode($data, JSON_PRETTY_PRINT);
    }
}
