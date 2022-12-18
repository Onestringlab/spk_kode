<?php

class wsm_wpm
{
  public $alternatif;
  public $kriteria;
  public $bobot;
  public $wsm = array();
  public $wpm = array();

  function __construct()
  {
    $this->alternatif = array(
      array("Rudi", "A1", 1, 0.75, 0.25, 0.75, 0.25, 0.75, 0.5, 0.75, 0.75, 0.5),
      array("Dimas", "A2", 0.25, 1, 1, 1, 1, 1, 0.75, 1, 1, 0.75),
      array("Angga", "A3", 0.5, 0.25, 0.25, 0.25, 0.25, 0.5, 0.5, 0.5, 0.25, 0),
      array("Wahyu", "A4", 0.25, 0.25, 0.25, 0.25, 0.5, 1, 1, 1, 1, 1),
      array("Doni", "A5", 1, 1, 1, 1, 0.25, 0.25, 0.25, 0.25, 0.5, 1)
    );

    $this->kriteria = array(
      array("C1", "Status Kepemilikan Rumah", 0.1),
      array("C2", "Luas lantai per anggota rumah tangga", 0.05),
      array("C3", "Jenis lantai rumah", 0.05),
      array("C4", "Jenis dinding rumah", 0.05),
      array("C5", "Penerangan rumah yang digunakan", 0.15),
      array("C6", "Bahan bakar yang digunakan", 0.15),
      array("C7", "Frekuensi makan dalam sehari", 0.15),
      array("C8", "Kemampuan membeli daging/ayam/susu dalam seminggu", 0.05),
      array("C9", "Pekerjaan kepala rumah tangga", 0.15),
      array("C10", "Pendidikan kepala rumah tangga", 0.1)
    );

    $this->bobot = array(0.1, 0.05, 0.05, 0.05, 0.15, 0.15, 0.15, 0.05, 0.15, 0.1);
    $this->wsm = $this->wsm();
    $this->wpm = $this->wpm();
  }

  function wsm()
  {
    foreach ($this->alternatif as $a) {
      $total = 0;
      for ($i = 0; $i < 10; $i++) {
        $a[$i + 2] *= $this->bobot[$i];
        $total += $a[$i + 2];
      }
      $a[12] = $total;
      array_push($this->wsm, $a);
    }
    return $this->wsm;
  }

  function wpm()
  {
    foreach ($this->alternatif as $a) {
      $total = 1;
      for ($i = 0; $i < 10; $i++) {
        $a[$i + 2] = pow($a[$i + 2], $this->bobot[$i]);
        $a[$i + 2] = round($a[$i + 2], 3);
        $total *= $a[$i + 2];
        $total = round($total, 3);
      }
      $a[12] = $total;
      array_push($this->wpm, $a);
    }
    return $this->wpm;
  }
}
