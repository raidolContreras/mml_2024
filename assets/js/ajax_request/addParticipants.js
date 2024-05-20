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
