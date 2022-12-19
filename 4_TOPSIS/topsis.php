<?php

class topsis
{
  public $alternatif = array();
  public $kriteria = array();

  public function __construct()
  {
    // koneksi db
    $db = new SQLite3('db_topsis.sqlite');

    // data kriteria
    $kriteria = $db->query('select * from tb_kriteria');
    while ($row = $kriteria->fetchArray()) {
      array_push($this->kriteria, array($row['kriteria'], $row['bobot'], $row['atribut']));
    }

    // array_push($this->kriteria, array('Lokasi', 5, 'Benefit'));
    // array_push($this->kriteria, array('Luas Tanah', 4, 'Benefit'));
    // array_push($this->kriteria, array('Harga', 4, 'Cost'));
    // array_push($this->kriteria, array('Ukuran', 3, 'Benefit'));
    // array_push($this->kriteria, array('Resiko', 4, 'Cost'));

    // data alternatif
    $alternatif = $db->query('select * from tb_alternatif');
    while ($row = $alternatif->fetchArray()) {
      array_push($this->alternatif, array($row['alternatif'], $row['lokasi'], $row['luas_tanah'], $row['harga'], $row['ukuran'], $row['resiko']));
    }
    // array_push($this->alternatif, array('Jalan A', 4, 2000, 5000, 3, 1));
    // array_push($this->alternatif, array('Jalan B', 2, 5000, 2000, 4, 4));
    // array_push($this->alternatif, array('Jalan C', 3, 4000, 3000, 4, 3));

    $this->pembagi();
    $this->normalisasi();
    $this->bobot();
    $this->normxbobot();
    $this->cmax();
    $this->cmin();
    $this->atribut();
    $this->ymaxmin();
    $this->dplusmin();
  }

  public function pembagi()
  {
    $this->pembagi = array(0, 0, 0, 0, 0);
    foreach ($this->alternatif as $a) {
      for ($i = 0; $i < count($this->kriteria); $i++) {
        $this->pembagi[$i] += pow($a[$i + 1], 2);
      }
    }
    for ($i = 0; $i < count($this->pembagi); $i++) {
      $this->pembagi[$i] = round(sqrt($this->pembagi[$i]), 3);
    }
  }

  public function normalisasi()
  {
    $this->normalisasi = array();
    foreach ($this->alternatif as $a) {
      for ($i = 0; $i < count($this->pembagi); $i++) {
        $a[$i + 1] = $a[$i + 1] / $this->pembagi[$i];
        $a[$i + 1] = round($a[$i + 1], 3);
      }
      array_push($this->normalisasi, $a);
    }
  }

  public function bobot()
  {
    $this->bobot = array();
    foreach ($this->kriteria as $k) {
      array_push($this->bobot, $k[1]);
    }
  }

  public function normxbobot()
  {
    $this->normxbobot = array();
    foreach ($this->normalisasi as $n) {
      for ($i = 0; $i < count($this->bobot); $i++) {
        $n[$i + 1] = $n[$i + 1] * $this->bobot[$i];
      }
      array_push($this->normxbobot, $n);
    }
  }

  public function cmin()
  {
    $this->cmin = array(10, 10, 10, 10, 10);
    foreach ($this->normxbobot as $nb) {
      if ($this->cmin[0] > $nb[1]) $this->cmin[0] = $nb[1];
      if ($this->cmin[1] > $nb[2]) $this->cmin[1] = $nb[2];
      if ($this->cmin[2] > $nb[3]) $this->cmin[2] = $nb[3];
      if ($this->cmin[3] > $nb[4]) $this->cmin[3] = $nb[4];
      if ($this->cmin[4] > $nb[5]) $this->cmin[4] = $nb[5];
    }
  }

  public function cmax()
  {
    $this->cmax = array(0, 0, 0, 0, 0);
    foreach ($this->normxbobot as $nb) {
      if ($this->cmax[0] < $nb[1]) $this->cmax[0] = $nb[1];
      if ($this->cmax[1] < $nb[2]) $this->cmax[1] = $nb[2];
      if ($this->cmax[2] < $nb[3]) $this->cmax[2] = $nb[3];
      if ($this->cmax[3] < $nb[4]) $this->cmax[3] = $nb[4];
      if ($this->cmax[4] < $nb[5]) $this->cmax[4] = $nb[5];
    }
  }

  public function atribut()
  {
    $this->atribut = array();
    foreach ($this->kriteria as $k) {
      array_push($this->atribut, $k[2]);
    }
  }

  public function ymaxmin()
  {
    $this->ymax = array();
    $this->ymin = array();
    for ($i = 0; $i < count($this->atribut); $i++) {
      if ($this->atribut[$i] == 'Benefit') {
        array_push($this->ymax, $this->cmax[$i]);
        array_push($this->ymin, $this->cmin[$i]);
      } else if ($this->atribut[$i] == 'Cost') {
        array_push($this->ymax, $this->cmin[$i]);
        array_push($this->ymin, $this->cmax[$i]);
      }
    }
  }

  public function dplusmin()
  {
    $this->dplusmin = array();
    foreach ($this->normxbobot as $nb) {
      $this->dplus = 0;
      $this->dmin = 0;
      for ($i = 0; $i < count($this->ymax); $i++) {
        $this->dplus += pow($this->ymax[$i] - $nb[$i + 1], 2);
        $this->dmin += pow($nb[$i + 1] - $this->ymin[$i], 2);
      }
      $nb[6] = round(sqrt($this->dplus), 3);
      $nb[7] = round(sqrt($this->dmin), 3);
      array_push($this->dplusmin, $nb);
    }
  }
}
