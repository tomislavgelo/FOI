<?php
include '../inc/header.php';

echo '<main>';
if(isset($_SESSION['korisnik_id']) && isset($_SESSION['tip_id']))
{
  if($_SESSION['tip_id'] <= 2)
  {
    echo '<div>';
      echo '<form action="../controller/VoziloController.php" method="POST">';   
        $vozilo = new VoziloService;
        $vozilo = $vozilo->dohvatiVozilo($_GET['vozilo_id']);
        if($_SESSION['korisnik_id'] == $vozilo[0]->getKorisnikId())
        {
          foreach($vozilo as $voz)
          {
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
                    echo '<input type="text" value="'.$voz->getRegistracija().'" name="registracija" required/>';
                  echo '</td>';
                echo '</tr>';
                echo '<tr>';
                  echo '<td>';
                    echo '<label>Marka Vozila: <label>';
                  echo '</td>';
                  echo '<td>';
                    echo '<input type="text" value="'.$voz->getMarkaVozila().'" name="marka_vozila" required/>';
                  echo '</td>';
                echo '</tr>';
                echo '<tr>';
                  echo '<td>';
                    echo '<label>Model/Tip Vozila: <label>';
                  echo '</td>';
                  echo '<td>';
                    echo '<input type="text" value="'.$voz->getTipVozila().'" name="tip_vozila" required/>';
                  echo '</td>';
                echo '</tr>';
              echo '</tbody>';
            echo '</table>';
            echo '<input type="hidden" value="'.$voz->getVoziloId().'" name="vozilo_id"/>';
            echo '<input type="hidden" value="azuriraj" name="vozilo"/>';
            echo '<button type="submit">';
              echo 'Unesi';
            echo '</button>';
          }
        }
        else
        {
          header('Location: ../view/greska.php?greska=pristupPodacima');

          die();
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