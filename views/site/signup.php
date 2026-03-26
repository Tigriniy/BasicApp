<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Регистрация нового кадровика</title>
    <link rel="stylesheet" href="/css/main.css">
</head>
<body>

<h1>Регистрация нового сотрудника отдела кадров</h1>

<?php if (isset($error)): ?>
    <p style="color: red; font-weight: bold;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<?php if (isset($success)): ?>
    <p style="color: green; font-weight: bold;"><?= htmlspecialchars($success) ?></p>
<?php endif; ?>

<form method="POST">
    <div>
        <label for="login">Логин *</label>
        <input type="text" id="login" name="login" required>
    </div>
    <div>
        <label for="password">Пароль *</label>
        <input type="password" id="password" name="password" required>
    </div>
    <button type="submit">Зарегистрировать</button>
</form>

<p><a href="<?= app()->route->getUrl('/hello') ?>">На главную</a></p>

</body>
</html>