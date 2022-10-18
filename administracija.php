<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="styles.css" />
    <title>Administracija</title>
</head>
<body>
<?php
    session_start();
    if(!isset($_SESSION['korisnik'])) {
        header("Location: index.php");
        exit();
    }
?>
<div class="page-wrapper">
    <header>
        <nav>
            <a href="index.php"><img class="logo" src="img/logo.png" /></a>
            <br /><br >
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="kategorija.php?id=politika">Politik</a></li>
                <li><a href="kategorija.php?id=zdravlje">Gesundheit</a></li>
                <li><a href="arhiva.php">Arhiva</a></li>
                <li><a href='administracija.php'>Administracija</a></li>
                <li><a href='unos.html'>Unos vijesti</a></li>
                <li class='odjava'><a href='odjava.php'>Odjava</a></li>
            </ul>   
        </nav>
    </header>

    <?php
        include 'connect.php';
        define('UPLPATH', 'img/');

        if($_SESSION['razina'] == 1) {
            $query1 = "SELECT * FROM vijesti"; 
            $result1 = mysqli_query($dbc, $query1);

            while($row = mysqli_fetch_array($result1)) {
                $id = $row['id'];
                $slika = $row['slika'];
                $naslov = $row['naslov'];
                $opis = $row['opis'];
                $vijest = $row['vijest'];
                $arhiva = $row['arhiva'];
                $kategorija =$row['kategorija'];
                echo "<form enctype='multipart/form-data' method='POST' action=''>
                        <input type='hidden' name='id' value='$id'>

                        <label>Naslov vijesti</label><br />
                        <input type='text' name='naslov' id='naslov' value='$naslov'/><br />
        
                        <label>Kratki sadržaj vijesti</label><br />
                        <textarea cols='30' rows='6' name='opis' id='opis'>$opis</textarea><br />
        
                        <label>Sadržaj vijesti</label><br />
                        <textarea cols='30' rows='10' name='vijest' id='vijest'>$vijest</textarea><br />
        
                        <label>Kategorija</label><br />
                    ";
                    if($kategorija == "Politik") {
                        echo "<select name='kategorija' id='kategorija'>
                                <option selected value='$kategorija'>$kategorija</option>
                                <option value='Gesundheit'>Gesundheit</option>
                              </select><br />";
                    }
                    else {
                        echo "<select name='kategorija' id='kategorija'>
                                <option value='Politik'>Politik</option>
                                <option selected value='$kategorija'>$kategorija</option>
                              </select><br />";
                    }
                    echo "
                        <label>Slika:</label><br />
                        <input type='file' accept='image/jpg' name='slika' id='slika'/><br />
                        <img src='".UPLPATH.$slika."' width='100'><br />

                        <label>Arhivirati:</label><br />";

                        if($arhiva == 0) {
                            echo "<input type='checkbox' name='arhiva' /><br /><br />";
                        }
                        else {
                            echo "<input type='checkbox' name='arhiva' checked/><br /><br />";
                        }               

                echo "  <input type='submit' name='izmjeni' id='izmjeni' value='Izmjeni' />
                        <input type='submit' name='brisi' id='brisi' value='Izbriši' />
                        <input type='reset' value='Poništi' /><br /><br /><hr /><br />
                    </form>";
            }

            if(isset($_POST['brisi'])) {
                $id2 = $_POST['id']; 
                $query2 = "DELETE FROM vijesti WHERE id = $id2"; 
                $result2 = mysqli_query($dbc, $query2) or die('Error querying database'); 
            }

            if(isset($_POST['izmjeni'])) {
                $naslov2 = $_POST['naslov'];
                $opis2 = $_POST['opis'];
                $vijest2 = $_POST['vijest'];
                $kategorija2 = $_POST['kategorija'];
                $slika2 = $_FILES['slika']['name'];
                $id2 = $_POST['id'];
                if(isset($_POST['arhiva'])) {
                    $arhiva2 = 1;
                }
                else {
                    $arhiva2 = 0;
                }
                
                if($slika2 != '') {
                    if($slika != $slika2) {
                        $direktorij = 'img/'.$slika2;
                        move_uploaded_file($_FILES['slika']['tmp_name'], $direktorij);
                        
                        $query3 = "UPDATE vijesti
                               SET naslov = '$naslov2', opis = '$opis2', vijest = '$vijest2', slika = '$slika2', kategorija = '$kategorija2', arhiva = '$arhiva2'
                               WHERE id = '$id2'";
                    }
                    else {
                        $query3 = "UPDATE vijesti
                               SET naslov = '$naslov2', opis = '$opis2', vijest = '$vijest2', kategorija = '$kategorija2', arhiva = '$arhiva2'
                               WHERE id = '$id2'";
                    }
                }
                else {
                    $query3 = "UPDATE vijesti
                           SET naslov = '$naslov2', opis = '$opis2', vijest = '$vijest2', kategorija = '$kategorija2', arhiva = '$arhiva2'
                           WHERE id = '$id2'";
                }                
               
    
                $result3 = mysqli_query($dbc, $query3) or die('Error querying database');
            }
        }
        else {
            echo "<p class='marginaMobitel'>Pozdrav, " .$_SESSION['korisnik']. "! Prijavljeni ste, ali niste administrator.</p>";
        }

        mysqli_close($dbc);
    ?>

    <footer>
        <p id="podnozje">stern.de GmbH | Administracija</p>
    </footer>

</div>
</body>
</html>