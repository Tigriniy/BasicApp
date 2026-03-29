<h2>Редактирование сотрудника</h2>

<form method="POST" enctype="multipart/form-data" class="form-container">
    <input type="hidden" name="csrf_token" value="<?= app()->auth::generateCSRF() ?>">

    <div class="photo-section">
        <label class="photo-label">Фото сотрудника</label>

        <?php if (!empty($employee->image)): ?>
            <img id="currentPhoto" src="<?= $employee->image ?>" alt="Текущее фото" class="employee-photo">
        <?php else: ?>
            <div id="currentPhoto" class="photo-placeholder">
                Фото отсутствует
            </div>
        <?php endif; ?>

        <img id="preview" src="#" alt="Новое фото" class="photo-preview">

        <input type="file" id="imageInput" name="image" accept="image/jpeg,image/png,image/webp,image/jfif">
        <p class="file-input-help">Выберите файл, чтобы заменить текущее фото</p>
    </div>

    <hr class="divider">

    <div class="form-group">
        <label>Фамилия</label>
        <input type="text" name="last_name" class="form-control" value="<?= htmlspecialchars($employee->last_name) ?>" required>
    </div>

    <div class="form-group">
        <label>Имя</label>
        <input type="text" name="first_name" class="form-control" value="<?= htmlspecialchars($employee->first_name) ?>" required>
    </div>

    <div class="form-group">
        <label>Отчество</label>
        <input type="text" name="middle_name" class="form-control" value="<?= htmlspecialchars($employee->middle_name) ?>">
    </div>

    <div class="form-group">
        <label>Телефон</label>
        <input type="tel" id="phone" name="phone" class="form-control" placeholder="+7 (999) 123-45-67" value="<?= htmlspecialchars($employee->phone) ?>">
    </div>

    <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($employee->email) ?>">
    </div>

    <div class="form-actions">
        <button type="submit" class="btn-edit" style="flex: 2;">Сохранить изменения</button>
        <a href="<?= app()->route->getUrl('/employees') ?>" class="btn-delete" style="flex: 1; text-align: center;">Отмена</a>
    </div>
</form>

<script>
    const imageInput = document.querySelector('#imageInput');
    const currentPhoto = document.querySelector('#currentPhoto');
    const preview = document.querySelector('#preview');

    imageInput.onchange = evt => {
        const [file] = imageInput.files;
        if (file) {
            preview.src = URL.createObjectURL(file);
            if (currentPhoto) currentPhoto.style.display = 'none';
            preview.style.display = 'inline-block';
        }
    }

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
</script>