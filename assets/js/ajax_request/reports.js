function seeReports(element, matrix) {
    const dataAttributes = ['photos', 'videos', 'reports', 'attendance', 'agreements', 'others'];

    // Mostrar u ocultar secciones según los atributos data
    dataAttributes.forEach(attr => {
        const value = $(element).data(attr);
        $(`.${attr}`).css('display', value ? 'block' : 'none');
    });

    $.ajax({
        type: 'POST',
        url: 'controller/ajax/ajax.form.php',
        data: { searchReportsToMatrix: matrix },
        dataType: 'json',
        success: function(data) {
            let html = `
                <div class="row head mb-2">
                    <div class="col-4 description">${translations.description}</div>
                    <div class="col-4 progress_activity">${translations.progress_activity}</div>
                    <div class="col-4 evidences">${translations.evidences}</div>
                </div>`;
            let i = 0;
            data.forEach(reports => {
                html += `
                    <div class="row row-body ml-1">
                        <div class="col-4">Example</div>
                        <div class="col-4">Example</div>
                        <div class="col-4">Example</div>
                    </div>
                `;
                i++;
            });
            if (i === 0) {
                html += `
                    <div class="row row-body ml-1">
                        <div class="col-12">No hay reportes</div>
                    </div>
                `;
            }
            $('.addEvidence').attr('onclick', `chargeEvidences(${matrix})`);
            $('.evidenceReports').html(html);
            
            $('#chargeEvidence').css('display', 'none');
            $('#seeReports').modal('show');
        }
    });
}

function evidences(idEvidences) {
    $('#evidencesModal').modal('show');
    $('#seeReports').modal('hide');
}

function chargeEvidences(matrix) {
    $('#chargeEvidence').css('display', 'block');
}

$('#teamSelectEdit').on('change', function() {
    const team = $(this).val();
    $('#idTeamSelect').val(team);
    if (team >= 1) {
        getMatrix(team);
    } else {
        $('.totalReports').css('display', 'none');
    }
});

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
                            idMatrixArray.push({ activityNumber: index + 1, idMatrix: matrix.idMatrix });
                            numberMatrix++;
                        }
                    }

                    if (numberMatrix === 8) {
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
                        'data-others': data.others == 1
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

Dropzone.autoDiscover = false;

const initDropzone = (selector, url, acceptedFiles) => {
    return new Dropzone(selector, {
        url: url,
        maxFiles: 5,
        maxFilesize: 1, // MB
        acceptedFiles: acceptedFiles, // Tipos de archivos permitidos
        addRemoveLinks: true,
        dictDefaultMessage: 'Arrastra y suelta el archivo aquí o haz clic para seleccionar uno <p class="subtitulo-sup">Tipos de archivo permitidos: ' + acceptedFiles + ' (Tamaño máximo 1 MB)</p>',
        autoProcessQueue: false,
        dictInvalidFileType: "Archivo no permitido. Por favor, sube un archivo en formato permitido.",
        dictFileTooBig: "El archivo es demasiado grande ({{filesize}}MB). Tamaño máximo permitido: {{maxFilesize}}MB.",
        init: function() {
            this.on("addedfile", function(file) {
                var removeButton = Dropzone.createElement('<button class="rounded-button">&times;</button>');
                var _this = this;
                removeButton.addEventListener("click", function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    _this.removeFile(file);
                });
                file.previewElement.appendChild(removeButton);
            });

            this.on("sending", function(file, xhr, formData) {
                var team = $('#teamSelectEdit').val();
                formData.append("team", team); // Add team parameter to formData
            });

            this.on("success", function(file, response) {
                console.log('Archivo subido con éxito:', response);
            });
        }
    });
};

// Inicializar Dropzones con tipos de archivos específicos
const photoDropzone = initDropzone("#AddPhotosDropzone", "/path/to/upload/photos", "image/jpeg,image/png,image/jpg");
const reportsDropzone = initDropzone("#AddReportsDropzone", "/path/to/upload/reports", "application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document");
const attendanceDropzone = initDropzone("#AddAttendanceDropzone", "/path/to/upload/attendance", "application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document");
const agreementsDropzone = initDropzone("#AddAgreementsDropzone", "/path/to/upload/agreements", "application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document");
const othersDropzone = initDropzone("#AddOthersDropzone", "/path/to/upload/others", "image/jpeg,image/png,image/jpg,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document");

function saveEvidence() {
    const videoUrl = $('#video').val();
    const progress = $('#progress_activity').val();
    const description = $('#description').val();

    const formData = new FormData();
    formData.append('video', videoUrl);
    formData.append('progress', progress);
    formData.append('description', description);

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

    $.ajax({
        type: 'POST',
        url: 'controller/ajax/upload_evidence.php', // Cambia esta URL a tu ruta de carga
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
            console.log('Evidencia guardada con éxito:', response);
            // Ocultar el formulario de carga después de guardar
            $('#chargeEvidence').css('display', 'none');
        },
        error: function(error) {
            console.error('Error al guardar la evidencia:', error);
        }
    });
}