<!DOCTYPE html>
<html>

<head>
    <title>掲示板</title>
</head>

<body>

    <h1>掲示板</h1>

    <form method="POST">
        <input type="text" name="personal_name" placeholder="名前" required><br><br>
        <textarea name="contents" rows="8" cols="40" placeholder="投稿内容" required></textarea>
        <div>
            <label>
                削除パスワード:
                <input type="password" name="delete_password">
            </label>
        </div>
        <br><br>
        <input type="submit" name="btn1" value="投稿する">
    </form>

    <?php foreach (readData() as $record): ?>
        <hr>
        <p>IPアドレス：<?= h($record['ip']) ?></p>
        <p>日時：<?= h($record['date']) ?></p>
        <p>投稿者：<?= h($record['name']) ?></p>
        <p>内容：
            <?php if (isset($record['content'])): ?>
                <br><?= nl2br(h($record['content'])) ?>
            <?php else: ?>
                <em>削除済み</em>
            <?php endif ?>
        </p>
        <?php if (isset($record['del_pass_hash'])): ?>
            <div>
                <form method="get" action="/delete" style="text-align: right">
                    <input type="hidden" name="id" value="<?= h($record['id']) ?>">
                    <button type="submit">削除</button>
                </form>
            </div>
        <?php endif ?>
    <?php endforeach ?>
</body>

</html>
