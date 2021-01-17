<?php
include '../model/Vozilo.php';
include '../repository/VoziloRepository.php';

class VoziloService
{
  public function dohvatiVozilaPremaKorisniku($korisnikId)
  {
    $vozila = new VoziloRepository;
    $vozila = $vozila->dohvatiVozilaPremaKorisniku($korisnikId);

    $dohvacenaVozila = [];

    foreach($vozila as $vozilo)
    {
      $vozilo->getVoziloId();
      $vozilo->getKorisnikId();
      $vozilo->getRegistracija();
      $vozilo->getMarkaVozila();
      $vozilo->getTipVozila();
      array_push($dohvacenaVozila, $vozilo);
    }
    return $dohvacenaVozila;
  }
  public function dohvatiVozilo($voziloId)
  {
    $vozilo = new VoziloRepository;
    $vozilo = $vozilo->dohvatiVozilo($voziloId);

    $dohvacenoVozilo = [];

    foreach($vozilo as $voz)
    {
      $voz->getVoziloId();
      $voz->getKorisnikId();
      $voz->getRegistracija();
      $voz->getMarkaVozila();
      $voz->getTipVozila();
      array_push($dohvacenoVozilo, $voz);
    }
    return $dohvacenoVozilo;
  }
  public function dodajNovoVozilo($korisnikId, $registracija, $markaVozila, $tipVozila)
  {
    $vozilo = new VoziloRepository;
    $vozilo = $vozilo->dodajNovoVozilo($korisnikId, $registracija, $markaVozila, $tipVozila);
  }
  public function azurirajVozilo($voziloId, $registracija, $markaVozila, $tipVozila)
  {
    $vozilo = new VoziloRepository;
    $vozilo = $vozilo->azurirajVozilo($voziloId, $registracija, $markaVozila, $tipVozila);
  }
  public function dohvatiSvaVozila()
  {
    $vozila = new VoziloRepository;
    $vozila = $vozila->dohvatiSvaVozila();

    $dohvacenaVozila = [];

    foreach($vozila as $vozilo)
    {
      $vozilo->getVoziloId();
      $vozilo->getKorisnikId();
      $vozilo->getRegistracija();
      $vozilo->getMarkaVozila();
      $vozilo->getTipVozila();
      array_push($dohvacenaVozila, $vozilo);
    }
    return $dohvacenaVozila;
  }
  public function dohvatiSvaVozilaOsim($voziloId)
  {
    $vozila = new VoziloRepository;
    $vozila = $vozila->dohvatiSvaVozilaOsim($voziloId);

    $dohvacenaVozila = [];

    foreach($vozila as $vozilo)
    {
      $vozilo->getVoziloId();
      $vozilo->getKorisnikId();
      $vozilo->getRegistracija();
      $vozilo->getMarkaVozila();
      $vozilo->getTipVozila();
      array_push($dohvacenaVozila, $vozilo);
    }
    return $dohvacenaVozila;
  }
}