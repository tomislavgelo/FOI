<?php
require_once '../db/DbConnection.php';

class TipKorisnikaRepository
{
  private static $veza;

  public function dohvatiSveTipove()
  {
    self::$veza = DbVeza::dobijVezu();
    $upit = 'SELECT * FROM tip_korisnika';
    $stmt = self::$veza->query($upit);
    $rezultat = $stmt->fetchAll();

    $listaTipova = [];
    
    foreach($rezultat as $tipKorisnika)
    {
      $tipKorisnika = new TipKorisnika(
        $tipKorisnika['tip_id'],
        $tipKorisnika['naziv']
      );
      array_push($listaTipova, $tipKorisnika);
    }
    return $listaTipova;
  }
  public function dohvatiSveTipoveOsim($tipId)
  {
    self::$veza = DbVeza::dobijVezu();
    $upit = 'SELECT * FROM tip_korisnika WHERE NOT tip_id = :tip_id';
    $stmt = self::$veza->prepare($upit);
    $stmt->bindParam(':tip_id', $tipId, PDO::PARAM_INT);
    $stmt->execute();
    $rezultat = $stmt->fetchAll();

    $listaTipova = [];

    foreach($rezultat as $tipKorisnika)
    {
      $tipKorisnika = new TipKorisnika(
        $tipKorisnika['tip_id'],
        $tipKorisnika['naziv']
      );
      array_push($listaTipova, $tipKorisnika);
    }
    return $listaTipova;
  }
  public function dohvatiTipKorisnika($tipId)
  {
    self::$veza = DbVeza::dobijVezu();
    $upit = 'SELECT * FROM tip_korisnika WHERE tip_id = :tip_id';
    $stmt = self::$veza->prepare($upit);
    $stmt->bindParam(':tip_id', $tipId, PDO::PARAM_INT);
    $stmt->execute();
    $rezultat = $stmt->fetchAll();

    $dohvaceniTip = [];

    foreach($rezultat as $tipKorisnika)
    {
      $tipKorisnika = new TipKorisnika(
        $tipKorisnika['tip_id'],
        $tipKorisnika['naziv']
      );
      array_push($dohvaceniTip, $tipKorisnika);
    }
    return $dohvaceniTip;
  }
}