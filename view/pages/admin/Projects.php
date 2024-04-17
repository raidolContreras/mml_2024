<div class="conteiner">
    <div class="card">
        <div class="card-header">
            <div class="header-title d-flex justify-content-between">
                <h4 class="card-title project_list"></h4>
                <button class="btn btn-primary addProject_btn" data-bs-toggle="modal" data-bs-target="#projectModal"></button>
            </div>
        </div>
        <div class="card-body">
            <table class="table" id="projects">
                <thead>
                    <tr>
                        <th class="projectName"></th>
                        <th class="projectLink"></th>
                        <th class="projectColor"></th>
                        <th class="projectLogo"></th>
                        <th class="actions"></th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<!-- Add projects -->
<div class="modal fade" id="projectModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title addProject_btn" id="exampleModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Nombre del proyecto -->
                <div class="form-group mt-3">
                    <label for="projectName" class="form-label projectName"></label>
                    <input type="text" class="form-control" id="projectName">
                </div>
                <!-- Link del proyecto -->
                <div class="form-group mt-3">
                    <label for="projectLink" class="form-label projectLink"></label>
                    <input type="text" class="form-control" id="projectLink">
                </div>
                <!-- Color del menu superior -->
                <div class="col-6">
                    <label for="menuColor" class="form-label projectColor"></label>
                    <input type="text" class="form-control col-9" id="projectColor" value="#000000"  data-coloris>
                </div>
                <!-- Logo del proyecto (Dropzone) -->
                <div class="form-group mt-3">
                    <label for="projectLogo" class="form-label projectLogo"></label>
                    <div id="projectLogoDropzone" class="dropzone"></div>
                    <input type="hidden" id="projectLogo" name="projectLogo" />
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger cancel" data-bs-dismiss="modal"></button>
                <button type="button" class="btn btn-success accept" id="uploadButton"></button>
            </div>
        </div>
    </div>
</div>
