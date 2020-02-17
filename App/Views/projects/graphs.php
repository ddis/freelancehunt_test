<?php
$this->title = "Проекты";
$this->addJs("https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js");
$this->addJs("/public/js/chart.js");
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card strpied-tabled-with-hover">
                <?=\App\Widgets\ProjectMenu::widget(['active' => "graphs"])?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Кол-во проектов по ценам</h4>
                </div>
                <div class="card-body">
                    <canvas id="chartByPrice" width="200" height="200"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Топ 5 категорий</h4>
                </div>
                <div class="card-body">
                    <canvas id="chartBySkills" width="200" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>