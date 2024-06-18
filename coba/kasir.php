<?php 
require ("functions-kasir.php");
$brg = query("SELECT * FROM barang");
$total = 0;

if (isset($_POST["input"])) {
	if (tambah($_POST) > 0) {
		echo "<script>
				document.location.href = 'kasir.php';
			</script>
			";
	}else {
		echo "<script>
				alert('data tidak masuk!');
				document.location.href = 'kasir.php';
			</script>
			";
	}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>kasir</title>
	<link rel="stylesheet" href="../cssGrid/cssGrid.css">
	<style>
		body {background-color: #36454F;}
		.row {
			background-color: #495D6A;
			border-radius: 10px;
			box-shadow: 6px 6px 6px 6px;
		}table {
			box-shadow: 3px 3px 3px 3px #36454F;
			border-radius: 10px;
		}tr:hover {
			background-color: #36454F;
			color: white;
		}a {color: #000000}
		input {
			width: 85%;
			border-radius: 5px;
		}input:hover {
			background-color: #36454F;
			color: white;
		}button {
			width: 93%;
			border-radius: 5px;
			border: none;
		}.button-input:hover {
			background-color: #495D6A;
			color: white;
		}.button-reset:hover {
			background-color: maroon;
			color: white;
		}.button-cetak:hover {
			background-color: #495D6A;
			color: white;
		}
	</style>
</head>
<body>
	<div class="row">
		<div class="kol-12"><a href="../"><h2>kembali</h2></a></div>
	</div>
	<div class="row">
		<h1 align="center">Nama Barang dan Perhitungan Total Jumlah Barang</h1><hr>
		<form method="post" action="" name="autoSumForm1" enctype="multipart/form-data" align="center">
			<div class="kol-4"><fieldset><hr width="100%"><hr width="90%"><hr width="80%"><hr width="70%"><hr width="60%"><hr width="50%"><hr width="40%"><hr width="30%"><hr width="20%"><hr width="10%">
				<fieldset>
				<table width="100%" cellspacing="10" class="justify">
					<legend><h2>Masukan Data</h2></legend>
					<tr>
						<th><label for="nama_barang">nama barang</label></th>
						<td><input type="text" name="nama_barang" placeholder="nama barang"></td>
					</tr>
					<tr>
						<th><label for="pcs">pcs</label></th>
						<td><input type="number" name="pcs" onFocus="startCalc();" onBlur="stopCalc();" placeholder="pcs"></td>
					</tr>
					<tr>
						<th><label for="harga">harga</label></th>
						<td><input type="text" name="harga" onFocus="startCalc();" onBlur="stopCalc();" placeholder="harga"></td>
					</tr>
					<tr>
						<th><label for="jumlah">jumlah</label></th>
						<td><input readOnly="true" type="text" name="jumlah" value="0" onFocus="startCalc();" onBlur="stopCalc();"></td>
					</tr>
					<tr>
						<th colspan="2">
							<button type="submit" name="input" class="button-input">input data</button>
						</th>
					</tr>
					<tr>
						<th colspan="2">
							<button type="reset" class="button-reset">reset</button>
						</th>
					</tr>
				</table>
			</fieldset><hr width="10%"><hr width="20%"><hr width="30%"><hr width="40%"><hr width="50%"><hr width="60%"><hr width="70%"><hr width="80%"><hr width="90%"><hr width="100%">
			</fieldset>
			</div>
			<div class="kol-8">
				<table width="100%" cellspacing="0" cellpadding="5%" border="0" align="center">
					<tr>
						<th colspan="2">opsi</th>
						<th>no</th>
						<th>nama barang</th>
						<th>pcs</th>
						<th>harga</th>
						<th>jumlah</th>
					</tr>
					<?php $i = 1 ; ?>
					<?php foreach($brg as $row) { 
						$total += $row["jumlah"]; ?>
						<tr>
							<td><a href="ubah-kasir.php?id=<?= $row["id"]; ?>">ubah</a></td>
							<td><a href="hapus-kasir.php?id=<?= $row["id"]; ?>" onclick="return confirm('yakin?')">hapus</a></td>
							<td><?= $i; ?></td>
							<td><?= $row["nama_barang"]; ?></td>
							<td><?= $row["pcs"]; ?></td>
							<td>Rp. <?= number_format($row["harga"]); ?></td>
							<td>Rp. <?= number_format($row["jumlah"]); ?></td>
						</tr>
					<?php $i++; ?>
					<?php } ?>
						<tr>
							<th colspan="6">total</th>
							<th>Rp.<?= number_format($total); ?></th>
						</tr>
						<tr>
							<th colspan="6">total</th>
							<th>Rp.<input type="text" id="total" name="total" value="<?= $total; ?>" onFocus="startCalc();" onBlur="stopCalc();" ></th>
						</tr>
						<tr>
							<th colspan="6">bayar</th>
							<th>Rp.<input type="text" id="bayar" name="bayar" onFocus="startCalc();" onBlur="stopCalc();"></th>
						</tr>
						<tr>
							<th colspan="6">kembalian</th>
							<th>Rp.<input type="text" id="kembalian" name="kembalian" value="0" onFocus="startCalc();" onBlur="stopCalc();" required=""></th>
						</tr>
						<tr><th colspan="7"><button type="submit" name="cetak" onclick="window.print()" class="button-cetak">Cetak</button></th></tr>
				</table>
			</div>
		</form><hr>
	</div>
	<script>
		// perhitungan otomatis
		function startCalc(){
			interval = setInterval("calc()",1);
		}
		function calc(){
			$pcs = document.autoSumForm1.pcs.value;
			$hrg = document.autoSumForm1.harga.value;
			$tot = document.autoSumForm1.total.value;
			$byr = document.autoSumForm1.bayar.value;
			document.autoSumForm1.jumlah.value = ($pcs * 1) * ($hrg * 1) + ($hrg * 0);
			document.autoSumForm1.kembalian.value = ($byr * 1) - ($tot * 1);
		}
		function stopCalc(){
			clearInterval(interval);
		}

	</script>
</body>
</html>