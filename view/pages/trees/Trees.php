    <style>
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #004d4d;
            font-weight: bold;
        }
        .segment-title {
            text-align: center;
            margin-top: 10px;
            font-size: 1.25rem;
            font-weight: bold;
            color: #004d4d;
        }
        .target-card {
            margin: 10px;
            border-radius: 10px;
            transition: transform 0.3s, box-shadow 0.3s;
            border: none;
            width: calc(25% - 20px); /* 4 target-cards per row */
        }
        .target-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }
        .target-card-body {
            padding: 15px;
            height: 5rem;
        }
        .target-card-text {
            font-size: 0.7rem;
            font-weight: bold;
            color: #fff;
        }
        .central {
            background-color: #004d4d;
            color: white;
        }
        .main-effect {
            background-color: #ff4d4d;
            color: white;
        }
        .effect-target-card {
            background-color: #ff6666;
            color: white;
        }
        .cause-target-card, .main-cause {
            background-color: #ff9999;
            color: white;
        }
        .main-result, .main-objective {
            background-color: #006666;
            color: white;
        }
        .result-target-card {
            background-color: #008080;
            color: white;
        }
        .action-target-card, .main-action {
            background-color: #ffa500;
            color: white;
        }
        .tree-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            background-color: #fff;
            border-radius: 16px;
        }
        .spacer {
            height: 30px;
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="float-end mb-3">
                <button class="btn btn-primary" onclick="chargerTree()">Cargar arból</button>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6">
                <h2>Árbol de Problemas</h2>
                <div class="segment-title">Main Effects</div>
                <div class="tree-container">
                    <div class="target-card main-effect">
                        <div class="target-card-body">
                            <p class="target-card-text"></p>
                        </div>
                    </div>
                    <div class="target-card main-effect">
                        <div class="target-card-body">
                            <p class="target-card-text"></p>
                        </div>
                    </div>
                    <div class="target-card main-effect">
                        <div class="target-card-body">
                            <p class="target-card-text"></p>
                        </div>
                    </div>
                    <div class="target-card main-effect">
                        <div class="target-card-body">
                            <p class="target-card-text"></p>
                        </div>
                    </div>
                </div>
                <div class="segment-title">Effects</div>
                <div class="tree-container">
                    <div class="target-card effect-target-card">
                        <div class="target-card-body">
                            <p class="target-card-text"></p>
                        </div>
                    </div>
                    <div class="target-card effect-target-card">
                        <div class="target-card-body">
                            <p class="target-card-text"></p>
                        </div>
                    </div>
                    <div class="target-card effect-target-card">
                        <div class="target-card-body">
                            <p class="target-card-text"></p>
                        </div>
                    </div>
                    <div class="target-card effect-target-card">
                        <div class="target-card-body">
                            <p class="target-card-text"></p>
                        </div>
                    </div>
                </div>
                <div class="segment-title">Central Problem</div>
                <div class="tree-container">
                    <div class="target-card central" style="width: calc(100% - 20px);">
                        <div class="target-card-body">
                            <p class="target-card-text"></p>
                        </div>
                    </div>
                </div>
                <div class="segment-title">Causes</div>
                <div class="tree-container">
                    <div class="target-card cause-target-card">
                        <div class="target-card-body">
                            <p class="target-card-text"></p>
                        </div>
                    </div>
                    <div class="target-card cause-target-card">
                        <div class="target-card-body">
                            <p class="target-card-text"></p>
                        </div>
                    </div>
                    <div class="target-card cause-target-card">
                        <div class="target-card-body">
                            <p class="target-card-text"></p>
                        </div>
                    </div>
                    <div class="target-card cause-target-card">
                        <div class="target-card-body">
                            <p class="target-card-text"></p>
                        </div>
                    </div>
                </div>
                <div class="segment-title">Main Causes</div>
                <div class="tree-container">
                    <div class="target-card main-cause">
                        <div class="target-card-body">
                            <p class="target-card-text"></p>
                        </div>
                    </div>
                    <div class="target-card main-cause">
                        <div class="target-card-body">
                            <p class="target-card-text"></p>
                        </div>
                    </div>
                    <div class="target-card main-cause">
                        <div class="target-card-body">
                            <p class="target-card-text"></p>
                        </div>
                    </div>
                    <div class="target-card main-cause">
                        <div class="target-card-body">
                            <p class="target-card-text"></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6">
                <h2>Árbol de Objetivos</h2>
                <div class="segment-title">Main Results</div>
                <div class="tree-container">
                    <div class="target-card main-result">
                        <div class="target-card-body">
                            <p class="target-card-text"></p>
                        </div>
                    </div>
                    <div class="target-card main-result">
                        <div class="target-card-body">
                            <p class="target-card-text"></p>
                        </div>
                    </div>
                    <div class="target-card main-result">
                        <div class="target-card-body">
                            <p class="target-card-text"></p>
                        </div>
                    </div>
                    <div class="target-card main-result">
                        <div class="target-card-body">
                            <p class="target-card-text"></p>
                        </div>
                    </div>
                </div>
                <div class="segment-title">Results</div>
                <div class="tree-container">
                    <div class="target-card result-target-card">
                        <div class="target-card-body">
                            <p class="target-card-text"></p>
                        </div>
                    </div>
                    <div class="target-card result-target-card">
                        <div class="target-card-body">
                            <p class="target-card-text"></p>
                        </div>
                    </div>
                    <div class="target-card result-target-card">
                        <div class="target-card-body">
                            <p class="target-card-text"></p>
                        </div>
                    </div>
                    <div class="target-card result-target-card">
                        <div class="target-card-body">
                            <p class="target-card-text"></p>
                        </div>
                    </div>
                </div>
                <div class="segment-title">Main Objective</div>
                <div class="tree-container">
                    <div class="target-card main-objective" style="width: calc(100% - 20px);">
                        <div class="target-card-body">
                            <p class="target-card-text"></p>
                        </div>
                    </div>
                </div>
                <div class="segment-title">Actions</div>
                <div class="tree-container">
                    <div class="target-card action-target-card">
                        <div class="target-card-body">
                            <p class="target-card-text"></p>
                        </div>
                    </div>
                    <div class="target-card action-target-card">
                        <div class="target-card-body">
                            <p class="target-card-text"></p>
                        </div>
                    </div>
                    <div class="target-card action-target-card">
                        <div class="target-card-body">
                            <p class="target-card-text"></p>
                        </div>
                    </div>
                    <div class="target-card action-target-card">
                        <div class="target-card-body">
                            <p class="target-card-text"></p>
                        </div>
                    </div>
                </div>
                <div class="segment-title">Main Actions</div>
                <div class="tree-container">
                    <div class="target-card main-action">
                        <div class="target-card-body">
                            <p class="target-card-text"></p>
                        </div>
                    </div>
                    <div class="target-card main-action">
                        <div class="target-card-body">
                            <p class="target-card-text"></p>
                        </div>
                    </div>
                    <div class="target-card main-action">
                        <div class="target-card-body">
                            <p class="target-card-text"></p>
                        </div>
                    </div>
                    <div class="target-card main-action">
                        <div class="target-card-body">
                            <p class="target-card-text"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- Add users -->
<div class="modal fade" id="treeModal" tabindex="-1" aria-labelledby="treeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title addTrees_btn" id="treeModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                
                <!-- Botón para descargar plantilla de ejemplo -->
                <div class="form-group mt-3">
                    <a type="button" class="btn btn-primary download_template" download="Tree_template.csv" href="assets/documents/Tree_template.csv"></a>
                </div>
                <!-- Dropzone para cargar archivos -->
                <div class="col-md-12">
                    <div id="addTreeDropzone" class="dropzone"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger cancel" data-bs-dismiss="modal"></button>
                <button type="button" class="btn btn-success accept" id="sendButton"></button>
            </div>
        </div>
    </div>
</div>