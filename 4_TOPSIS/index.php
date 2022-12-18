<?php
require_once 'topsis.php';
$topsis = new topsis();

?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <title>TOPSIS (Technique For Others Reference by Similarity to Ideal Solution)</title>
</head>

<body>
  <div class="container">
    <h1>TOPSIS (Technique For Others Reference by Similarity to Ideal Solution)</h1>
    <hr>
    <!-- kritera bobot dan atribut -->
    <h2>1. KRITERIA, BOBOT DAN ATRIBUT</h2>
    <table class="table">
      <thead>
        <tr>
          <th>No</th>
          <th>Kode</th>
          <th>Kriteria</th>
          <th>Bobot</th>
          <th>Atribut</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        $total = 0;
        foreach ($topsis->kriteria as $k) {
        ?>
          <tr>
            <td><?= $no ?></td>
            <td>C<?= $no ?></td>
            <td><?= $k[0] ?></td>
            <td><?= $k[1] ?></td>
            <td><?= $k[2] ?></td>
          </tr>
        <?php
          $no++;
        }
        ?>
      </tbody>
    </table>

    <h2>2. DATA ALTERNATIF</h2>
    <table class="table">
      <thead>
        <tr>
          <th>No</th>
          <th>Kode</th>
          <th>C1</th>
          <th>C2</th>
          <th>C3</th>
          <th>C4</th>
          <th>C5</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        foreach ($topsis->alternatif as $a) {
        ?>
          <tr>
            <td><?= $no ?></td>
            <td><?= $a[0] ?></td>
            <td><?= $a[1] ?></td>
            <td><?= $a[2] ?></td>
            <td><?= $a[3] ?></td>
            <td><?= $a[4] ?></td>
            <td><?= $a[5] ?></td>
          </tr>
        <?php
          $no++;
        }
        ?>
      </tbody>
    </table>

    <h2>3. MENGHITUNG MATRIKS KEPUTUSAN TERNORMALISASI</h2>
    <table class="table">
      <thead>
        <tr>
          <th>Kriteria</th>
          <th>C1</th>
          <th>C2</th>
          <th>C3</th>
          <th>C4</th>
          <th>C5</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th>Pembagi</th>
          <th><?= $topsis->pembagi[0] ?></th>
          <th><?= $topsis->pembagi[1] ?></th>
          <th><?= $topsis->pembagi[2] ?></th>
          <th><?= $topsis->pembagi[3] ?></th>
          <th><?= $topsis->pembagi[4] ?></th>
        </tr>
      </tbody>
    </table>
    <table class="table">
      <thead>
        <tr>
          <th>No</th>
          <th>Kode</th>
          <th>C1</th>
          <th>C2</th>
          <th>C3</th>
          <th>C4</th>
          <th>C5</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        foreach ($topsis->normalisasi as $n) {
        ?>
          <tr>
            <td><?= $no ?></td>
            <td><?= $n[0] ?></td>
            <td><?= $n[1] ?></td>
            <td><?= $n[2] ?></td>
            <td><?= $n[3] ?></td>
            <td><?= $n[4] ?></td>
            <td><?= $n[5] ?></td>
          </tr>
        <?php
          $no++;
        }
        ?>
        <tr>
          <th colspan="2">Bobot</th>
          <td><?= $topsis->bobot[0] ?></td>
          <td><?= $topsis->bobot[1] ?></td>
          <td><?= $topsis->bobot[2] ?></td>
          <td><?= $topsis->bobot[3] ?></td>
          <td><?= $topsis->bobot[4] ?></td>
        </tr>
      </tbody>
    </table>

    <h2>4. MENGHITUNG MATRIKS KEPUTUSAN TERNORMALISASI DAN TERBOBOT</h2>
    <table class="table">
      <thead>
        <tr>
          <th>No</th>
          <th>Kode</th>
          <th>C1</th>
          <th>C2</th>
          <th>C3</th>
          <th>C4</th>
          <th>C5</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        foreach ($topsis->normxbobot as $nb) {
        ?>
          <tr>
            <td><?= $no ?></td>
            <td><?= $nb[0] ?></td>
            <td><?= $nb[1] ?></td>
            <td><?= $nb[2] ?></td>
            <td><?= $nb[3] ?></td>
            <td><?= $nb[4] ?></td>
            <td><?= $nb[5] ?></td>
          </tr>
        <?php
          $no++;
        }
        ?>
        <tr>
          <th>*</th>
          <th>Atribut</th>
          <td><?= $topsis->atribut[0] ?></td>
          <td><?= $topsis->atribut[1] ?></td>
          <td><?= $topsis->atribut[2] ?></td>
          <td><?= $topsis->atribut[3] ?></td>
          <td><?= $topsis->atribut[4] ?></td>
        </tr>
      </tbody>
    </table>

    <h2>5. MENCARI NILAI SOLUSI IDEAL POSITIF (MAKS) DAN SOLUSI IDEAL NEGATIF (MIN)</h2>
    <table class="table">
      <tbody>
        <tr>
          <th>Max(y+)</th>
          <td><?= $topsis->ymax[0] ?></td>
          <td><?= $topsis->ymax[1] ?></td>
          <td><?= $topsis->ymax[2] ?></td>
          <td><?= $topsis->ymax[3] ?></td>
          <td><?= $topsis->ymax[4] ?></td>
        </tr>
        <tr>
          <th>Min(y-)</th>
          <td><?= $topsis->ymin[0] ?></td>
          <td><?= $topsis->ymin[1] ?></td>
          <td><?= $topsis->ymin[2] ?></td>
          <td><?= $topsis->ymin[3] ?></td>
          <td><?= $topsis->ymin[4] ?></td>
        </tr>
      </tbody>
    </table>

    <h2>6. MENCARI D+ DAN D- UNTUK SETIAP ALTERNATIF</h2>
    <table class="table">
      <thead>
        <tr>
          <th>No</th>
          <th>Alternatif</th>
          <th>D+</th>
          <th>D-</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        foreach ($topsis->dplusmin as $dpm) {
        ?>
          <tr>
            <td><?= $no ?></td>
            <td><?= $dpm[0] ?></td>
            <td><?= $dpm[6] ?></td>
            <td><?= $dpm[7] ?></td>
          </tr>
        <?php
          $no++;
        }
        ?>
      </tbody>
    </table>

    <h2>7. MENCARI HASIL PREFERENSI</h2>
    <table class="table">
      <thead>
        <tr>
          <th>No</th>
          <th>Alternatif</th>
          <th>Preferensi</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        foreach ($topsis->dplusmin as $dpm) {
          $preferensi = round($dpm[7] / ($dpm[7] + $dpm[6]), 3);
        ?>
          <tr>
            <td><?= $no ?></td>
            <td><?= $dpm[0] ?></td>
            <td><?= $preferensi ?></td>
          </tr>
        <?php
          $no++;
        }
        ?>
      </tbody>
  </div>


  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>