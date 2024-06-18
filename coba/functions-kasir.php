<?php 
$conn = mysqli_connect("localhost", "root", "", "coba");

function query($query) {
	global $conn;
	$result = mysqli_query($conn, $query);
	$rows = [];
	while ($row = mysqli_fetch_assoc($result)) {
		$rows[] = $row;
	}
	return $rows;
}
function tambah($data) {
	global $conn;
	$nama_barang = htmlspecialchars($data["nama_barang"]);
	$pcs = htmlspecialchars($data["pcs"]);
	$harga = htmlspecialchars($data["harga"]);
	$jumlah = htmlspecialchars($data["jumlah"]);

	$query = "INSERT INTO barang VALUES('', '$nama_barang', '$pcs', '$harga', '$jumlah')";
	mysqli_query($conn, $query);
	return mysqli_affected_rows($conn);
}
function hapus($id) {
	global $conn;
	mysqli_query($conn, "DELETE FROM barang WHERE id = $id");
	return mysqli_affected_rows($conn);
}
function ubah($data) {
	global $conn;
	$id = $data["id"];
	$nama_barang = htmlspecialchars($data["nama_barang"]);
	$pcs = htmlspecialchars($data["pcs"]);
	$harga = htmlspecialchars($data["harga"]);
	$jumlah = htmlspecialchars($data["jumlah"]);

	$query = "UPDATE barang SET nama_barang = '$nama_barang', pcs = '$pcs', harga = '$harga', jumlah = '$jumlah' WHERE id = $id ";
	mysqli_query($conn, $query);
	return mysqli_affected_rows($conn);
}





?>