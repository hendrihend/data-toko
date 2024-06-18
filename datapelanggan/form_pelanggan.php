<?php 
require 'functions.php'; //koneksi
//cek tombol
if (isset($_POST["simpan"])) {
	//cek data berhasil ditambahkan atau tidak
	if (tambah($_POST) > 0) {
		echo "<script>
				alert('Data Pelanggan berhasil ditambahkan!');
				document.location.href = 'index.php';
			</script>";
	} else {
		echo "<script>
				alert('Data Pelanggan gagal ditambaakan!');
				document.location.href = 'index.php';
			</script>";
	}
}


?>



<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../css/materialize.min.css">
	<title>Halaman Form Pelanggan</title>
</head>
<body>
	<div class="container">
		<div class="row">
			<h5>Masukan Data Pelanggan</h5>
			<form action="" method="post" enctype="multipart/form-data" class="col s12">
				<div class="row">
					<div class="input-field col s12">
						<input type="text" required="" name="nama_pelanggan" id="nama_pelanggan">
						<label for="nama_pelanggan">Nama Pelanggan</label>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s12">
						<input type="text" required="" name="total_belanja" id="total_belanja">
						<label for="total_belanja">Total Belanja</label>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s12">
						<input type="date" name="tanggal" id="tanggal">
						<label for="tanggal">Tanggal</label>
					</div>
				</div>
				<!-- hidden -->
				<input type="hidden" name="waktu" id="waktu">
				<!-- hidden -->
				<div class="row">
				<div class="input-field col s12">
					<select name="status" id="status" class="browser-default">
						<option value="" disabled selected="">Pilih Status</option>
						<option value="hutang">hutang</option>
						<option value="bayar">bayar</option>
					</select>
				</div>
				</div>
				<button type="submit" name="simpan" class="waves-effect waves-light btn-small">Simpan</button>
				<button type="reset" name="reset" class="waves-effect waves-light red btn-small">Reset</button>
				<a href="index.php" class="waves-effect waves-light btn-small transparent black-text">Kembali</a>
			</form>
		</div>
	</div>
<script src="../js/materialize.min.js"></script>

</body>
</html>