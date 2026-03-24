<h2><?= htmlspecialchars($message ?? 'Главная страница') ?></h2>

<p>Вы вошли как: <strong><?= htmlspecialchars($user->login ?? '') ?></strong></p>
<p>Ваша роль: <strong><?= htmlspecialchars($user->role ?? '') ?></strong></p>

<h3>Доступные действия:</h3>
<ul>
    <li><a href="<?=app()->route->getUrl('/employees/add') ?>">Добавить нового сотрудника</a></li>
    <li><a href="<?=app()->route->getUrl('/employees') ?>">Посмотреть всех сотрудников</a></li>
    <li><a href="<?=app()->route->getUrl('/employees/by_department') ?>">Список сотрудников по подразделению</a></li>
    <li><a href="<?=app()->route->getUrl('/employees/by_category') ?>">Список сотрудников по составу</a></li>
    <li><a href="<?=app()->route->getUrl('/employees/avg_age') ?>">Средний возраст по подразделениям</a></li>
</ul>