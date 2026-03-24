<?php
session_start();

require __DIR__ . '/../elements/createPDO.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === '' || $password === '') {
        $error = 'Tous les champs sont requis.';
    } else {
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $pdo->prepare('INSERT INTO users (userName, password_hashed) VALUES (?, ?)');
        try {
            $stmt->execute([$username, $hash]);
            header('Location: login.php');
            exit();
        } catch (PDOException $e) {
            if ($e->getCode() === '23000') {
                $error = 'Ce nom d\'utilisateur existe déjà.';
            } else {
                $error = 'Erreur lors de la création du compte.';
            }
        }
    }
}
?>

<?php if ($error): ?>
    <p style="color:red;"> <?= htmlspecialchars($error, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?> </p>
<?php endif; ?>

<form method="POST">
    <input type="text" name="username" value="<?= htmlspecialchars($username ?? '', ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>" required>
    <input type="password" name="password" required>
    <button type="submit">Créer un compte</button>
</form>