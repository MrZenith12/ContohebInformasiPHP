<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fa fa-edit"></i> Tambah Data Menu
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
                        echo "<option value='" . $data_menuutama['id_menuutama'] . "'>" . $data_menuutama['nama_menuutama'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="nama_menu">Nama Menu</label>
                <input type="text" class="form-control" id="nama_menu" name="nama_menu" placeholder="Nama Menu" required>
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
            <a href="?page=data-menu" class="btn btn-secondary">
                <i class="fa fa-arrow-left"></i> Kembali
            </a>
        </div>
    </form>
</div>

<?php

if (isset($_POST['Simpan'])) {
    // Baca data dari formulir
    $nama_menu = $_POST['nama_menu'];
    $status = $_POST['status'];
    $urutan = $_POST['urutan'];
    $id_menuutama = $_POST['id_menuutama'];

    // Pastikan koneksi berhasil
    if (!$koneksi) {
        die("Koneksi database gagal: " . mysqli_connect_error());
    }

    // Query SQL untuk menambahkan data
    $sql_tambah_menu = "INSERT INTO tbl_menu (nama_menu, status, urutan, id_menuutama) VALUES (
        '$nama_menu',
        '$status',
        '$urutan',
        '$id_menuutama'
    )";

    // Eksekusi query
    $query_tambah_menu = mysqli_query($koneksi, $sql_tambah_menu);

    if ($query_tambah_menu) {
        // Data berhasil ditambahkan
        echo "<script>
            Swal.fire({title: 'Tambah Data Berhasil', text: '', icon: 'success', confirmButtonText: 'OK'
            }).then((result) => {
                if (result.value) {
                    window.location = 'index.php?page=data-menu';
                }
            })</script>";
    } else {
        // Data gagal ditambahkan
        echo "<script>
            Swal.fire({title: 'Tambah Data Gagal', text: '', icon: 'error', confirmButtonText: 'OK'
            }).then((result) => {
                if (result.value) {
                    window.location = 'index.php?page=add-menu';
                }
            })</script>";
    }

    // Tutup koneksi database
    mysqli_close($koneksi);
}

?>