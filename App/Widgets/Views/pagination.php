<nav aria-label="Page navigation example">
    <ul class="pagination">
        <?php if ($page > 1): ?>
            <li class="page-item">
                <a class="page-link" href="<?= \App\Helpers\UrlHelper::changeQuery(['page' => ($page - 1)]) ?>"
                   aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Previous</span>
                </a>
            </li>
        <?php endif; ?>
        <?php for ($i = ($page - 3); $i < $page; $i++): ?>
            <?php if ($i > 0): ?>
                <li class="page-item">
                    <a class="page-link" href="<?= \App\Helpers\UrlHelper::changeQuery(['page' => $i]) ?>"><?= $i ?></a>
                </li>
            <?php endif; ?>
        <?php endfor; ?>
        <li class="page-item active">
            <a class="page-link" href="#"><?= $page ?></a>
        </li>
        <?php for ($i = ($page + 1); $i <= ($page + 3); $i++): ?>
            <?php if ($i <= $totalPages): ?>
                <li class="page-item">
                    <a class="page-link" href="<?= \App\Helpers\UrlHelper::changeQuery(['page' => $i]) ?>"><?= $i ?></a>
                </li>
            <?php endif; ?>
        <?php endfor; ?>
        <?php if ($page < $totalPages): ?>
            <li class="page-item">
                <a class="page-link" href="<?= \App\Helpers\UrlHelper::changeQuery(['page' => ($page + 1)]) ?>"
                   aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Next</span>
                </a>
            </li>
        <?php endif ?>
    </ul>
</nav>