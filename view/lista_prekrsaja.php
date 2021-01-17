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
  if(isset($_GET['kategorija_id']))
  { 
    $stranica = basename($_SERVER['SCRIPT_FILENAME']).'?kategorija_id='.$_GET['kategorija_id'];
  }
  else
  {
    $stranica = basename($_SERVER['SCRIPT_FILENAME']);
  }
  if($_SESSION['tip_id'] == 1)
  {
    $kategorije = new KategorijaService;
    $kategorije = $kategorije->dohvatiKategorijeModeratora($_SESSION['korisnik_id']);

    echo '<form action="../controller/PrekrsajController.php" method="POST">';

    $mojeKategorije = [];

    foreach($kategorije as $kategorija)
    {
      array_push($mojeKategorije, $kategorija->getKategorijaId());
    }
    if(isset($_GET['kategorija_id']) && $_GET['kategorija_id'] != null)
    {
      if(isset($_GET['kategorija_id']) && in_array($_GET['kategorija_id'], $mojeKategorije))
      {
        $prekrsajiKategorije = new PrekrsajService;
        $prekrsajiKategorije = $prekrsajiKategorije->dohvatiPrekrsajePremaKategoriji($_GET['kategorija_id']);
        $rezultataPoStranici = 5;
        $brojStranica = ceil(count($prekrsajiKategorije)/$rezultataPoStranici);
        $listanje = ($rezultataPoStranici * $trenutnaStranica) - $rezultataPoStranici;
        $prikazPrekrsaja = array_slice($prekrsajiKategorije, $listanje, $rezultataPoStranici);
        if($prekrsajiKategorije != null)
        {
          echo '<table>';
            echo '<thead>';
              echo '<tr>';
                echo '<th>Vozilo</th>';
                echo '<th>Naziv</th>';
                echo '<th>Opis</th>';
                echo '<th>Status</th>';
                echo '<th>Novčana Kazna</th>';
                echo '<th>Datum Prekršaja</th>';
                echo '<th>Vrijeme Prekršaja</th>';
                echo '<th>Datum Plaćanja</th>';
                echo '<th>Vrijeme Plaćanja</th>';
                echo '<th>Slika</th>';
                echo '<th>Video</th>';
              echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
            foreach($prikazPrekrsaja as $prekrsaj)
            {
              echo '<tr>';
                echo '<td>';
                $voziloPrekrsaja = new VoziloService;
                $voziloPrekrsaja = $voziloPrekrsaja->dohvatiVozilo($prekrsaj->getVoziloId());

                foreach($voziloPrekrsaja as $vozilo)
                {
                  echo $vozilo->getRegistracija();
                }
                echo '</td>';
                echo '<td>';
                  echo '<a href="azuriraj_prekrsaj.php?prekrsaj_id='.$prekrsaj->getPrekrsajId().'">'.$prekrsaj->getNaziv().'</a>';
                echo '</td>';
                echo '<td>';
                  echo $prekrsaj->getOpis();
                echo '</td>';
                echo '<td>';
                  echo $prekrsaj->getStatus();
                echo '</td>';
                echo '<td>';
                  echo $prekrsaj->getNovcanaKazna().',00 kn';
                echo '</td>';
                echo '<td>';
                  echo $prekrsaj->getDatumPrekrsaja();
                echo '</td>';
                echo '<td>';
                  echo $prekrsaj->getVrijemePrekrsaja();
                echo '</td>';
                echo '<td>';
                  echo $prekrsaj->getDatumPlacanja();
                echo '</td>';
                echo '<td>';
                  echo $prekrsaj->getVrijemePlacanja();
                echo '</td>';
                echo '<td>';
                  echo '<img src="'.$prekrsaj->getSlika().'" alt="Slika prekršaja" height="240" width="300">';
                echo '</td>';
                echo '<td>';
                  if(is_int(strpos($prekrsaj->getVideo(), 'embed')))
                  {
                    echo '<iframe src="'.$prekrsaj->getVideo().'" height="240" width="300"></iframe>';
                  }
                  elseif(is_int(strpos($prekrsaj->getVideo(), 'watch?v=')))
                  {
                    $video = str_replace('watch?v=', 'embed/', $prekrsaj->getVideo());
                    echo '<iframe src="'.$video.'" height="240" width="300"></iframe>';
                  }
                  elseif(is_int(strpos($prekrsaj->getVideo(), 'https'))) 
                  {
                    echo '<video height="240" width="300" controls>';
                      echo '<source src="'.$prekrsaj->getVideo().'">';
                    echo '</video>';
                  }
                  else
                  {
                    echo '<p>Ne postoji video zapis!</p>';
                  }
                echo '</td>';
              echo '</tr>';
            }
            echo '</tbody>';
          echo '</table>';
          echo '<br/>';
        }
        else
        {
          echo '<p>Ne postoje zapisi o prekršajima u traženoj kategoriji</p>';
        }
      }
      elseif(isset($_GET['kategorija_id']) && !in_array($_GET['kategorija_id'], $mojeKategorije)) 
      {
        header('Location: ../view/greska.php?greska=krivaKategorija');

        die();
      }
    }
    elseif(isset($_GET['kategorija_id']) && $_GET['kategorija_id'] == null)
    {
      header('Location: moje_kategorije.php');
    }
    echo '<a href="dodaj_novi_prekrsaj.php">Dodaj Novi Prekršaj</a>';
    echo '</form>';
    echo '<br/>';
  }
  elseif($_SESSION['tip_id'] == 0)
  {
    echo '<form action="../controller/PrekrsajController.php" method="POST">';
    if(isset($_GET['kategorija_id']) && $_GET['kategorija_id'] != null)
    {
      $prekrsajiKategorije = new PrekrsajService;
      $prekrsajiKategorije = $prekrsajiKategorije->dohvatiPrekrsajePremaKategoriji($_GET['kategorija_id']);
      $rezultataPoStranici = 5;
      $brojStranica = ceil(count($prekrsajiKategorije)/$rezultataPoStranici);
      $listanje = ($rezultataPoStranici * $trenutnaStranica) - $rezultataPoStranici;
      $prikazPrekrsaja = array_slice($prekrsajiKategorije, $listanje, $rezultataPoStranici);
      if($prekrsajiKategorije != null)
      {
        echo '<table>';
          echo '<thead>';
            echo '<tr>';
              echo '<th>Vozilo</th>';
              echo '<th>Naziv</th>';
              echo '<th>Opis</th>';
              echo '<th>Status</th>';
              echo '<th>Novčana Kazna</th>';
              echo '<th>Datum Prekršaja</th>';
              echo '<th>Vrijeme Prekršaja</th>';
              echo '<th>Datum Plaćanja</th>';
              echo '<th>Vrijeme Plaćanja</th>';
              echo '<th>Slika</th>';
              echo '<th>Video</th>';
            echo '</tr>';
          echo '</thead>';
          echo '<tbody>';
          foreach($prikazPrekrsaja as $prekrsaj)
          {
            echo '<tr>';
              echo '<td>';
                $voziloPrekrsaja = new VoziloService;
                $voziloPrekrsaja = $voziloPrekrsaja->dohvatiVozilo($prekrsaj->getVoziloId());

                foreach($voziloPrekrsaja as $vozilo)
                {
                  echo $vozilo->getRegistracija();
                }
                echo '</td>';
              echo '<td>';
                echo '<a href="azuriraj_prekrsaj.php?prekrsaj_id='.$prekrsaj->getPrekrsajId().'">'.$prekrsaj->getNaziv().'</a>';
              echo '</td>';
              echo '<td>';
                echo $prekrsaj->getOpis();
              echo '</td>';
              echo '<td>';
                echo $prekrsaj->getStatus();
              echo '</td>';
              echo '<td>';
                echo $prekrsaj->getNovcanaKazna().',00 kn';
              echo '</td>';
              echo '<td>';
                echo $prekrsaj->getDatumPrekrsaja();
              echo '</td>';
              echo '<td>';
                echo $prekrsaj->getVrijemePrekrsaja();
              echo '</td>';
              echo '<td>';
                echo $prekrsaj->getDatumPlacanja();
              echo '</td>';
              echo '<td>';
                echo $prekrsaj->getVrijemePlacanja();
              echo '</td>';
              echo '<td>';
                echo '<img src="'.$prekrsaj->getSlika().'" alt="Slika prekršaja" height="240" width="300">';
              echo '</td>';
              echo '<td>';
                if(is_int(strpos($prekrsaj->getVideo(), 'embed')))
                {
                  echo '<iframe src="'.$prekrsaj->getVideo().'" height="240" width="300"></iframe>';
                }
                elseif(is_int(strpos($prekrsaj->getVideo(), 'watch?v=')))
                {
                  $video = str_replace('watch?v=', 'embed/', $prekrsaj->getVideo());
                  echo '<iframe src="'.$video.'" height="240" width="300"></iframe>';
                }
                elseif(is_int(strpos($prekrsaj->getVideo(), 'https'))) 
                {
                  echo '<video height="240" width="300" controls>';
                    echo '<source src="'.$prekrsaj->getVideo().'">';
                  echo '</video>';
                }
                else
                {
                  echo '<p>Ne postoji video zapis!</p>';
                }
              echo '</td>';
            echo '</tr>';
          }
          echo '</tbody>';
        echo '</table>';
        echo '<br/>';
      }
      else
      {
        echo '<p>Ne postoje zapisi o prekršajima u traženoj kategoriji</p>';
      }
      echo '<a href="dodaj_novi_prekrsaj.php">Dodaj Novi Prekršaj</a>';
    }
    elseif(isset($_GET['kategorija_id']) && $_GET['kategorija_id'] == null)
    {
      header('Location: moje_kategorije.php');
    }
    echo '</form>';
    echo '<br/>';
  }
        
  if($brojStranica > 1)
  {
    echo '<div>';
    $paginacija = new PaginacijaService;
    $paginacija = $paginacija->paginacija($stranica, $brojStranica, $trenutnaStranica);
    echo '</div>';
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