<?php
if(isset($_GET['kode'])){
    $sql_cek = "SELECT * FROM tbl_siswa WHERE id_siswa='".$_GET['kode']."'";
    $query_cek = mysqli_query($koneksi, $sql_cek);
    $data_cek = mysqli_fetch_array($query_cek, MYSQLI_BOTH);
}
?>

<div class="card card-success">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fa fa-edit"></i> Ubah Data</h3>
    </div>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="card-body">

            <div class="form-group row">
                <div class="col-sm-5">
                    <input type="hidden" class="form-control" id="id_siswa" name="id_siswa" value="<?php echo $data_cek['id_siswa']; ?>" readonly/>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">NISN</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="NISN" name="NISN" value="<?php echo $data_cek['NISN']; ?>"/>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nama Siswa</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nama_siswa" name="nama_siswa" value="<?php echo $data_cek['nama_siswa']; ?>"/>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Kejuruan</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="jurusan" name="jurusan" value="<?php echo $data_cek['jurusan']; ?>"/>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Media</label>
                <div class="col-sm-6">
                    <?php
                    $gambar = $data_cek['gambar'];
                    $ekstensi = pathinfo($gambar, PATHINFO_EXTENSION);

                    if ($ekstensi === 'jpg' || $ekstensi === 'jpeg' || $ekstensi === 'png') {
                        // Tampilkan gambar jika ekstensi adalah JPG, JPEG, atau PNG
                        echo '<img src="foto/' . $gambar . '" width="160px" />';
                    }
                    ?>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Ubah Media</label>
                <div class="col-sm-6">
                    <input type="file" id="gambar" name="gambar" accept=".jpg, .jpeg, .png">
                    <p class="help-block">
                        <font color="red">Format file JPG, JPEG & PNG</font>
                    </p>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <input type="submit" name="Ubah" value="Simpan" class="btn btn-success">
            <a href="?page=view-all" title="Kembali" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>

<?php
$sumber = @$_FILES['gambar']['tmp_name'];
$target = 'foto/';
$nama_file = @$_FILES['gambar']['name'];

if (isset($_POST['Ubah'])) {
    $nisn_baru = $_POST['NISN'];
    $id_siswa = $_POST['id_siswa'];

    // Mengecek apakah NISN baru yang dimasukkan sudah ada dalam database untuk siswa lain
    $sql_cek_nisn = "SELECT * FROM tbl_siswa WHERE NISN = '$nisn_baru' AND id_siswa != '$id_siswa'";
    $result_cek_nisn = mysqli_query($koneksi, $sql_cek_nisn);
    
    if (mysqli_num_rows($result_cek_nisn) > 0) {
        // Jika NISN sudah ada untuk siswa lain, tampilkan pesan kesalahan
        echo "<script>
        Swal.fire({title: 'NISN sudah digunakan oleh siswa lain', text: '', icon: 'error', confirmButtonText: 'OK'
        }).then((result) => {
            if (result.value) {
                window.location = 'index.php?page=data-siswa';
            }
        })</script>";
    } else {
        if (!empty($sumber)) {
            // Proses pengubahan dengan mengganti gambar
            $gambar = $data_cek['gambar'];
            $ekstensi = pathinfo($nama_file, PATHINFO_EXTENSION);

            if ($ekstensi === 'jpg' || $ekstensi === 'jpeg' || $ekstensi === 'png') {
                // Hapus gambar lama jika ekstensinya adalah JPG, JPEG, atau PNG
                if (file_exists("foto/$gambar")) {
                    unlink("foto/$gambar");
                }

                $pindah = move_uploaded_file($sumber, $target . $nama_file);

                $sql_ubah = "UPDATE tbl_siswa SET
                    NISN='" . $_POST['NISN'] . "',
                    nama_siswa='" . $_POST['nama_siswa'] . "',
                    jurusan='" . $_POST['jurusan'] . "',
                    gambar='" . $nama_file . "'
                    WHERE id_siswa='" . $_POST['id_siswa'] . "'";
                $query_ubah = mysqli_query($koneksi, $sql_ubah);
            } else {
                echo "<script>
                Swal.fire({title: 'Format File Tidak Dikenali', text: '', icon: 'error', confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.value) {
                        window.location = 'index.php?page=data-siswa';
                    }
                })</script>";
            }
        } else {
            // Proses pengubahan tanpa mengganti gambar
            $sql_ubah = "UPDATE tbl_siswa SET
                NISN='" . $_POST['NISN'] . "',
                nama_siswa='" . $_POST['nama_siswa'] . "',
                jurusan='" . $_POST['jurusan'] . "'
                WHERE id_siswa='" . $_POST['id_siswa'] . "'";
            $query_ubah = mysqli_query($koneksi, $sql_ubah);
        }

        if ($query_ubah) {
            // Tampilkan pesan sukses jika pengubahan berhasil
            echo "<script>
            Swal.fire({title: 'Ubah Data Berhasil', text: '', icon: 'success', confirmButtonText: 'OK'
            }).then((result) => {
                if (result.value) {
                    window.location = 'index.php?page=data-siswa';
                }
            })</script>";
        } else {
            // Tampilkan pesan kesalahan jika pengubahan gagal
            echo "<script>
            Swal.fire({title: 'Ubah Data Gagal', text: '', icon: 'error', confirmButtonText: 'OK'
            }).then((result) => {
                if (result.value) {
                    window.location = 'index.php?page=data-siswa';
                }
            })</script>";
        }
    }
}
?>