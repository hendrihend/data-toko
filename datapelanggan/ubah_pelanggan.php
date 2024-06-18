<?php 
require 'functions.php'; //koneksi ke database
//ambil data pelanggan di url berdasarkan id_pelanggan
$id_pelanggan = $_GET["id_pelanggan"];
//query data pelanggan
$data = query("SELECT * FROM t_pelanggan WHERE id_pelanggan = $id_pelanggan")[0];

//cek tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {
	//cek data pelanggan sudah berhasil diubah atau belum
	if (ubah($_POST) > 0 ) {
		echo "<script>
				alert('Data berhasil diubah!');
				document.location.href = 'index.php';
			</script>";
	}else {
		echo "<script>
				alert('Data gagal diubah!');
				document.location.href = 'index.php';
			</script>";
	}
}
if (isset($_POST["kembali"])) {
	header("Location: index.php");
}

?>




<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../css/materialize.min.css">
	<title>Halaman Ubah Data Pelanggan</title>
</head>
<body>
	<div class="container">
		<div class="row">
			<h5>Ubah Data Pelanggan</h5><hr>
			<form action="" method="POST" enctype="multipart/form-data" class="col s12">
					<input type="hidden" name="id_pelanggan" value="<?= $data["id_pelanggan"]; ?>">
					<div class="row">
						<div class="input-field col s12">
							<input type="text" name="nama_pelanggan" id="nama_pelanggan" value="<?= $data["nama_pelanggan"]; ?>">
							<label for="nama_pelanggan">Nama Pelanggan</label>
						</div>
					</div>
					<div class="row">
						<div class="input-field col s12">
							<input type="text" name="total_belanja" id="total_belanja" value="<?= $data["total_belanja"]; ?>">
							<label for="total_belanja">Total Belanja</label>
						</div>
					</div>
					<div class="row">
						<div class="input-field col s12">
							<input type="date" name="tanggal" id="tanggal" value="<?= $data["tanggal"]; ?>">
							<label for="tanggal">Tanggal</label>
						</div>
					</div>
					<div class="row">
						<div class="input-field col s12">
							<input type="time" name="waktu" id="waktu" value="<?= $data["waktu"]; ?>">
							<label for="waktu">Waktu</label>
						</div>
					</div>
					<div class="row">
						<div class="input-field col s12">
							<select name="status" id="status" value="<?= $data["status"]; ?>" class="browser-default">
								<option value="" disabled selected="">Pilih Status</option>
								<option value="hutang">hutang</option>
								<option value="bayar">bayar</option>
							</select>
						</div>
					</div>
					<button type="submit" name="submit" class="waves-effect waves-light btn-small">Ubah</button>
					<button type="reset" name="reset" class="waves-effect waves-light red btn-small">Reset</button>
					<button type="submit" name="kembali" class="waves-effect waves-light btn-small transparent black-text">Kembali</button>
			</form>
		</div>
	</div>
	<script src="../js/materialize.min.js"></script>
</body>
</html>