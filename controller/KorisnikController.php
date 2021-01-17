<?php
include '../service/KorisnikService.php';

session_start();

$paket = ($_SERVER['CONTENT_LENGTH']);
$limit = (int) ini_get('post_max_size') * 1024 * 1024;

if($limit >= $paket)
{
  if(isset($_POST['korisnik']) && $_POST['korisnik'] == 'prijava')
  {
    $prijava = new KorisnikService;
    $prijava = $prijava->prijava($_POST['korisnicko_ime'], $_POST['lozinka']);
  
    if($prijava == null)
    {
      header('Location: ../view/greska.php?greska=pogresnoKorImeIliLozinka');

      die();
    }
    elseif($_SESSION['tip_id'] <= 1)
    {
      header('Location: ../view/moje_kategorije.php');
    }
    else
    {
      header('Location: ../view/pocetna.php');
    }
  }
  elseif(isset($_POST['korisnik']) && $_POST['korisnik'] == 'odjava')
  {
    $odjava = new KorisnikService;
    $odjava = $odjava->odjava();
    header('Location: ../view/pocetna.php');
  }
  elseif(isset($_POST['korisnik']) && $_POST['korisnik'] == 'dodaj')
  {
    if(isset($_POST['tip_id']))
    {
      $provjeraSlike = array('image/png', 'image/jpeg', 'image/jpg', 'image/gif');
      $slika = $_FILES['slika'];
    
      if(is_array($slika))
      {
        if(in_array($slika['type'], $provjeraSlike))
        {
          move_uploaded_file($slika['tmp_name'], '../korisnici/'.$slika['name']);
          $putanjaSlike = 'korisnici/'.$slika['name'];
          $noviKorisnik = new KorisnikService;
          $noviKorisnik = $noviKorisnik->dodajNovogKorisnika(
            $_POST['tip_id'], 
            $_POST['korisnicko_ime'], 
            $_POST['lozinka'], 
            $_POST['ime'], 
            $_POST['prezime'], 
            $_POST['email'], 
            $putanjaSlike
          );
        }
        elseif($slika['name'] == '' && $slika['type'] == '' && $slika['tmp_name'] == '' && $slika['error'] == 4 && $slika['size'] == 0)
        {
          $putanjaSlike = null;
          $noviKorisnik = new KorisnikService;
          $noviKorisnik = $noviKorisnik->dodajNovogKorisnika(
            $_POST['tip_id'], 
            $_POST['korisnicko_ime'], 
            $_POST['lozinka'], 
            $_POST['ime'], 
            $_POST['prezime'], 
            $_POST['email'], 
            $putanjaSlike
          );
        }
        else 
        {
          header('Location: ../view/greska.php?greska=formatDatoteke');

          die();  
        }
      }
      else 
      {
        header('Location: ../view/greska.php?greska=noviKorisnik');

        die();  
      }
      header('Location: ../view/lista_korisnika.php');
    }
    else
    {
      header('Location: ../view/greska.php?greska=tipKorisnika');

      die();
    }
  }
  elseif(isset($_POST['korisnik']) && $_POST['korisnik'] == 'azuriraj')
  {
    if(isset($_POST['tip_id']))
    {
      $provjeraSlike = array('image/png', 'image/jpeg', 'image/jpg', 'image/gif');
      $slika = $_FILES['slika'];
    
      if(is_array($slika))
      {
        if(in_array($slika['type'], $provjeraSlike))
        {
          move_uploaded_file($slika['tmp_name'], '../korisnici/'.$slika['name']);
          $putanjaSlike = 'korisnici/'.$slika['name'];
          $noviKorisnik = new KorisnikService;
          $noviKorisnik = $noviKorisnik->azurirajKorisnika(
            $_POST['tip_id'], 
            $_POST['korisnicko_ime'], 
            $_POST['lozinka'], 
            $_POST['ime'], 
            $_POST['prezime'], 
            $_POST['email'], 
            $putanjaSlike,
            $_POST['korisnik_id']
          );
        }
        elseif($slika['name'] == '' && $slika['type'] == '' && $slika['tmp_name'] == '' && $slika['error'] == 4 && $slika['size'] == 0)
        {
          $putanjaSlike = null;
          $noviKorisnik = new KorisnikService;
          $noviKorisnik = $noviKorisnik->azurirajKorisnika(
            $_POST['tip_id'], 
            $_POST['korisnicko_ime'], 
            $_POST['lozinka'], 
            $_POST['ime'], 
            $_POST['prezime'], 
            $_POST['email'], 
            $putanjaSlike,
            $_POST['korisnik_id']
          );
        }
        else 
        {
          header('Location: ../view/greska.php?greska=formatDatoteke');

          die(); 
        }
      }
      else 
      {
        header('Location: ../view/greska.php?greska=noviKorisnik');

        die();  
      }
      header('Location: ../view/lista_korisnika.php');
    }
    else
    {
      header('Location: ../view/greska.php?greska=tipKorisnika');

      die();
    }
  }
  else 
  {
    header('Location: ../view/pocetna.php');
  }
}
else
{
  header('Location: ../view/greska.php?greska=velicinaDatoteke');
  
  die();
}