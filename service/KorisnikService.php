<?php
require_once '../model/Korisnik.php';
require_once '../repository/KorisnikRepository.php';

class KorisnikService
{
  public function prijava($korisnickoIme, $lozinka)
  {
    $korisnik = new KorisnikRepository;
    $korisnik = $korisnik->prijava($korisnickoIme, $lozinka);

    foreach($korisnik as $prijava)
    {
      $_SESSION['korisnik_id'] = $prijava->getKorisnikId();
      $_SESSION['tip_id'] = $prijava->getTipId();
      $_SESSION['korisnicko_ime'] = $prijava->getKorisnickoIme();
      $_SESSION['lozinka'] = $prijava->getLozinka();
      $_SESSION['ime'] = $prijava->getIme();
      $_SESSION['prezime'] = $prijava->getPrezime();
      $_SESSION['email'] = $prijava->getEmail();
      $_SESSION['slika'] = $prijava->getSlika();
    }
    return $_SESSION;
  }
  public function odjava()
  {
    session_destroy();
  }
  public function dohvatiSveKorisnike()
  {
    $korisnici = new KorisnikRepository;
    $korisnici = $korisnici->dohvatiSveKorisnike();

    $listaKorisnika = [];

    foreach($korisnici as $korisnik)
    {
      $korisnik->getKorisnikId();
      $korisnik->getTipId();
      $korisnik->getKorisnickoIme();
      $korisnik->getLozinka();
      $korisnik->getIme();
      $korisnik->getPrezime();
      $korisnik->getEmail();
      $korisnik->getSlika();
      array_push($listaKorisnika, $korisnik);
    }
    return $listaKorisnika;
  }
  public function dohvatiKorisnika($korisnikId)
  {
    $korisnik = new KorisnikRepository;
    $korisnik = $korisnik->dohvatiKorisnika($korisnikId);

    $dohvaceniKorisnik = [];

    foreach($korisnik as $kor)
    {
      $kor->getKorisnikId();
      $kor->getTipId();
      $kor->getKorisnickoIme();
      $kor->getLozinka();
      $kor->getIme();
      $kor->getPrezime();
      $kor->getEmail();
      $kor->getSlika();
      array_push($dohvaceniKorisnik, $kor);
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
    $korisnik = new KorisnikRepository;
    $korisnik = $korisnik->dodajNovogKorisnika(
      $tipId, 
      $korisnickoIme, 
      $lozinka, 
      $ime, 
      $prezime, 
      $email, 
      $slika
    );
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
    $korisnik = new KorisnikRepository;
    $korisnik = $korisnik->azurirajKorisnika(
      $tipId, 
      $korisnickoIme, 
      $lozinka, 
      $ime, 
      $prezime, 
      $email, 
      $slika,
      $korisnikId
    );
  }
  public function top20($datumOd, $datumDo)
  {
    $korisnici = new KorisnikRepository;
    $korisnici = $korisnici->top20($datumOd, $datumDo);

    $top20Korisnika = [];

    foreach ($korisnici as $korisnik)
    {
      $korisnik->getKorisnikId ();
      $korisnik->getTipId ();
      $korisnik->getKorisnickoIme ();
      $korisnik->getLozinka ();
      $korisnik->getIme ();
      $korisnik->getPrezime ();
      $korisnik->getEmail ();
      $korisnik->getSlika ();
      array_push ($top20Korisnika, $korisnik);
    }
    return $top20Korisnika;
  }
  public function dohvatiModeratore()
  {
    $moderatori = new KorisnikRepository;
    $moderatori = $moderatori->dohvatiModeratore();

    $listaModeratora = [];

    foreach($moderatori as $moderator)
    {
      $moderator->getKorisnikId();
      $moderator->getTipId();
      $moderator->getKorisnickoIme();
      $moderator->getLozinka();
      $moderator->getIme();
      $moderator->getPrezime();
      $moderator->getEmail();
      $moderator->getSlika();
      array_push($listaModeratora, $moderator);
    }
    return $listaModeratora;
  }
  public function dohvatiModeratoreOsim($moderatorId)
  {
    $moderatori = new KorisnikRepository;
    $moderatori = $moderatori->dohvatiModeratoreOsim($moderatorId);

    $listaModeratora = [];

    foreach($moderatori as $moderator)
    {
      $moderator->getKorisnikId();
      $moderator->getTipId();
      $moderator->getKorisnickoIme();
      $moderator->getLozinka();
      $moderator->getIme();
      $moderator->getPrezime();
      $moderator->getEmail();
      $moderator->getSlika();
      array_push($listaModeratora, $moderator);
    }
    return $listaModeratora;
  }
}