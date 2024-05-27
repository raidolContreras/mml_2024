$('#addParticipantBtn').on('click', function () {
    $('#participantsModal').modal('show');
});

var myDropzone = new Dropzone("#addParticipantsDropzone", {
    maxFiles: 1,
    url: "controller/ajax/ajax.form.php",
    maxFilesize: 10,
    acceptedFiles: "text/csv",
    paramName: "pacientList",
    dictDefaultMessage: 'Arrastra y suelta el archivo aquí o haz clic para seleccionar uno <p class="subtitulo-sup">Tipos de archivo permitidos .csv (Tamaño máximo 10 MB)</p>',
    autoProcessQueue: false,
    dictInvalidFileType: "Archivo no permitido. Por favor, sube un archivo en formato CSV.",
    dictFileTooBig: "El archivo es demasiado grande ({{filesize}}MB). Tamaño máximo permitido: {{maxFilesize}}MB.",
    errorPlacement: function(error, element) {
        var $element = $(element),
            errContent = $(error).text();
            $element.attr('data-toggle', 'tooltip');
            $element.attr('title', errContent);
            $element.tooltip({
            placement: 'top'
        });
        $element.tooltip('show');

        // Agregar botón de eliminar archivo
        var removeButton = Dropzone.createElement('<button class="rounded-button">&times;</button>');
        removeButton.addEventListener("click", function(e) {
            e.preventDefault();
            e.stopPropagation();
            myDropzone.removeFile(element);
        });
        $element.parent().append(removeButton); // Agregar el botón al contenedor del input
    },
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
    }
});

$('#sendButton').on('click', function () {        
    myDropzone.processQueue();
});

$('#teamSelectEdit').on('change', function() {
    var team = $('#teamSelectEdit').val();
    $('#idTeamSelect').val(team);
    
    $('.edit-button').attr('onclick', 'editTeam(' + team + ')');
    
    if (team >= 1) {
        $('.details-teams').css('display', 'flex');
        participants(team);
    } else {
        $('.details-teams').css('display', 'none');
    }
});

function participants(idTeam) {
    $.ajax({
        type: "POST",
        url: "controller/ajax/getParticipants.php",
        data: {
            idTeam: idTeam
        },
        dataType: "json",
        success: function (participants) {
            try {
                var html = "";
                if (participants.length === 0) {
                    html = '<p>No hay estudiantes en el equipo.</p>';
                } else {
                    participants.forEach(function(participant) {
                        html +=`<div class="participant mb-2">
                                    <div class="row">
                                        <div class="col-4 font-weight-bold">${participant.firstnameParticipant} ${participant.lastnameParticipant}:</div>
                                        <div class="col-6">${participant.emailParticipant}</div>
                                        <div class="col-2 btn-group" role="group">
                                            <button type="button" class="btn btn-primary btn-sm" onClick='editParticipant(${participant.idparticipant})'>
                                                <i class="fa-solid fa-user-pen"></i>
                                            </button>
                                            <button type="button" class="btn btn-danger btn-sm" onClick='deleteParticipant(${participant.idparticipant})'>
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>`;
                    });
                }
                $("#participantsList").html(html);
            } catch (error) {
                console.error("Error al parsear la respuesta del servidor:", error);
            }
        },
        error: function(xhr, status, error) {
            console.error("Error en la solicitud AJAX:", error);
        }
    });
}


function editParticipant(idparticipant) {
    $('#editParticipantsModal').modal('show');
    $.ajax({
        type: 'POST',
        url: 'controller/ajax/ajax.form.php',
        data: {
            searchParticipant: idparticipant
        },
        dataType: 'json',
        success: function (response) {
            console.log(response);
            $('#editParticipant').val(idparticipant);
            $('#firstnameParticipant').val(response.firstnameParticipant);
            $('#lastnameParticipant').val(response.lastnameParticipant);
            $('#emailParticipant').val(response.emailParticipant);
        }
    });
}

function deleteParticipant(idparticipant) {
    $('#deleteParticipantsModal').modal('show');
    $('#editParticipant').val(idparticipant);
}

$('#deleteParticipant').on('click', function() {
    var idparticipant = $('#editParticipant').val();
    $.ajax({
        type: 'POST',
        url: 'controller/ajax/ajax.form.php',
        data: {
            deleteParticipant: idparticipant
        },
        success: function (response) {
            $('#deleteParticipantsModal').modal('hide');
            
            var idteam = $('#idTeamSelect').val();

            participants(idteam);
        }
    });
});

$('#updateParticipant').on('click', function() {
    $.ajax({
        type: 'POST',
        url: 'controller/ajax/ajax.form.php',
        data: {
            updateParticipant: $('#editParticipant').val(),
            firstnameParticipant: $('#firstnameParticipant').val(),
            lastnameParticipant: $('#lastnameParticipant').val(),
            emailParticipant: $('#emailParticipant').val()
        },
        success: function (response) {
            $('#editParticipantsModal').modal('hide');

            var idteam = $('#idTeamSelect').val();
            
            participants(idteam);
        }
    });
});