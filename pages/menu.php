<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<p>Bienvenue sur le menu, vous etes connecté</p>
<a href="./logout.php">SE DECCONECTER</a>