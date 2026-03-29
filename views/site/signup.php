<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Регистрация нового сотрудника</title>
    <link rel="stylesheet" href="/css/main.css">
</head>
<body>

<h1>Регистрация нового сотрудника отдела кадров</h1>

<pre><?= $message ?? ''; ?></pre>

<form method="POST">
    <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>

    <div>
        <label>Имя <input type="text" name="name" required></label>
    </div>
    <div>
        <label>Логин <input type="text" name="login" required></label>
    </div>
    <div>
        <label>Пароль <input type="password" name="password" required></label>
    </div>
    <button type="submit">Зарегистрироваться</button>
</form>

<p><a href="<?= app()->route->getUrl('/hello') ?>">На главную</a></p>

</body>
</html>
