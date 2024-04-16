<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/mdbassit/Coloris@latest/dist/coloris.min.css"/>
<script src="https://cdn.jsdelivr.net/gh/mdbassit/Coloris@latest/dist/coloris.min.js"></script>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <label for="projectSelect" class="form-label current_project"></label>
            <select class="form-select" id="projectSelect">
                <option value="" selected>Select a project</option>
                <option value="project1">Project 1</option>
                <option value="project2">Project 2</option>
                <option value="project3">Project 3</option>
            </select>
            
            <label class="form-label mt-3 color_settings"></label>
            <form id=""></form>
            <div class="row">
                <div class="col-6">
                    <label for="problemColor" class="form-label col-3 problem"></label>
                    <input type="text" class="form-control col-9" id="problemColor" value="#000000"  data-coloris>
                </div>
                <div class="col-6">
                    <label for="effectColor" class="form-label col-3 effect"></label>
                    <input type="text" class="form-control col-9" id="effectColor" value="#000000"  data-coloris>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-6">
                    <label for="causeColor" class="form-label col-3 cause"></label>
                    <input type="text" class="form-control col-9" id="causeColor" value="#000000"  data-coloris>
                </div>
                <div class="col-6">
                    <label for="objectiveColor" class="form-label col-3 objetive"></label>
                    <input type="text" class="form-control col-9" id="objectiveColor" value="#000000"  data-coloris>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-6">
                    <label for="resultColor" class="form-label col-3 result"></label>
                    <input type="text" class="form-control col-9" id="resultColor" value="#000000"  data-coloris>
                </div>
                <div class="col-6">
                    <label for="actionColor" class="form-label col-3 action"></label>
                    <input type="text" class="form-control col-9" id="actionColor" value="#000000"  data-coloris>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-6">
                    <label for="productColor" class="form-label col-3 product"></label>
                    <input type="text" class="form-control col-9" id="productColor" value="#000000"  data-coloris>
                </div>
            </div>
        </div>
    </div>
</div>
