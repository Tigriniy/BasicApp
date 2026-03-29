<h2>Список всех сотрудников</h2>

<section class="search-section" style="margin-bottom: 20px;">
    <form method="GET" action="<?= app()->route->getUrl('/employees') ?>" style="display: flex; gap: 10px;">
        <input type="text" name="search"
               placeholder="Поиск по фамилии..."
               value="<?= htmlspecialchars($_GET['search'] ?? '') ?>"
               style="padding: 8px; flex-grow: 1; border: 1px solid #ccc; border-radius: 4px;">
        <button type="submit" class="btn-edit">Найти</button>
        <?php if (!empty($_GET['search'])): ?>
            <a href="<?= app()->route->getUrl('/employees') ?>" class="btn-delete" style="text-decoration: none; line-height: 2;">Сбросить</a>
        <?php endif; ?>
    </form>
</section>

<?php if (empty($employees)): ?>
    <p>Сотрудников не найдено.</p>
<?php else: ?>
    <div class="employees-grid">
        <?php foreach ($employees as $employee): ?>
            <div class="employee-card">
                <div class="employee-header">
                    <span class="employee-id">#<?= $employee->employee_id ?></span>
                    <span class="employee-gender"><?= htmlspecialchars($employee->gender) ?></span>
                </div>

                <div class="employee-name">
                    <strong><?= htmlspecialchars($employee->last_name) ?></strong>
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