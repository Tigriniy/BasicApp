<h2>Список всех сотрудников</h2>

<?php if (empty($employees)): ?>
    <p>Сотрудников пока нет.</p>
<?php else: ?>
    <table border="1" style="width: 100%; border-collapse: collapse; margin-top: 20px;">
        <thead>
        <tr style="background-color: #f2f2f2;">
            <th>ID</th>
            <th>Фамилия</th>
            <th>Имя</th>
            <th>Отчество</th>
            <th>Пол</th>
            <th>Телефон</th>
            <th>Email</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($employees as $employee): ?>
            <tr>
                <td><?= $employee->employee_id ?></td>
                <td><?= htmlspecialchars($employee->last_name) ?></td>
                <td><?= htmlspecialchars($employee->first_name) ?></td>
                <td><?= htmlspecialchars($employee->middle_name) ?></td>
                <td><?= htmlspecialchars($employee->gender) ?></td>
                <td><?= htmlspecialchars($employee->phone) ?></td>
                <td><?= htmlspecialchars($employee->email) ?></td>
                <td>
                    <a href="<?= app()->route->getUrl('/employees/edit?id=' . $employee->employee_id) ?>">Редактировать</a>
                    <a href="<?= app()->route->getUrl('/employees/delete?id=' . $employee->employee_id) ?>"
                       onclick="return confirm('Вы уверены?')">Удалить</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<div style="margin-top: 20px;">
    <a href="<?= app()->route->getUrl('/employees/add') ?>" class="action-card" style="display: inline-block; padding: 10px; border: 1px solid #ccc; text-decoration: none; color: black;">
        <strong>+ Добавить сотрудника</strong>
    </a>
</div>