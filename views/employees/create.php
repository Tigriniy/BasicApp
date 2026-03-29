<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавить сотрудника</title>
    <link rel="stylesheet" href="/css/main.css">
</head>
<body>

<h1>Добавление нового сотрудника</h1>

<form method="POST" action="<?= app()->route->getUrl('/employees/add') ?>">
    <input type="hidden" name="csrf_token" value="<?= app()->auth::generateCSRF() ?>">

    <div>
        <label for="last_name">Фамилия</label>
        <input type="text" id="last_name" name="last_name" value="<?= $old['last_name'] ?? '' ?>" required>
        <span style="color: red; display: block; font-size: 0.8em;"><?= $errors['last_name'][0] ?? '' ?></span>
    </div>

    <div>
        <label for="first_name">Имя</label>
        <input type="text" id="first_name" name="first_name" value="<?= $old['first_name'] ?? '' ?>" required>
        <span style="color: red; display: block; font-size: 0.8em;"><?= $errors['first_name'][0] ?? '' ?></span>
    </div>

    <div>
        <label for="middle_name">Отчество</label>
        <input type="text" id="middle_name" name="middle_name" value="<?= $old['middle_name'] ?? '' ?>">
        <span style="color: red; display: block; font-size: 0.8em;"><?= $errors['middle_name'][0] ?? '' ?></span>
    </div>

    <div>
        <label for="gender">Пол</label>
        <select id="gender" name="gender" required>
            <option value="мужской" <?= (isset($old['gender']) && $old['gender'] == 'мужской') ? 'selected' : '' ?>>Мужской</option>
            <option value="женский" <?= (isset($old['gender']) && $old['gender'] == 'женский') ? 'selected' : '' ?>>Женский</option>
        </select>
    </div>

    <div>
        <label for="birth_date">Дата рождения</label>
        <input type="date" id="birth_date" name="birth_date" value="<?= $old['birth_date'] ?? '' ?>" required>
    </div>

    <div>
        <label for="registration_address">Адрес прописки</label>
        <input type="text" id="registration_address" name="registration_address" value="<?= $old['registration_address'] ?? '' ?>" required>
    </div>

    <div>
        <label for="phone">Телефон</label>
        <input type="tel" id="phone" name="phone" placeholder="+7 (999) 123-45-67" value="<?= $old['phone'] ?? '' ?>" required>
        <span style="color: red; display: block; font-size: 0.8em;"><?= $errors['phone'][0] ?? '' ?></span>
    </div>

    <div>
        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="<?= $old['email'] ?? '' ?>" required>
        <span style="color: red; display: block; font-size: 0.8em;"><?= $errors['email'][0] ?? '' ?></span>
    </div>

    <div>
        <label for="department_id">Подразделение *</label>
        <select id="department_id" name="department_id" required>
            <option value="">Выберите подразделение</option>
            <?php foreach ($departments as $dept): ?>
                <option value="<?= $dept->department_id ?>" <?= (isset($old['department_id']) && $old['department_id'] == $dept->department_id) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($dept->name) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div>
        <label for="position_id">Должность *</label>
        <select id="position_id" name="position_id" required>
            <option value="">Выберите должность</option>
            <?php foreach ($positions as $pos): ?>
                <option value="<?= $pos->positions_id ?>" <?= (isset($old['position_id']) && $old['position_id'] == $pos->positions_id) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($pos->name) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div>
        <label for="order_number">Номер приказа</label>
        <input type="text" id="order_number" name="order_number" value="<?= $old['order_number'] ?? '' ?>" required>
    </div>

    <button type="submit">Добавить сотрудника</button>
</form>

<p><a href="<?= app()->route->getUrl('/hello') ?>">На главную</a></p>

<script>
    const phoneInput = document.querySelector('#phone');

    phoneInput.addEventListener('input', (e) => {

        let input = e.target.value.replace(/\D/g, '');

        if (!input) {
            e.target.value = '';
            return;
        }

        let result = '+7 (';


        if (input.length > 1) {
            result += input.substring(1, 4);
        }

        if (input.length > 4) {
            result += ') ' + input.substring(4, 7);
        }

        if (input.length > 7) {
            result += '-' + input.substring(7, 9);
        }
        if (input.length > 9) {
            result += '-' + input.substring(9, 11);
        }

        e.target.value = result;
    });
</script>

</body>
</html>