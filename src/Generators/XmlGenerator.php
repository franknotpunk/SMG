<?php


namespace SGM\Generators;

use DOMDocument;
use DOMException;

final class XmlGenerator implements GeneratorInterface
{
    /**
     * @throws DOMException
     */
    public function generate(array $pages): string
    {
        $dom = new DOMDocument('1.0', 'UTF-8');
        $urlset = $dom->createElement('urlset');
        $urlset->setAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');

        foreach ($pages as $page) {
            $url = $dom->createElement('url');
            $url->appendChild($dom->createElement('loc', $page->loc->getValue()));
            $url->appendChild($dom->createElement('lastmod', $page->lastmod->format('Y-m-d')));
            $url->appendChild($dom->createElement('priority', $page->priority->getValue()));
            $url->appendChild($dom->createElement('changefreq', $page->changefreq->getValue()));
            $urlset->appendChild($url);
        }

        $dom->appendChild($urlset);
        return $dom->saveXML();
    }
}
