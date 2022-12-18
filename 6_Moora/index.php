<?php

require_once "moora.php";
$moora = new moora();

?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <title>MOORA</title>
</head>

<body>
  <div class="container">
    <h1>Multi-Objective Optimization On The Basis Of Ratio Analysis (MOORA)</h1>
    <hr>
    <h2>1. Data Kriteria</h2>
    <table class="table table-striped">
      <thead class="table-primary">
        <tr>
          <th class="text-center">#</th>
          <th class="text-center">Kode</th>
          <th class="text-center">Kriteria</th>
          <th class="text-center">Atribut</th>
          <th class="text-center">Bobot</th>
          <th class="text-center">Satuan</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        foreach ($moora->kriteria as $k) {
        ?>
          <tr>
            <th class="text-center"><?= $no++ ?>.</th>
            <td class="text-center"><?= $k[0] ?></td>
            <td class="text-left"><?= $k[1] ?></td>
            <td class="text-center"><?= $k[2] ?></td>
            <td class="text-center"><?= $k[3] ?></td>
            <td class="text-center"><?= $k[4] ?></td>
          </tr>
        <?php
        }
        ?>
      </tbody>
    </table>

    <h2>2. Data Alternatif</h2>
    <table class="table table-striped">
      <thead class="table-primary">
        <tr>
          <th class="text-center">#</th>
          <th class="text-center">Kode</th>
          <th class="text-center">Alternatif</th>
          <th class="text-center">K1</th>
          <th class="text-center">K2</th>
          <th class="text-center">K3</th>
          <th class="text-center">K4</th>
          <th class="text-center">K5</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        $as = $moora->akar_sigma;
        foreach ($moora->alternatif as $a) {
        ?>
          <tr>
            <th class="text-center"><?= $no++ ?>.</th>
            <td class="text-center"><?= $a[0] ?></td>
            <td class="text-left"><?= $a[1] ?></td>
            <td class="text-center"><?= $a[2] ?></td>
            <td class="text-center"><?= $a[3] ?></td>
            <td class="text-center"><?= $a[4] ?></td>
            <td class="text-center"><?= $a[5] ?></td>
            <td class="text-center"><?= $a[6] ?></td>
          </tr>
        <?php
        }
        ?>
        <tr>
          <th class="text-center"></th>
          <td class="text-center"></td>
          <td class="text-center"></td>
          <td class="text-center"><?= $moora->akar_sigma[0] ?></td>
          <td class="text-center"><?= $as[1] ?></td>
          <td class="text-center"><?= $as[2] ?></td>
          <td class="text-center"><?= $as[3] ?></td>
          <td class="text-center"><?= $as[4] ?></td>
        </tr>
      </tbody>
    </table>

    <h2>3. Data Matriks Ternormalisasi</h2>
    <table class="table table-striped">
      <thead class="table-primary">
        <tr>
          <th class="text-center">#</th>
          <th class="text-center">Kode</th>
          <th class="text-center">Alternatif</th>
          <th class="text-center">K1</th>
          <th class="text-center">K2</th>
          <th class="text-center">K3</th>
          <th class="text-center">K4</th>
          <th class="text-center">K5</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        foreach ($moora->matriks_ternormalisasi as $mt) {
        ?>
          <tr>
            <th class="text-center"><?= $no++ ?>.</th>
            <td class="text-center"><?= $mt[0] ?></td>
            <td class="text-left"><?= $mt[1] ?></td>
            <td class="text-center"><?= $mt[2] ?></td>
            <td class="text-center"><?= $mt[3] ?></td>
            <td class="text-center"><?= $mt[4] ?></td>
            <td class="text-center"><?= $mt[5] ?></td>
            <td class="text-center"><?= $mt[6] ?></td>
          </tr>
        <?php
        }
        ?>
        <tr>
          <th colspan="3">Bobot</th>
          <?php
          foreach ($moora->kriteria as $k) {
          ?>
            <td class="text-center"><?= $k[3] ?></td>
          <?php
          }
          ?>
        </tr>
      </tbody>
    </table>

    <h2>4. Nilai Optimalisasi</h2>
    <table class="table table-striped">
      <thead class="table-primary">
        <tr>
          <th class="text-center">#</th>
          <th class="text-center">Kode</th>
          <th class="text-center">Alternatif</th>
          <th class="text-center">Benefit</th>
          <th class="text-center">Cost</th>
          <th class="text-center">Optimalisasi</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        foreach ($moora->nilai_optimalisasi as $np) {
        ?>
          <tr>
            <th class="text-center"><?= $no++ ?>.</th>
            <td class="text-center"><?= $np[0] ?></td>
            <td class="text-left"><?= $np[1] ?></td>
            <td class="text-center"><?= $np[2] ?></td>
            <td class="text-center"><?= $np[3] ?></td>
            <td class="text-center"><?= $np[4] ?></td>
          </tr>
        <?php
        }
        ?>
      </tbody>
    </table>

    <h2>5. Perangkingan</h2>
    <table class="table table-striped">
      <thead class="table-primary">
        <tr>
          <th class="text-center">Rangking</th>
          <th class="text-center">Kode</th>
          <th class="text-center">Alternatif</th>
          <th class="text-center">Benefit</th>
          <th class="text-center">Cost</th>
          <th class="text-center">Optimalisasi</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        foreach ($moora->perangkingan as $per) {
        ?>
          <tr>
            <th class="text-center"><?= $no++ ?></th>
            <td class="text-center"><?= $per[0] ?></td>
            <td class="text-left"><?= $per[1] ?></td>
            <td class="text-center"><?= $per[2] ?></td>
            <td class="text-center"><?= $per[3] ?></td>
            <td class="text-center"><?= $per[4] ?></td>
          </tr>
        <?php
        }
        ?>
      </tbody>
    </table>
    <br><br>
  </div>

  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>