
<?php
    session_start();
?>
<!doctype html>
<html lang="en" dir="ltr">
    
    <?php
        include 'extras/css.php';
    ?>

    <body class="auto theme-color-blue">
        <div class="conatiner-fluid content-inner pb-0">
            <div class="row">
                <?php
                    include 'whiteList.php';
                ?>
            </div>
        </div>

        <?php
            include 'extras/js.php';
        ?>
    </body>
</html>