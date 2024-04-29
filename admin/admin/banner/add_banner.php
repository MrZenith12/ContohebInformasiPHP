<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fa fa-edit"></i> Tambah Data</h3>
    </div>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="card-body">

            <div class="form-group">
                <label class="col-sm-2 col-form-label">Judul Banner</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="judul_banner" name="judul_banner" placeholder="Judul Banner" required>
                </div>
            </div>
            <div class="form-group">
                <label for="status" class="col-sm-2 col-form-label">Status</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="Aktif">Aktif</option>
                    <option value="Tidak Aktif">Tidak Aktif</option>
                </select>
            </div>
            <div class="form-group">
                <label for="urutan" class="col-sm-2 col-form-label">Urutan</label>
                <input type="number" class="form-control" id="urutan" name="urutan" placeholder="Urutan" required>
            </div>
            <div class="form-group">
                <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Keterangan" required>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 col-form-label">File Gambar/Video (JPG/PNG/MP4)</label>
                <div class="col-sm-6">
                    <input type="file" id="gambar" name="gambar" accept=".jpg, .png, .mp4">
                    <p class="help-block">
                        <font color="red">Format file JPG, JPEG, PNG, & MP4</font>
                    </p>
                </div>
            </div>

        </div>
        <div class="card-footer">
            <input type="submit" name="Simpan" value="Simpan" class="btn btn-info">
            <a href="?page=data-banner" title="Kembali" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>

<?php
$file_sumber = @$_FILES['gambar']['tmp_name']; // Mengganti 'gambar' menjadi 'gambar'
$target_directory = 'foto/'; // Ganti dengan direktori tempat file gambar akan disimpan
$file_name = @$_FILES['gambar']['name']; // Mengganti 'gambar' menjadi 'gambar'

// Periksa ekstensi file
$ekstensi = pathinfo($file_name, PATHINFO_EXTENSION);

if (isset($_POST['Simpan'])) {
    if (!empty($file_sumber) && in_array($ekstensi, array('jpg', 'jpeg', 'png', 'mp4'))) { // Menambahkan 'mp4' ke dalam array ekstensi yang diterima
        // Koneksi ke database (pastikan ini sudah ada di kode Anda)
        $koneksi = mysqli_connect("localhost", "root", "", "db_portalberita");

        // Pastikan koneksi berhasil
        if (!$koneksi) {
            die("Koneksi database gagal: " . mysqli_connect_error());
        }

        $judul_banner = $_POST['judul_banner'];
        $status = $_POST['status'];
        $urutan = $_POST['urutan'];
        $keterangan = $_POST['keterangan']; // Menggunakan 'keterangan' sebagai nama kolom

        $sql_simpan = "INSERT INTO tbl_banner (judul_banner, status, urutan, keterangan, gambar) VALUES (
            '$judul_banner',
            '$status',
            '$urutan',
            '$keterangan',
            '$file_name')";

        $query_simpan = mysqli_query($koneksi, $sql_simpan);

        if ($query_simpan) {
            move_uploaded_file($file_sumber, $target_directory . $file_name); // Pindahkan file gambar ke direktori target
            echo "<script>
            Swal.fire({title: 'Tambah Data Berhasil', text: '', icon: 'success', confirmButtonText: 'OK'
            }).then((result) => {
                if (result.value) {
                    window.location = 'index.php?page=data-banner';
                }
            })</script>";
        } else {
            echo "<script>
            Swal.fire({title: 'Tambah Data Gagal', text: '', icon: 'error', confirmButtonText: 'OK'
            }).then((result) => {
                if (result.value) {
                    window.location = 'index.php?page=add-banner';
                }
            })</script>";
        }

        // Tutup koneksi database
        mysqli_close($koneksi);
    } else {
        echo "<script>
        Swal.fire({title: 'Gagal, Harap Unggah File Gambar/Video dengan Format JPG/PNG/MP4', text: '', icon: 'error', confirmButtonText: 'OK'
        }).then((result) => {
            if (result.value) {
                window.location = 'index.php?page=add-banner';
            }
        })</script>";
    }
}
// Selesai proses simpan data
?>
