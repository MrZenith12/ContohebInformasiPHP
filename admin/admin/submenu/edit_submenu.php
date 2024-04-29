<?php
if (isset($_GET['kode'])) {
    $kode = $_GET['kode'];
    $sql_cek = "SELECT * FROM tbl_submenu WHERE id_submenu='$kode'";
    $query_cek = mysqli_query($koneksi, $sql_cek);
    $data_cek = mysqli_fetch_array($query_cek, MYSQLI_ASSOC);

    if (!$data_cek) {
        // Handle jika data tidak ditemukan
        echo "<script>
            alert('Data tidak ditemukan');
            window.location.href = '?page=data-submenu';
        </script>";
        exit; // Keluar dari skrip jika data tidak ditemukan
    }
}
?>

<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fa fa-edit"></i> Ubah Data SubMenu
        </h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <form action="" method="post">
            <div class="form-group">
                <label for="id_menu">Pilih Menu</label>
                <select class="form-control" id="id_menu" name="id_menu" required>
                    <option value="">Pilih Menu Utama</option>
                    <?php
                    // Query SQL untuk mengambil data dari tbl_menu
                    $sql_menu = "SELECT * FROM tbl_menu";
                    $query_menu = mysqli_query($koneksi, $sql_menu);

                    while ($data_menu = mysqli_fetch_assoc($query_menu)) {
                        $selected = ($data_menu['id_menu'] == $data_cek['id_menu']) ? 'selected' : '';
                        echo "<option value='" . $data_menu['id_menu'] . "' $selected>" . $data_menu['nama_menu'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="nama_submenu">Nama SubMenu</label>
                <input type="text" class="form-control" id="nama_submenu" name="nama_submenu" value="<?php echo $data_cek['nama_submenu']; ?>" required>
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
            <div class="form-group">
                <label for="isi">Isi Konten</label>
                <textarea name="isi" id="isi"><?php echo $data_cek['isi']; ?></textarea>
            </div>
            <div class="form-group">
                <label class="col-sm-2 col-form-label">File Gambar</label>
                <div class="col-sm-6">
                    <input type="file" id="gambar" name="gambar" accept=".jpg, .png">
                </div>
            </div>
            <div class="card-footer">
                <input type="hidden" name="id_submenu" value="<?php echo $data_cek['id_submenu']; ?>">
                <button type="submit" name="SimpanEdit" class="btn btn-primary">
                    <i class="fa fa-save"></i> Simpan Perubahan
                </button>
                <a href="?page=data-menu" class="btn btn-secondary">
                    <i class="fa fa-arrow-left"></i> Kembali
                </a>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.tiny.cloud/1/7z31gctppnzbjvmolgazesznc2evcvl8xy9il1du6y4gajak/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: 'textarea',
        plugins: 'advlist autolink lists link image charmap print preview anchor',
        toolbar: 'undo redo | formatselect | ' +
            'bold italic backcolor | alignleft aligncenter ' +
            'alignright alignjustify | bullist numlist outdent indent | ' +
            'removeformat | link image',
    });
</script>

<?php
if (isset($_POST['SimpanEdit'])) {
    // Ambil data yang dikirimkan melalui formulir
    $id_submenu = $data_cek['id_submenu']; // Gunakan id_submenu untuk tabel tbl_submenu
    $id_menu = $_POST['id_menu'];
    $nama_submenu = $_POST['nama_submenu'];
    $status = $_POST['status'];
    $urutan = $_POST['urutan'];
    $isi = $_POST['isi'];

    // Cek apakah gambar baru diunggah
    if ($_FILES['gambar']['error'] === 0) {
        // Hapus gambar lama (jika ada)
        $gambarLama = $data_cek['gambar']; // Nama gambar lama dari database
        if (file_exists('path/to/your/directory/' . $gambarLama)) {
            unlink('path/to/your/directory/' . $gambarLama);
        }

        // Simpan gambar yang baru diunggah
        $gambarBaru = $_FILES['gambar']['name'];
        $gambarTmp = $_FILES['gambar']['tmp_name'];
        move_uploaded_file($gambarTmp, 'path/to/your/directory/' . $gambarBaru);

        // Update nama gambar di database
        $sql_update_submenu = "UPDATE tbl_submenu SET 
            id_menu = '$id_menu',
            nama_submenu = '$nama_submenu',
            status = '$status',
            urutan = '$urutan',
            isi = '$isi',
            gambar = '$gambarBaru' 
            WHERE id_submenu = '$id_submenu'";
    } else {
        // Jika gambar tidak diubah, hanya perbarui data lainnya
        $sql_update_submenu = "UPDATE tbl_submenu SET 
            id_menu = '$id_menu',
            nama_submenu = '$nama_submenu',
            status = '$status',
            urutan = '$urutan',
            isi = '$isi'
            WHERE id_submenu = '$id_submenu'";
    }

    // Eksekusi query update untuk tabel tbl_submenu
    $query_update_submenu = mysqli_query($koneksi, $sql_update_submenu);

    if ($query_update_submenu) {
        // Data pada tabel tbl_submenu berhasil diperbarui, alihkan kembali ke halaman data-submenu
        echo "<script>
        Swal.fire({title: 'Ubah Data Berhasil', text: '', icon: 'success', confirmButtonText: 'OK'
        }).then((result) => {
            if (result.value) {
                window.location = 'index.php?page=data-submenu';
            }
        })</script>";
    } else {
        // Data pada tabel tbl_submenu gagal diperbarui, tampilkan pesan error
        echo "<script>
        Swal.fire({title: 'Ubah Data Gagal', text: '', icon: 'error', confirmButtonText: 'OK'
        }).then((result) => {
            if (result.value) {
                window.location = 'index.php?page=data-submenu';
            }
        })</script>";
    }
}
?>
