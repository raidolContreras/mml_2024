$(document).ready(async function () {
    var language = $('#language').val();
    await cargarTraducciones(language);
    

    $('#users').DataTable({
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
            url: 'controller/ajax/getUsers.php',
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
                render: function (data, type, row) {
                    return data.firstname + ' ' + data.lastname;
                }
            },
            {
                data: 'email'
            },
            {
                data: null,
                render: function(data) {
                    if (data.nameProject != isNaN) {
                        return data.nameProject;
                    } else {
                        return '';
                    }
                }
            },
            {
                data: null,
                render: function(data) {
                    if (data.teamName != isNaN) {
                        return data.teamName;
                    } else {
                        return '';
                    }
                }
            },
            {
                data: null,
                render: function(data, type) {
                    var level = "";
                    if (data.level == 0) {
                        level = translations.admin;
                    } else if(data.level == 1) {
                        level = translations.standar;
                    } else {
                        level = translations.student;
                    }
                    return level;
                } 
            },
            {
                data: null,
                render: function(data) {
                    return `
                    <center>
                        <div class="btn-group" role="group">
                            <button class="btn btn-info" onclick="editUser(${data.idUser})">${translations.edit}</button>
                            <button class="btn btn-danger" onclick="deleteUser(${data.idUser})">${translations.delete}</button>
                        </div>
                    </center>
                    `;
                }
            }
        ],
    });

    var myDropzone = new Dropzone("#addUsersDropzone", {
        maxFiles: 1,
        url: "controller/ajax/ajax.form.php",
        maxFilesize: 10,
        acceptedFiles: "text/csv",
        paramName: "userList",
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
        }
    });
    
    $('#sendButton').on('click', function () {        
        myDropzone.processQueue();
    });
    
    $('.acceptEdit').on('click', function () {
        var user = $('#editUser').val();
        var firstname = $('.firstnameEdit').val();
        var lastname = $('.lastnameEdit').val();
        var email = $('.emailEdit').val();
        var projectSelectEdit = $('.projectSelectEdit').val();
        var teamSelectEdit = $('.teamSelectEdit').val();
        var level = $('.level_user_edit').val();
        $.ajax({
            type: 'POST',
            url: 'controller/ajax/ajax.form.php',
            data: {
                EditUser: user,
                firstname: firstname,
                lastname: lastname,
                email: email,
                projectSelectEdit: projectSelectEdit,
                teamSelectEdit: teamSelectEdit,
                level: level
            },
            dataSrc: '',
            success: function (response) {
                if (response == 'ok') {
                    $('#editUsersModal').modal('hide');
                    $('#users').DataTable().ajax.reload();
                    showAlertBootstrap(translations.success, translations.updateUser);
                } else {
                    $('#editUsersModal').modal('hide');
                    showAlertBootstrap1(translations.alert, translations.errorUpdateUser, 'editUsersModal');
                }
            }
        });
    });
    
    $('.accept').on('click', function () {
        var firstname = $('#firstnameAdd').val();
        var lastname = $('#lastnameAdd').val();
        var email = $('#emailAdd').val();
        var password = $('#password').val();
        var projectSelectEdit = $('#projectSelectEdit').val();
        var teamSelectEdit = $('#teamSelectEdit').val();
        var level = $('#level_user_edit').val();
        $.ajax({
            type: 'POST',
            url: 'controller/ajax/ajax.form.php',
            data: {
                createUser: 'ok',
                firstname: firstname,
                lastname: lastname,
                email: email,
                password: password,
                project: projectSelectEdit,
                team: teamSelectEdit,
                level: level
            },
            dataSrc: '',
            success: function (response) {
                if (response == 'ok') {
                    $('#addUsersModal').modal('hide');
                    $('#users').DataTable().ajax.reload();
                    showAlertBootstrap(translations.success, translations.updateUser);
                } else {
                    $('#addUsersModal').modal('hide');
                    showAlertBootstrap1(translations.alert, translations.errorUpdateUser, 'addUsersModal');
                }
            }
        });
    });

    
    $('.acceptDelete').on('click', function () {
        $deleteUser = $('#deleteUser').val();
        $.ajax({
            type: 'POST',
            url: 'controller/ajax/ajax.form.php',
            data: {
                DeleteUser: $deleteUser
            },
            dataSrc: '',
            success: function (response) {
                if (response == 'ok') {
                    $('#deleteUsersModal').modal('hide');
                    $('#users').DataTable().ajax.reload();
                    showAlertBootstrap(translations.success, translations.deleteUser);
                } else {
                    $('#deleteUsersModal').modal('hide');
                    showAlertBootstrap1(translations.alert, translations.errorDeleteUser, 'deleteUsersModal');
                }
            }
        });
    });
    
    // Configuración del evento 'sending' del Dropzone
	// myDropzone.on("sending", function(file, xhr, formData) {
    //     formData.append("projectSelect", projectSelect);
    //     formData.append("level_user", level_user);
    // });

    myDropzone.on("success", function(file, response) {
        
        $('#usersModal').modal('hide');
        if (response == 'ok') {
            $('#users').DataTable().ajax.reload();
            myDropzone.removeAllFiles();
            showAlertBootstrap(translations.success, translations.processedFile);
        } else {
            myDropzone.removeAllFiles();
            showAlertBootstrap1(translations.alert, translations.errorProcessedFileUpload + '<br>' + response, 'usersModal');
        }
    });

    var secondDropzone = new Dropzone("#deleteUsersDropzone", {
        maxFiles: 1,
        url: "controller/ajax/ajax.form.php",
        maxFilesize: 10,
        acceptedFiles: "text/csv",
        paramName: "deleteUserList",
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
                secondDropzone.removeFile(element);
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

    $('#DeleteMassiveButton').on('click', function () {
        secondDropzone.processQueue();
    });

    
    secondDropzone.on("success", function(file, response) {
        $('#deleteMassiveModal').modal('hide');
        if (response == 'ok') {
            $('#users').DataTable().ajax.reload();
            secondDropzone.removeAllFiles();
            showAlertBootstrap(translations.success, translations.processedFile);
        } else {
            secondDropzone.removeAllFiles();
            showAlertBootstrap1(translations.alert, translations.errorProcessedFile, 'usersModal');
        }
        
    });
    
});

