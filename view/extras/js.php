
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

<?php
    if($pagina == 'Admin'){
        echo '<script src="assets/js/ajax_request/adminSettings.js"></script>';
        echo '<script src="assets/js/ajax_request/getProjectsSelects.js"></script>';
    } elseif($pagina == 'Users') {
        // Importar librerías de Dropzone
        echo '<script src="assets/vendor/dropzone/dropzone-min.js"></script>';
        echo '<script src="assets/js/ajax_request/getUsers.js"></script>';
        echo '<script src="assets/js/ajax_request/getProjectsSelects.js"></script>';
        echo '<script src="assets/js/ajax_request/getTeamsSelects.js"></script>';
    } elseif($pagina == 'Projects') {
        // Importar librerías de Dropzone
        echo '<script src="assets/vendor/dropzone/dropzone-min.js"></script>';
        echo '<script src="assets/js/ajax_request/getProjects.js"></script>';
        echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/mdbassit/Coloris@latest/dist/coloris.min.css"/>';
        echo '<script src="https://cdn.jsdelivr.net/gh/mdbassit/Coloris@latest/dist/coloris.min.js"></script>';
    } elseif($pagina == 'Teams') {
        // Importar librerías de Dropzone
        echo '<script src="assets/js/ajax_request/getTeams.js"></script>';
    } elseif($pagina == 'EventSettings') {
        // Importar librerías de Dropzone
        echo '<script src="assets/js/ajax_request/getEvents.js"></script>';
    }
    include 'view/extras/language.php';
?>

<script>
	
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


</script>