<?php
    if ($_SESSION['level'] == 0) {
        include "adminTeam.php";
    } else {
        include "teacherTeam.php";
    }