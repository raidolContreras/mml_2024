Dropzone.autoDiscover = false;

// Definir la función initDropzone
const initDropzone = (selector, acceptedFiles) => {
    return new Dropzone(selector, {
        url: 'controller/ajax/upload_evidence.php', // URL predeterminada para la carga
        maxFiles: 5,
        maxFilesize: 1, // MB
        acceptedFiles: acceptedFiles, // Tipos de archivos permitidos
        addRemoveLinks: true,
        dictDefaultMessage: translations.DragAndDropFileHereOrClickToSelectOne + ' <p class="subtitulo-sup">' + translations.AllowedFileTypes + acceptedFiles + ' (' + translations.MaxSize + ' 1 MB)</p>',
        autoProcessQueue: false,
        dictInvalidFileType: translations.FileNotAllowedPleaseUploadA,
        dictFileTooBig: translations.FileIsTooLarge,
        init: function () {
            this.on("addedfile", function (file) {
                var removeButton = Dropzone.createElement('<button class="rounded-button">&times;</button>');
                var _this = this;
                removeButton.addEventListener("click", function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                    _this.removeFile(file);
                });
                file.previewElement.appendChild(removeButton);
            });

            this.on("sending", function (file, xhr, formData) {
                var team = ($('#level').val() != 0) ? $('#idTeam').val() : $('#teamSelectEdit').val();
                formData.append("team", team); // Add team parameter to formData
            });

            this.on("success", function (file, response) {
                console.log('Archivo subido con éxito:', response);
            });
        }
    });
};

var photoDropzone;
var reportsDropzone;
var attendanceDropzone;
var agreementsDropzone;
var othersDropzone;

$(document).ready(async function () {
    var language = $('#language').val();
    await cargarTraducciones(language);

    if (typeof translations !== 'undefined') {
        
        // Inicializar Dropzones aquí, después de asegurarte de que translations esté definido
        photoDropzone = initDropzone("#AddPhotosDropzone", "image/jpeg,image/png,image/jpg");
        reportsDropzone = initDropzone("#AddReportsDropzone", "application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document");
        attendanceDropzone = initDropzone("#AddAttendanceDropzone", "application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document");
        agreementsDropzone = initDropzone("#AddAgreementsDropzone", "application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document");
        othersDropzone = initDropzone("#AddOthersDropzone", "image/jpeg,image/png,image/jpg,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document");
    } else {
        console.error('Translations is not defined');
    }

    var level = $('#level').val();
    if (level != 0) {
        $('.teamSelect').hide();
        var idTeam = $('#idTeam').val();
        getMatrix(idTeam);
    } else {
        $('#teamSelectEdit').on('change', function () {
            var team = $('#teamSelectEdit').val();
            $('#idTeamSelect').val(team);

            if (team >= 1) {
                getMatrix(team);
            } else {
                $('.totalReports').css('display', 'none');
            }
        });
    }
});

var progress = 0;
var maxProgress = 0;
var seeReport;
var activitySelected;
var goal;

