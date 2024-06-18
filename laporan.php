<?php include 'header.php';
include 'koneksi.php'; ?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Cetak Data Laporan</h6>
    </div>
    <div class="card-body">
        <form action="cetak_laporan.php" method="get" target="_blank" onsubmit="return validateForm()">
            <input type="date" name="awal" class="form-control mb-2" required>
            <input type="date" name="akhir" class="form-control mb-2" required>
            <button type="submit" class="btn btn-primary" name="cetak">Cetak</button>
        </form>
    </div>
</div>

<?php include 'footer.php'; ?>

<script>
    function validateForm() {
        var awalDate = new Date(document.forms[0]["awal"].value);
        var akhirDate = new Date(document.forms[0]["akhir"].value);

        // Validasi 1: Harap isi bidang
        if (document.forms[0]["awal"].value === "" || document.forms[0]["akhir"].value === "") {
            alert("Harap isi semua bidang");
            return false;
        }

        return true;
    }
</script>