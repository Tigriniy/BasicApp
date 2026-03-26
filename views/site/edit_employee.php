<h2>Редактирование сотрудника</h2>

<form method="POST">
    <div>
        <label>Фамилия</label>
        <input type="text" name="last_name" value="<?= htmlspecialchars($employee->last_name) ?>" required>
    </div>
    <div>
        <label>Имя</label>
        <input type="text" name="first_name" value="<?= htmlspecialchars($employee->first_name) ?>" required>
    </div>
    <div>
        <label>Отчество</label>
        <input type="text" name="middle_name" value="<?= htmlspecialchars($employee->middle_name) ?>">
    </div>
    <div>
        <label>Телефон</label>
        <input type="text" name="phone" value="<?= htmlspecialchars($employee->phone) ?>">
    </div>
    <div>
        <label>Email</label>
        <input type="email" name="email" value="<?= htmlspecialchars($employee->email) ?>">
    </div>

    <button type="submit">Сохранить изменения</button>
    <a href="<?= app()->route->getUrl('/employees') ?>">Отмена</a>
</form>