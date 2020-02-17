<?php $this->title = "Настройки";
$this->addJS("/public/js/settings.js");
?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Список категорий</h4>
            </div>
            <div class="card-body">
                <form data-action="/settings/skills" method="post" data-name="settings-skills">
                    <div class="row">
                        <div class="col-md-12 pr-1">
                            <div class="form-group">
                                <label>Категории</label>
                                <select class="form-control selectpicker" name="skills[]" multiple="multiple">
                                    <?php foreach ($data as $datum): ?>
                                        <option
                                                value="<?= $datum['id'] ?>"
                                            <?php if (in_array($datum['id'], $selected)): ?>
                                                selected="selected"
                                            <?php endif; ?>
                                        >
                                            <?= $datum['name'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-info btn-fill pull-left">Сохранить</button>
                    <button type="button" class="btn btn-success btn-fill pull-left" data-action="parse" style="margin-left: 20px">Импорт</button>
                </form>
            </div>
        </div>
    </div>
</div>