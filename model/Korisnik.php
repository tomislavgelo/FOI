<?php
require_once '../interface/iKorisnik.php';

class Korisnik implements iKorisnik
{
  public $korisnikId;
  public $tipId;
  public $korisnickoIme;
  public $lozinka;
  public $ime;
  public $prezime;
  public $email;
  public $slika;

  public function __construct(
    $korisnikId, 
    $tipId, 
    $korisnickoIme, 
    $lozinka, 
    $ime, 
    $prezime, 
    $email, 
    $slika)
  {
    $this->korisnikId = $korisnikId;
    $this->tipId = $tipId;
    $this->korisnickoIme = $korisnickoIme;
    $this->lozinka = $lozinka;
    $this->ime = $ime;
    $this->prezime = $prezime;
    $this->email = $email;
    $this->slika = $slika;
  }
  public function getKorisnikId()
  {
    return $this->korisnikId;
  }
  public function getTipId()
  {
    return $this->tipId;
  }
  public function getKorisnickoIme()
  {
    return $this->korisnickoIme;
  }
  public function getLozinka()
  {
    return $this->lozinka;
  }
  public function getIme()
  {
    return $this->ime;
  }
  public function getPrezime()
  {
    return $this->prezime;
  }
  public function getEmail()
  {
    return $this->email;
  }
  public function getSlika()
  {
    return $this->slika;
  }
}