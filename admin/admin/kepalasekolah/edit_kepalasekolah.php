<?php

    if(isset($_GET['kode'])){
        $sql_cek = "SELECT * FROM tbl_kepalasekolah WHERE id_kepalasekolah='".$_GET['kode']."'";
        $query_cek = mysqli_query($koneksi, $sql_cek);
        $data_cek = mysqli_fetch_array($query_cek,MYSQLI_BOTH);
    }
?>

<div class="card card-success">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-edit"></i> Ubah Data</h3>
	</div>
	<form action="" method="post" enctype="multipart/form-data">
		<div class="card-body">

			<div class="form-group row">
				<div class="col-sm-5">
					<input type="hidden" class="form-control" id="id_kepalasekolah" name="id_kepalasekolah" value="<?php echo $data_cek['id_kepalasekolah']; ?>"
					 readonly/>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">NIP</label>
				<div class="col-sm-5">
					<input type="text" class="form-control" id="NIP" name="NIP" value="<?php echo $data_cek['NIP']; ?>"
					/>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Nama</label>
				<div class="col-sm-5">
					<input type="text" class="form-control" id="nama" name="nama" value="<?php echo $data_cek['nama']; ?>"
					/>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Jabatan</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="jabatan" name="jabatan" value="<?php echo $data_cek['jabatan']; ?>"
					/>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Gambar</label>
				<div class="col-sm-6">
					<img src="foto/<?php echo $data_cek['gambar']; ?>" width="160px" />
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Ubah Gambar</label>
				<div class="col-sm-6">
					<input type="file" id="gambar" name="gambar">
					<p class="help-block">
						<font color="red">"Format file Jpg/Png"</font>
					</p>
				</div>
			</div>
		</div>

		<div class="card-footer">
			<input type="submit" name="Ubah" value="Simpan" class="btn btn-success">
			<a href="?page=data-kepalasekolah" title="Kembali" class="btn btn-secondary">Batal</a>
		</div>
	</form>
</div>

<?php
	$sumber = @$_FILES['gambar']['tmp_name'];
	$target = 'foto/';
	$nama_file = @$_FILES['gambar']['name'];
	$pindah = move_uploaded_file($sumber, $target.$nama_file);

	
if (isset ($_POST['Ubah'])){

    if(!empty($sumber)){
        $gambar= $data_cek['gambar'];
            if (file_exists("foto/$gambar")){
            unlink("foto/$gambar");}

        $sql_ubah = "UPDATE tbl_kepalasekolah SET
			NIP='".$_POST['NIP']."',
			nama='".$_POST['nama']."',
			jabatan='".$_POST['jabatan']."',
			gambar='".$nama_file."'		
            WHERE id_kepalasekolah='".$_POST['id_kepalasekolah']."'";
        $query_ubah = mysqli_query($koneksi, $sql_ubah);

    }elseif(empty($sumber)){
		$sql_ubah = "UPDATE tbl_kepalasekolah SET
		NIP='".$_POST['NIP']."',
		nama='".$_POST['nama']."',
		jabatan='".$_POST['jabatan']."'		
		WHERE id_kepalasekolah='".$_POST['id_kepalasekolah']."'";
	$query_ubah = mysqli_query($koneksi, $sql_ubah);
        }

    if ($query_ubah) {
        echo "<script>
        Swal.fire({title: 'Ubah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
        }).then((result) => {
            if (result.value) {
                window.location = 'index.php?page=data-kepalasekolah';
            }
        })</script>";
        }else{
        echo "<script>
        Swal.fire({title: 'Ubah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
        }).then((result) => {
            if (result.value) {
                window.location = 'index.php?page=data-kepalasekolah';
            }
        })</script>";
    }
}

