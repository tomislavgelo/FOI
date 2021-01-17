<?php
include '../inc/header.php';

echo '<main>';
if(isset($_SESSION['korisnik_id']) && isset($_SESSION['tip_id']))
{
  if($_SESSION['tip_id'] == 0)
  {
    echo '<div>';
      echo '<form action="../controller/PrekrsajController.php" method="POST">';
        echo '<label>';
          echo 'Od: ';
        echo '</label>';
        echo '<input type="text" name="datum_od" placeholder="dd.mm.gggg"/>';
        echo '<br/>';
        echo '<label>';
          echo 'Do: ';
        echo '</label>';
        echo '<input type="text" name="datum_do" placeholder="dd.mm.gggg"/>';
        echo '<input type="hidden" value="razdoblje" name="prekrsaj"/>';
        echo '<br/>';
        echo '<button type="submit">';
          echo 'Prikaži';
        echo '</button>';
      echo '</form>';
    echo '</div>';
    if(isset($_GET['datum_od']) && isset($_GET['datum_do']))
    {
      list($godinaOd, $mjesecOd, $danOd) = explode('-', $_GET['datum_od']);
      list($godinaDo, $mjesecDo, $danDo) = explode('-', $_GET['datum_do']);

      if(checkdate($mjesecOd, $danOd, $godinaOd) == true && checkdate($mjesecDo, $danDo, $godinaDo) == true)
      {   
        echo '<div>';
          $korisnici = new KorisnikService;
          $korisnici = $korisnici->top20($_GET['datum_od'], $_GET['datum_do']);
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
              foreach($korisnici as $korisnik)
              {
                echo '<tr>';
                  echo '<td>';
                    echo $korisnik->getKorisnickoIme();
                  echo '</td>';
                    $dohvaceniPrekrsaji = new PrekrsajService;
                    $dohvaceniPrekrsaji = $dohvaceniPrekrsaji->dohvatiPrekrsajePremaKorisnikuRazdoblje($_GET['datum_od'], $_GET['datum_do'], $korisnik->getKorisnikId());
                    
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
                  echo 'Razdoblje ';
                  echo '<font face="Symbol">&#229;</font>';
                echo '</td>';
                  $sumaPrekrsaja = new PrekrsajService;
                  $sumaPrekrsaja = $sumaPrekrsaja->dohvatiPrekrsajeRazdoblje($_GET['datum_od'], $_GET['datum_do']);

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
        echo '</div>';
      }
      else
      {
        header('Location: ../view/greska.php?greska=formatDatuma');
    
        die();
      }
    }
    else
    {
      echo '<div>';
        echo '<p>';
          echo 'Unesite datume kako bi vidjeli podatke za traženo razdoblje.';
        echo '</p>';
      echo '</div>';
    }
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
echo '</main>';
echo '<hr/>';

include '../inc/footer.php';
?>