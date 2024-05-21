<div class="container mt-4">
    <div class="row mt-3">
        <div class="col-md-6 offset-md-1">
            <div class="card">
                <div class="card-header pb-3">
                    <h5 class="card-title">Team Information</h5>
                    <div class="row d-flex align-items-center">
                        <p class="card-text col-11 mb-0">Details about the selected team.</p>
                        <button class="col-1 btn btn-primary btn-sm edit-button">
                            <i class="fas fa-edit"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-6 text-right font-weight-bold">Mentor:</div>
                        <div class="col-6" id="mentorName"></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6 text-right font-weight-bold">Mentor Email:</div>
                        <div class="col-6" id="mentorEmail"></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6 text-right font-weight-bold">Team:</div>
                        <div class="col-6" id="teamName"></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6 text-right font-weight-bold">School:</div>
                        <div class="col-6" id="teamSchool"></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6 text-right font-weight-bold">State:</div>
                        <div class="col-6" id="teamState"></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6 text-right font-weight-bold">Identified Problem:</div>
                        <div class="col-6" id="identifiedProblem"></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6 text-right font-weight-bold">Main Objective:</div>
                        <div class="col-6" id="mainObjective"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center pb-3">
                    <h5 class="card-title mb-0 participants"></h5>
                    <button class="btn btn-primary" id="addParticipantBtn"><i class="fas fa-plus"></i> Add Participant</button>
                </div>
                <div class="card-body" id="participantsList">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add users -->
<div class="modal fade" id="participantsModal" tabindex="-1" aria-labelledby="participantsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title addParticipant_btn" id="participantsModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Botón para descargar plantilla de ejemplo -->
                <div class="form-group mt-3">
                    <a type="button" class="btn btn-primary download_template" download="pacients_template.csv" href="assets/documents/pacients_template.csv"></a>
                </div>
                <!-- Dropzone para cargar archivos -->
                <div class="col-md-12">
                    <div id="addParticipantsDropzone" class="dropzone"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger cancel" data-bs-dismiss="modal"></button>
                <button type="button" class="btn btn-success accept" id="sendButton"></button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editTeamModal" tabindex="-1" aria-labelledby="editTeamModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title editParticipant_btn" id="editTeamModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label" for="state">State</label>
                    <input type="text" class="form-control" id="state">
                </div>
                <div class="form-group">
                    <label class="form-label" for="identifiedProbleminput">Identified Problem</label>
                    <input type="text" class="form-control" id="identifiedProbleminput">
                </div>
                <div class="form-group">
                    <label class="form-label" for="mainObjective">Main Objective</label>
                    <input type="text" class="form-control" id="mainObjectiveinput">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger cancel" data-bs-dismiss="modal"></button>
                <button type="button" class="btn btn-success accept" id="updateTeam"></button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editParticipantsModal" tabindex="-1" aria-labelledby="editParticipantsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title editParticipant_btn" id="editParticipantsModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label" for="firstnameParticipant">FirstName</label>
                    <input type="text" class="form-control" id="firstnameParticipant">
                </div>
                <div class="form-group">
                    <label class="form-label" for="lastnameParticipant">LastName</label>
                    <input type="text" class="form-control" id="lastnameParticipant">
                </div>
                <div class="form-group">
                    <label class="form-label" for="emailParticipant">Email</label>
                    <input type="email" class="form-control" id="emailParticipant">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger cancel" data-bs-dismiss="modal"></button>
                <button type="button" class="btn btn-success accept" id="updateParticipant"></button>
            </div>
        </div>
    </div>
</div>



<style>
    .card {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
    }
    .card-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid #dee2e6;
        min-height: 20%;
    }
    .card-title {
        margin-bottom: 0;
    }
    .form-select {
        width: 100%;
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #ced4da;
    }
    .form-label {
        font-weight: bold;
    }
    .font-weight-bold {
        font-weight: bold;
    }
    .participant {
        border-bottom: 1px solid #dee2e6;
        padding-bottom: 10px;
    }
    .participant:last-child {
        border-bottom: none;
    }
    
    .align-center {
        display: flex;
        align-items: center;
    }
</style>