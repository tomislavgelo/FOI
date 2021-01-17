<?php
require_once '../db/DbConnection.php';

class KategorijaRepository
{
  private static $veza;

  public function dohvatiSveKategorije()
  {
    self::$veza = DbVeza::dobijVezu();
    $upit = 'SELECT * FROM kategorija';
    $stmt = self::$veza->query($upit);
    $rezultat = $stmt->fetchAll();

    $listaKategorija = [];

    foreach($rezultat as $kategorija)
    {
      $kategorija = new Kategorija(
        $kategorija['kategorija_id'],
        $kategorija['moderator_id'],
        $kategorija['naziv'],
        $kategorija['opis']
      );
      array_push($listaKategorija, $kategorija);
    }
    return $listaKategorija;
  }
  public function dohvatiKategoriju($kategorijaId)
  {
    self::$veza = DbVeza::dobijVezu();
    $upit = 'SELECT * FROM kategorija WHERE kategorija_id = :kategorija_id';
    $stmt = self::$veza->prepare($upit);
    $stmt->bindParam(':kategorija_id', $kategorijaId, PDO::PARAM_INT);
    $stmt->execute();
    $rezultat = $stmt->fetchAll();

    $dohvacenaKategorija = [];

    foreach($rezultat as $kategorija)
    {
      $kategorija = new Kategorija(
        $kategorija['kategorija_id'],
        $kategorija['moderator_id'],
        $kategorija['naziv'],
        $kategorija['opis']
      );
      array_push($dohvacenaKategorija, $kategorija);
    }
    return $dohvacenaKategorija;
  }
  public function dohvatiKategorijeModeratora($moderatorId)
  {
    self::$veza = DbVeza::dobijVezu();
    $upit = 'SELECT * FROM kategorija WHERE moderator_id = :moderator_id';
    $stmt = self::$veza->prepare($upit);
    $stmt->bindParam(':moderator_id', $moderatorId, PDO::PARAM_INT);
    $stmt->execute();
    $rezultat = $stmt->fetchAll();

    $dohvaceneKategorije = [];

    foreach($rezultat as $kategorija)
    {
      $kategorija = new Kategorija(
        $kategorija['kategorija_id'],
        $kategorija['moderator_id'],
        $kategorija['naziv'],
        $kategorija['opis']
      );
      array_push($dohvaceneKategorije, $kategorija);
    }
    return $dohvaceneKategorije;
  }
  public function dodajNovuKategoriju($naziv, $opis, $moderatorId)
  {
    self::$veza = DbVeza::dobijVezu();
    $upit = 'SELECT * FROM kategorija WHERE naziv = :naziv';
    $stmt = self::$veza->prepare($upit);
    $stmt->bindParam(':naziv', $naziv, PDO::PARAM_STR);
    $stmt->execute();
    $rezultat = $stmt->fetchAll();

    if($rezultat == null)
    {
      self::$veza = DbVeza::dobijVezu();
      $upit = 'INSERT INTO kategorija (naziv, opis, moderator_id) 
      VALUES (:naziv, :opis, :moderator_id)';
      $stmt = self::$veza->prepare($upit);
      $stmt->bindParam(':naziv', $naziv, PDO::PARAM_STR);
      $stmt->bindParam(':opis', $opis, PDO::PARAM_STR);
      $stmt->bindParam(':moderator_id', $moderatorId, PDO::PARAM_INT);
      $stmt->execute();
    }
    else
    {
      header('Location: ../view/greska.php?greska=postojiKategorija');

      die();
    }
  }
  public function azurirajKategoriju($naziv, $opis, $moderatorId, $kategorijaId)
  {
    self::$veza = DbVeza::dobijVezu();
    $upit = 'SELECT * FROM kategorija WHERE naziv = :naziv 
    AND NOT kategorija_id = :kategorija_id';
    $stmt = self::$veza->prepare($upit);
    $stmt->bindParam(':naziv', $naziv, PDO::PARAM_STR);
    $stmt->bindParam(':kategorija_id', $kategorijaId, PDO::PARAM_INT);
    $stmt->execute();
    $rezultat = $stmt->fetchAll();
    
    if($rezultat == null)
    {
      self::$veza = DbVeza::dobijVezu();
      $upit = 'UPDATE kategorija SET 
      moderator_id = :moderator_id, 
      naziv = :naziv, 
      opis = :opis
      WHERE kategorija_id = :kategorija_id';
      $stmt = self::$veza->prepare($upit);
      $stmt->bindParam(':moderator_id', $moderatorId, PDO::PARAM_INT);
      $stmt->bindParam(':naziv', $naziv, PDO::PARAM_STR);
      $stmt->bindParam(':opis', $opis, PDO::PARAM_STR);
      $stmt->bindParam(':kategorija_id', $kategorijaId, PDO::PARAM_INT);
      $stmt->execute();
    }
    else
    {
      header('Location: ../view/greska.php?greska=postojiKategorija');

      die();
    }
  }
  public function dohvatiSveKategorijeOsim($kategorijaId)
  {
    self::$veza = DbVeza::dobijVezu();
    $upit = 'SELECT * FROM kategorija WHERE NOT kategorija_id = :kategorija_id';
    $stmt = self::$veza->prepare($upit);
    $stmt->bindParam(':kategorija_id', $kategorijaId, PDO::PARAM_INT);
    $stmt->execute();
    $rezultat = $stmt->fetchAll();

    $dohvaceneKategorije = [];

    foreach($rezultat as $kategorija)
    {
      $kategorija = new Kategorija(
        $kategorija['kategorija_id'],
        $kategorija['moderator_id'],
        $kategorija['naziv'],
        $kategorija['opis']
      );
      array_push($dohvaceneKategorije, $kategorija);
    }
    return $dohvaceneKategorije;
  }
  public function dohvatiKategorijeModeratoraOsim($moderatorId, $kategorijaId)
  {
    self::$veza = DbVeza::dobijVezu();
    $upit = 'SELECT * FROM kategorija WHERE moderator_id = :moderator_id AND NOT kategorija_id = :kategorija_id';
    $stmt = self::$veza->prepare($upit);
    $stmt->bindParam(':moderator_id', $moderatorId, PDO::PARAM_INT);
    $stmt->bindParam(':kategorija_id', $kategorijaId, PDO::PARAM_INT);
    $stmt->execute();
    $rezultat = $stmt->fetchAll();

    $dohvaceneKategorije = [];

    foreach($rezultat as $kategorija)
    {
      $kategorija = new Kategorija(
        $kategorija['kategorija_id'],
        $kategorija['moderator_id'],
        $kategorija['naziv'],
        $kategorija['opis']
      );
      array_push($dohvaceneKategorije, $kategorija);
    }
    return $dohvaceneKategorije;
  }
} 