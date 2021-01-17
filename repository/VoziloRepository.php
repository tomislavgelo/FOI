<?php
require_once '../db/DbConnection.php';

class VoziloRepository
{
  private static $veza;

  public function dohvatiVozilaPremaKorisniku($korisnikId)
  {
    self::$veza = DbVeza::dobijVezu();
    $upit = 'SELECT * FROM vozilo WHERE korisnik_id = :korisnik_id';
    $stmt = self::$veza->prepare($upit);
    $stmt->bindParam(':korisnik_id', $korisnikId, PDO::PARAM_INT);
    $stmt->execute();
    $rezultat = $stmt->fetchAll();

    $dohvacenaVozila = [];

    foreach($rezultat as $vozilo)
    {
      $vozilo = new Vozilo(
        $vozilo['vozilo_id'],
        $vozilo['korisnik_id'],
        $vozilo['registracija'],
        $vozilo['marka_vozila'],
        $vozilo['tip_vozila']
      );
      array_push($dohvacenaVozila, $vozilo);
    }
    return $dohvacenaVozila;
  }
  public function dohvatiVozilo($voziloId)
  {
    self::$veza = DbVeza::dobijVezu();
    $upit = 'SELECT * FROM vozilo WHERE vozilo_id = :vozilo_id';
    $stmt = self::$veza->prepare($upit);
    $stmt->bindParam(':vozilo_id', $voziloId, PDO::PARAM_INT);
    $stmt->execute();
    $rezultat = $stmt->fetchAll();

    $dohvacenoVozilo = [];

    foreach($rezultat as $vozilo)
    {
      $vozilo = new Vozilo(
        $vozilo['vozilo_id'],
        $vozilo['korisnik_id'],
        $vozilo['registracija'],
        $vozilo['marka_vozila'],
        $vozilo['tip_vozila']
      );
      array_push($dohvacenoVozilo, $vozilo);
    }
    return $dohvacenoVozilo;
  }
  public function dodajNovoVozilo($korisnikId, $registracija, $markaVozila, $tipVozila)
  {
    self::$veza = DbVeza::dobijVezu();
    $upit = 'SELECT * FROM vozilo WHERE registracija = :registracija';
    $stmt = self::$veza->prepare($upit);
    $stmt->bindParam(':registracija', $registracija, PDO::PARAM_STR);
    $stmt->execute();
    $rezultat = $stmt->fetchAll();
    
    if($rezultat == null)
    {
      self::$veza = DbVeza::dobijVezu();
      $upit = 'INSERT INTO vozilo (korisnik_id, registracija, marka_vozila, tip_vozila)
      VALUES (:korisnik_id, :registracija, :marka_vozila, :tip_vozila)';
      $stmt = self::$veza->prepare($upit);
      $stmt->bindParam(':korisnik_id', $korisnikId, PDO::PARAM_INT);
      $stmt->bindParam(':registracija', $registracija, PDO::PARAM_STR);
      $stmt->bindParam(':marka_vozila', $markaVozila, PDO::PARAM_STR);
      $stmt->bindParam(':tip_vozila', $tipVozila, PDO::PARAM_STR);
      $stmt->execute();
    }
    else
    {
      header('Location: ../view/greska.php?greska=postojiRegistracija');

      die();
    }
  }
  public function azurirajVozilo($voziloId, $registracija, $markaVozila, $tipVozila)
  {
    self::$veza = DbVeza::dobijVezu();
    $upit = 'SELECT * FROM vozilo WHERE registracija = :registracija 
    AND NOT vozilo_id = :vozilo_id';
    $stmt = self::$veza->prepare($upit);
    $stmt->bindParam(':registracija', $registracija, PDO::PARAM_STR);
    $stmt->bindParam(':vozilo_id', $voziloId, PDO::PARAM_INT);
    $stmt->execute();
    $rezultat = $stmt->fetchAll();
    
    if($rezultat == null)
    {
      self::$veza = DbVeza::dobijVezu();
      $upit = 'UPDATE vozilo SET 
      registracija = :registracija, 
      marka_vozila = :marka_vozila, 
      tip_vozila = :tip_vozila
      WHERE vozilo_id = :vozilo_id';
      $stmt = self::$veza->prepare($upit);
      $stmt->bindParam(':vozilo_id', $voziloId, PDO::PARAM_INT);
      $stmt->bindParam(':registracija', $registracija, PDO::PARAM_STR);
      $stmt->bindParam(':marka_vozila', $markaVozila, PDO::PARAM_STR);
      $stmt->bindParam(':tip_vozila', $tipVozila, PDO::PARAM_STR);
      $stmt->execute();
    }
    else
    {
      header('Location: ../view/greska.php?greska=postojiRegistracija');

      die();
    }
  }
  public function dohvatiSvaVozila()
  {
    self::$veza = DbVeza::dobijVezu();
    $upit = 'SELECT * FROM vozilo';
    $stmt = self::$veza->prepare($upit);
    $stmt->execute();
    $rezultat = $stmt->fetchAll();

    $dohvacenaVozila = [];

    foreach($rezultat as $vozilo)
    {
      $vozilo = new Vozilo(
        $vozilo['vozilo_id'],
        $vozilo['korisnik_id'],
        $vozilo['registracija'],
        $vozilo['marka_vozila'],
        $vozilo['tip_vozila']
      );
      array_push($dohvacenaVozila, $vozilo);
    }
    return $dohvacenaVozila;
  }
  public function dohvatiSvaVozilaOsim($voziloId)
  {
    self::$veza = DbVeza::dobijVezu();
    $upit = 'SELECT * FROM vozilo WHERE NOT vozilo_id = :vozilo_id';
    $stmt = self::$veza->prepare($upit);
    $stmt->bindParam(':vozilo_id', $voziloId, PDO::PARAM_INT);
    $stmt->execute();
    $rezultat = $stmt->fetchAll();

    $dohvacenaVozila = [];

    foreach($rezultat as $vozilo)
    {
      $vozilo = new Vozilo(
        $vozilo['vozilo_id'],
        $vozilo['korisnik_id'],
        $vozilo['registracija'],
        $vozilo['marka_vozila'],
        $vozilo['tip_vozila']
      );
      array_push($dohvacenaVozila, $vozilo);
    }
    return $dohvacenaVozila;
  }
}