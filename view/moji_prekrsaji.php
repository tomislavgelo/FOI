<?php
include '../inc/header.php';

echo '<main>';
if(isset($_SESSION['korisnik_id']) && $_SESSION['tip_id'] <= 2)
{
  if(isset($_GET['stranica']))
  {
    $trenutnaStranica = $_GET['stranica'];
  }
  else
  {
    $trenutnaStranica = 1;
  }
  if(isset($_GET['vozilo_id']))
  { 
    $stranica = basename($_SERVER['SCRIPT_FILENAME']).'?vozilo_id='.$_GET['vozilo_id'];
  }
  else
  {
    $stranica = basename($_SERVER['SCRIPT_FILENAME']);
  }
  $vozila = new VoziloService;
  $vozila = $vozila->dohvatiVozilaPremaKorisniku($_SESSION['korisnik_id']);

  echo '<form action="../controller/PrekrsajController.php" method="POST">';
  if($vozila == null)
  {
    echo '<p>Nema vozila, nema prekršaja :)</p>';
  }
  else
  {
    echo '<table>';
      echo '<thead>';
        echo '<tr>';
          echo '<th>';
            echo '<label>Odaberite Vozilo</label>';
          echo '</th>';
          echo '<th>';
            echo '<select name="vozilo_id">';
              echo '<option selected disabled>Odaberite Vozilo</option>';

              foreach($vozila as $vozilo)
              {
                echo '<option value="'.$vozilo->getVoziloId().'">';
                  echo $vozilo->getRegistracija();
                echo '</option>';
              }
            echo '</select>';
          echo '</th>';
          echo '<th>';
            echo '<input type="hidden" value="prikazi" name="prekrsaj">';
            echo '<button type="submit">Prikaži Prekršaje</button>';
          echo '</th>';
        echo '</tr>';
      echo '</thead>';
    echo '</table>';

    $mojaVozila = [];

    foreach($vozila as $vozilo)
    {
      array_push($mojaVozila, $vozilo->getVoziloId());
    }
    if(isset($_GET['vozilo_id']) && $_GET['vozilo_id'] != null)
    {
      if(isset($_GET['vozilo_id']) && in_array($_GET['vozilo_id'], $mojaVozila))
      {
        $mojiPrekrsaji = new PrekrsajService;
        $mojiPrekrsaji = $mojiPrekrsaji->dohvatiPrekrsajePremaVozilu($_GET['vozilo_id']);
        $rezultataPoStranici = 3;
        $brojStranica = ceil(count($mojiPrekrsaji)/$rezultataPoStranici);
        $listanje = ($rezultataPoStranici * $trenutnaStranica) - $rezultataPoStranici;
        $prikazPrekrsaja = array_slice($mojiPrekrsaji, $listanje, $rezultataPoStranici);
        if($mojiPrekrsaji != null)
        {
          echo '<table>';
            echo '<thead>';
              echo '<tr>';
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
                  if($prekrsaj->getStatus() == 'P')
                  {
                    echo '<p>'.$prekrsaj->getNaziv().'</p>';
                  }
                  else
                  {
                    echo '<a href="placanje_prekrsaja.php?vozilo_id='.$_GET['vozilo_id'].'&prekrsaj_id='.$prekrsaj->getPrekrsajId().'" class="test">';
                      echo $prekrsaj->getNaziv();
                    echo '</a>';
                  }
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
          echo '<p>Bravo! Vaše vozilo nema prekršaja!</p>';
        }
      }
      elseif(isset($_GET['vozilo_id']) && !in_array($_GET['vozilo_id'], $mojaVozila)) 
      {
        header('Location: ../view/greska.php?greska=pristupPodacima');
      
        die();
      }
    }
    elseif(isset($_GET['vozilo_id']) && $_GET['vozilo_id'] == null)
    {
      header('Location: ../view/greska.php?greska=odabirVozila');
      
      die();
    }
  echo '</form>';
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