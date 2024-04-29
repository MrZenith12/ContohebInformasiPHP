<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fa fa-edit"></i> Tambah Data
        </h3>
    </div>
    <form action="" method="post">
        <div class="card-body">
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Judul Berita</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="judul_berita" name="judul_berita" placeholder="Judul Berita" required>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Deskripsi</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="deskripsi" name="deskripsi" placeholder="Deskripsi" required>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Tautan Video YouTube</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="gambar" name="gambar" placeholder="Tautan Video YouTube" required>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <input type="submit" name="Simpan" value="Simpan" class="btn btn-info">
            <a href="?page=data-beritamp" title="Kembali" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
<?php

if (isset($_POST['Simpan'])) {
    $judul_berita = mysqli_real_escape_string($koneksi, $_POST['judul_berita']);
    $deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);
    $gambar = mysqli_real_escape_string($koneksi, $_POST['gambar']);

    // Query untuk menyimpan data ke database
    $sql_simpan = "INSERT INTO tbl_berita (judul_berita, deskripsi, gambar) VALUES (
        '$judul_berita',
        '$deskripsi',
        '$gambar')";
    $query_simpan = mysqli_query($koneksi, $sql_simpan);

    if ($query_simpan) {
        echo "<script>
            Swal.fire({title: 'Tambah Data Berhasil', text: '', icon: 'success', confirmButtonText: 'OK'
            }).then((result) => {
                if (result.value) {
                    window.location = 'index.php?page=data-beritamp';
                }
            })</script>";
    } else {
        echo "<script>
            Swal.fire({title: 'Tambah Data Gagal', text: '', icon: 'error', confirmButtonText: 'OK'
            }).then((result) => {
                if (result.value) {
                    window.location = 'index.php?page=add-beritamp';
                }
            })</script>";
    }
}

// Selesai proses simpan data

// Tutup koneksi database
mysqli_close($koneksi);
?>
