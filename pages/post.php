<?php

$name = filter_input(INPUT_POST, 'personal_name');
$content = filter_input(INPUT_POST, 'contents');
$now = new DateTimeImmutable;
$ip = $_SERVER['REMOTE_ADDR'];
$del_pass = filter_input(INPUT_POST, 'delete_password') ?? '';

$del_pass_hash = $del_pass === ''
    ? null
    : password_hash($del_pass, PASSWORD_ARGON2ID);

writeData($name, $content, $now, $ip, $del_pass_hash);

include __DIR__ . '/index.php';
