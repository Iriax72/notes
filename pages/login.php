<?php 
session_start();
 
require('./elements/createPDO.php');

if($_SERVER["REQUEST_METHOD"] === "POST") {
    // ici c'est le bon stmt ? ->
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$_POST['username']]);
    $user = $stmt->fetch();
}
if ($user && password_verify($_POST["password"], $user["password_hashed"])) {
    $_SESSION['user_id'] = $user['id'];
    header("Location: menu.php");
    exit();
} else {
    // ELLE SERT A QUOI $error ? ->
    $error = "identifients incorrects";
}
?>

<form method="POST">
    <input type="text" name="userName" placeholder="nom d'utilisateur" required>
    <input type="text" name="password" placeholder="mot de passe" required>
    <button type="submit">SE CONNECTER</button>
</form>

<a href="./signin.php">PAS ENCORE DE COMPTE ?</a>