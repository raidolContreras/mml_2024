<div class="conteiner">
    <div class="card">
        <div class="card-header">
            <div class="header-title d-flex justify-content-between">
                <h4 class="card-title team_list"></h4>
                <button class="btn btn-primary addTeam_btn" data-bs-toggle="modal" data-bs-target="#teamModal"></button>
            </div>
        </div>
        <div class="card-body">
            <table class="table" id="teams">
                <thead>
                    <tr>
                        <th class="teamName"></th>
                        <th class="description"></th>
                        <th class="school"></th>
                        <th class="actions"></th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
<!-- Add teams -->
<div class="modal fade" id="teamModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title addTeam_btn" id="exampleModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                
                <div class="form-group mt-3">
                    <label for="projectName" class="form-label teamName"></label>
                    <input type="text" class="form-control" id="teamName">
                </div>
                <div class="form-group mt-3">
                    <label for="projectName" class="form-label description"></label>
                    <input type="text" class="form-control" id="description">
                </div>
                <div class="form-group mt-3">
                    <label for="projectName" class="form-label school"></label>
                    <input type="text" class="form-control" id="school">
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
