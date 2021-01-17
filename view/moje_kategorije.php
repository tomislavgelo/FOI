<?php
include '../inc/header.php';

echo '<main>';
if(isset($_SESSION['korisnik_id']) && $_SESSION['tip_id'] <= 1)
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
  if($_SESSION['tip_id'] == 1)
  {
    $mojeKategorije = new KategorijaService;
    $mojeKategorije = $mojeKategorije->dohvatiKategorijeModeratora($_SESSION['korisnik_id']);

    echo '<table>';
      echo '<thead>';
        echo '<tr>';
          echo '<th>';
            echo 'Naziv';
          echo '</th>';
          echo '<th>';
            echo 'Opis';
          echo '</th>';
        echo '</tr>';
      echo '</thead>';
      echo '<tbody>';
      foreach($mojeKategorije as $kategorija)
      {
        echo '<tr>';
          echo '<td>';
            echo '<a href="lista_prekrsaja.php?kategorija_id='.$kategorija->getKategorijaId().'">';
              echo $kategorija->getNaziv();
            echo '</a>';
          echo '</td>';
          echo '<td>';
            echo $kategorija->getOpis();
          echo '</td>';
        echo '</tr>';
      }
      echo '</tbody>';
    echo '</table>';
    echo '<br/>';
    echo '<div>';
      echo '<a href="prekrsaji_korisnici.php">Statistika Prekršaja</a>';
    echo '</div>';
  }
  if($_SESSION['tip_id'] == 0)
  {
    $mojeKategorije = new KategorijaService;
    $mojeKategorije = $mojeKategorije->dohvatiSveKategorije();

    echo '<table>';
      echo '<thead>';
        echo '<tr>';
          echo '<th>';
            echo 'Naziv';
          echo '</th>';
          echo '<th>';
            echo 'Opis';
          echo '</th>';
          echo '<th>';
            echo 'Moderator';
          echo '</th>';
          echo '<th>';
            echo 'Ažuriranje';
          echo '</th>';
        echo '</tr>';
      echo '</thead>';
      echo '<tbody>';
      foreach($mojeKategorije as $kategorija)
      {
        echo '<tr>';
          echo '<td>';
            echo '<a href="lista_prekrsaja.php?kategorija_id='.$kategorija->getKategorijaId().'">';
              echo $kategorija->getNaziv();
            echo '</a>';
          echo '</td>';
          echo '<td>';
            echo $kategorija->getOpis();
          echo '</td>';
          echo '<td>';
          $moderatori = new KorisnikService;
          $moderatori = $moderatori->dohvatiKorisnika($kategorija->getModeratorId());

          foreach($moderatori as $moderator)
          {
            echo $moderator->getKorisnickoIme();
          }
          echo '</td>';
          echo '<td>';
            echo '<a href="azuriraj_kategoriju.php?kategorija_id='.$kategorija->getKategorijaId().'">Uredi Kategoriju</a>';
          echo '</td>';
        echo '</tr>';
      }
      echo '</tbody>';
    echo '</table>';
    echo '<br/>';
    echo '<div>';
      echo '<a href="prekrsaji_korisnici.php">Statistika Prekršaja</a>';
    echo '</div>';
    echo '<br/>';
    echo '<div>';
      echo '<a href="prekrsaji_razdoblje.php">Prekršaji u Razdoblju</a>';
    echo '</div>';
    echo '<br/>';
    echo '<div>';
      echo '<a href="dodaj_novu_kategoriju.php">Dodaj Novu Kategoriju</a>';
    echo '</div>';
  }
  echo '</div>';
  echo '<br/>';
}
elseif(isset($_SESSION['korisnik_id']) && $_SESSION['tip_id'] > 1)
{
  header('Location: ../view/greska.php?greska=pristupPodacima');

  die();
}
else
{
  header('Location: ../view/greska.php?greska=prijava');

  die();
}
echo '</main>';
echo '<hr/>';

include '../inc/footer.php';
?>