<?php
include '../service/VoziloService.php';

session_start();

if(isset($_POST['vozilo']) && $_POST['vozilo'] == 'dodaj')
{
  $registracija1='/^[A-Ž]{2}-[0-9]{4}-[A-Ž]{2}$/';
  $registracija2='/^[A-Ž]{2}-[0-9]{3}-[A-Ž]{2}$/';
  
  if(preg_match($registracija1, $_POST['registracija']) || 
  preg_match($registracija2, $_POST['registracija']))
  {
    $vozilo = new VoziloService;
    $vozilo = $vozilo->dodajNovoVozilo(
      $_SESSION['korisnik_id'], 
      $_POST['registracija'], 
      $_POST['marka_vozila'], 
      $_POST['tip_vozila']
    );
    header('Location: ../view/moja_vozila.php');
  }
  else
  {
    header('Location: ../view/greska.php?greska=formatRegistracije');

    die();
  }
}
elseif(isset($_POST['vozilo']) && $_POST['vozilo'] == 'azuriraj')
{
  $registracija1='/^[A-Ž]{2}-[0-9]{4}-[A-Ž]{2}$/';
  $registracija2='/^[A-Ž]{2}-[0-9]{3}-[A-Ž]{2}$/';
  
  if(preg_match($registracija1, $_POST['registracija']) || 
  preg_match($registracija2, $_POST['registracija']))
  {
    $vozilo = new VoziloService;
    $vozilo = $vozilo->azurirajVozilo(
      $_POST['vozilo_id'], 
      $_POST['registracija'], 
      $_POST['marka_vozila'], 
      $_POST['tip_vozila']
    );
    header('Location: ../view/moja_vozila.php');
  }
  else
  {
    header('Location: ../view/greska.php?greska=formatRegistracije');

    die();
  }
}
else 
{
  header('Location: ../view/pocetna.php');
}