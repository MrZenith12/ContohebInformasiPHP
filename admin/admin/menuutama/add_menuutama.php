<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fa fa-edit"></i> Tambah Data Menu Utama
        </h3>
    </div>
    <!-- /.card-header -->
    <form action="" method="post">
        <div class="card-body">
            <div class="form-group">
                <label for="nama_menuutama">Nama Menu Utama</label>
                <input type="text" class="form-control" id="nama_menuutama" name="nama_menuutama" placeholder="Nama Menu Utama" required>
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="Aktif">Aktif</option>
                    <option value="Tidak Aktif">Tidak Aktif</option>
                </select>
            </div>
            <div class="form-group">
                <label for="urutan">Urutan</label>
                <input type="number" class="form-control" id="urutan" name="urutan" placeholder="Urutan" required>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" name="Simpan" class="btn btn-primary">
                <i class="fa fa-save"></i> Simpan
            </button>
            <a href="?page=data-menuutama" class="btn btn-secondary">
                <i class="fa fa-arrow-left"></i> Kembali
            </a>
        </div>
    </form>
</div>
<?php
// Cek apakah form telah disubmit
if (isset($_POST['Simpan'])) {
    // Baca data dari formulir
    $nama_menuutama = $_POST['nama_menuutama'];
    $status = $_POST['status'];
    $urutan = $_POST['urutan'];

    // Pastikan koneksi berhasil
    if (!$koneksi) {
        die("Koneksi database gagal: " . mysqli_connect_error());
    }

    // Query SQL untuk menambahkan data
    $sql_tambah = "INSERT INTO tbl_menuutama (nama_menuutama, status, urutan) VALUES (
        '$nama_menuutama',
        '$status',
        '$urutan'
    )";

    // Eksekusi query
    $query_tambah = mysqli_query($koneksi, $sql_tambah);

    if ($query_tambah) {
        // Data berhasil ditambahkan, lakukan tindakan lanjutan jika diperlukan
        echo "<script>
            Swal.fire({title: 'Tambah Data Berhasil', text: '', icon: 'success', confirmButtonText: 'OK'
            }).then((result) => {
                if (result.value) {
                    window.location = 'index.php?page=data-menuutama';
                }
            })</script>";
    } else {
        // Data gagal ditambahkan, tampilkan pesan error jika diperlukan
        echo "<script>
            Swal.fire({title: 'Tambah Data Gagal', text: '', icon: 'error', confirmButtonText: 'OK'
            }).then((result) => {
                if (result.value) {
                    window.location = 'index.php?page=add-menuutama';
                }
            })</script>";
    }

    // Tutup koneksi database
    mysqli_close($koneksi);
}
?>
