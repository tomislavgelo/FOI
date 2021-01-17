<?php
include '../inc/header.php';

if(isset($_SESSION['korisnik_id']))
{
  echo 'Hello '.$_SESSION['korisnicko_ime'].'!';
}
else 
{
  echo '<main>';
    echo '<div class="prijava">';
      echo '<div class="form">';
        echo '<form method="POST" action="../controller/KorisnikController.php">';
          echo '<h2>Prijava</h2>';
          echo '<input type="text" name="korisnicko_ime" placeholder="Korisničko ime" required/>';
          echo '<br/>';
          echo '<input type="password" name="lozinka" placeholder="Lozinka" required/>';
          echo '<br/>';
          echo '<input type="hidden" name="korisnik" value="prijava"/>';
          echo '<button class="prijava" type="submit">Prijava</button>';
        echo '</form>';
      echo '</div>';
    echo '</div>';
    echo '<br/>';
  echo '</main>';
  echo '<hr/>';
}

include '../inc/footer.php';
?>