<?php
include '../service/PrekrsajService.php';

session_start();

if(isset($_POST['prekrsaj']) && $_POST['prekrsaj'] == 'prikazi')
{
  header('Location: ../view/moji_prekrsaji.php?vozilo_id='.$_POST['vozilo_id']);
}
elseif(isset($_POST['prekrsaj']) && $_POST['prekrsaj'] == 'plati')
{
  $provjeraDatuma = '/^(0[1-9]|[1-2][0-9]|3[0-1]).(0[1-9]|1[0-2]).[0-9]{4}$/';
  $provjeraVremena = '/^(?:2[0-3]|[01][0-9]):[0-5][0-9]:[0-5][0-9]$/';

  if(preg_match($provjeraDatuma, $_POST['datum_placanja']) && preg_match($provjeraVremena, $_POST['vrijeme_placanja']))
  {
    list($godina, $mjesec, $dan) = explode('.', $_POST['datum_placanja']);
    if(checkdate($dan, $mjesec, $godina) == true)
    {
      $rastavljeniDatum = explode('.', $_POST['datum_placanja']);
      $preokrenutiDatum = array_reverse($rastavljeniDatum);
      $spojeniDatum = implode('-', $preokrenutiDatum);

      $placanjePrekrsaja = new PrekrsajService;
      $placanjePrekrsaja = $placanjePrekrsaja->placanjePrekrsaja(
        $_POST['prekrsaj_id'], 
        $spojeniDatum, 
        $_POST['vrijeme_placanja']
      );
      header('Location: ../view/moji_prekrsaji.php?vozilo_id='.$_POST['vozilo_id']);
    }
    else
    {
      header('Location: ../view/greska.php?greska=formatDatuma');

      die();
    }
  }
  else
  {
    header('Location: ../view/greska.php?greska=formatDatuma');

    die();
  }
}
elseif(isset($_POST['prekrsaj']) && $_POST['prekrsaj'] == 'dodaj')
{
  $provjeraDatuma = '/^(0[1-9]|[1-2][0-9]|3[0-1]).(0[1-9]|1[0-2]).[0-9]{4}$/';
  $provjeraVremena = '/^(?:2[0-3]|[01][0-9]):[0-5][0-9]:[0-5][0-9]$/';

  if(preg_match($provjeraDatuma, $_POST['datum_prekrsaja']) && preg_match($provjeraVremena, $_POST['vrijeme_prekrsaja']))
  {
    list($dan, $mjesec, $godina) = explode('.', $_POST['datum_prekrsaja']);
    if(checkdate($mjesec, $dan, $godina) == true)
    {
      $rastavljeniDatum = explode('.', $_POST['datum_prekrsaja']);
      $obrnutiDatum = array_reverse($rastavljeniDatum);
      $spojeniDatum = implode('-', $obrnutiDatum);
  
      $noviPrekrsaj = new PrekrsajService;
      $noviPrekrsaj = $noviPrekrsaj->dodajNoviPrekrsaj(
        $_POST['kategorija_id'], 
        $_POST['vozilo_id'],
        $_POST['naziv'],
        $_POST['opis'],
        $_POST['novcana_kazna'],
        $spojeniDatum, 
        $_POST['vrijeme_prekrsaja'],
        $_POST['slika'],
        $_POST['video']
      );
      header('Location: ../view/lista_prekrsaja.php?kategorija_id='.$_POST['kategorija_id']);
    }
    else
    {
      header('Location: ../view/greska.php?greska=formatDatuma');

      die();
    }
  }
  else
  {
    header('Location: ../view/greska.php?greska=formatDatuma');

    die();
  }
}
elseif(isset($_POST['prekrsaj']) && $_POST['prekrsaj'] == 'azuriraj')
{
  $provjeraDatuma = '/^(0[1-9]|[1-2][0-9]|3[0-1]).(0[1-9]|1[0-2]).[0-9]{4}$/';
  $provjeraVremena = '/^(?:2[0-3]|[01][0-9]):[0-5][0-9]:[0-5][0-9]$/';
  
  if(preg_match($provjeraDatuma, $_POST['datum_prekrsaja']) && preg_match($provjeraDatuma, $_POST['datum_placanja'])
    && preg_match($provjeraVremena, $_POST['vrijeme_prekrsaja']) && preg_match($provjeraVremena, $_POST['vrijeme_placanja']))
  {
    list($dan, $mjesec, $godina) = explode('.', $_POST['datum_prekrsaja']);
    if(checkdate($mjesec, $dan, $godina) == true)
    {
      list($dan, $mjesec, $godina) = explode('.', $_POST['datum_placanja']);
      if(checkdate($mjesec, $dan, $godina) == true)
      {
        $datumPrekrsaja = explode('.', $_POST['datum_prekrsaja']);
        $obrnutiDatumPrekrsaja = array_reverse($datumPrekrsaja);
        $spojeniDatumPrekrsaja = implode('-', $obrnutiDatumPrekrsaja);
    
        $datumPlacanja = explode('.', $_POST['datum_placanja']);
        $obrnutiDatumPlacanja = array_reverse($datumPlacanja);
        $spojeniDatumPlcanja = implode('-', $obrnutiDatumPlacanja);
    
        $azurirajPrekrsaj = new PrekrsajService;
        $azurirajPrekrsaj = $azurirajPrekrsaj->azurirajPrekrsaj(
          $_POST['prekrsaj_id'],
          $_POST['kategorija_id'], 
          $_POST['vozilo_id'],
          $_POST['naziv'],
          $_POST['opis'],
          $_POST['status'],
          $_POST['novcana_kazna'],
          $spojeniDatumPrekrsaja, 
          $_POST['vrijeme_prekrsaja'],
          $spojeniDatumPlcanja,
          $_POST['vrijeme_placanja'],
          $_POST['slika'],
          $_POST['video']
        );
        header('Location: ../view/lista_prekrsaja.php?kategorija_id='.$_POST['kategorija_id']);
      }
      else
      {
        header('Location: ../view/greska.php?greska=formatDatuma');
        
        die();
      }
    }
    else
    { 
      header('Location: ../view/greska.php?greska=formatDatuma');
      
      die();
    }
  }
  elseif($_POST['datum_placanja'] == null && $_POST['vrijeme_placanja'] == null)
  {
    $datumPrekrsaja = explode('.', $_POST['datum_prekrsaja']);
    $obrnutiDatumPrekrsaja = array_reverse($datumPrekrsaja);
    $spojeniDatumPrekrsaja = implode('-', $obrnutiDatumPrekrsaja);

    $noviPrekrsaj = new PrekrsajService;
    $noviPrekrsaj = $noviPrekrsaj->azurirajPrekrsaj(
      $_POST['prekrsaj_id'],
      $_POST['kategorija_id'], 
      $_POST['vozilo_id'],
      $_POST['naziv'],
      $_POST['opis'],
      $_POST['status'],
      $_POST['novcana_kazna'],
      $spojeniDatumPrekrsaja, 
      $_POST['vrijeme_prekrsaja'],
      $datumPlacanja = null,
      $vrijemePlacanja = null,
      $_POST['slika'],
      $_POST['video']
    );
    header('Location: ../view/lista_prekrsaja.php?kategorija_id='.$_POST['kategorija_id']);
  }
  else
  {
    header('Location: ../view/greska.php?greska=formatDatuma');
    
    die();
  }
}
elseif(isset($_POST['prekrsaj']) && $_POST['prekrsaj'] == 'razdoblje')
{
  $provjeraDatuma = '/^(0[1-9]|[1-2][0-9]|3[0-1]).(0[1-9]|1[0-2]).[0-9]{4}$/';

  if(preg_match($provjeraDatuma, $_POST['datum_od']) && preg_match($provjeraDatuma, $_POST['datum_do']))
  {
    list($danOd, $mjesecOd, $godinaOd) = explode('.', $_POST['datum_od']);
    list($danDo, $mjesecDo, $godinaDo) = explode('.', $_POST['datum_do']);
    if(checkdate($mjesecOd, $danOd, $godinaOd) == true && checkdate($mjesecDo, $danDo, $godinaDo) == true)
    {
      $rastavljeniDatumOd = explode('.', $_POST['datum_od']);
      $obrnutiDatumOd = array_reverse($rastavljeniDatumOd);
      $spojeniDatumOd = implode('-', $obrnutiDatumOd);
      $rastavljeniDatumDo = explode('.', $_POST['datum_do']);
      $obrnutiDatumDo = array_reverse($rastavljeniDatumDo);
      $spojeniDatumDo = implode('-', $obrnutiDatumDo);

      header('Location: ../view/prekrsaji_razdoblje.php?datum_od='.$spojeniDatumOd.'&datum_do='.$spojeniDatumDo);
    }
    else
    {
      header('Location: ../view/greska.php?greska=formatDatuma');

      die();
    }
  }
  elseif($_POST['datum_od'] == null && preg_match($provjeraDatuma, $_POST['datum_do']))
  {
    list($danDo, $mjesecDo, $godinaDo) = explode('.', $_POST['datum_do']);
    if(checkdate($mjesecDo, $danDo, $godinaDo) == true)
    {
      $rastavljeniDatumDo = explode('.', $_POST['datum_do']);
      $obrnutiDatumDo = array_reverse($rastavljeniDatumDo);
      $spojeniDatumDo = implode('-', $obrnutiDatumDo);

      $prekrsaji = new PrekrsajService;
      $prekrsaji = $prekrsaji->dohvatiSvePrekrsaje();

      $datumi = [];

      foreach($prekrsaji as $prekrsaj)
      {
        array_push($datumi, $prekrsaj->getDatumPrekrsaja());
      }

      $datumOd = min($datumi);

      header('Location: ../view/prekrsaji_razdoblje.php?datum_od='.$datumOd.'&datum_do='.$spojeniDatumDo);
    }
  }
  elseif(preg_match($provjeraDatuma, $_POST['datum_od']) && $_POST['datum_do'] == null)
  {
    list($danOd, $mjesecOd, $godinaOd) = explode('.', $_POST['datum_od']);
    if(checkdate($mjesecOd, $danOd, $godinaOd) == true)
    {
      $rastavljeniDatumOd = explode('.', $_POST['datum_od']);
      $obrnutiDatumOd = array_reverse($rastavljeniDatumOd);
      $spojeniDatumOd = implode('-', $obrnutiDatumOd);

      $prekrsaji = new PrekrsajService;
      $prekrsaji = $prekrsaji->dohvatiSvePrekrsaje();

      $datumi = [];

      foreach($prekrsaji as $prekrsaj)
      {
        array_push($datumi, $prekrsaj->getDatumPrekrsaja());
      }

      $datumDo = max($datumi);

      header('Location: ../view/prekrsaji_razdoblje.php?datum_od='.$spojeniDatumOd.'&datum_do='.$datumDo);
    }
  }
  elseif($_POST['datum_od'] == null && $_POST['datum_do'] == null)
  {
    $prekrsaji = new PrekrsajService;
    $prekrsaji = $prekrsaji->dohvatiSvePrekrsaje();

    $datumi = [];

    foreach($prekrsaji as $prekrsaj)
    {
      array_push($datumi, $prekrsaj->getDatumPrekrsaja());
    }

    $datumOd = min($datumi);
    $datumDo = max($datumi);

    header('Location: ../view/prekrsaji_razdoblje.php?datum_od='.$datumOd.'&datum_do='.$datumDo);
  }
  else
  {
    header('Location: ../view/greska.php?greska=formatDatuma');

    die();
  }
}
else
{
  header('Location: ../view/pocetna.php');
}