
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
     include 'view/extras/languaje.php';
     if($pagina == 'Admin'){
        echo '<script src="assets/js/ajax_request/adminSettings.js"></script>';
     } 
?>

<script>
	
function showAlertBootstrap(title, message) {
    var accept = translations.accept; // Usar las traducciones cargadas
    $('#modalLabel').text(title);
    $('.modal-body-extra').html(message);
    $('.modal-footer-extra').html('<button type="button" class="btn btn-success" data-bs-dismiss="modal">'+accept+'</button>');
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

</script>