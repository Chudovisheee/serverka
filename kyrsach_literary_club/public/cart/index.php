<?php
$title = 'Корзина';
include __DIR__ . '/../page_start.php';
?>

<h1><i class="fas fa-shopping-cart"></i> Моя корзина</h1>

<div class="cart-calculator">
    <h3><i class="fas fa-calculator"></i> Калькулятор стоимости</h3>
    <form method="POST" action="<?= $basePath ?>/cart/calculate">
        <div class="form-group">
            <label><i class="fas fa-square-root-variable"></i> Введите математическое выражение</label>
            <input type="text" name="expression" id="expression" placeholder="Пример: 599 + 499 * 2" required>
        </div>
        <button type="submit" class="btn"><i class="fas fa-equals"></i> Посчитать</button>
    </form>
    
    <?php if (isset($total)): ?>
        <div class="result">
            <i class="fas fa-coins"></i> Итого: <?= round($total, 2) ?> ₽
        </div>
    <?php endif; ?>
</div>

<div class="cart-items">
    <h3><i class="fas fa-books"></i> Товары в корзине</h3>
    <p><i class="fas fa-box-open"></i> Пока пусто...</p>
</div>

<?php include __DIR__ . '/../page_end.php'; ?>