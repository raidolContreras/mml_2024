<style>
    .card.border-warning,
    .activity-btn {
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
    .Structure {
        display: none;
    }
</style>

<div class="row mb-4">
    <div class="col-md-6 offset-md-3">
        <label for="teamSelectEdit" class="form-label teams"></label>
        <select class="form-select" id="teamSelectEdit">
        </select>
    </div>
</div>
<div class="container Structure">
    <!-- Main Results -->
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card border-result">
                <div class="card-header bg-result text-white">Main Result</div>
                <div class="card-body bg-light-green"></div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card border-result">
                <div class="card-header bg-result text-white">Main Result</div>
                <div class="card-body bg-light-green"></div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="arrow">↓</div>
        </div>
        <div class="col-md-5">
            <div class="arrow">↓</div>
        </div>
    </div>
    <!-- Main Objectives -->
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card border-objetive">
                <div class="card-header bg-objetive text-white">Main Objective</div>
                <div class="card-body bg-light-blue"></div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card border-objetive">
                <div class="card-header bg-objetive text-white">Main Objective</div>
                <div class="card-body bg-light-blue"></div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="arrow">↓</div>
        </div>
        <div class="col-md-5">
            <div class="arrow">↓</div>
        </div>
    </div>
    <!-- Actions -->
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card border-action">
                <div class="card-header bg-action text-white">Action</div>
                <div class="card-body bg-light-red"></div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card border-action">
                <div class="card-header bg-action text-white">Action</div>
                <div class="card-body bg-light-red"></div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="arrow">↓</div>
        </div>
        <div class="col-md-5">
            <div class="arrow">↓</div>
        </div>
    </div>
    <!-- Main Actions -->
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card border-danger">
                <div class="card-header bg-danger text-white">Main Action</div>
                <div class="card-body bg-light-red"></div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card border-danger">
                <div class="card-header bg-danger text-white">Main Action</div>
                <div class="card-body bg-light-red"></div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="arrow">↓</div>
        </div>
        <div class="col-md-5">
            <div class="arrow">↓</div>
        </div>
    </div>
    <!-- Products -->
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card border-product">
                <div class="card-header bg-product text-white">Product</div>
                <div class="card-body bg-light-yellow"></div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card border-product">
                <div class="card-header bg-product text-white">Product</div>
                <div class="card-body bg-light-yellow"></div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="arrow">↓</div>
        </div>
        <div class="col-md-5">
            <div class="arrow">↓</div>
        </div>
    </div>
    <!-- Activities -->
    <div class="row justify-content-center">
        <div class="col-md-3">
            <div class="card activity-btn">
                <div class="card-header bg-cause">Activity</div>
                <div class="card-body"></div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card activity-btn">
                <div class="card-header bg-cause">Activity</div>
                <div class="card-body"></div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card activity-btn">
                <div class="card-header bg-cause">Activity</div>
                <div class="card-body"></div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card activity-btn">
                <div class="card-header bg-cause">Activity</div>
                <div class="card-body"></div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-3">
            <div class="card activity-btn">
                <div class="card-header bg-cause">Activity</div>
                <div class="card-body"></div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card activity-btn">
                <div class="card-header bg-cause">Activity</div>
                <div class="card-body"></div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card activity-btn">
                <div class="card-header bg-cause">Activity</div>
                <div class="card-body"></div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card activity-btn">
                <div class="card-header bg-cause">Activity</div>
                <div class="card-body"></div>
            </div>
        </div>
    </div>
</div>
