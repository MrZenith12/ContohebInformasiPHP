<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fa fa-edit"></i> Tambah Data Menu
        </h3>
    </div>
    <!-- /.card-header -->
    <form action="" method="post" enctype="multipart/form-data">
        <div class="card-body">
            <div class="form-group">
                <label for="namajurusan">Nama Jurusan</label>
                <input type="text" class="form-control" id="namajurusan" name="namajurusan" placeholder="Nama Jurusan" required>
            </div>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="jumlah_siswa">Jumlah Siswa</label>
                <input type="number" class="form-control" id="jumlah_siswa" name="jumlah_siswa" placeholder="Jumlah Siswa" required>
            </div>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <input type="text" class="form-control" id="deskripsi" name="deskripsi" placeholder="Deskripsi" required>
            </div>
        </div>
        <div class="card-body">
				<label class="col-sm-2 col-form-label">Gambar Jurusan</label>
				<div class="col-sm-6">
					<input type="file" id="gambar" name="gambar">
					<p class="help-block">
						<font color="red">"Format file Jpg/Png"</font>
					</p>
				</div>
			</div>
        <div class="card-body">
            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="Aktif">Aktif</option>
                    <option value="Tidak Aktif">Tidak Aktif</option>
                </select>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" name="Simpan" class="btn btn-primary">
                <i class="fa fa-save"></i> Simpan
            </button>
            <a href="?page=data-jurusan" class="btn btn-secondary">
                <i class="fa fa-arrow-left"></i> Kembali
            </a>
        </div>
    </form>
</div>

<?php
$sumber = @$_FILES['gambar']['tmp_name'];
$target = 'foto/';
$judul_berita_file = @$_FILES['gambar']['name'];
$pindah = move_uploaded_file($sumber, $target.$judul_berita_file);

if (isset($_POST['Simpan'])) {
    if (!empty($sumber)) {
        $sql_simpan = "INSERT INTO tbl_jurusan (namajurusan, jumlah_siswa, status, deskripsi, gambar) VALUES (
            '" . $_POST['namajurusan'] . "',
            '" . $_POST['jumlah_siswa'] . "',
			'" . $_POST['status'] . "',
            '" . $_POST['deskripsi'] . "',
            '" . $judul_berita_file . "')";
        $query_simpan = mysqli_query($koneksi, $sql_simpan);
        mysqli_close($koneksi);

        if ($query_simpan) {
            echo "<script>
            Swal.fire({title: 'Tambah Data Berhasil', text: '', icon: 'success', confirmButtonText: 'OK'
            }).then((result) => {
                if (result.value) {
                    window.location = 'index.php?page=data-jurusan';
                }
            })</script>";
        } else {
            echo "<script>
            Swal.fire({title: 'Tambah Data Gagal', text: '', icon: 'error', confirmButtonText: 'OK'
            }).then((result) => {
                if (result.value) {
                    window.location = 'index.php?page=add-jurusan';
                }
            })</script>";
        }
    } else {
        echo "<script>
        Swal.fire({title: 'Gagal, Foto Wajib Diisi', text: '', icon: 'error', confirmButtonText: 'OK'
        }).then((result) => {
            if (result.value) {
                window.location = 'index.php?page=add-jurusan';
            }
        })</script>";
    }
}
//selesai proses simpan data
?>