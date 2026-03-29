<h1>Добавление нового сотрудника</h1>

<form method="POST" enctype="multipart/form-data" class="form-container">
    <input type="hidden" name="csrf_token" value="<?= app()->auth::generateCSRF() ?>">

    <div class="photo-section">
        <label class="photo-label">Фото сотрудника</label>
        <input type="file" name="image" id="imageInput" accept="image/jpeg,image/png,image/webp,image/jfif">
        <img id="preview" class="photo-preview" src="#" alt="Превью">
    </div>

    <div class="form-group">
        <label for="last_name">Фамилия</label>
        <input type="text" id="last_name" name="last_name" class="form-control" value="<?= htmlspecialchars($old['last_name'] ?? '') ?>" required>
        <span class="error-msg"><?= $errors['last_name'][0] ?? '' ?></span>
    </div>

    <div class="form-group">
        <label for="first_name">Имя</label>
        <input type="text" id="first_name" name="first_name" class="form-control" value="<?= htmlspecialchars($old['first_name'] ?? '') ?>" required>
        <span class="error-msg"><?= $errors['first_name'][0] ?? '' ?></span>
    </div>

    <div class="form-group">
        <label for="middle_name">Отчество</label>
        <input type="text" id="middle_name" name="middle_name" class="form-control" value="<?= htmlspecialchars($old['middle_name'] ?? '') ?>">
    </div>

    <div class="form-group">
        <label for="gender">Пол *</label>
        <select id="gender" name="gender" class="form-control" required>
            <option value="мужской" <?= (isset($old['gender']) && $old['gender'] == 'мужской') ? 'selected' : '' ?>>Мужской</option>
            <option value="женский" <?= (isset($old['gender']) && $old['gender'] == 'женский') ? 'selected' : '' ?>>Женский</option>
        </select>
    </div>

    <div class="form-group">
        <label for="birth_date">Дата рождения</label>
        <input type="date" id="birth_date" name="birth_date" class="form-control" value="<?= $old['birth_date'] ?? '' ?>" required>
    </div>

    <div class="form-group">
        <label for="registration_address">Адрес прописки</label>
        <input type="text" id="registration_address" name="registration_address" class="form-control" value="<?= htmlspecialchars($old['registration_address'] ?? '') ?>" required>
    </div>

    <div class="form-group">
        <label for="phone">Телефон</label>
        <input type="tel" id="phone" name="phone" class="form-control" placeholder="+7 (999) 123-45-67" value="<?= htmlspecialchars($old['phone'] ?? '') ?>" required>
        <span class="error-msg"><?= $errors['phone'][0] ?? '' ?></span>
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" class="form-control" value="<?= htmlspecialchars($old['email'] ?? '') ?>" required>
        <span class="error-msg"><?= $errors['email'][0] ?? '' ?></span>
    </div>

    <div class="form-group">
        <label for="department_id">Подразделение</label>
        <select id="department_id" name="department_id" class="form-control" required>
            <option value="">Выберите подразделение</option>
            <?php foreach ($departments as $dept): ?>
                <option value="<?= $dept->department_id ?>" <?= (isset($old['department_id']) && $old['department_id'] == $dept->department_id) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($dept->name) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn-edit" style="flex: 2;">Добавить сотрудника</button>
        <a href="<?= app()->route->getUrl('/employees') ?>" class="btn-delete" style="flex: 1; text-align: center;">Отмена</a>
    </div>
</form>

<script>
    const phoneInput = document.querySelector('#phone');
    phoneInput.addEventListener('input', (e) => {
        let input = e.target.value.replace(/\D/g, '');
        if (!input) { e.target.value = ''; return; }
        let result = '+7 (';
        if (input.length > 1) result += input.substring(1, 4);
        if (input.length > 4) result += ') ' + input.substring(4, 7);
        if (input.length > 7) result += '-' + input.substring(7, 9);
        if (input.length > 9) result += '-' + input.substring(9, 11);
        e.target.value = result;
    });

    const imageInput = document.querySelector('#imageInput');
    const preview = document.querySelector('#preview');
    imageInput.onchange = evt => {
        const [file] = imageInput.files;
        if (file) {
            preview.src = URL.createObjectURL(file);
            preview.style.display = 'block';
        }
    }
</script>