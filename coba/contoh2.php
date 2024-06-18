<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>contoh2</title>
</head>
<body>
	<table width="80%" cellspacing="0" cellpadding="10%" border="1" align="center">
		<tr>
			<th>no</th>
			<th>nama pelanggan</th>
			<th>total belanja</th>
			<th>status</th>
			<th>tanggal</th>
			<th>waktu</th>
			<th colspan="3">opsi</th>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td id="hasil"></td>
			<td></td>
			<td></td>
			<td>bayar tagihan</td>
			<td>ubah</td>
			<td id="hapus">hapus</td>
		</tr>
	</table>

	<script>
		document.getElementById("tombolBayar").
		addEventListener("click", tampilkanStatusBayar);
		
		document.getElementById("tombolBayarNanti").
		addEventListener("click", tampilkanStatusBelumDiBayar);
		
		function tampilkanStatusBayar() {
	    var outputBayar=document.getElementById("inputBayar").value;
	    document.getElementById("hasil").innerHTML=outputBayar;
		}
		function tampilkanStatusBelumDiBayar(){
		    var outputBelumBayar=document.getElementById("inputBelumBayar").value;
		    document.getElementById("hasil").innerHTML=outputBelumBayar;
		    document.getElementById("hapus").hide();
		}
	</script>
	
</body>
</html>