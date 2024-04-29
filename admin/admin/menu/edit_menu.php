<?php
if (isset($_GET['kode'])) {
    $kode = $_GET['kode'];
    $sql_cek = "SELECT * FROM tbl_menu WHERE id_menu='$kode'";
    $query_cek = mysqli_query($koneksi, $sql_cek);
    $data_cek = mysqli_fetch_array($query_cek, MYSQLI_ASSOC);

    if (!$data_cek) {
        // Handle jika data tidak ditemukan
        echo "<script>
            alert('Data tidak ditemukan');
            window.location.href = '?page=data-menu';
        </script>";
        exit; // Keluar dari skrip jika data tidak ditemukan
    }
}
?>

<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fa fa-edit"></i> Ubah Data Menu
        </h3>
    </div>
    <!-- /.card-header -->
    <form action="" method="post">
        <div class="card-body">
            <div class="form-group">
                <label for="id_menuutama">Pilih Menu Utama</label>
                <select class="form-control" id="id_menuutama" name="id_menuutama" required>
                    <option value="">Pilih Menu Utama</option>
                    <?php
                    // Query SQL untuk mengambil data dari tbl_menuutama
                    $sql_menuutama = "SELECT * FROM tbl_menuutama";
                    $query_menuutama = mysqli_query($koneksi, $sql_menuutama);

                    while ($data_menuutama = mysqli_fetch_assoc($query_menuutama)) {
                        $selected = ($data_menuutama['id_menuutama'] == $data_cek['id_menuutama']) ? 'selected' : '';
                        echo "<option value='" . $data_menuutama['id_menuutama'] . "' $selected>" . $data_menuutama['nama_menuutama'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="nama_menu">Nama Menu</label>
                <input type="text" class="form-control" id="nama_menu" name="nama_menu" value="<?php echo $data_cek['nama_menu']; ?>" required>
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
            <input type="hidden" name="id_menu" value="<?php echo $kode; ?>">
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
    $id_menu = $_POST['id_menu']; // Gunakan id_menu untuk tabel tbl_menu
    $id_menuutama = $_POST['id_menuutama']; // Gunakan id_menuutama untuk tabel tbl_menuutama
    $nama_menu = $_POST['nama_menu'];
    $status = $_POST['status'];
    $urutan = $_POST['urutan'];

    // Query SQL untuk mengupdate data pada tabel tbl_menu
    $sql_update_menu = "UPDATE tbl_menu SET 
        id_menuutama = '$id_menuutama',
        nama_menu = '$nama_menu',
        status = '$status',
        urutan = '$urutan'
        WHERE id_menu = '$id_menu'";

    // Eksekusi query update untuk tabel tbl_menu
    $query_update_menu = mysqli_query($koneksi, $sql_update_menu);

    if ($query_update_menu) {
        // Data pada tabel tbl_menu berhasil diperbarui, alihkan kembali ke halaman data-menu
        echo "<script>
        Swal.fire({title: 'Ubah Data Berhasil', text: '', icon: 'success', confirmButtonText: 'OK'
        }).then((result) => {
            if (result.value) {
                window.location = 'index.php?page=data-menu';
            }
        })</script>";
    } else {
        // Data pada tabel tbl_menu gagal diperbarui, tampilkan pesan error
        echo "<script>
        Swal.fire({title: 'Ubah Data Gagal', text: '', icon: 'error', confirmButtonText: 'OK'
        }).then((result) => {
            if (result.value) {
                window.location = 'index.php?page=data-menu';
            }
        })</script>";
    }
}
?>