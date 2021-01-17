<?php
require_once '../model/Kategorija.php';
require_once '../repository/KategorijaRepository.php';

class KategorijaService
{
  public function dohvatiSveKategorije()
  {
    $kategorije = new KategorijaRepository;
    $kategorije = $kategorije->dohvatiSveKategorije();

    $listaKategorija = [];

    foreach($kategorije as $kategorija)
    {
      $kategorija->getKategorijaId();
      $kategorija->getModeratorId();
      $kategorija->getNaziv();
      $kategorija->getOpis();
      array_push($listaKategorija, $kategorija);
    }
    return $listaKategorija;
  }
  public function dohvatiKategoriju($kategorijaId)
  {
    $kategorija = new KategorijaRepository;
    $kategorija = $kategorija->dohvatiKategoriju($kategorijaId);

    $dohvacenaKategorija = [];

    foreach($kategorija as $kat)
    {
      $kat->getKategorijaId();
      $kat->getModeratorId();
      $kat->getNaziv();
      $kat->getOpis();
      array_push($dohvacenaKategorija, $kat);
    }
    return $dohvacenaKategorija;
  }
  
  public function dohvatiKategorijeModeratora($moderatorId)
  {
    $kategorije = new KategorijaRepository;
    $kategorije = $kategorije->dohvatiKategorijeModeratora($moderatorId);

    $dohvaceneKategorije = [];

    foreach($kategorije as $kategorija)
    {
      $kategorija->getKategorijaId();
      $kategorija->getModeratorId();
      $kategorija->getNaziv();
      $kategorija->getOpis();
      array_push($dohvaceneKategorije, $kategorija);
    }
    return $dohvaceneKategorije;
  }
  public function dodajNovuKategoriju($naziv, $opis, $moderatorId)
  {
    $kategorija = new KategorijaRepository;
    $kategorija = $kategorija->dodajNovuKategoriju($naziv, $opis, $moderatorId);
  }
  public function azurirajKategoriju($naziv, $opis, $moderatorId, $kategorijaId)
  {
    $kategorija = new KategorijaRepository;
    $kategorija = $kategorija->azurirajKategoriju($naziv, $opis, $moderatorId, $kategorijaId);
  }
  public function dohvatiSveKategorijeOsim($kategorijaId)
  {
    $kategorije = new KategorijaRepository;
    $kategorije = $kategorije->dohvatiSveKategorijeOsim($kategorijaId);

    $listaKategorija = [];

    foreach($kategorije as $kategorija)
    {
      $kategorija->getKategorijaId();
      $kategorija->getModeratorId();
      $kategorija->getNaziv();
      $kategorija->getOpis();
      array_push($listaKategorija, $kategorija);
    }
    return $listaKategorija;
  }
  public function dohvatiKategorijeModeratoraOsim($moderatorId, $kategorijaId)
  {
    $kategorije = new KategorijaRepository;
    $kategorije = $kategorije->dohvatiKategorijeModeratoraOsim($moderatorId, $kategorijaId);

    $dohvaceneKategorije = [];

    foreach($kategorije as $kategorija)
    {
      $kategorija->getKategorijaId();
      $kategorija->getModeratorId();
      $kategorija->getNaziv();
      $kategorija->getOpis();
      array_push($dohvaceneKategorije, $kategorija);
    }
    return $dohvaceneKategorije;
  }
}