function seeReports(element, matrix) {
    progress = 0;
    maxProgress = 0;

    const dataAttributes = ['photos', 'videos', 'reports', 'attendance', 'agreements', 'others'];
    // Mostrar u ocultar secciones según los atributos data
    dataAttributes.forEach(attr => {
        const value = $(element).data(attr);
        $(`.${attr}`).css('display', value ? 'block' : 'none');
    });

    activitySelected = $(element).data('activity');

    maxProgress = $(element).data('goal');
    goal = $(element).data('goal');
    
    seeReport = $.ajax({
        type: 'POST',
        url: 'controller/ajax/ajax.form.php',
        data: { searchReportsToMatrix: matrix },
        dataType: 'json',
        success: function(data) {
            clearForm();
            let html = `
                <div class="row head mb-2">
                    <div class="col-3 description">${translations.description}</div>
                    <div class="col-1 progress_activity">${translations.progress_activity}</div>
                    <div class="col-4 evidences">${translations.evidences}</div>
                    <div class="col-4 actions">${translations.actions}</div>
                </div>`;

            let i = 0;
            let j = false;

            data.forEach(reports => {
                progress += reports.progress;
                maxProgress -= reports.progress;

                if ($(element).data('goal') > progress) {
                    j = true;
                } else {
                    j = false;
                }

                i++;

                if (reports.files && reports.files.trim() !== "") {
                    try {
                        const files = JSON.parse(reports.files);
                        if (Array.isArray(files) && files.length > 0) {
                            html += `
                                <div class="row row-body ml-1">
                                    <div class="col-3">${reports.description}</div>
                                    <div class="col-1">${reports.progress}</div>
                                    <div class="col-4">
                            `;
                            html += `<div class="">`;
                
                            files.forEach(file => {
                                file.path = file.path.replace(/^(\.\.\/){2}/, ''); // Eliminar ../../ del inicio del path
                                const fileIcon = getFileIcon(file.name, reports.idMatrix);
                                const fileName = file.name;
                                const extension = fileName.split('.').pop().toLowerCase();

                                html += `
                                    <div class="file-item btn-group row" style="align-items: center;">
                                        <img src="${fileIcon}" class="img-fluid mr-3 mt-2 col-3" alt="${file.name}">
                                        <div class="col">`;

                                switch (extension) {
                                    case 'pdf':
                                    case 'doc':
                                    case 'docx':
                                    case 'ppt':
                                    case 'pptx':
                                    case 'xls':
                                    case 'xlsx':
                                    case 'txt':
                                        html += `<a href="${file.path}" target="_blank" class="btn btn-primary mt-2">${translations.download}</a>`;
                                        break;
                                    default:
                                        html += `<button onclick="evidences('${file.path}', false)" target="_blank" class="btn btn-primary mt-2">${translations.view}</button>`;
                                        break;
                                }

                                html += `
                                            <button onclick="deleteFile('${file.path}', ${matrix}, ${reports.idReport})" class="btn btn-danger mt-2">${translations.delete}</button>
                                        </div>
                                    </div>`;
                            });

                            if (reports.videos && reports.videos.trim() !== '') {
                                html += `
                                    <div class="file-item btn-group row" style="align-items: center;">
                                        <img src="assets/images/video-icon.png" class="img-fluid mr-3 mt-2 col-3" alt="${reports.description}">
                                        <div class="col">
                                            <button onclick="evidences('${reports.videos}', true)" target="_blank" class="btn btn-primary mt-2">${translations.view}</button>
                                        </div>
                                    </div>`;
                            }

                            html += `
                                            </div>
                                        </div>
                                    <div class="col-4 btn-group" style="flex-wrap: nowrap; align-items: center;">
                                        <button onclick="editEvidence(${reports.idReport})" class="btn btn-info col">${translations.edit} </button>
                                        <button onclick="deleteEvidence(${reports.idReport})" class="btn btn-danger col">${translations.delete} </button>
                                    </div>
                                </div>`;

                        } else {
                            html += `
                                <div class="row row-body ml-1">
                                    <div class="col-3">${reports.description}</div>
                                    <div class="col-1">${reports.progress}</div>
                                    <div class="col-4 evidencesLinks"></div>
                                    <div class="col-4 btn-group" style="flex-wrap: nowrap; align-items: center;">
                                        <button onclick="editEvidence(${reports.idReport})" class="btn btn-info col">${translations.edit} </button>
                                        <button onclick="deleteEvidence(${reports.idReport})" class="btn btn-danger col">${translations.delete} </button>
                                    </div>
                                </div>
                            `;
                        }
                    } catch (error) {
                        console.error('Error parsing files JSON:', error);
                    }
                } else {
                    html += `
                        <div class="row row-body ml-1">
                            <div class="col-3">${reports.description}</div>
                            <div class="col-1">${reports.progress}</div>
                            <div class="col-4 evidencesLinks"></div>
                            <div class="col-4 btn-group" style="flex-wrap: nowrap; align-items: center;">
                                <button onclick="editEvidence(${reports.idReport})" class="btn btn-info col">${translations.edit} </button>
                                        <button onclick="deleteEvidence(${reports.idReport})" class="btn btn-danger col">${translations.delete} </button>
                            </div>
                        </div>
                    `;
                }
            });

            if (i === 0) {
                html += `
                    <div class="row row-body ml-1">
                        <div class="col-12">${translations.no_reports}</div>
                    </div>
                `;
            }

            if (j || progress == 0) { 
                $('.add_evidence').attr('onclick', `chargeEvidences(${matrix})`);
                
                maxProgress = $(element).data('goal') - progress;
                $('#progress_activity').attr('max', maxProgress);
                $('.add_evidence').css('display', 'block');
            } else {
                $('.add_evidence').css('display', 'none');
            }
            
            $('.evidenceReports').html(html);

            $('#chargeEvidence').css('display', 'none');
            $('#seeReports').modal('show');
        }
    });
}

