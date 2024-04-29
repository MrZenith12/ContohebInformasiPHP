<div class="card card-primary">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-edit"></i> Tambah Data</h3>
	</div>
	<form action="" method="post" enctype="multipart/form-data">
		<div class="card-body">

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">NISN</label>
				<div class="col-sm-5">
					<input type="text" class="form-control" id="NISN" name="NISN" placeholder="NISN" required>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Nama Siswa</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="nama_siswa" name="nama_siswa" placeholder="Nama Siswa" required>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Kejuruan</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="jurusan" name="jurusan" placeholder="Jurusan" required>
				</div>
			</div>
			
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Gambar Siswa</label>
				<div class="col-sm-6">
					<input type="file" id="gambar" name="gambar">
					<p class="help-block">
						<font color="red">"Format file Jpg/Png"</font>
					</p>
				</div>
			</div>

		</div>
		<div class="card-footer">
			<input type="submit" name="Simpan" value="Simpan" class="btn btn-info">
			<a href="?page=data-siswa" title="Kembali" class="btn btn-secondary">Batal</a>
		</div>
	</form>
</div>

<?php
$sumber = @$_FILES['gambar']['tmp_name'];
$target = 'foto/';
$judul_berita_file = @$_FILES['gambar']['name'];
$pindah = move_uploaded_file($sumber, $target.$judul_berita_file);

if (isset($_POST['Simpan'])) {
    // Mendapatkan NISN dari form
    $nisn = $_POST['NISN'];

    // Query untuk memeriksa apakah NISN sudah ada di database atau belum
    $query_check_nisn = "SELECT NISN FROM tbl_siswa WHERE NISN = '$nisn'";
    $result_check_nisn = mysqli_query($koneksi, $query_check_nisn);

    // Memeriksa apakah hasil query mengembalikan baris atau tidak
    if (mysqli_num_rows($result_check_nisn) > 0) {
        // Jika NISN sudah ada dalam database, tampilkan pesan kesalahan
        echo "<script>
        Swal.fire({title: 'Tambah Data Gagal', text: 'NISN sudah ada', icon: 'error', confirmButtonText: 'OK'
        }).then((result) => {
            if (result.value) {
                window.location = 'index.php?page=add-siswa';
            }
        })</script>";
    } else {
        // Jika NISN belum ada dalam database, lanjutkan proses penyimpanan data
        if (!empty($sumber)) {
            // Menyimpan nama file gambar ke dalam variabel $judul_berita_file
            $judul_berita_file = $_FILES['gambar']['name'];

            $sql_simpan = "INSERT INTO tbl_siswa (NISN, nama_siswa, jurusan, gambar) VALUES (
                '" . $_POST['NISN'] . "',
                '" . $_POST['nama_siswa'] . "',
                '" . $_POST['jurusan'] . "',
                '" . $judul_berita_file . "')";
            $query_simpan = mysqli_query($koneksi, $sql_simpan);

            if ($query_simpan) {
                echo "<script>
                Swal.fire({title: 'Tambah Data Berhasil', text: '', icon: 'success', confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.value) {
                        window.location = 'index.php?page=data-siswa';
                    }
                })</script>";
            } else {
                echo "<script>
                Swal.fire({title: 'Tambah Data Gagal', text: '', icon: 'error', confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.value) {
                        window.location = 'index.php?page=add-siswa';
                    }
                })</script>";
            }
        } else {
            echo "<script>
            Swal.fire({title: 'Gagal, Foto Wajib Diisi', text: '', icon: 'error', confirmButtonText: 'OK'
            }).then((result) => {
                if (result.value) {
                    window.location = 'index.php?page=add-siswa';
                }
            })</script>";
        }
    }
    // Menutup koneksi database
    mysqli_close($koneksi);
}
?>
