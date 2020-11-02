<?php

$name = filter_input(INPUT_POST, 'personal_name');
$content = filter_input(INPUT_POST, 'contents');
$now = new DateTimeImmutable;
$ip = $_SERVER['REMOTE_ADDR'];

writeData($name, $content, $now, $ip);

include __DIR__ . '/index.php';
