<?php
require_once "../forms.controller.php";
require_once "../../model/forms.models.php";

$comment = $_POST['comment'];
$fromTable = $_POST['fromTable'];
$idTeam = $_POST['idTeam'];

$data = array(
    "comment" => $comment,
    "fromTable" => $fromTable,
    "idTeam" => $idTeam
);

$result = FormsController::ctrAddComment($data);
echo $result;