function editUser(user) {

    $.ajax({
        type: 'POST',
        url: 'controller/ajax/ajax.form.php',
        data: {
            SearchUser: user
        },
        dataType: 'json',
        success: function (response) {
            if (response) {
                $(".teamSelectEdit").prop('disabled', true);
                $('#editUser').val(user);
                $('#editUsersModal').modal('show');
                $('.acceptEdit').html(translations.accept);
                $('.firstnameEdit').val(response.firstname);
                $('.lastnameEdit').val(response.lastname);
                $('.emailEdit').val(response.email);
                $('.projectSelectEdit').val(response.users_idProjects);
                $('.teamSelectEdit').val(response.users_idTeam);
                $('.level_user_edit').val(response.level);
            }
        },
        error: function (xhr, status, error) {
            // Manejar errores aquí
            console.error(xhr.responseText);
        }
    });
}

function deleteUser(user) {
    $('#deleteUser').val(user);
    $('#deleteUsersModal').modal('show');
    $.ajax({
        type: 'POST',
        url: 'controller/ajax/ajax.form.php',
        data: {
            SearchUser: user
        },
        dataType: 'json',
        success: function (response) {
            if (response) {
                $('.deleteMessage').html(translations.deleteMessage);
            }
        },
        error: function (xhr, status, error) {
            // Manejar errores aquí
            console.error(xhr.responseText);
        }
    });
}

$('#projectSelectEdit').on('change', async function() {
    var project = $('#projectSelectEdit').val();
    
    try {
        let response = await $.ajax({
            type: "POST",
            url: "controller/ajax/getTeams.php",
            data: {
                idProject: project
            },
            dataType: "json"
        });

        var html = '';
        var language = $('#language').val();
        await cargarTraducciones(language);

        html += `<option value="">${translations.select_one}</option>`;
        
        response.forEach(function(team) {
            html += '<option value="' + team.idTeam + '">' + team.teamName + '</option>';
        });
        
        $("#teamSelectEdit").prop('disabled', false);
        $("#teamSelectEdit").html(html);

    } catch (error) {
        console.error("Error en la solicitud AJAX:", error);
    }
});

$('.projectSelectEdit').on('change', async function() {
    var project = $('.projectSelectEdit').val();
    
    try {
        let response = await $.ajax({
            type: "POST",
            url: "controller/ajax/getTeams.php",
            data: {
                idProject: project
            },
            dataType: "json"
        });

        var html = '';
        var language = $('#language').val();
        await cargarTraducciones(language);

        html += `<option value="">${translations.select_one}</option>`;
        
        response.forEach(function(team) {
            html += '<option value="' + team.idTeam + '">' + team.teamName + '</option>';
        });
        
        $(".teamSelectEdit").prop('disabled', false);
        $(".teamSelectEdit").html(html);

    } catch (error) {
        console.error("Error en la solicitud AJAX:", error);
    }
});

$('.addUsersModal').on('click', function(e) {
    $("#teamSelectEdit").prop('disabled', true);
})