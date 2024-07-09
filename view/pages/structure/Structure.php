<style>
    .card.border-warning,
    .activity-btn,
    .product_btn {
        cursor: pointer;
    }

    .card-header {
        font-weight: bold;
        text-align: center;
        padding: 0 !important;
    }
    .card {
        margin-bottom: 15px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    }
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0,0,0,0.2);
    }
    .card-body {
        text-align: center;
        padding: 0.5rem;
    }
    .arrow {
        text-align: center;
        font-size: 24px;
        color: #6c757d;
        animation: bounce 4s infinite;
    }
    @keyframes bounce {
        0%, 20%, 50%, 80%, 100% {
            transform: translateY(0);
        }
        40% {
            transform: translateY(-10px);
        }
        60% {
            transform: translateY(-5px);
        }
    }
    
    .bg-danger {
        background-color:  <?php echo $project['problem'] ?> !important;
    }
    .bg-action {
        background-color:  <?php echo $project['action'] ?> !important;
    }
    .bg-objetive {
        background-color:  <?php echo $project['objetive'] ?> !important;
    }
    .bg-result {
        background-color:  <?php echo $project['result'] ?> !important;
    }
    .bg-product {
        background-color:  <?php echo $project['product'] ?> !important;
    }
    .bg-cause {
        background-color:  <?php echo $project['cause'] ?> !important;
        color: #f3f3f3;
    }
    .step-container {
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .Structure, .selectStructure, .completeTree {
        display: none;
    }
</style>

<div class="row mb-4 teamSelect">
    <div class="col-md-6 offset-md-3">
        <label for="teamSelectEdit" class="form-label teams"></label>
        <select class="form-select" id="teamSelectEdit">
        </select>
    </div>
</div>

<?php
    include 'structureTable.php';
    include 'selectProblem.php';
?>

<div class="modal fade modal2" id="editModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabelEdit"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body modal-body-edit">
                <label for="columnName" class="EditField"></label>
                <input type="text" class="form-control" id="value">
                <input type="hidden" id="columnName">
                <input type="hidden" id="idStructure">
            </div>
            <div class="modal-footer modal-footer-edit">
                <button type="button" class="btn btn-danger cancel" data-bs-dismiss="modal"></button>
                <button type="button" class="btn btn-success accept" id="editButton"></button>
            </div>
        </div>
    </div>
</div>