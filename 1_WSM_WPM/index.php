<?php

require_once "wsm_wpm.php";
$wsm_wpm = new wsm_wpm();

?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <title>Weighted Sum Model dan Weighted Product Model</title>
</head>

<body>
  <div class=container>
    <h1>Weighted Sum Model dan Weighted Product Model</h1>
    <hr>
    <h2>Kriteria</h2>
    <table class="table">
      <thead>
        <tr>
          <th>Kode</th>
          <th>Kriteria</th>
          <th>Bobot</th>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($wsm_wpm->kriteria as $k) {
        ?>
          <tr>
            <td><?= $k[0] ?></td>
            <td><?= $k[1] ?></td>
            <td><?= $k[2] ?></td>
          </tr>
        <?php
        }
        ?>
      </tbody>
    </table>

    <h2>Alternatif</h2>
    <table class="table">
      <thead>
        <tr>
          <th>Alternatif</th>
          <th>Kode</th>
          <th>C01</th>
          <th>C02</th>
          <th>C03</th>
          <th>C04</th>
          <th>C05</th>
          <th>C06</th>
          <th>C07</th>
          <th>C08</th>
          <th>C09</th>
          <th>C10</th>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($wsm_wpm->alternatif as $a) {
        ?>
          <tr>
            <td><?= $a[0] ?></td>
            <td><?= $a[1] ?></td>
            <td><?= $a[2] ?></td>
            <td><?= $a[3] ?></td>
            <td><?= $a[4] ?></td>
            <td><?= $a[5] ?></td>
            <td><?= $a[6] ?></td>
            <td><?= $a[7] ?></td>
            <td><?= $a[8] ?></td>
            <td><?= $a[9] ?></td>
            <td><?= $a[10] ?></td>
            <td><?= $a[11] ?></td>
          </tr>
        <?php
        }
        ?>
        <tr>
          <th colspan=2>Bobot</th>
          <td><?= $wsm_wpm->bobot[0] ?></td>
          <td><?= $wsm_wpm->bobot[1] ?></td>
          <td><?= $wsm_wpm->bobot[2] ?></td>
          <td><?= $wsm_wpm->bobot[3] ?></td>
          <td><?= $wsm_wpm->bobot[4] ?></td>
          <td><?= $wsm_wpm->bobot[5] ?></td>
          <td><?= $wsm_wpm->bobot[6] ?></td>
          <td><?= $wsm_wpm->bobot[7] ?></td>
          <td><?= $wsm_wpm->bobot[8] ?></td>
          <td><?= $wsm_wpm->bobot[9] ?></td>
        </tr>
      </tbody>
    </table>

    <h2>Weighted Sum Model</h2>
    <table class="table">
      <thead>
        <tr>
          <th>Alternatif</th>
          <th>Kode</th>
          <th>C01</th>
          <th>C02</th>
          <th>C03</th>
          <th>C04</th>
          <th>C05</th>
          <th>C06</th>
          <th>C07</th>
          <th>C08</th>
          <th>C09</th>
          <th>C10</th>
          <th>Total</th>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($wsm_wpm->wsm as $a) {
        ?>
          <tr>
            <td><?= $a[0] ?></td>
            <td><?= $a[1] ?></td>
            <td><?= $a[2] ?></td>
            <td><?= $a[3] ?></td>
            <td><?= $a[4] ?></td>
            <td><?= $a[5] ?></td>
            <td><?= $a[6] ?></td>
            <td><?= $a[7] ?></td>
            <td><?= $a[8] ?></td>
            <td><?= $a[9] ?></td>
            <td><?= $a[10] ?></td>
            <td><?= $a[11] ?></td>
            <td><?= $a[12] ?></td>
          </tr>
        <?php
        }
        ?>
      </tbody>
    </table>

    <h2>Weighted Product Model</h2>
    <table class="table">
      <thead>
        <tr>
          <th>Alternatif</th>
          <th>Kode</th>
          <th>C01</th>
          <th>C02</th>
          <th>C03</th>
          <th>C04</th>
          <th>C05</th>
          <th>C06</th>
          <th>C07</th>
          <th>C08</th>
          <th>C09</th>
          <th>C10</th>
          <th>Total</th>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($wsm_wpm->wpm as $a) {
        ?>
          <tr>
            <td><?= $a[0] ?></td>
            <td><?= $a[1] ?></td>
            <td><?= $a[2] ?></td>
            <td><?= $a[3] ?></td>
            <td><?= $a[4] ?></td>
            <td><?= $a[5] ?></td>
            <td><?= $a[6] ?></td>
            <td><?= $a[7] ?></td>
            <td><?= $a[8] ?></td>
            <td><?= $a[9] ?></td>
            <td><?= $a[10] ?></td>
            <td><?= $a[11] ?></td>
            <td><?= $a[12] ?></td>
          </tr>
        <?php
        }
        ?>
      </tbody>
    </table>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>