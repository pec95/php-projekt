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


    <form enctype="multipart/form-data" method="POST" action="unos_reg.php">
        <input type="hidden" name="id">

        <label>Ime:</label><br />
        <input type="text" name="ime" id="ime" /><br />
        <span id="porukaIme" class="greska"></span><br /><br />

        <label>Prezime:</label><br />
        <input type="text" name="prezime" id="prezime" /><br />
        <span id="porukaPrezime" class="greska"></span><br /><br />
        
        <label>Korisničko ime:</label><br />
        <input type="text" name="korisnicko_ime" id="korisnicko_ime" /><br />
        <span id="porukaKorisnik" class="greska"></span><br /><br />

        <label>Lozinka:</label><br />
        <input type="password" name="lozinka1" id="lozinka1" /><br />
        <span id="porukaLozinka1" class="greska"></span><br /><br />

        <label>Ponovite lozinku:</label><br />
        <input type="password" name="lozinka2" id="lozinka2" /><br />
        <span id="porukaLozinka2" class="greska"></span><br /><br />

        <input type="submit" name="registracija" id="registracija" value="Registracija" />
    </form>

    <footer>
        <p id="podnozje">stern.de GmbH | Registracija</p>
    </footer>

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

</div>
</body>
</html>