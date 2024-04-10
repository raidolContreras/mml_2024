
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
?>

<script>
	
function showAlertBootstrap(title, message) {
    var accept = translations.accept; // Usar las traducciones cargadas
    $('#modalLabel').text(title);
    $('.modal-body-extra').html(message);
    $('.modal-footer-extra').html('<button type="button" class="btn btn-success" data-bs-dismiss="modal">'+accept+'</button>');
    $('#alertModal').modal('show');
}
</script>