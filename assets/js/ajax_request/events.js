
var idTeam = ($('#level').val() != 0) ? $('#idTeam').val() : 0;
$(document).ready(async function () {
    var language = $('#language').val();
    await cargarTraducciones(language);

    // Manejar el cambio de evento seleccionado
    $('#eventSelectEdit').on('change', function () {
        const eventId = $(this).val();
        if (eventId) {
            if ($('#level').val() == 0) {
                $('.teamSelect').css('display', 'block');
                $('#teamSelectEdit').on('change', function () {
                    if ($('#teamSelectEdit').val() > 0) {
                        idTeam = $('#teamSelectEdit').val();
                        $('#eventDropzone').css('display', 'block');
                        $('#existingFiles').css('display', 'flex');
                        $('#fileCounter').css('display', 'block');
                        $('#videoUploadContainer').css('display', 'block');
                        $('.or').css('display', 'flex');
                        loadEventFiles(eventId, idTeam);
                    } else {
                        $('#eventDropzone').css('display', 'none');
                        $('#existingFiles').css('display', 'none');
                        $('#fileCounter').css('display', 'none');
                        $('#videoUploadContainer').css('display', 'none');
                        $('.or').css('display', 'none');
                        $('#teamSelect').data('display', 'none');
                    }
                });
            } else {
                $('#eventDropzone').css('display', 'block');
                $('#existingFiles').css('display', 'flex');
                $('#fileCounter').css('display', 'block');
                $('#videoUploadContainer').css('display', 'block');
                $('.or').css('display', 'flex');
                loadEventFiles(eventId, idTeam);
            }

        } else {
            $('#eventDropzone').css('display', 'none');
            $('#existingFiles').css('display', 'none');
            $('#fileCounter').css('display', 'none');
            $('#videoUploadContainer').css('display', 'none');
            $('.or').css('display', 'none');
        }
    });

    // Configurar Dropzone
    const eventDropzone = new Dropzone("#eventDropzone", {
        maxFiles: 5,
        url: "controller/ajax/uploadEventFiles.php",
        paramName: "file",
        acceptedFiles: ".jpg,.jpeg,.gif,.png,.pdf,.doc,.docx,.ppt,.pptx,.xls,.xlsx,.txt",
        dictDefaultMessage: translations.DragAndDropFileHereOrClickToSelectOne+' <p class="subtitulo-sup">'+translations.AllowedFileTypes+' .jpg,.jpeg,.gif,.png,.pdf,.doc,.docx,.ppt,.pptx,.xls,.xlsx,.txt ('+translations.MaxSize+' 1 MB)</p>',
        maxFilesize: 10,
        addRemoveLinks: true,
        dictInvalidFileType: translations.FileNotAllowedPleaseUploadA,
        dictFileTooBig: translations.FileIsTooLarge,
        init: function () {
            this.on("sending", function (file, xhr, formData) {
                formData.append("eventId", $('#eventSelectEdit').val());
                formData.append("idTeam", idTeam);
            });
            this.on("success", function (file, response) {
                this.removeFile(file);  // Eliminar el archivo de la vista de Dropzone
                loadEventFiles($('#eventSelectEdit').val(), idTeam);
            });
        }
    });

    // Función para cargar archivos existentes
    function loadEventFiles(eventId, idTeam) {
        $.ajax({
            url: 'controller/ajax/getEventFiles.php',
            method: 'POST',
            data: { eventId: eventId, idTeam: idTeam },
            dataType: 'json',
            success: function (response) {
                const existingFilesContainer = $('#existingFiles');
                existingFilesContainer.empty();
                let uploadedFilesCount = 0;

                response.forEach(file => {
                    let fileElement;
                    if (file.type === 'image') {
                        fileElement = `
                            <div class="col-md-3 file-item">
                                <button class="delete-btn" onclick="deleteFile(${file.idEventToTeam})">&times;</button>
                                <img src="assets/uploads/events/${file.file}" class="img-fluid">
                            </div>`;
                    } else if (file.type === 'video') {
                        fileElement = `
                            <div class="col-md-3 file-item">
                                <button class="delete-btn" onclick="deleteFile(${file.idEventToTeam})">&times;</button>
                                <iframe width="100%" height="200" src="https://www.youtube.com/embed/${getYouTubeID(file.file)}" frameborder="0" allowfullscreen></iframe>
                            </div>`;
                    } else {
                        fileElement = `
                            <div class="col-md-3 file-item">
                                <button class="delete-btn" onclick="deleteFile(${file.idEventToTeam})">&times;</button>
                                <a href="assets/uploads/events/${file.file}" target="_blank">${file.file}</a>
                            </div>`;
                    }
                    existingFilesContainer.append(fileElement);
                    uploadedFilesCount++;
                });

                $('#uploadedFilesCount').text(uploadedFilesCount);
                eventDropzone.options.maxFiles = 5 - uploadedFilesCount;
                if (uploadedFilesCount >= 5) {
                    eventDropzone.disable();
                    $('#eventDropzone').css('display', 'none');
                    $('#videoUploadContainer').css('display', 'none');
                    $('.or').css('display', 'none');
                } else {
                    eventDropzone.enable();
                    $('#eventDropzone').css('display', 'block');
                    $('#videoUploadContainer').css('display', 'block');
                    $('.or').css('display', 'flex');
                }
            },
            error: function (error) {
                console.error('Error al obtener los archivos del evento:', error);
            }
        });
    }

    // Función para eliminar archivo
    window.deleteFile = function (eventDelete) {
        $.ajax({
            url: 'controller/ajax/deleteEventFile.php',
            method: 'POST',
            data: { idEventToTeam: eventDelete },
            success: function (response) {
                loadEventFiles($('#eventSelectEdit').val(), idTeam);
            },
            error: function (error) {
                console.error('Error al eliminar el archivo:', error);
            }
        });
    };

    // Manejar el envío del enlace del video
    $('#uploadVideoLink').on('click', function () {
        const videoLink = $('#videoLink').val();
        if (videoLink) {
            $.ajax({
                url: 'controller/ajax/uploadEventFiles.php',
                method: 'POST',
                data: {
                    eventId: $('#eventSelectEdit').val(),
                    idTeam: idTeam,
                    videoLink: videoLink
                },
                success: function (response) {
                    $('#videoLink').val('');
                    loadEventFiles($('#eventSelectEdit').val(), idTeam);
                },
                error: function (error) {
                    console.error('Error al subir el enlace del video:', error);
                }
            });
        }
    });

    // Función para obtener el ID de un video de YouTube a partir de su URL
    function getYouTubeID(url) {
        const regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
        const match = url.match(regExp);
        return (match && match[2].length == 11) ? match[2] : null;
    }
});

