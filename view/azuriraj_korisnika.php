<?php
include '../inc/header.php';

echo '<main>';
if(isset($_SESSION['korisnik_id']) && isset($_SESSION['tip_id']))
{
  if($_SESSION['tip_id'] == 0)
  {
    if(isset($_GET['korisnik_id']))
    {
      echo '<div>';
        echo '<form action="../controller/KorisnikController.php" method="POST" enctype="multipart/form-data">';
          $dohvaceniKorisnik = new KorisnikService;
          $dohvaceniKorisnik = $dohvaceniKorisnik->dohvatiKorisnika($_GET['korisnik_id']);

          foreach($dohvaceniKorisnik as $korisnik)
          {
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
                      echo '<option disabled>';
                        echo 'Odaberite Tip Korisnika';
                      echo '</option>';
                      $tipKorisnika = new TipKorisnikaService;
                      $tipKorisnika = $tipKorisnika->dohvatiTipKorisnika($korisnik->getTipId());

                      foreach($tipKorisnika as $tip)
                      {
                        echo '<option selected value="'.$tip->getTipId().'">';
                          echo $tip->getNaziv();
                        echo '</option>';
                      }
                      $tipoviKorisnika = new TipKorisnikaService;
                      $tipoviKorisnika = $tipoviKorisnika->dohvatiSveTipoveOsim($korisnik->getTipId());
                      
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
                    echo '<input type="text" value="'.$korisnik->getKorisnickoIme().'" name="korisnicko_ime" />';
                  echo '</td>';
                echo '</tr>';
                echo '<tr>';
                  echo '<td>';
                    echo '<label>';
                      echo 'Lozinka';
                    echo '</label>';
                  echo '</td>';
                  echo '<td>';
                    echo '<input type="text" value="'.$korisnik->getLozinka().'" name="lozinka" />';
                  echo '</td>';
                echo '</tr>';
                echo '<tr>';
                  echo '<td>';
                    echo '<label>';
                      echo 'Ime';
                    echo '</label>';
                  echo '</td>';
                  echo '<td>';
                    echo '<input type="text" value="'.$korisnik->getIme().'" name="ime" />';
                  echo '</td>';
                echo '</tr>';
                echo '<tr>';
                  echo '<td>';
                    echo '<label>';
                      echo 'Prezime';
                    echo '</label>';
                  echo '</td>';
                  echo '<td>';
                    echo '<input type="text" value="'.$korisnik->getPrezime().'" name="prezime" />';
                  echo '</td>';
                echo '</tr>';
                echo '<tr>';
                  echo '<td>';
                    echo '<label>';
                      echo 'E-mail';
                    echo '</label>';
                  echo '</td>';
                  echo '<td>';
                    echo '<input type="text" value="'.$korisnik->getEmail().'"name="email" />';
                  echo '</td>';
                echo '</tr>';
                echo '<tr>';
                  echo '<td>';
                    echo '<label>';
                      echo 'Slika';
                    echo '</label>';
                  echo '</td>';
                  echo '<td>';
                    echo '<img src="../'.$korisnik->getSlika().'" width="120" height="140" />';
                    echo '<br/>';
                    echo '<input type="file" name ="slika" />';
                  echo '</td>';
                echo '</tr>';
                echo '<tr>';;
                echo '</tr>';
              echo '</tbody>';
            echo '</table>';
            echo '<input type="hidden" value="'.$_GET['korisnik_id'].'" name="korisnik_id"/>';
            echo '<input type="hidden" value="azuriraj" name="korisnik"/>';
            echo '<button type="submit">';
              echo 'Ažuriraj';
            echo '</button>';
          }
        echo '</form>';
      echo '</div>';
    }
    else
    {
      header('Location: ../view/greska.php?greska=nemaKorisnika');
    
      die();
    }
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