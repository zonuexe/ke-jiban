<html>

<head>
    <title>掲示板</title>
</head>

<body>

    <h1>掲示板</h1>

    <form method="POST">
        <input type="text" name="personal_name" placeholder="名前" required><br><br>
        <textarea name="contents" rows="8" cols="40" placeholder="投稿内容" required></textarea>
        <br><br>
        <input type="submit" name="btn1" value="投稿する">
    </form>

<?php readData() ?>
</body>

</html>
