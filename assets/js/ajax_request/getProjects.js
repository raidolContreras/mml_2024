$(document).ready(function () {

    $('#projects').DataTable({
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
            url: 'controller/ajax/getProjects.php',
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
                data: null,
                render: function(data) {
                    if (data.logoProject == "") {
                        return `
                        <div class="text-center">
                            Sin logotipo
                        </div>
                        `;
                    }
                    return `
                    <div class="text-center">
                        <img src="assets/images/projects/${data.idProject}/${data.logoProject}" class="img-fluid" style="max-height: 50px;" alt="Logo del proyecto">
                    </div>
                    `;
                }
            },
            {
                data: 'nameProject'
            },
            {
                data: 'linkProject'
            },
            {
                data: null,
                render: function(data) {
                    return `
                    <center>
                        <button class="btn btn-info" onclick="editProject(${data.idProject})">${translations.edit}</button>
                        <button class="btn btn-danger" onclick="deleteProject(${data.idProject})">${translations.delete}</button>
                    </center>
                    `;
                }
            }
        ],
    });
    
    var idProject;

    var myDropzone = new Dropzone("#projectLogoDropzone", {
        maxFiles: 1,
        url: "controller/ajax/ajax.form.php",
        maxFilesize: 10,
        paramName: "logo",
        acceptedFiles: "image/jpeg, image/png",
        dictDefaultMessage: 'Arrastra y suelta el archivo aquí o haz clic para seleccionar uno <p class="subtitulo-sup">Tipos de archivo permitidos .PNG, .JPG, .JPEG (Tamaño máximo 10 MB)</p>',
        autoProcessQueue: false,
        dictInvalidFileType: "Archivo no permitido. Por favor, sube un archivo en formato .PNG, .JPG, .JPEG.",
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
        }
    });

    $('#sendButton').on('click', function () {
        projectName = $('#projectName').val();
        projectLink = $('#projectLink').val();
        
        // Validar si los campos están vacíos
        if (projectName === '' || projectLink === '') {
            // Mostrar un mensaje de error si algún campo está vacío
            $('#projectModal').modal('hide');
            showAlertBootstrap1('¡Alerta!','Por favor, completa todos los campos.', 'projectModal');
            return; // Detener el envío del formulario si hay campos vacíos
        }

        // Si todos los campos están llenos, enviar los datos mediante AJAX
        var formData = {
            projectName: projectName,
            projectLink: projectLink
        };
        
        // Enviar los datos mediante AJAX
        $.ajax({
            type: 'POST',
            url: 'controller/ajax/ajax.form.php', 
            data: formData,
            success: function (response) {
                console.log(response);
                $('#teamModal').modal('hide');
                if (response !== 'error') {
                    showAlertBootstrap('¡Éxito!', 'El proyecto ha sido creado exitosamente.');
                    $('#projectName').val('');
                    $('#projectLink').val('');
                    $('#projects').DataTable().ajax.reload();
                    idProject = response;

                    myDropzone.processQueue();
                    $('#projectModal').modal('hide');
                    
                    setTimeout(() => {
                        // Limpiar el Dropzone
                        myDropzone.removeAllFiles();
                    }, 1000);
                    
                } else {
                    showAlertBootstrap('¡Alerta!', 'El proyecto no se ha creado, intentalo de nuevo.');
                }
            },
            error: function (xhr, status, error) {
                // Manejar errores aquí
                console.error(xhr.responseText);
            }
        });

    });
    
    // Configuración del evento 'sending' del Dropzone
	myDropzone.on("sending", function(file, xhr, formData) {
        formData.append("idProject", idProject);
    });
});

function editProject(project) {
    $('#editProject').val(project);
    $.ajax({
        type: 'POST',
        url: 'controller/ajax/ajax.form.php', 
        data: {
            SelectProject: project
        },
        dataType: 'json',
        success: function (response) {
            $('#projectNameEdit').val(response.nameProject);
            $('#projectLinkEdit').val(response.linkProject);
            $('#logoProject').val(response.logoProject);
            $('#editProjectsModal').modal('show');
        },
        error: function (xhr, status, error) {
            // Manejar errores aquí
            console.error(xhr.responseText);
        }
    });
}

function deleteProject(project) {
    $('#deleteProject').val(project);
    $.ajax({
        type: 'POST',
        url: 'controller/ajax/ajax.form.php', 
        data: {
            SelectProject: project
        },
        dataType: 'json',
        success: function (response) {
            $('#deleteProjectsModal').modal('show');
            $('.acceptDelete').html(translations.accept);
            $('.deleteMessage').html(translations.deleteMessageProject);
        },
        error: function (xhr, status, error) {
            // Manejar errores aquí
            console.error(xhr.responseText);
        }
    });
}