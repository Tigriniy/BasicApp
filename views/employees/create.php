
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Добавить сотрудника</title>
    <link rel="stylesheet" href="/css/main.css">
</head>
<body>

<h1>Добавление нового сотрудника</h1>

<?php if (isset($error)): ?>
    <p style="color: red;"><?=htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="POST" action="<?= app()->route->getUrl('/employees/add') ?>">
    <input type="hidden" name="csrf_token" value="<?= app()->auth::generateCSRF() ?>">
    <div>
        <label for="last_name">Фамилия</label>
        <input type="text" id="last_name" name="last_name" required>
    </div>

    <div>
        <label for="first_name">Имя</label>
        <input type="text" id="first_name" name="first_name" required>
    </div>

    <div>
        <label for="middle_name">Отчество</label>
        <input type="text" id="middle_name" name="middle_name" required>
    </div>

    <div>
        <label for="gender">Пол</label>
        <select id="gender" name="gender" required>
            <option value="мужской">Мужской</option>
            <option value="женский">Женский</option>
        </select>
    </div>

    <div>
        <label for="birth_date">Дата рождения</label>
        <input type="date" id="birth_date" name="birth_date" required>
    </div>

    <div>
        <label for="registration_address">Адресс прописки</label>
        <input type="text" id="registration_address" name="registration_address" required>
    </div>

    <div>
        <label for="phone">Телефон</label>
        <input type="tel" id="phone" name="phone" required>
    </div>

    <div>
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>
    </div>



    <div>
        <label for="department_id">Подразделение *</label>
        <select id="department_id" name="department_id" required>
            <option value="">Выберите подразделение</option>
            <?php if (isset($departments) && is_iterable($departments)): ?>
                <?php foreach ($departments as $dept): ?>
                    <option value="<?= $dept->department_id ?>">
                        <?= htmlspecialchars($dept->name ?? '') ?>
                    </option>
                <?php endforeach; ?>
            <?php endif; ?>
        </select>
    </div>

    <div>
        <label for="position_id">Должность *</label>
        <select id="position_id" name="position_id" required>
            <option value="">Выберите должность</option>
            <?php if (isset($positions) && is_iterable($positions)): ?>
                <?php foreach ($positions as $pos): ?>
                    <option value="<?= $pos->positions_id ?>">
                        <?= htmlspecialchars($pos->name ?? '') ?>
                    </option>
                <?php endforeach; ?>
            <?php endif; ?>
        </select>
    </div>

    <div>
        <label for="order_number">Номер приказа</label>
        <input type="text" id="order_number" name="order_number" required>
    </div>

    <button type="submit">Добавить сотрудника</button>
</form>

<p><a href="<?= app()->route->getUrl('/hello') ?>">На главную</a></p>

</body>
</html>