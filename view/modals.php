
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

<?php if (isset ($_SESSION['changePass']) && $_SESSION['changePass'] != 0):?>

<!-- Bootstrap Modal for Password Change -->
<div class="modal fade" id="passwordChangeModal" tabindex="-1" aria-labelledby="passwordChangeModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="passwordChangeModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="passwordChangeForm">
                    <div class="mb-3">
                        <label for="newPassword" class="form-label" id="newPasswordLabel"></label>
                        <input type="password" class="form-control" id="newPassword" name="newPassword" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger cancel" data-bs-dismiss="modal"></button>
                <button type="button" class="btn btn-success accept" id="changePassBtn"></button>
            </div>
        </div>
    </div>
</div>


<?php endif ?>