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
                        <th>#</th>
                        <th width="15%" class="teamName"></th>
                        <th class="description"></th>
                        <th class="school"></th>
                        <th class="projects"></th>
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
            <form class="modal-body row">
                
                <div class="col-6 form-group mt-3">
                    <label for="projectName" class="form-label"><span class="teamName"></span>*</label>
                    <input type="text" class="form-control" id="teamName" name="teamName" required>
                </div>
                <div class="col-6 form-group mt-3">
                    <label for="projectName" class="form-label "><span class="description"></span>*</label>
                    <input type="text" class="form-control" id="description" name="description" required>
                </div>
                <div class="col-6 form-group mt-3">
                    <label for="projectName" class="form-label"><span class="school"></span>*</label>
                    <input type="text" class="form-control" id="school" name="school" required>
                </div>

                <div class="col-6 form-group mt-3">
                    <label for="projectSelectEdit" class="form-label projects"></label>
                    <select class="form-select" id="projectSelectEdit">
                    </select>
                </div>

            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger cancel" data-bs-dismiss="modal"></button>
                <button type="button" class="btn btn-success accept" id="sendButton"></button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="teamModalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title editTeam_btn" id="exampleModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="modal-body row">
                
                <div class="col-6 form-group mt-3">
                    <label for="teamNameEdit" class="form-label"><span class="teamName"></span>*</label>
                    <input type="text" class="form-control" id="teamNameEdit" name="teamNameEdit" required>
                </div>
                <div class="col-6 form-group mt-3">
                    <label for="descriptionEdit" class="form-label "><span class="description"></span>*</label>
                    <input type="text" class="form-control" id="descriptionEdit" name="descriptionEdit" required>
                </div>
                <div class="col-6 form-group mt-3">
                    <label for="schoolEdit" class="form-label"><span class="school"></span>*</label>
                    <input type="text" class="form-control" id="schoolEdit" name="schoolEdit" required>
                </div>
                
                <div class="col-6 form-group mt-3">
                    <label for="projectSelectEdit" class="form-label projects"></label>
                    <select class="form-select projectSelectEdit" id="projectSelectEdit">
                    </select>
                </div>
                
                <input type="hidden" id="editTeam">
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger cancel" data-bs-dismiss="modal"></button>
                <button type="button" class="btn btn-success accept" id="acceptButton"></button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="teamModalDelete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title alert-message" id="exampleModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="modal-body">
                
                <div class="deleteMessage">

                </div>
            </form>
            <input type="hidden" id="deleteTeam">

            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger cancel" data-bs-dismiss="modal"></button>
                <button type="button" class="btn btn-success accept" id="deleteButton"></button>
            </div>
        </div>
    </div>
</div>