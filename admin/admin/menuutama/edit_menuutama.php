<?php
if(isset($_GET['kode'])){
    $sql_cek = "SELECT * FROM tbl_menuutama WHERE id_menuutama='".$_GET['kode']."'";
    $query_cek = mysqli_query($koneksi, $sql_cek);
    $data_cek = mysqli_fetch_array($query_cek, MYSQLI_BOTH);
}
?>

<div class="card card-success">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fa fa-edit"></i> Ubah Data</h3>
    </div>
    <form action="" method="post">
        <div class="card-body">
            <input type="hidden" name="id_menuutama" value="<?php echo $data_cek['id_menuutama']; ?>">
            <div class="form-group">
                <label for="nama_menuutama">Nama Menu Utama</label>
                <input type="text" class="form-control" id="nama_menuutama" name="nama_menuutama" value="<?php echo $data_cek['nama_menuutama']; ?>" required>
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="Aktif" <?php if ($data_cek['status'] == 'Aktif') echo 'selected'; ?>>Aktif</option>
                    <option value="Tidak Aktif" <?php if ($data_cek['status'] == 'Tidak Aktif') echo 'selected'; ?>>Tidak Aktif</option>
                </select>
            </div>
            <div class="form-group">
                <label for="urutan">Urutan</label>
                <input type="number" class="form-control" id="urutan" name="urutan" value="<?php echo $data_cek['urutan']; ?>" required>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" name="SimpanEdit" class="btn btn-primary">
                <i class="fa fa-save"></i> Simpan Perubahan
            </button>
            <a href="?page=data-menuutama" class="btn btn-secondary">
                <i class="fa fa-arrow-left"></i> Kembali
            </a>
        </div>
    </form>
</div>

<?php
if (isset($_POST['SimpanEdit'])) {
    // Ambil data yang dikirimkan melalui formulir
    $id_menuutama = $_POST['id_menuutama'];
    $nama_menuutama = $_POST['nama_menuutama'];
    $status = $_POST['status'];
    $urutan = $_POST['urutan'];

    // Pastikan koneksi berhasil
    if (!$koneksi) {
        die("Koneksi database gagal: " . mysqli_connect_error());
    }

    // Query SQL untuk mengupdate data
    $sql_update = "UPDATE tbl_menuutama SET 
        nama_menuutama = '$nama_menuutama',
        status = '$status',
        urutan = '$urutan'
        WHERE id_menuutama = $id_menuutama";

    // Eksekusi query
    $query_update = mysqli_query($koneksi, $sql_update);

    if ($query_update) {
        // Data berhasil diperbarui, lakukan tindakan lanjutan jika diperlukan
        echo "<script>
        Swal.fire({title: 'Ubah Data Berhasil', text: '', icon: 'success', confirmButtonText: 'OK'
        }).then((result) => {
            if (result.value) {
                window.location = 'index.php?page=data-menuutama';
            }
        })</script>";
    } else {
        // Data gagal diperbarui, tampilkan pesan error jika diperlukan
        echo "<script>
        Swal.fire({title: 'Ubah Data Gagal', text: '', icon: 'error', confirmButtonText: 'OK'
        }).then((result) => {
            if (result.value) {
                window.location = 'index.php?page=data-menuutama';
            }
        })</script>";
    }

    // Tutup koneksi database
    mysqli_close($koneksi);
}
?>
