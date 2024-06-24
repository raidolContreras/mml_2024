<style>    
	.row {
		margin-top: 7px;
	}

	.activitySelect {
        margin-bottom: 7px;
        margin-left: 0px !important;
        margin-right: 0px !important;
	}
    
	.col-2, .col-8, .col-3 {
		padding: 15px;
	}
    
    .col-12  {
        border-bottom: 1px solid #000;
        font-size: 20px;
        padding: 10px 15px;
        text-align: center;
    }
    .ml-1 {
        margin-left: .25rem !important;
    }
    .mr-1 {
        margin-right: .25rem !important;
    }
</style>

<div class="row mb-4">
    <div class="col-md-6 offset-md-3">
        <label for="teamSelectEdit" class="form-label teams">Select Team</label>
        <select class="form-select" id="teamSelectEdit">
        </select>
    </div>
</div>
    
<div class="container">
    <div class="row">
        <div class="col-6">
            <div class="row head mr-1">
                <div class="col-8 activity"></div>
                <div class="col-2 goal"></div>
                <div class="col-2 progress_activity"></div>
            </div>
            
            <div class="row row-body mr-1">
                <div class="col-12">Product</div>
                <div class="row activitySelect" onclick="editMatriz(1)">
                    <div class="col-8">Example</div>
                    <div class="col-2">Example</div>
                    <div class="col-2">Example</div>
                </div>
                <div class="row activitySelect" onclick="editMatriz(1)">
                    <div class="col-8">Example</div>
                    <div class="col-2">Example</div>
                    <div class="col-2">Example</div>
                </div>
                <div class="row activitySelect" onclick="editMatriz(1)">
                    <div class="col-8">Example</div>
                    <div class="col-2">Example</div>
                    <div class="col-2">Example</div>
                </div>
                <div class="row activitySelect" onclick="editMatriz(1)">
                    <div class="col-8">Example</div>
                    <div class="col-2">Example</div>
                    <div class="col-2">Example</div>
                </div>
            </div>
            
            <div class="row row-body mr-1">
            <div class="col-12">Product</div>
                <div class="row activitySelect" onclick="editMatriz(1)">
                    <div class="col-8">Example</div>
                    <div class="col-2">Example</div>
                    <div class="col-2">Example</div>
                </div>
                <div class="row activitySelect" onclick="editMatriz(1)">
                    <div class="col-8">Example</div>
                    <div class="col-2">Example</div>
                    <div class="col-2">Example</div>
                </div>
                <div class="row activitySelect" onclick="editMatriz(1)">
                    <div class="col-8">Example</div>
                    <div class="col-2">Example</div>
                    <div class="col-2">Example</div>
                </div>
                <div class="row activitySelect" onclick="editMatriz(1)">
                    <div class="col-8">Example</div>
                    <div class="col-2">Example</div>
                    <div class="col-2">Example</div>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="row head ml-1">
                <div class="col-3 description"></div>
                <div class="col-3 progress_activity"></div>
                <div class="col-3 evidences"></div>
                <div class="col-3 actions"></div>
            </div>
            
            <div class="row row-body ml-1">

            </div>
        </div>
    </div>
</div>