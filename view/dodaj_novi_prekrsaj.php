<?php
include '../inc/header.php';

echo '<main>';
if(isset($_SESSION['korisnik_id']) && $_SESSION['tip_id'] <= 1)
{
  echo '<div>';
    echo '<form action="../controller/PrekrsajController.php" method="POST">';
      echo '<table>';
        echo '<thead>';
          echo '<tr>';
            echo '<th colspan="2">Unesite Novi Prekršaj</th>';
          echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
          echo '<tr>';
            echo '<td>';
              echo '<label>Kategorija: <label>';
            echo '</td>';
            echo '<td>';
              echo '<select name="kategorija_id" required>';
                echo '<option selected disabled>';
                  echo 'Odaberite Kategoriju';
                echo '</option>';
                if($_SESSION['tip_id'] == 1)
                {
                  $kategorije = new KategorijaService;
                  $kategorije = $kategorije->dohvatiKategorijeModeratora($_SESSION['korisnik_id']);

                  foreach($kategorije as $kategorija)
                  {
                    echo '<option value="'.$kategorija->getKategorijaId().'">';
                      echo $kategorija->getNaziv();
                    echo '</option>';
                  }
                }
                elseif($_SESSION['tip_id'] == 0)
                {
                  $kategorije = new KategorijaService;
                  $kategorije = $kategorije->dohvatiSveKategorije();

                  foreach($kategorije as $kategorija)
                  {
                    echo '<option value="'.$kategorija->getKategorijaId().'">';
                      echo $kategorija->getNaziv();
                    echo '</option>';
                  }
                }
              echo '</select>';
            echo '</td>';
          echo '</tr>';
          echo '<tr>';
            echo '<td>';
              echo '<label>Registracija: <label>';
            echo '</td>';
            echo '<td>';
              echo '<select name=vozilo_id required>';
                echo '<option selected disabled>';
                  echo 'Odaberite Vozilo';
                echo '</option>';
              $vozila = new VoziloService;
              $vozila = $vozila->dohvatiSvaVozila();
              
              foreach($vozila as $vozilo)
              {
                echo '<option value="'.$vozilo->getVoziloId().'">';
                  echo $vozilo->getRegistracija();
                echo '</option>';
              }
              echo '</select>';
            echo '</td>';
          echo '</tr>';
          echo '<tr>';
            echo '<td>';
              echo '<label>Naziv: <label>';
            echo '</td>';
            echo '<td>';
              echo '<input type="text" name="naziv" placeholder="Naziv prekršaja" required/>';
            echo '</td>';
          echo '</tr>';
          echo '<tr>';
            echo '<td>';
              echo '<label>Opis: <label>';
            echo '</td>';
            echo '<td>';
              echo '<textarea name ="opis" placeholder="Opišite prekršaj..." rows="6" cols="22" required>';
              echo '</textarea>';
            echo '</td>';
          echo '</tr>';
          echo '<tr>';
            echo '<td>';
              echo '<label>Novčana Kazna (hrk): <label>';
            echo '</td>';
            echo '<td>';
              echo '<input type="number" name="novcana_kazna" required/>';
            echo '</td>';
          echo '</tr>';
          echo '<tr>';
            echo '<td>';
              echo '<label>Datum Prekršaja: <label>';
            echo '</td>';
            echo '<td>';
              echo '<input type="text" name="datum_prekrsaja" placeholder="dd.mm.gggg" required/>';
            echo '</td>';
          echo '</tr>';
          echo '<tr>';
            echo '<td>';
              echo '<label>Vrijeme Prekršaja: <label>';
            echo '</td>';
            echo '<td>';
              echo '<input type="text" name="vrijeme_prekrsaja" placeholder ="hh:mm:ss" required/>';
            echo '</td>';
          echo '</tr>';
          echo '<tr>';
            echo '<td>';
              echo '<label>Slika: <label>';
            echo '</td>';
            echo '<td>';
              echo '<input type="text" name="slika" placeholder="link do slike" required/>';
            echo '</td>';
          echo '</tr>';
          echo '<tr>';
            echo '<td>';
              echo '<label>Video: <label>';
            echo '</td>';
            echo '<td>';
              echo '<input type="text" name="video" placeholder ="link do videa" />';
            echo '</td>';
          echo '</tr>';
        echo '</tbody>';
      echo '</table>';
      echo '<input type="hidden" value="dodaj" name="prekrsaj"/>';
      echo '<button type="submit">';
        echo 'Unesi';
      echo '</button>';
    echo '</form>';
  echo '</div>';
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