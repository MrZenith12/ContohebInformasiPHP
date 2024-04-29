<div class="card card-primary">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-edit"></i> Tambah Data</h3>
	</div>
	<form action="" method="post" enctype="multipart/form-data">
		<div class="card-body">

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">NIP</label>
				<div class="col-sm-5">
					<input type="text" class="form-control" id="NIP" name="NIP" placeholder="NIP" required>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Nama</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" required>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Jabatan</label>
				<div class="col-sm-5">
					<input type="text" class="form-control" id="jabatan" name="jabatan" placeholder="Jabatan" required>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Gambar</label>
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
			<a href="?page=data-kepalasekolah" title="Kembali" class="btn btn-secondary">Batal</a>
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
        $sql_simpan = "INSERT INTO tbl_kepalasekolah (NIP, nama, jabatan, gambar) VALUES (
            '" . $_POST['NIP'] . "',
            '" . $_POST['nama'] . "',
			'" . $_POST['jabatan'] . "',
            '" . $judul_berita_file . "')";
        $query_simpan = mysqli_query($koneksi, $sql_simpan);
        mysqli_close($koneksi);

        if ($query_simpan) {
            echo "<script>
            Swal.fire({title: 'Tambah Data Berhasil', text: '', icon: 'success', confirmButtonText: 'OK'
            }).then((result) => {
                if (result.value) {
                    window.location = 'index.php?page=data-kepalasekolah';
                }
            })</script>";
        } else {
            echo "<script>
            Swal.fire({title: 'Tambah Data Gagal', text: '', icon: 'error', confirmButtonText: 'OK'
            }).then((result) => {
                if (result.value) {
                    window.location = 'index.php?page=add-kepalasekolah';
                }
            })</script>";
        }
    } elseif (empty($sumber)) {
        echo "<script>
        Swal.fire({title: 'Gagal, Foto Wajib Diisi', text: '', icon: 'error', confirmButtonText: 'OK'
        }).then((result) => {
            if (result.value) {
                window.location = 'index.php?page=add-kepalasekolah';
            }
        })</script>";
    }
}
     //selesai proses simpan data
?>


