<?php

declare(strict_types=1);

require __DIR__ . '/../bootstrap.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = strtoupper($_SERVER['REQUEST_METHOD']);

require __DIR__ . '/../pages/' . ([
    '/' => [
        'GET' => 'index',
        'POST' => 'post',
    ],
    '/delete' => [
        'GET' => 'delete_form',
        'POST' => 'delete',
    ],
][$uri][$method] ?? '404') . '.php';
