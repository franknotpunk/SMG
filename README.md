# Sitemap Generator

Библиотека для генерации карты сайта (sitemap) в различных форматах: XML, JSON и CSV. Проста в использовании и поддерживает все основные параметры страниц, такие как loc, lastmod, priority и changefreq.

## Установка

Установите библиотеку через Composer:

```bash
composer require franknotpunk/SMG
```

## Использование

### 1. Создание экземпляра генератора

```php
use SGM\SitemapGenerator;

$generator = new SitemapGenerator();
```

### 2. Добавление страниц

Вы можете добавить одну или несколько страниц. Каждая страница должна быть массивом с ключами:

- `loc` (string) — URL страницы.
- `lastmod` (string) — Дата последнего изменения в формате YYYY-MM-DD.
- `priority` (float, опционально) — Приоритет страницы (от 0.0 до 1.0).
- `changefreq` (string, опционально) — Частота изменения страницы. Допустимые значения: `always`, `hourly`, `daily`, `weekly`, `monthly`, `yearly`, `never`.

Пример:

```php
$generator->addPages([
    [
        'loc' => 'https://example.com',
        'lastmod' => '2024-01-01',
        'priority' => 0.8,
        'changefreq' => 'daily'
    ],
    [
        'loc' => 'https://example.com/about',
        'lastmod' => '2024-01-15',
        'priority' => 0.5,
        'changefreq' => 'monthly'
    ]
]);
```

### 3. Генерация карты сайта

Используйте метод `generate`, чтобы создать карту сайта в нужном формате:

```php
$generator->generate('xml', __DIR__ . '/sitemaps'); // Генерация XML
$generator->generate('json', __DIR__ . '/sitemaps'); // Генерация JSON
$generator->generate('csv', __DIR__ . '/sitemaps', "myName"); // Генерация CSV
```

Параметры метода `generate`:
- `format` (string) — Формат файла. Допустимые значения: `xml`, `json`, `csv`.
- `directory` (string) — Директория для сохранения файла. По умолчанию — текущая директория.
- `fileName` (string, опционально) — Имя файла (без расширения). Если не указано, будет использовано имя `sitemap`.

## Примеры

### Генерация XML

```php
$generator->generate('xml', __DIR__ . '/sitemaps');
```

Результат (файл `sitemap.xml`):

```xml
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>https://example.com</loc>
        <lastmod>2024-01-01</lastmod>
        <priority>0.8</priority>
        <changefreq>daily</changefreq>
    </url>
    <url>
        <loc>https://example.com/about</loc>
        <lastmod>2024-01-15</lastmod>
        <priority>0.5</priority>
        <changefreq>monthly</changefreq>
    </url>
</urlset>
```

### Генерация JSON

```php
$generator->generate('json', __DIR__ . '/sitemaps');
```

Результат (файл `sitemap.json`):

```json
[
    {
        "loc": "https://example.com",
        "lastmod": "2024-01-01",
        "priority": 0.8,
        "changefreq": "daily"
    },
    {
        "loc": "https://example.com/about",
        "lastmod": "2024-01-15",
        "priority": 0.5,
        "changefreq": "monthly"
    }
]
```

### Генерация CSV

```php
$generator->generate('csv', __DIR__ . '/sitemaps');
```

Результат (файл `sitemap.csv`):

```csv
loc,lastmod,priority,changefreq
https://example.com,2024-01-01,0.8,daily
https://example.com/about,2024-01-15,0.5,monthly
```

## Поддерживаемые форматы

- **XML**: Соответствует стандарту Sitemap Protocol.
- **JSON**: Удобен для использования в API или других приложениях.
- **CSV**: Подходит для импорта в таблицы или базы данных.

## Обработка ошибок

Библиотека выбрасывает исключения в случае ошибок:

- `InvalidPageException` — если данные страницы невалидны.
- `FileWriteException` — если произошла ошибка при записи файла.

Пример обработки ошибок:

```php
try {
    $generator->addPages([...]);
    $generator->generate('xml', __DIR__ . '/sitemaps');
} catch (\SGM\Exceptions\InvalidPageException $e) {
    echo "Ошибка в данных страницы: " . $e->getMessage();
} catch (\SGM\Exceptions\FileWriteException $e) {
    echo "Ошибка при записи файла: " . $e->getMessage();
}
```

## Лицензия

Библиотека распространяется под лицензией MIT. См. файл LICENSE для подробностей.
