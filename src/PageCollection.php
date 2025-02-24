<?php

namespace SGM;

final class PageCollection
{
    /** @var Page[] */
    private array $pages = [];

    public function addPage(Page $page): void
    {
        $this->pages[] = $page;
    }

    public function getPages(): array
    {
        return $this->pages;
    }
}
