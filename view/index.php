
<?php
    session_start();
    $_SESSION['language'] = (isset($_SESSION['language'])) ? $_SESSION['language'] : 'en';
?>
<!doctype html>
<html dir="ltr">
    
<title>Radix | MML <?php echo $_GET['pagina'] ?? 'Dashboard'; ?></title>

<script src="https://kit.fontawesome.com/f4781c35cc.js" crossorigin="anonymous"></script>
    
    <?php
        include 'extras/css.php';
        include 'whiteList.php';
        include 'extras/js.php';
    ?>

    </body>
</html>