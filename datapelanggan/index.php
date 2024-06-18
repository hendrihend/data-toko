<?php 
require 'functions.php';
$pelanggan = query("SELECT * FROM t_pelanggan");
//tombol cari ditekan
if (isset($_POST["cari"])) {
	# code...
	$pelanggan = cari($_POST["keyword"]);
}

?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1.0">
 	<!-- <link rel="stylesheet" href="../css/materialize.min.css"> -->
	<link rel="stylesheet" href="css/style.css">
 	<title>Halaman Data Pelanggan</title>
 </head>
 <body>
	<nav>
	    <div class="nav">
	      <a href="#" class="brand-logo"><h1>Toko Mimi Hana Tio Cilegeh</h1></a>
	      <ul id="nav-mobile" class="left hide-on-med-and-down">
	        <li><a href="../">Data Barang</a></li>
	        <li><a href="#datapelanggan">Data Pelanggan</a></li>
	        <li><a href="../kasir">Kasir</a></li>
	      </ul>
	    </div>
	</nav>
	<section class="content">
		<div class="container" id="datapelanggan">
			<div class="row heading">
				<div class="col s12">
					<h3>Data Pelanggan</h3>
				</div>
			</div>
			<div class="row">
				<div class="col s6">
					<a class="btn-form-pelanggan" href="form_pelanggan.php">Form Pelanggan</a>
				</div>
				<div class="col s6">
					<form action="" method="POST" class="form-pencarian">
						<input type="text" name="keyword" autofocus autocomplete="off" id="keyword" placeholder="Cari...">
						<button type="submit" name="cari" id="tombol-cari" class="tombol-cari">Cari</button>
					</form>
				</div>
			</div>
			<div class="row">
				<table>
					<tr>
						<th>No</th>
						<th>Nama Pelanggan</th>
						<th>Total Belanja</th>
						<th>Tanggal</th>
						<th>Waktu</th>
						<th>Status</th>
						<th>Opsi</th>
					</tr>
					<?php $j = 1; ?>
					<?php foreach ($pelanggan as $plgn) : ?>
						<tr>
							<td><?= $j; ?></td>
							<td><?= $plgn["nama_pelanggan"]; ?></td>
							<td><?= number_format($plgn["total_belanja"]); ?></td>
							<td><?= $plgn["tanggal"]; ?></td>
							<td><?= $plgn["waktu"]; ?></td>
							<td><?= $plgn["status"]; ?></td>
							<td class="opsi">
								<a href="form_pembayaran.php?id_pelanggan=<?= $plgn["id_pelanggan"]; ?>"><img src="../img/wallet.png" alt="gambar pembayaran"></a>
								<a href="ubah_pelanggan.php?id_pelanggan=<?= $plgn["id_pelanggan"]; ?>"><img src="../img/edit.png" alt="gambar edit"></a>
								<a href="hapus.php?id_pelanggan=<?= $plgn["id_pelanggan"]; ?>" onclick="return confirm('yakin?')"><img src="../img/delete.png" alt="gambar hapus"></a>
							</td>
						</tr>
					<?php $j++; ?>
					<?php endforeach; ?>
				</table>
			</div>
		</div>
	</section>

	<footer class="page-footer">
		<div class="row">
			<p>&copy Copyright | Toko Mimi Hana Tio Cilegeh 2022</p>
		</div>
	</footer>
	<script type="text/javascript" src="../js/materialize.min.js"></script>
	<script type="text/javascript" src="../js/script.js"></script>
	<script>
		const tabs = document.querySelectorAll('.tabs');
		M.Tabs.init(tabs);
	</script>
 </body>
 </html>