// Helper function to extract YouTube video ID from URL
function getYouTubeVideoId(url) {
    const regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
    const match = url.match(regExp);
    return (match && match[2].length == 11) ? match[2] : null;
}

// Function to view evidence
function evidences(path, video = false) {
    $('#evidencesModal').modal('show');
    let html;

    if (video) {
        const videoId = getYouTubeVideoId(path);
        html = `
            <div class="d-flex justify-content-center">
                <iframe width="560" height="315" src="https://www.youtube.com/embed/${videoId}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>`;
    } else {
        html = `<img src="${path}" class="img-fluid">`;
    }

    $('.evidenceShow').html(html);
    $('#seeReports').modal('hide');

    $('.return').on('click', function(){
        $('#evidencesModal').modal('hide');
        $('#seeReports').modal('show');
    });
}

function deleteFile(filePath, matrix, idReport) {
    $.ajax({
        type: 'POST',
        url: 'controller/ajax/delete_file.php',
        data: { filePath: filePath, idReport: idReport },
        dataType: 'json',
        success: function(response) {
            if (response.status === 'success') {
                showAlert(translations.success, translations.FileDeletedSuccessfully);
                // Reload or refresh the report
                seeReports($(`[data-matrix="${matrix}"]`)[0], matrix);
            } else {
                showAlert(translations.alert, translations.ErrorDeletingFile);
            }
        },
        error: function(error) {
            console.error('Error al eliminar el archivo:', error);
            showAlert(translations.alert, translations.ErrorDeletingFile);
        }
    });
}

function getFileIcon(fileName, idMatrix) {
    const extension = fileName.split('.').pop().toLowerCase();
    switch (extension) {
        case 'pdf':
            return 'assets/images/pdf-icon.png';
        case 'doc':
        case 'docx':
            return 'assets/images/word-icon.png';
        case 'ppt':
        case 'pptx':
            return 'assets/images/powerpoint-icon.png';
        case 'xls':
        case 'xlsx':
            return 'assets/images/excel-icon.png';
        case 'txt':
            return 'assets/images/text-icon.png';
        default:
            return `assets/uploads/${idMatrix}/${fileName}`;
    }
}

let activities = Array(8).fill('');
let idStructure = 0;

