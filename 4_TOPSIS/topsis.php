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
        foreach ($this->alternatif as $a) {
            for ($i = 0; $i < count($this->pembagi); $i++) {
                $a[$i + 1] = $a[$i + 1] / $this->pembagi[$i];
                $a[$i + 1] = round($a[$i + 1], 3);
            }
            array_push($this->normalisasi, $a);
        }
    }

    private function bobot()
    {
        $this->bobot = array_column($this->kriteria, 1);
    }

    private function normxbobot()
    {
        $this->normxbobot = array();
        foreach ($this->normalisasi as $n) {
            for ($i = 0; $i < count($this->bobot); $i++) {
                $n[$i + 1] = $n[$i + 1] * $this->bobot[$i];
            }
            array_push($this->normxbobot, $n);
        }
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
        foreach ($this->normxbobot as $nb) {
            $dplus  = 0;
            $dmin   =  0;
            for ($i = 0; $i < count($this->ymax); $i++) {
                $dplus += pow($this->ymax[$i] - $nb[$i + 1], 2);
                $dmin += pow($nb[$i + 1] - $this->ymin[$i], 2);
            }
            $nb[6] = round(sqrt($dplus), 3);
            $nb[7] = round(sqrt($dmin), 3);
            array_push($this->dplusmin, $nb);
        }
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

    public function getNormalisasi()
    {
        return $this->normalisasi;
    }

    public function getBobot()
    {
        return $this->bobot;
    }

    public function getNormxbobot()
    {
        return $this->normxbobot;
    }

    public function getAtribut()
    {
        return $this->atribut;
    }

    public function getYmax()
    {
        return $this->ymax;
    }

    public function getYmin()
    {
        return $this->ymin;
    }

    public function getDplusmin()
    {
        return $this->dplusmin;
    }
}
