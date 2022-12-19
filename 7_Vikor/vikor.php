<?php

class vikor
{
  public $db;
  public $kriteria = array();
  public $alternatif = array();
  public $atribut = array();
  public $bobot = array();
  public $fplus = array();
  public $fmin = array();
  public $matriks_normalisasi = array();
  public $matriks_normalisasi_bobot = array();
  public $Splus = 0;
  public $Rplus = 0;
  public $Smin = 1;
  public $Rmin = 1;
  public $nilai_vikor = array();
  public $perangkingan = array();
  public $DQ = 0;
  public $Qx = 0;
  public $accepptable = "";


  public function __construct()
  {
    $this->get_koneksi_db();
    $this->get_kriteria();
    $this->get_alternatif();
    $this->get_fplus_fmin();
    $this->get_matriks_normalisasi();
    $this->get_matriks_normalisasi_bobot();
    $this->get_splus_rplus_smin_rmin();
    $this->get_nilai_vikor();
    $this->get_perangkingan();
    $this->get_acceptable();
  }

  public function get_koneksi_db()
  {
    $this->db = new SQLite3('db_vikor.sqlite');
  }

  public function get_kriteria()
  {
    $kriteria = $this->db->query('select * from tb_kriteria');
    while ($row = $kriteria->fetchArray()) {
      array_push($this->kriteria, array($row['kode'], $row['kriteria'], $row['atribut'], $row['bobot']));
      array_push($this->atribut, $row['atribut']);
      array_push($this->bobot, $row['bobot']);
    }
  }

  public function get_alternatif()
  {
    $alternatif = $this->db->query('select * from tb_alternatif');
    while ($row = $alternatif->fetchArray()) {
      array_push($this->alternatif, array($row['kode'], $row['alternatif'], $row['k1'], $row['k2'], $row['k3'], $row['k4']));
    }
  }

  public function get_fplus_fmin()
  {
    $kmax = array(0, 0, 0, 0);
    $kmin = array(5000000, 5000000, 5000000, 5000000, 5000000);

    for ($i = 0; $i < count($this->alternatif); $i++) {
      for ($j = 2; $j < count($this->alternatif[$i]); $j++) {
        if ($kmax[$j - 2] < $this->alternatif[$i][$j]) {
          $kmax[$j - 2] = $this->alternatif[$i][$j];
        }

        if ($kmin[$j - 2] > $this->alternatif[$i][$j]) {
          $kmin[$j - 2] = $this->alternatif[$i][$j];
        }
      }
    }

    for ($i = 0; $i < count($this->atribut); $i++) {
      if ($this->atribut[$i] ==  "B") {
        array_push($this->fplus, $kmax[$i]);
      } else {
        array_push($this->fplus, $kmin[$i]);
      }

      if ($this->atribut[$i] ==  "C") {
        array_push($this->fmin, $kmax[$i]);
      } else {
        array_push($this->fmin, $kmin[$i]);
      }
    }
  }

  public function get_matriks_normalisasi()
  {
    $temp_normalisasi = $this->alternatif;
    for ($i = 0; $i < count($temp_normalisasi); $i++) {
      for ($j = 2; $j < count($temp_normalisasi[$i]); $j++) {
        $temp_normalisasi[$i][$j] = ($this->fplus[$j - 2] - $temp_normalisasi[$i][$j]) / ($this->fplus[$j - 2] - $this->fmin[$j - 2]);
        $temp_normalisasi[$i][$j] = round($temp_normalisasi[$i][$j], 4);
      }
      array_push($this->matriks_normalisasi, $temp_normalisasi[$i]);
    }
  }