async function getMatrix(team) {
    try {
        const response = await $.ajax({
            type: 'POST',
            url: 'controller/ajax/ajax.form.php',
            data: { structureSelect: team },
            dataType: 'json'
        });

        if (!response || Object.keys(response).length === 0) {
            $('.totalReports').css('display', 'none');
            return;
        }

        const project = $('#project').val();
        let structureSelect = true;
        let numberActivities = 0;
        let numberMatrix = 0;
        const idMatrixArray = [];

        for (let structure of response) {
            if (structure.idProject == project) {
                
                let matrixTotal = 0;
                
                structureSelect = false;

                const product1 = structure.product1 || '';
                const product2 = structure.product2 || '';

                activities = [
                    structure.activity1,
                    structure.activity2,
                    structure.activity3,
                    structure.activity4,
                    structure.activity5,
                    structure.activity6,
                    structure.activity7,
                    structure.activity8
                ];

                numberActivities = activities.filter(activity => activity != null).length;
                idStructure = structure.idStructure;

                if (numberActivities === 8) {
                    for (let index = 0; index < activities.length; index++) {
                        const matrix = await getStructureMatrix(index + 1, idStructure);
                        if (matrix) {
                            if (matrix.idMatrix != null) {
                                matrixTotal++;
                            }
                            idMatrixArray.push({ activityNumber: index + 1, idMatrix: matrix.idMatrix });
                            numberMatrix++;
                        }
                    }

                    if (numberMatrix === 8) {
                        if(matrixTotal === 8) {
                            $('.product01').html(product1);
                            $('.product02').html(product2);
    
                            activities.forEach((activity, index) => {
                                const $progressElement = $(`.totalProgress0${index + 1}`);
                                const $totalGoal = $(`.totalGoal0${index + 1}`);
                                const $activityTable = $(`.activity0${index + 1}`);
    
                                $activityTable.html(activity || '');
                                idMatrixArray.forEach(data => {
                                    if (data.activityNumber === index + 1) {
                                        const onClickAttr = `seeReports(this, ${data.idMatrix})`;
                                        $progressElement.attr('onclick', onClickAttr);
                                        $totalGoal.attr('onclick', onClickAttr);
                                        $activityTable.attr('onclick', onClickAttr);
                                    }
                                });
                            });
    
                            $('.totalReports').css('display', 'block');
                        } else {
                            $('.totalReports').css('display', 'none');
                            showAlertBootstrap2(translations.alert, translations.message_empty_matrix, 'Matriz');
                        }
                    }
                }
            }
        }

        if (structureSelect) {
            $('.totalReports').css('display', 'none');
        }
    } catch (error) {
        console.log("Error en la solicitud AJAX:", error);
    }
}

