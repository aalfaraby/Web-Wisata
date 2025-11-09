<?php
$hasil = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nama = $_POST["nama"];
  $telp = $_POST["telp"];
  $waktu = (int)$_POST["waktu"];
  $peserta = (int)$_POST["peserta"];
  $layanan = isset($_POST["layanan"]) ? $_POST["layanan"] : [];
  $hargaPaket = 0;
  $layananList = [];
  foreach ($layanan as $pilih) {
    if ($pilih == "penginapan") {
      $hargaPaket += 1000000;
      $layananList[] = "Penginapan (Rp 1.000.000)";
    } elseif ($pilih == "transportasi") {
      $hargaPaket += 1200000;
      $layananList[] = "Transportasi (Rp 1.200.000)";
    } elseif ($pilih == "makanan") {
      $hargaPaket += 500000;
      $layananList[] = "Makanan (Rp 500.000)";
    }
  }
  $total = $waktu * $peserta * $hargaPaket;
  $hasil = "
  <div class='card mt-4 shadow'>
    <div class='card-header bg-success text-white'>Detail Pemesanan</div>
    <div class='card-body'>
      <p><strong>Nama Pemesan:</strong> $nama</p>
      <p><strong>Nomor HP:</strong> $telp</p>
      <p><strong>Waktu Pelaksanaan:</strong> $waktu hari</p>
      <p><strong>Jumlah Peserta:</strong> $peserta orang</p>
      <p><strong>Pelayanan Paket:</strong><br>" . (empty($layananList) ? "Tidak ada layanan dipilih" : implode("<br>", $layananList)) . "</p>
      <p><strong>Harga Paket:</strong> Rp " . number_format($hargaPaket, 0, ',', '.') . "</p>
      <p><strong>Total Tagihan:</strong> Rp " . number_format($total, 0, ',', '.') . "</p>
    </div>
  </div>";
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Pemesanan Paket Wisata</title>
  <link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <div class="hero-text">
    <img src="foto/foto3.jpg" alt="Header Image" class="img-fluid" style="max-height:150px; width:100%; object-fit:cover;">
    <h1>BEAUTIFUL RAJA AMPAT</h1>
  </div>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <div class="collapse navbar-collapse">
        <div class="navbar-nav">
          <a class="nav-link" href="index.php">BERANDA</a>
          <a class="nav-link" href="#">ABOUT</a>
          <a class="nav-link" href="#">CETAK WISATA</a>
          <a class="nav-link" href="#">FASILITAS WISATA</a>
          <a class="nav-link" href="#">PAKET WISATA</a>
          <a class="nav-link active" href="pemesanan.php">PEMESANAN</a>
          <a class="nav-link" href="#">GALLERY</a>
        </div>
      </div>
    </div>
  </nav>
  <div class="container my-5 p-4">
    <div class="card shadow-lg">
      <div class="card-header bg-dark text-white">
        <h4 class="mb-0">Form Pemesanan Paket Wisata</h4>
      </div>
      <div class="card-body">
        <form method="POST" action="">
          <div class="mb-3 row">
            <label class="col-sm-4 col-form-label">Nama Pemesan</label>
            <div class="col-sm-8">
              <input type="text" name="nama" class="form-control" required>
            </div>
          </div>
          <div class="mb-3 row">
            <label class="col-sm-4 col-form-label">Nomor Telp/HP</label>
            <div class="col-sm-8">
              <input type="tel" name="telp" class="form-control" required>
            </div>
          </div>
          <div class="mb-3 row">
            <label class="col-sm-4 col-form-label">Waktu Pelaksanaan (hari)</label>
            <div class="col-sm-8">
              <input type="number" name="waktu" min="1" class="form-control" required>
            </div>
          </div>
          <div class="mb-3 row">
            <label class="col-sm-4 col-form-label">Jumlah Peserta</label>
            <div class="col-sm-8">
              <input type="number" name="peserta" min="1" class="form-control" required>
            </div>
          </div>
          <div class="mb-3 row">
            <label class="col-sm-4 col-form-label">Pelayanan Paket Perjalanan</label>
            <div class="col-sm-8">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="layanan[]" value="penginapan" id="penginapan">
                <label class="form-check-label" for="penginapan">Penginapan (Rp 1.000.000)</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="layanan[]" value="transportasi" id="transportasi">
                <label class="form-check-label" for="transportasi">Transportasi (Rp 1.200.000)</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="layanan[]" value="makanan" id="makanan">
                <label class="form-check-label" for="makanan">Makanan (Rp 500.000)</label>
              </div>
            </div>
          </div>
          <div class="d-flex justify-content-end gap-2">
            <button type="submit" class="btn btn-primary">Hitung & Simpan</button>
            <a href="index.php" class="btn btn-danger">Batal</a>
          </div>
        </form>
        <?php echo $hasil; ?>
      </div>
    </div>
  </div>
  <script src="bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>