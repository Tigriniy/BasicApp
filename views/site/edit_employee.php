<h2>Редактирование сотрудника</h2>

<form method="POST" enctype="multipart/form-data" style="max-width: 500px; background: #f4f7f6; padding: 20px; border-radius: 10px;">
    <input type="hidden" name="csrf_token" value="<?= app()->auth::generateCSRF() ?>">

    <div class="current-photo-section" style="margin-bottom: 20px; text-align: center;">
        <label style="display: block; margin-bottom: 10px; font-weight: bold;">Фото сотрудника</label>

        <?php if (!empty($employee->image)): ?>
            <img id="currentPhoto" src="<?= $employee->image ?>" alt="Текущее фото"
                 style="width: 150px; height: 150px; object-fit: cover; border-radius: 10px; border: 1px solid #ccc; margin-bottom: 10px;">
        <?php else: ?>
            <div id="currentPhoto" style="width: 150px; height: 150px; background: #e0e0e0; margin: 0 auto 10px; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: #888; border: 1px dashed #999;">
                Фото отсутствует
            </div>
        <?php endif; ?>

        <img id="preview" src="#" alt="Новое фото"
             style="width: 150px; height: 150px; object-fit: cover; border-radius: 10px; border: 2px solid #28a745; margin-bottom: 10px; display: none;">

        <input type="file" id="imageInput" name="image" accept="image/jpeg,image/png,image/webp,image/jfif" style="font-size: 0.9em; display: block; margin: 0 auto;">
        <p style="font-size: 0.8em; color: #777;">Выберите файл, чтобы заменить текущее фото</p>
    </div>

    <hr style="border: 0; border-top: 1px solid #ddd; margin: 20px 0;">

    <div style="margin-bottom: 10px;">
        <label style="display: block;">Фамилия</label>
        <input type="text" name="last_name" value="<?= htmlspecialchars($employee->last_name) ?>" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
    </div>

    <div style="margin-bottom: 10px;">
        <label style="display: block;">Имя</label>
        <input type="text" name="first_name" value="<?= htmlspecialchars($employee->first_name) ?>" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
    </div>

    <div style="margin-bottom: 10px;">
        <label style="display: block;">Отчество</label>
        <input type="text" name="middle_name" value="<?= htmlspecialchars($employee->middle_name) ?>" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
    </div>

    <div style="margin-bottom: 10px;">
        <label style="display: block;">Телефон</label>
        <input type="tel" id="phone" name="phone" placeholder="+7 (999) 123-45-67" value="<?= htmlspecialchars($employee->phone) ?>" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
    </div>

    <div style="margin-bottom: 20px;">
        <label style="display: block;">Email</label>
        <input type="email" name="email" value="<?= htmlspecialchars($employee->email) ?>" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
    </div>

    <div style="display: flex; gap: 10px;">
        <button type="submit" class="btn-edit" style="flex: 2; padding: 10px; cursor: pointer;">Сохранить изменения</button>
        <a href="<?= app()->route->getUrl('/employees') ?>" class="btn-delete" style="flex: 1; text-align: center; text-decoration: none; padding: 10px; line-height: 1.2; background: #dc3545; color: white; border-radius: 4px;">Отмена</a>
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