function getStructureMatrix(activity, structure) {
    return new Promise((resolve, reject) => {
        $.ajax({
            type: 'POST',
            url: 'controller/ajax/ajax.form.php',
            data: {
                activity: activity,
                searchStructureMatrix: structure
            },
            dataType: 'json',
            success: function(data) {
                if (data) {
                    const $progressElement = $(`.totalProgress0${activity}`);
                    const $totalGoal = $(`.totalGoal0${activity}`);
                    const $activityTable = $(`.activity0${activity}`);
                    $progressElement.html(data.progress != null ? data.progress : 0);

                    const attributes = {
                        'data-photos': data.photos == 1,
                        'data-videos': data.videos == 1,
                        'data-reports': data.reports == 1,
                        'data-attendance': data.attendance == 1,
                        'data-agreements': data.agreements == 1,
                        'data-others': data.others == 1,
                        'data-goal': data.goal,
                        'data-activity': activity
                    };

                    for (let key in attributes) {
                        $progressElement.attr(key, attributes[key]);
                        $totalGoal.attr(key, attributes[key]);
                        $activityTable.attr(key, attributes[key]);
                    }

                    $totalGoal.html(data.goal);

                    resolve(data);
                } else {
                    resolve(null);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                reject(errorThrown);
            }
        });
    });
}

function saveEvidence() {
    const videoUrl = $('#video').val();
    let progress = $('#progress_activity').val();
    const description = $('#description').val();
    const Matrix = idMatrix;

    const formData = new FormData();
    formData.append('video', videoUrl);
    formData.append('progress', progress);
    formData.append('maxProgress', maxProgress);
    formData.append('description', description);
    formData.append('matrix', Matrix);

    // Agregar archivos de Dropzone a formData
    photoDropzone.files.forEach(file => {
        formData.append('photos[]', file);
    });
    reportsDropzone.files.forEach(file => {
        formData.append('reports[]', file);
    });
    attendanceDropzone.files.forEach(file => {
        formData.append('attendance[]', file);
    });
    agreementsDropzone.files.forEach(file => {
        formData.append('agreements[]', file);
    });
    othersDropzone.files.forEach(file => {
        formData.append('others[]', file);
    });

    if (progress !== '' || description !== '') {
        $.ajax({
            type: 'POST',
            url: 'controller/ajax/upload_evidence.php', // Cambia esta URL a tu ruta de carga
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.status === 'success') {
                    progress = parseFloat(progress);
                    maxProgress = parseFloat(maxProgress);
                    
                    let totalProgress = $('.totalProgress0' + activitySelected).html();
                    totalProgress = parseFloat(totalProgress) + progress;
                    if (totalProgress > parseFloat(goal)) {
                        progress = parseFloat(goal) - parseFloat($('.totalProgress0' + activitySelected).html());
                        $('.totalProgress0' + activitySelected).html(goal);
                    } else {
                        $('.totalProgress0' + activitySelected).html(totalProgress);
                    }

                    let html = `
                        <div class="row row-body ml-1">
                            <div class="col-4">${description}</div>
                            <div class="col-4">${progress}</div>
                            <div class="col-4 evidencesLinks"></div>
                        </div>
                    `;

                    $('.evidenceReports').append(html);

                    // Llama a la función updateEvidence
                    updateEvidence(response.uploadId, response.files);

                    // Ocultar el formulario de carga después de guardar
                    $('#chargeEvidence').css('display', 'none');

                    clearForm();
                    // window.location.reload();
                } else {
                    console.error('Error al guardar la evidencia:', response.message);
                    showAlert(translations.alert, translations.uploadEvidenceError);
                }
            },
            error: function(error) {
                console.error('Error al guardar la evidencia:', error);
                showAlert(translations.alert, translations.uploadEvidenceError);
            }
        });
    } else {
        showAlert(translations.alert, translations.uploadEvidenceError);
    }
}

function updateEvidence(uploadId, files) {
    
    $.ajax({
        type: 'POST',
        url: 'controller/ajax/update_evidence.php',
        data: {
            uploadId: uploadId,
            files: JSON.stringify(files)
        },
        dataType: 'json',
        success: function(response) {
            if (response.status === 'success') {
                showAlert2(translations.success, translations.uploadEvidenceSuccess);
            } else {
                console.error('Error updating evidence:', response.message);
                showAlert(translations.alert, translations.updateEvidenceError);
            }
        },
        error: function(error) {
            console.error('Error updating evidence:', error);
            showAlert(translations.alert, translations.updateEvidenceError);
        }
    });
}

// Función para limpiar los campos de Dropzones y inputs
function clearForm() {
    $('#video').val('');
    $('#progress_activity').val('');
    $('#description').val('');
    photoDropzone.removeAllFiles(true);
    reportsDropzone.removeAllFiles(true);
    attendanceDropzone.removeAllFiles(true);
    agreementsDropzone.removeAllFiles(true);
    othersDropzone.removeAllFiles(true);
}

function chargeEvidences(matrix) {
    idMatrix = matrix;
    $('#chargeEvidence').css('display', 'block');
}

function showAlert(title, message) {
    var accept = translations.accept; // Usar las traducciones cargadas
    $('#modalLabel').text(title);
    $('.modal-body-extra').html(message);
    $('.modal-footer-extra').html('<button type="button" class="btn btn-success acceptError" data-bs-dismiss="modal">'+accept+'</button>');
    $('#alertModal').modal('show');
    $('#seeReports').modal('hide');

    $('.acceptError').on('click', function() {
        $('#seeReports').modal('show');
    });

}

