<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="styles.css" />
    <title>Članak</title>
</head>
<body>
<div class="page-wrapper">
    <header>
        <nav>
            <a href="index.php"><img class="logo" src="img/logo.png" /></a>
            <br /><br >
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="kategorija.php?id=politika">Politik</a></li>
                <li><a href="kategorija.php?id=zdravlje">Gesundheit</a></li>                                
                <?php 
                session_start();
                if(isset($_SESSION['korisnik'])) {
                    echo "<li><a href='administracija.php'>Administracija</a></li>
                          <li><a href='unos.html'>Unos vijesti</a></li>
                          <li class='odjava'><a href='odjava.php'>Odjava</a></li>";
                } 
                else {
                    echo "<li><a href='prijava.php'>Prijava</a></li>
                          <li><a href='registracija.php'>Registracija</a></li>"; 
                }
                ?>
            </ul>   
        </nav>
    </header>

    <?php
        include 'connect.php';
        define('UPLPATH', 'img/');

        $id = $_GET['id'];

        $query = "SELECT * FROM vijesti WHERE id = $id";
        $result = mysqli_query($dbc, $query) or die('Error querying database');

        $row = mysqli_fetch_array($result);

        if($row != 0) {
            $naslov = $row['naslov'];
            $datum = $row['datum'];
            $opis = $row['opis'];
            $slika = $row['slika'];
            $vijest = $row['vijest'];
            $kategorija = $row['kategorija'];
            $arhiva = $row['arhiva'];
            
            if($arhiva == 1) {
                if(isset($_SESSION['korisnik'])) {
                    echo "<div class='vijest'><h2>$naslov</h2>
                    <span class='datum'>$datum</span>
                    <div class='clear'></div>
                    <p class='opis'>$opis</p>
                    <img class='slikavijest' src='".UPLPATH.$slika."' />
                    <hr />
                    <p class='vijest'>$vijest</p></div>";
                }
                else {
                    echo "<p class='marginaMobitel'>Nemate pravo pristupa ili ne postoji članak!</p><br />";
                }
            }
            else {
                echo "<div class='vijest'><h2>$naslov</h2>
                <span class='datum'>$datum</span>
                <div class='clear'></div>
                <p class='opis'>$opis</p>
                <img class='slikavijest' src='".UPLPATH.$slika."' />
                <hr />
                <p class='vijest'>$vijest</p></div>";
            }
        }
        else {
            echo "<p class='marginaMobitel'>Nemate pravo pristupa ili ne postoji članak!</p><br />";
        }
        
        mysqli_close($dbc);
    ?>
    
    <footer>
        <p id="podnozje">stern.de GmbH | Članak</p>
    </footer>
</div>
</body>
</html>