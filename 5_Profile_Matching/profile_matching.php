<?php

class profile_matching
{
  public $db;
  public $kriteria = array();
  public $subkriteria = array();
  public $pembobotan = array();
  public $alt_kecerdasan = array();
  public $alt_sikap_kerja = array();
  public $alt_perilaku = array();
  public $gap_aspek_kecerdasan = array();
  public $gap_aspek_sikap_kerja = array();
  public $gap_aspek_perilaku = array();
  public $dic_nilai_gap = [];
  public $pembobotan_aspek_kecerdasan = array();
  public $pembobotan_aspek_sikap_kerja = array();
  public $pembobotan_aspek_perilaku = array();
  public $perangkingan = array();

  public function __construct()
  {
    $this->koneksi_db();
    $this->get_kriteria();
    $this->get_sub_kriteria();
    $this->get_pembobotan();
    $this->get_alt_kecerdasan();
    $this->get_alt_sikap_kerja();
    $this->get_alt_perilaku();
    $this->gap_aspek_kecerdasan();
    $this->gap_aspek_sikap_kerja();
    $this->gap_aspek_perilaku();
    $this->pembobotan_aspek_kecerdasan();
    $this->pembobotan_aspek_sikap_kerja();
    $this->pembobotan_aspek_perilaku();
    $this->perangkingan();
  }

  public function koneksi_db()
  {
    $this->db = new SQLite3("db_pm.sqlite");
  }

  public function get_kriteria()
  {
    $kriteria = $this->db->query('select * from tb_kriteria');
    while ($row = $kriteria->fetchArray()) {
      array_push($this->kriteria, array($row['kriteria'], $row['bobot'], $row['core'], $row['secondary']));
    }
  }

  public function get_sub_kriteria()
  {
    $sub_kriteria = $this->db->query('select b.kriteria, a.* from tb_subkriteria a join tb_kriteria b on a.id_kriteria = b.id order by id_kriteria asc, sub_kriteria_ke asc');

    while ($row = $sub_kriteria->fetchArray()) {
      array_push($this->subkriteria, array($row['kriteria'], $row['sub_kriteria_ke'], $row['sub_kriteria'], $row['nilai_target'], $row['tipe']));
    }
  }

  public function get_pembobotan()
  {
    $pembobotan = $this->db->query('select * from tb_pembobotan');
    while ($row = $pembobotan->fetchArray()) {
      array_push($this->pembobotan, array($row['keterangan'], $row['selisih'], $row['bobot']));
    }

    $nilai_gap = $this->db->query('select selisih, bobot from tb_pembobotan order by bobot');
    while ($row = $nilai_gap->fetchArray()) {
      $this->dic_nilai_gap[$row['selisih']] = array($row['selisih'], $row['bobot']);
    }
  }

  public function get_alt_kecerdasan()
  {
    $alt_kecerdasan = $this->db->query('select * from tb_alternatif_kecerdasan');
    while ($row = $alt_kecerdasan->fetchArray()) {
      array_push($this->alt_kecerdasan, array($row['alternatif'], $row['i1'], $row['i2'], $row['i3'], $row['i4'], $row['i5'], $row['i6'], $row['i7'], $row['i8'], $row['i9'], $row['i10']));
    }
  }

  public function get_alt_sikap_kerja()
  {
    $alt_sikap_kerja = $this->db->query('select * from tb_alternatif_sikap_kerja');
    while ($row = $alt_sikap_kerja->fetchArray()) {
      array_push($this->alt_sikap_kerja, array($row['alternatif'], $row['s1'], $row['s2'], $row['s3'], $row['s4'], $row['s5'], $row['s6']));
    }
  }

  public function get_alt_perilaku()
  {
    $alt_perilaku = $this->db->query('select * from tb_alternatif_perilaku');
    while ($row = $alt_perilaku->fetchArray()) {
      array_push($this->alt_perilaku, array($row['alternatif'], $row['p1'], $row['p2'], $row['p3'], $row['p4']));
    }
  }

