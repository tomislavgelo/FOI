<?php
require_once '../interface/iVozilo.php';

class Vozilo implements iVozilo
{
  public $voziloId;
  public $korisnikId;
  public $registracija;
  public $markaVozila;
  public $tipVozila;

  public function __construct(
    $voziloId, 
    $korisnikId, 
    $registracija, 
    $markaVozila,
    $tipVozila
  )
  {
    $this->voziloId = $voziloId;
    $this->korisnikId = $korisnikId;
    $this->registracija = $registracija;
    $this->markaVozila = $markaVozila;
    $this->tipVozila = $tipVozila;
  }
  public function getVoziloId()
  {
    return $this->voziloId;
  }
  public function getKorisnikId()
  {
    return $this->korisnikId;
  }
  public function getRegistracija()
  {
    return $this->registracija;
  }
  public function getMarkaVozila()
  {
    return $this->markaVozila;
  }
  public function getTipVozila()
  {
    return $this->tipVozila;
  }
}