<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Вход в систему</title>
    <link rel="stylesheet" href="/css/main.css">
</head>
<body>

<h1>Вход в систему отдела кадров</h1>

<h3><?= $message ?? ''; ?></h3>
<h3><?= app()->auth->user()->name ?? ''; ?></h3>

<?php if (!app()->auth::check()): ?>
    <form method="POST">
        <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>

        <div>
            <label>Логин <input type="text" name="login" required></label>
        </div>
        <div>
            <label>Пароль <input type="password" name="password" required></label>
        </div>
        <button type="submit">Войти</button>
    </form>
<?php else: ?>
    <p>Вы уже вошли как <?= htmlspecialchars(app()->auth::user()->login) ?></p>
<?php endif; ?>

<p><a href="<?= app()->route->getUrl('/hello') ?>">На главную</a></p>

</body>
</html>
