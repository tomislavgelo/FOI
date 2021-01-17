<?php
require_once '../db/DbConnection.php';

class PrekrsajRepository
{
  private static $veza;

  public function dohvatiSvePrekrsaje()
  {
    self::$veza = DbVeza::dobijVezu();
    $upit = 'SELECT * FROM prekrsaj';
    $stmt = self::$veza->query($upit);
    $rezultat = $stmt->fetchAll();

    $listaPrekrsaja = [];

    foreach($rezultat as $prekrsaj)
    {
      $prekrsaj = new Prekrsaj(
        $prekrsaj['prekrsaj_id'],
        $prekrsaj['kategorija_id'],
        $prekrsaj['vozilo_id'],
        $prekrsaj['naziv'],
        $prekrsaj['opis'],
        $prekrsaj['status'],
        $prekrsaj['novcana_kazna'],
        $prekrsaj['datum_prekrsaja'],
        $prekrsaj['vrijeme_prekrsaja'],
        $prekrsaj['datum_placanja'],
        $prekrsaj['vrijeme_placanja'],
        $prekrsaj['slika'],
        $prekrsaj['video']
      );
      array_push($listaPrekrsaja, $prekrsaj);
    }
    return $listaPrekrsaja;
  }
  public function dohvatiPrekrsaj($prekrsajId)
  {
    self::$veza = DbVeza::dobijVezu();
    $upit = 'SELECT * FROM prekrsaj WHERE prekrsaj_id = :prekrsaj_id';
    $stmt = self::$veza->prepare($upit);
    $stmt->bindParam(':prekrsaj_id', $prekrsajId, PDO::PARAM_INT);
    $stmt->execute();
    $rezultat = $stmt->fetchAll();

    $dohvaceniPrekrsaj = [];

    foreach($rezultat as $prekrsaj)
    {
      $prekrsaj = new Prekrsaj(
        $prekrsaj['prekrsaj_id'],
        $prekrsaj['kategorija_id'],
        $prekrsaj['vozilo_id'],
        $prekrsaj['naziv'],
        $prekrsaj['opis'],
        $prekrsaj['status'],
        $prekrsaj['novcana_kazna'],
        $prekrsaj['datum_prekrsaja'],
        $prekrsaj['vrijeme_prekrsaja'],
        $prekrsaj['datum_placanja'],
        $prekrsaj['vrijeme_placanja'],
        $prekrsaj['slika'],
        $prekrsaj['video']
      );
      array_push($dohvaceniPrekrsaj, $prekrsaj);
    }
    return $dohvaceniPrekrsaj;
  }
  public function dohvatiPrekrsajePremaKategoriji($kategorijaId)
  {
    self::$veza = DbVeza::dobijVezu();
    $upit = 'SELECT * FROM prekrsaj WHERE kategorija_id = :kategorija_id';
    $stmt = self::$veza->prepare($upit);
    $stmt->bindParam(':kategorija_id', $kategorijaId, PDO::PARAM_INT);
    $stmt->execute();
    $rezultat = $stmt->fetchAll();

    $dohvaceniPrekrsaji = [];

    foreach($rezultat as $prekrsaj)
    {
      $prekrsaj = new Prekrsaj(
        $prekrsaj['prekrsaj_id'],
        $prekrsaj['kategorija_id'],
        $prekrsaj['vozilo_id'],
        $prekrsaj['naziv'],
        $prekrsaj['opis'],
        $prekrsaj['status'],
        $prekrsaj['novcana_kazna'],
        $prekrsaj['datum_prekrsaja'],
        $prekrsaj['vrijeme_prekrsaja'],
        $prekrsaj['datum_placanja'],
        $prekrsaj['vrijeme_placanja'],
        $prekrsaj['slika'],
        $prekrsaj['video']
      );
      array_push($dohvaceniPrekrsaji, $prekrsaj);
    }
    return $dohvaceniPrekrsaji;
  }
  public function dohvatiPrekrsajePremaKategorijiPremaGodini($kategorijaId, $godina)
  {
    self::$veza = DbVeza::dobijVezu();
    $upit = 'SELECT * FROM prekrsaj WHERE kategorija_id = :kategorija_id 
    AND YEAR(datum_prekrsaja) = :datum_prekrsaja';
    $stmt = self::$veza->prepare($upit);
    $stmt->bindParam(':kategorija_id', $kategorijaId, PDO::PARAM_INT);
    $stmt->bindParam(':datum_prekrsaja', $godina, PDO::PARAM_INT);
    $stmt->execute();
    $rezultat = $stmt->fetchAll();

    $dohvaceniPrekrsaji = [];

    foreach($rezultat as $prekrsaj)
    {
      $prekrsaj = new Prekrsaj(
        $prekrsaj['prekrsaj_id'],
        $prekrsaj['kategorija_id'],
        $prekrsaj['vozilo_id'],
        $prekrsaj['naziv'],
        $prekrsaj['opis'],
        $prekrsaj['status'],
        $prekrsaj['novcana_kazna'],
        $prekrsaj['datum_prekrsaja'],
        $prekrsaj['vrijeme_prekrsaja'],
        $prekrsaj['datum_placanja'],
        $prekrsaj['vrijeme_placanja'],
        $prekrsaj['slika'],
        $prekrsaj['video']
      );
      array_push($dohvaceniPrekrsaji, $prekrsaj);
    }
    return $dohvaceniPrekrsaji;
  }
  public function dohvatiPrekrsajePremaVozilu($voziloId)
  {
    self::$veza = DbVeza::dobijVezu();
    $upit = 'SELECT * FROM prekrsaj WHERE vozilo_id = :vozilo_id';
    $stmt = self::$veza->prepare($upit);
    $stmt->bindParam(':vozilo_id', $voziloId, PDO::PARAM_INT);
    $stmt->execute();
    $rezultat = $stmt->fetchAll();

    $dohvaceniPrekrsaji = [];

    foreach($rezultat as $prekrsaj)
    {
      $prekrsaj = new Prekrsaj(
        $prekrsaj['prekrsaj_id'],
        $prekrsaj['kategorija_id'],
        $prekrsaj['vozilo_id'],
        $prekrsaj['naziv'],
        $prekrsaj['opis'],
        $prekrsaj['status'],
        $prekrsaj['novcana_kazna'],
        $prekrsaj['datum_prekrsaja'],
        $prekrsaj['vrijeme_prekrsaja'],
        $prekrsaj['datum_placanja'],
        $prekrsaj['vrijeme_placanja'],
        $prekrsaj['slika'],
        $prekrsaj['video']
      );
      array_push($dohvaceniPrekrsaji, $prekrsaj);
    }
    return $dohvaceniPrekrsaji;
  }
  public function placanjePrekrsaja($prekrsajId, $datumPlacanja, $vrijemePlacanja)
  {
    self::$veza = DbVeza::dobijVezu();
    $upit = 'UPDATE prekrsaj SET prekrsaj.status = "P", datum_placanja = :datum_placanja,
    vrijeme_placanja = :vrijeme_placanja WHERE prekrsaj_id = :prekrsaj_id';
    $stmt = self::$veza->prepare($upit);
    $stmt->bindParam(':prekrsaj_id', $prekrsajId, PDO::PARAM_INT);
    $stmt->bindParam(':datum_placanja', $datumPlacanja, PDO::PARAM_STR);
    $stmt->bindParam(':vrijeme_placanja', $vrijemePlacanja, PDO::PARAM_STR);
    $stmt->execute();
  }
  public function dodajNoviPrekrsaj(
    $kategorijaId, 
    $registracijaId, 
    $naziv, 
    $opis, 
    $novcanaKazna, 
    $datumPrekrsaja, 
    $vrijemePrekrsaja, 
    $slika, 
    $video
    )
  {
    self::$veza = DbVeza::dobijVezu();
    $upit = 'INSERT INTO prekrsaj (kategorija_id, vozilo_id, naziv, opis, 
    prekrsaj.status, novcana_kazna, datum_prekrsaja, vrijeme_prekrsaja, slika, video) 
    VALUES (:kategorija_id, :vozilo_id, :naziv, :opis, "N", :novcana_kazna, 
    :datum_prekrsaja, :vrijeme_prekrsaja, :slika, :video)';
    $stmt = self::$veza->prepare($upit);
    $stmt->bindParam(':kategorija_id', $kategorijaId, PDO::PARAM_INT);
    $stmt->bindParam(':vozilo_id', $registracijaId, PDO::PARAM_INT);
    $stmt->bindParam(':naziv', $naziv, PDO::PARAM_STR);
    $stmt->bindParam(':opis', $opis, PDO::PARAM_STR);
    $stmt->bindParam(':novcana_kazna', $novcanaKazna, PDO::PARAM_STR);
    $stmt->bindParam(':datum_prekrsaja', $datumPrekrsaja, PDO::PARAM_STR);
    $stmt->bindParam(':vrijeme_prekrsaja', $vrijemePrekrsaja, PDO::PARAM_STR);
    $stmt->bindParam(':slika', $slika, PDO::PARAM_STR);
    $stmt->bindParam(':video', $video, PDO::PARAM_STR);
    $stmt->execute();
  }
  public function azurirajPrekrsaj(
    $prekrsajId,
    $kategorijaId, 
    $voziloId, 
    $naziv, 
    $opis,
    $status, 
    $novcanaKazna, 
    $datumPrekrsaja, 
    $vrijemePrekrsaja,
    $datumPlacanja,
    $vrijemePlacanja, 
    $slika, 
    $video
  )
  {
    self::$veza = DbVeza::dobijVezu();
    $upit = 'UPDATE prekrsaj SET kategorija_id = :kategorija_id, 
    vozilo_id = :vozilo_id, naziv = :naziv, opis = :opis, prekrsaj.status = :status,
    novcana_kazna = :novcana_kazna, datum_prekrsaja = :datum_prekrsaja, 
    vrijeme_prekrsaja = :vrijeme_prekrsaja, datum_placanja = :datum_placanja, 
    vrijeme_placanja = :vrijeme_placanja, slika = :slika, video = :video 
    WHERE prekrsaj_id = :prekrsaj_id';
    $stmt = self::$veza->prepare($upit);
    $stmt->bindParam(':prekrsaj_id', $prekrsajId, PDO::PARAM_INT);
    $stmt->bindParam(':kategorija_id', $kategorijaId, PDO::PARAM_INT);
    $stmt->bindParam(':vozilo_id', $voziloId, PDO::PARAM_INT);
    $stmt->bindParam(':naziv', $naziv, PDO::PARAM_STR);
    $stmt->bindParam(':opis', $opis, PDO::PARAM_STR);
    $stmt->bindParam(':status', $status, PDO::PARAM_STR);
    $stmt->bindParam(':novcana_kazna', $novcanaKazna, PDO::PARAM_STR);
    $stmt->bindParam(':datum_prekrsaja', $datumPrekrsaja, PDO::PARAM_STR);
    $stmt->bindParam(':vrijeme_prekrsaja', $vrijemePrekrsaja, PDO::PARAM_STR);
    $stmt->bindParam(':datum_placanja', $datumPlacanja, PDO::PARAM_STR);
    $stmt->bindParam(':vrijeme_placanja', $vrijemePlacanja, PDO::PARAM_STR);
    $stmt->bindParam(':slika', $slika, PDO::PARAM_STR);
    $stmt->bindParam(':video', $video, PDO::PARAM_STR);
    $stmt->execute();
  }
  public function dohvatiPrekrsajePremaKorisniku($korisnikId)
  {
    self::$veza = DbVeza::dobijVezu();
    $upit = 'SELECT * FROM prekrsaj INNER JOIN vozilo ON vozilo.vozilo_id = prekrsaj.vozilo_id 
    INNER JOIN korisnik ON korisnik.korisnik_id = vozilo.korisnik_id 
    WHERE korisnik.korisnik_id = :korisnik_id';
    $stmt = self::$veza->prepare($upit);
    $stmt->bindParam(':korisnik_id', $korisnikId, PDO::PARAM_INT);
    $stmt->execute();
    $rezultat = $stmt->fetchAll();

    $dohvaceniPrekrsaji = [];

    foreach($rezultat as $prekrsaj)
    {
      $prekrsaj = new Prekrsaj(
        $prekrsaj['prekrsaj_id'],
        $prekrsaj['kategorija_id'],
        $prekrsaj['vozilo_id'],
        $prekrsaj['naziv'],
        $prekrsaj['opis'],
        $prekrsaj['status'],
        $prekrsaj['novcana_kazna'],
        $prekrsaj['datum_prekrsaja'],
        $prekrsaj['vrijeme_prekrsaja'],
        $prekrsaj['datum_placanja'],
        $prekrsaj['vrijeme_placanja'],
        $prekrsaj['slika'],
        $prekrsaj['video']
      );
      array_push($dohvaceniPrekrsaji, $prekrsaj);
    }
    return $dohvaceniPrekrsaji;
  }
  public function dohvatiPrekrsajeRazdoblje($datumOd, $datumDo)
  {
    self::$veza = DbVeza::dobijVezu();
    $upit = 'SELECT * FROM prekrsaj WHERE datum_prekrsaja BETWEEN :datum_od AND :datum_do';
    $stmt = self::$veza->prepare($upit);
    $stmt->bindParam(':datum_od', $datumOd, PDO::PARAM_STR);
    $stmt->bindParam(':datum_do', $datumDo, PDO::PARAM_STR);
    $stmt->execute();
    $rezultat = $stmt->fetchAll();

    $dohvaceniPrekrsaji = [];

    foreach($rezultat as $prekrsaj)
    {
      $prekrsaj = new Prekrsaj(
        $prekrsaj['prekrsaj_id'],
        $prekrsaj['kategorija_id'],
        $prekrsaj['vozilo_id'],
        $prekrsaj['naziv'],
        $prekrsaj['opis'],
        $prekrsaj['status'],
        $prekrsaj['novcana_kazna'],
        $prekrsaj['datum_prekrsaja'],
        $prekrsaj['vrijeme_prekrsaja'],
        $prekrsaj['datum_placanja'],
        $prekrsaj['vrijeme_placanja'],
        $prekrsaj['slika'],
        $prekrsaj['video']
      );
      array_push($dohvaceniPrekrsaji, $prekrsaj);
    }
    return $dohvaceniPrekrsaji;
  }
  public function dohvatiPrekrsajePremaKorisnikuRazdoblje($datumOd, $datumDo, $korisnikId)
  {
    self::$veza = DbVeza::dobijVezu();
    $upit = 'SELECT * FROM prekrsaj INNER JOIN vozilo ON vozilo.vozilo_id = prekrsaj.vozilo_id 
    INNER JOIN korisnik ON korisnik.korisnik_id = vozilo.korisnik_id WHERE datum_prekrsaja BETWEEN :datum_od 
    AND :datum_do AND korisnik.korisnik_id = :korisnik_id';
    $stmt = self::$veza->prepare($upit);
    $stmt->bindParam(':datum_od', $datumOd, PDO::PARAM_STR);
    $stmt->bindParam(':datum_do', $datumDo, PDO::PARAM_STR);
    $stmt->bindParam(':korisnik_id', $korisnikId, PDO::PARAM_INT);
    $stmt->execute();
    $rezultat = $stmt->fetchAll();

    $dohvaceniPrekrsaji = [];

    foreach($rezultat as $prekrsaj)
    {
      $prekrsaj = new Prekrsaj(
        $prekrsaj['prekrsaj_id'],
        $prekrsaj['kategorija_id'],
        $prekrsaj['vozilo_id'],
        $prekrsaj['naziv'],
        $prekrsaj['opis'],
        $prekrsaj['status'],
        $prekrsaj['novcana_kazna'],
        $prekrsaj['datum_prekrsaja'],
        $prekrsaj['vrijeme_prekrsaja'],
        $prekrsaj['datum_placanja'],
        $prekrsaj['vrijeme_placanja'],
        $prekrsaj['slika'],
        $prekrsaj['video']
      );
      array_push($dohvaceniPrekrsaji, $prekrsaj);
    }
    return $dohvaceniPrekrsaji;
  }
}