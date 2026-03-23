<h2>Регистрация нового сотрудника отдела кадров</h2>

<?php if (isset($error)): ?>
    <p style="color: red;"><?=$error?></p>
<?php endif; ?>

<?php if (isset($success)): ?>
    <p style="color: green;"><?= $success ?></p>
<?php endif; ?>



<form method="post">
    <div>
        <label>Логин:</label>
        <input type="text" name="login" required>
    </div>
    <div>
        <label>Пароль:</label>
        <input type="text" name="password" required>
    </div>

    <div>
        <label>Роль:</label>
        <select name="role">
            <option value="hr_employee">Сотрудник отдела кадров</option>
        </select>
    </div>

    <button type="submit">Зарегистрировать</button>
</form>