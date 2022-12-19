<?php

class moora
{
  public $db;
  public $kriteria = array();
  public $alternatif = array();
  public $akar_sigma = array(0, 0, 0, 0, 0);
  public $matriks_ternormalisasi = array();
  public $nilai_optimalisasi = array();
  public $perangkingan = array();

  public function __construct()
  {
    $this->get_koneksi_db();
    $this->get_kriteria();
    $this->get_alternatif();
    $this->get_akar_sigma();
    $this->get_matriks_ternormalisasi();
    $this->get_nilai_optimalisasi();
    $this->get_perangkingan();
  }

  public function get_koneksi_db()
  {
    // $this->db = new SQLite3('db_moora.sqlite');

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "db_moora";

    $this->db = mysqli_connect($servername, $username, $password, $database);
  }

  public function get_kriteria()
  {
    $kriteria = $this->db->query('select * from tb_kriteria');
    while ($row = $kriteria->fetch_assoc()) {
      array_push($this->kriteria, array($row['kode'], $row['kriteria'], $row['atribut'], $row['bobot'], $row['satuan']));
    }
  }

  public function get_alternatif()
  {
    $alternatif = $this->db->query('select * from tb_alternatif');
    while ($row = $alternatif->fetch_assoc()) {
      array_push($this->alternatif, array($row['kode'], $row['alternatif'], $row['k1'], $row['k2'], $row['k3'], $row['k4'], $row['k5']));
    }
  }

  public function get_akar_sigma()
  {
    $jumlah = array_fill(0, count($this->kriteria), 0);
    for ($i = 0; $i < count($this->alternatif); $i++) {
      for ($j = 2; $j < count($this->alternatif[$i]); $j++) {
        $jumlah[$j - 2] += pow($this->alternatif[$i][$j], 2);
      }
    }

    for ($i = 0; $i < count($jumlah); $i++) {
      $this->akar_sigma[$i] = round(sqrt($jumlah[$i]), 2);
    }
  }

  public function get_matriks_ternormalisasi()
  {
    $temp_alternatif = $this->alternatif;
    for ($i = 0; $i < count($this->alternatif); $i++) {
      for ($j = 2; $j < count($this->alternatif[$i]); $j++) {
        $temp_alternatif[$i][$j] = round($temp_alternatif[$i][$j] / $this->akar_sigma[$j - 2], 2);
      }
      array_push($this->matriks_ternormalisasi, $temp_alternatif[$i]);
    }
  }

  public function get_nilai_optimalisasi()
  {
    $temp_matriks = $this->matriks_ternormalisasi;
    for ($i = 0; $i < count($temp_matriks); $i++) {
      $benefit = 0;
      $cost = 0;
      for ($j = 2; $j < count($temp_matriks[$i]); $j++) {
        $temp_matriks[$i][$j] *= $this->kriteria[$j - 2][3];
        if ($this->kriteria[$j - 2][2] == 'benefit') {
          $benefit += round($temp_matriks[$i][$j], 2);
        } else {
          $cost += round($temp_matriks[$i][$j], 2);
        }
      }
      $optimalisasi = $benefit - $cost;
      array_push($this->nilai_optimalisasi, array($temp_matriks[$i][0], $temp_matriks[$i][1], $benefit, $cost, $optimalisasi));
    }
  }

  public function get_perangkingan()
  {
    $this->perangkingan = $this->nilai_optimalisasi;
    $keys = array_column($this->perangkingan, 4);
    array_multisort($keys, SORT_DESC, $this->perangkingan);
  }
}
