<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="styles.css" />
    <link rel="stylesheet" type="text/css" href="bootstrap-grid.css" />
    <title>Početna</title>
</head>
<body>
<div class="page-wrapper">
    <?php
        include 'connect.php';

        if(isset($_POST['prijava'])) {
            $prijavaKorisnik = $_POST['korisnicko_ime'];
            $prijavaLozinka = $_POST['lozinka'];

            $query = "SELECT korisnicko_ime, lozinka, razina FROM korisnik WHERE korisnicko_ime = ?";
            $stmt = mysqli_stmt_init($dbc);
            if(mysqli_stmt_prepare($stmt, $query)) { 
                mysqli_stmt_bind_param($stmt, 's', $prijavaKorisnik);
                mysqli_stmt_execute($stmt); 
                mysqli_stmt_store_result($stmt); 
            }
            mysqli_stmt_bind_result($stmt, $korisnik, $lozinka, $razina);
            mysqli_stmt_fetch($stmt);

            if(mysqli_stmt_num_rows($stmt) > 0 && password_verify($prijavaLozinka, $lozinka)) { 
                session_start();

                $_SESSION['korisnik'] = $korisnik; 
                $_SESSION['razina'] = $razina; 
            }
            else {
                $greska = "<p class='greska'>Neuspješna prijava!<p>";
            }
        }
        else {
            session_start();
        }
    ?>
    <header>
        <nav>
            <a href="index.php"><img class="logo" src="img/logo.png" /></a>
            <br /><br >
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="kategorija.php?id=politika">Politik</a></li>
                <li><a href="kategorija.php?id=zdravlje">Gesundheit</a></li>                                
                <?php                 
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
        if(isset($greska)) {
            echo $greska;
        }

        define('UPLPATH', 'img/');

        $query1 = "SELECT * FROM vijesti WHERE arhiva = 0 AND kategorija = 'Politik' LIMIT 3";
        $result1 = mysqli_query($dbc, $query1) or die('Error querying database');

        echo "  <a href='kategorija.php?id=politika'><h1 class='pocetnah1'>POLITIK <img src='img/strelica.PNG' alt='strelica' class='strelica' /></h1></a>
                <div class='clear'></div>
                <section id='politika' class='container'>
                <div class='row'>";
        while($row = mysqli_fetch_array($result1)) {
            $id1 = $row['id'];
            $slika1 = $row['slika'];
            $naslov1 = $row['naslov'];
            $opis1 = $row['opis'];
            echo "  <div class='col-md-4'>
                        <a href='clanak.php?id=$id1'><article>
                        <img src='".UPLPATH.$slika1."' height='200' />
                	    <h3>$naslov1</h3>
                        <p>$opis1</p>
                    </article></a>
                    </div>";
        }
        echo "  </div></section><br />
                <div class='clear'></div>";

        $query2 = "SELECT * FROM vijesti WHERE arhiva = 0 AND kategorija = 'Gesundheit' LIMIT 3";
        $result2 = mysqli_query($dbc, $query2) or die('Error querying database');

        echo "  <a href='kategorija.php?id=zdravlje'><h1 class='pocetnah1'>GESUNDHEIT <img src='img/strelica.PNG' alt='strelica' class='strelica' /></h1></a>
                <div class='clear'></div>
                <section id='zdravlje' class='container'>
                <div class='row'>";
        while($row = mysqli_fetch_array($result2)) {
            $id2 = $row['id'];
            $slika2 = $row['slika'];
            $naslov2 = $row['naslov'];
            $opis2 = $row['opis'];

            echo "  <div class='col-md-4'>
                        <a href='clanak.php?id=$id2'><article>
                        <img src='".UPLPATH.$slika2."' height='200' />
                	    <h3>$naslov2</h3>
                        <p>$opis2</p>
                    </article></a>
                    </div>";
        }
        echo "  </div></section><br />";

        mysqli_close($dbc);
    ?>
    
    <footer>
        <p id="podnozje">stern.de GmbH | Home</p>
    </footer>
</div>
</body>
</html>