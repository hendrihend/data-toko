<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Halaman Kasir</title>
	<link rel="stylesheet" href="../cssGrid/cssGrid.css">
	<style>
		* { font-family: arial; }
		body {
			background-color: #36454F;
			color: white;
		}
		.row {
			background-color: #495D6A;
			border-radius: 10px;
			box-shadow: 0 0 3px 1px black;
			margin: 2rem;
			padding: 1rem;
		}
		.row .img-home { width: 10%; }
		table {
			box-shadow: 0 0 3px 1px black;
			border-radius: 10px;
			padding: 1rem;
		}
		tr{ transition: .3s; }
		tr:hover {
			background-color: #36454F;
			color: black;
		}.pesan{
			color: maroon;
			font-style: italic;	
		}a {color: #000000}
		label { font-size: x-small; }
		input {
			width: 85%;
			border-radius: 5px;
			border: none;
			padding: .3rem;
			transition: .3s;
		}input:hover {
			background-color: #36454F;
			color: white;
		}button {
			width: 93%;
			border-radius: 5px;
			border: none;
			transition: .3s;
			padding: .3rem;
		}.button-input:hover {
			background-color: #495D6A;
			color: white;
		}.button-ubah:hover {
			background-color: #495D6A;
			color: white;
		}.button-reset:hover {
			background-color: maroon;
			color: white;
		}.button-cetak:hover {
			background-color: #495D6A;
			color: white;
		}
		/* garis fieldset */
		fieldset {
			border-radius: 1rem;
		}

		/* opsi */
		.opsi img { width: 15pt; 		}
	</style>
</head>
<body>
<?php 
$conn = mysqli_connect("localhost", "root", "", "my-toko");

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
			$query = "INSERT INTO t_kasir (id, nama_barang, pcs, harga, jumlah) VALUES(".$id.", '".$nama_barang."', '".$pcs."', '".$harga."', '".$jumlah."')";
		$simpan = mysqli_query($conn, $query);
			echo "<script>
					alert('data masuk!');
					document.location.href = 'index.php';
				</script>";
			if ($simpan && isset($_GET["aksi"])) {
				if ($_GET["aksi"] == "create") {
					echo "<script>
							alert('data masuk!');
							document.location.href = 'index.php';
						</script>";
				}
			}
		} else {
			$pesan = "Tidak dapat menyimpan, data belum lengkap!";
		}
	}
?>

<!-- form tambah -->
<div class="row">
	<div class="kol-3"><a href="../"><h2><img class="img-home" src="../img/home.png" alt="gambar rumah"></h2></a></div>
	<div class="kol-6 center"><h1>Toko Mimi Hana Tio Cilegeh🛒 </h1></div>
	<div class="kol-3 right"><h3 id="htbt"></h3><h3 id="jam"></h3></div>
</div>
<div class="row">
	<fieldset>
		<legend class="center"><h2>Nama Barang dan Perhitungan Total Jumlah Barang</h2></legend>
	<form action="" method="POST" name="autoSumForm1">
		<div class="kol-4"><fieldset>
			<fieldset>
			<table width="100%" cellspacing="10" class="justify">
				<legend class="center"><h2>Masukan Data</h2></legend>
				<tr><th colspan="2" class="pesan"><?= isset($pesan) ? $pesan : "" ?></th></tr>
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
		</fieldset>
		</fieldset>
		</div>
