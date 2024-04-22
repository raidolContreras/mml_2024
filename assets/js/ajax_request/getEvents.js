$(document).ready(function () {

    $('#eventSettings').DataTable({
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
            url: 'controller/ajax/getEvents.php',
            dataSrc: ''
        },
        columns: [
            {
                data: 'eventName'
            },
            {
                data: null,
                render: function(data) {
                    return `
                    <center>
                        <button class="btn btn-info" onclick="editEvent(${data.idEvent})">${translations.edit}</button>
                        <button class="btn btn-danger" onclick="deleteEvent(${data.idEvent})">${translations.delete}</button>
                    </center>
                    `;
                }
            }
        ],
    });

    $('#sendButton').on('click', function () {

        var eventName = $('#eventName').val();

        // Validar si los campos están vacíos
        if (eventName === '') {
            // Mostrar un mensaje de error si algún campo está vacío
            $('#eventModal').modal('hide');
            showAlertBootstrap1('¡Alerta!','Por favor, completa todos los campos.', 'eventModal');
            return; // Detener el envío del formulario si hay campos vacíos
        }
        
        // Enviar los datos mediante AJAX
        $.ajax({
            type: 'POST',
            url: 'controller/ajax/ajax.form.php', 
            data: {eventName: eventName},
            success: function (response) {
                console.log(response);
                $('#eventModal').modal('hide');
                if (response === 'ok') {
                    showAlertBootstrap('¡Éxito!', 'El evento ha sido creado exitosamente.');
                    $('#eventName').val('');
                    $('#eventSettings').DataTable().ajax.reload();
                } else {
                    
                    showAlertBootstrap1('¡Alerta!', 'El evento no se ha creado, intentalo de nuevo.', 'eventModal');
                }
            },
            error: function (xhr, status, error) {
                // Manejar errores aquí
                console.error(xhr.responseText);
            }
        });
    });
});

function editEvent(event) {
    // Mostrar el modal
    $('#eventModalEdit').modal('show');
    // Limpiar los campos
    $('#eventName').val('');
    // Recuperar los datos del evento
    $.ajax({
        type: 'POST',
        url: 'controller/ajax/ajax.form.php', 
        data: {SelectEvent: event},
        dataType: 'json',
        success: function (response) {
            $('#eventNameEdit').val(response.eventName);
        },
        error: function (xhr, status, error) {
            // Manejar errores aquí
            console.error(xhr.responseText);
        }
    });
}

function deleteEvent(event) {
    // Mostrar el modal
    $('#deleteEventModal').modal('show');
    $('.acceptDelete').html(translations.accept);
    $('.deleteMessage').html(translations.deleteMessageEvent);
    $('#deleteEvent').val(event);
}