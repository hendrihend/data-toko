<!DOCTYPE html>
<html>
<head>
    <title>CRUD Petani Kode</title>
    <link rel="icon" href="http://www.petanikode.com/favicon.ico" />
    <link rel="stylesheet" href="../cssGrid/cssGrid.css">
</head>
<body>

<?php
// --- koneksi ke database
$koneksi = mysqli_connect("localhost","root","","pertanian") or die(mysqli_error());
echo "<div class='row'> ";
// --- Fngsi tambah data (Create)
function tambah($koneksi){
    
    if (isset($_POST['btn_simpan'])){
        $id = time();
        $nm_tanaman = $_POST['nm_tanaman'];
        $hasil = $_POST['hasil'];
        $lama = $_POST['lama'];
        $tgl_panen = $_POST['tgl_panen'];
        
        if(!empty($nm_tanaman) && !empty($hasil) && !empty($lama) && !empty($tgl_panen)){
            $sql = "INSERT INTO tabel_panen (id,nama_tanaman, hasil_panen, lama_tanam, tanggal_panen) VALUES(".$id.",'".$nm_tanaman."','".$hasil."','".$lama."','".$tgl_panen."')";
            $simpan = mysqli_query($koneksi, $sql);
            echo "<script>
                    alert('data berhasil ditambahkan!');
                    document.location.href = 'index.php';
                </script>";
            if($simpan && isset($_GET['aksi'])){
                if($_GET['aksi'] == 'create'){
                    echo "<script>
                            alert('data berhasil ditambahkan!');
                            document.location.href = 'index.php';
                        </script>";
                }
            }
        } else {
            $pesan = "Tidak dapat menyimpan, data belum lengkap!";
        }
    }
    ?>
    <div class='kol-4 justify'>
        <form action="" method="POST">
            <fieldset>
            <legend class="center"><h2>Tambah data</h2></legend>
            <table width="100%">
                <tr>
                    <th><label>Nama tanaman</label></th>
                    <td><input type="text" name="nm_tanaman"></td>
                </tr>
                <tr>
                    <th><label>Hasil panen</label></th>
                    <td><input type="number" name="hasil"> kg</td>
                </tr>
                <tr>
                    <th><label>Lama tanam</label></th>
                    <td><input type="number" name="lama"> bulan</td>
                </tr>
                <tr>
                    <th><label>Tanggal panen</label> </th>
                    <td><input type="date" name="tgl_panen"></td>
                </tr>
                <tr>
                    <th>
                        <input type="submit" name="btn_simpan" value="Simpan">
                        <input type="reset" name="reset" value="Besihkan">
                    </th>
                    <td></td>
                </tr>
            </table>
            <p><?= isset($pesan) ? $pesan : "" ?></p>
            </fieldset>
        </form>
    </div>
    <?php
}
// --- Tutup Fungsi tambah data
// --- Fungsi Baca Data (Read)
function tampil_data($koneksi){
    $sql = "SELECT * FROM tabel_panen";
    $query = mysqli_query($koneksi, $sql);
    echo "<div class='kol-8 center'>";
    echo "<fieldset>";
    echo "<legend><h2>Data Panen</h2></legend>";
    
    echo "<table width='100%' border='1' cellpadding='10'>";
    echo "<tr>
            <th>ID</th>
            <th>Nama Tanaman</th>
            <th>Hasil Panen</th>
            <th>Lama Tanam</th>
            <th>Tanggal Panen</th>
            <th>Tindakan</th>
          </tr>";
    
    while($data = mysqli_fetch_array($query)){
        ?>
        <tr>
            <td><?= $data['id']; ?></td>
            <td><?= $data['nama_tanaman']; ?></td>
            <td><?= $data['hasil_panen']; ?> Kg</td>
            <td><?= $data['lama_tanam']; ?> bulan</td>
            <td><?= $data['tanggal_panen']; ?></td>
            <td>
                <a href="index.php?aksi=update&id=<?= $data['id']; ?>&nama=<?= $data['nama_tanaman']; ?>&hasil=<?= $data['hasil_panen']; ?>&lama=<?= $data['lama_tanam']; ?>&tanggal=<?= $data['tanggal_panen']; ?>">Ubah</a> |
                <a href="index.php?aksi=delete&id=<?= $data['id']; ?>" onclick="return confirm('yakin?')">Hapus</a>
            </td>
        </tr>
        <?php
    }
    echo "</table>";
    echo "</fieldset>";
    echo "</div>";
}
// --- Tutup Fungsi Baca Data (Read)
// --- Fungsi Ubah Data (Update)
function ubah($koneksi){
    // ubah data
    if(isset($_POST['btn_ubah'])){
        $id = $_POST['id'];
        $nm_tanaman = $_POST['nm_tanaman'];
        $hasil = $_POST['hasil'];
        $lama = $_POST['lama'];
        $tgl_panen = $_POST['tgl_panen'];
        
        if(!empty($nm_tanaman) && !empty($hasil) && !empty($lama) && !empty($tgl_panen)){
            $perubahan = "nama_tanaman='".$nm_tanaman."',hasil_panen=".$hasil.",lama_tanam=".$lama.",tanggal_panen='".$tgl_panen."'";
            $sql_update = "UPDATE tabel_panen SET ".$perubahan." WHERE id=$id";
            $update = mysqli_query($koneksi, $sql_update);
            if($update && isset($_GET['aksi'])){
                if($_GET['aksi'] == 'update'){
                    echo "<script>
                            alert('data berhasil diubah!');
                            document.location.href = 'index.php';
                        </script>";
                }
            }
        } else {
            $pesan = "Data tidak lengkap!";
        }
    }
    
    // tampilkan form ubah
    if(isset($_GET['id'])){
        ?>
        <a href="index.php"> &laquo; Home</a> | 
        <a href="index.php?aksi=create"> (+) Tambah Data</a>
        <hr>
        <div class="kol-4 justify">
        <form action="" method="POST">
            <fieldset>
            <legend class="center"><h2>Ubah data</h2></legend>
            <table width="100%">
                <input type="hidden" name="id" value="<?= $_GET['id'] ?>"/>
                <tr>
                    <th><label>Nama tanaman</label></th>
                    <td><input type="text" name="nm_tanaman" value="<?= $_GET['nama'] ?>"/></td>
                </tr>
                <tr>
                    <th><label>Hasil panen</label></th>
                    <td><input type="number" name="hasil" value="<?= $_GET['hasil'] ?>"/> kg</td>
                </tr>
                <tr>
                    <th><label>Lama tanam</label></th>
                    <td><input type="number" name="lama" value="<?= $_GET['lama'] ?>"/> bulan</td>
                </tr>
                <tr>
                    <th><label>Tanggal panen </label> </th>
                    <td><input type="date" name="tgl_panen" value="<?= $_GET['tanggal'] ?>"/></td>
                </tr>
                <tr>
                    <th colspan="2">
                        <input type="submit" name="btn_ubah" value="Simpan Perubahan"/> atau <a href="index.php?aksi=delete&id=<?= $_GET['id'] ?>" onclick="return confirm('yakin?')"> (x) Hapus data ini</a>!
                    </th>
                </tr>
                <p><?= isset($pesan) ? $pesan : "" ?></p>
                
            </fieldset>
            </table>
        </form>
        </div>
        <?php
    }
}
// --- Tutup Fungsi Update
echo "</div>";

