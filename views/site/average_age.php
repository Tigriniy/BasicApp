<h2>Средний возраст сотрудников по подразделениям</h2>

<div class="stats-grid">
    <?php if (count($stats) > 0): ?>
        <?php foreach ($stats as $item): ?>
            <div class="stats-card">
                <div class="stats-content">
                    <span class="stats-label"><?= htmlspecialchars($item->department_name) ?></span>
                    <span class="stats-value">
                        <?= number_format($item->avg_age, 1) ?>
                        <small>лет</small>
                    </span>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="empty-state">Данные по возрасту отсутствуют</div>
    <?php endif; ?>
</div>