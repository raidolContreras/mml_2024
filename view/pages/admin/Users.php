<div class="conteiner">
    <div class="card">
        <div class="card-header"><div class="header-title d-flex justify-content-between">
            <h4 class="card-title users_list"></h4>
            <div class="dropdown">
                <button class="btn btn-primary addUsersModal" data-bs-toggle="modal" data-bs-target="#addUsersModal"></button>
                <button class="btn btn-secondary dropdown-toggle massiveActions" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"></button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><button class="dropdown-item addUser_btn" data-bs-toggle="modal" data-bs-target="#usersModal"></button></li>
                    <li><a class="dropdown-item deleteUser_btn" data-bs-toggle="modal" data-bs-target="#deleteMassiveModal"></a></li>
                </ul>
            </div>
        </div>

        </div>
        <div class="card-body">
            <table class="table" id="users">
                <thead>
                    <tr>
                        <th>#</th>
                        <th class="name"></th>
                        <th class="email"></th>
                        <th class="project"></th>
                        <th class="team"></th>
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
                    <a type="button" class="btn btn-primary download_template" download="users_template.csv" href="assets/documents/users_template.csv"></a>
                </div>
                <!-- Dropzone para cargar archivos -->
                <div class="col-md-12">
                    <div id="addUsersDropzone" class="dropzone"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger cancel" data-bs-dismiss="modal"></button>
                <button type="button" class="btn btn-success accept" id="sendButton"></button>
            </div>
        </div>
    </div>
</div>

<!-- Delete users -->
<div class="modal fade" id="deleteMassiveModal" tabindex="-1" aria-labelledby="deleteMassiveLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title deleteUser_btn" id="deleteMassiveLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                
                <!-- Botón para descargar plantilla de ejemplo -->
                <div class="form-group mt-3">
                    <a type="button" class="btn btn-primary download_template" download="delete_users_template.csv" href="assets/documents/delete_users_template.csv"></a>
                </div>
                <!-- Dropzone para cargar archivos -->
                <div class="col-md-12">
                    <div id="deleteUsersDropzone" class="dropzone"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger cancel" data-bs-dismiss="modal"></button>
                <button type="button" class="btn btn-success accept" id="DeleteMassiveButton"></button>
            </div>
        </div>
    </div>
</div>

<!-- Add users -->
<div class="modal fade" id="addUsersModal" tabindex="-1" aria-labelledby="addUsersModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title User_btn" id="addUsersModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                
                <div class="row">
                    <div class="col-6">
                        <div class="form-group mt-3">
                            <label for="firstname" class="form-label firstname"></label>
                            <input class="form-control" type="text" id="firstnameAdd">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group mt-3">
                            <label for="lastname" class="form-label lastname"></label>
                            <input class="form-control" type="text" id="lastnameAdd">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group mt-3">
                            <label for="email" class="form-label email"></label>
                            <input class="form-control" type="text" id="emailAdd">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group mt-3">
                            <label for="password" class="form-label password"></label>
                            <input class="form-control" type="password" id="password">
                        </div>
                    </div>
                    <div class="col-6 form-group mt-3">
                        <label for="projectSelect" class="form-label projects"></label>
                        <select class="form-select" id="projectSelectEdit">
                        </select>
                    </div>
                    <div class="col-6 form-group mt-3">
                        <label for="teamSelect" class="form-label teams"></label>
                        <select class="form-select" id="teamSelectEdit" disabled>
                        </select>
                    </div>
                    <div class="col-6 form-group mt-3">
                        <label for="projectLevel" class="form-label level_user"></label>
                        <select class="form-select" id="level_user_edit">
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger cancel" data-bs-dismiss="modal"></button>
                <button type="button" class="btn btn-success accept"></button>
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
                            <input class="form-control firstnameEdit" type="text" id="firstname">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group mt-3">
                            <label for="lastname" class="form-label lastname"></label>
                            <input class="form-control lastnameEdit" type="text" id="lastname">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group mt-3">
                            <label for="email" class="form-label email"></label>
                            <input class="form-control emailEdit" type="text" id="email">
                        </div>
                    </div>
                    <div class="col-6 form-group mt-3">
                        <label for="projectSelectEdit" class="form-label projects"></label>
                        <select class="form-select projectSelectEdit" id="projectSelectEdit">
                        </select>
                    </div>
                    <div class="col-6 form-group mt-3">
                        <label for="teamSelectEdit" class="form-label teams"></label>
                        <select class="form-select teamSelectEdit" disabled>
                        </select>
                    </div>
                    <div class="col-6 form-group mt-3">
                        <label for="projectLevel" class="form-label level_user"></label>
                        <select class="form-select level_user_edit" id="level_user_edit">
                        </select>
                    </div>
                </div>
            </div>
            <input type="hidden" id="editUser">
            <div class="modal-footer">
                <button type="button" class="btn btn-danger cancel" data-bs-dismiss="modal"></button>
                <button type="button" class="btn btn-success acceptEdit"></button>
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