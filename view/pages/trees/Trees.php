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
            cursor: pointer !important;
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
            font-size: 0.9rem;
            color: #fff;
        }
        
        .central {
            background-color:  <?php echo $project['problem'] ?> !important;
            color: white;
        }
        .effect-target-card {
            background-color:  <?php echo $project['effect'] ?> !important;
            color: white;
        }
        .action-target-card, .main-action {
            background-color:  <?php echo $project['action'] ?> !important;
            color: white;
        }
        .main-objective {
            background-color:  <?php echo $project['objetive'] ?> !important;
            color: white;
        }
        .main-result, .result-target-card {
            background-color:  <?php echo $project['result'] ?> !important;
            color: white;
        }
        .bg-product {
            background-color:  <?php echo $project['product'] ?> !important;
            color: white;
        }
        .cause-target-card, .main-cause {
            background-color:  <?php echo $project['cause'] ?> !important;
            color: white;
        }
        .main-effect {
            background-color:  <?php echo $project['effect'] ?> !important;
            color: #f3f3f3;
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

        .Comments,
        .CommentsList,
        .chargerTree {
            display: none;
        }

        .comment-item {
            background-color: #fff;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .comment-text {
            font-size: 1rem;
            color: #333;
        }

        .comment-actions {
            margin-left: auto;
        }

        .comment-actions .btn {
            margin-left: 10px;
        }

        .comment-actions .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }

        .comment-actions .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }
    </style>
