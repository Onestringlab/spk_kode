<?php
require_once "saw.php";
$saw = new saw();

?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <title>SAW (Simple Additive Weighting)</title>
</head>

<body>
  <div class="container">
    <h1>SAW (Simple Additive Weighting)</h1>
    <hr>

    <!-- kritera bobot dan atribut -->
    <h2>Kriteria, Bobot dan Atribut</h2>
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
        foreach ($saw->kriteria as $k) {
        ?>
          <tr>
            <td><?= $no ?></td>
            <td><?= $k[0] ?></td>
            <td><?= $k[1] ?></td>
            <td><?= $k[2] ?></td>
            <td><?= $k[3] ?></td>
          </tr>
        <?php
          $no++;
        }
        ?>
      </tbody>
    </table>

    <h2>Data Alternatif</h2>
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
        foreach ($saw->alternatif as $a) {
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
        <tr>
          <th colspan="2">Atribut</th>
          <td><?= $saw->atribut[0] ?></td>
          <td><?= $saw->atribut[1] ?></td>
          <td><?= $saw->atribut[2] ?></td>
          <td><?= $saw->atribut[3] ?></td>
          <td><?= $saw->atribut[4] ?></td>
        </tr>
        <tr>
          <th colspan="2">Cmin</th>
          <td><?= $saw->cmin[0] ?></td>
          <td><?= $saw->cmin[1] ?></td>
          <td><?= $saw->cmin[2] ?></td>
          <td><?= $saw->cmin[3] ?></td>
          <td><?= $saw->cmin[4] ?></td>
        </tr>
        <tr>
          <th colspan="2">Cmax</th>
          <td><?= $saw->cmax[0] ?></td>
          <td><?= $saw->cmax[1] ?></td>
          <td><?= $saw->cmax[2] ?></td>
          <td><?= $saw->cmax[3] ?></td>
          <td><?= $saw->cmax[4] ?></td>
        </tr>
      </tbody>
    </table>

    <h2>Data Ternormalisasi</h2>
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
        foreach ($saw->normalisasi as $n) {
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
          <td><?= $saw->bobot[0] ?></td>
          <td><?= $saw->bobot[1] ?></td>
          <td><?= $saw->bobot[2] ?></td>
          <td><?= $saw->bobot[3] ?></td>
          <td><?= $saw->bobot[4] ?></td>
        </tr>
      </tbody>
    </table>

    <h2>Nilai Preferensi</h2>
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
          <th>Total</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        foreach ($saw->preferensi as $p) {
        ?>
          <tr>
            <td><?= $no ?></td>
            <td><?= $p[0] ?></td>
            <td><?= $p[1] ?></td>
            <td><?= $p[2] ?></td>
            <td><?= $p[3] ?></td>
            <td><?= $p[4] ?></td>
            <td><?= $p[5] ?></td>
            <td><?= $p[6] ?></td>
          </tr>
        <?php
          $no++;
        }
        ?>
      </tbody>
    </table>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>