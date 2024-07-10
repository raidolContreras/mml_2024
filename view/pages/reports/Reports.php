<style>    
	.activitySelect, .activityHead {
        display: flex;
        /* margin-left: 0px !important;
        margin-right: 0px !important; */
	}
    
	.col-2, .col-8, .col-3, .col-4, .col-2, .col-1{
		padding: 15px;
        border-right: 2px solid #f5f6fa;
	}

    .col-3:last-child, .col-2:last-child {
        border-right: none;
    }

    /* Si hay otros elementos que no son col-3 y quieres que el último .col-3 no tenga borde */
    .col-3:last-of-type, .col-2:last-of-type {
        border-right: none;
    }

    .col-12  {
        border-bottom: 1px solid #000;
        font-size: 15px;
        padding: 10px 15px;
        text-align: center;
    }

    .col-12:last-child {
        border-bottom: none;
    }

    .totalReports {
        display: none;
    }

    .mr-3 {
        margin-right: .6rem !important;
    }

    .img-fluid {
        border-radius: 10px !important;
    }

    .Comments,
    .CommentsList {
        display: none;
    }

    .comment-item {
        background-color: #fff;
        border-radius: 10px;
        padding: 15px;
        margin-bottom: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .comment-text {
        font-size: 1rem;
        color: #333;
    }

    .comment-actions {
        margin-left: auto;
    }

    .comment-actions .btn {
        margin-left: 10px;
    }

    .comment-actions .btn-success {
        background-color: #28a745;
        border-color: #28a745;
    }

    .comment-actions .btn-danger {
        background-color: #dc3545;
        border-color: #dc3545;
    }
</style>

<div class="row mb-2 teamSelect">
    <div class="col-md-6 offset-md-3">
        <label for="teamSelectEdit" class="form-label teams"></label>
        <select class="form-select" id="teamSelectEdit">
        </select>
    </div>
</div>

<div class="row Comments">
    <div class="float-end mb-3">
        <button class="btn btn-primary mb-4 addComments" id="Comment" data-bs-toggle="modal" data-bs-target="#commetModal" onclick="openComment()"></button>
    </div>
</div>
    
<div class="container totalReports">
    <div class="row">
        <div class="col-12">
            <div class="row head mb-2">
                <div class="activityHead">
                    <div class="col-8 activity"></div>
                    <div class="col-2 goal"></div>
                    <div class="col-2 progress_activity"></div>
                </div>
            </div>
            
            <div class="row row-body">
                <div class="col-12 product01"></div>
                <div class="activitySelect">
                    <div class="col-8 activity01"></div>
                    <div class="col-2 totalGoal01"></div>
                    <div class="col-2 totalProgress01"></div>
                </div>
                <div class="activitySelect">
                    <div class="col-8 activity02"></div>
                    <div class="col-2 totalGoal02"></div>
                    <div class="col-2 totalProgress02"></div>
                </div>
                <div class="activitySelect">
                    <div class="col-8 activity03"></div>
                    <div class="col-2 totalGoal03"></div>
                    <div class="col-2 totalProgress03"></div>
                </div>
                <div class="activitySelect">
                    <div class="col-8 activity04"></div>
                    <div class="col-2 totalGoal04"></div>
                    <div class="col-2 totalProgress04"></div>
                </div>
            </div>
            
            <div class="row row-body">
                <div class="col-12 product02"></div>
                <div class="activitySelect">
                    <div class="col-8 activity05"></div>
                    <div class="col-2 totalGoal05"></div>
                    <div class="col-2 totalProgress05"></div>
                </div>
                <div class="activitySelect">
                    <div class="col-8 activity06"></div>
                    <div class="col-2 totalGoal06"></div>
                    <div class="col-2 totalProgress06"></div>
                </div>
                <div class="activitySelect">
                    <div class="col-8 activity07"></div>
                    <div class="col-2 totalGoal07"></div>
                    <div class="col-2 totalProgress07"></div>
                </div>
                <div class="activitySelect">
                    <div class="col-8 activity08"></div>
                    <div class="col-2 totalGoal08"></div>
                    <div class="col-2 totalProgress08"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="seeReports" tabindex="-1" aria-labelledby="seeReportsLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="seeReportsLabel"></h5>
                <button class="btn btn-primary add_evidence"></button>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body evidenceReports">
			</div>
		</div>
	</div>
    <div class="card" id="chargeEvidence" style="width: 1140px; margin-right: auto; margin-left: auto; display: none;">
        <div class="card-body row">
            <h5 class="card-title col-12 attach_evidence"></h5>
            <div class="form-group col-6 mt-3">
                <label for="description"><span class="description"></span> *</label>
                <input type="text" class="form-control EnterADescription" id="description">
            </div>
            <div class="form-group col-6 mt-3">
                <label for="progress_activity"><span class="progress_activity"></span> *</label>
                <input min="1" type="number" class="form-control EnterProgress" id="progress_activity">
            </div>
            <div class="form-group col-6 mt-3 photos">
                <label for="photos"><span class="title_photos"></span></label>
                <div id="AddPhotosDropzone" class="dropzone"></div>
            </div>
            <div class="form-group col-6 mt-3 reports">
                <label for="reports"><span class="title_reports"></span></label>
                <div id="AddReportsDropzone" class="dropzone"></div>
            </div>
            <div class="form-group col-6 mt-3 attendance">
                <label for="attendance"><span class="title_attendance"></span></label>
                <div id="AddAttendanceDropzone" class="dropzone"></div>
            </div>
            <div class="form-group col-6 mt-3 agreements">
                <label for="agreements"><span class="title_agreements"></span></label>
                <div id="AddAgreementsDropzone" class="dropzone"></div>
            </div>
            <div class="form-group col-6 mt-3 others">
                <label for="others"><span class="title_others"></span></label>
                <div id="AddOthersDropzone" class="dropzone"></div>
            </div>
            <div class="form-group col-12 mt-3 videos">
                <label for="video"><span class="title_video"></span></label>
                <input type="url" class="form-control EnterYouTubeVideoURL" id="video">
            </div>
            <button class="btn btn-success mt-3 accept" onclick="saveEvidence()"></button>
        </div>
    </div>
</div>

<!-- Second Modal -->
<div class="modal fade" id="evidencesModal" tabindex="-1" aria-labelledby="evidencesModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl custom-modal-right">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title Evidence" id="evidencesModalLabel"></h5>
            </div>
            <div class="modal-body evidenceShow">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary return Back" data-bs-dismiss="modal"></button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para editar evidencia -->
<div class="modal fade" id="editEvidenceModal" tabindex="-1" aria-labelledby="editEvidenceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title edit_evidence" id="editEvidenceModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editEvidenceForm">
                    <div class="mb-3">
                        <label for="editDescription" class="form-label description"></label>
                        <input type="text" class="form-control" id="editDescription" required>
                    </div>
                    <div class="mb-3">
                        <label for="editProgress" class="form-label progress_activity"></label>
                        <input type="number" class="form-control" id="editProgress" required>
                    </div>
                    <button type="submit" class="btn btn-primary save_changes"></button>
                </form>
            </div>
        </div>
    </div>
</div>
<input type="hidden" id="totalProgressAccepted">
<input type="hidden" id="lastEditProgress">
<input type="hidden" id="idMatrix">


<?php
    include "view/pages/comments.php";
?>