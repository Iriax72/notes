<?php
function head(string $title): void {
    $safeTitle = htmlspecialchars($title, ENT_QUOTES | ENT_HTML5, 'UTF-8'); // modifier ça
    echo <<<HTML
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>$safeTitle</title>
    </head>
HTML;
}
?>