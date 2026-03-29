<h2>Список всех сотрудников</h2>

<?php if (empty($employees)): ?>
    <p>Сотрудников пока нет.</p>
<?php else: ?>
    <div class="employees-grid">
        <?php foreach ($employees as $employee): ?>
            <div class="employee-card">
                <div class="employee-header">
                    <span class="employee-id">#<?= $employee->employee_id ?></span>
                    <span class="employee-gender"><?= htmlspecialchars($employee->gender) ?></span>
                </div>

                <div class="employee-name">
                    <?= htmlspecialchars($employee->last_name) ?>
                    <?= htmlspecialchars($employee->first_name) ?>
                    <?= htmlspecialchars($employee->middle_name ?? '') ?>
                </div>

                <div class="employee-contacts">
                    <?php if (!empty($employee->phone)): ?>
                        <div><strong>Телефон:</strong> <?= htmlspecialchars($employee->phone) ?></div>
                    <?php endif; ?>
                    <?php if (!empty($employee->email)): ?>
                        <div><strong>Email:</strong> <?= htmlspecialchars($employee->email) ?></div>
                    <?php endif; ?>
                </div>

                <div class="employee-actions">
                    <a href="<?= app()->route->getUrl('/employees/edit?id=' . $employee->employee_id) ?>"
                       class="btn-edit">Редактировать</a>
                    <a href="<?= app()->route->getUrl('/employees/delete?id=' . $employee->employee_id) ?>"
                       class="btn-delete"
                       onclick="return confirm('Вы действительно хотите удалить этого сотрудника?')">Удалить</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<div class="add-employee-block">
    <a href="<?= app()->route->getUrl('/employees/add') ?>" class="action-card">
        <strong>+ Добавить нового сотрудника</strong>
    </a>
</div>