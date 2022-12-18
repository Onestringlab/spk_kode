<?php
require_once "vikor.php";
$vikor = new vikor();
?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <title>VIKOR</title>
</head>

<body>
  <div class="container">
    <h1>VIšekriterijumsko KOmpromisno Rangiranje (VIKOR)</h1>
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
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        foreach ($vikor->kriteria as $k) {
        ?>
          <tr>
            <th class="text-center"><?= $no++ ?>.</th>
            <td class="text-center"><?= $k[0] ?></td>
            <td class="text-left"><?= $k[1] ?></td>
            <td class="text-center"><?= $k[2] ?></td>
            <td class="text-center"><?= $k[3] ?></td>
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
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        foreach ($vikor->alternatif as $a) {
        ?>
          <tr>
            <th class="text-center"><?= $no++ ?>.</th>
            <td class="text-center"><?= $a[0] ?></td>
            <td class="text-left"><?= $a[1] ?></td>
            <td class="text-center"><?= $a[2] ?></td>
            <td class="text-center"><?= $a[3] ?></td>
            <td class="text-center"><?= $a[4] ?></td>
            <td class="text-center"><?= $a[5] ?></td>
          </tr>
        <?php
        }
        ?>
        <tr>
          <th></th>
          <td></td>
          <th class="text-left">Bobot</th>
          <td class="text-center"><?= $vikor->bobot[0] ?></td>
          <td class="text-center"><?= $vikor->bobot[1] ?></td>
          <td class="text-center"><?= $vikor->bobot[2] ?></td>
          <td class="text-center"><?= $vikor->bobot[3] ?></td>
        </tr>
        <tr>
          <th></th>
          <td></td>
          <th class="text-left">Atribut</th>
          <td class="text-center"><?= $vikor->atribut[0] ?></td>
          <td class="text-center"><?= $vikor->atribut[1] ?></td>
          <td class="text-center"><?= $vikor->atribut[2] ?></td>
          <td class="text-center"><?= $vikor->atribut[3] ?></td>
        </tr>
        <tr>
          <th></th>
          <td></td>
          <th class="text-left">f+</th>
          <td class="text-center"><?= $vikor->fplus[0] ?></td>
          <td class="text-center"><?= $vikor->fplus[1] ?></td>
          <td class="text-center"><?= $vikor->fplus[2] ?></td>
          <td class="text-center"><?= $vikor->fplus[3] ?></td>
        </tr>
        <tr>
          <th></th>
          <td></td>
          <th class="text-left">f-</th>
          <td class="text-center"><?= $vikor->fmin[0] ?></td>
          <td class="text-center"><?= $vikor->fmin[1] ?></td>
          <td class="text-center"><?= $vikor->fmin[2] ?></td>
          <td class="text-center"><?= $vikor->fmin[3] ?></td>
        </tr>
      </tbody>
    </table>

    <h2>3. Matriks Normalisasi</h2>
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
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        foreach ($vikor->matriks_normalisasi as $mn) {
        ?>
          <tr>
            <th class="text-center"><?= $no++ ?>.</th>
            <td class="text-center"><?= $mn[0] ?></td>
            <td class="text-left"><?= $mn[1] ?></td>
            <td class="text-center"><?= $mn[2] ?></td>
            <td class="text-center"><?= $mn[3] ?></td>
            <td class="text-center"><?= $mn[4] ?></td>
            <td class="text-center"><?= $mn[5] ?></td>
          </tr>
        <?php
        }
        ?>
      </tbody>
    </table>

    <h2>4. Matriks Normalisasi Terbobot, Si, Ri, S+, R+, S- dan R-</h2>
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
          <th class="text-center">Si</th>
          <th class="text-center">Ri</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        foreach ($vikor->matriks_normalisasi_bobot as $mnb) {
        ?>
          <tr>
            <th class="text-center"><?= $no++ ?>.</th>
            <td class="text-center"><?= $mnb[0] ?></td>
            <td class="text-left"><?= $mnb[1] ?></td>
            <td class="text-center"><?= $mnb[2] ?></td>
            <td class="text-center"><?= $mnb[3] ?></td>
            <td class="text-center"><?= $mnb[4] ?></td>
            <td class="text-center"><?= $mnb[5] ?></td>
            <td class="text-center"><?= $mnb[6] ?></td>
            <td class="text-center"><?= $mnb[7] ?></td>
          </tr>
        <?php
        }
        ?>
        <tr>
          <th class="text-center"></th>
          <th class="text-center"></th>
          <th class="text-center"></th>
          <th class="text-center"></th>
          <th class="text-center"></th>
          <th class="text-center"></th>
          <th class="text-center">S+ dan R+</th>
          <td class="text-center"><?= $vikor->Splus ?></td>
          <td class="text-center"><?= $vikor->Rplus ?></td>
        </tr>
        <tr>
          <th class="text-center"></th>
          <th class="text-center"></th>
          <th class="text-center"></th>
          <th class="text-center"></th>
          <th class="text-center"></th>
          <th class="text-center"></th>
          <th class="text-center">S- dan R-</th>
          <td class="text-center"><?= $vikor->Smin ?></td>
          <td class="text-center"><?= $vikor->Rmin ?></td>
        </tr>
      </tbody>
    </table>

    <h2>5. Nilai VIKOR</h2>
    <table class="table table-striped">
      <thead class="table-primary">
        <tr>
          <th class="text-center">#</th>
          <th class="text-center">Kode</th>
          <th class="text-center">Alternatif</th>
          <th class="text-center">Q(v=0.50)</th>
          <th class="text-center">Q(v=0.45)</th>
          <th class="text-center">Q(v=0.55)</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        foreach ($vikor->nilai_vikor as $nv) {
        ?>
          <tr>
            <th class="text-center"><?= $no++ ?>.</th>
            <td class="text-center"><?= $nv[0] ?></td>
            <td class="text-left"><?= $nv[1] ?></td>
            <td class="text-center"><?= $nv[2] ?></td>
            <td class="text-center"><?= $nv[3] ?></td>
            <td class="text-center"><?= $nv[4] ?></td>
          </tr>
        <?php
        }
        ?>
      </tbody>
    </table>

    <h2>6. Nilai Perangkingan</h2>
    <table class="table table-striped">
      <thead class="table-primary">
        <tr>
          <th class="text-center">Ranking</th>
          <th class="text-center">Kode</th>
          <th class="text-center">Alternatif</th>
          <th class="text-center">Q(v=0.50)</th>
          <th class="text-center">Q(v=0.45)</th>
          <th class="text-center">Q(v=0.55)</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        foreach ($vikor->perangkingan as $per) {
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
    <h2>7. Acceptable Advantage</h2>
    <table class="table table-striped">
      <thead class="table-primary">
        <tr>
          <th class="text-center">QA2 - QA1</th>
          <th class="text-center">DQ</th>
          <th class="text-center">Acceptable</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="text-center"><?= $vikor->Qx ?></td>
          <td class="text-center"><?= $vikor->QD ?></td>
          <td class="text-center"><?= $vikor->accepptable ?></td>
        </tr>
      </tbody>
    </table>
  </div>
  <br><br>

  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>