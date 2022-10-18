<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="styles.css" />
    <title>Odjava</title>
</head>
<?php
    session_start();
    if(!isset($_SESSION['korisnik'])) {
        header("Location: index.php");
        exit();
    }
    session_destroy();
?>
<body>
    <p>Odjavljeni ste...</p>
    <a id="pocetnalink" href="index.php">Povratak na početnu stranicu</a>
</body>
</html>
