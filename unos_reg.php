<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="styles.css" />
    <title>Registracija</title>
</head>
<?php
    session_start();
    if(isset($_SESSION['korisnik'])) {
        header("Location: index.php");
        exit();
    }
?>
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
                <li><a href='prijava.php'>Prijava</a></li>
            </ul>   
        </nav>
    </header>

    <?php 
        include 'connect.php';

        $ime = $_POST['ime'];
        $prezime = $_POST['prezime'];
        $korisnicko_ime = $_POST['korisnicko_ime']; 
        $lozinka = $_POST['lozinka1']; 
        $hash = password_hash($lozinka, CRYPT_BLOWFISH); 
        $razina = 0;
        $registracija = false;

        $query1 = "SELECT korisnicko_ime FROM korisnik WHERE korisnicko_ime = ?";
        $stmt = mysqli_stmt_init($dbc); 
        if(mysqli_stmt_prepare($stmt, $query1)) { 
            mysqli_stmt_bind_param($stmt, 's', $korisnicko_ime);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
        }

        if(mysqli_stmt_num_rows($stmt) > 0) { 
            echo "<p>Korisničko ime već postoji!</p>"; 
        }
        else {
            $sql = "INSERT INTO korisnik(ime, prezime, korisnicko_ime, lozinka, razina) VALUES(?, ?, ?, ?, ?)"; 
            $stmt = mysqli_stmt_init($dbc); 
            if (mysqli_stmt_prepare($stmt, $sql)) { 
                mysqli_stmt_bind_param($stmt, 'ssssi', $ime, $prezime, $korisnicko_ime, $hash, $razina); 
                mysqli_stmt_execute($stmt); 
                $registracija = true;
            }
        }

        if($registracija == true) {
            echo "<p>Registracija uspješna!</p><br />";
        }
        else {
            echo "<p>Pokušajte ponovno</p>
                <form enctype='multipart/form-data' method='POST' action=''>
                    <input type='hidden' name='id'>
        
                    <label>Ime:</label><br />
                    <input type='text' name='ime' id='ime' /><br />
                    <span id='porukaIme' class='greska'></span><br /><br />
        
                    <label>Prezime:</label><br />
                    <input type='text' name='prezime' id='prezime' /><br />
                    <span id='porukaPrezime' class='greska'></span><br /><br />
                
                    <label>Korisničko ime:</label><br />
                    <input type='text' name='korisnicko_ime' id='korisnicko_ime' /><br />
                    <span id='porukaKorisnik' class='greska'></span><br /><br />
        
                    <label>Lozinka:</label><br />
                    <input type='password' name='lozinka1' id='lozinka1' /><br />
                    <span id='porukaLozinka1' class='greska'></span><br /><br />
        
                    <label>Ponovite lozinku:</label><br />
                    <input type='password' name='lozinka2' id='lozinka2' /><br />
                    <span id='porukaLozinka2' class='greska'></span><br /><br />
        
                    <input type='submit' id='registracija' value='Registracija' />
                </form>";
        }
    ?>

    <script type="text/javascript">
        document.getElementById("registracija").onclick = function(event) {
            var predaj = true;

            var imePolje = document.getElementById("ime");
            var ime = document.getElementById("ime").value;
            imePolje.style.border = "1px solid black";
            document.getElementById("porukaIme").innerHTML = "";
            if(ime.length == 0) {
                predaj = false;
                imePolje.style.border = "2px solid #ED1C24";
                document.getElementById("porukaIme").innerHTML = "Unesite ime!<br />";
            }

            var prezimePolje = document.getElementById("prezime");
            var prezime = document.getElementById("prezime").value;
            prezimePolje.style.border = "1px solid black";
            document.getElementById("porukaPrezime").innerHTML = "";
            if(prezime.length == 0) {
                predaj = false;
                prezimePolje.style.border = "2px solid #ED1C24";
                document.getElementById("porukaPrezime").innerHTML = "Unesite prezime!<br />";
            }

            var korisnikPolje = document.getElementById("korisnicko_ime");
            var korisnik = document.getElementById("korisnicko_ime").value;
            korisnikPolje.style.border = "1px solid black";
            document.getElementById("porukaKorisnik").innerHTML = "";
            if(korisnik.length == 0) {
                predaj = false;
                korisnikPolje.style.border = "2px solid #ED1C24";
                document.getElementById("porukaKorisnik").innerHTML = "Unesite korisničko ime!<br />";
            }

            var lozinka1Polje = document.getElementById("lozinka1");
            var lozinka1 = document.getElementById("lozinka1").value;
            var lozinka2Polje = document.getElementById("lozinka2");
            var lozinka2 = document.getElementById("lozinka2").value;
            lozinka1Polje.style.border = "1px solid black";
            lozinka2Polje.style.border = "1px solid black";
            document.getElementById("porukaLozinka1").innerHTML = "";
            document.getElementById("porukaLozinka2").innerHTML = "";
            if(lozinka1.length == 0 || lozinka2.length == 0) {
                predaj = false;
                lozinka1Polje.style.border = "2px solid #ED1C24";
                lozinka2Polje.style.border = "2px solid #ED1C24";
                document.getElementById("porukaLozinka1").innerHTML = "Unesite lozinku!<br />";
            }
            if(lozinka1 != lozinka2) {
                predaj = false;
                lozinka1Polje.style.border = "2px solid #ED1C24";
                lozinka2Polje.style.border = "2px solid #ED1C24";
                document.getElementById("porukaLozinka2").innerHTML = "Lozinke nisu jednake!<br />";
            }

            if(predaj == false) {
                event.preventDefault();
            }
        }
    </script>
    
    <?php
        mysqli_close($dbc);
    ?>

    <footer>
        <p id="podnozje">stern.de GmbH | Registracija</p>
    </footer>
</div>
</body>
</html>