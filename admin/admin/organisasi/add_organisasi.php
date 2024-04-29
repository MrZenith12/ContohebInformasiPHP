<div class="card card-primary">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-edit"></i> Tambah Data</h3>
	</div>
	<form action="" method="post" enctype="multipart/form-data">
		<div class="card-body">

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Nama Organisasi</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="nama_organisasi" name="nama_organisasi" placeholder="Nama Organisasi" required>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Deskripsi</label>
				<div class="col-sm-5">
					<input type="text" class="form-control" id="deskripsi" name="deskripsi" placeholder="Deskripsi" required>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Gambar Organisasi</label>
				<div class="col-sm-6">
					<input type="file" id="gambar_organisasi" name="gambar_organisasi">
					<p class="help-block">
						<font color="red">"Format file Jpg/Png"</font>
					</p>
				</div>
			</div>

		</div>
		<div class="card-footer">
			<input type="submit" name="Simpan" value="Simpan" class="btn btn-info">
			<a href="?page=data-organisasi" title="Kembali" class="btn btn-secondary">Batal</a>
		</div>
	</form>
</div>

<?php
$sumber = @$_FILES['gambar_organisasi']['tmp_name'];
$target = 'foto/';
$judul_berita_file = @$_FILES['gambar_organisasi']['name'];
$pindah = move_uploaded_file($sumber, $target.$judul_berita_file);

if (isset($_POST['Simpan'])) {
    if (!empty($sumber)) {
        $sql_simpan = "INSERT INTO tbl_organisasi ( nama_organisasi, deskripsi, gambar_organisasi) VALUES (
            '" . $_POST['nama_organisasi'] . "',
            '" . $_POST['deskripsi'] . "',
            '" . $judul_berita_file . "')";
        $query_simpan = mysqli_query($koneksi, $sql_simpan);
        mysqli_close($koneksi);

        if ($query_simpan) {
            echo "<script>
            Swal.fire({title: 'Tambah Data Berhasil', text: '', icon: 'success', confirmButtonText: 'OK'
            }).then((result) => {
                if (result.value) {
                    window.location = 'index.php?page=data-organisasi';
                }
            })</script>";
        } else {
            echo "<script>
            Swal.fire({title: 'Tambah Data Gagal', text: '', icon: 'error', confirmButtonText: 'OK'
            }).then((result) => {
                if (result.value) {
                    window.location = 'index.php?page=add-organisasi';
                }
            })</script>";
        }
    } elseif (empty($sumber)) {
        echo "<script>
        Swal.fire({title: 'Gagal, Foto Wajib Diisi', text: '', icon: 'error', confirmButtonText: 'OK'
        }).then((result) => {
            if (result.value) {
                window.location = 'index.php?page=add-organisasi';
            }
        })</script>";
    }
}
     //selesai proses simpan data
?>


