<?php
$title = 'Статистика клуба';
include __DIR__ . '/page_start.php';
?>

<h2><i class="fas fa-chart-line"></i> Статистика книжного клуба</h2>

<div class="stats-grid">
    <div class="stat-card">
        <i class="fas fa-star" style="font-size: 48px; color: #F4A0B5;"></i>
        <h3>Средний рейтинг книг</h3>
        <p class="big-number"><?= round($stats['avg_rating'], 1) ?></p>
        <p>из 5</p>
    </div>
    <div class="stat-card">
        <i class="fas fa-book" style="font-size: 48px; color: #C5B4E3;"></i>
        <h3>Всего книг</h3>
        <p class="big-number"><?= $stats['total_books'] ?></p>
        <p>в библиотеке</p>
    </div>
    <div class="stat-card">
        <i class="fas fa-users" style="font-size: 48px; color: #B39CD0;"></i>
        <h3>Активных читателей</h3>
        <p class="big-number"><?= $stats['active_members'] ?></p>
        <p>человек</p>
    </div>
</div>

<div class="equation-info">
    <p><i class="fas fa-calculator"></i> Статистика рассчитана с помощью решения уравнений:</p>
    <ul>
        <li><i class="fas fa-chart-simple"></i> Средний рейтинг: <code>X + 0.5 = 4.5</code> → X = <?= $stats['avg_rating'] ?></li>
        <li><i class="fas fa-book"></i> Всего книг: <code>X - 5 = 15</code> → X = <?= $stats['total_books'] ?></li>
        <li><i class="fas fa-user-group"></i> Активных читателей: <code>X / 2 = 25</code> → X = <?= $stats['active_members'] ?></li>
    </ul>
</div>

<?php include __DIR__ . '/page_end.php'; ?>