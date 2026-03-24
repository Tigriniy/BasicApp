<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Отдел кадров</title>
    <link rel="stylesheet" href="/css/main.css">
</head>
<body>
<header>
    <h1>Система учета сотрудников отдела кадров</h1>
    <nav>
        <a href="<?= app()->route->getUrl('/hello') ?>">Главная</a>
        <?php if (!app()->auth::check()): ?>
            <a href="<?= app()->route->getUrl('/employees/add') ?>">Добавить сотрудника</a>
            <a href="<?= app()->route->getUrl('/employees') ?>">Список сотрудников</a>
            <a href="<?= app()->route->getUrl('/employees/by_department') ?>">По подразделениям</a>
            <a href="<?= app()->route->getUrl('/employees/by_category') ?>">По составу</a>
            <a href="<?= app()->route->getUrl('/departments/avg_age') ?>">Средний возраст</a>

            <?php if (!app()->auth::user()->role === 'admin'): ?>
                <a href="<?=app()->route->getUrl('/signup') ?>">Добавить кадровика</a>
            <?php endif; ?>

            <a href="<?= app()->route->getUrl('/logout') ?>">Выйти (<?= htmlspecialchars(app()->auth::user()->login ?? '') ?>)</a>

        <?php else: ?>
            <a href="<?= app()->route->getUrl('/login') ?>">Вход</a>
        <?php endif; ?>
    </nav>
</header>
<main>
    <?= $content ?? '' ?>
</main>

<footer>
    <p>&copy;<?= date('Y') ?>Отдел кадров</p>
</footer>

</body>
</html>