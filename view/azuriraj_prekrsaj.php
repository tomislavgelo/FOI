<?php
include '../inc/header.php';

echo '<main>';
if(isset($_SESSION['korisnik_id']) && isset($_SESSION['tip_id']))
{
  if($_SESSION['tip_id'] == 1)
  {
    $kategorijaPrekrsaja = new PrekrsajService;
    $kategorijaPrekrsaja = $kategorijaPrekrsaja->dohvatiPrekrsaj($_GET['prekrsaj_id']);

    $dohvacenaKategorija = [];

    foreach($kategorijaPrekrsaja as $kategorija)
    {
      array_push($dohvacenaKategorija, $kategorija->getKategorijaId());
    }

    $kategorijeModeratora = new KategorijaService;
    $kategorijeModeratora = $kategorijeModeratora->dohvatiKategorijeModeratora($_SESSION['korisnik_id']);

    $listaKategorija = [];

    foreach($kategorijeModeratora as $kategorije)
    {
      array_push($listaKategorija, $kategorije->getKategorijaId());
    }

    if(in_array($dohvacenaKategorija[0], $listaKategorija))
    {
      echo '<div>';
        echo '<form action="../controller/PrekrsajController.php" method="POST">';
          $dohvaceniPrekrsaj = new PrekrsajService;
          $dohvaceniPrekrsaj = $dohvaceniPrekrsaj->dohvatiPrekrsaj($_GET['prekrsaj_id']);

          foreach($dohvaceniPrekrsaj as $prekrsaj)
          {
            echo '<table>';
              echo '<thead>';
                echo '<tr>';
                  echo '<th colspan="2">Ažurirajte Prekršaj</th>';
                echo '</tr>';
              echo '</thead>';
              echo '<tbody>';
                echo '<tr>';
                  echo '<td>';
                    echo '<label>Kategorija: <label>';
                  echo '</td>';
                  echo '<td>';
                    echo '<select name="kategorija_id">';
                      echo '<option disabled>';
                        echo 'Odaberite Kategoriju';
                      echo '</option>';
                      echo '<option value ="'.$prekrsaj->getKategorijaId().'" selected>';
                      $kategorijaPrekrsaja = new KategorijaService;
                      $kategorijaPrekrsaja = $kategorijaPrekrsaja->dohvatiKategoriju($prekrsaj->getKategorijaId());

                      foreach($kategorijaPrekrsaja as $kategorija)
                      {
                        echo $kategorija->getNaziv();
                      }
                      echo '</option>';
                      $kategorije = new KategorijaService;
                      $kategorije = $kategorije->dohvatiKategorijeModeratoraOsim($_SESSION['korisnik_id'], $prekrsaj->getKategorijaId());

                      foreach($kategorije as $kategorija)
                      {
                        echo '<option value="'.$kategorija->getKategorijaId().'">';
                          echo $kategorija->getNaziv();
                        echo '</option>';
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
                      echo '<option disabled>';
                        echo 'Odaberite Vozilo';
                      echo '</option>';
                      $voziloPrekršaja = new VoziloService;
                      $voziloPrekršaja = $voziloPrekršaja->dohvatiVozilo($prekrsaj->getVoziloId());

                      foreach($voziloPrekršaja as $vozilo)
                      {
                        echo '<option selected value="'.$vozilo->getVoziloId().'">';
                          echo $vozilo->getRegistracija();
                        echo '</option>';
                      }
                    $vozila = new VoziloService;
                    $vozila = $vozila->dohvatiSvaVozilaOsim($prekrsaj->getVoziloId());
                    
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
                    echo '<input type="text" name="naziv" value="'.$prekrsaj->getNaziv().'" required/>';
                  echo '</td>';
                echo '</tr>';
                echo '<tr>';
                  echo '<td>';
                    echo '<label>Opis: <label>';
                  echo '</td>';
                  echo '<td>';
                    echo '<textarea name ="opis" rows="6" cols="22">';
                      echo $prekrsaj->getOpis();
                    echo '</textarea>';
                  echo '</td>';
                echo '</tr>';
                echo '<tr>';
                  echo '<td>';
                    echo '<label>Status: <label>';
                  echo '</td>';
                  echo '<td>';
                    echo '<select name ="status">';
                    if($prekrsaj->getStatus() == 'N')
                    {
                      echo '<option selected>N</option>';
                      echo '<option>P</option>';
                    }
                    else
                    {
                      echo '<option>N</option>';
                      echo '<option selected>P</option>';
                    }
                    echo '</select>';
                  echo '</td>';
                echo '</tr>';
                echo '<tr>';
                  echo '<td>';
                    echo '<label>Novčana Kazna (hrk): <label>';
                  echo '</td>';
                  echo '<td>';
                    echo '<input type="number" name="novcana_kazna" value="'.$prekrsaj->getNovcanaKazna().'" required/>';
                  echo '</td>';
                echo '</tr>';
                echo '<tr>';
                  echo '<td>';
                    echo '<label>Datum Prekršaja: <label>';
                  echo '</td>';
                  echo '<td>';
                  $datum = $prekrsaj->getDatumPrekrsaja();
                  $rastavljeniDatum = explode('-', $datum);
                  $obrnutiDatum = array_reverse($rastavljeniDatum);
                  $noviDatum = implode('.', $obrnutiDatum);
                    echo '<input type="text" name="datum_prekrsaja" value="'.$noviDatum.'" required/>';
                  echo '</td>';
                echo '</tr>';
                echo '<tr>';
                  echo '<td>';
                    echo '<label>Vrijeme Prekršaja: <label>';
                  echo '</td>';
                  echo '<td>';
                    echo '<input type="text" name="vrijeme_prekrsaja" value="'.$prekrsaj->getVrijemePrekrsaja().'" required/>';
                  echo '</td>';
                echo '</tr>';
                echo '<tr>';
                  echo '<td>';
                    echo '<label>Datum Plaćanja: <label>';
                  echo '</td>';
                  echo '<td>';
                  $datum = $prekrsaj->getDatumPlacanja();
                  $rastavljeniDatum = explode('-', $datum);
                  $obrnutiDatum = array_reverse($rastavljeniDatum);
                  $noviDatum = implode('.', $obrnutiDatum);
                    echo '<input type="text" name="datum_placanja" value="'.$noviDatum.'" />';
                  echo '</td>';
                echo '</tr>';
                echo '<tr>';
                  echo '<td>';
                    echo '<label>Vrijeme Plaćanja: <label>';
                  echo '</td>';
                  echo '<td>';
                    echo '<input type="text" name="vrijeme_placanja" value="'.$prekrsaj->getVrijemePlacanja().'" />';
                  echo '</td>';
                echo '</tr>';
                echo '<tr>';
                  echo '<td>';
                    echo '<label>Slika: <label>';
                  echo '</td>';
                  echo '<td>';
                    echo '<input type="text" name="slika" value="'.$prekrsaj->getSlika().'" required/>';
                  echo '</td>';
                echo '</tr>';
                echo '<tr>';
                  echo '<td>';
                    echo '<label>Video: <label>';
                  echo '</td>';
                  echo '<td>';
                    echo '<input type="text" name="video" value="'.$prekrsaj->getVideo().'" />';
                  echo '</td>';
                echo '</tr>';
              echo '</tbody>';
            echo '</table>';
            echo '<input type="hidden" value="azuriraj" name="prekrsaj"/>';
            echo '<input type="hidden" value="'.$_GET['prekrsaj_id'].'" name="prekrsaj_id"/>';
            echo '<button type="submit">';
              echo 'Ažuriraj';
            echo '</button>';
          }  
        echo '</form>';
      echo '</div>';
    }
    else
    {
      header('Location: ../view/greska.php?greska=pristupPodacima');

      die();
    }
  }
  elseif($_SESSION['tip_id'] == 0)
  {
    echo '<div>';
      echo '<form action="../controller/PrekrsajController.php" method="POST">';
        $dohvaceniPrekrsaj = new PrekrsajService;
        $dohvaceniPrekrsaj = $dohvaceniPrekrsaj->dohvatiPrekrsaj($_GET['prekrsaj_id']);

        foreach($dohvaceniPrekrsaj as $prekrsaj)
        {
          echo '<table>';
            echo '<thead>';
              echo '<tr>';
                echo '<th colspan="2">Ažurirajte Prekršaj</th>';
              echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
              echo '<tr>';
                echo '<td>';
                  echo '<label>Kategorija: <label>';
                echo '</td>';
                echo '<td>';
                  echo '<select name="kategorija_id">';
                    echo '<option disabled>';
                      echo 'Odaberite Kategoriju';
                    echo '</option>';
                    echo '<option value ="'.$prekrsaj->getKategorijaId().'" selected>';
                    $kategorijaPrekrsaja = new KategorijaService;
                    $kategorijaPrekrsaja = $kategorijaPrekrsaja->dohvatiKategoriju($prekrsaj->getKategorijaId());

                    foreach($kategorijaPrekrsaja as $kategorija)
                    {
                      echo $kategorija->getNaziv();
                    }
                    echo '</option>';
                    $kategorije = new KategorijaService;
                    $kategorije = $kategorije->dohvatiSveKategorijeOsim($prekrsaj->getKategorijaId());

                    foreach($kategorije as $kategorija)
                    {
                      echo '<option value="'.$kategorija->getKategorijaId().'">';
                        echo $kategorija->getNaziv();
                      echo '</option>';
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
                    echo '<option disabled>';
                      echo 'Odaberite Vozilo';
                    echo '</option>';
                    $voziloPrekršaja = new VoziloService;
                    $voziloPrekršaja = $voziloPrekršaja->dohvatiVozilo($prekrsaj->getVoziloId());

                    foreach($voziloPrekršaja as $vozilo)
                    {
                      echo '<option selected value="'.$vozilo->getVoziloId().'">';
                        echo $vozilo->getRegistracija();
                      echo '</option>';
                    }
                  $vozila = new VoziloService;
                  $vozila = $vozila->dohvatiSvaVozilaOsim($prekrsaj->getVoziloId());
                  
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
                  echo '<input type="text" name="naziv" value="'.$prekrsaj->getNaziv().'" required/>';
                echo '</td>';
              echo '</tr>';
              echo '<tr>';
                echo '<td>';
                  echo '<label>Opis: <label>';
                echo '</td>';
                echo '<td>';
                  echo '<textarea name ="opis" rows="6" cols="22">';
                    echo $prekrsaj->getOpis();
                  echo '</textarea>';
                echo '</td>';
              echo '</tr>';
              echo '<tr>';
                echo '<td>';
                  echo '<label>Status: <label>';
                echo '</td>';
                echo '<td>';
                  echo '<select name ="status">';
                  if($prekrsaj->getStatus() == 'N')
                  {
                    echo '<option selected>N</option>';
                    echo '<option>P</option>';
                  }
                  else
                  {
                    echo '<option>N</option>';
                    echo '<option selected>P</option>';
                  }
                  echo '</select>';
                echo '</td>';
              echo '</tr>';
              echo '<tr>';
                echo '<td>';
                  echo '<label>Novčana Kazna (hrk): <label>';
                echo '</td>';
                echo '<td>';
                  echo '<input type="number" name="novcana_kazna" value="'.$prekrsaj->getNovcanaKazna().'" required/>';
                echo '</td>';
              echo '</tr>';
              echo '<tr>';
                echo '<td>';
                  echo '<label>Datum Prekršaja: <label>';
                echo '</td>';
                echo '<td>';
                $datum = $prekrsaj->getDatumPrekrsaja();
                $rastavljeniDatum = explode('-', $datum);
                $obrnutiDatum = array_reverse($rastavljeniDatum);
                $noviDatum = implode('.', $obrnutiDatum);
                  echo '<input type="text" name="datum_prekrsaja" value="'.$noviDatum.'" required/>';
                echo '</td>';
              echo '</tr>';
              echo '<tr>';
                echo '<td>';
                  echo '<label>Vrijeme Prekršaja: <label>';
                echo '</td>';
                echo '<td>';
                  echo '<input type="text" name="vrijeme_prekrsaja" value="'.$prekrsaj->getVrijemePrekrsaja().'" required/>';
                echo '</td>';
              echo '</tr>';
              echo '<tr>';
                echo '<td>';
                  echo '<label>Datum Plaćanja: <label>';
                echo '</td>';
                echo '<td>';
                $datum = $prekrsaj->getDatumPlacanja();
                $rastavljeniDatum = explode('-', $datum);
                $obrnutiDatum = array_reverse($rastavljeniDatum);
                $noviDatum = implode('.', $obrnutiDatum);
                  echo '<input type="text" name="datum_placanja" value="'.$noviDatum.'" />';
                echo '</td>';
              echo '</tr>';
              echo '<tr>';
                echo '<td>';
                  echo '<label>Vrijeme Plaćanja: <label>';
                echo '</td>';
                echo '<td>';
                  echo '<input type="text" name="vrijeme_placanja" value="'.$prekrsaj->getVrijemePlacanja().'" />';
                echo '</td>';
              echo '</tr>';
              echo '<tr>';
                echo '<td>';
                  echo '<label>Slika: <label>';
                echo '</td>';
                echo '<td>';
                  echo '<input type="text" name="slika" value="'.$prekrsaj->getSlika().'" required/>';
                echo '</td>';
              echo '</tr>';
              echo '<tr>';
                echo '<td>';
                  echo '<label>Video: <label>';
                echo '</td>';
                echo '<td>';
                  echo '<input type="text" name="video" value="'.$prekrsaj->getVideo().'" />';
                echo '</td>';
              echo '</tr>';
            echo '</tbody>';
          echo '</table>';
          echo '<input type="hidden" value="azuriraj" name="prekrsaj"/>';
          echo '<input type="hidden" value="'.$_GET['prekrsaj_id'].'" name="prekrsaj_id"/>';
          echo '<button type="submit">';
            echo 'Ažuriraj';
          echo '</button>';
        }  
      echo '</form>';
    echo '</div>';
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