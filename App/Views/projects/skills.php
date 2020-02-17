<?php
$this->title = "Проекты";
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card strpied-tabled-with-hover">
                <?= \App\Widgets\ProjectMenu::widget(['active' => "skills"]) ?>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card strpied-tabled-with-hover">
                <div class="card-header ">
                    <h4 class="card-title">Список проектов по категориям</h4>
                    <p class="card-category"><?= $activeSkills ?></p>
                </div>
                <div class="card-body table-full-width table-responsive">
                    <table class="table table-hover table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Категория</th>
                            <th>Кол-тво проектов</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($list as $key => $item): ?>
                            <tr<?php if (in_array($item['id'], $activeSkillsList)): ?> style="background-color: beige;" <?php endif; ?>>
                                <td><?= ($startPosition + ($key + 1)) ?></td>
                                <td><?= $item['name'] ?></td>
                                <td><?= $item['project_count'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <?= \App\Widgets\Pagination::widget([
                'total' => $total,
            ]); ?>
        </div>
    </div>
</div>
