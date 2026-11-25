<?php
session_start();

require_once '../elements/createPDO.php';

function error(string $error) {
    echo "<div>Une erreur est survenue: $error</div>";
    exit();
}

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
$user_id = $_SESSION['user_id'];

if (isset($_POST['newSubject'])) {
    try {
        $sql = 'INSERT INTO subjects (subject_name) VALUES (?)';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$_POST['newSubject']]);

        $sql = 'SELECT id FROM subjects WHERE subject_name = (?) ORDER BY id DESC LIMIT 1';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$_POST['newSubject']]);
        $subject_id = (int) $stmt->fetchColumn();

        $sql = 'INSERT INTO enrollements (user_id, subject_id) VALUES (?, ?)';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$user_id, $subject_id]);
    } catch (PDOException $error) {
        error($error);
    }
}

require_once __DIR__ . '/../elements/head.php';
head("menu", '../css/menu.css');

try {
    $sql = 'SELECT subject_name FROM enrollements JOIN subjects ON enrollements.subject_id = subjects.id WHERE user_id = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$_SESSION['user_id']]);
    $enrollements = $stmt->fetch();
} catch (PDOException $error) {
    error($error);
}
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
            <?php foreach($enrollements as $enrollement) {
                $safeEnrollement = htmlspecialchars((string) $enrollement, ENT_QUOTES | ENT_HTML5, 'UTF-8');
                echo '<a href="./subject.php?subject=' . $safeEnrollement . '">' . $safeEnrollement . '</a>';
            };?>
        <?php endif; ?>
    </main>
    <footer>
        <a href="./logout.php">SE DECCONECTER</a>
    </footer>
</body>
