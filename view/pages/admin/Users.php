<div class="conteiner">
    <div class="card">
        <div class="card-header"><div class="header-title d-flex justify-content-between">
            <h4 class="card-title users_list"></h4>
            <button class="btn btn-primary addUser_btn" data-bs-toggle="modal" data-bs-target="#exampleModal">Agregar Usuario</button>
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
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title addUser_btn" id="exampleModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                
                <!-- Botón para descargar plantilla de ejemplo -->
                <div class="form-group mt-3">
                    <button type="button" class="btn btn-primary" id="downloadTemplateButton">Descargar plantilla</button>
                </div>
                <!-- Dropzone para cargar archivos -->
                <div class="col-md-12">
                    <div id="addUsersDropzone" class="dropzone"></div>
                </div>
                <!-- Lista desplegable de proyectos -->
                <div class="form-group mt-3">
                    <label for="projectSelect" class="form-label current_project"></label>
                    <select class="form-select" id="projectSelect">
                        <option value="" selected>Selecciona un proyecto</option>
                        <option value="project1">Proyecto 1</option>
                        <option value="project2">Proyecto 2</option>
                        <option value="project3">Proyecto 3</option>
                        <!-- Agrega más opciones según sea necesario -->
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger cancel" data-bs-dismiss="modal"></button>
                <button type="button" class="btn btn-success accept" id="uploadButton"></button>
            </div>
        </div>
    </div>
</div>
<input type="hidden" id="language" value="<?php echo $_SESSION['language']; ?>">
