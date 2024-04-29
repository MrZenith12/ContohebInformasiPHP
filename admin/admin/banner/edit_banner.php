<?php
if(isset($_GET['kode'])){
    $sql_cek = "SELECT * FROM tbl_banner WHERE id_banner='".$_GET['kode']."'";
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
                    <input type="hidden" class="form-control" id="id_banner" name="id_banner" value="<?php echo $data_cek['id_banner']; ?>" readonly/>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 col-form-label">Judul Banner</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="judul_banner" name="judul_banner" value="<?php echo $data_cek['judul_banner']; ?>"/>
                </div>
            </div>

            <div class="form-group">
                <label for="status" class="col-sm-2 col-form-label">Status</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="Aktif" <?php if ($data_cek['status'] == 'Aktif') echo 'selected'; ?>>Aktif</option>
                    <option value="Tidak Aktif" <?php if ($data_cek['status'] == 'Tidak Aktif') echo 'selected'; ?>>Tidak Aktif</option>
                </select>
            </div>

            <div class="form-group">
                <label class="col-sm-2 col-form-label">Keterangan</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="keterangan" name="keterangan" value="<?php echo $data_cek['keterangan']; ?>"/>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 col-form-label">Media</label>
                <div class="col-sm-6">
                    <?php
                    $gambar = $data_cek['gambar'];
                    $ekstensi = pathinfo($gambar, PATHINFO_EXTENSION);

                    if ($ekstensi === 'jpg' || $ekstensi === 'jpeg' || $ekstensi === 'png') {
                        // Tampilkan gambar jika ekstensi adalah JPG, JPEG, atau PNG
                        echo '<img src="foto/' . $gambar . '" width="160px" />';
                    }elseif ($ekstensi === 'mp4') {
                        // Tampilkan video jika ekstensi adalah MP4
                        echo '<video width="150" height="100" controls>';
                        echo '<source src="foto/' . $gambar . '" type="video/mp4">';
                        echo 'Your browser does not support the video tag.';
                        echo '</video>';
                    }
                    ?>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 col-form-label">Ubah Media</label>
                <div class="col-sm-6">
                    <input type="file" id="gambar" name="gambar" accept=".jpg, .jpeg, .png, .mp4">
                    <p class="help-block">
                        <font color="red">Format file JPG, JPEG, PNG & mp4</font>
                    </p>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <input type="submit" name="Ubah" value="Simpan" class="btn btn-success">
            <a href="?page=data-banner" title="Kembali" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>

<?php
$sumber = @$_FILES['gambar']['tmp_name'];
$target = 'foto/';
$nama_file = @$_FILES['gambar']['name'];

if (isset($_POST['Ubah'])) {
    if (!empty($sumber)) {
        $gambar = $data_cek['gambar'];
        $ekstensi = pathinfo($gambar, PATHINFO_EXTENSION);

        if ($ekstensi === 'jpg' || $ekstensi === 'jpeg' || $ekstensi === 'png' || $ekstensi === 'mp4') {
            // Hapus gambar lama jika ekstensinya adalah JPG, JPEG, atau PNG
            if (file_exists("foto/$gambar")) {
                unlink("foto/$gambar");
            }

            $pindah = move_uploaded_file($sumber, $target . $nama_file);

            $sql_ubah = "UPDATE tbl_banner SET
                judul_banner='" . $_POST['judul_banner'] . "',
                status='" . $_POST['status'] . "',
                keterangan='" . $_POST['keterangan'] . "',
                gambar='" . $nama_file . "'
                WHERE id_banner='" . $_POST['id_banner'] . "'";
            $query_ubah = mysqli_query($koneksi, $sql_ubah);
        } else {
            echo "<script>
            Swal.fire({title: 'Format File Tidak Dikenali', text: '', icon: 'error', confirmButtonText: 'OK'
            }).then((result) => {
                if (result.value) {
                    window.location = 'index.php?page=data-banner';
                }
            })</script>";
        }
    } elseif (empty($sumber)) {
        $sql_ubah = "UPDATE tbl_banner SET
            judul_banner='" . $_POST['judul_banner'] . "',
            status='" . $_POST['status'] . "',
            keterangan='" . $_POST['keterangan'] . "'
            WHERE id_banner='" . $_POST['id_banner'] . "'";
        $query_ubah = mysqli_query($koneksi, $sql_ubah);
    }

    if ($query_ubah) {
        echo "<script>
        Swal.fire({title: 'Ubah Data Berhasil', text: '', icon: 'success', confirmButtonText: 'OK'
        }).then((result) => {
            if (result.value) {
                window.location = 'index.php?page=data-banner';
            }
        })</script>";
    } else {
        echo "<script>
        Swal.fire({title: 'Ubah Data Gagal', text: '', icon: 'error', confirmButtonText: 'OK'
        }).then((result) => {
            if (result.value) {
                window.location = 'index.php?page=data-banner';
            }
        })</script>";
    }
}
?>