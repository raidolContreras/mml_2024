    <style>
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
    <div class="container selectStructure">
        <!-- Main Results -->
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-result">
                    <form>
                        <p class="font-weight-bold message_Select_Problems"></p>
                        <div class="row">
                            <div class="col-12 form-check-inline">
                                <div class="form-check">
                                    <input type="checkbox" id="nameMain01" class="form-check-input" onclick="limitCheckboxes()">
                                    <label for="nameMain01" class="form-check-label nameMain01"></label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" id="nameMain02" class="form-check-input" onclick="limitCheckboxes()">
                                    <label for="nameMain02" class="form-check-label nameMain02"></label>
                                </div>
                            </div>
                            <div class="col-12 form-check-inline">
                                <div class="form-check">
                                    <input type="checkbox" id="nameMain03" class="form-check-input" onclick="limitCheckboxes()">
                                    <label for="nameMain03" class="form-check-label nameMain03"></label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" id="nameMain04" class="form-check-input" onclick="limitCheckboxes()">
                                    <label for="nameMain04" class="form-check-label nameMain04"></label>
                                </div>
                            </div>
                        </div>
                    </form>
                    <button class="btn btn-primary send_Selections_btn"><i class="fa-light fa-paper-plane-top"></i> <span class="send_Selections"></span></button>
                </div>
            </div>
        </div>
    </div>
