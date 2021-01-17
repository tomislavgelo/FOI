<?php
include '../inc/header.php';

echo '<main>';
if(isset($_SESSION['korisnik_id']) && $_SESSION['tip_id'] <= 2)
{
  $provjera = new PrekrsajService;
  $provjera = $provjera->dohvatiPrekrsajePremaVozilu($_GET['vozilo_id']);

  $mojiPrekrsaji = [];

  foreach($provjera as $prekrsaj)
  {
    array_push($mojiPrekrsaji, $prekrsaj->getPrekrsajId());
  }
  if(isset($_GET['prekrsaj_id']) && in_array($_GET['prekrsaj_id'], $mojiPrekrsaji))
  {
    echo '<div>';
    echo '<form action="../controller/PrekrsajController.php" method="POST">';
      echo '<table>';
        echo '<thead>';
          echo '<tr>';
            echo '<th>Plaćanje Prekršaja</th>';
          echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
          echo '<tr>';
            echo '<td>';
              echo '<label>Datum Plaćanja</label>';
            echo '</td>';
            echo '<td>';
              echo '<input type="text" value="'.date('d.m.Y').'" name="datum_placanja"/>';
            echo '</td>';
          echo '</tr>';
          echo '<tr>';
            echo '<td>';
              echo '<label>Vrijeme Plaćanja</label>';
            echo '</td>';
            echo '<td>';
              echo '<input type="text" value="'.date('H:i:s').'" name="vrijeme_placanja"/>';
            echo '</td>';
          echo '</tr>';
        echo '</tbody>';
      echo '</table>';
      echo '<input type="hidden" name="prekrsaj_id" value="'.$_GET['prekrsaj_id'].'"/>';
      echo '<input type="hidden" name="vozilo_id" value="'.$_GET['vozilo_id'].'"/>';
      echo '<input type="hidden" name="prekrsaj" value="plati"/>';
      echo '<button type="submit">Plati</button>';
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