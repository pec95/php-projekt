<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="styles.css" />
    <link rel="stylesheet" type="text/css" href="bootstrap-grid.css" />
    <title>Kategorije</title>
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

        $query = '';
        $kategorija = $_GET['id'];
        
        if($kategorija == "politika" || $kategorija == "zdravlje") {
            if($kategorija == "politika") {
                $query = "SELECT * FROM vijesti WHERE arhiva = 0 AND kategorija = 'Politik'";
                
                $podnozje = "Politik";
                echo "  <a id='politika'></a>
                        <a href='#politika'><h1 class='pocetnah1'>POLITIK</h1></a>
                        <div class='clear'></div>
                        <section id='politika' class='container'>";

                
            }
            else if($kategorija == "zdravlje") {
                $query = "SELECT * FROM vijesti WHERE arhiva = 0 AND kategorija = 'Gesundheit'";

                $podnozje = "Gesundheit";
                echo "  <a id='zdravlje'></a>
                        <a href='#zdravlje'><h1 class='pocetnah1'>GESUNDHEIT</h1></a>
                        <div class='clear'></div>
                        <section id='zdravlje' class='container'>";
            }

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
        }
        else {
            $podnozje = "";
            echo "<p class='marginaMobitel'>Nepostojeća kategorija!</p><br />";
        }

        
        mysqli_close($dbc);
    ?>
    
    <footer>
        <p id="podnozje">stern.de GmbH | <?php echo $podnozje; ?></p>
    </footer>
</div>
</body>
</html>