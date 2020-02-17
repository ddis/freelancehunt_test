<div class="modal" tabindex="-1" role="dialog" data-modal-name="install" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Установка системы</h5>
            </div>
            <div class="modal-body">
                <form method="POST" data-action="/install/init"
                      data-name="API-key-form">
                    <div class="form-group">
                        <label for="field-API-key">API key</label>
                        <input type="email" class="form-control" id="field-API-key" aria-describedby="emailHelp"
                               placeholder="Укажите API key" name="api-key">
                        <small class="form-text text-muted">Получить ключ можно по <a
                                    href="https://freelancehunt.com/my/api" target="_blank">ссылке</a></small>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label>Доступ к базе данных</label>
                        <input type="text" class="form-control" placeholder="Укажите Host" name="db[host]"
                               value="localhost">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Укажите имя базы данныз"
                               name="db[database]">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Укажите имя пользователя базы данных"
                               name="db[user]">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Укажите пароль базы данныз"
                               name="db[password]">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info btn-fill pull-right">Сохранить</button>
                <img src="/public/img/save.gif" class="" style="max-width: 100px; display: none">
            </div>
        </div>
    </div>
</div>