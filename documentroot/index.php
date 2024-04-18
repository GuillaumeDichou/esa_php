<!DOCTYPE html>
<html>
<head>
    <title>Document root</title>
</head>
<body>
<?php

$documentRoot = $_SERVER['DOCUMENT_ROOT'];

$pointeur = opendir($documentRoot);

while (($nomFichier = readdir($pointeur)) !== false) {
        echo $nomFichier . "<br>";
        }

closedir($pointeur);

?>
</body>
</html>