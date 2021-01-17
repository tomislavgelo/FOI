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
  $stranica = basename($_SERVER['SCRIPT_FILENAME']);
  $mojaVozila = new VoziloService;
  $mojaVozila = $mojaVozila->dohvatiVozilaPremaKorisniku($_SESSION['korisnik_id']);
  $rezultataPoStranici = 5;
  $brojStranica = ceil(count($mojaVozila)/$rezultataPoStranici);
  $listanje = ($rezultataPoStranici * $trenutnaStranica) - $rezultataPoStranici;
  $prikazVozila = array_slice($mojaVozila, $listanje, $rezultataPoStranici);
  echo '<div>';
  if($mojaVozila != null)
  {
    echo '<table>';
      echo '<tr>';
        echo '<th>Registracija</th>';
        echo '<th>Marka Vozila</th>';
        echo '<th>Model/Tip Vozila</th>';
        echo '<th>Ažuriranje</th>';
      echo '</tr>';
      foreach($prikazVozila as $vozilo)
      {
        echo '<tr>';
          echo '<td>'.$vozilo->getRegistracija().'</td>';
          echo '<td>'.$vozilo->getMarkaVozila().'</td>';
          echo '<td>'.$vozilo->getTipVozila().'</td>';
          echo '<td>';
            echo '<a href="azuriraj_vozilo.php?vozilo_id='.$vozilo->getVoziloId().'">Uredi Vozilo</a>';
          echo '</td>';
        echo '</tr>';
      }
    echo '</table>';
    echo '<br/>';
    echo '<div>';
      echo '<a href="dodaj_novo_vozilo.php">Dodaj Novo Vozilo</a>';
    echo '<div>';
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
    echo '<pre>';
      echo '
      Izgleda da nemate prijavljenih vozila.
      Ispod je link koji Vas vodi na formu za unos novog Vozila.
      Obavezan je unos svih podataka, te se pri unosu registracije držite traženog formata!';
    echo '</pre>';
    echo '<div>';
      echo '<a href="dodaj_novo_vozilo.php">Dodaj Novo Vozilo</a>';
    echo '<div>';
  } 
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