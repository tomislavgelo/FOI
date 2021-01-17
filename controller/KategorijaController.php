<?php
include '../service/KategorijaService.php';

if(isset($_POST['kategorija']) && $_POST['kategorija'] == 'azuriraj')
{
  $kategorija = new KategorijaService;
  $kategorija = $kategorija->azurirajKategoriju($_POST['naziv'], $_POST['opis'], $_POST['moderator_id'], $_POST['kategorija_id']);

  header('Location: ../view/moje_kategorije.php');
}
elseif(isset($_POST['kategorija']) && $_POST['kategorija'] == 'dodaj')
{
  if(isset($_POST['moderator_id']))
  {
    $kategorija = new KategorijaService;
    $kategorija = $kategorija->dodajNovuKategoriju($_POST['naziv'], $_POST['opis'], $_POST['moderator_id']);

    header('Location: ../view/moje_kategorije.php');
  }
  else
  {
    header('Location: ../view/greska.php?greska=nemaModeratora');

    die();
  }
}
else
{
  header('Location: ../view/pocetna.php');
}