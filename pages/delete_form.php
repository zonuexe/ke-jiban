<?php

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT, ['options' => ['min_range' => 0]]);

if ($id === false) {
    require __DIR__ . '/404.php';
    return;
}

$record = array_column(readData(), null, 'id')[$id] ?? null;
if ($record === null) {
    require __DIR__ . '/404.php';
    return;
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>ページ削除</title>
</head>

<body>

    <h1>削除</h1>

    <div>
        <p>IPアドレス：<?= h($record['ip']) ?></p>
        <p>日時：<?= h($record['date']) ?></p>
        <p>投稿者：<?= h($record['name']) ?></p>
        <p>内容：<br><?= nl2br(h($record['content'])) ?></p>
    </div>

    <form method="post" action="/delete?<?= h(http_build_query(['id' => $record['id']])) ?>">
        <div>
            <label>
                削除パスワード:
                <input type="password" name="delete_password">
            </label>
        </div>
        <button type="submit">削除</button>
    </form>
</body>
