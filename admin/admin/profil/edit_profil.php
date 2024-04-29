<?php
if(isset($_GET['kode'])){
    $sql_cek = "SELECT * FROM tbl_profil WHERE id_profil='".$_GET['kode']."'";
    $query_cek = $koneksi->query($sql_cek);
    $data_cek = $query_cek->fetch_assoc();
}
?>

<div class="card card-success">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fa fa-edit"></i> Ubah Profil</h3>
    </div>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="card-body">

            <input type='hidden' class="form-control" name="id_profil" value="<?php echo $data_cek['id_profil']; ?>" readonly/>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nama Instansi</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="nama_profil" name="nama_profil" value="<?php echo $data_cek['nama_profil']; ?>" />
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Deskripsi</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="deskripsi" name="deskripsi" value="<?php echo $data_cek['deskripsi']; ?>" />
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo $data_cek['alamat']; ?>" />
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Jam Masuk</label>
                <div class="col-sm-4">
                    <input type="time" class="form-control" id="jam_masuk" name="jam_masuk" value="<?php echo $data_cek['jam_masuk']; ?>" />
                </div>
                <label class="col-sm-2 col-form-label">Jam Pulang</label>
                <div>
                    <input type="time" class="form-control" id="jam_pulang" name="jam_pulang" value="<?php echo $data_cek['jam_pulang']; ?>" />
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">No Telepon</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="no_tlpn" name="no_tlpn" value="<?php echo $data_cek['no_tlpn']; ?>" />
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-8">
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $data_cek['email']; ?>" />
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Facebook</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="facebook" name="facebook" value="<?php echo $data_cek['facebook']; ?>" />
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Instagram</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="instagram" name="instagram" value="<?php echo $data_cek['instagram']; ?>" />
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">YouTube</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="youtube" name="youtube" value="<?php echo $data_cek['youtube']; ?>" />
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Logo</label>
                <div class="col-sm-6">
                    <input type="file" class="form-control-file" id="logo" name="logo">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Preview Logo</label>
                <div class="col-sm-6">
                    <?php
                    $logo = $data_cek['logo'];
                    if (!empty($logo)) {
                        echo '<img src="foto/' . $logo . '" width="100px" />';
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <input type="submit" name="Ubah" value="Simpan" class="btn btn-success">
            <a href="?page=data-profil" title="Kembali" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>

<?php
if (isset($_POST['Ubah'])){
  $id_profil = $_POST['id_profil'];
  $nama_profil = $_POST['nama_profil'];
  $deskripsi = $_POST['deskripsi'];
  $alamat = $_POST['alamat'];
  $jam_masuk = $_POST['jam_masuk'];
  $jam_pulang = $_POST['jam_pulang'];
  $no_tlpn = $_POST['no_tlpn'];
  $email = $_POST['email'];
  $facebook = $_POST['facebook'];
  $instagram = $_POST['instagram'];
  $youtube = $_POST['youtube'];

  // Pengunggahan logo
  $logo = $_FILES['logo']['name'];
  $logo_tmp = $_FILES['logo']['tmp_name'];
  $lokasi = 'foto/' . $logo;

  if (!empty($logo)) {
      move_uploaded_file($logo_tmp, $lokasi);
  } else {
      $logo = $data_cek['logo'];
  }

  $sql_ubah = "UPDATE tbl_profil SET 
      nama_profil='$nama_profil', 
      deskripsi='$deskripsi',
      alamat='$alamat',
      jam_masuk='$jam_masuk',
      jam_pulang='$jam_pulang', 
      no_tlpn='$no_tlpn', 
      email='$email', 
      facebook='$facebook', 
      instagram='$instagram', 
      youtube='$youtube',
      logo='$logo'
      WHERE id_profil='$id_profil'";
  $query_ubah = $koneksi->query($sql_ubah);

  if ($query_ubah) {
      echo "<script>
      Swal.fire({title: 'Ubah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
      }).then((result) => {if (result.value)
          {window.location = 'index.php?page=data-profil';
          }
      })</script>";
  } else {
      echo "<script>
      Swal.fire({title: 'Ubah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
      }).then((result) => {if (result.value)
          {window.location = 'index.php?page=data-profil';
          }
      })</script>";
  }
}
?>