<?php
include '../inc/header.php';

echo '<main>';
if(isset($_SESSION['korisnik_id']) && $_SESSION['tip_id'] == 0)
{
  if(isset($_GET['stranica']))
  {
    $trenutnaStranica = $_GET['stranica'];
  }
  else
  {
    $trenutnaStranica = 1;
  }
  $stranica = basename($_SERVER['SCRIPT_FILENAME']);

  echo '<div>';
  
  $korisnici = new KorisnikService;
  $korisnici = $korisnici->dohvatiSveKorisnike();
  $rezultataPoStranici = 10;
  $brojStranica = ceil(count($korisnici)/$rezultataPoStranici);
  $listanje = ($rezultataPoStranici * $trenutnaStranica) - $rezultataPoStranici;
  $prikazKorisnika = array_slice($korisnici, $listanje, $rezultataPoStranici);
    echo '<table>';
      echo '<thead>';
        echo '<tr>';
          echo '<th>';
            echo 'Tip';
          echo '</th>';
          echo '<th>';
            echo 'Korisničko Ime';
          echo '</th>';
          echo '<th>';
            echo 'Lozinka';
          echo '</th>';
          echo '<th>';
            echo 'Ime';
          echo '</th>';
          echo '<th>';
            echo 'Prezime';
          echo '</th>';
          echo '<th>';
            echo 'E-mail';
          echo '</th>';
          echo '<th>';
            echo 'Slika';
          echo '</th>';
          echo '<th>';
            echo 'Ažuriraj';
          echo '</th>';
        echo '</tr>';
      echo '</thead>';
      echo '<tbody>';
      foreach($prikazKorisnika as $korisnik)
      {
        echo '<tr>';
          echo '<td>';
            $tipKorisnika = new TipKorisnikaService;
            $tipKorisnika = $tipKorisnika->dohvatiTipKorisnika($korisnik->getTipId());

            foreach($tipKorisnika as $tip)
            {
              echo $tip->getNaziv();
            }
          echo '</td>';
          echo '<td>';
            echo $korisnik->getKorisnickoIme();
          echo '</td>';
          echo '<td>';
            echo $korisnik->getLozinka();
          echo '</td>';
          echo '<td>';
            echo $korisnik->getIme();
          echo '</td>';
          echo '<td>';
            echo $korisnik->getPrezime();
          echo '</td>';
          echo '<td>';
            echo $korisnik->getEmail();
          echo '</td>';
          echo '<td>';
            echo '<img src="../'.$korisnik->getSlika().'" alt="Slika korisnika" height="140" width="120">';
          echo '</td>';
          echo '<td>';
            echo '<a href="azuriraj_korisnika.php?korisnik_id='.$korisnik->getKorisnikId().'">';
              echo 'Ažuriraj Korisnika';
            echo '</a>';
          echo '</td>';
        echo '</tr>';
      }
      echo '</tbody>';
    echo '</table>';
   echo '<br/>';
    echo '<div>';
      echo '<a href="dodaj_novog_korisnika.php">Dodaj Novog Korisnika</a>';
    echo '</div>';
  echo '</div>';
  echo '<br/>';
}
elseif(isset($_SESSION['korisnik_id']) && $_SESSION['tip_id'] > 1)
{
  header('Location: ../view/greska.php?greska=pristupKorisnicima');

  die();
}
else
{
  header('Location: ../view/greska.php?greska=prijava');

  die();
}
if($brojStranica > 1)
{
  echo '<div>';
  $paginacija = new PaginacijaService;
  $paginacija = $paginacija->paginacija($stranica, $brojStranica, $trenutnaStranica);
  echo '</div>';
}
echo '</main>';
echo '<hr/>';

include '../inc/footer.php';
?>