// ambil elemen2 yg dibutuhkan
var keyword = document.getElementById('keyword');
var tombolCari = document.getElementById('tombol-cari');
var container = document.getElementsByClassName('container');

// tambahkan event ketika keyword ditulis
keyword.addEventListener('keyup', function() {
	// buat object ajax
	var xhr = new XMLHttpRequest();

	// cek kesiapan ajax
	xhr.onreadystatechange = function() {
		if ( xhr.readyState == 4 && xhr.status == 200 ) {
			container.innerText = xhr.responseText;
		}
	}

	// eksekusi ajax
	xhr.open('GET', 'ajax/barang.php?keyword=' + keyword.value, true);
	xhr.send();
});

