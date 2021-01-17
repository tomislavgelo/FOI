<?php
include '../inc/header.php';

echo '<main>';
if(isset($_SESSION['korisnik_id']) && isset($_SESSION['tip_id']))
{
  if($_SESSION['tip_id'] == 0)
  {
    if(isset($_GET['kategorija_id']))
    {
      echo '<div>';
        echo '<form action="../controller/KategorijaController.php" method="POST">';
          $dohvacenaKategorija = new KategorijaService;
          $dohvacenaKategorija = $dohvacenaKategorija->dohvatiKategoriju($_GET['kategorija_id']);

          foreach($dohvacenaKategorija as $kategorija)
          {
            echo '<table>';
              echo '<thead>';
                echo '<tr>';
                  echo '<th>';
                    echo 'Ažuriraj Kategoriju';
                  echo '</th>';
                  echo '<th>';
                  echo '</th>';
                echo '</tr>';
              echo '</thead>';
              echo '<tbody>';
                echo '<tr>';
                  echo '<td>';
                    echo '<label>';
                      echo 'Naziv';
                    echo '</label>';
                  echo '</td>';
                  echo '<td>';
                    echo '<input type="text" name="naziv" value="'.$kategorija->getNaziv().'" required/>';
                  echo '</td>';
                echo '</tr>';
                echo '<tr>';
                  echo '<td>';
                    echo '<label>';
                      echo 'Opis';
                    echo '</label>';
                  echo '</td>';
                  echo '<td>';
                    echo '<textarea name ="opis" rows="6" cols="22">';
                      echo $kategorija->getOpis();
                    echo '</textarea>';
                  echo '</td>';
                echo '</tr>';
                echo '<tr>';
                  echo '<td>';
                    echo '<label>';
                      echo 'Moderator';
                    echo '</label>';
                  echo '</td>';
                  echo '<td>';
                    echo '<select name=moderator_id required>';
                    echo '<option disabled>';
                      echo 'Odaberite Moderatora';
                    echo '</option>';
                    $moderatorKategorije = new KorisnikService;
                    $moderatorKategorije = $moderatorKategorije->dohvatiKorisnika($kategorija->getModeratorId());

                    foreach($moderatorKategorije as $moderator)
                    {
                      echo '<option selected value="'.$moderator->getKorisnikId().'">';
                        echo $moderator->getKorisnickoIme();
                      echo '</option>';
                    }
                    $moderatori = new KorisnikService;
                    $moderatori = $moderatori->dohvatiModeratoreOsim($kategorija->getModeratorId());

                    foreach($moderatori as $moderator)
                    {
                      echo '<option value="'.$moderator->getKorisnikId().'">';
                        echo $moderator->getKorisnickoIme();
                      echo '</option>';
                    }
                    echo '</select>';
                  echo '</td>';
                echo '</tr>';
              echo '</tbody>';
            echo '</table>';
            echo '<input type="hidden" value="azuriraj" name="kategorija"/>';
            echo '<input type="hidden" value="'.$_GET['kategorija_id'].'" name="kategorija_id"/>';
            echo '<button type="submit">';
              echo 'Ažuriraj';
            echo '</button>';
          }
        echo '</form>';
      echo '</div>';
    }
    else
    {
      header('Location: ../view/greska.php?greska=nemaKategorije');
    
      die();
    }
  }
  else
  {
    header('Location: ../view/greska.php?greska=pristupPodacima');
  
    die();
  }
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