<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_POST['newSubject']) {
    require_once __DIR__ . './../elements/createPDO.php';
    $sql = 'INSERT INTO subjects (subject_name) VALUES (?)';
    $stmt = $pdo->prepare($stmt);
    $stmt->execute([$_POST['newSubject']]);
}

require_once __DIR__ . '/../elements/head.php';
head("menu");

require_once __DIR__ . '/../elements/createPDO.php';
$sql = 'SELECT * FROM enrollements WHERE user_id = ?';
$stmt = $pdo->prepare($sql);
$stmt->execute([$_SESSION['user_id']]);
$enrollements = $stmt->fetch();
?>

<body>
    <header>
        <h1>App Note</h1>
    </header>
    <main>
        <p>Bienvenue dans le menu, vous etes en tant que <?php echo htmlspecialchars((string)($_SESSION['user_id'] ?? ''), ENT_QUOTES | ENT_HTML5, 'UTF-8'); ?></p>
        <form method="post">
            <input type="text" name="newSubject" placeholder="une nouvelle matière ?">
            <button type="submit">Enregistrer</button>
        </form>
        <?php if (!$enrollements): ?>
            <p>Vous n'êtes pour l'instant inscrit à aucun cours</p>
        <?php else: ?>
            <?php foreach($enrollements as $user_id => $enrollement) {
                $safeEnrollement = htmlspecialchars((string) $enrollement, ENT_QUOTES | ENT_HTML5, 'UTF-8');
                echo '<a href="./subject.php?subject=' . $safeEnrollement . '">' . $safeEnrollement . '</a>';
            };?>
        <?php endif; ?>
    </main>
    <footer>
        <a href="./logout.php">SE DECCONECTER</a>
    </footer>
</body>