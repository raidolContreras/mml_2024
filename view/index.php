
<?php
    session_start();
?>
<!doctype html>
<html dir="ltr">
    
<title>Edradix | MML <?php echo $_GET['pagina'] ?? 'Dashboard'; ?></title>
    
    <?php
        include 'extras/css.php';
        include 'whiteList.php';
        include 'extras/js.php';
    ?>
        
<!-- Bootstrap Modal for Alerts -->
<div class="modal fade modal2" id="alertModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Alert</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body modal-body-extra">
                Alert message.
            </div>
            <div class="modal-footer modal-footer-extra">
            </div>
        </div>
    </div>
</div>

    </body>
</html>