  public function gap_aspek_kecerdasan()
  {
    $target_kecerdasan = $this->db->query('select nilai_target from tb_subkriteria where id_kriteria=1 order by sub_kriteria_ke');

    $target_nilai = array();
    while ($row = $target_kecerdasan->fetchArray()) {
      array_push($target_nilai, $row['nilai_target']);
    }

    $temp_kecerdasan = $this->alt_kecerdasan;
    for ($i = 0; $i < count($temp_kecerdasan); $i++) {
      for ($j = 0; $j < count($target_nilai); $j++) {
        $temp_kecerdasan[$i][$j + 1] -= $target_nilai[$j];
      }
      array_push($this->gap_aspek_kecerdasan, $temp_kecerdasan[$i]);
    }
  }

  public function gap_aspek_sikap_kerja()
  {
    $target_sikap_kerja = $this->db->query('select nilai_target from tb_subkriteria where id_kriteria=2 order by sub_kriteria_ke');

    $target_nilai = array();
    while ($row = $target_sikap_kerja->fetchArray()) {
      array_push($target_nilai, $row['nilai_target']);
    }

    $temp_sikap_kerja = $this->alt_sikap_kerja;
    for ($i = 0; $i < count($temp_sikap_kerja); $i++) {
      for ($j = 0; $j < count($target_nilai); $j++) {
        $temp_sikap_kerja[$i][$j + 1] -= $target_nilai[$j];
      }
      array_push($this->gap_aspek_sikap_kerja, $temp_sikap_kerja[$i]);
    }
  }

  public function gap_aspek_perilaku()
  {
    $target_perilaku = $this->db->query('select nilai_target from tb_subkriteria where id_kriteria=3 order by sub_kriteria_ke');

    $target_nilai = array();
    while ($row = $target_perilaku->fetchArray()) {
      array_push($target_nilai, $row['nilai_target']);
    }

    $temp_perilaku = $this->alt_perilaku;
    for ($i = 0; $i < count($temp_perilaku); $i++) {
      for ($j = 0; $j < count($target_nilai); $j++) {
        $temp_perilaku[$i][$j + 1] -= $target_nilai[$j];
      }
      array_push($this->gap_aspek_perilaku, $temp_perilaku[$i]);
    }
  }

  public function pembobotan_aspek_kecerdasan()
  {
    $dic = $this->dic_nilai_gap;
    $temp_pembobotan_kecerdasan = $this->gap_aspek_kecerdasan;
    for ($i = 0; $i < count($temp_pembobotan_kecerdasan); $i++) {
      $total_core = 0;
      $jum_core = 0;
      $total_secondary = 0;
      $jum_secondary = 0;
      for ($j = 0; $j < count($temp_pembobotan_kecerdasan[$i]) - 1; $j++) {
        $temp_pembobotan_kecerdasan[$i][$j + 1] = $dic[$temp_pembobotan_kecerdasan[$i][$j + 1]][1];

        $tipe = $this->subkriteria[$j][4];
        if ($tipe == "Core Factor") {
          $total_core += $temp_pembobotan_kecerdasan[$i][$j + 1];
          $jum_core++;
        } else {
          $total_secondary += $temp_pembobotan_kecerdasan[$i][$j + 1];
          $jum_secondary++;
        }
      }
      $temp_pembobotan_kecerdasan[$i][11] = round($total_core / $jum_core, 2);
      $temp_pembobotan_kecerdasan[$i][12] = round($total_secondary / $jum_secondary, 2);

      $total_pembobotan_kecerdasan = ($temp_pembobotan_kecerdasan[$i][11] * $this->kriteria[0][2]) + ($temp_pembobotan_kecerdasan[$i][12] * $this->kriteria[0][3]);

      $temp_pembobotan_kecerdasan[$i][13] = round($total_pembobotan_kecerdasan, 2);
      array_push($this->pembobotan_aspek_kecerdasan, $temp_pembobotan_kecerdasan[$i]);
    }
  }

