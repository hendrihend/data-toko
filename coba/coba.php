<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Coba</title>
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
<?php 
$conn = mysqli_connect("localhost", "root", "", "coba2");

function query($query) {
	global $conn;
	$result = mysqli_query($conn, $query);
	$rows = [];
	while ($row = mysqli_fetch_assoc($result)) {
		$rows[] = $row;
	}
	return $rows;
}
// function tambah
function tambah($conn) {
	if (isset($_POST["btnSimpan"])) {
		$id = time();
		$nama_barang = $_POST["nama_barang"];
		$pcs = $_POST["pcs"];
		$harga = $_POST["harga"];
		$jumlah = $_POST["jumlah"];
		if (!empty($nama_barang) && !empty($pcs) && !empty($harga) && !empty($jumlah)){
			$query = "INSERT INTO barang (id, nama_barang, pcs, harga, jumlah) VALUES(".$id.", '".$nama_barang."', '".$pcs."', '".$harga."', '".$jumlah."')";
		$simpan = mysqli_query($conn, $query);
			echo "<script>
					alert('data masuk!');
					document.location.href = 'coba.php';
				</script>";
			if ($simpan && isset($_GET["aksi"])) {
				if ($_GET["aksi"] == "create") {
					echo "<script>
							alert('data masuk!');
							document.location.href = 'coba.php';
						</script>";
				}
			}
		// return mysqli_affected_rows($conn);
		} else {
			echo "<script>
				alert('data masuk!');
				document.location.href = 'coba.php';
			</script>";
		}
		// return mysqli_affected_rows($conn);
	}
?>
<!-- form tambah -->
<div class="row">
	<div class="kol-12"><a href="../"><h2>kembali</h2></a></div>
</div>
<div class="row">
	<h1 align="center">Nama Barang dan Perhitungan Total Jumlah Barang</h1><hr>
	<form action="" method="POST" name="autoSumForm1">
		<div class="kol-4"><fieldset><hr width="100%"><hr width="90%"><hr width="80%"><hr width="70%"><hr width="60%"><hr width="50%"><hr width="40%"><hr width="30%"><hr width="20%"><hr width="10%">
			<fieldset>
			<table width="100%" cellspacing="10" class="justify">
				<legend class="center"><h2>Masukan Data</h2></legend>
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
					<td><input type="text" name="jumlah" readonly="" value="0" onFocus="startCalc();" onBlur="stopCalc();"></td>
				</tr>
				<tr>
					<th colspan="2">
						<button type="submit" name="btnSimpan" class="button-input">input data</button>
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
<?php
}
// tutup function tambah
// function tampil data
function tampilData($conn) {
	$query = query("SELECT * FROM  barang");
	$total = 0;
?>
<div class="kol-8 center">
    <!-- <legend><h2>Data Pesanan</h2></legend> -->
    <table width="100%" border="0" cellspacing="0" cellpadding="5" align="center">
    	<tr>
            <th colspan="2">Opsi</th>
            <th>No</th>
            <th>Nama Barang</th>
            <th>Pcs</th>
            <th>Harga</th>
            <th>Jumlah</th>
          </tr>
  	<?php $i = 1 ; ?>
  	<?php foreach ($query as $brg) {
  		$total += $brg["jumlah"]; ?>
		<tr>
			<td>
				<a href="coba.php?aksi=update&id=<?= $brg["id"]; ?>&nama_barang=<?= $brg["nama_barang"]; ?>&pcs=<?= $brg["pcs"]; ?>&harga=<?= $brg["harga"]; ?>&jumlah=<?= $brg["jumlah"]; ?>">ubah</a>
			</td>
			<td>
				<a href="coba.php?aksi=delete&id=<?= $brg["id"]; ?>" onclick="return confirm('yakin?')">hapus</a>
			</td>
			<td><?= $i; ?></td>
			<td><?= $brg["nama_barang"]; ?></td>
			<td><?= $brg["pcs"]; ?></td>
			<td>Rp.<?= number_format($brg["harga"]); ?></td>
			<td>Rp.<?= number_format($brg["jumlah"]); ?></td>
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
			<th>Rp.<input type='text' id="bayar" name="bayar" onFocus="startCalc();" onBlur="stopCalc();"></th>
		</tr>
		<tr>
			<th colspan="6">kembalian</th>
			<th>Rp.<input type='text' id="kembalian" name="kembalian" value="0" onFocus="startCalc();" onBlur="stopCalc();" required=""></th>
		</tr>
		<tr>
			<th colspan="7">
				<button type="submit" name="cetak" onclick="window.print()" class="button-cetak">Cetak</button>
			</th>
		</tr>
  	</table>
</div>	
</form><hr>

    <?php
}
// tutup function tampil data
// function ubah
function ubah($conn) {
	if (isset($_POST["btnUbah"])) {
		$id = $_POST["id"];
		$nama_barang = $_POST["nama_barang"];
		$pcs = $_POST["pcs"];
		$harga = $_POST["harga"];
		$jumlah = $_POST["jumlah"];
		if (!empty($nama_barang) && !empty($pcs) && !empty($harga) && !empty($jumlah)) {
			$ubahData = "nama_barang = '".$nama_barang."', pcs = '".$pcs."', harga = '".$harga."', jumlah = '".$jumlah."'";
			$query = "UPDATE barang SET " .$ubahData. " WHERE id = $id";
			$ubah = mysqli_query($conn, $query);
			if ($ubah && isset($_GET["aksi"])) {
				if ($_GET["aksi"] == "update") {
					echo "<script>
							alert('data berhasil diubah!');
							document.location.href = 'coba.php';
						</script>";
				}
			}
		}else {
			echo "<script>
					alert('data gagal diubah!');
					document.location.href = 'coba.php';
				</script>";
		}
		// return mysqli_affected_rows($conn);
	}
if (isset($_GET["id"])) {
?>
<!-- form ubah -->
	<a href="coba.php"> &laquo; Home</a> | 
	<a href="coba.php?aksi=create"> (+) Tambah Data</a>
<form action="" name="autoSumForm2" method="POST">
	<div class="kol-4"><fieldset><hr width="100%"><hr width="90%"><hr width="80%"><hr width="70%"><hr width="60%"><hr width="50%"><hr width="40%"><hr width="30%"><hr width="20%"><hr width="10%">
	<fieldset>
		<table width="100%" cellspacing="10" class="justify">
			<legend class="center"><h2>Ubah data</h2></legend>
			<tr>
				<td><input type="hidden" value="<?= $_GET["id"]; ?>" name="id"></td>
			</tr>
			<tr>
				<th><label for="nama_barang">nama barang</label></th>
				<td><input type="text" name="nama_barang" value="<?= $_GET["nama_barang"]; ?>" placeholder="nama barang"></td>
			</tr>
			<tr>
				<th><label for="pcs">pcs</label></th>
				<td><input type="number" name="pcs" id="pcs" value="<?= $_GET["pcs"]; ?>" onkeyup="sum()" placeholder="pcs"></td>
			</tr>
			<tr>
				<th><label for="harga">harga</label></th>
				<td><input type="text" name="harga" id="harga" value="<?= $_GET["harga"]; ?>" onkeyup="sum()" placeholder="harga"></td>
			</tr>
			<tr>
				<th><label for="jumlah">jumlah</label></th>
				<td><input type="text" name="jumlah" id="jumlah" readonly="" value="<?= $_GET["jumlah"]; ?>"></td>
			</tr>
			<tr>
				<th>
					<button type="submit" name="btnUbah">ubah data</button>
					<button type="reset">reset</button>
				</th>
			</tr>
		</table>
	</fieldset><hr width="10%"><hr width="20%"><hr width="30%"><hr width="40%"><hr width="50%"><hr width="60%"><hr width="70%"><hr width="80%"><hr width="90%"><hr width="100%">
	</fieldset>
	</div>
</form>
</div>
<?php
}
}

// tutup function ubah
// function hapus
function hapus($conn) {
	if (isset($_GET["id"]) && isset($_GET["aksi"])) {
		$id = $_GET["id"];
	$query =  "DELETE FROM barang WHERE id = " .$id;
	$hapus = mysqli_query($conn, $query);
		if ($hapus) {
			if ($_GET["aksi"] == "delete") {
				echo "<script>
						alert('data berhasil dihapus!');
						document.location.href = 'coba.php';
					</script>";
			}
		}
	}
	// return mysqli_affected_rows($conn);
}
// tutup function hapus
// program utama
if (isset($_GET["aksi"])) {
	switch ($_GET["aksi"]) {
		case "create":
	        echo '<a href="coba.php"> &laquo; Home</a>';
	        tambah($conn);
	        break;
        case "read":
	        tampilData($conn);
	        break;
        case "update":
        	ubah($conn);
	        tampilData($conn);
        	break;
    	case "delete":
    		hapus($conn);
    		break;
		default:
            echo "<h3>Aksi <i>".$_GET['aksi']."</i> tidaka ada!</h3>";
			tambah($conn);
			tampilData($conn);
	}
}else {
	tambah($conn);
	tampilData($conn);
}

?>
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

	function sum() {
		var Npcs = document.getElementById('pcs').value;
		var Nhrg = document.getElementById('harga').value;
		var rs = parseInt(Npcs * 1) * parseInt(Nhrg * 1);
			document.getElementById('jumlah').value = rs;
		// if (!isNaN(rs)) {
		// }
	}

	// function startCalc1(){
	// 		interval = setInterval("calc()",1);
	// 	}
	// function calc1(){
	// 	$pcss = document.autoSumForm1.pcss.value;
	// 	$hrgg = document.autoSumForm1.hargaa.value;
	// 	$tot = document.autoSumForm1.total.value;
	// 	$byr = document.autoSumForm1.bayar.value;
	// 	document.autoSumForm1.jumlahh.value = ($pcss * 1) * ($hrgg * 1) + ($hrgg * 0);
	// 	document.autoSumForm1.kembalian.value = ($byr * 1) - ($tot * 1);
	// }
	// function stopCalc1(){
	// 	clearInterval(interval);
	// }
</script>
</body>
</html>