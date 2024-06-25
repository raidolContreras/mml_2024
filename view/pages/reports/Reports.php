<style>    
	.activitySelect, .activityHead {
        display: flex;
        /* margin-left: 0px !important;
        margin-right: 0px !important; */
	}
    
	.col-2, .col-8, .col-3 {
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

</style>

<div class="row mb-2">
    <div class="col-md-6 offset-md-3">
        <label for="teamSelectEdit" class="form-label teams">Select Team</label>
        <select class="form-select" id="teamSelectEdit">
        </select>
    </div>
</div>
    
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="row head mr-1 mb-2">
                <div class="activityHead">
                    <div class="col-8 activity"></div>
                    <div class="col-2 goal"></div>
                    <div class="col-2 progress_activity"></div>
                </div>
            </div>
            
            <div class="row row-body mr-1">
                <div class="col-12">Product</div>
                <div class="activitySelect" onclick="seeReports(1)">
                    <div class="col-8">Example</div>
                    <div class="col-2">Example</div>
                    <div class="col-2">Example</div>
                </div>
                <div class="activitySelect" onclick="seeReports(1)">
                    <div class="col-8">Example</div>
                    <div class="col-2">Example</div>
                    <div class="col-2">Example</div>
                </div>
                <div class="activitySelect" onclick="seeReports(1)">
                    <div class="col-8">Example</div>
                    <div class="col-2">Example</div>
                    <div class="col-2">Example</div>
                </div>
                <div class="activitySelect" onclick="seeReports(1)">
                    <div class="col-8">Example</div>
                    <div class="col-2">Example</div>
                    <div class="col-2">Example</div>
                </div>
            </div>
            
            <div class="row row-body mr-1">
                <div class="col-12">Product</div>
                <div class="activitySelect" onclick="seeReports(1)">
                    <div class="col-8">Example</div>
                    <div class="col-2">Example</div>
                    <div class="col-2">Example</div>
                </div>
                <div class="activitySelect" onclick="seeReports(1)">
                    <div class="col-8">Example</div>
                    <div class="col-2">Example</div>
                    <div class="col-2">Example</div>
                </div>
                <div class="activitySelect" onclick="seeReports(1)">
                    <div class="col-8">Example</div>
                    <div class="col-2">Example</div>
                    <div class="col-2">Example</div>
                </div>
                <div class="activitySelect" onclick="seeReports(1)">
                    <div class="col-8">Example</div>
                    <div class="col-2">Example</div>
                    <div class="col-2">Example</div>
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
                <button class="btn btn-primary" onclick="chargeEvidences(1)">Agregar Evidencia</button>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
                <div class="row head mb-2">
                    <div class="col-3 description"></div>
                    <div class="col-3 progress_activity"></div>
                    <div class="col-3 evidences"></div>
                    <div class="col-3 actions"></div>
                </div>
                
                <div class="row row-body ml-1">
                    <div class="col-3">Example</div>
                    <div class="col-3">Example</div>
                    <div class="col-3" onclick="evidences(1)">Example</div>
                    <div class="col-3"></div>
                </div>
                <div class="row row-body ml-1">
                    <div class="col-3">Example</div>
                    <div class="col-3">Example</div>
                    <div class="col-3">Example</div>
                    <div class="col-3">
                        <button class="btn btn-primary">Agregar Evidencia</button>
                    </div>
                </div>
			</div>
		</div>
	</div>
    <div class="card fade" style="width: 1140px; margin-right: auto; margin-left: auto;">
        <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
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
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="seeReports(1)">Regresar</button>
            </div>
        </div>
    </div>
</div>