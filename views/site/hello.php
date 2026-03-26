<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Главная - Отдел кадров</title>
    <link rel="stylesheet" href="/css/main.css">
</head>
<body>

<h2>Добро пожаловать в систему отдела кадров</h2>

<p>Вы вошли как: <strong><?= htmlspecialchars($user->login ?? '') ?></strong>
    (Роль: <strong><?= htmlspecialchars($user->role ?? '') ?></strong>)</p>

<h3>Доступные действия:</h3>

<div class="actions-grid">
    <a href="<?= app()->route->getUrl('/employees/add') ?>" class="action-card">
        <strong>Добавить сотрудника</strong>
        <span>Приём, перевод, заполнение личных данных</span>
    </a>

    <a href="<?= app()->route->getUrl('/employees') ?>" class="action-card">
        <strong>Список всех сотрудников</strong>
        <span>Просмотр текущего состава</span>
    </a>

    <a href="<?= app()->route->getUrl('/employees/by_department') ?>" class="action-card">
        <strong>Сотрудники по подразделению</strong>
        <span>Фильтрация по отделам и кафедрам</span>
    </a>

    <a href="<?= app()->route->getUrl('/employees/by_category') ?>" class="action-card">
        <strong>Сотрудники по составу</strong>
        <span>Проф-преп, АХЧ, учебно-вспомогательный и т.д.</span>
    </a>

    <a href="<?= app()->route->getUrl('/departments/avg_age') ?>" class="action-card">
        <strong>Средний возраст по подразделениям</strong>
        <span>Статистика по отделам</span>
    </a>

    <?php if (app()->auth::user()->role === 'admin'): ?>
        <a href="<?= app()->route->getUrl('/signup') ?>" class="action-card admin-card">
            <strong>Добавить нового кадровика</strong>
            <span>Создание учётной записи администратором</span>
        </a>
    <?php endif; ?>
</div>

</body>
</html>