<?php
require_once '../interface/iKategorija.php';

class Kategorija implements iKategorija
{
  public $kategorijaId;
  public $moderatorId;
  public $naziv;
  public $opis;

  public function __construct($kategorijaId, $moderatorId, $naziv, $opis)
  {
    $this->kategorijaId = $kategorijaId;
    $this->moderatorId = $moderatorId;
    $this->naziv = $naziv;
    $this->opis = $opis;
  }
  public function getKategorijaId()
  {
    return $this->kategorijaId;
  }
  public function getModeratorId()
  {
    return $this->moderatorId;
  }
  public function getNaziv()
  {
    return $this->naziv;
  }
  public function getOpis()
  {
    return $this->opis;
  }
}