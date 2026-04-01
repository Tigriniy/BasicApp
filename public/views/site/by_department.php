<h2>Список сотрудников по подразделениям</h2>

<nav class="filter-section">
    <form method="GET" class="filter-form">
        <label for="department_id">Подразделение:</label>
        <select name="department_id" id="department_id" onchange="this.form.submit()">
            <option value="">--- Все подразделения ---</option>
            <?php foreach ($departments as $dep): ?>
                <option value="<?= $dep->department_id ?>" <?= ($current_dep == $dep->department_id) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($dep->name) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </form>
</nav>

<div class="employee-list">
    <?php if (count($employees) > 0): ?>
        <?php foreach ($employees as $employee): ?>
            <div class="employee-row">
                <div class="emp-info main-info">
                    <span class="label">ФИО:</span>
                    <span class="value"><?= htmlspecialchars($employee->last_name . ' ' . $employee->first_name . ' ' . $employee->middle_name) ?></span>
                </div>
                <div class="emp-info">
                    <span class="label">Телефон:</span>
                    <span class="value"><?= htmlspecialchars($employee->phone) ?></span>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="empty-state">Сотрудники не найдены</div>
    <?php endif; ?>
</div>