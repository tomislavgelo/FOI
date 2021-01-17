<?php
include '../inc/header.php';

echo '<main>';
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
    $listaPrekrsaja = new PrekrsajService;
    $listaPrekrsaja = $listaPrekrsaja->dohvatiSvePrekrsaje();
    $trenutnaGodina = date("Y");

    $datumiPrekrsaja = [];

    foreach($listaPrekrsaja as $prekrsaj)
    {
      array_push($datumiPrekrsaja, $prekrsaj->getDatumPrekrsaja());
    }

    $godinePrekrsaja = [];

    while(min($datumiPrekrsaja) <= $trenutnaGodina)
    {
      array_push($godinePrekrsaja, $trenutnaGodina);
      $trenutnaGodina--;
    }
    $stupacaPoStranici = 15;
    $brojStranica = ceil(count($godinePrekrsaja)/$stupacaPoStranici);
    $listanje = ($stupacaPoStranici * $trenutnaStranica) - $stupacaPoStranici;
    echo '<table>';
      echo '<thead>';
        echo '<tr>';
          echo '<th>Kategorije</th>';
          $prikazGodina = array_slice($godinePrekrsaja, $listanje, $stupacaPoStranici);

          foreach ($prikazGodina as $godina)
          {
            echo '<th>'.$godina.'</th>';
          }
        echo '</tr>';
      echo '</thead>';
      echo '<tbody>';
        $listaKategorija = new KategorijaService;
        $listaKategorija = $listaKategorija->dohvatiSveKategorije();

        foreach($listaKategorija as $kategorija)
        {
          echo '<tr class="kategorija" onclick="sakrijPokazi(this)">';
            $kategorijaId = $kategorija->getKategorijaId();
            echo '<td class="naziv">'.$kategorija->getNaziv().'</td>';
            
            foreach($prikazGodina as $godina)
            {
              $brojPrekrsaja = new PrekrsajService;
              $brojPrekrsaja = $brojPrekrsaja->dohvatiPrekrsajePremaKategorijiPremaGodini(
                $kategorijaId, $godina
              );
              echo '<td style="visibility: hidden;">'.count($brojPrekrsaja).'</td>';
            }
          echo '</tr>';
        }
      echo '<tbody>';
    echo '</table>';
  echo '</div>';
  if($brojStranica > 1)
  {
    echo '<br/>';
    echo '<div>';
    $paginacija = new PaginacijaService;
    $paginacija = $paginacija->paginacija($stranica, $brojStranica, $trenutnaStranica);
    echo '</div>';
  }
echo '</main>';
echo '<hr/>';

include '../inc/footer.php';
?>