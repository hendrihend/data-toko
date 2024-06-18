<?php 
require ("functions.php");
$brg = query("SELECT * FROM t_barang");
// tombol cari ditekan
if (isset($_POST["cari"]) ){
	$brg = cari($_POST["keyword"]);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Halaman Data Barang</title>
	<link rel="stylesheet" href="css/style.css">
	<!-- <link rel="stylesheet" href="css/materialize.min.css"> -->
</head>
<body>
	<nav>
	    <div class="nav">
	      <h1 href="#" class="brand-logo right">Toko Mimi Hana Tio Cilegeh</h1>
	      <ul id="nav-mobile" class="left hide-on-med-and-down">
	        <li><a href="#namaHargaBarang">Data Barang</a></li>
	        <li><a href="datapelanggan">Data Pelanggan</a></li>
	        <li><a href="kasir">Kasir</a></li>
	      </ul>
	    </div>
	</nav>

	<!-- Content -->
	<section class="content">
		<div class="container" id="namaHargaBarang">
			<div class="row heading">
				<div class="col">
					<h3 class="center">Data Barang</h3>
				</div>
			</div>
			<div class="row">
				<form action="" method="POST" class="form-pencarian">
					<input type="text" name="keyword" autofocus autocomplete="off" id="keyword" placeholder="Cari...">
					<button type="submit" name="cari" id="tombol-cari" class="tombol-cari">Cari</button>
				</form>
				<div class="col s6">
					<a class="btn-tambah-data" href="input.php">Tambah Data</a>
				</div>
			</div>
			<div class="row table">
				<table>
					<tr>
						<th rowspan="2">No</th>
						<th rowspan="2">Nama Barang</th>
						<th colspan="2">Harga Jual</th>
						<th rowspan="2">Jenis Barang</th>
						<th rowspan="2">Opsi</th>
					</tr>
					<tr>
						<th>Harga Asli</th>
						<th>Harga Ecer</th>
					</tr>
					<?php $i = 1; ?>
					<?php foreach($brg as $row): ?>
						<tr>
							<td><?= $i; ?></td>
							<td><?= $row["nama_barang"]; ?></td>
							<td><?= $row["harga_asli"]; ?></td>
							<td><?= $row["harga_jual"]; ?></td>
							<td><?= $row["jenis_barang"]; ?></td>
							<td class="pops opsi">
								<a class="btn-update" href="update.php?id=<?= $row["id"]; ?>"><img src="img/edit.png" alt=""></a>
								<a class="btn-delete" href="delete.php?id=<?= $row["id"]; ?>" onclick="return confirm('yakin?')"><img src="img/delete.png" alt=""></a>
							</td>
						</tr>
						<?php $i++; ?>
					<?php endforeach; ?>
				</table>
			</div>
		</div>
	</section>

	<!-- Footer -->
	<footer class="page-footer">
		<div class="container">
	        <div class="row iframe">
	            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3964.439272774718!2d108.02647867442883!3d-6.46590336322035!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e693526c6977317%3A0xf5bbd9a592545961!2sToko%20Mimi%20Hana%20Tio%20Cilegeh!5e0!3m2!1sid!2sid!4v1716743823904!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
	        </div>
			<div class="row">
				<p>&copy Copyright | Toko Mimi Hana Tio Cilegeh 2022</p>
			</div>
		</div>
	</footer>
	<!-- <script type="text/javascript" src="js/materialize.min.js"></script> -->
	<script type="text/javascript" src="js/script.js"></script>
</body>
</html>
