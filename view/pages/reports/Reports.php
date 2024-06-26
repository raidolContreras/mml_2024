<style>    
	.activitySelect, .activityHead {
        display: flex;
        /* margin-left: 0px !important;
        margin-right: 0px !important; */
	}
    
	.col-2, .col-8, .col-4 {
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

</style>

<div class="row mb-2">
    <div class="col-md-6 offset-md-3">
        <label for="teamSelectEdit" class="form-label teams">Select Team</label>
        <select class="form-select" id="teamSelectEdit">
        </select>
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
                <button class="btn btn-primary addEvidence">Agregar Evidencia</button>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body evidenceReports">
			</div>
		</div>
	</div>
    <div class="card" id="chargeEvidence" style="width: 1140px; margin-right: auto; margin-left: auto; display: none;">
        <div class="card-body row">
            <h5 class="card-title col-12">Adjuntar evidencia</h5>
            <div class="form-group col-12 mt-3">
                <label for="description">Descripción</label>
                <input type="text" class="form-control" id="description" placeholder="Ingrese una descripción">
            </div>
            <div class="form-group col-6 mt-3 photos">
                <label for="photos">Fotos</label>
                <div id="AddPhotosDropzone" class="dropzone"></div>
            </div>
            <div class="form-group col-6 mt-3 videos">
                <label for="video">URL del Video</label>
                <input type="url" class="form-control" id="video" placeholder="Ingrese la URL del video">
            </div>
            <div class="form-group col-6 mt-3 reports">
                <label for="reports">Reportes</label>
                <div id="AddReportsDropzone" class="dropzone"></div>
            </div>
            <div class="form-group col-6 mt-3 attendance">
                <label for="attendance">Lista de Asistencia</label>
                <div id="AddAttendanceDropzone" class="dropzone"></div>
            </div>
            <div class="form-group col-6 mt-3 agreements">
                <label for="agreements">Acuerdos</label>
                <div id="AddAgreementsDropzone" class="dropzone"></div>
            </div>
            <div class="form-group col-6 mt-3 others">
                <label for="others">Otros</label>
                <div id="AddOthersDropzone" class="dropzone"></div>
            </div>
            <div class="form-group col-6 mt-3">
                <label for="progress_activity">Progreso de la Actividad</label>
                <input min="0" type="number" class="form-control" id="progress_activity" placeholder="Ingrese el progreso">
            </div>
            <button class="btn btn-success mt-3" onclick="saveEvidence()">Guardar Evidencia</button>
        </div>
    </div>
</div>

<!-- Second Modal -->
<div class="modal fade" id="evidencesModal" tabindex="-1" aria-labelledby="evidencesModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl custom-modal-right">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="evidencesModalLabel">Evidence Modal</h5>
            </div>
            <div class="modal-body">
                <p>This is the evidence modal content.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Regresar</button>
            </div>
        </div>
    </div>
</div>