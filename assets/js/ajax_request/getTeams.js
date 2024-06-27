$(document).ready(async function () {
    var language = $('#language').val();
    await cargarTraducciones(language);
});

$(document).ready(function () {

    $('#teams').DataTable({
        // Resto de tus opciones de configuración...
        initComplete: function(settings, json) {
            // Esto inicializa los tooltips después de que DataTables ha terminado de cargar los datos por primera vez
            $('[data-bs-toggle="tooltip"]').tooltip();
        },
        drawCallback: function(settings) {
            // Esto reinicializa los tooltips cada vez que DataTables redibuja la tabla (ej., paginación)
            $('[data-bs-toggle="tooltip"]').tooltip();
        },
        ajax: {
            url: 'controller/ajax/getTeams.php',
            dataSrc: ''
        },
        columns: [
            {
				data: null,
                render: function (data, type, row, meta) {
                // Utilizando el contador proporcionado por DataTables
                return meta.row + 1;
				}
            },
            {
                data: 'teamName'
            },
            {
                data: 'teamDescription'
            },
            {
                data: 'teamSchool'
            },
            {
                data: 'nameProject'
            },
            {
                data: null,
                render: function(data) {
                    return `
                    <center>
                        <div class="btn-group" role="group">
                            <button class="btn btn-info" onclick="editTeam(${data.idTeam})">${translations.edit}</button>
                            <button class="btn btn-danger" onclick="deleteTeam(${data.idTeam})">${translations.delete}</button>
                        </div>
                    </center>
                    `;
                }
            }
        ],
    });

    $('#sendButton').on('click', function () {

        var teamName = $('#teamName').val();
        var description = $('#description').val();
        var school = $('#school').val();
        var project = $('#projectSelectEdit').val();

        // Validar si los campos están vacíos
        if (teamName === '' || description === '' || school === '') {
            // Mostrar un mensaje de error si algún campo está vacío
            $('#teamModal').modal('hide');
            showAlertBootstrap1('¡Alerta!','Por favor, completa todos los campos.', 'teamModal');
            return; // Detener el envío del formulario si hay campos vacíos
        }

        // Si todos los campos están llenos, enviar los datos mediante AJAX
        var formData = {
            teamName: teamName,
            description: description,
            school: school,
            project: project
        };

        // Enviar los datos mediante AJAX
        $.ajax({
            type: 'POST',
            url: 'controller/ajax/ajax.form.php', 
            data: formData,
            success: function (response) {
                console.log(response);
                $('#teamModal').modal('hide');
                if (response === 'ok') {
                    showAlertBootstrap('¡Éxito!', 'El equipo ha sido creado exitosamente.');
                    $('#teamName').val('');
                    $('#description').val('');
                    $('#school').val('');
                    $('#project').val('');
                    $('#teams').DataTable().ajax.reload();
                } else {
                    showAlertBootstrap('¡Alerta!', 'El equipo no se ha creado, intentalo de nuevo.');
                }
            },
            error: function (xhr, status, error) {
                // Manejar errores aquí
                console.error(xhr.responseText);
            }
        });
    });

    $('#acceptButton').on('click', function () {
        var teamName = $('#teamNameEdit').val();
        var description = $('#descriptionEdit').val();
        var school = $('#schoolEdit').val();
        var project = $('.projectSelectEdit').val();
        var team = $('#editTeam').val();

        $.ajax({
            type: 'POST',
            url: 'controller/ajax/ajax.form.php',
            data: {
                EditTeam: team,
                teamNameEdit: teamName,
                descriptionEdit: description,
                schoolEdit: school,
                projectEdit: project
            },
            success: function (response) {
                console.log(response);
                $('#teamModalEdit').modal('hide');
                if (response === 'ok') {
                    showAlertBootstrap('¡Éxito!', 'El equipo ha sido editado exitosamente.');
                    $('#teams').DataTable().ajax.reload();
                } else {
                    showAlertBootstrap('¡Alerta!', 'El equipo no se ha editado, intentalo de nuevo.');
                }
            },
            error: function (xhr, status, error) {
                // Manejar errores aquí
                console.error(xhr.responseText);
            }
        });
    });

    
    $('#deleteButton').on('click', function () {
        var team = $('#deleteTeam').val();
        $.ajax({
            type: 'POST',
            url: 'controller/ajax/ajax.form.php',
            data: {
                DeleteTeam: team
            },
            success: function (response) {
                console.log(response);
                $('#teamModalDelete').modal('hide');
                if (response === 'ok') {
                    showAlertBootstrap('¡Éxito!', 'El equipo ha sido eliminado exitosamente.');
                    $('#teams').DataTable().ajax.reload();
                } else {
                    showAlertBootstrap('¡Alerta!', 'El equipo no se ha eliminado, intentalo de nuevo.');
                }
            },
            error: function (xhr, status, error) {
                // Manejar errores aquí
                console.error(xhr.responseText);
            }
    
        });
    });

});

function editTeam(team) {

    $('#teamModalEdit').modal('show');
    $.ajax({
        type: 'POST',
        url: 'controller/ajax/ajax.form.php',
        data: {
            SearchTeam: team
        },
        dataType: 'json',
        success: function (response) {
            $('#editTeam').val(team);
            $('#teamNameEdit').val(response.teamName);
            $('#descriptionEdit').val(response.teamDescription);
            $('#schoolEdit').val(response.teamSchool);
            $('.projectSelectEdit').val(response.teams_idProject);
        },
        error: function (xhr, status, error) {
            // Manejar errores aquí
            console.error(xhr.responseText);
        }
    });
}

function deleteTeam(team) {
    
    $('#teamModalDelete').modal('show');
    // Eliminar el equipo mediante AJAX
    $.ajax({
        type: 'POST',
        url: 'controller/ajax/ajax.form.php',
        data: {
            SearchTeam: team
        },
        dataType: 'json',
        success: function (response) {
            $('.deleteMessage').html(translations.deleteMessageTeam);
            $('#deleteTeam').val(response.idTeam);
        }
    });
}