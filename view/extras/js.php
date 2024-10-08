
</div>
        </div>

<!-- Library Bundle Script -->
<script src="assets/js/core/libs.min.js"></script>

<!-- External Library Bundle Script -->
<script src="assets/js/core/external.min.js"></script>

<!-- Widgetchart Script -->
<script src="assets/js/charts/widgetcharts.js"></script>

<!-- mapchart Script -->
<script src="assets/js/charts/vectore-chart.js"></script>
<script src="assets/js/charts/dashboard.js" ></script>

<!-- fslightbox Script -->
<script src="assets/js/plugins/fslightbox.js"></script>

<!-- Settings Script -->
<script src="assets/js/plugins/setting.js"></script>

<!-- Slider-tab Script -->
<script src="assets/js/plugins/slider-tabs.js"></script>

<!-- Form Wizard Script -->
<script src="assets/js/plugins/form-wizard.js"></script>

<!-- AOS Animation Plugin-->

<!-- App Script -->
<script src="assets/js/hope-ui.js" defer></script>

<script src="https://kit.fontawesome.com/f4781c35cc.js" crossorigin="anonymous"></script>

<?php
    if($pagina == 'Admin'){
        echo '<script src="assets/js/ajax_request/adminSettings.js"></script>';
    } elseif($pagina == 'Users') {
        echo '<script src="assets/vendor/dropzone/dropzone-min.js"></script>';
        echo '<script src="assets/js/ajax_request/getUsers.js"></script>';
        echo '<script src="assets/js/ajax_request/getProjectsSelects.js"></script>';
    } elseif($pagina == 'Projects') {
        echo '<script src="assets/vendor/dropzone/dropzone-min.js"></script>';
        echo '<script src="assets/js/ajax_request/getProjects.js"></script>';
        echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/mdbassit/Coloris@latest/dist/coloris.min.css"/>';
        echo '<script src="https://cdn.jsdelivr.net/gh/mdbassit/Coloris@latest/dist/coloris.min.js"></script>';
    } elseif($pagina == 'Teams') {
        echo '<script src="assets/js/ajax_request/getTeams.js"></script>';
        echo '<script src="assets/js/ajax_request/getProjectsSelects.js"></script>';
    } elseif($pagina == 'EventSettings') {
        echo '<script src="assets/js/ajax_request/getEvents.js"></script>';
    } elseif($pagina == 'Team') {
        echo '<script src="assets/vendor/dropzone/dropzone-min.js"></script>';
        if ($_SESSION['level'] == 1) {
            echo '<script src="assets/js/ajax_request/getTeamTeacher.js"></script>';
        } else {
            echo '<script src="assets/js/ajax_request/getTeamsSelects.js"></script>';
            echo '<script src="assets/js/ajax_request/addParticipants.js"></script>';
        }
    } elseif($pagina == 'Trees') {
        echo '<script src="assets/vendor/dropzone/dropzone-min.js"></script>';
        echo '<script src="assets/js/ajax_request/trees.js"></script>';
        echo '<script src="assets/js/ajax_request/getTeamsSelects.js"></script>';
    } elseif($pagina == 'Matriz') {
        echo '<script src="assets/js/ajax_request/getTeamsSelects.js"></script>';
        echo '<script src="assets/js/ajax_request/matrix.js"></script>';
    } elseif($pagina == 'Structure') {
        echo '<script src="assets/js/ajax_request/structure.js"></script>';
        echo '<script src="assets/js/ajax_request/getTeamsSelects.js"></script>';
    } elseif($pagina == 'Reports') {
        echo '<script src="assets/vendor/dropzone/dropzone-min.js"></script>';
        echo '<script src="assets/js/ajax_request/reports.js"></script>';
        echo '<script src="assets/js/ajax_request/getTeamsSelects.js"></script>';
    } elseif($pagina == 'Events') {
        echo '<script src="assets/js/ajax_request/getEventsSelects.js"></script>';
        echo '<script src="assets/vendor/dropzone/dropzone-min.js"></script>';
        echo '<script src="assets/js/ajax_request/events.js"></script>';
        echo '<script src="assets/js/ajax_request/getTeamsSelects.js"></script>';
    } elseif($pagina == 'Summary') {
        echo '<script src="assets/js/ajax_request/getTeamsSelects.js"></script>';
        echo '<script src="assets/js/ajax_request/summary.js"></script>';
    } 
    include 'view/extras/language.php';
