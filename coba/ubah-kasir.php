<?php 
require ("functions-kasir.php");
$id = $_GET["id"];
$data = query("SELECT * FROM barang WHERE id = $id")[0];
if (isset($_POST["ubah"])) {
	if (ubah($_POST) > 0) {
		echo "<script>
				alert('data diubah!');
				document.location.href = 'kasir.php';
			</script>";
	}else {
		echo "<script>
				alert('data belum diubah!');
				document.location.href = 'kasir.php';
			</script>";
	}
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>ubah</title>
</head>
<body>
	<h3 align="center">Halaman Perubahan</h3>
	<form action="" name="autoSumForm1" method="post" enctype="multipart/form-data">
		<table width="25%" align="center" id="tabel-ubah">
			<tr>
				<td><input type="hidden" value="<?= $data["id"]; ?>" name="id"></td>
			</tr>
			<tr>
				<th><label for="nama_barang">nama barang</label></th>
				<td><input type="text" value="<?= $data["nama_barang"]; ?>" id="nama_barang" name="nama_barang" placeholder="nama barang"></td>
			</tr>
			<tr>
				<th><label for="pcs">pcs</label></th>
				<td><input type="number" value="<?= $data["pcs"]; ?>" id="pcs" name="pcs" onFocus="startCalc();" onBlur="stopCalc();" placeholder="pcs"></td>
			</tr>
			<tr>
				<th><label for="harga">harga</label></th>
				<td><input type="text" value="<?= $data["harga"]; ?>" id="harga" name="harga" onFocus="startCalc();" onBlur="stopCalc();" placeholder="harga"></td>
			</tr>
			<tr>
				<th><label for="jumlah">jumlah</label></th>
				<td><input readOnly="true" type="text" value="<?= $data["jumlah"]; ?>" id="jumlah" name="jumlah" onFocus="startCalc();" onBlur="stopCalc();"></td>
			</tr>
			<tr>
				<th colspan="2">
					<button type="submit" name="ubah">ubah data</button>
					<button type="reset">reset</button>
				</th>
			</tr>
		</table>
	</form>
	<script>
		// perhitungan otomatis
		function startCalc(){
			interval = setInterval("calc()",1);
		}
		function calc(){
			$pcs = document.autoSumForm1.pcs.value;
			$hrg = document.autoSumForm1.harga.value;
			document.autoSumForm1.jumlah.value = ($pcs * 1) * ($hrg * 1) + ($hrg * 0);
		}
		function stopCalc(){
			clearInterval(interval);
		}

	</script>
	
</body>
</html>