function showAlert2(title, message) {
    
    var team = ($('#level').val() != 0) ? $('#idTeam').val() : $('#teamSelectEdit').val();
    getMatrix(team);

    var accept = translations.accept; // Usar las traducciones cargadas
    $('#modalLabel').text(title);
    $('.modal-body-extra').html(message);
    $('.modal-footer-extra').html('<button type="button" class="btn btn-success" data-bs-dismiss="modal">'+accept+'</button>');
    $('#alertModal').modal('show');
    $('#seeReports').modal('hide');

}

function showAlert3(title, message) {
    
    var team = ($('#level').val() != 0) ? $('#idTeam').val() : $('#teamSelectEdit').val();
    getMatrix(team);

    var accept = translations.accept; // Usar las traducciones cargadas
    var cancel = translations.cancel; // Usar las traducciones cargadas
    $('#modalLabel').text(title);
    $('.modal-body-extra').html(message);
    $('.modal-footer-extra').html(`<button type="button" class="btn btn-success accept">${accept}</button>
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">${cancel}</button>`);
    $('#alertModal').modal('show');
    $('#seeReports').modal('hide');

}

function editEvidence(idReport) {
    // Realizar una solicitud AJAX para obtener los detalles del reporte
    $.ajax({
        type: 'POST',
        url: 'controller/ajax/ajax.form.php',
        data: { getReportDetails: idReport },
        dataType: 'json',
        success: function(response) {
            if (response.status === 'success') {
                const report = response.data;
                $('#editDescription').val(report.description);
                $('#editProgress').val(report.progress);
                $('#lastEditProgress').val(report.progress);
                $('#idMatrix').val(report.idMatrix);
                // Guardar el ID del reporte en el formulario para usarlo en la actualización
                $('#editEvidenceForm').data('reportId', idReport);
                // Mostrar el modal de edición
                $('#editEvidenceModal').modal('show');
            } else {
                showAlert(translations.alert, translations.ErrorGettingReportDetails);
            }
        },
        error: function(error) {
            showAlert(translations.alert, translations.ErrorGettingReportDetails);
        }
    });
}

// Manejar la actualización del reporte cuando se envía el formulario de edición
$('#editEvidenceForm').on('submit', function(event) {
    event.preventDefault();

    const idReport = $(this).data('reportId');
    const description = $('#editDescription').val();
    const progress = $('#editProgress').val();
    const lastEditProgress = $('#lastEditProgress').val();
    const idMatrix = $('#idMatrix').val();

    $.ajax({
        type: 'POST',
        url: 'controller/ajax/ajax.form.php',
        data: {
            updateReport: idReport,
            description: description,
            progress: progress,
            lastEditProgress: lastEditProgress,
            idMatrixUpdate: idMatrix
        },
        dataType: 'json',
        success: function(response) {
            if (response.status === 'success') {
                showAlert2(translations.success, translations.ReportUpdatedSuccessfully);
                // Actualizar la vista de reportes
                $('#editEvidenceModal').modal('hide');
            } else {
                showAlert(translations.alert, translations.ErrorUpdatingReport);
            }
        },
        error: function(error) {
            showAlert(translations.alert, translations.ErrorUpdatingReport);
        }
    });
});

function deleteEvidence(idReport) {
    // Mostrar el modal de confirmación
    showAlert3(translations.confirm_delete, translations.confirm_delete_message);

    // Configurar el botón de aceptar para realizar la eliminación
    $('.modal-footer-extra .accept').off('click').on('click', function() {
        // Realizar la solicitud AJAX para eliminar la evidencia
        $.ajax({
            type: 'POST',
            url: 'controller/ajax/delete_evidence.php',
            data: { idReport: idReport },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {

                    var team = ($('#level').val() != 0) ? $('#idTeam').val() : $('#teamSelectEdit').val();
                    getMatrix(team);

                    showAlert(translations.success, translations.success_report_delete);
                    $('#alertModal').modal('hide');
                    $('#seeReports').modal('hide');
                } else {
                    showAlert(translations.alert, translations.error_report_delete);
                }
            },
            error: function(error) {
                showAlert(transeltions.alert, translations.error_report_delete);
            }
        });
    });
}
