<?php
$this->title = "Проекты";
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card strpied-tabled-with-hover">
                <?=\App\Widgets\ProjectMenu::widget(['active' => "project"])?>
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
                            <th>Имя проекта</th>
                            <th>Буджет (оригинал)</th>
                            <th>Буджет (в ГРН)</th>
                            <th>Имя заказчика</th>
                            <th>Логин заказчика</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($projectList as $list): ?>
                            <tr>
                                <td><?= $list['id'] ?></td>
                                <td>
                                    <a href="<?= $list['link_web'] ?>" target="_blank"><?= $list['name'] ?></a>
                                </td>
                                <td>
                                    <?= $list['budget_amount'] ?> <?= $list['budget_currency'] ?>
                                </td>
                                <td>
                                    <?= $list['budget_in_UAH'] ?> <?php if ($list['budget_in_UAH']): ?>UAH<?php endif; ?>
                                </td>
                                <td>
                                    <?= $list['first_name'] ?> <?= $list['last_name'] ?>
                                </td>
                                <td>
                                    <?= $list['login'] ?>
                                </td>
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
