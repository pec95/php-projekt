<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="styles.css" />
    <title>Unos vijesti</title>
</head>
<?php
    session_start();
    if(!isset($_SESSION['korisnik'])) {
        header("Location: index.php");
        exit();
    }
?>
<body>
<div class="page-wrapper">
    <?php 
        include 'connect.php';

        $datum = date('d.m.Y.');
        $naslov = $_POST['naslov'];
        $opis = $_POST['opis'];
        $vijest = $_POST['vijest'];
        $kategorija = $_POST['kategorija'];
        $slika = $_FILES['slika']['name'];
        $id = $_POST['id'];
        
        if(isset($_POST['arhiva'])) {
            $arhiva = 1;
        }
        else {
            $arhiva = 0;
        }

        $direktorij = 'img/' . $slika;
        move_uploaded_file($_FILES['slika']['tmp_name'], $direktorij);

        $query = "INSERT INTO vijesti(datum, naslov, opis, vijest, slika, kategorija, arhiva)
                  VALUES('$datum', '$naslov', '$opis', '$vijest', '$slika', '$kategorija', '$arhiva')";

        $result = mysqli_query($dbc, $query) or die('Error querying database');

        if($result) {
            echo "<p>Vijest uspješno unesena</p><br />";
            if($kategorija == "Politik") {
                echo "<a href='kategorija.php?id=politika'>Natrag na svi politik članci</a>";
            }
            else {
                echo "<a href='kategorija.php?id=zdravlje'>Natrag na svi gesundheit članci</a>";  
            }
        }
        mysqli_close($dbc);
    ?>
</div>
</body>
</html>