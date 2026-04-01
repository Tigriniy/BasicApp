<h2>Список сотрудников по составу</h2>

<div class="filter-section">
    <form method="GET" class="filter-form role-filter">
        <label for="category_id">Категория состава:</label>
        <select name="category_id" id="category_id" onchange="this.form.submit()">
            <option value="">--- Все категории ---</option>
            <?php foreach ($categories as $cat): ?>
                <option value="<?= $cat->staff_id ?>"
                        <?= ($current_cat == $cat->staff_id) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($cat->category_name) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </form>
</div>

<div class="employee-list">
    <?php if (count($employees) > 0): ?>
        <?php foreach ($employees as $employee): ?>
            <div class="employee-row">
                <div class="emp-info main-info">
                    <span class="label">ФИО сотрудника</span>
                    <span class="value"><?= htmlspecialchars($employee->last_name . ' ' . $employee->first_name . ' ' . $employee->middle_name) ?></span>
                </div>

                <div class="emp-info">
                    <span class="label">Должность</span>
                    <span class="value">
                        <?php
                        $order = $employee->orders->first();
                        echo $order && $order->position
                                ? htmlspecialchars($order->position->name)
                                : '<span style="color: #999; font-weight: normal;">Не назначена</span>';
                        ?>
                    </span>
                </div>

                <div class="emp-info">
                    <span class="label">Контактные данные</span>
                    <span class="value"><?= htmlspecialchars($employee->phone) ?></span>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="empty-state">В данной категории сотрудники не найдены</div>
    <?php endif; ?>
</div>