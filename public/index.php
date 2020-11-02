<?php

declare(strict_types=1);

require __DIR__ . '/../bootstrap.php';

header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: SAMEORIGIN');
header('X-Robots-Tag: noindex, nofollow');
header('X-XSS-Protection: 1; mode=block');

[$type, $token] = explode(' ', $_SERVER['HTTP_AUTHORIZATION'] ?? ' ', 2);

if ($type !== 'Basic' || base64_decode($token) !== 'にゃーん:nya-n') {
    http_response_code(403);
    header('WWW-Authenticate: Basic realm="Nyaan", charset="UTF-8"');
    return;
}

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
