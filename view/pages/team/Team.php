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
                <p>Are you sure you want to delete this participant?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger cancel" data-bs-dismiss="modal"></button>
                <button type="button" class="btn btn-success accept" id="deleteParticipant"></button>
            </div>
        </div>
    </div>
</div>