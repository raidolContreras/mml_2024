<?php 
    
	$pagina = $_GET['pagina'] ?? 'Dashboard';

	$navs = [
		'Dashboard',
		'Admin',
        'Events',
        'Matriz',
        'Reports',
        'Structure',
        'Summary',
        'Trees',
        'Team'
	];
    
    if(isset($_SESSION['logged']) && $_SESSION['logged'] == true){
        
        if (in_array($pagina, $navs)) {
            include "view/extras/header.php";
            include "view/modals.php";
        }

        if ($pagina == 'Dashboard'){
            include "view/pages/$pagina.php";
        } elseif ($pagina == 'Admin'){
            include "view/pages/admin/$pagina.php";
        } elseif ($pagina == 'Events'){
            include "view/pages/events/$pagina.php";
        } elseif ($pagina == 'Matriz'){
            include "view/pages/matriz/$pagina.php";
        } elseif ($pagina == 'Reports'){
            include "view/pages/reports/$pagina.php";
        } elseif ($pagina == 'Structure'){
            include "view/pages/structure/$pagina.php";
        } elseif ($pagina == 'Summary'){
            include "view/pages/summary/$pagina.php";
        } elseif ($pagina == 'Trees'){
            include "view/pages/trees/$pagina.php";
        } elseif ($pagina == 'Team'){
            include "view/pages/team/$pagina.php";
        } else {
            if ($pagina == 'Login') {
                header("Location: ./");
                exit();
            }
            include "error404.php";
        }

    } elseif($pagina == 'Login') {
        include "view/pages/login/Login.php";
    } else {
        header("Location: Login");
        exit();
    }