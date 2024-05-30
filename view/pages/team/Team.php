<?php
    if ($_SESSION['level'] == 0) {
        include "adminTeam.php";
    } else {
        include "teacherTeam.php";
    }
?>

<div class="modal fade" id="editParticipantsModal" tabindex="-1" aria-labelledby="editParticipantsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title editParticipant_btn" id="editParticipantsModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label firstname" for="firstnameParticipant"></label>
                    <input type="text" class="form-control" id="firstnameParticipant">
                </div>
                <div class="form-group">
                    <label class="form-label lastname" for="lastnameParticipant"></label>
                    <input type="text" class="form-control" id="lastnameParticipant">
                </div>
                <div class="form-group">
                    <label class="form-label email" for="emailParticipant"></label>
                    <input type="email" class="form-control" id="emailParticipant">
                    <input type="hidden" class="form-control" id="editParticipant">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger cancel" data-bs-dismiss="modal"></button>
                <button type="button" class="btn btn-success accept" id="updateParticipant"></button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteParticipantsModal" tabindex="-1" aria-labelledby="deleteParticipantsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteParticipantsModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="message_delete_participants"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger cancel" data-bs-dismiss="modal"></button>
                <button type="button" class="btn btn-success accept" id="deleteParticipant"></button>
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