<?php
require_once '../db/DbConnection.php';

class KorisnikRepository
{
  private static $veza;

  public function prijava($korisnickoIme, $lozinka)
  {
    self::$veza = DbVeza::dobijVezu();
    $upit = 'SELECT * FROM korisnik WHERE 
    korisnicko_ime = :korisnicko_ime AND
    lozinka = :lozinka';
    $stmt = self::$veza->prepare($upit);
    $stmt->bindParam(':korisnicko_ime', $korisnickoIme, PDO::PARAM_STR);
    $stmt->bindParam(':lozinka', $lozinka, PDO::PARAM_STR);
    $stmt->execute();
    $rezultat = $stmt->fetchAll();

    $dohvaceniKorisnik = [];

    foreach($rezultat as $korisnik)
    {
      $korisnik = new Korisnik(
        $korisnik['korisnik_id'],
        $korisnik['tip_id'],
        $korisnik['korisnicko_ime'],
        $korisnik['lozinka'],
        $korisnik['ime'],
        $korisnik['prezime'],
        $korisnik['email'],
        $korisnik['slika']
      );
      array_push($dohvaceniKorisnik, $korisnik);
    }
    return $dohvaceniKorisnik;
  }
  public function dohvatiSveKorisnike()
  {
    self::$veza = DbVeza::dobijVezu();
    $upit = 'SELECT * FROM korisnik';
    $stmt = self::$veza->query($upit);
    $rezultat = $stmt->fetchAll();

    $listaKorisnika = [];

    foreach($rezultat as $korisnik)
    {
      $korisnik = new Korisnik(
        $korisnik['korisnik_id'],
        $korisnik['tip_id'],
        $korisnik['korisnicko_ime'],
        $korisnik['lozinka'],
        $korisnik['ime'],
        $korisnik['prezime'],
        $korisnik['email'],
        $korisnik['slika']
      );
      array_push($listaKorisnika, $korisnik);
    }
    return $listaKorisnika;
  }
  public function dohvatiKorisnika($korisnikId)
  {
    self::$veza = DbVeza::dobijVezu();
    $upit = 'SELECT * FROM korisnik WHERE korisnik_id = :korisnik_id';
    $stmt = self::$veza->prepare($upit);
    $stmt->bindParam(':korisnik_id', $korisnikId, PDO::PARAM_INT);
    $stmt->execute();
    $rezultat = $stmt->fetchAll();

    $dohvaceniKorisnik = [];

    foreach($rezultat as $korisnik)
    {
      $korisnik = new Korisnik(
        $korisnik['korisnik_id'],
        $korisnik['tip_id'],
        $korisnik['korisnicko_ime'],
        $korisnik['lozinka'],
        $korisnik['ime'],
        $korisnik['prezime'],
        $korisnik['email'],
        $korisnik['slika']
      );
      array_push($dohvaceniKorisnik, $korisnik);
    }
    return $dohvaceniKorisnik;
  }
  public function dodajNovogKorisnika(
    $tipId, 
    $korisnickoIme, 
    $lozinka, 
    $ime, 
    $prezime, 
    $email, 
    $slika
  )
  {
    self::$veza = DbVeza::dobijVezu();
    $upit = 'SELECT * FROM korisnik WHERE korisnicko_ime = :korisnicko_ime';
    $stmt = self::$veza->prepare($upit);
    $stmt->bindParam(':korisnicko_ime', $korisnickoIme, PDO::PARAM_STR);
    $stmt->execute();
    $rezultat = $stmt->fetchAll();

    if($rezultat == null)
    {
      self::$veza = DbVeza::dobijVezu();
      $upit = 'INSERT INTO korisnik 
      (tip_id, korisnicko_ime, lozinka, ime, prezime, email, slika) 
      VALUES (:tip_id, :korisnicko_ime, :lozinka, :ime, :prezime, :email, :slika)';
      $stmt = self::$veza->prepare($upit);
      $stmt->bindParam(':tip_id', $tipId, PDO::PARAM_INT);
      $stmt->bindParam(':korisnicko_ime', $korisnickoIme, PDO::PARAM_STR);
      $stmt->bindParam(':lozinka', $lozinka, PDO::PARAM_STR);
      $stmt->bindParam(':ime', $ime, PDO::PARAM_STR);
      $stmt->bindParam(':prezime', $prezime, PDO::PARAM_STR);
      $stmt->bindParam(':email', $email, PDO::PARAM_STR);
      $stmt->bindParam(':slika', $slika, PDO::PARAM_STR);
      $stmt->execute();
    }
    else
    {
      header('Location: ../view/greska.php?greska=postojiKorisnik');

      die();
    }
  }
  public function azurirajKorisnika(
    $tipId, 
    $korisnickoIme, 
    $lozinka, 
    $ime, 
    $prezime, 
    $email, 
    $slika, 
    $korisnikId 
  )
  {
    self::$veza = DbVeza::dobijVezu();
    $upit = 'SELECT * FROM korisnik WHERE korisnicko_ime = :korisnicko_ime 
    AND NOT korisnik_id = :korisnik_id';
    $stmt = self::$veza->prepare($upit);
    $stmt->bindParam(':korisnicko_ime', $korisnickoIme, PDO::PARAM_STR);
    $stmt->bindParam(':korisnik_id', $korisnikId, PDO::PARAM_INT);
    $stmt->execute();
    $rezultat = $stmt->fetchAll();

    if($rezultat == null)
    {
      if($slika == null)
      {
        self::$veza = DbVeza::dobijVezu();
        $upit = 'UPDATE korisnik SET 
        tip_id = :tip_id, 
        korisnicko_ime = :korisnicko_ime, 
        lozinka = :lozinka, 
        ime = :ime, 
        prezime = :prezime, 
        email = :email 
        WHERE korisnik_id = :korisnik_id';
        $stmt = self::$veza->prepare($upit);
        $stmt->bindParam(':tip_id', $tipId, PDO::PARAM_INT);
        $stmt->bindParam(':korisnicko_ime', $korisnickoIme, PDO::PARAM_STR);
        $stmt->bindParam(':lozinka', $lozinka, PDO::PARAM_STR);
        $stmt->bindParam(':ime', $ime, PDO::PARAM_STR);
        $stmt->bindParam(':prezime', $prezime, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':korisnik_id', $korisnikId, PDO::PARAM_INT);
        $stmt->execute();
      }
      else
      {
        self::$veza = DbVeza::dobijVezu();
        $upit = 'UPDATE korisnik SET 
        tip_id = :tip_id, 
        korisnicko_ime = :korisnicko_ime, 
        lozinka = :lozinka, 
        ime = :ime, 
        prezime = :prezime, 
        email = :email, 
        slika = :slika 
        WHERE korisnik_id = :korisnik_id';
        $stmt = self::$veza->prepare($upit);
        $stmt->bindParam(':tip_id', $tipId, PDO::PARAM_INT);
        $stmt->bindParam(':korisnicko_ime', $korisnickoIme, PDO::PARAM_STR);
        $stmt->bindParam(':lozinka', $lozinka, PDO::PARAM_STR);
        $stmt->bindParam(':ime', $ime, PDO::PARAM_STR);
        $stmt->bindParam(':prezime', $prezime, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':slika', $slika, PDO::PARAM_STR);
        $stmt->bindParam(':korisnik_id', $korisnikId, PDO::PARAM_INT);
        $stmt->execute();
      }
    }
    else
    {
      header('Location: ../view/greska.php?greska=postojiKorisnik');

      die();
    }
  }
  public function top20($datumOd, $datumDo)
  {
    self::$veza = DbVeza::dobijVezu();
    $upit = 'SELECT * FROM korisnik k INNER JOIN vozilo v ON 
    v.korisnik_id = k.korisnik_id INNER JOIN prekrsaj p ON 
    p.vozilo_id = v.vozilo_id WHERE v.korisnik_id = k.korisnik_id AND 
    v.vozilo_id = p.vozilo_id AND p.datum_prekrsaja BETWEEN :datumOd AND 
    :datumDo GROUP BY k.korisnik_id ORDER BY COUNT(*) DESC LIMIT 20';
    $stmt = self::$veza->prepare($upit);
    $stmt->bindParam(':datumOd', $datumOd, PDO::PARAM_STR);
    $stmt->bindParam(':datumDo', $datumDo, PDO::PARAM_STR);
    $stmt->execute();
    $rezultat = $stmt->fetchAll();

    $top20Korisnika = [];

    foreach($rezultat as $korisnik)
    {
      $korisnik = new Korisnik(
        $korisnik['korisnik_id'],
        $korisnik['tip_id'],
        $korisnik['korisnicko_ime'],
        $korisnik['lozinka'],
        $korisnik['ime'],
        $korisnik['prezime'],
        $korisnik['email'],
        $korisnik['slika']
      );
      array_push($top20Korisnika, $korisnik);
    }
    return $top20Korisnika;
  }
  public function dohvatiModeratore()
  {
    self::$veza = DbVeza::dobijVezu();
    $upit = 'SELECT * FROM korisnik WHERE tip_id = 1';
    $stmt = self::$veza->query($upit);
    $rezultat = $stmt->fetchAll();

    $listaModeratora = [];

    foreach($rezultat as $moderator)
    {
      $moderator = new Korisnik(
        $moderator['korisnik_id'],
        $moderator['tip_id'],
        $moderator['korisnicko_ime'],
        $moderator['lozinka'],
        $moderator['ime'],
        $moderator['prezime'],
        $moderator['email'],
        $moderator['slika']
      );
      array_push($listaModeratora, $moderator);
    }
    return $listaModeratora;
  }
  
  public function dohvatiModeratoreOsim($moderatorId)
  {
    self::$veza = DbVeza::dobijVezu();
    $upit = 'SELECT * FROM korisnik WHERE tip_id = 1 AND NOT korisnik_id = :moderator_id';
    $stmt = self::$veza->prepare($upit);
    $stmt->bindParam(':moderator_id', $moderatorId, PDO::PARAM_INT);
    $stmt->execute();
    $rezultat = $stmt->fetchAll();

    $listaModeratora = [];

    foreach($rezultat as $moderator)
    {
      $moderator = new Korisnik(
        $moderator['korisnik_id'],
        $moderator['tip_id'],
        $moderator['korisnicko_ime'],
        $moderator['lozinka'],
        $moderator['ime'],
        $moderator['prezime'],
        $moderator['email'],
        $moderator['slika']
      );
      array_push($listaModeratora, $moderator);
    }
    return $listaModeratora;
  }
}