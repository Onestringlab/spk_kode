<?php

class Topsis
{
    private $alternatif = [];
    private $kriteria = [];
    private $pembagi = [];
    private $normalisasi = [];
    private $bobot = [];
    private $normxbobot = [];
    private $cmin = [];
    private $cmax = [];
    private $atribut = [];
    private $ymax = [];
    private $ymin = [];
    private $dplusmin = [];

    public function __construct()
    {
        $this->loadData();
        $this->processData();
    }

    private function loadData()
    {
        $db = new SQLite3('db_topsis.sqlite');

        // Data kriteria
        $result = $db->query('SELECT * FROM tb_kriteria');
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $this->kriteria[] = [$row['kriteria'], $row['bobot'], $row['atribut']];
        }

        // Data alternatif
        $result = $db->query('SELECT * FROM tb_alternatif');
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $this->alternatif[] = [$row['alternatif'], $row['lokasi'], $row['luas_tanah'], $row['harga'], $row['ukuran'], $row['resiko']];
        }
    }

    private function processData()
    {
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

    private function pembagi()
    {
        $this->pembagi = array_fill(0, count($this->kriteria), 0);
        foreach ($this->alternatif as $a) {
            foreach ($this->kriteria as $i => $k) {
                $this->pembagi[$i] += pow($a[$i + 1], 2);
            }
        }
        $this->pembagi = array_map(function($value) {
            return round(sqrt($value), 3);
        }, $this->pembagi);
    }

    private function normalisasi()
    {
        $this->normalisasi = array_map(function($a) {
            return array_map(function($value, $index) {
                return round($value / $this->pembagi[$index], 3);
            }, array_slice($a, 1), array_keys(array_slice($a, 1)));
        }, $this->alternatif);
    }

    private function bobot()
    {
        $this->bobot = array_column($this->kriteria, 1);
    }

    private function normxbobot()
    {
        $this->normxbobot = array_map(function($n) {
            return array_map(function($value, $index) {
                return $value * $this->bobot[$index];
            }, array_slice($n, 1), array_keys(array_slice($n, 1)));
        }, $this->normalisasi);
    }

    private function cmin()
    {
        $this->cmin = array_fill(0, count($this->kriteria), INF);
        foreach ($this->normxbobot as $nb) {
            foreach ($this->cmin as $i => &$value) {
                if ($value > $nb[$i + 1]) {
                    $value = $nb[$i + 1];
                }
            }
        }
    }

    private function cmax()
    {
        $this->cmax = array_fill(0, count($this->kriteria), -INF);
        foreach ($this->normxbobot as $nb) {
            foreach ($this->cmax as $i => &$value) {
                if ($value < $nb[$i + 1]) {
                    $value = $nb[$i + 1];
                }
            }
        }
    }

    private function atribut()
    {
        $this->atribut = array_column($this->kriteria, 2);
    }

    private function ymaxmin()
    {
        foreach ($this->atribut as $i => $attr) {
            if ($attr == 'Benefit') {
                $this->ymax[] = $this->cmax[$i];
                $this->ymin[] = $this->cmin[$i];
            } else {
                $this->ymax[] = $this->cmin[$i];
                $this->ymin[] = $this->cmax[$i];
            }
        }
    }

    private function dplusmin()
    {
        $this->dplusmin = array_map(function($nb) {
            $dplus = $dmin = 0;
            foreach ($this->ymax as $i => $ymax) {
                $dplus += pow($ymax - $nb[$i + 1], 2);
                $dmin += pow($nb[$i + 1] - $this->ymin[$i], 2);
            }
            return array_merge($nb, [round(sqrt($dplus), 3), round(sqrt($dmin), 3)]);
        }, $this->normxbobot);
    }

    public function getKriteria()
    {
        return $this->kriteria;
    }

    public function getAlternatif()
    {
        return $this->alternatif;
    }

    public function getPembagi()
    {
        return $this->pembagi;
    }
}
