<?php

    if(isset($_GET['kode'])){
        $sql_cek = "SELECT * FROM tbl_organisasi WHERE id_organisasi='".$_GET['kode']."'";
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
					<input type="hidden" class="form-control" id="id_organisasi" name="id_organisasi" value="<?php echo $data_cek['id_organisasi']; ?>"
					 readonly/>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Nama Organisasi</label>
				<div class="col-sm-5">
					<input type="text" class="form-control" id="nama_organisasi" name="nama_organisasi" value="<?php echo $data_cek['nama_organisasi']; ?>"
					/>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Deskripsi</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="deskripsi" name="deskripsi" value="<?php echo $data_cek['deskripsi']; ?>"
					/>
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Gambar Organisasi</label>
				<div class="col-sm-6">
					<img src="foto/<?php echo $data_cek['gambar_organisasi']; ?>" width="160px" />
				</div>
			</div>

			<div class="form-group row">
				<label class="col-sm-2 col-form-label">Ubah Gambar</label>
				<div class="col-sm-6">
					<input type="file" id="gambar_organisasi" name="gambar_organisasi">
					<p class="help-block">
						<font color="red">"Format file Jpg/Png"</font>
					</p>
				</div>
			</div>
		</div>

		<div class="card-footer">
			<input type="submit" name="Ubah" value="Simpan" class="btn btn-success">
			<a href="?page=data-organisasi" title="Kembali" class="btn btn-secondary">Batal</a>
		</div>
	</form>
</div>

<?php
	$sumber = @$_FILES['gambar_organisasi']['tmp_name'];
	$target = 'foto/';
	$nama_file = @$_FILES['gambar_organisasi']['name'];
	$pindah = move_uploaded_file($sumber, $target.$nama_file);

	
if (isset ($_POST['Ubah'])){

    if(!empty($sumber)){
        $gambar_organisasi= $data_cek['gambar_organisasi'];
            if (file_exists("foto/$gambar_organisasi")){
            unlink("foto/$gambar_organisasi");}

        $sql_ubah = "UPDATE tbl_organisasi SET
			nama_organisasi='".$_POST['nama_organisasi']."',
			deskripsi='".$_POST['deskripsi']."',
			gambar_organisasi='".$nama_file."'		
            WHERE id_organisasi='".$_POST['id_organisasi']."'";
        $query_ubah = mysqli_query($koneksi, $sql_ubah);

    }elseif(empty($sumber)){
		$sql_ubah = "UPDATE tbl_organisasi SET
		nama_organisasi='".$_POST['nama_organisasi']."',
		deskripsi='".$_POST['deskripsi']."'		
		WHERE id_organisasi='".$_POST['id_organisasi']."'";
	$query_ubah = mysqli_query($koneksi, $sql_ubah);
        }

    if ($query_ubah) {
        echo "<script>
        Swal.fire({title: 'Ubah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
        }).then((result) => {
            if (result.value) {
                window.location = 'index.php?page=data-organisasi';
            }
        })</script>";
        }else{
        echo "<script>
        Swal.fire({title: 'Ubah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
        }).then((result) => {
            if (result.value) {
                window.location = 'index.php?page=data-organisasi';
            }
        })</script>";
    }
}

