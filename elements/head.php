<?php
function head(string $title): void {
    echo <<<HTML
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>$title</title>
    </head>
HTML;
}
?>