<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkbox Limit</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }
        .border-result {
            border: 1px solid #ccc;
            padding: 20px;
            margin-top: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .form-check-inline {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }
        .form-check {
            margin: 10px 0;
        }
        .form-check-label {
            margin-left: 5px;
        }
        .btn-primary {
            margin-top: 20px;
            background-color: #007bff;
            border-color: #007bff;
            transition: background-color 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
    </style>
</head>
<body>
    <div class="container selectStructure">
        <!-- Main Results -->
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-result">
                    <form>
                        <p class="font-weight-bold">Selecciona 2 problemas a resolver:</p>
                        <div class="row">
                            <div class="col-12 form-check-inline">
                                <div class="form-check">
                                    <input type="checkbox" id="nameMain01" class="form-check-input" onclick="limitCheckboxes()">
                                    <label for="nameMain01" class="form-check-label nameMain01">Option 1</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" id="nameMain02" class="form-check-input" onclick="limitCheckboxes()">
                                    <label for="nameMain02" class="form-check-label nameMain02">Option 2</label>
                                </div>
                            </div>
                            <div class="col-12 form-check-inline">
                                <div class="form-check">
                                    <input type="checkbox" id="nameMain03" class="form-check-input" onclick="limitCheckboxes()">
                                    <label for="nameMain03" class="form-check-label nameMain03">Option 3</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" id="nameMain04" class="form-check-input" onclick="limitCheckboxes()">
                                    <label for="nameMain04" class="form-check-label nameMain04">Option 4</label>
                                </div>
                            </div>
                        </div>
                    </form>
                    <button class="btn btn-primary"><i class="fas fa-paper-plane"></i> Enviar</button>
                </div>
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
