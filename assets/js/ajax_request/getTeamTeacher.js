var idteam = $('#idTeam').val();
$(document).ready(function () {
    $.ajax({
        type: "POST",
        url: "controller/ajax/getTeams.php",
        dataType: "json",
        success: function (teams) {
            var mentorName = $('#name').val();
            var mentorEmail = $('#email').val();
            try {
                teams.forEach(function(team) {
                    if (team.idTeam == idteam) {
                        teamName = team.teamName;
                        teamSchool = team.teamSchool;
                        teamState = team.teamState;
                        identifiedProblem = team.identifiedProblem;
                        mainObjective = team.mainObjective;
                    }
                });
                $("#mentorName").html(mentorName);
                $("#mentorEmail").html(mentorEmail);
                $("#teamName").html(teamName);
                $("#teamSchool").html(teamSchool);
                $("#teamState").html(teamState);
                $("#identifiedProblem").html(identifiedProblem);
                $("#mainObjective").html(mainObjective);
                participants(idteam);
            } catch (error) {
                console.error("Error al parsear la respuesta del servidor:", error);
            }
        },
        error: function(xhr, status, error) {
            console.error("Error en la solicitud AJAX:", error);
        }
    });
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
            formData.append("team", idteam);
        });

        this.on("success", function( file, xhr, formData) {
            $('#participantsModal').modal('hide');
            participants(idteam);
        });
    }
});

$('#sendButton').on('click', function () {        
    myDropzone.processQueue();
});

$('#teamSelectEdit').on('change', function() {
    var team = $('#teamSelectEdit').val();
    if (team >= 1) {
        $('.details-teams').css('display', 'flex');
        $.ajax({
            type: 'POST',
            url: 'controller/ajax/ajax.form.php',
            data: {
                searchTeamParticipants: team
            },
            success: function (response) {
                
            }
        });
    } else {
        $('.details-teams').css('display', 'none');
    }
});
