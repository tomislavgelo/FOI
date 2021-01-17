<?php
include '../inc/header.php';

echo '<main>';
if(isset($_SESSION['korisnik_id']) && $_SESSION['tip_id'] <= 2)
{
  echo '<div>';
    echo '<form action="../controller/VoziloController.php" method="POST">';
      echo '<table>';
        echo '<thead>';
          echo '<tr>';
            echo '<th colspan="2">Unesite Novo Vozilo</th>';
          echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
          echo '<tr>';
            echo '<td>';
              echo '<label>Registracija: <label>';
            echo '</td>';
            echo '<td>';
              echo '<input type="text" placeholder="XY-000/0-XY" name="registracija" required/>';
            echo '</td>';
          echo '</tr>';
          echo '<tr>';
            echo '<td>';
              echo '<label>Marka Vozila: <label>';
            echo '</td>';
            echo '<td>';
              echo '<input type="text" name="marka_vozila" required/>';
            echo '</td>';
          echo '</tr>';
          echo '<tr>';
            echo '<td>';
              echo '<label>Model/Tip Vozila: <label>';
            echo '</td>';
            echo '<td>';
              echo '<input type="text" name="tip_vozila"/ required>';
            echo '</td>';
          echo '</tr>';
        echo '</tbody>';
      echo '</table>';
      echo '<input type="hidden" value="dodaj" name="vozilo"/>';
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