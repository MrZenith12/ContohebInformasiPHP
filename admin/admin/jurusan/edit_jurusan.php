<?php
if (isset($_GET['kode'])) {
    $kode = $_GET['kode'];
    $sql_cek = "SELECT * FROM tbl_jurusan WHERE id_jurusan='$kode'";
    $query_cek = mysqli_query($koneksi, $sql_cek);
    $data_cek = mysqli_fetch_array($query_cek, MYSQLI_ASSOC);

    if (!$data_cek) {
        // Handle jika data tidak ditemukan
        echo "<script>
            alert('Data tidak ditemukan');
            window.location.href = '?page=data-jurusan';
        </script>";
        exit; // Keluar dari skrip jika data tidak ditemukan
    }
}
?>

<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fa fa-edit"></i> Ubah Data Jurusan
        </h3>
    </div>
    <!-- /.card-header -->
    <form action="" method="post" enctype="multipart/form-data">
        <div class="card-body">
            <div class="form-group">
                <label for="namajurusan">Nama Jurusan</label>
                <input type="text" class="form-control" id="namajurusan" name="namajurusan" value="<?php echo $data_cek['namajurusan']; ?>" required>
            </div>
            <div class="form-group">
                <label for="jumlah_siswa">Jumlah Siswa</label>
                <input type="number" class="form-control" id="jumlah_siswa" name="jumlah_siswa" value="<?php echo $data_cek['jumlah_siswa']; ?>" required>
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="Aktif" <?php if ($data_cek['status'] == 'Aktif') echo 'selected'; ?>>Aktif</option>
                    <option value="Tidak Aktif" <?php if ($data_cek['status'] == 'Tidak Aktif') echo 'selected'; ?>>Tidak Aktif</option>
                </select>
            </div>
            <div class="form-group">
                <label for="gambar">Gambar Jurusan</label><br>
                <img src="foto/<?php echo $data_cek['gambar']; ?>" width="160px" alt="Gambar Jurusan" style="margin-bottom: 10px;">
                <input type="file" id="gambar" name="gambar">
                <p class="help-block">
                    <font color="red">"Format file Jpg/Png"</font>
                </p>
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"><?php echo $data_cek['deskripsi']; ?></textarea>
            </div>
        </div>
        <div class="card-footer">
            <input type="hidden" name="id_jurusan" value="<?php echo $kode; ?>">
            <button type="submit" name="SimpanEdit" class="btn btn-primary">
                <i class="fa fa-save"></i> Simpan Perubahan
            </button>
            <a href="?page=data-menu" class="btn btn-secondary">
                <i class="fa fa-arrow-left"></i> Kembali
            </a>
        </div>
    </form>
</div>

<?php
if (isset($_POST['SimpanEdit'])) {
    // Ambil data yang dikirimkan melalui formulir
    $id_jurusan = $_POST['id_jurusan']; // Gunakan id_jurusan untuk tabel tbl_jurusan
    $namajurusan = $_POST['namajurusan'];
    $jumlah_siswa = $_POST['jumlah_siswa'];
    $status = $_POST['status'];
    $deskripsi = $_POST['deskripsi'];

    // Handle gambar
    $gambar = @$_FILES['gambar']['name'];
    $sumber = @$_FILES['gambar']['tmp_name'];
    $target = 'foto/';

    // Hapus gambar lama jika ada
    if (!empty($gambar)) {
        $gambar_lama = $data_cek['gambar'];
        if (file_exists("foto/$gambar_lama")) {
            unlink("foto/$gambar_lama");
        }
        move_uploaded_file($sumber, $target . $gambar);
    } else {
        $gambar = $data_cek['gambar'];
    }

    // Query SQL untuk mengupdate data pada tabel tbl_jurusan
    $sql_update_jurusan = "UPDATE tbl_jurusan SET 
        namajurusan = '$namajurusan',
        jumlah_siswa = '$jumlah_siswa',
        status = '$status',
        deskripsi = '$deskripsi',
        gambar = '$gambar'
        WHERE id_jurusan = '$id_jurusan'";

    // Eksekusi query update untuk tabel tbl_jurusan
    $query_update_jurusan = mysqli_query($koneksi, $sql_update_jurusan);

    if ($query_update_jurusan) {
        // Data pada tabel tbl_jurusan berhasil diperbarui, alihkan kembali ke halaman data-menu
        echo "<script>
        Swal.fire({title: 'Ubah Data Berhasil', text: '', icon: 'success', confirmButtonText: 'OK'
        }).then((result) => {
            if (result.value) {
                window.location = 'index.php?page=data-jurusan';
            }
        })</script>";
    } else {
        // Data pada tabel tbl_jurusan gagal diperbarui, tampilkan pesan error
        echo "<script>
        Swal.fire({title: 'Ubah Data Gagal', text: '', icon: 'error', confirmButtonText: 'OK'
        }).then((result) => {
            if (result.value) {
                window.location = 'index.php?page=data-jurusan';
            }
        })</script>";
    }
}
?>