  public function get_matriks_normalisasi_bobot()
  {
    $temp_normalisasi_bobot = $this->matriks_normalisasi;
    for ($i = 0; $i < count($temp_normalisasi_bobot); $i++) {
      $Si = 0;
      $Ri = 0;
      for ($j = 2; $j < count($temp_normalisasi_bobot[$i]); $j++) {
        $temp_normalisasi_bobot[$i][$j] = $temp_normalisasi_bobot[$i][$j] * $this->bobot[$j - 2];
        $temp_normalisasi_bobot[$i][$j] = round($temp_normalisasi_bobot[$i][$j], 4);
        $Si += $temp_normalisasi_bobot[$i][$j];
        if ($Ri < $temp_normalisasi_bobot[$i][$j]) {
          $Ri = $temp_normalisasi_bobot[$i][$j];
        }
      }
      $temp_normalisasi_bobot[$i][6] = $Si;
      $temp_normalisasi_bobot[$i][7] = $Ri;

      array_push($this->matriks_normalisasi_bobot, $temp_normalisasi_bobot[$i]);
    }
  }

  public function get_splus_rplus_smin_rmin()
  {
    for ($i = 0; $i < count($this->matriks_normalisasi_bobot); $i++) {

      if ($this->Splus < $this->matriks_normalisasi_bobot[$i][6]) {
        $this->Splus = $this->matriks_normalisasi_bobot[$i][6];
      }

      if ($this->Smin > $this->matriks_normalisasi_bobot[$i][6]) {
        $this->Smin = $this->matriks_normalisasi_bobot[$i][6];
      }

      if ($this->Rplus < $this->matriks_normalisasi_bobot[$i][7]) {
        $this->Rplus = $this->matriks_normalisasi_bobot[$i][7];
      }

      if ($this->Rmin > $this->matriks_normalisasi_bobot[$i][7]) {
        $this->Rmin = $this->matriks_normalisasi_bobot[$i][7];
      }
    }
  }

  public function hitung_nilai_vikor($v, $si, $splus, $smin, $ri, $rplus, $rmin)
  {
    $q = ($v * (($si - $smin) / ($splus - $smin))) + ((1 - $v) * (($ri - $rmin) / ($rplus - $rmin)));
    return round($q, 4);
  }

  public function get_nilai_vikor()
  {
    for ($i = 0; $i < count($this->matriks_normalisasi_bobot); $i++) {
      $q050 = $this->hitung_nilai_vikor(0.5, $this->matriks_normalisasi_bobot[$i][6], $this->Splus, $this->Smin, $this->matriks_normalisasi_bobot[$i][7], $this->Rplus, $this->Rmin);


      $q045 = $this->hitung_nilai_vikor(0.45, $this->matriks_normalisasi_bobot[$i][6], $this->Splus, $this->Smin, $this->matriks_normalisasi_bobot[$i][7], $this->Rplus, $this->Rmin);


      $q055 = $this->hitung_nilai_vikor(0.55, $this->matriks_normalisasi_bobot[$i][6], $this->Splus, $this->Smin, $this->matriks_normalisasi_bobot[$i][7], $this->Rplus, $this->Rmin);

      array_push($this->nilai_vikor, array($this->matriks_normalisasi_bobot[$i][0], $this->matriks_normalisasi_bobot[$i][1], $q050, $q045, $q055));
    }
  }

  public function get_perangkingan()
  {
    $this->perangkingan = $this->nilai_vikor;
    $keys = array_column($this->perangkingan, 2);
    array_multisort($keys, SORT_ASC, $this->perangkingan);
  }

  public function get_acceptable()
  {
    $this->Qx = $this->perangkingan[1][2] - $this->perangkingan[0][2];
    $this->Qx = round($this->Qx, 4);

    $this->QD = round(1 / (13 - 1), 4);

    if ($this->Qx > $this->DQ) {
      $this->accepptable = "Nilai selisih yang dihasilkan lebih besar dari nilai DQ, sehingga kondisi Acceptable advantage terpenuhi";
    } else {
      $this->accepptable = "Nilai selisih yang dihasilkan lebih besar dari nilai DQ, sehingga kondisi Acceptable advantage tidak terpenuhi";
    }
  }
}
