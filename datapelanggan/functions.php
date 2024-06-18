<?php 
$conn = mysqli_connect("localhost", "root", "", "my-toko");
function query($query) {
	global $conn;
	$result = mysqli_query($conn, $query);
	$rows = [];
	while ($row = mysqli_fetch_assoc($result) ) {
		$rows[] = $row;
	}
	return $rows;
}
function tambah($data) {
	global $conn;
	$nama_pelanggan = htmlspecialchars($data["nama_pelanggan"]);
	$total_belanja = htmlspecialchars($data["total_belanja"]);
	$tanggal = htmlspecialchars($data["tanggal"]);
	$waktu = htmlspecialchars($data["waktu"]);
	$status = htmlspecialchars($data["status"]);
	 //query input data kedalam tabel pelanggan
	$query = "INSERT INTO t_pelanggan VALUES('', '$nama_pelanggan', '$total_belanja', CURDATE(), NOW(), '$status')";
	mysqli_query($conn, $query);
	return mysqli_affected_rows($conn);
}
function hapus($id_pelanggan) {
	global $conn;
	mysqli_query($conn, "DELETE FROM t_pelanggan WHERE id_pelanggan = $id_pelanggan ");
	return mysqli_affected_rows($conn);
}
function ubah($data) {
	global $conn;
	$id_pelanggan = $data["id_pelanggan"];
	$nama_pelanggan = htmlspecialchars($data["nama_pelanggan"]);
	$total_belanja = htmlspecialchars($data["total_belanja"]);
	$tanggal = htmlspecialchars($data["tanggal"]);
	$waktu = htmlspecialchars($data["waktu"]);
	$status = htmlspecialchars($data["status"]);
	//query ubah data
	$query = "UPDATE t_pelanggan SET nama_pelanggan = '$nama_pelanggan', total_belanja = '$total_belanja', tanggal = CURDATE(), waktu = NOW(), status = '$status' WHERE id_pelanggan = $id_pelanggan ";
	mysqli_query($conn, $query);
	return mysqli_affected_rows($conn);
}
function cari($keyword) {
	$query = "SELECT * FROM t_pelanggan WHERE
			nama_pelanggan LIKE '%$keyword%' OR
			total_belanja LIKE '%$keyword%' OR
			tanggal LIKE '%$keyword%' OR
			waktu LIKE '%$keyword%' OR
			status LIKE '%$keyword%'
	";
	return query($query);
}
?>