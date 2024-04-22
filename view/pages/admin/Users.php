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
                    <a type="button" class="btn btn-primary download_template" download="" href="assets/documents/users_template.csv"></a>
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

<!-- Edit users -->
<div class="modal fade" id="editUsersModal" tabindex="-1" aria-labelledby="editUsersModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title editUser_btn" id="editUsersModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                
                <div class="row">
                    <div class="col-6">
                        <div class="form-group mt-3">
                            <label for="firstname" class="form-label firstname"></label>
                            <input class="form-control" type="text" id="firstname">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group mt-3">
                            <label for="lastname" class="form-label lastname"></label>
                            <input class="form-control" type="text" id="lastname">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group mt-3">
                            <label for="email" class="form-label email"></label>
                            <input class="form-control" type="text" id="email">
                        </div>
                    </div>
                    <div class="col-6 form-group mt-3">
                        <label for="projectSelectEdit" class="form-label projects"></label>
                        <select class="form-select" id="projectSelectEdit">
                        </select>
                    </div>
                    <div class="col-6 form-group mt-3">
                        <label for="projectLevel" class="form-label level_user"></label>
                        <select class="form-select" id="level_user_edit">
                        </select>
                    </div>
                </div>
            </div>
            <input type="hidden" id="editUser">
            <div class="modal-footer">
                <button type="button" class="btn btn-danger cancel" data-bs-dismiss="modal"></button>
                <button type="button" class="btn btn-success acceptEdit" id="sendButton"></button>
            </div>
        </div>
    </div>
</div>


<!-- Delete users -->
<div class="modal fade" id="deleteUsersModal" tabindex="-1" aria-labelledby="deleteUsersModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title alert-message" id="deleteUsersModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                
                <div class="deleteMessage">

                </div>
            </div>
            <input type="hidden" id="deleteUser">
            <div class="modal-footer">
                <button type="button" class="btn btn-danger cancel" data-bs-dismiss="modal"></button>
                <button type="button" class="btn btn-success acceptDelete" id="sendButton"></button>
            </div>
        </div>
    </div>
</div>