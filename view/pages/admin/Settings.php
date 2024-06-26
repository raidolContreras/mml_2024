<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/mdbassit/Coloris@latest/dist/coloris.min.css"/>
<script src="https://cdn.jsdelivr.net/gh/mdbassit/Coloris@latest/dist/coloris.min.js"></script>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <label for="projectSelect" class="form-label current_project"></label>
            <select class="form-select" id="projectActive">
            </select>
            
            <label class="form-label mt-3 color_settings"></label>
            <form id=""></form>
            <div class="row">
                <div class="col-6 problemDiv">
                    <label for="problemColor" class="form-label col-3 problem"></label>
                    <input type="text" class="form-control col-9" id="problemColor" data-coloris>
                </div>
                <div class="col-6 effectDiv">
                    <label for="effectColor" class="form-label col-3 effect"></label>
                    <input type="text" class="form-control col-9" id="effectColor" data-coloris>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-6 causeDiv">
                    <label for="causeColor" class="form-label col-3 cause"></label>
                    <input type="text" class="form-control col-9" id="causeColor" data-coloris>
                </div>
                <div class="col-6 objetiveDiv">
                    <label for="objectiveColor" class="form-label col-3 objetive"></label>
                    <input type="text" class="form-control col-9" id="objectiveColor" data-coloris>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-6 resutDiv">
                    <label for="resultColor" class="form-label col-3 result"></label>
                    <input type="text" class="form-control col-9" id="resultColor" data-coloris>
                </div>
                <div class="col-6 actionDiv">
                    <label for="actionColor" class="form-label col-3 action"></label>
                    <input type="text" class="form-control col-9" id="actionColor" data-coloris>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-6 productDiv">
                    <label for="productColor" class="form-label col-3 product"></label>
                    <input type="text" class="form-control col-9" id="productColor" data-coloris>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-12 text-end">
                    <button type="button" class="btn btn-success save" id="sendButton">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</div>