// --- Fungsi Delete
function hapus($koneksi){
    if(isset($_GET['id']) && isset($_GET['aksi'])){
        $id = $_GET['id'];
        $sql_hapus = "DELETE FROM tabel_panen WHERE id=" . $id;
        $hapus = mysqli_query($koneksi, $sql_hapus);
        
        if($hapus){
            if($_GET['aksi'] == 'delete'){
                echo "<script>
                        alert('data berhasil dihapus!');
                        document.location.href = 'index.php';
                    </script>";
            }
        }
    }
}
// --- Tutup Fungsi Delete
// ===================================================================
// --- Program Utama
if (isset($_GET['aksi'])){
    switch($_GET['aksi']){
        case "create":
            echo '<a href="index.php"> &laquo; Home</a>';
            tambah($koneksi);
            break;
        case "read":
            tampil_data($koneksi);
            break;
        case "update":
            ubah($koneksi);
            tampil_data($koneksi);
            break;
        case "delete":
            hapus($koneksi);
            break;
        default:
            echo "<h3>Aksi <i>".$_GET['aksi']."</i> tidaka ada!</h3>";
            tambah($koneksi);
            tampil_data($koneksi);
    }
} else {
        tambah($koneksi);
        ubah($koneksi);
        tampil_data($koneksi);
    }
?>
</body>
</html>