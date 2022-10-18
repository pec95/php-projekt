<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="styles.css" />
    <link rel="stylesheet" type="text/css" href="bootstrap-grid.css" />
    <title>Arhiva</title>
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
        <nav>
            <a href="index.php"><img class="logo" src="img/logo.png" /></a>
            <br /><br >
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="kategorija.php?id=politika">Politik</a></li>
                <li><a href="kategorija.php?id=zdravlje">Gesundheit</a></li>
                <li><a href='administracija.php'>Administracija</a></li>
                <li><a href='unos.html'>Unos vijesti</a></li>
                <li class='odjava'><a href='odjava.php'>Odjava</a></li>
            </ul> 
        </nav>
    </header>

    <?php
        include 'connect.php';
        define('UPLPATH', 'img/');

        $query = "SELECT * FROM vijesti WHERE arhiva = 1";
        
        $podnozje = "Arhiva";
        echo "  <h1 class='arhivah1'>ARHIVA</h1>
                <section id='arhiva' class='container'>";

        $result = mysqli_query($dbc, $query) or die('Error querying database');
        $i = 1;
        while($row = mysqli_fetch_array($result)) {
            $id = $row['id'];
            $slika = $row['slika'];
            $naslov = $row['naslov'];
            $opis = $row['opis'];

            if($i == 1) {
                echo "<div class='row'>";    
            }
            
            echo "<div class='col-md-4'>
                <a href='clanak.php?id=$id'><article>
                    <img src='".UPLPATH.$slika."' height='200' />
                    <h3>$naslov</h3>
                    <p>$opis</p>
                    </article>
                </a></div>";

            if($i == 3) {
                echo "</div><br />";
                $i = 1;  
            }
            else {
                $i++;
            }
        }
        echo "  </section><br />";
        
        mysqli_close($dbc);
    ?>
    
    <footer>
        <p id="podnozje">stern.de GmbH | <?php echo $podnozje; ?></p>
    </footer>
</div>
</body>
</html>