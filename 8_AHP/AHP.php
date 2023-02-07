<?php

class AHP
{
  public $db;
  public $kriteria = array();
  public $nilai_kriteria = array();
  public $alternatif = array();
  public $nilai_alternatif = array();

  public function __construct()
  {
    $this->get_koneksi_db();
    $this->get_kriteria();
    $this->get_nilai_kriteria();
    $this->get_alternatif();
    $this->get_nilai_alternatif();
  }

  public function get_koneksi_db()
  {
    $this->db = new SQLite3('db_ahp_smart.sqlite');
  }

  public function get_kriteria()
  {
    $kriteria = $this->db->query('select * from tb_kriteria');
    while ($row = $kriteria->fetchArray()) {
      array_push($this->kriteria, array(
        $row['kriteria'], $row['c1'], $row['c2'], $row['c3'], $row['c4'], $row['c5'], $row['c6']
      ));
    }
  }

  public function get_nilai_kriteria()
  {
    $kriteria = $this->db->query('select * from tb_kriteria');
    while ($row = $kriteria->fetchArray()) {
      array_push($this->nilai_kriteria, array(
        $row['c1'], $row['c2'], $row['c3'], $row['c4'], $row['c5'], $row['c6']
      ));
    }
  }

  public function get_alternatif()
  {
    $alternatif = $this->db->query('select * from tb_alternatif');
    while ($row = $alternatif->fetchArray()) {
      array_push($this->alternatif, array(
        $row['alternatif'], $row['c1'], $row['c2'], $row['c3'], $row['c4'], $row['c5'], $row['c6']
      ));
    }
  }

  public function get_nilai_alternatif()
  {
    $alternatif = $this->db->query('select * from tb_alternatif');
    while ($row = $alternatif->fetchArray()) {
      array_push($this->nilai_alternatif, array(
        $row['c1'], $row['c2'], $row['c3'], $row['c4'], $row['c5'], $row['c6']
      ));
    }
  }
}
