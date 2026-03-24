<?php
session_start();

require __DIR__ . '/../elements/createPDO.php';

$error = '';
$username = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === '' || $password === '') {
        $error = 'Veuillez renseigner tous les champs.';
    } else {
        $stmt = $pdo->prepare('SELECT * FROM users WHERE userName = ?');
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password_hashed'])) {
            $_SESSION['user_id'] = $user['id'];
            header('Location: menu.php');
            exit();
        } else {
            $error = 'Identifiants incorrects.';
        }
    }
}
?>

<?php if ($error): ?>
    <p style="color:red;"> <?= htmlspecialchars($error, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?> </p>
<?php endif; ?>

<form method="POST">
    <input type="text" name="username" value="<?= htmlspecialchars($username, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>" placeholder="nom d'utilisateur" required>
    <input type="password" name="password" placeholder="mot de passe" required>
    <button type="submit">SE CONNECTER</button>
</form>

<a href="./signin.php">PAS ENCORE DE COMPTE ?</a>