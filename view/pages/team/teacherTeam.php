<div class="container mt-4">
    <div class="row mt-3">
        <div class="col-md-6 offset-md-1">
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
                        <div class="col-6" id="teamSchool"></div>
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
        <div class="col-md-4">
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