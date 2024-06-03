<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkbox Limit</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .border-result {
            border: 1px solid #ccc;
            padding: 20px;
            margin-top: 20px;
        }
        .form-check-inline {
            display: flex;
            align-items: center;
            margin-right: 20px;
        }
        .form-check-label {
            margin-left: 5px;
        }
    </style>
</head>
<body>
    <div class="container selectStructure">
        <!-- Main Results -->
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card border-result">
                    <form>
                        <p>Selecciona 2 problemas a resolver:</p>
                        <div class="form-check-inline">
                            <div class="form-check">
                                <input type="checkbox" id="nameMain01" class="form-check-input" onclick="limitCheckboxes()">
                                <label for="nameMain01" class="form-check-label nameMain01">Option 1</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" id="nameMain02" class="form-check-input" onclick="limitCheckboxes()">
                                <label for="nameMain02" class="form-check-label nameMain02">Option 2</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" id="nameMain03" class="form-check-input" onclick="limitCheckboxes()">
                                <label for="nameMain03" class="form-check-label nameMain03">Option 3</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" id="nameMain04" class="form-check-input" onclick="limitCheckboxes()">
                                <label for="nameMain04" class="form-check-label nameMain04">Option 4</label>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-1">
                <button class="btn btn-primary"><i class="fa-light fa-paper-plane-top"></i></button>
            </div>
        </div>
    </div>

    <script>
        function limitCheckboxes() {
            const checkboxes = document.querySelectorAll('.form-check-input');
            let checkedCount = 0;

            checkboxes.forEach(checkbox => {
                if (checkbox.checked) {
                    checkedCount++;
                }
            });

            if (checkedCount >= 2) {
                checkboxes.forEach(checkbox => {
                    if (!checkbox.checked) {
                        checkbox.disabled = true;
                    }
                });
            } else {
                checkboxes.forEach(checkbox => {
                    checkbox.disabled = false;
                });
            }
        }
    </script>
</body>
</html>
