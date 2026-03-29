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
    <div class="employees-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 20px;">
        <?php foreach ($employees as $employee): ?>
            <div class="employee-card" style="border: 1px solid #ddd; padding: 15px; border-radius: 10px; background: #fff; text-align: center;">

                <div class="employee-photo" style="margin-bottom: 15px; text-align: center;">
                    <?php if (!empty($employee->image)): ?>
                        <img src="<?= $employee->image ?>"
                             alt="Фото"
                             style="width: 100px; height: 100px; object-fit: cover; border-radius: 50%; border: 2px solid #007bff;">
                    <?php else: ?>
                        <div style="width: 100px; height: 100px; background: #f0f0f0; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; color: #aaa; border: 2px dashed #ccc; margin: 0 auto;">
                            Нет фото
                        </div>
                    <?php endif; ?>
                </div>

                <div class="employee-header" style="font-size: 0.8em; color: #666; margin-bottom: 5px;">
                    <span class="employee-id">#<?= $employee->employee_id ?></span>
                    <span class="employee-gender"><?= htmlspecialchars($employee->gender) ?></span>
                </div>

                <div class="employee-name" style="font-size: 1.2em; font-weight: bold; margin-bottom: 10px;">
                    <?= htmlspecialchars($employee->last_name) ?>
                    <?= htmlspecialchars($employee->first_name) ?>
                    <div style="font-weight: normal; font-size: 0.9em; color: #555;">
                        <?= htmlspecialchars($employee->middle_name ?? '') ?>
                    </div>
                </div>

                <div class="employee-contacts" style="font-size: 0.9em; text-align: left; background: #f9f9f9; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
                    <?php if (!empty($employee->phone)): ?>
                        <div><strong>Тел:</strong> <?= htmlspecialchars($employee->phone) ?></div>
                    <?php endif; ?>
                    <?php if (!empty($employee->email)): ?>
                        <div><strong>Email:</strong> <?= htmlspecialchars($employee->email) ?></div>
                    <?php endif; ?>
                </div>

                <div class="employee-actions" style="display: flex; justify-content: space-around;">
                    <a href="<?= app()->route->getUrl('/employees/edit?id=' . $employee->employee_id) ?>"
                       class="btn-edit" style="font-size: 0.85em;">Редактировать</a>
                    <a href="<?= app()->route->getUrl('/employees/delete?id=' . $employee->employee_id) ?>"
                       class="btn-delete" style="font-size: 0.85em;"
                       onclick="return confirm('Вы действительно хотите удалить этого сотрудника?')">Удалить</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<div class="add-employee-block" style="margin-top: 30px;">
    <a href="<?= app()->route->getUrl('/employees/add') ?>" class="action-card" style="text-decoration: none; display: block; padding: 20px; border: 2px dashed #007bff; text-align: center; border-radius: 10px; color: #007bff;">
        <strong>+ Добавить нового сотрудника</strong>
    </a>
</div>