  public function pembobotan_aspek_sikap_kerja()
  {
    $dic = $this->dic_nilai_gap;
    $temp_pembobotan_sikap_kerja = $this->gap_aspek_sikap_kerja;
    for ($i = 0; $i < count($temp_pembobotan_sikap_kerja); $i++) {
      $total_core = 0;
      $jum_core = 0;
      $total_secondary = 0;
      $jum_secondary = 0;
      for ($j = 0; $j < count($temp_pembobotan_sikap_kerja[$i]) - 1; $j++) {
        $temp_pembobotan_sikap_kerja[$i][$j + 1] = $dic[$temp_pembobotan_sikap_kerja[$i][$j + 1]][1];

        $tipe = $this->subkriteria[$j + 10][4];
        if ($tipe == "Core Factor") {
          $total_core += $temp_pembobotan_sikap_kerja[$i][$j + 1];
          $jum_core++;
        } else {
          $total_secondary += $temp_pembobotan_sikap_kerja[$i][$j + 1];
          $jum_secondary++;
        }
      }
      $temp_pembobotan_sikap_kerja[$i][7] = round($total_core / $jum_core, 2);
      $temp_pembobotan_sikap_kerja[$i][8] = round($total_secondary / $jum_secondary, 2);

      $total_pembobotan_sikap_kerja = ($temp_pembobotan_sikap_kerja[$i][7] * $this->kriteria[1][2]) + ($temp_pembobotan_sikap_kerja[$i][8] * $this->kriteria[1][3]);

      $temp_pembobotan_sikap_kerja[$i][9] = round($total_pembobotan_sikap_kerja, 2);
      array_push($this->pembobotan_aspek_sikap_kerja, $temp_pembobotan_sikap_kerja[$i]);
    }
  }

  public function pembobotan_aspek_perilaku()
  {
    $dic = $this->dic_nilai_gap;
    $temp_pembobotan_perilaku = $this->gap_aspek_perilaku;
    for ($i = 0; $i < count($temp_pembobotan_perilaku); $i++) {
      $total_core = 0;
      $jum_core = 0;
      $total_secondary = 0;
      $jum_secondary = 0;
      for ($j = 0; $j < count($temp_pembobotan_perilaku[$i]) - 1; $j++) {
        $temp_pembobotan_perilaku[$i][$j + 1] = $dic[$temp_pembobotan_perilaku[$i][$j + 1]][1];

        $tipe = $this->subkriteria[$j + 16][4];
        if ($tipe == "Core Factor") {
          $total_core += $temp_pembobotan_perilaku[$i][$j + 1];
          $jum_core++;
        } else {
          $total_secondary += $temp_pembobotan_perilaku[$i][$j + 1];
          $jum_secondary++;
        }
      }
      $temp_pembobotan_perilaku[$i][5] = round($total_core / $jum_core, 2);
      $temp_pembobotan_perilaku[$i][6] = round($total_secondary / $jum_secondary, 2);

      $total_pembobotan_perilaku = ($temp_pembobotan_perilaku[$i][5] * $this->kriteria[2][2]) + ($temp_pembobotan_perilaku[$i][6] * $this->kriteria[2][3]);

      $temp_pembobotan_perilaku[$i][7] = round($total_pembobotan_perilaku, 2);
      array_push($this->pembobotan_aspek_perilaku, $temp_pembobotan_perilaku[$i]);
    }
  }

  public function perangkingan()
  {
    for ($i = 0; $i < count($this->alt_kecerdasan); $i++) {
      $alternatif = $this->alt_kecerdasan[$i][0];
      $total_kecerdasan = $this->pembobotan_aspek_kecerdasan[$i][13];
      $total_sikap_kerja = $this->pembobotan_aspek_sikap_kerja[$i][9];
      $total_perilaku = $this->pembobotan_aspek_perilaku[$i][7];
      $nilai_total = round(($total_kecerdasan * $this->kriteria[0][1]) + ($total_sikap_kerja * $this->kriteria[1][1]) + ($total_perilaku * $this->kriteria[2][1]), 2);

      array_push($this->perangkingan, array($alternatif, $total_kecerdasan, $total_sikap_kerja, $total_perilaku, $nilai_total));

      $keys = array_column($this->perangkingan, 4);
      array_multisort($keys, SORT_DESC, $this->perangkingan);
    }
  }
}
