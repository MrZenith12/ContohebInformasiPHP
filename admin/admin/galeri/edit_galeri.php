<?php
if(isset($_GET['kode'])){
    $sql_cek = "SELECT * FROM tbl_galeri WHERE id_galeri='".$_GET['kode']."'";
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
                    <input type="hidden" class="form-control" id="id_galeri" name="id_galeri" value="<?php echo $data_cek['id_galeri']; ?>" readonly/>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Judul Galeri</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="judul_galeri" name="judul_galeri" value="<?php echo $data_cek['judul_galeri']; ?>"/>
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
                    $image = $data_cek['image'];
                    $ekstensi = pathinfo($image, PATHINFO_EXTENSION);

                    if ($ekstensi === 'jpg' || $ekstensi === 'jpeg' || $ekstensi === 'png') {
                        // Tampilkan image jika ekstensi adalah JPG, JPEG, atau PNG
                        echo '<img src="foto/' . $image . '" width="160px" />';
                    }
                    ?>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Ubah Media</label>
                <div class="col-sm-6">
                    <input type="file" id="image" name="image" accept=".jpg, .jpeg, .png">
                    <p class="help-block">
                        <font color="red">Format file JPG, JPEG & PNG</font>
                    </p>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <input type="submit" name="Ubah" value="Simpan" class="btn btn-success">
            <a href="?page=data-galeri" title="Kembali" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>

<?php
$sumber = @$_FILES['image']['tmp_name'];
$target = 'foto/';
$nama_file = @$_FILES['image']['name'];

if (isset($_POST['Ubah'])) {
    if (!empty($sumber)) {
        $image = $data_cek['image'];
        $ekstensi = pathinfo($image, PATHINFO_EXTENSION);

        if ($ekstensi === 'jpg' || $ekstensi === 'jpeg' || $ekstensi === 'png') {
            // Hapus image lama jika ekstensinya adalah JPG, JPEG, atau PNG
            if (file_exists("foto/$image")) {
                unlink("foto/$image");
            }

            $pindah = move_uploaded_file($sumber, $target . $nama_file);

            $sql_ubah = "UPDATE tbl_galeri SET
                judul_galeri='" . $_POST['judul_galeri'] . "',
                deskripsi='" . $_POST['deskripsi'] . "',
                image='" . $nama_file . "'
                WHERE id_galeri='" . $_POST['id_galeri'] . "'";
            $query_ubah = mysqli_query($koneksi, $sql_ubah);
        } else {
            echo "<script>
            Swal.fire({title: 'Format File Tidak Dikenali', text: '', icon: 'error', confirmButtonText: 'OK'
            }).then((result) => {
                if (result.value) {
                    window.location = 'index.php?page=data-galeri';
                }
            })</script>";
        }
    } elseif (empty($sumber)) {
        $sql_ubah = "UPDATE tbl_galeri SET
            judul_galeri='" . $_POST['judul_galeri'] . "',
            deskripsi='" . $_POST['deskripsi'] . "'
            WHERE id_galeri='" . $_POST['id_galeri'] . "'";
        $query_ubah = mysqli_query($koneksi, $sql_ubah);
    }

    if ($query_ubah) {
        echo "<script>
        Swal.fire({title: 'Ubah Data Berhasil', text: '', icon: 'success', confirmButtonText: 'OK'
        }).then((result) => {
            if (result.value) {
                window.location = 'index.php?page=data-galeri';
            }
        })</script>";
    } else {
        echo "<script>
        Swal.fire({title: 'Ubah Data Gagal', text: '', icon: 'error', confirmButtonText: 'OK'
        }).then((result) => {
            if (result.value) {
                window.location = 'index.php?page=data-galeri';
            }
        })</script>";
    }
}
?>