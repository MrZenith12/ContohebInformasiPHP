<div class="card card-primary">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-edit"></i> Tambah Data</h3>
	</div>
	<form action="" method="post" enctype="multipart/form-data">
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
				<label class="col-sm-2 col-form-label">Masukkan Link Video (Opsional)</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="gambar_berita" name="gambar_berita" placeholder="Masukkan Link Video YouTube">
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-2 col-form-label">File Media (Opsional)</label>
				<div class="col-sm-6">
					<input type="file" id="gambar_berita" name="gambar_berita" accept=".jpg, .png">
					<p class="help-block">
						<font color="red">Format file: JPG/PNG</font>
					</p>
				</div>
			</div>
		</div>
		<div class="card-footer">
			<input type="submit" name="Simpan" value="Simpan" class="btn btn-info">
			<a href="?page=data-berita" title="Kembali" class="btn btn-secondary">Batal</a>
		</div>
	</form>
</div>

<?php 

if (isset($_POST['Simpan'])) {

    $judul_berita = $_POST['judul_berita'];
    $deskripsi = $_POST['deskripsi'];

    // Periksa apakah tautan video YouTube diisi
    if (!empty($_POST['gambar_berita'])) {
        // Simpan tautan video YouTube
        $gambar_berita = $_POST['gambar_berita'];
    } else {
        // Periksa unggah file gambar
        $gambar_berita = @$_FILES['gambar_berita']['name'];
        $file_sumber = @$_FILES['gambar_berita']['tmp_name'];

        // Periksa ekstensi file
        $ekstensi = pathinfo($gambar_berita, PATHINFO_EXTENSION);

        if (!empty($file_sumber)) {
            if ($ekstensi === 'jpg' || $ekstensi === 'jpeg' || $ekstensi === 'png') {
                // File adalah gambar_berita
                $target_directory = 'foto/';
            } elseif ($ekstensi === 'mp4') {
                // File adalah video MP4
                $target_directory = 'foto/';
            } else {
                // Ekstensi tidak dikenal
                $target_directory = ''; // Sesuaikan direktori sesuai kebutuhan
            }

            if (!empty($target_directory)) {
                // Pindahkan file ke direktori yang sesuai
                $upload_success = move_uploaded_file($file_sumber, $target_directory . $gambar_berita);
            }
        }
    }

    $sql_simpan = "INSERT INTO tbl_berita (judul_berita, deskripsi, gambar_berita) VALUES (
        '" . $judul_berita . "',
        '" . $deskripsi . "',
        '" . $gambar_berita . "')";

    $query_simpan = mysqli_query($koneksi, $sql_simpan);

    if ($query_simpan) {
        echo "<script>
        Swal.fire({title: 'Tambah Data Berhasil', text: '', icon: 'success', confirmButtonText: 'OK'
        }).then((result) => {
            if (result.value) {
                window.location = 'index.php?page=data-berita';
            }
        })</script>";
    } else {
        echo "<script>
        Swal.fire({title: 'Tambah Data Gagal', text: '', icon: 'error', confirmButtonText: 'OK'
        }).then((result) => {
            if (result.value) {
                window.location = 'index.php?page=add-berita';
            }
        })</script>";
    }

    mysqli_close($koneksi);
}


?>