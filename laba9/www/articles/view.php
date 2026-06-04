<?php include __DIR__ . '/../page_start.php'; ?>

    <h1><?= $article->getName() ?></h1>
    <p><?= $article->getText() ?></p>
    
    <?php if ($author !== null): ?>
        <p><strong>Автор:</strong> <?= $author->nickname ?></p>
    <?php endif; ?>

<?php include __DIR__ . '/../page_end.php'; ?>