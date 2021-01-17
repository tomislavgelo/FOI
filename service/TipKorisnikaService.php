<?php
require_once '../model/TipKorisnika.php';
require_once '../repository/TipKorisnikaRepository.php';

class TipKorisnikaService
{
  public function dohvatiSveTipove()
  {
    $tipoviKorisnika = new TipKorisnikaRepository;
    $tipoviKorisnika = $tipoviKorisnika->dohvatiSveTipove();
    
    $listaTipova = [];

    foreach($tipoviKorisnika as $tipKorisnika)
    {
      $tipKorisnika->getTipId();
      $tipKorisnika->getNaziv();
      array_push($listaTipova, $tipKorisnika);
    }
    return $listaTipova;
  }
  public function dohvatiSveTipoveOsim($tipId)
  {
    $tipoviKorisnika = new TipKorisnikaRepository;
    $tipoviKorisnika = $tipoviKorisnika->dohvatiSveTipoveOsim($tipId);
    
    $listaTipova = [];

    foreach($tipoviKorisnika as $tipKorisnika)
    {
      $tipKorisnika->getTipId();
      $tipKorisnika->getNaziv();
      array_push($listaTipova, $tipKorisnika);
    }
    return $listaTipova;
  }
  public function dohvatiTipKorisnika($tipId)
  {
    $tipKorisnika = new TipKorisnikaRepository;
    $tipKorisnika = $tipKorisnika->dohvatiTipKorisnika($tipId);
    
    $dohvaceniTip = [];

    foreach($tipKorisnika as $tip)
    {
      $tip->getTipId();
      $tip->getNaziv();
      array_push($dohvaceniTip, $tip);
    }
    return $dohvaceniTip;
  }
}