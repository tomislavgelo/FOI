<?php
include '../inc/header.php';

echo '<main>';
if(isset($_SESSION['korisnik_id']) && isset($_SESSION['tip_id']))
{
  if($_SESSION['tip_id'] <= 1)
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
      $rezultataPoStranici = 20;
      $brojStranica = ceil(count($korisnici)/$rezultataPoStranici);
      $listanje = ($rezultataPoStranici * $trenutnaStranica) - $rezultataPoStranici;
      $prikazKorisnika = array_slice($korisnici, $listanje, $rezultataPoStranici);
      echo '<table>';
        echo '<thead>';
          echo '<tr>';
            echo '<th>';
              echo 'Korisničko Ime';
            echo '</th>';
            echo '<th>';
              echo 'Neplaćeni Prekršaji';
            echo '</th>';
            echo '<th>';
              echo 'Plaćeni Prekršaji';
            echo '</th>';
            echo '<th>';
              echo 'Ukupno';
            echo '</th>';
          echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
          foreach($prikazKorisnika as $korisnik)
          {
            echo '<tr>';
              echo '<td>';
                echo $korisnik->getKorisnickoIme();
              echo '</td>';
                $dohvaceniPrekrsaji = new PrekrsajService;
                $dohvaceniPrekrsaji = $dohvaceniPrekrsaji->dohvatiPrekrsajePremaKorisniku($korisnik->getKorisnikId());

                $placeniPrekrsaji = [];
                $nePlaceniPrekrsaji = [];

                foreach($dohvaceniPrekrsaji as $prekrsaji)
                {
                  $status = $prekrsaji->getStatus();
                  if($status == 'N')
                  {
                    array_push($nePlaceniPrekrsaji, $prekrsaji);
                  }
                  else
                  {
                    array_push($placeniPrekrsaji, $prekrsaji);
                  }
                }
              echo '<td>';
                echo count($nePlaceniPrekrsaji);
              echo '</td>';
              echo '<td>';
                echo count($placeniPrekrsaji);
              echo '</td>';
              echo '<td>';
                echo count($nePlaceniPrekrsaji) + count($placeniPrekrsaji);
              echo '</td>';            
            echo '</tr>';
          }
          echo '<tr>';
            echo '<td>';
              echo '<font face="Symbol">&#229;</font>';
            echo '</td>';
              $sumaPrekrsaja = new PrekrsajService;
              $sumaPrekrsaja = $sumaPrekrsaja->dohvatiSvePrekrsaje();

              $placeniPrekrsajiSuma = [];
              $nePlaceniPrekrsajiSuma = [];

              foreach($sumaPrekrsaja as $prekrsaji)
              {
                $status = $prekrsaji->getStatus();
                if($status == 'N')
                {
                  array_push($nePlaceniPrekrsajiSuma, $prekrsaji);
                }
                else
                {
                  array_push($placeniPrekrsajiSuma, $prekrsaji);
                }
              }
            echo '<td>';
              echo count($nePlaceniPrekrsajiSuma);
            echo '</td>';
            echo '<td>';
              echo count($placeniPrekrsajiSuma);
            echo '</td>';
            echo '<td>';
              echo count($nePlaceniPrekrsajiSuma) + count($placeniPrekrsajiSuma);
            echo '</td>';
          echo '</tr>';
        echo '</tbody>';
      echo '</table>';
     echo '<br/>';
    echo '</div>';
    echo '<br/>';
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