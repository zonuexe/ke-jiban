<?php

declare(strict_types=1);

function h(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

function readData(): array
{
    return json_decode(file_get_contents(__DIR__ . '/../cache/keijiban.json'), true) ?: [];
}

function writeData(string $name, string $content, DateTimeImmutable $datetime, string $ip): void
{
    $fp = fopen(__DIR__ . '/../cache/keijiban.json', 'r+');
    flock($fp, LOCK_EX);

    $data = json_decode(stream_get_contents($fp), true);

    $id = ($data[0]['id'] ?? 0) + 1;
    $date = $datetime->format('Y-m-d H:i:s');

    array_unshift($data, compact('id', 'name', 'content', 'date', 'ip'));

    fseek($fp, 0);
    fwrite($fp, json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));

    fclose($fp);
}
