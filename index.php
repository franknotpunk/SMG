<?php

require_once __DIR__ . '/vendor/autoload.php';

use SGM\SitemapGenerator;

$generator = new SitemapGenerator();
$generator->addPages([[
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
    ]]);

$generator->generate('json');
$generator->generate('xml');
$generator->generate('csv');

echo 'Sitemap generated successfully!';
