<?php session_start(); ?>

<!DOCTYPE html>
<html lang="fr">
    <?php 
    require_once './elements/head.php';
    head('menu');
    ?>
    <body>
        <?php
        if (isset($_SESSION['user_id'])) {
            header("Location: pages/menu.php");
            exit();
        } else {
            header("Location: pages/login.php");
            exit();
        }
        ?>
    </body>
</html>