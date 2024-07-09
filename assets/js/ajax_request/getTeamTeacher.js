var myDropzone;

$(document).ready(async function () {
    var language = $('#language').val();
    await cargarTraducciones(language);
    

    myDropzone = new Dropzone("#addParticipantsDropzone", {
        maxFiles: 1,
        url: "controller/ajax/ajax.form.php",
        maxFilesize: 10,
        acceptedFiles: "text/csv",
        paramName: "pacientList",
        dictDefaultMessage: translations.DragAndDropFileHereOrClickToSelectOne+' <p class="subtitulo-sup">'+translations.AllowedFileTypes+' .csv ('+translations.MaxSize+' 10 MB)</p>',
        autoProcessQueue: false,
        dictInvalidFileType: translations.FileNotAllowedPleaseUploadA,
        dictFileTooBig: translations.FileIsTooLarge,
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
                // Eliminar el archivo de Dropzone
                this.removeFile(file);
            });
        }
    });
});

var idteam = $('#idTeam').val();
$(document).ready(function () {
    loadTeamsData(idteam);
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
                                    <div class="col-5">${participant.emailParticipant}</div>
                                    <div class="col-3 btn-group" role="group">
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
            participants(idteam);
        }
    });
});

function editTeam(team) {
    $('#editTeamModal').modal('show');
    $.ajax({
        type: 'POST',
        url: 'controller/ajax/ajax.form.php',
        data: {
            searchTeam: team
        },
        dataType: 'json',
        success: function (response) {
            $('#state').val(response.teamState);
            $('#identifiedProbleminput').val(response.identifiedProblem);
            $('#mainObjectiveinput').val(response.mainObjective);
        },
        error: function (xhr, status, error) {
            // Manejar errores aquí
            console.error(xhr.responseText);
        }
    });
}

$('#updateTeam').on('click', function() {
    $.ajax({
        type: 'POST',
        url: 'controller/ajax/ajax.form.php',
        data: {
            updateTeam: idteam,
            state: $('#state').val(),
            identifiedProblem: $('#identifiedProbleminput').val(),
            mainObjective: $('#mainObjectiveinput').val()
        },
        success: function (response) {
            $('#editTeamModal').modal('hide');
            loadTeamsData(idteam);
        }
    });
});

function loadTeamsData(idteam) {
    $.ajax({
        type: "POST",
        url: "controller/ajax/getTeams.php",
        data:{
            team: $('#idTeam').val()
        },
        dataType: "json",
        success: function (team) {
            var mentorName = $('#name').val();
            var mentorEmail = $('#email').val();
            try {
                teamName = team.teamName;
                teamSchool = team.teamSchool;
                teamState = team.teamState;
                identifiedProblem = team.identifiedProblem;
                mainObjective = team.mainObjective;
                $("#mentorName").html(mentorName);
                $("#mentorEmail").html(mentorEmail);
                $("#teamName").html(teamName);
                $("#teamSchool").html(teamSchool);
                $("#teamState").html(teamState);
                $("#identifiedProblem").html(identifiedProblem);
                $("#mainObjective").html(mainObjective);
                participants(idteam);
                $('.edit-button').attr('onclick', 'editTeam(' + idteam + ')');
            } catch (error) {
                console.error("Error al parsear la respuesta del servidor:", error);
            }
        },
        error: function(xhr, status, error) {
            console.error("Error en la solicitud AJAX:", error);
        }
    });
}