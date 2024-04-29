<?php
if(isset($_GET['kode'])){
    $sql_cek = "SELECT * FROM tbl_berita WHERE id_berita='".$_GET['kode']."'";
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
                    <input type="hidden" class="form-control" id="id_berita" name="id_berita" value="<?php echo $data_cek['id_berita']; ?>" readonly/>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Judul Berita</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="judul_berita" name="judul_berita" value="<?php echo $data_cek['judul_berita']; ?>"/>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Deskripsi</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="deskripsi" name="deskripsi" value="<?php echo $data_cek['deskripsi']; ?>"/>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Media</label>
                <div class="col-sm-6">
                    <?php
                    $gambar = $data_cek['gambar_berita'];
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
                    <input type="file" id="gambar_berita" name="gambar_berita" accept=".jpg, .jpeg, .png">
                    <p class="help-block">
                        <font color="red">Format file JPG, JPEG & PNG</font>
                    </p>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <input type="submit" name="Ubah" value="Simpan" class="btn btn-success">
            <a href="?page=data-berita" title="Kembali" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>

<?php
$sumber = @$_FILES['gambar_berita']['tmp_name'];
$target = 'foto/';
$nama_file = @$_FILES['gambar_berita']['name'];

if (isset($_POST['Ubah'])) {
    if (!empty($sumber)) {
        $gambar = $data_cek['gambar_berita'];
        $ekstensi = pathinfo($gambar, PATHINFO_EXTENSION);

        if ($ekstensi === 'jpg' || $ekstensi === 'jpeg' || $ekstensi === 'png') {
            // Hapus gambar lama jika ekstensinya adalah JPG, JPEG, atau PNG
            if (file_exists("foto/$gambar")) {
                unlink("foto/$gambar");
            }

            $pindah = move_uploaded_file($sumber, $target . $nama_file);

            $sql_ubah = "UPDATE tbl_berita SET
                judul_berita='" . $_POST['judul_berita'] . "',
                deskripsi='" . $_POST['deskripsi'] . "',
                gambar_berita ='" . $nama_file . "'
                WHERE id_berita='" . $_POST['id_berita'] . "'";
            $query_ubah = mysqli_query($koneksi, $sql_ubah);
        } else {
            echo "<script>
            Swal.fire({title: 'Format File Tidak Dikenali', text: '', icon: 'error', confirmButtonText: 'OK'
            }).then((result) => {
                if (result.value) {
                    window.location = 'index.php?page=data-beritaimg';
                }
            })</script>";
        }
    } elseif (empty($sumber)) {
        $sql_ubah = "UPDATE tbl_berita SET
            judul_berita='" . $_POST['judul_berita'] . "',
            deskripsi='" . $_POST['deskripsi'] . "'
            WHERE id_berita='" . $_POST['id_berita'] . "'";
        $query_ubah = mysqli_query($koneksi, $sql_ubah);
    }

    if ($query_ubah) {
        echo "<script>
        Swal.fire({title: 'Ubah Data Berhasil', text: '', icon: 'success', confirmButtonText: 'OK'
        }).then((result) => {
            if (result.value) {
                window.location = 'index.php?page=data-beritaimg';
            }
        })</script>";
    } else {
        echo "<script>
        Swal.fire({title: 'Ubah Data Gagal', text: '', icon: 'error', confirmButtonText: 'OK'
        }).then((result) => {
            if (result.value) {
                window.location = 'index.php?page=data-beritaimg';
            }
        })</script>";
    }
}
?>