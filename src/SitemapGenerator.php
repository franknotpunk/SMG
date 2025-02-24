<?php

namespace SGM;

use Exception;

/**
 * Class SitemapGenerator
 *
 * Генератор карты сайта (sitemap) в различных форматах (XML, JSON, CSV).
 *
 * Пример использования:
 * $generator = new SitemapGenerator();
 * $generator->addPages([
 *     [
 *         'loc' => 'https://example.com',
 *         'lastmod' => '2024-01-01',
 *         'priority' => 0.8,
 *         'changefreq' => 'daily'
 *     ],
 *     [
 *         'loc' => 'https://example.com/about',
 *         'lastmod' => '2024-01-15',
 *         'priority' => 0.5,
 *         'changefreq' => 'monthly'
 *     ]
 * ]);
 * $generator->generate('xml', __DIR__ . '/sitemaps');
 */
final class SitemapGenerator
{
    private PageCollection $pageCollection;
    private PageFactory $pageFactory;
    private FileHandler $fileHandler;
    private GeneratorFactory $generatorFactory;

    public function __construct()
    {
        $this->pageCollection = new PageCollection();
        $this->pageFactory = new PageFactory();
        $this->fileHandler = new FileHandler();
        $this->generatorFactory = new GeneratorFactory();
    }

    /**
     * Добавляет несколько страниц в карту сайта.
     *
     * @param array $pagesData Массив страниц. Каждая страница должна быть массивом с ключами:
     *                         - 'loc' (string) - URL страницы.
     *                         - 'lastmod' (string) - Дата последнего изменения в формате YYYY-MM-DD.
     *                         - 'priority' (float, опционально) - Приоритет страницы (от 0.0 до 1.0).
     *                         - 'changefreq' (string, опционально) - Частота изменения страницы.
     *                           Допустимые значения: 'always', 'hourly', 'daily', 'weekly', 'monthly', 'yearly', 'never'.
     *
     * @throws Exception Если данные страницы невалидны.
     */
    public function addPages(array $pagesData): void
    {
        foreach ($pagesData as $pageData) {
            $this->addPage($pageData);
        }
    }

    /**
     * Генерирует карту сайта в указанном формате и сохраняет её в файл.
     *
     * @param string $format Формат файла. Допустимые значения: 'xml', 'json', 'csv'.
     * @param string $directory Директория, в которой будет сохранен файл. По умолчанию — текущая директория.
     * @param string|null $fileName Имя файла (без расширения). Если не указано, будет использовано имя "sitemap".
     *
     * @throws Exception Если формат не поддерживается или произошла ошибка при записи файла.
     */
    public function generate(string $format, string $directory = __DIR__, ?string $fileName = null): void
    {
        $fileName = $fileName ? "{$fileName}.{$format}" : $this->generateFileName($format);
        $filePath = rtrim($directory, '/') . '/' . $fileName;

        $generator = $this->generatorFactory->create($format);
        $content = $generator->generate($this->pageCollection->getPages());

        $this->fileHandler->createDirectory($directory);
        $this->fileHandler->writeFile($filePath, $content);
    }

    private function addPage(array $pageData): void
    {
        $page = $this->pageFactory->createFromArray($pageData);
        $this->pageCollection->addPage($page);
    }

    private function generateFileName(string $format): string
    {
        $extension = strtolower($format);
        return "sitemap.{$extension}";
    }
}
