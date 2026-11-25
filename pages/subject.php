<?php
session_start();

require_once __DIR__ . '/../elements/head.php';
$pageName = filter_input(INPUT_GET, 'subject', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?? 'inconnu';
head($pageName, '../css/subject.css');

$grades = [
    5.5 => 0.5,
    6 => 1,
    4 => 0.5
    5.5 => 0.5
]
?>

<body>
    <header></header>
    <main class="container">
        <p>
            <span>Vous êtes sur votre cour de <?php echo htmlspecialchars($pageName, ENT_QUOTES | ENT_HTML5, 'UTF-8'); ?></span>
            <a class="btn" href="./menu.php">retour au menu</a>
        </p>
        <div class="container">
            <button class="btn">Nouvelle note</button>
            <?php foreach($grades as $grade => $coef): ?>
                <div>
                    <span>Note: </span>
                    <span><?=$grade?></span>
                    <span>Coef: </span>
                    <span><?=$coef?></span>
                </div>
            <?php endforeach ?>
        </div>
    </main>
    <footer></footer>
</body>