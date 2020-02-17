<nav class="nav nav-pills nav-justified">
    <?php foreach ($items as $key => $item): ?>
        <a class="nav-link<?php if ($key === $active): ?> active<?php endif ?>" href="<?= $item['url'] ?>">
            <?= $item['name'] ?>
        </a>
    <?php endforeach; ?>
</nav>
