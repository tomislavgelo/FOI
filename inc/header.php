<?php
include '../service/KategorijaService.php';
include '../service/KorisnikService.php';
include '../service/PaginacijaService.php';
include '../service/PrekrsajService.php';
include '../service/TipKorisnikaService.php';
include '../service/VoziloService.php';
session_start();
?>
<!DOCTYPE html>
<html lang="hr">
  <head>
    <title>E-prekršaji</title>
    <meta charset="UTF-8">
    <meta name="description" content="Web app">
    <meta name="keywords" content="prekršaj, kazna, plaćanje, alkohol, brzina, zakon">
    <meta name="author" content="Tomislav Gelo">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/style.css"/>
    <script type="text/javascript" src="../js/sakrijPokazi.js"></script>
  </head>
  <body>
    <header>
      <a href="../o_autoru.html">O autoru</a>
      <br/>
      <div class="logo">
        <img src="../images/mup.png"/>
      </div>
      <div>
      <?php
      if(isset($_SESSION['korisnicko_ime']))
      {
        $tipKorisnika = new TipKorisnikaService;
        $tipKorisnika = $tipKorisnika->dohvatiTipKorisnika($_SESSION['tip_id']);

        foreach($tipKorisnika as $tip)
        {
          echo '<p>Dobrodošao '.$_SESSION['korisnicko_ime'].'!</p>';
          echo '<p>Vi ste '.$tip->getNaziv().'!</p>';
          echo '<img src="../'.$_SESSION['slika'].'" width="120" height="140"/><br/>';
          echo '<form action="../controller/KorisnikController.php" method="POST">';
            echo '<input type="hidden" name="korisnik" value="odjava">';
            echo '<button type="submit">Odjava</button>';
          echo '</form>';
        }
      }
      else
      {
        echo '<p>Dobrodošao posjetitelju!</p>';
        echo '<p>Prijavite se kako bi pristupili aplikaciji!</p>';
        echo '<img src="../korisnici/UnRegisterdUser.png" width="120" height="140"/><br/>';
        echo "<a href='../view/prijava.php'>Prijava</a>";
      }
      ?>
      </div>
      <nav class="menu">
      <?php
      if(isset($_SESSION['korisnicko_ime']) && $_SESSION['tip_id'] == 2)
      {
        echo '| <a href="../view/pocetna.php">Početna</a> | ';
        echo '<a href="../view/moja_vozila.php">Moja Vozila</a> | ';
        echo '<a href="../view/moji_prekrsaji.php">Moji Prekrsaji</a> | ';
      }
      elseif(isset($_SESSION['korisnicko_ime']) && $_SESSION['tip_id'] == 1) 
      {
        echo '| <a href="../view/pocetna.php">Početna</a> | ';
        echo '<a href="../view/moja_vozila.php">Moja Vozila</a> | ';
        echo '<a href="../view/moji_prekrsaji.php">Moji Prekrsaji</a> | ';
        echo '<a href="../view/moje_kategorije.php">Moje Kategorije</a> | ';
      }
      elseif(isset($_SESSION['korisnicko_ime']) && $_SESSION['tip_id'] == 0) 
      {
        echo '| <a href="../view/pocetna.php">Početna</a> | ';
        echo '<a href="../view/moja_vozila.php">Moja Vozila</a> | ';
        echo '<a href="../view/moji_prekrsaji.php">Moji Prekrsaji</a> | ';
        echo '<a href="../view/moje_kategorije.php">Moje Kategorije</a> | ';
        echo '<a href="../view/lista_korisnika.php">Korisnici</a> |';
      }
      else
      {
        echo '| <a href="../view/pocetna.php">Početna</a> | ';
      }
      ?>
      </nav>
    </header>
    <br/>
    <hr/>