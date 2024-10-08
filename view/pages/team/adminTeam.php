<div class="container mt-4">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <label for="teamSelectEdit" class="form-label teams">Select Team</label>
            <select class="form-select" id="teamSelectEdit">
            </select>
        </div>
    </div>
    <div class="row mt-3 details-teams ">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header pb-3">
                    <h5 class="card-title team_information"></h5>
                    <div class="row d-flex align-items-center">
                        <p class="card-text col-11 mb-0 details_team_text"></p>
                        <button class="col-1 btn btn-primary btn-sm edit-button">
                            <i class="fas fa-edit"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-6 text-right font-weight-bold mentor"></div>
                        <div class="col-6" id="mentorName"></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6 text-right font-weight-bold email"></div>
                        <div class="col-6" id="mentorEmail"></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6 text-right font-weight-bold team"></div>
                        <div class="col-6" id="teamName"></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6 text-right font-weight-bold school"></div>
                        <div class="col-6" id="schoolName"></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6 text-right font-weight-bold state"></div>
                        <div class="col-6" id="teamState"></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6 text-right font-weight-bold identifed_problem"></div>
                        <div class="col-6" id="identifiedProblem"></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6 text-right font-weight-bold main_objetive"></div>
                        <div class="col-6" id="mainObjective"></div>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" id="idTeamSelect">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center pb-3">
                    <h6 class="card-title mb-0 participants"></h6>
                    <button class="btn btn-primary" id="addParticipantBtn"></button>
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

<style>
    .card {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
    }
    .card-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid #dee2e6;
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
</style>