<div class="card card-primary">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-edit"></i> Tambah Data</h3>
	</div>
	<form action="" method="post" enctype="multipart/form-data">
		<div class="card-body">

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Nama Guru</label>
				<div class="col-sm-5">
					<input type="text" class="form-control" id="nama_guru" name="nama_guru" placeholder="Nama Guru" required>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">NIP</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="NIP" name="NIP" placeholder="NIP" required>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Mapel / Jabatan</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="mapel" name="mapel" placeholder="Mapel / Jabatan" required>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Jenis Kelamin</label>
				<div class="col-sm-5">
					<select class="form-control" id="JK" name="JK" required>
						<option value="">Pilih Jenis Kelamin</option>
						<option value="Laki-laki">Laki-laki</option>
						<option value="Perempuan">Perempuan</option>
					</select>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Tugas Tambahan</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="tugastambahan" name="tugastambahan" placeholder="Tugas Tambahan" >
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Agama</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="agama" name="agama" placeholder="Agama" required>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Gambar Guru</label>
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
			<a href="?page=data-bidang" title="Kembali" class="btn btn-secondary">Batal</a>
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
        $sql_simpan = "INSERT INTO tbl_guru (nama_guru, JK, NIP, mapel, tugastambahan, agama, gambar) VALUES (
            '" . $_POST['nama_guru'] . "',
            '" . $_POST['JK'] . "',
			'" . $_POST['NIP'] . "',
            '" . $_POST['mapel'] . "',
			'" . $_POST['tugastambahan'] . "',
			'" . $_POST['agama'] . "',
            '" . $judul_berita_file . "')";
        $query_simpan = mysqli_query($koneksi, $sql_simpan);
        mysqli_close($koneksi);

        if ($query_simpan) {
            echo "<script>
            Swal.fire({title: 'Tambah Data Berhasil', text: '', icon: 'success', confirmButtonText: 'OK'
            }).then((result) => {
                if (result.value) {
                    window.location = 'index.php?page=data-bidang';
                }
            })</script>";
        } else {
            echo "<script>
            Swal.fire({title: 'Tambah Data Gagal', text: '', icon: 'error', confirmButtonText: 'OK'
            }).then((result) => {
                if (result.value) {
                    window.location = 'index.php?page=add-bidang';
                }
            })</script>";
        }
    } elseif (empty($sumber)) {
        echo "<script>
        Swal.fire({title: 'Gagal, Foto Wajib Diisi', text: '', icon: 'error', confirmButtonText: 'OK'
        }).then((result) => {
            if (result.value) {
                window.location = 'index.php?page=add-bidang';
            }
        })</script>";
    }
}
     //selesai proses simpan data
?>


