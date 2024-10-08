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
                        <p class="font-weight-bold message_Select_mainActions"></p>
                        <div>
                            <div>
                                <div class="form-check">
                                    <input type="checkbox" id="mainAction01" class="form-check-input" onclick="limitCheckboxes()">
                                    <label for="mainAction01" class="form-check-label mainAction01"></label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" id="mainAction02" class="form-check-input" onclick="limitCheckboxes()">
                                    <label for="mainAction02" class="form-check-label mainAction02"></label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" id="mainAction03" class="form-check-input" onclick="limitCheckboxes()">
                                    <label for="mainAction03" class="form-check-label mainAction03"></label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" id="mainAction04" class="form-check-input" onclick="limitCheckboxes()">
                                    <label for="mainAction04" class="form-check-label mainAction04"></label>
                                </div>
                            </div>
                            <input type="hidden" id="mainGoals">
                        </div>
                    </form>
                    <button class="btn btn-primary send_Selections_btn" disabled><i class="fa-light fa-paper-plane-top"></i> <span class="send_Selections"></span></button>
                </div>
            </div>
        </div>
    </div>

    <div class="container completeTree">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-result shadow-sm mt-4">
                    <div class="row">
                        <div class="col-12">
                            <div class="alert alert-danger text-center mt-3 message_complete_tree">
                                
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center mb-3">
                        <div class="col-8 text-center">
                            <a class="btn btn-primary send_selections_btn" href="Trees">
                                <i class="fa-light fa-paper-plane-top"></i> <span class="go_trees">Ir al árbol de objetivos</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>