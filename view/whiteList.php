<?php 
    
	$pagina = $_GET['pagina'] ?? 'Dashboard';

	$navs = [
		'Dashboard',
        // Admin URLs
		'Admin',
		'Users',
		'Projects',
		'Teams',
		'EventSettings',

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
        } elseif ($pagina == 'Admin' || $pagina == 'Users' || $pagina == 'Projects' || $pagina == 'Teams' || $pagina == 'EventSettings'){

            include "view/pages/admin/Admin.php";
            
            if ($pagina == 'Admin') {
                include "view/pages/admin/Settings.php";
            }
            if ($pagina == 'Users') {
                include "view/pages/admin/Users.php";
            }
            if ($pagina == 'Projects') {
                include "view/pages/admin/Projects.php";
            }
            if ($pagina == 'Teams') {
                include "view/pages/admin/Teams.php";
            }
            if ($pagina == 'EventSettings') {
                include "view/pages/admin/EventSettings.php";
            }

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

    } elseif($pagina == 'participant_login') {
        include "view/pages/login/participant_login.php";
    } elseif($pagina == 'Login') {
        include "view/pages/login/Login.php";
    } elseif($pagina == 'forgot_password') {
        include "view/pages/login/forgot_password.php";
    } else {
        header("Location: Login");
        exit();
    }