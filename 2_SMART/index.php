<?php
require_once "smart.php";
$smart = new smart();
?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <title>SMART</title>
</head>

<body>
  <div class="container">
    <h1>SMART (Simple Multi Attribute Rating Technique)</h1>
    <hr>

    <!-- kritera dan bobot -->
    <h2>Kriteria dan Bobot</h2>
    <table class="table">
      <thead>
        <tr>
          <th>No</th>
          <th>Kode</th>
          <th>Kriteria</th>
          <th>Bobot</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        $total = 0;
        foreach ($smart->kriteria as $k) {
        ?>
          <tr>
            <td><?= $no ?></td>
            <td><?= $k[0] ?></td>
            <td><?= $k[1] ?></td>
            <td><?= $k[2] ?></td>
          </tr>
        <?php
          $total += $k[2];
          $no++;
        }
        ?>
        <tr>
          <td colspan="3">Total</td>
          <td><?= $total ?></td>
        <tr>
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
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        foreach ($smart->alternatif as $a) {
        ?>
          <tr>
            <td><?= $no ?></td>
            <td><?= $a[0] ?></td>
            <td><?= $a[1] ?></td>
            <td><?= $a[2] ?></td>
            <td><?= $a[3] ?></td>
            <td><?= $a[4] ?></td>
          </tr>
        <?php
          $no++;
        }
        ?>
        <tr>
          <td colspan="2">Cmin</td>
          <td><?= $smart->cmin[0] ?></td>
          <td><?= $smart->cmin[1] ?></td>
          <td><?= $smart->cmin[2] ?></td>
          <td><?= $smart->cmin[3] ?></td>
        </tr>
        <tr>
          <td colspan="2">Cmax</td>
          <td><?= $smart->cmax[0] ?></td>
          <td><?= $smart->cmax[1] ?></td>
          <td><?= $smart->cmax[2] ?></td>
          <td><?= $smart->cmax[3] ?></td>
        </tr>
      </tbody>
    </table>

    <h2>Kriteria dan Bobot Ternormalisasi</h2>
    <table class="table">
      <thead>
        <tr>
          <th>No</th>
          <th>Kode</th>
          <th>Kriteria</th>
          <th>Bobot</th>
          <th>Normalisasi</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        foreach ($smart->normalisasi_bobot as $nb) {
        ?>
          <tr>
            <td><?= $no ?></td>
            <td><?= $nb[0] ?></td>
            <td><?= $nb[1] ?></td>
            <td><?= $nb[2] ?></td>
            <td><?= $nb[3] ?></td>
          </tr>
        <?php
          $no++;
        }
        ?>
      </tbody>
    </table>

    <h2>Nilai Utilitas</h2>
    <table class="table">
      <thead>
        <tr>
          <th>No</th>
          <th>Kode</th>
          <th>C1</th>
          <th>C2</th>
          <th>C3</th>
          <th>C4</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        foreach ($smart->nilai_utilitas as $nu) {
        ?>
          <tr>
            <td><?= $no ?></td>
            <td><?= $nu[0] ?></td>
            <td><?= $nu[1] ?></td>
            <td><?= $nu[2] ?></td>
            <td><?= $nu[3] ?></td>
            <td><?= $nu[4] ?></td>
          </tr>
        <?php
          $no++;
        }
        ?>
      </tbody>
    </table>

    <h2>Nilai Akhir</h2>
    <table class="table">
      <thead>
        <tr>
          <th>No</th>
          <th>Kode</th>
          <th>C1</th>
          <th>C2</th>
          <th>C3</th>
          <th>C4</th>
          <th>Total</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        foreach ($smart->nilai_akhir as $na) {
        ?>
          <tr>
            <td><?= $no ?></td>
            <td><?= $na[0] ?></td>
            <td><?= $na[1] ?></td>
            <td><?= $na[2] ?></td>
            <td><?= $na[3] ?></td>
            <td><?= $na[4] ?></td>
            <td><?= $na[5] ?></td>
          </tr>
        <?php
          $no++;
        }
        ?>
      </tbody>
    </table>

  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>