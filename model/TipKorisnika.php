<?php
require_once '../interface/iTipKorisnika.php';

class TipKorisnika implements iTipKorisnika
{
  public $tipId;
  public $naziv;

  public function __construct($tipId, $naziv)
  {
    $this->tipId = $tipId;
    $this->naziv = $naziv;
  }
  public function getTipId()
  {
    return $this->tipId;
  }
  public function getNaziv()
  {
    return $this->naziv;
  }
}