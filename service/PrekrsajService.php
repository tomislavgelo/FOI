<?php
require_once '../model/Prekrsaj.php';
require_once '../repository/PrekrsajRepository.php';

class PrekrsajService
{
  public function dohvatiSvePrekrsaje()
  {
    $prekrsaji = new PrekrsajRepository;
    $prekrsaji = $prekrsaji->dohvatiSvePrekrsaje();

    $listaPrekrsaja = [];

    foreach($prekrsaji as $prekrsaj)
    {
      $prekrsaj->getPrekrsajId();
      $prekrsaj->getKategorijaId();
      $prekrsaj->getVoziloId();
      $prekrsaj->getNaziv();
      $prekrsaj->getOpis();
      $prekrsaj->getStatus();
      $prekrsaj->getNovcanaKazna();
      $prekrsaj->getDatumPrekrsaja();
      $prekrsaj->getVrijemePrekrsaja();
      $prekrsaj->getDatumPlacanja();
      $prekrsaj->getVrijemePlacanja();
      $prekrsaj->getSlika();
      $prekrsaj->getVideo();
      array_push($listaPrekrsaja, $prekrsaj);
    }
    return $listaPrekrsaja;
  }
  public function dohvatiPrekrsaj($prekrsajId)
  {
    $prekrsaj = new PrekrsajRepository;
    $prekrsaj = $prekrsaj->dohvatiPrekrsaj($prekrsajId);

    $dohvaceniPrekrsaj = [];

    foreach($prekrsaj as $pre)
    {
      $pre->getPrekrsajId();
      $pre->getKategorijaId();
      $pre->getVoziloId();
      $pre->getNaziv();
      $pre->getOpis();
      $pre->getStatus();
      $pre->getNovcanaKazna();
      $pre->getDatumPrekrsaja();
      $pre->getVrijemePrekrsaja();
      $pre->getDatumPlacanja();
      $pre->getVrijemePlacanja();
      $pre->getSlika();
      $pre->getVideo();
      array_push($dohvaceniPrekrsaj, $pre);
    }
    return $dohvaceniPrekrsaj;
  }
  public function dohvatiPrekrsajePremaKategoriji($kategorijaId)
  {
    $prekrsaji = new PrekrsajRepository;
    $prekrsaji = $prekrsaji->dohvatiPrekrsajePremaKategoriji($kategorijaId);

    $dohvaceniPrekrsaji = [];

    foreach($prekrsaji as $prekrsaj)
    {
      $prekrsaj->getPrekrsajId();
      $prekrsaj->getKategorijaId();
      $prekrsaj->getVoziloId();
      $prekrsaj->getNaziv();
      $prekrsaj->getOpis();
      $prekrsaj->getStatus();
      $prekrsaj->getNovcanaKazna();
      $prekrsaj->getDatumPrekrsaja();
      $prekrsaj->getVrijemePrekrsaja();
      $prekrsaj->getDatumPlacanja();
      $prekrsaj->getVrijemePlacanja();
      $prekrsaj->getSlika();
      $prekrsaj->getVideo();
      array_push($dohvaceniPrekrsaji, $prekrsaj);
    }
    return $dohvaceniPrekrsaji;
  }
  public function dohvatiPrekrsajePremaKategorijiPremaGodini($kategorijaId, $godina)
  {
    $prekrsaji = new PrekrsajRepository;
    $prekrsaji = $prekrsaji->dohvatiPrekrsajePremaKategorijiPremaGodini($kategorijaId, $godina);

    $dohvaceniPrekrsaji = [];

    foreach($prekrsaji as $prekrsaj)
    {
      $prekrsaj->getPrekrsajId();
      $prekrsaj->getKategorijaId();
      $prekrsaj->getVoziloId();
      $prekrsaj->getNaziv();
      $prekrsaj->getOpis();
      $prekrsaj->getStatus();
      $prekrsaj->getNovcanaKazna();
      $prekrsaj->getDatumPrekrsaja();
      $prekrsaj->getVrijemePrekrsaja();
      $prekrsaj->getDatumPlacanja();
      $prekrsaj->getVrijemePlacanja();
      $prekrsaj->getSlika();
      $prekrsaj->getVideo();
      array_push($dohvaceniPrekrsaji, $prekrsaj);
    }
    return $dohvaceniPrekrsaji;
  }
  public function dohvatiPrekrsajePremaVozilu($voziloId)
  {
    $prekrsaji = new PrekrsajRepository;
    $prekrsaji = $prekrsaji->dohvatiPrekrsajePremaVozilu($voziloId);

    $dohvaceniPrekrsaji = [];

    foreach($prekrsaji as $prekrsaj)
    {
      $prekrsaj->getPrekrsajId();
      $prekrsaj->getKategorijaId();
      $prekrsaj->getVoziloId();
      $prekrsaj->getNaziv();
      $prekrsaj->getOpis();
      $prekrsaj->getStatus();
      $prekrsaj->getNovcanaKazna();
      $prekrsaj->getDatumPrekrsaja();
      $prekrsaj->getVrijemePrekrsaja();
      $prekrsaj->getDatumPlacanja();
      $prekrsaj->getVrijemePlacanja();
      $prekrsaj->getSlika();
      $prekrsaj->getVideo();
      array_push($dohvaceniPrekrsaji, $prekrsaj);
    }
    return $dohvaceniPrekrsaji;
  }
  public function placanjePrekrsaja($prekrsajId, $datumPlacanja, $vrijemePlacanja)
  {
    $placanjePrekrsaja = new PrekrsajRepository;
    $placanjePrekrsaja = $placanjePrekrsaja->placanjePrekrsaja($prekrsajId, $datumPlacanja, $vrijemePlacanja);
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
    $noviPrekrsaj = new PrekrsajRepository;
    $noviPrekrsaj = $noviPrekrsaj->dodajNoviPrekrsaj(
      $kategorijaId, 
      $registracijaId, 
      $naziv, 
      $opis, 
      $novcanaKazna, 
      $datumPrekrsaja, 
      $vrijemePrekrsaja, 
      $slika, 
      $video
    );
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
    $noviPrekrsaj = new PrekrsajRepository;
    $noviPrekrsaj = $noviPrekrsaj->azurirajPrekrsaj(
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
    );
  }
  public function dohvatiPrekrsajePremaKorisniku($korisnikId)
  {
    $prekrsaji = new PrekrsajRepository;
    $prekrsaji = $prekrsaji->dohvatiPrekrsajePremaKorisniku($korisnikId);

    $dohvaceniPrekrsaji = [];

    foreach($prekrsaji as $prekrsaj)
    {
      $prekrsaj->getPrekrsajId();
      $prekrsaj->getKategorijaId();
      $prekrsaj->getVoziloId();
      $prekrsaj->getNaziv();
      $prekrsaj->getOpis();
      $prekrsaj->getStatus();
      $prekrsaj->getNovcanaKazna();
      $prekrsaj->getDatumPrekrsaja();
      $prekrsaj->getVrijemePrekrsaja();
      $prekrsaj->getDatumPlacanja();
      $prekrsaj->getVrijemePlacanja();
      $prekrsaj->getSlika();
      $prekrsaj->getVideo();
      array_push($dohvaceniPrekrsaji, $prekrsaj);
    }
    return $dohvaceniPrekrsaji;
  }
  public function dohvatiPrekrsajeRazdoblje($datumOd, $datumDo)
  {
    $prekrsaji = new PrekrsajRepository;
    $prekrsaji = $prekrsaji->dohvatiPrekrsajeRazdoblje($datumOd, $datumDo);

    $dohvaceniPrekrsaji = [];

    foreach($prekrsaji as $prekrsaj)
    {
      $prekrsaj->getPrekrsajId();
      $prekrsaj->getKategorijaId();
      $prekrsaj->getVoziloId();
      $prekrsaj->getNaziv();
      $prekrsaj->getOpis();
      $prekrsaj->getStatus();
      $prekrsaj->getNovcanaKazna();
      $prekrsaj->getDatumPrekrsaja();
      $prekrsaj->getVrijemePrekrsaja();
      $prekrsaj->getDatumPlacanja();
      $prekrsaj->getVrijemePlacanja();
      $prekrsaj->getSlika();
      $prekrsaj->getVideo();
      array_push($dohvaceniPrekrsaji, $prekrsaj);
    }
    return $dohvaceniPrekrsaji;
  }
  public function dohvatiPrekrsajePremaKorisnikuRazdoblje($datumOd, $datumDo, $korisnikId)
  {
    $prekrsaji = new PrekrsajRepository;
    $prekrsaji = $prekrsaji->dohvatiPrekrsajePremaKorisnikuRazdoblje($datumOd, $datumDo, $korisnikId);

    $dohvaceniPrekrsaji = [];

    foreach($prekrsaji as $prekrsaj)
    {
      $prekrsaj->getPrekrsajId();
      $prekrsaj->getKategorijaId();
      $prekrsaj->getVoziloId();
      $prekrsaj->getNaziv();
      $prekrsaj->getOpis();
      $prekrsaj->getStatus();
      $prekrsaj->getNovcanaKazna();
      $prekrsaj->getDatumPrekrsaja();
      $prekrsaj->getVrijemePrekrsaja();
      $prekrsaj->getDatumPlacanja();
      $prekrsaj->getVrijemePlacanja();
      $prekrsaj->getSlika();
      $prekrsaj->getVideo();
      array_push($dohvaceniPrekrsaji, $prekrsaj);
    }
    return $dohvaceniPrekrsaji;
  }
}