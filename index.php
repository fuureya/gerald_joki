<?php include 'header.php';
include 'koneksi.php';
$query = "SELECT * FROM pembayaran_212279 WHERE 212279_ket = 'LUNAS'";
$query2 = "SELECT * FROM pembayaran_212279 WHERE 212279_ket = 'LUNAS' and 212279_denda > 0";
$exec = mysqli_query($conn, $query);
$totalspp = mysqli_num_rows($exec);
$totaldenda = mysqli_num_rows(mysqli_query($conn, $query2));
$totaltrx = 0;
$totaluangdenda = 0;
while ($res = mysqli_fetch_assoc($exec)) {
    $totaltrx += $res['212279_jumlah'];
    $totaluangdenda += $res['212279_denda'];
}
?>
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    <button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm print-button" onclick="printchart()"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
</div>

<!-- Content Row -->
<div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2" style="background-color: #f0ffff;">
            <div class="card-body">
                <div class=" row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Transaksi SPP</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $totalspp ?>&nbsp;&nbsp;Transaksi</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-dark-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2" style="background-color: #f0ffff;">
            <div class=" card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1 ">
                            Total Pembayaran SPP</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">Rp.<?= number_format($totaltrx) ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-dark-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2" style="background-color: #f0ffff;">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Transaksi Denda</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $totaldenda ?>&nbsp;&nbsp;Transaksi</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-dark-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2" style="background-color: #f0ffff;">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1 ">
                            Total Uang Denda</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">Rp.<?= number_format($totaluangdenda) ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-dark-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="row">

    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4" id="ciko">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between" style="background-color: #f0ffff;">
                <h6 class="m-0 font-weight-bold text-primary">Grafik Pembayaran SPP Sekolah</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-area">
                    <canvas id="chartTahunan"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Content Row -->
<?php include 'footer.php'; ?>