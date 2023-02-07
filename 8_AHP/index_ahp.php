<?php
require_once "AHP.php";
$ahp = new AHP();
?>


<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <title>AHP-SMART</title>
</head>

<body>
  <div class="container">
    <h1>AHP-SMART</h1>
    <hr>
    <h2>1. Data Kriteria</h2>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Kriteria</th>
          <th scope="col">C1</th>
          <th scope="col">C2</th>
          <th scope="col">C3</th>
          <th scope="col">C4</th>
          <th scope="col">C5</th>
          <th scope="col">C6</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        foreach ($ahp->kriteria as $k) {
        ?>
          <tr>
            <td><?= $no++ ?></td>
            <td><?= $k[0] ?></td>
            <td><?= $k[1] ?></td>
            <td><?= $k[2] ?></td>
            <td><?= $k[3] ?></td>
            <td><?= $k[4] ?></td>
            <td><?= $k[5] ?></td>
            <td><?= $k[6] ?></td>
          </tr>
        <?php
        }
        ?>
      </tbody>
    </table>
    <h2>2. Data Alternatif</h2>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Alternatif</th>
          <th scope="col">C1</th>
          <th scope="col">C2</th>
          <th scope="col">C3</th>
          <th scope="col">C4</th>
          <th scope="col">C5</th>
          <th scope="col">C6</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        foreach ($ahp->alternatif as $a) {
        ?>
          <tr>
            <td><?= $no++ ?></td>
            <td><?= $a[0] ?></td>
            <td><?= $a[1] ?></td>
            <td><?= $a[2] ?></td>
            <td><?= $a[3] ?></td>
            <td><?= $a[4] ?></td>
            <td><?= $a[5] ?></td>
            <td><?= $a[6] ?></td>
          </tr>
        <?php
        }
        ?>
      </tbody>
    </table>
  </div>




  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>