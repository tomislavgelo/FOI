<?php
include '../inc/header.php';

echo '<main>';
  echo '<div>';
    if(isset($_GET['greska']))
    {
      switch($_GET['greska'])
      {
        case 'nemaModeratora':
          echo '<p class="greska">Kategorija ne može biti bez Moderatora!</p>';
          header('Refresh: 3, url=moje_kategorije.php');
          break;
        case 'pogresnoKorImeIliLozinka':
          echo '<p class="greska">Pogreško korisničko ime i/ili lozinka!</p>';
          header('Refresh: 3, url=prijava.php');
          break;
        case 'formatDatoteke':
          echo '<p class="greska">Ne podržani format datoteke!</p>';
          header('Refresh: 3, url=moji_prekrsaji.php');
          break;
        case 'noviKorisnik':
          echo '<p class="greska">Došlo je do greške pri dodavanju novog korisnika, molimo Vas pokušajte ponovno.</p>';
          header('Refresh: 3, url=lista_korisnika.php');
          break;
        case 'tipKorisnika':
          echo '<p class="greska">Ne možete dodati korisnika bez tipa!</p>';
          header('Refresh: 3, url=lista_korisnika.php');
          break;
        case 'velicinaDatoteke':
          echo '<p class="greska">Datoteka koju ste pokušali poslati je prevelika!</p>';
          header('Refresh: 3, url=lista_korisnika.php');
          break;
        case 'formatDatuma':
          echo '<p class="greska">Pogrešan format datuma i/ili vremena!</p>';
          header('Refresh: 3, url=pocetna.php');
          break;
        case 'formatRegistracije':
          echo '<p class="greska">Pogrešan format registracije!</p>';
          header('Refresh: 3, url=moja_vozila.php');
          break;
        case 'db':
          echo '<p class="greska">Greška pri spajanju na bazu!</p>';
          header('Refresh: 3, url=pocetna.php');
          break;
        case 'postojiKategorija':
          echo '<p class="greska">Već postoji kategorija tog naziva!</p>';
          header('Refresh: 3, url=moje_kategorije.php');
          break;
        case 'nemaKategorije':
          echo '<p class="greska">Niste odabrali kategoriju za ažuriranje!</p>';
          header('Refresh: 3, url=moje_kategorije.php');
          break;
        case 'postojiKorisnik':
          echo '<p class="greska">Korisničko ime je zauzeto!</p>';
          header('Refresh: 3, url=lista_korisnika.php');
          break;
        case 'nemaKorisnika':
          echo '<p class="greska">Niste odabrali korisnika za ažuriranje!</p>';
          header('Refresh: 3, url=lista_korisnika.php');
          break;
        case 'postojiRegistracija':
          echo '<p class="greska">Već postoji vozilo s tom registracijom!</p>';
          header('Refresh: 3, url=moja_vozila.php');
          break;
        case 'pristupPodacima':
          echo '<p class="greska">Nije Vam odobren pristup traženim podacima!</p>';
          header('Refresh: 3, url=pocetna.php');
          break;
        case 'prijava':
          echo '<p class="greska">Morate se prijaviti kako bi pristupili traženim podacima!</p>';
          header('Refresh: 3, url=prijava.php');
          break;
        case 'krivaKategorija':
          echo '<p class="greska">Ne možete pristupiti traženoj Kategoriji!</p>';
          header('Refresh: 3, url=moje_kategorije.php');
          break;
        case 'odabirVozila':
          echo '<p class="greska">Molimo Vas odaberite Vozilo!</p>';
          header('Refresh: 3, url=moji_prekrsaji.php');
          break;
        case 'nemaPrekrsaja':
          echo '<p class="greska">Niste odabrali prekršaj za ažuriranje</p>';
          header('Refresh: 3, url=moji_prekrsaji.php');
          break;
        default:
          echo '<p class="greska">Došlo je do neočekivane greške. Molimo Vas pokušajte ponovno kasnije.</p>';
          header('Refresh: 3, url=pocetna.php');
      }
    }
    else
    {
      header('Location: pocetna.php');
    }
  echo '</div>';
  echo '<br/>';
echo '</main>';
echo '<hr/>';

include '../inc/footer.php';
?>