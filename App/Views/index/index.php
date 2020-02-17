<?php $this->title = "Welcome"; ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Новые проекты</h4>
                </div>
                <div class="card-body table-full-width table-responsive">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-hover table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Имя проекта</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($projectList as $item): ?>
                                    <tr>
                                        <td><?= $item['id'] ?></td>
                                        <td>
                                            <a href="<?= $item['link_web'] ?>" target="_blank"><?= $item['name'] ?></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                            <div class="col-md-12">
                                <a href="/projects" class="btn btn-info btn-fill">Все проекты</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Топ категорий</h4>
                </div>
                <div class="card-body table-full-width table-responsive">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-hover table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Категория</th>
                                    <th>Кол-во проектов</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($topSkills as $index => $item): ?>
                                    <tr>
                                        <td><?= ($index + 1) ?></td>
                                        <td>
                                            <?=$item['name']?>
                                        </td>
                                        <td>
                                            <?=$item['total']?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                            <div class="col-md-12">
                                <a href="/projects/skills" class="btn btn-info btn-fill">Все категории</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>