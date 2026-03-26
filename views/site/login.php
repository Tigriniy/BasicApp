<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Вход в систему</title>
    <link rel="stylesheet" href="<?= app()->route->getUrl('/css/main.css') ?>">
</head>
<body>

<h1>Вход в систему отдела кадров</h1>

<?php if (isset($message)): ?>
    <p style="color: red; font-weight: bold;"><?= htmlspecialchars($message) ?></p>
<?php endif; ?>

<?php if (app()->auth::check()): ?>
    <p>Вы уже вошли как <?= htmlspecialchars(app()->auth::user()->login) ?></p>
<?php else: ?>
    <form method="POST" action="<?= app()->route->getUrl('/login') ?>">
        <div>
            <label for="login">Логин</label>
            <input type="text" id="login" name="login" required>
        </div>
        <div>
            <label for="password">Пароль</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit">Войти</button>
    </form>
<?php endif; ?>

<p><a href="<?= app()->route->getUrl('/hello') ?>">На главную</a></p>

</body>
</html>