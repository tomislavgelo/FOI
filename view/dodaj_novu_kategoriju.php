<?php
include '../inc/header.php';

echo '<main>';
if(isset($_SESSION['korisnik_id']) && $_SESSION['tip_id'] == 0)
{
  echo '<div>';
    echo '<form action="../controller/KategorijaController.php" method="POST">';
      echo '<table>';
        echo '<thead>';
          echo '<tr>';
            echo '<th>';
              echo 'Ažuriraj Kategoriju';
            echo '</th>';
            echo '<th>';
            echo '</th>';
          echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
          echo '<tr>';
            echo '<td>';
              echo '<label>';
                echo 'Naziv';
              echo '</label>';
            echo '</td>';
            echo '<td>';
              echo '<input type="text" name="naziv" />';
            echo '</td>';
          echo '</tr>';
          echo '<tr>';
            echo '<td>';
              echo '<label>';
                echo 'Opis';
              echo '</label>';
            echo '</td>';
            echo '<td>';
              echo '<textarea name ="opis" rows="6" cols="22">';
              echo '</textarea>';
            echo '</td>';
          echo '</tr>';
          echo '<tr>';
            echo '<td>';
              echo '<label>';
                echo 'Moderator';
              echo '</label>';
            echo '</td>';
            echo '<td>';
              echo '<select name=moderator_id required>';
                echo '<option selected disabled>';
                  echo 'Odaberite Moderatora';
                echo '</option>';
                $moderatori = new KorisnikService;
                $moderatori = $moderatori->dohvatiModeratore();

                foreach($moderatori as $moderator)
                {
                  echo '<option value="'.$moderator->getKorisnikId().'">';
                    echo $moderator->getKorisnickoIme();
                  echo '</option>';
                }
              echo '</select>';
            echo '</td>';
          echo '</tr>';
        echo '</tbody>';
      echo '</table>';
      echo '<input type="hidden" value="dodaj" name="kategorija"/>';
      echo '<button type="submit">';
        echo 'Dodaj';
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