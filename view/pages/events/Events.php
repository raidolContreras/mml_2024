<style>

#existingFiles {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: center; /* Centrar los elementos horizontalmente */
}

.file-item {
    position: relative;
    display: flex;
    width: 200px;
    margin-bottom: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
    background-color: #fff;
    flex-wrap: nowrap;
    align-items: center;
}

.file-item:hover {
    transform: scale(1.05);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
}

.file-item img,
.file-item iframe {
    width: 100%;
    height: auto;
    border-bottom: 1px solid #ddd; /* Separador debajo de la imagen/video */
}

.file-item a {
    display: block;
    text-align: center;
    margin: 10px 0;
    text-decoration: none;
    color: #007bff;
    font-weight: bold;
}

.delete-btn {
    position: absolute;
    top: -10px;
    right: -10px;
    background: red;
    color: white;
    border: none;
    border-radius: 50%;
    width: 30px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
}

.delete-btn:hover {
    background: rgba(255, 0, 0, 1);
    transform: scale(1.1);
}

.or {
    display: none;
    align-items: center;
    justify-content: center;
}

</style>
<div class="container">
    <div class="row mb-4">
        <div class="col-md-6 offset-md-3">
            <label for="eventSelectEdit" class="form-label SelectEvent"></label>
            <select class="form-select" id="eventSelectEdit"></select>
        </div>
    </div>
    
    <div class="row mb-4 teamSelect" style="display: none;">
        <div class="col-md-6 offset-md-3">
            <label for="teamSelectEdit" class="form-label teams"></label>
            <select class="form-select" id="teamSelectEdit"></select>
        </div>
    </div>

    <div class="row">
        <div id="eventDropzone" class="dropzone col-6 ml-2" style="display: none;"></div>

        <div class="col or"></div>

        <div id="videoUploadContainer" style="display: none;" class="mt-4 col-5">
            <input type="text" id="videoLink" class="form-control mb-2 EnterYouTubeVideoURL" />
            <button id="uploadVideoLink" class="btn btn-primary UploadVideoLink"></button>
        </div>

        <div id="fileCounter" class="mt-3 mb-2 col-12 mr-2" style="display: none;">
            <span id="UploadedFilesCount"></span> <span id="uploadedFilesCount">0</span>/5
        </div>

        <div id="existingFiles" class="row col-12" style="display: none;"></div>
    </div>
</div>
