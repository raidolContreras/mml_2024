<div class="conteiner">
    <div class="card">
        <div class="card-header"><div class="header-title d-flex justify-content-between">
            <h4 class="card-title users_list"></h4>
            <button class="btn btn-primary addUser_btn" data-bs-toggle="modal" data-bs-target="#usersModal">Agregar Usuario</button>
        </div>

        </div>
        <div class="card-body">
            <table class="table" id="users">
                <thead>
                    <tr>
                        <th class="name"></th>
                        <th class="email"></th>
                        <th class="project"></th>
                        <th class="user_type"></th>
                        <th class="actions"></th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<!-- Add users -->
<div class="modal fade" id="usersModal" tabindex="-1" aria-labelledby="usersModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title addUser_btn" id="usersModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                
                <!-- Botón para descargar plantilla de ejemplo -->
                <div class="form-group mt-3">
                    <a type="button" class="btn btn-primary" download="" href="assets/documents/users_template.csv">Descargar plantilla</a>
                </div>
                <!-- Dropzone para cargar archivos -->
                <div class="col-md-12">
                    <div id="addUsersDropzone" class="dropzone"></div>
                </div>
                <!-- Lista desplegable de proyectos -->
                <div class="row">
                    <div class="col-6 form-group mt-3">
                        <label for="projectSelect" class="form-label current_project"></label>
                        <select class="form-select" id="projectSelect">
                        </select>
                    </div>
                    <div class="col-6 form-group mt-3">
                        <label for="projectLevel" class="form-label level_user"></label>
                        <select class="form-select" id="level_user">
                            <option value="">Selecciona el nivel</option>
                            <option value="0">Administrador</option>
                            <option value="1">Estándar</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger cancel" data-bs-dismiss="modal"></button>
                <button type="button" class="btn btn-success accept" id="sendButton"></button>
            </div>
        </div>
    </div>
</div>
