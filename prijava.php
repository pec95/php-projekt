<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="styles.css" />
    <title>Prijava</title>
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
                <li><a href='registracija.php'>Registracija</a></li>                               
            </ul>   
        </nav>
    </header>

    <form enctype="multipart/form-data" method="POST" action="index.php">
        <input type="hidden" name="id">
        
        <label>Korisničko ime:</label><br />
        <input type="text" name="korisnicko_ime" id="korisnicko_ime" /><br />
        <span id="porukaKorisnik" class="greska"></span><br /><br />

        <label>Lozinka:</label><br />
        <input type="password" name="lozinka" id="lozinka" /><br />
        <span id="porukaLozinka" class="greska"></span><br /><br />

        <input type="submit" name="prijava" id="prijava" value="Prijava" />
    </form>

    <footer>
        <p id="podnozje">stern.de GmbH | Prijava</p>
    </footer>

    <script type="text/javascript">
        document.getElementById("prijava").onclick = function(event) {
            var predaj = true;

            var korisnikPolje = document.getElementById("korisnicko_ime");
            var korisnik = document.getElementById("korisnicko_ime").value;
            if(korisnik.length == 0) {
                predaj = false;
                korisnikPolje.style.border = "2px solid #ED1C24";
                document.getElementById("porukaKorisnik").innerHTML = "Unesite korisničko ime!<br />";
            }

            var lozinkaPolje = document.getElementById("lozinka");
            var lozinka = document.getElementById("lozinka").value;
            if(lozinka.length == 0) {
                predaj = false;
                lozinkaPolje.style.border = "2px solid #ED1C24";
                document.getElementById("porukaLozinka").innerHTML = "Unesite lozinku!<br />";
            }

            if(predaj == false) {
                event.preventDefault();
            }
        }
    </script>
</div>
</body>
</html>