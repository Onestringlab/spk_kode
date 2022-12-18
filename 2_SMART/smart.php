<?php

class smart
{
  public $kriteria = array();
  public $alternatif = array();
  public $normalisasi_bobot = array();
  public $cmin = array();
  public $cmax = array();
  public $nilai_utilitas = array();
  public $nilai_akhir = array();

  function __construct()
  {
    //data kriteria dan bobot
    array_push($this->kriteria, array('CO1', 'Rangking Paralel', 86));
    array_push($this->kriteria, array('CO2', 'Prestasi', 89));
    array_push($this->kriteria, array('CO3', 'Kondisi Ekonomi', 83));
    array_push($this->kriteria, array('CO4', 'Hafalan Al Quran', 80));

    //data alternatif
    array_push($this->alternatif, array('A1', 4, 1, 3, 1));
    array_push($this->alternatif, array('A2', 1, 0, 4, 3));
    array_push($this->alternatif, array('A3', 0, 0, 2, 2));
    array_push($this->alternatif, array('A4', 2, 0, 2, 1));
    array_push($this->alternatif, array('A5', 3, 3, 1, 1));

    $this->normalisasi();
    $this->cmin();
    $this->cmax();
    $this->nilai_utilitas();
    $this->nilai_akhir();
  }

  function normalisasi()
  {
    $total_bobot = 0;
    foreach ($this->kriteria as $k) {
      $total_bobot += $k[2];
    }

    foreach ($this->kriteria as $k) {
      $k[3] = $k[2] / $total_bobot;
      $k[3] = round($k[3], 4);
      array_push($this->normalisasi_bobot, $k);
    }
  }

  function cmin()
  {
    $this->cmin = array(10, 10, 10, 10);
    foreach ($this->alternatif as $a) {
      if ($this->cmin[0] > $a[1]) $this->cmin[0] = $a[1];
      if ($this->cmin[1] > $a[2]) $this->cmin[1] = $a[2];
      if ($this->cmin[2] > $a[3]) $this->cmin[2] = $a[3];
      if ($this->cmin[3] > $a[4]) $this->cmin[3] = $a[4];
    }
  }

  function cmax()
  {
    $this->cmax = array(0, 0, 0, 0);
    foreach ($this->alternatif as $a) {
      if ($this->cmax[0] < $a[1]) $this->cmax[0] = $a[1];
      if ($this->cmax[1] < $a[2]) $this->cmax[1] = $a[2];
      if ($this->cmax[2] < $a[3]) $this->cmax[2] = $a[3];
      if ($this->cmax[3] < $a[4]) $this->cmax[3] = $a[4];
    }
  }

  function nilai_utilitas()
  {
    foreach ($this->alternatif as $a) {
      for ($i = 0; $i < 4; $i++) {
        $a[$i + 1] = ($a[$i + 1] - $this->cmin[$i]) / ($this->cmax[$i] - $this->cmin[$i]);
        $a[$i + 1] = round($a[$i + 1], 4);
      }
      array_push($this->nilai_utilitas, $a);
    }
  }

  function nilai_akhir()
  {
    $bobot = array();
    foreach ($this->normalisasi_bobot as $nb) {
      array_push($bobot, $nb[3]);
    }

    foreach ($this->nilai_utilitas as $nu) {
      $total = 0;
      for ($i = 0; $i < count($bobot); $i++) {
        $nu[$i + 1] = $nu[$i + 1] * $bobot[$i];
        $nu[$i + 1] = round($nu[$i + 1], 4);
        $total += $nu[$i + 1];
      }
      $nu[5] = $total;
      array_push($this->nilai_akhir, $nu);
    }
  }
}