?>

<script>

$(document).ready(function () {
    checkPassword();
    $('#changePassBtn').on('click', function () {
        var newPassword = $('#newPassword').val();

        if (newPassword.length < 8) {
            showAlert2('Error', translations.password_length_error, 'passwordChangeModal');
            return false;
        } else {
            let idUser = $('#user').val();
            $.ajax({
                type: "POST",
                url: "controller/ajax/ajax.form.php",
                data: { newPassword: newPassword, idUser: idUser },
                success: function (response) {
                    if (response == 'ok') {
                        $('#passwordChangeModal').modal('hide');
                        showAlertBootstrap(translations.success, translations.password_change_success);
                    } else {
                        $('#passwordChangeModal').modal('hide');
                        showAlert2(translations.alert, translations.password_change_error, 'passwordChangeModal');
                    }
                }
            });
        }
    });
});

function showAlert2(title, message, modalId) {
    var accept = translations.accept; // Usar las traducciones cargadas
    $('#modalLabel').text(title); // Cambiar el título del modal
    $('.modal-body-extra').html(message); // Cambiar el contenido del cuerpo del modal
    $('.modal-footer-extra').html('<button type="button" class="btn btn-success" data-bs-dismiss="modal">' + accept + '</button>');

    // Mostrar el modal de alerta
    $('#alertModal').modal('show');

    // Añadir evento click al botón de aceptar
    $('.modal-footer-extra .btn-success').on('click', function() {
        // Cerrar el modal de alerta
        $('#alertModal').modal('hide');

        // Mostrar el modal especificado por su ID
        $('#' + modalId).modal('show');
    });
}

function showAlertBootstrap(title, message) {
    var accept = translations.accept; // Usar las traducciones cargadas
    $('#modalLabel').text(title);
    $('.modal-body-extra').html(message);
    $('.modal-footer-extra').html('<button type="button" class="btn btn-success" data-bs-dismiss="modal">'+accept+'</button>');
    $('#alertModal').modal('show');
}


function showAlertBootstrap1(title, message, id) {
    var accept = translations.accept; // Asegúrate de que las traducciones estén cargadas correctamente
    $('#modalLabel').text(title);
    $('.modal-body-extra').html(message);
    $('.modal-footer-extra').html('<button type="button" class="btn btn-success" data-bs-dismiss="modal" onclick="showModal(\'' + id + '\')">' + accept + '</button>');
    $('#alertModal').modal('show');
}

function showAlertBootstrap2(title, message, adress) {
    var accept = translations.accept;
    $('#modalLabel').text(title);
    $('.modal-body-extra').html(message);
    $('.modal-footer-extra').html('<button type="button" class="btn btn-success" onclick="window.location.href=\''+ adress +'\'">' + accept + '</button>');
    $('#alertModal').modal('show');
}

function logout() {
    // Realiza la solicitud Ajax para cerrar la sesión
    $.ajax({
        type: "POST",
        url: "controller/ajax/logout.php", // Cambia esto con la ruta correcta a tu script de logout
        success: function (response) {
            // Redirige a la página de inicio después de cerrar sesión
            window.location.href = './';
        },
        error: function (error) {
            console.log("Error en la solicitud Ajax:", error);
        }
    });
}

function showModal(id) {
    $('#' + id).modal('show');
}

function checkPassword() {
    if ($('#changePass').val() == 1) {
        $('#passwordChangeModal').modal('show');
    }
}

</script>