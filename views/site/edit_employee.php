<h2>Редактирование сотрудника</h2>

<form method="POST">
    <input type="hidden" name="csrf_token" value="<?= app()->auth::generateCSRF() ?>">

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
        <input type="tel" id="phone" name="phone" placeholder="+7 (999) 123-45-67" value="<?= htmlspecialchars($employee->phone) ?>">
    </div>

    <div>
        <label>Email</label>
        <input type="email" name="email" value="<?= htmlspecialchars($employee->email) ?>">
    </div>

    <button type="submit">Сохранить изменения</button>
    <a href="<?= app()->route->getUrl('/employees') ?>">Отмена</a>
</form>

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