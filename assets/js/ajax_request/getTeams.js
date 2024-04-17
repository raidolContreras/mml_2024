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
                data: null,
                render: function(data) {
                    return '';
                }
            }
        ],
    });

    $('#sendButton').on('click', function () {

        var teamName = $('#teamName').val();
        var description = $('#description').val();
        var school = $('#school').val();

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
            school: school
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

});
