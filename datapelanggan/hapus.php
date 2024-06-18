<?php 
require 'functions.php'; //koneksi ke database
$id_pelanggan = $_GET["id_pelanggan"];
if (hapus($id_pelanggan) > 0 ) {
	echo "<script>
			alert('Data berhasil dihapus!');
			document.location.href = 'index.php';
		</script>";
} else {
	echo "<script>
			alert('Data gagal dihapus!');
			document.location.href = 'index.php';
		</script>";
}

?>