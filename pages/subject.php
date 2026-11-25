<?php
session_start();

require_once __DIR__ . '/../elements/head.php';
$pageName = filter_input(INPUT_GET, 'subject', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?? 'inconnu';
head($pageName, '../css/subject.css');
?>

<body>
    <header></header>
    <main class="container">
        <p>Vous êtes sur votre cour de <?php echo htmlspecialchars($pageName, ENT_QUOTES | ENT_HTML5, 'UTF-8'); ?></p>
        <a class="btn" href="./menu.php">retour au menu</a>
    </main>
    <footer></footer>
</body>