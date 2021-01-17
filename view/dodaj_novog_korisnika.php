<?php
include '../inc/header.php';

echo '<main>';
if(isset($_SESSION['korisnik_id']) && $_SESSION['tip_id'] == 0)
{
  echo '<div>';
    echo '<form action="../controller/KorisnikController.php" method="POST" enctype="multipart/form-data">';
      echo '<table>';
        echo '<thead>';
          echo '<tr>';
            echo '<th>';
              echo 'Ažuriraj Korisnika';
            echo '</th>';
            echo '<th>';
            echo '</th>';
          echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
          echo '<tr>';
            echo '<td>';
              echo '<label>';
                echo 'Tip Korisnika';
              echo '</label>';
            echo '</td>';
            echo '<td>';
              echo '<select name="tip_id" required>';
                echo '<option selected disabled>';
                  echo 'Odaberite Tip Korisnika';
                echo '</option>';
                $tipoviKorisnika = new TipKorisnikaService;
                $tipoviKorisnika = $tipoviKorisnika->dohvatiSveTipove();
                
                foreach($tipoviKorisnika as $tipKorisnika)
                {
                  echo '<option value="'.$tipKorisnika->getTipId().'">';
                    echo $tipKorisnika->getNaziv();
                  echo '</option>';
                }
              echo '</select>';
            echo '</td>';
          echo '</tr>';
          echo '<tr>';
            echo '<td>';
              echo '<label>';
                echo 'Korisničko Ime';
              echo '</label>';
            echo '</td>';
            echo '<td>';
              echo '<input type="text" name ="korisnicko_ime" />';
            echo '</td>';
          echo '</tr>';
          echo '<tr>';
            echo '<td>';
              echo '<label>';
                echo 'Lozinka';
              echo '</label>';
            echo '</td>';
            echo '<td>';
              echo '<input type="text" name ="lozinka" />';
            echo '</td>';
          echo '</tr>';
          echo '<tr>';
            echo '<td>';
              echo '<label>';
                echo 'Ime';
              echo '</label>';
            echo '</td>';
            echo '<td>';
              echo '<input type="text" name ="ime" />';
            echo '</td>';
          echo '</tr>';
          echo '<tr>';
            echo '<td>';
              echo '<label>';
                echo 'Prezime';
              echo '</label>';
            echo '</td>';
            echo '<td>';
              echo '<input type="text" name ="prezime" />';
            echo '</td>';
          echo '</tr>';
          echo '<tr>';
            echo '<td>';
              echo '<label>';
                echo 'E-mail';
              echo '</label>';
            echo '</td>';
            echo '<td>';
              echo '<input type="text" name ="email" />';
            echo '</td>';
          echo '</tr>';
          echo '<tr>';
            echo '<td>';
              echo '<label>';
                echo 'Slika';
              echo '</label>';
            echo '</td>';
            echo '<td>';
              echo '<input type="file" name ="slika" />';
            echo '</td>';
          echo '</tr>';
        echo '</tbody>';
      echo '</table>';
      echo '<input type="hidden" value="dodaj" name="korisnik"/>';
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