<?php
require_once "profile_matching.php";
$pm = new profile_matching();
?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <title>Profile Matching Method</title>
</head>

<body>
  <div class="container">
    <h1>Profile Matching Method</h1>
    <hr>
    <h2>Kriteria</h2>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">No</th>
          <th scope="col">Kriteria</th>
          <th scope="col">Bobot</th>
          <th scope="col">Core</th>
          <th scope="col">Secondary</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        foreach ($pm->kriteria as $k) {
        ?>
          <tr>
            <th scope="row"><?= $no ?></th>
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

    <h2>Sub Kriteria</h2>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">No</th>
          <th scope="col">Kriteria</th>
          <th scope="col">Kriteria Ke</th>
          <th scope="col">Sub Kriteria</th>
          <th scope="col">Nilai Target</th>
          <th scope="col">Tipe</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        foreach ($pm->subkriteria as $sk) {
        ?>
          <tr>
            <th scope="row"><?= $no ?></th>
            <td><?= $sk[0] ?></td>
            <td><?= $sk[1] ?></td>
            <td><?= $sk[2] ?></td>
            <td><?= $sk[3] ?></td>
            <td><?= $sk[4] ?></td>
          </tr>
        <?php
          $no++;
        }
        ?>
      </tbody>
    </table>

    <h2>Pembobotan</h2>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">No</th>
          <th scope="col">Keterangan</th>
          <th scope="col">Selisih</th>
          <th scope="col">Bobot Nilai</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        foreach ($pm->pembobotan as $p) {
        ?>
          <tr>
            <th scope="row"><?= $no ?></th>
            <td><?= $p[0] ?></td>
            <td><?= $p[1] ?></td>
            <td><?= $p[2] ?></td>
          </tr>
        <?php
          $no++;
        }
        ?>
      </tbody>
    </table>

    <h2>Alternatif Kecerdasan</h2>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">No</th>
          <th scope="col">Alternatif</th>
          <th scope="col">i1</th>
          <th scope="col">i2</th>
          <th scope="col">i3</th>
          <th scope="col">i4</th>
          <th scope="col">i5</th>
          <th scope="col">i6</th>
          <th scope="col">i7</th>
          <th scope="col">i8</th>
          <th scope="col">i9</th>
          <th scope="col">i10</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        foreach ($pm->alt_kecerdasan as $ak) {
        ?>
          <tr>
            <th scope="row"><?= $no ?></th>
            <td><?= $ak[0] ?></td>
            <td><?= $ak[1] ?></td>
            <td><?= $ak[2] ?></td>
            <td><?= $ak[3] ?></td>
            <td><?= $ak[4] ?></td>
            <td><?= $ak[5] ?></td>
            <td><?= $ak[6] ?></td>
            <td><?= $ak[7] ?></td>
            <td><?= $ak[8] ?></td>
            <td><?= $ak[9] ?></td>
            <td><?= $ak[10] ?></td>
          </tr>
        <?php
          $no++;
        }
        ?>
      </tbody>
    </table>

    <h2>Alternatif Sikap Kerja</h2>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">No</th>
          <th scope="col">Alternatif</th>
          <th scope="col">s1</th>
          <th scope="col">s2</th>
          <th scope="col">s3</th>
          <th scope="col">s4</th>
          <th scope="col">s5</th>
          <th scope="col">s6</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        foreach ($pm->alt_sikap_kerja as $ask) {
        ?>
          <tr>
            <th scope="row"><?= $no ?></th>
            <td><?= $ask[0] ?></td>
            <td><?= $ask[1] ?></td>
            <td><?= $ask[2] ?></td>
            <td><?= $ask[3] ?></td>
            <td><?= $ask[4] ?></td>
            <td><?= $ask[5] ?></td>
            <td><?= $ask[6] ?></td>
          </tr>
        <?php
          $no++;
        }
        ?>
      </tbody>
    </table>

    <h2>Alternatif Perilaku</h2>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">No</th>
          <th scope="col">Alternatif</th>
          <th scope="col">p1</th>
          <th scope="col">p2</th>
          <th scope="col">p3</th>
          <th scope="col">p4</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        foreach ($pm->alt_perilaku as $ap) {
        ?>
          <tr>
            <th scope="row"><?= $no ?></th>
            <td><?= $ap[0] ?></td>
            <td><?= $ap[1] ?></td>
            <td><?= $ap[2] ?></td>
            <td><?= $ap[3] ?></td>
            <td><?= $ap[4] ?></td>
          </tr>
        <?php
          $no++;
        }
        ?>
      </tbody>
    </table>

    <h2>Gap Aspek Kecerdasan</h2>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">No</th>
          <th scope="col">Alternatif</th>
          <th scope="col">i1</th>
          <th scope="col">i2</th>
          <th scope="col">i3</th>
          <th scope="col">i4</th>
          <th scope="col">i5</th>
          <th scope="col">i6</th>
          <th scope="col">i7</th>
          <th scope="col">i8</th>
          <th scope="col">i9</th>
          <th scope="col">i10</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        foreach ($pm->gap_aspek_kecerdasan as $gak) {
        ?>
          <tr>
            <th scope="row"><?= $no ?></th>
            <td><?= $gak[0] ?></td>
            <td><?= $gak[1] ?></td>
            <td><?= $gak[2] ?></td>
            <td><?= $gak[3] ?></td>
            <td><?= $gak[4] ?></td>
            <td><?= $gak[5] ?></td>
            <td><?= $gak[6] ?></td>
            <td><?= $gak[7] ?></td>
            <td><?= $gak[8] ?></td>
            <td><?= $gak[9] ?></td>
            <td><?= $gak[10] ?></td>
          </tr>
        <?php
          $no++;
        }
        ?>
      </tbody>
    </table>

    <h2>Gap Aspek Sikap Kerja</h2>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">No</th>
          <th scope="col">Alternatif</th>
          <th scope="col">s1</th>
          <th scope="col">s2</th>
          <th scope="col">s3</th>
          <th scope="col">s4</th>
          <th scope="col">s5</th>
          <th scope="col">s6</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        foreach ($pm->gap_aspek_sikap_kerja as $gask) {
        ?>
          <tr>
            <th scope="row"><?= $no ?></th>
            <td><?= $gask[0] ?></td>
            <td><?= $gask[1] ?></td>
            <td><?= $gask[2] ?></td>
            <td><?= $gask[3] ?></td>
            <td><?= $gask[4] ?></td>
            <td><?= $gask[5] ?></td>
            <td><?= $gask[6] ?></td>
          </tr>
        <?php
          $no++;
        }
        ?>
      </tbody>
    </table>

    <h2>Gap Aspek Perilaku</h2>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">No</th>
          <th scope="col">Alternatif</th>
          <th scope="col">p1</th>
          <th scope="col">p2</th>
          <th scope="col">p3</th>
          <th scope="col">p4</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        foreach ($pm->gap_aspek_perilaku as $gap) {
        ?>
          <tr>
            <th scope="row"><?= $no ?></th>
            <td><?= $gap[0] ?></td>
            <td><?= $gap[1] ?></td>
            <td><?= $gap[2] ?></td>
            <td><?= $gap[3] ?></td>
            <td><?= $gap[4] ?></td>
          </tr>
        <?php
          $no++;
        }
        ?>
      </tbody>
    </table>

    <h2>Pembobotan Aspek Kecerdasan</h2>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">No</th>
          <th scope="col">Alternatif</th>
          <th scope="col">i1</th>
          <th scope="col">i2</th>
          <th scope="col">i3</th>
          <th scope="col">i4</th>
          <th scope="col">i5</th>
          <th scope="col">i6</th>
          <th scope="col">i7</th>
          <th scope="col">i8</th>
          <th scope="col">i9</th>
          <th scope="col">i10</th>
          <th scope="col">Core</th>
          <th scope="col">Secondary</th>
          <th scope="col">Total</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        foreach ($pm->pembobotan_aspek_kecerdasan as $pak) {
        ?>
          <tr>
            <th scope="row"><?= $no ?></th>
            <td><?= $pak[0] ?></td>
            <td><?= $pak[1] ?></td>
            <td><?= $pak[2] ?></td>
            <td><?= $pak[3] ?></td>
            <td><?= $pak[4] ?></td>
            <td><?= $pak[5] ?></td>
            <td><?= $pak[6] ?></td>
            <td><?= $pak[7] ?></td>
            <td><?= $pak[8] ?></td>
            <td><?= $pak[9] ?></td>
            <td><?= $pak[10] ?></td>
            <td><?= $pak[11] ?></td>
            <td><?= $pak[12] ?></td>
            <td><?= $pak[13] ?></td>
          </tr>
        <?php
          $no++;
        }
        ?>
      </tbody>
    </table>

    <h2>Pembobotan Aspek Sikap Kerja</h2>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">No</th>
          <th scope="col">Alternatif</th>
          <th scope="col">s1</th>
          <th scope="col">s2</th>
          <th scope="col">s3</th>
          <th scope="col">s4</th>
          <th scope="col">s5</th>
          <th scope="col">s6</th>
          <th scope="col">Core</th>
          <th scope="col">Secondary</th>
          <th scope="col">Total</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        foreach ($pm->pembobotan_aspek_sikap_kerja as $pask) {
        ?>
          <tr>
            <th scope="row"><?= $no ?></th>
            <td><?= $pask[0] ?></td>
            <td><?= $pask[1] ?></td>
            <td><?= $pask[2] ?></td>
            <td><?= $pask[3] ?></td>
            <td><?= $pask[4] ?></td>
            <td><?= $pask[5] ?></td>
            <td><?= $pask[6] ?></td>
            <td><?= $pask[7] ?></td>
            <td><?= $pask[8] ?></td>
            <td><?= $pask[9] ?></td>
          </tr>
        <?php
          $no++;
        }
        ?>
      </tbody>
    </table>

    <h2>Pembobotan Aspek Perilaku</h2>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">No</th>
          <th scope="col">Alternatif</th>
          <th scope="col">p1</th>
          <th scope="col">p2</th>
          <th scope="col">p3</th>
          <th scope="col">p4</th>
          <th scope="col">Core</th>
          <th scope="col">Secondary</th>
          <th scope="col">Total</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        foreach ($pm->pembobotan_aspek_perilaku as $pap) {
        ?>
          <tr>
            <th scope="row"><?= $no ?></th>
            <td><?= $pap[0] ?></td>
            <td><?= $pap[1] ?></td>
            <td><?= $pap[2] ?></td>
            <td><?= $pap[3] ?></td>
            <td><?= $pap[4] ?></td>
            <td><?= $pap[5] ?></td>
            <td><?= $pap[6] ?></td>
            <td><?= $pap[7] ?></td>
          </tr>
        <?php
          $no++;
        }
        ?>
      </tbody>
    </table>

    <h2>Perangkingan Alternatif</h2>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Rangking</th>
          <th scope="col">Alternatif</th>
          <th scope="col">Aspek Kecerdasan</th>
          <th scope="col">Aspek Sikap Kerja</th>
          <th scope="col">Aspek Perilaku</th>
          <th scope="col">Total</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        foreach ($pm->perangkingan as $per) {
        ?>
          <tr>
            <th scope="row"><?= $no ?></th>
            <td><?= $per[0] ?></td>
            <td><?= $per[1] ?></td>
            <td><?= $per[2] ?></td>
            <td><?= $per[3] ?></td>
            <td><?= $per[4] ?></td>
          </tr>
        <?php
          $no++;
        }
        ?>
      </tbody>
    </table>

    <br><br>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </div>
</body>

</html>