</head>
<body>
    <div class="container">
        
        <div class="row mb-4 teamSelect">
            <div class="col-md-6 offset-md-3">
                <label for="teamSelectEdit" class="form-label teams"></label>
                <select class="form-select" id="teamSelectEdit">
                </select>
            </div>
        </div>
        <div class="row Comments">
            <div class="float-end mb-3">
                <button class="btn btn-primary mb-4" id="Comment" data-bs-toggle="modal" data-bs-target="#commetModal" onclick="openComment()">Agregar Comentario</button>
            </div>
        </div>
        <div class="row chargerTree">
            <div class="col-12 col-md-6">
                <h2 class="problem_tree"></h2>
                <div class="segment-title main_effects"></div>
                <div class="tree-container">
                    <div class="target-card main-effect" data-text="nameMain01" data-tree="main_problems" data-name="Main Effects">
                        <div class="target-card-body">
                            <p class="target-card-text nameMain01"></p>
                        </div>
                    </div>
                    <div class="target-card main-effect" data-text="nameMain02" data-tree="main_problems" data-name="Main Effects">
                        <div class="target-card-body">
                            <p class="target-card-text nameMain02"></p>
                        </div>
                    </div>
                    <div class="target-card main-effect" data-text="nameMain03" data-tree="main_problems" data-name="Main Effects">
                        <div class="target-card-body">
                            <p class="target-card-text nameMain03"></p>
                        </div>
                    </div>
                    <div class="target-card main-effect" data-text="nameMain04" data-tree="main_problems" data-name="Main Effects">
                        <div class="target-card-body">
                            <p class="target-card-text nameMain04"></p>
                        </div>
                    </div>
                </div>
                <div class="segment-title effects">Effects</div>
                <div class="tree-container">
                    <div class="target-card effect-target-card" data-text="nameEffect01" data-tree="main_problems" data-name="Effects">
                        <div class="target-card-body">
                            <p class="target-card-text nameEffect01"></p>
                        </div>
                    </div>
                    <div class="target-card effect-target-card" data-text="nameEffect02" data-tree="main_problems" data-name="Effects">
                        <div class="target-card-body">
                            <p class="target-card-text nameEffect02"></p>
                        </div>
                    </div>
                    <div class="target-card effect-target-card" data-text="nameEffect03" data-tree="main_problems" data-name="Effects">
                        <div class="target-card-body">
                            <p class="target-card-text nameEffect03"></p>
                        </div>
                    </div>
                    <div class="target-card effect-target-card" data-text="nameEffect04" data-tree="main_problems" data-name="Effects">
                        <div class="target-card-body">
                            <p class="target-card-text nameEffect04"></p>
                        </div>
                    </div>
                </div>
                <div class="segment-title central_problem"></div>
                <div class="tree-container">
                    <div class="target-card central" style="width: calc(100% - 20px);" data-text="centralProblem" data-tree="main_problems" data-name="Central Problem">
                        <div class="target-card-body">
                            <p class="target-card-text centralProblem"></p>
                        </div>
                    </div>
                </div>
                <div class="segment-title causes"></div>
                <div class="tree-container">
                    <div class="target-card cause-target-card" data-text="causes01" data-tree="main_problems" data-name="Causes">
                        <div class="target-card-body">
                            <p class="target-card-text causes01"></p>
                        </div>
                    </div>
                    <div class="target-card cause-target-card" data-text="causes02" data-tree="main_problems" data-name="Causes">
                        <div class="target-card-body">
                            <p class="target-card-text causes02"></p>
                        </div>
                    </div>
                    <div class="target-card cause-target-card" data-text="causes03" data-tree="main_problems" data-name="Causes">
                        <div class="target-card-body">
                            <p class="target-card-text causes03"></p>
                        </div>
                    </div>
                    <div class="target-card cause-target-card" data-text="causes04" data-tree="main_problems" data-name="Causes">
                        <div class="target-card-body">
                            <p class="target-card-text causes04"></p>
                        </div>
                    </div>
                </div>
                <div class="segment-title main_causes"></div>
                <div class="tree-container">
                    <div class="target-card main-cause" data-text="mainCauses01" data-tree="main_problems" data-name="Main Causes">
                        <div class="target-card-body">
                            <p class="target-card-text mainCauses01"></p>
                        </div>
                    </div>
                    <div class="target-card main-cause" data-text="mainCauses02" data-tree="main_problems" data-name="Main Causes">
                        <div class="target-card-body">
                            <p class="target-card-text mainCauses02"></p>
                        </div>
                    </div>
                    <div class="target-card main-cause" data-text="mainCauses03" data-tree="main_problems" data-name="Main Causes">
                        <div class="target-card-body">
                            <p class="target-card-text mainCauses03"></p>
                        </div>
                    </div>
                    <div class="target-card main-cause" data-text="mainCauses04" data-tree="main_problems" data-name="Main Causes">
                        <div class="target-card-body">
                            <p class="target-card-text mainCauses04"></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6">
                <h2 class="goal_tree"></h2>
                <div class="segment-title main_results"></div>
                <div class="tree-container">
                    <div class="target-card main-result" data-text="mainResult01" data-tree="main_goals" data-name="Main Results">
                        <div class="target-card-body">
                            <p class="target-card-text mainResult01"></p>
                        </div>
                    </div>
                    <div class="target-card main-result" data-text="mainResult02" data-tree="main_goals" data-name="Main Results">
                        <div class="target-card-body">
                            <p class="target-card-text mainResult02"></p>
                        </div>
                    </div>
                    <div class="target-card main-result" data-text="mainResult03" data-tree="main_goals" data-name="Main Results">
                        <div class="target-card-body">
                            <p class="target-card-text mainResult03"></p>
                        </div>
                    </div>
                    <div class="target-card main-result" data-text="mainResult04" data-tree="main_goals" data-name="Main Results">
                        <div class="target-card-body">
                            <p class="target-card-text mainResult04"></p>
                        </div>
                    </div>
                </div>
                <div class="segment-title results"></div>
                <div class="tree-container">
                    <div class="target-card result-target-card" data-text="result01" data-tree="main_goals" data-name="Results">
                        <div class="target-card-body">
                            <p class="target-card-text result01"></p>
                        </div>
                    </div>
                    <div class="target-card result-target-card" data-text="result02" data-tree="main_goals" data-name="Results">
                        <div class="target-card-body">
                            <p class="target-card-text result02"></p>
                        </div>
                    </div>
                    <div class="target-card result-target-card" data-text="result03" data-tree="main_goals" data-name="Results">
                        <div class="target-card-body">
                            <p class="target-card-text result03"></p>
                        </div>
                    </div>
                    <div class="target-card result-target-card" data-text="result04" data-tree="main_goals" data-name="Results">
                        <div class="target-card-body">
                            <p class="target-card-text result04"></p>
                        </div>
                    </div>
                </div>
                <div class="segment-title main_objetive"></div>
                <div class="tree-container">
                    <div class="target-card main-objective" style="width: calc(100% - 20px);" data-text="mainObjetive" data-tree="main_goals" data-name="Main Objective">
                        <div class="target-card-body">
                            <p class="target-card-text mainObjetive"></p>
                        </div>
                    </div>
                </div>
                <div class="segment-title actions"></div>
                <div class="tree-container">
                    <div class="target-card action-target-card" data-text="action01" data-tree="main_goals" data-name="Actions">
                        <div class="target-card-body">
                            <p class="target-card-text action01"></p>
                        </div>
                    </div>
                    <div class="target-card action-target-card" data-text="action02" data-tree="main_goals" data-name="Actions">
                        <div class="target-card-body">
                            <p class="target-card-text action02"></p>
                        </div>
                    </div>
                    <div class="target-card action-target-card" data-text="action03" data-tree="main_goals" data-name="Actions">
                        <div class="target-card-body">
                            <p class="target-card-text action03"></p>
                        </div>
                    </div>
                    <div class="target-card action-target-card" data-text="action04" data-tree="main_goals" data-name="Actions">
                        <div class="target-card-body">
                            <p class="target-card-text action04"></p>
                        </div>
                    </div>
                </div>
                <div class="segment-title main_actions"></div>
                <div class="tree-container">
                    <div class="target-card main-action" data-text="mainAction01" data-tree="main_goals" data-name="Main Actions">
                        <div class="target-card-body">
                            <p class="target-card-text mainAction01"></p>
                        </div>
                    </div>
                    <div class="target-card main-action" data-text="mainAction02" data-tree="main_goals" data-name="Main Actions">
                        <div class="target-card-body">
                            <p class="target-card-text mainAction02"></p>
                        </div>
                    </div>
                    <div class="target-card main-action" data-text="mainAction03" data-tree="main_goals" data-name="Main Actions">
                        <div class="target-card-body">
                            <p class="target-card-text mainAction03"></p>
                        </div>
                    </div>
                    <div class="target-card main-action" data-text="mainAction04" data-tree="main_goals" data-name="Main Actions">
                        <div class="target-card-body">
                            <p class="target-card-text mainAction04"></p>
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
                <h5 class="modal-title addTrees" id="treeModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                
                <!-- Botón para descargar plantilla de ejemplo -->
                <div class="form-group mt-3">
                    <a type="button" class="btn btn-primary download_template" download="problems_and_objetives_template.csv" href="assets/documents/problems_and_objetives_template.csv"></a>
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

<div class="modal fade" id="editTreeModal" tabindex="-1" aria-labelledby="treeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title editTrees_btn"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="text" class="form-control" id="edit">
                <input type="hidden" id="tree">
                <input type="hidden" id="column">
                <input type="hidden" id="idMainProblems">
                <input type="hidden" id="idMainGoals">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger cancel" data-bs-dismiss="modal"></button>
                <button type="button" class="btn btn-success accept" id="editButton"></button>
            </div>
        </div>
    </div>  
</div>

<?php
    include "view/pages/comments.php";
?>