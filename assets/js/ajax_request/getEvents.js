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
                    return '';
                }
            }
        ],
    });
});
