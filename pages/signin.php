<?php
session_start() ;

require('./elements/createPDO');
    
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->execute([$_POST["username"], $hash]);

    header("Location: login.php");
    exit();
}
?>

<form method="POST">
    <input type="text" name="username" required>
    <input type="password" name="password" required>
    <button type="submit">Créer un compte</button>
</form>