<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Отдел кадров</title>
    <link rel="stylesheet" href="/css/main.css">
</head>
<body>

<header>
    <h1>Система учёта сотрудников отдела кадров</h1>

    <?php if (app()->auth::check()): ?>
        <nav>
            <a href="<?= app()->route->getUrl('/hello') ?>">Главная</a> |
            <a href="<?= app()->route->getUrl('/employees/add') ?>">Добавить сотрудника</a> |
            <a href="<?= app()->route->getUrl('/employees') ?>">Список сотрудников</a> |

            <?php if (app()->auth::user()->role === 'admin'): ?>
                <a href="<?= app()->route->getUrl('/signup') ?>">Добавить кадровика</a> |
            <?php endif; ?>

            <a href="<?= app()->route->getUrl('/logout') ?>">Выйти (<?= htmlspecialchars(app()->auth::user()->login ?? '') ?>)</a>
        </nav>
    <?php else: ?>
        <nav>
            <a href="<?= app()->route->getUrl('/login') ?>">Вход</a>
        </nav>
    <?php endif; ?>
</header>

<main>
    <?= $content ?? '' ?>
</main>

<footer>
    <p>&copy; <?= date('Y') ?> Отдел кадров</p>
</footer>

</body>
</html>