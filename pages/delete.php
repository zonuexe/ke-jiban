<?php

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT, ['min_range' => 0]);
$password = filter_input(INPUT_POST, 'delete_password') ?? '';

if ($id === false || $id === null) {
    require __DIR__ . '/404.php';
    return;
}

if (deleteData($id, $password)) {
    http_response_code(303);
    header('Location: /');
    return;
}

require __DIR__ . '/delete_form.php';
