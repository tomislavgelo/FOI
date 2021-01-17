<?php
require_once '../interface/iPrekrsaj.php';

class Prekrsaj implements iPrekrsaj
{
  public $prekrsajId;
  public $kategorijaId;
  public $voziloId;
  public $naziv;
  public $opis;
  public $status;
  public $novcanaKazna;
  public $datumPrekrsaja;
  public $vrijemePrekrsaja;
  public $datumnPlacanja;
  public $vrijemePlacanja;
  public $slika;
  public $video;
 
  public function __construct(
    $prekrsajId, 
    $kategorijaId, 
    $voziloId, 
    $naziv, 
    $opis, 
    $status, 
    $novcanaKazna, 
    $datumPrekrsaja, 
    $vrijemePrekrsaja, 
    $datumnPlacanja, 
    $vrijemePlacanja, 
    $slika, 
    $video
  )
  {
    $this->prekrsajId = $prekrsajId;
    $this->kategorijaId = $kategorijaId;
    $this->voziloId = $voziloId;
    $this->naziv = $naziv;
    $this->opis = $opis;
    $this->status = $status;
    $this->novcanaKazna = $novcanaKazna;
    $this->datumPrekrsaja = $datumPrekrsaja;
    $this->vrijemePrekrsaja = $vrijemePrekrsaja;
    $this->datumnPlacanja = $datumnPlacanja;
    $this->vrijemePlacanja = $vrijemePlacanja;
    $this->slika = $slika;
    $this->video = $video;
  }
  public function getPrekrsajId()
  {
    return $this->prekrsajId;
  }
  public function getKategorijaId()
  {
    return $this->kategorijaId;
  }
  public function getVoziloId()
  {
    return $this->voziloId;
  }
  public function getNaziv()
  {
    return $this->naziv;
  }
  public function getOpis()
  {
    return $this->opis;
  }
  public function getStatus()
  {
    return $this->status;
  }
  public function getNovcanaKazna()
  {
    return $this->novcanaKazna;
  }
  public function getDatumPrekrsaja()
  {
    return $this->datumPrekrsaja;
  }
  public function getVrijemePrekrsaja()
  {
    return $this->vrijemePrekrsaja;
  }
  public function getDatumPlacanja()
  {
    return $this->datumnPlacanja;
  }
  public function getVrijemeplacanja()
  {
    return $this->vrijemePlacanja;
  }
  public function getSlika()
  {
    return $this->slika;
  }
  public function getVideo()
  {
    return $this->video;
  }
}