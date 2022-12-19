<?php

class saw
{
  public $kriteria = array();
  public $alternatif = array();

  function __construct()
  {
    array_push($this->kriteria, array('Transportasi', 'C1', 0.144, 'Benefit'));
    array_push($this->kriteria, array('Suasana', 'C2', 0.219, 'Benefit'));
    array_push($this->kriteria, array('Keamanan', 'C3', 0.296, 'Cost'));
    array_push($this->kriteria, array('Variasi Produk', 'C4', 0.135, 'Cost'));
    array_push($this->kriteria, array('Fasilitas', 'C5', 0.206, 'Benefit'));

    array_push($this->alternatif, array('A1', 3, 3, 2, 1, 4));
    array_push($this->alternatif, array('A2', 3, 1, 2, 2, 4));
    array_push($this->alternatif, array('A3', 4, 3, 2, 2, 4));
    array_push($this->alternatif, array('A4', 4, 4, 1, 1, 4));
    array_push($this->alternatif, array('A5', 3, 1, 4, 1, 1));
    array_push($this->alternatif, array('A6', 3, 2, 3, 1, 4));
    array_push($this->alternatif, array('A7', 3, 3, 2, 2, 1));
    array_push($this->alternatif, array('A8', 3, 3, 2, 3, 4));
    array_push($this->alternatif, array('A9', 3, 4, 1, 1, 4));
    array_push($this->alternatif, array('A10', 3, 2, 2, 2, 4));

    $this->cmin();
    $this->cmax();
    $this->atribut();
    $this->normalisasi();
    $this->bobot();
    $this->preferensi();
  }

  function cmin()
  {
    $this->cmin = array(10, 10, 10, 10, 10);
    foreach ($this->alternatif as $a) {
      if ($this->cmin[0] > $a[1]) $this->cmin[0] = $a[1];
      if ($this->cmin[1] > $a[2]) $this->cmin[1] = $a[2];
      if ($this->cmin[2] > $a[3]) $this->cmin[2] = $a[3];
      if ($this->cmin[3] > $a[4]) $this->cmin[3] = $a[4];
      if ($this->cmin[4] > $a[5]) $this->cmin[4] = $a[5];
    }
  }

  function cmax()
  {
    $this->cmax = array(0, 0, 0, 0, 0);
    foreach ($this->alternatif as $a) {
      if ($this->cmax[0] < $a[1]) $this->cmax[0] = $a[1];
      if ($this->cmax[1] < $a[2]) $this->cmax[1] = $a[2];
      if ($this->cmax[2] < $a[3]) $this->cmax[2] = $a[3];
      if ($this->cmax[3] < $a[4]) $this->cmax[3] = $a[4];
      if ($this->cmax[4] < $a[5]) $this->cmax[4] = $a[5];
    }
  }

  function atribut()
  {
    $this->atribut = array();
    foreach ($this->kriteria as $k) {
      array_push($this->atribut, $k[3]);
    }
  }

  function normalisasi()
  {
    $this->normalisasi = array();
    foreach ($this->alternatif as $a) {
      for ($i = 0; $i < count($this->atribut); $i++) {
        if ($this->atribut[$i] == 'Benefit') {
          $a[$i + 1] = $a[$i + 1] / $this->cmax[$i];
          $a[$i + 1] = round($a[$i + 1], 3);
        } else if ($this->atribut[$i] == 'Cost') {
          $a[$i + 1] = $this->cmin[$i] / $a[$i + 1];
          $a[$i + 1] = round($a[$i + 1], 3);
        }
      }
      array_push($this->normalisasi, $a);
    }
  }

  function bobot()
  {
    $this->bobot = array();
    foreach ($this->kriteria as $k) {
      array_push($this->bobot, $k[2]);
    }
  }

  function preferensi()
  {
    $this->preferensi = array();
    foreach ($this->normalisasi as $n) {
      $total = 0;
      for ($i = 0; $i < count($this->bobot); $i++) {
        $n[$i + 1] = $n[$i + 1] * $this->bobot[$i];
        $n[$i + 1] = round($n[$i + 1], 3);
        $total = $total + $n[$i + 1];
      }
      $n[count($this->bobot) + 1] = $total;
      array_push($this->preferensi, $n);
    }
  }
}