<?php
}
// tutup function tambah
// function tampil data
function tampilData($conn) {
	$query = query("SELECT * FROM  t_kasir");
	$totalPcs = 0;
	$totalJumlah = 0;
	$cek = $query;
	$jumlahData = count($query);
	if (empty($cek)) {
		echo "<p style='text-align: center; font-weight: bold; font-style: italic; font-size: 150%; color: maroon;'>Tidak ada data.</p>";
	}
?>
<div class="kol-8 center">
    <table width="100%" border="0" cellspacing="0" cellpadding="5" align="center">
    	<tr>
            <th>Opsi</th>
            <th>No</th>
            <th>Nama Barang</th>
            <th>Pcs</th>
            <th>Harga</th>
            <th>Discon</th>
            <th>Jumlah</th>
          </tr>
  	<?php $i = 1 ; ?>
  	<?php foreach ($query as $brg) {
  		$totalPcs += $brg["pcs"];
  		$totalJumlah += $brg["jumlah"]; ?>
		<tr>
			<td class="opsi">
				<a href="index.php?aksi=update&id=<?= $brg["id"]; ?>&nama_barang=<?= $brg["nama_barang"]; ?>&pcs=<?= $brg["pcs"]; ?>&harga=<?= $brg["harga"]; ?>&jumlah=<?= $brg["jumlah"]; ?>"><img src="../img/edit.png" alt="gambar edit"></a>
				<a href="index.php?aksi=delete&id=<?= $brg["id"]; ?>" onclick="return confirm('yakin?')"><img src="../img/delete.png" alt="gambar hapus"></a>
			</td>
			<td><?= $i; ?></td>
			<td><?= $brg["nama_barang"]; ?></td>
			<td><?= $brg["pcs"]; ?></td>
			<td>Rp.<?= number_format($brg["harga"]); ?></td>
			<td>Rp.</td>
			<td>Rp.<?= number_format($brg["jumlah"]); ?></td>
		</tr>
<?php $i++; ?>
<?php } ?>
		<tr>
			<th colspan="3" class="left">Total Item: [ <?= $jumlahData; ?> ]</th>
			<th>Pcs [ <?= number_format($totalPcs); ?> ]</th>
			<th></th>
			<th></th>
			<th>Rp.<?= number_format($totalJumlah); ?></th>
		</tr>
		<tr>
			<th colspan="6" class="right">Total Belanja</th>
			<th>Rp.<input type="text" id="total" name="total" value="<?= $totalJumlah; ?>" onFocus="startCalc();" onBlur="stopCalc();" ></th>
		</tr>
		<tr>
			<th colspan="6" class="right">Tunai</th>
			<th>Rp.<input type='text' id="bayar" name="bayar" onFocus="startCalc();" onBlur="stopCalc();"></th>
		</tr>
		<tr>
			<th colspan="6" class="right">Kembalian</th>
			<th>Rp.<input type='text' id="kembalian" name="kembalian" value="0" onFocus="startCalc();" onBlur="stopCalc();" required=""></th>
		</tr>
		<tr>
			<th colspan="7">
				<button type="submit" name="cetak" id="cetak" onclick="window.print()" class="button-cetak">Cetak</button>
			</th>
		</tr>
  	</table>
</div>	
</form></fieldset>

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
			$query = "UPDATE t_kasir SET " .$ubahData. " WHERE id = $id";
			$ubah = mysqli_query($conn, $query);
			if ($ubah && isset($_GET["aksi"])) {
				if ($_GET["aksi"] == "update") {
					echo "<script>
							alert('data berhasil diubah!');
							document.location.href = 'index.php';
						</script>";
				}
			}
		}else {
			$pesan = "Data belum lengkap!";
		}
		// return mysqli_affected_rows($conn);
	}
if (isset($_GET["id"])) {
?>
<!-- form ubah -->
	<a href="index.php"> &laquo; Home</a> | 
	<a href="index.php?aksi=create"> (+) Tambah Data</a>
<form action="" name="autoSumForm2" method="POST" class="form-ubah">
	<div class="kol-4"><fieldset><hr width="100%"><hr width="90%"><hr width="80%"><hr width="70%"><hr width="60%"><hr width="50%"><hr width="40%"><hr width="30%"><hr width="20%"><hr width="10%">
	<fieldset>
		<table width="100%" cellspacing="10" class="justify">
			<legend class="center"><h2>Ubah data</h2></legend>
			<tr><th colspan="2" class="pesan"><?= isset($pesan) ? $pesan : "" ?></th></tr>
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
				<th colspan="2">
					<button type="submit" name="btnUbah" class="button-ubah">simpan perubahan</button>
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
	$query =  "DELETE FROM t_kasir WHERE id = " .$id;
	$hapus = mysqli_query($conn, $query);
		if ($hapus) {
			if ($_GET["aksi"] == "delete") {
				echo "<script>
						alert('data berhasil dihapus!');
						document.location.href = 'index.php';
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
	        echo '<a href="index.php"> &laquo; Home</a>';
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
<script src="../jQuery/jquery-3.6.0.js"></script>
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
	}
// =================================================
// awal jam=================================================
    window.onload = function() { jam(); }
    function jam() {
        var e = document.getElementById('jam'),
        d = new Date(), h, m, s;
        h = d.getHours();
        m = set(d.getMinutes());
        s = set(d.getSeconds());
        e.innerHTML = h + ':' + m + ':' + s + ' ' + 'WIB';
        setTimeout('jam()', 1000);
    }
    function set(e) {
        e = e < 10 ? '0'+ e : e;
        return e;
    }
// akhir jam=================================================
// awal htbt=================================================
	    tanggallengkap = new String();
	    namahari = ("Minggu Senin Selasa Rabu Kamis Jumat Sabtu");
	    namahari = namahari.split(" ");
	    namabulan = ("Januari Februari Maret April Mei Juni Juli Agustus September Oktober November Desember");
	    namabulan = namabulan.split(" ");
	    tgl = new Date();
	    hari = tgl.getDay();
	    tanggal = tgl.getDate();
	    bulan = tgl.getMonth();
	    tahun = tgl.getFullYear();
	    var tanggallengkap = namahari[hari] + ", " + tanggal + " " + namabulan[bulan] + " " + tahun;
	    document.getElementById('htbt').innerHTML = tanggallengkap;
// akhir htbt=================================================
</script>
</body>
</html>