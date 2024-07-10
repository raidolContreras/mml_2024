<style>
	.row {
		margin-bottom: 7px;
		margin-top: 7px;
		display: flex;
		align-items: center;
	}

	.col, .col-2 {
		padding: 15px;
	}

	.col-body {
		font-size: 14px;
	}

	select.form-select {
		width: 100%;
		padding: 10px;
		border-radius: 8px;
		border: 1px solid #ced4da;
		box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
	}

	.matrix {
		display: none;
	}

	.col-xs {
		-webkit-box-flex: 0.2;
    	flex: 0.2 0 0%;
	}
	
	.CommentsList,
    .Comments {
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
<div class="row mb-4 teamSelect">
	<div class="col-md-6 offset-md-3">
		<label for="teamSelectEdit" class="form-label teams"></label>
		<select class="form-select" id="teamSelectEdit"></select>
	</div>
</div>

<div class="row Comments">
	<div class="float-end mb-3">
		<button class="btn btn-primary mb-4" id="Comment" data-bs-toggle="modal" data-bs-target="#commetModal" onclick="openComment()">Agregar Comentario</button>
	</div>
</div>
<div class="container matrix">
	<div class="row head">
		<div class="col-2 product"></div>
		<div class="col-10">
			<div class="row">
				<div class="col-2 activity"></div>
				<div class="col-2 narrative_summary"></div>
				<div class="col indicator"></div>
				<div class="col-xs goal"></div>
				<div class="col-1 verification_sources"></div>
				<div class="col risks"></div>
				<div class="col-1 start_date"></div>
				<div class="col-1 term_date"></div>
			</div>
		</div>
	</div>
	<div class="row row-body">
		<div class="col-2 p-3 product01"></div>
		<div class="col-10">
			<div class="row activitySelect" onclick="editMatriz(1)">
				<div class="col-2 activity01"></div>
				<div class="col-2 col-body" id="narrative-summary-1"></div>
				<div class="col col-body" id="indicator-1"></div>
				<div class="col-xs col-body" id="goal-1"></div>
				<div class="col-1 col-body" id="verification-sources-1"></div>
				<div class="col col-body" id="risk-1"></div>
				<div class="col-1 col-body" style="text-align: center;" id="init-date-1"></div>
				<div class="col-1 col-body" id="end-date-1"></div>
			</div>
			<div class="row activitySelect" onclick="editMatriz(2)">
				<div class="col-2 activity02"></div>
				<div class="col-2 col-body" id="narrative-summary-2"></div>
				<div class="col col-body" id="indicator-2"></div>
				<div class="col-xs col-body" id="goal-2"></div>
				<div class="col-1 col-body" id="verification-sources-2"></div>
				<div class="col col-body" id="risk-2"></div>
				<div class="col-1 col-body" style="text-align: center;" id="init-date-2"></div>
				<div class="col-1 col-body" id="end-date-2"></div>
			</div>
			<div class="row activitySelect" onclick="editMatriz(3)">
				<div class="col-2 activity03"></div>
				<div class="col-2 col-body" id="narrative-summary-3"></div>
				<div class="col col-body" id="indicator-3"></div>
				<div class="col-xs col-body" id="goal-3"></div>
				<div class="col-1 col-body" id="verification-sources-3"></div>
				<div class="col col-body" id="risk-3"></div>
				<div class="col-1 col-body" style="text-align: center;" id="init-date-3"></div>
				<div class="col-1 col-body" id="end-date-3"></div>
			</div>
			<div class="row activitySelect" onclick="editMatriz(4)">
				<div class="col-2 activity04"></div>
				<div class="col-2 col-body" id="narrative-summary-4"></div>
				<div class="col col-body" id="indicator-4"></div>
				<div class="col-xs col-body" id="goal-4"></div>
				<div class="col-1 col-body" id="verification-sources-4"></div>
				<div class="col col-body" id="risk-4"></div>
				<div class="col-1 col-body" style="text-align: center;" id="init-date-4"></div>
				<div class="col-1 col-body" id="end-date-4"></div>
			</div>
		</div>
	</div>
	<div class="row row-body">
		<div class="col-2 p-3 product02"></div>
		<div class="col-10">
			<div class="row activitySelect" onclick="editMatriz(5)">
				<div class="col-2 activity05"></div>
				<div class="col-2 col-body" id="narrative-summary-5"></div>
				<div class="col col-body" id="indicator-5"></div>
				<div class="col-xs col-body" id="goal-5"></div>
				<div class="col-1 col-body" id="verification-sources-5"></div>
				<div class="col col-body" id="risk-5"></div>
				<div class="col-1 col-body" style="text-align: center;" id="init-date-5"></div>
				<div class="col-1 col-body" id="end-date-5"></div>
			</div>
			<div class="row activitySelect" onclick="editMatriz(6)">
				<div class="col-2 activity06"></div>
				<div class="col-2 col-body" id="narrative-summary-6"></div>
				<div class="col col-body" id="indicator-6"></div>
				<div class="col-xs col-body" id="goal-6"></div>
				<div class="col-1 col-body" id="verification-sources-6"></div>
				<div class="col col-body" id="risk-6"></div>
				<div class="col-1 col-body" style="text-align: center;" id="init-date-6"></div>
				<div class="col-1 col-body" id="end-date-6"></div>
			</div>
			<div class="row activitySelect" onclick="editMatriz(7)">
				<div class="col-2 activity07"></div>
				<div class="col-2 col-body" id="narrative-summary-7"></div>
				<div class="col col-body" id="indicator-7"></div>
				<div class="col-xs col-body" id="goal-7"></div>
				<div class="col-1 col-body" id="verification-sources-7"></div>
				<div class="col col-body" id="risk-7"></div>
				<div class="col-1 col-body" style="text-align: center;" id="init-date-7"></div>
				<div class="col-1 col-body" id="end-date-7"></div>
			</div>
			<div class="row activitySelect" onclick="editMatriz(8)">
				<div class="col-2 activity08"></div>
				<div class="col-2 col-body" id="narrative-summary-8"></div>
				<div class="col col-body" id="indicator-8"></div>
				<div class="col-xs col-body" id="goal-8"></div>
				<div class="col-1 col-body" id="verification-sources-8"></div>
				<div class="col col-body" id="risk-8"></div>
				<div class="col-1 col-body" style="text-align: center;" id="init-date-8"></div>
				<div class="col-1 col-body" id="end-date-8"></div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="editMatriz" tabindex="-1" aria-labelledby="editMatrizLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="editMatrizLabel"></h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form id="form-matrix">
					<div class="mb-3">
						<label for="description" class="form-label" id="description_activity"></label>
						<textarea class="form-control" id="description" rows="2"></textarea>
					</div>
					<div class="row">
						<div class="mb-3 col-6">
							<label for="startDate" class="form-label" id="start_date_activity"></label>
							<input type="date" class="form-control" id="startDate">
						</div>
						<div class="mb-3 col-6">
							<label for="endDate" class="form-label" id="end_date_activity"></label>
							<input type="date" class="form-control" id="endDate">
						</div>
					</div>
					<div class="mb-3">
						<label for="frequency" class="form-label" id="frequency_activity"></label>
						<select class="form-select" id="frequency">
						</select>
					</div>
					<div class="mb-3 row">
						<div class="col" id="Number_of"></div>
						<input type="text" class="col form-control" id="indicator_activity" >
						<div class="col" id="that"></div>
						<input type="text" class="col form-control" id="how">
					</div>
					<div class="mb-3 ">
						<div class="col" id="What_goal"></div>
						<input type="number" class="col form-control" id="What_goal_activity" >
					</div>
					<div class="mb-3">
						<label class="form-label" id="evidenceTypeLabel"></label>
						<div class="btn-group w-100" role="group">
							<input type="checkbox" class="btn-check" id="photos" autocomplete="off">
							<label class="btn btn-outline-primary" id="Photos" for="photos"></label>

							<input type="checkbox" class="btn-check" id="videos" autocomplete="off">
							<label class="btn btn-outline-primary" id="Videos" for="videos"></label>

							<input type="checkbox" class="btn-check" id="reports_input" autocomplete="off">
							<label class="btn btn-outline-primary" id="Reports_input" for="reports_input"></label>

							<input type="checkbox" class="btn-check" id="attendance" autocomplete="off">
							<label class="btn btn-outline-primary" id="Attendance_lists" for="attendance"></label>

							<input type="checkbox" class="btn-check" id="agreements" autocomplete="off">
							<label class="btn btn-outline-primary" id="Agreements" for="agreements"></label>

							<input type="checkbox" class="btn-check" id="others" autocomplete="off">
							<label class="btn btn-outline-primary" id="Others" for="others"></label>
						</div>
					</div>
					<div class="mb-3">
						<label for="risks" class="form-label" id="risk_activity"></label>
						<textarea class="form-control" id="risks" rows="2"></textarea>
					</div>
					<input type="hidden" id="idMatrix">
					<input type="hidden" id="idStructure">
					<input type="hidden" id="activityNumber">
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger cancel" data-bs-dismiss="modal"></button>
				<button type="button" class="btn btn-success accept sendMatrix"></button>
			</div>
		</div>
	</div>
</div>

<?php
    include "view/pages/comments.php";
?>