<?php 
require ("functions-kasir.php");
$id = $_GET["id"];
if (hapus($id) > 0) {
	# code...
	echo "<script>
			alert('data berhasil dihapus!');
			document.location.href = 'kasir.php';
		</script>";
}else {
	echo "<script>
			alert('data gagal dihapus!');
			document.location.href = 'kasir.php';
		</script>";
}




?>