<?php
		// Query SQL untuk menghitung jumlah berita
		$query = "SELECT COUNT(*) as total_berita FROM tbl_berita";
		$result = mysqli_query($koneksi, $query);

		if ($result) {
			$row = mysqli_fetch_assoc($result);
			$jumlahBerita = $row['total_berita'];
		} else {
			$jumlahBerita = 0;
		}

		// Query SQL untuk menghitung jumlah galeri
		$query = "SELECT COUNT(*) as total_galeri FROM tbl_galeri";
		$result = mysqli_query($koneksi, $query);

		if ($result) {
			$row = mysqli_fetch_assoc($result);
			$jumlahgaleri = $row['total_galeri'];
		} else {
			$jumlahgaleri = 0;
		}

		// Query SQL untuk menghitung jumlah guru bidang
		$query = "SELECT COUNT(*) as total_guru FROM tbl_guru";
		$result = mysqli_query($koneksi, $query);

		if ($result) {
			$row = mysqli_fetch_assoc($result);
			$jumlahgurubidang = $row['total_guru'];
		} else {
			$jumlahgurubidang = 0;
		}

		// Query SQL untuk menghitung jumlah jurusan
		$query = "SELECT COUNT(*) as total_jurusan FROM tbl_jurusan";
		$result = mysqli_query($koneksi, $query);

		if ($result) {
			$row = mysqli_fetch_assoc($result);
			$jumlahjurusan = $row['total_jurusan'];
		} else {
			$jumlahjurusan = 0;
		}

		// Query SQL untuk menghitung jumlah organisasi
		$query = "SELECT COUNT(*) as total_organisasi FROM tbl_organisasi";
		$result = mysqli_query($koneksi, $query);

		if ($result) {
			$row = mysqli_fetch_assoc($result);
			$jumlahorganisasi = $row['total_organisasi'];
		} else {
			$jumlahorganisasi = 0;
		}

		// Query SQL untuk menghitung jumlah pengguna
		$query = "SELECT COUNT(*) as total_pengguna FROM tbl_login";
		$result = mysqli_query($koneksi, $query);

		if ($result) {
			$row = mysqli_fetch_assoc($result);
			$jumlahpengguna = $row['total_pengguna'];
		} else {
			$jumlahpengguna = 0;
		}

		// Query SQL untuk menghitung jumlah siswa
		$query = "SELECT SUM(jumlah_siswa) as total_siswa FROM tbl_jurusan";
		$result = mysqli_query($koneksi, $query);

		if ($result) {
			$row = mysqli_fetch_assoc($result);
			$totalSiswa = $row['total_siswa'];
		} else {
			$totalSiswa = 0;
		}

        $sql_cek = "SELECT * FROM tbl_profil";
        $query_cek = mysqli_query($koneksi, $sql_cek);
		$data_cek = mysqli_fetch_array($query_cek,MYSQLI_BOTH);
		{
		
		
?>

<?php
		}
	$sql = $koneksi->query("SELECT count(id_berita) as lokal from tbl_berita");
	while ($data= $sql->fetch_assoc()) {
	
		$lokal=$data['lokal'];
	}
?>

<div class="row">
	<div class="col-lg-3 col-6">
		<!-- small box -->
		<div class="small-box bg-primary">
			<div class="inner">
				<h3>
					<?php echo $totalSiswa;  ?>
				</h3>

				<p>Jumlah Siswa</p>
			</div>
			<div class="icon">
				<i class="fas fa-user-graduate"></i>
			</div>
			<a href="index.php?page=data-siswa" class="small-box-footer">Selengkapnya
				<i class="fas fa-arrow-circle-right"></i>
			</a>
		</div>
	</div>
	<!-- ./col -->
	<div class="col-lg-3 col-6">
		<!-- small box -->
		<div class="small-box bg-success">
			<div class="inner">
				<h3>
					<?php echo $jumlahBerita; ?>
				</h3>

				<p>Status Berita</p>
			</div>
			<div class="icon">
				<i class="fas fa-newspaper"></i>
			</div>
			<a href="index.php?page=data-berita" class="small-box-footer">Selengkapnya
				<i class="fas fa-arrow-circle-right"></i>
			</a>
		</div>
	</div>
	<!-- ./col -->
	<div class="col-lg-3 col-6">
		<!-- small box -->
		<div class="small-box bg-info">
			<div class="inner">
				<h3>
					<?php echo $jumlahgaleri; ?>
				</h3>

				<p>Status Galeri</p>
			</div>
			<div class="icon">
				<i class="fas fa-images"></i>
			</div>
			<a href="index.php?page=data-galeri" class="small-box-footer">Selengkapnya
				<i class="fas fa-arrow-circle-right"></i>
			</a>
		</div>
	</div>
	<!-- ./col -->
	<div class="col-lg-3 col-6">
		<!-- small box -->
		<div class="small-box bg-warning">
			<div class="inner">
				<h3>
					<?php echo $jumlahgurubidang  ?>
				</h3>

				<p>Guru dan staf pengajar</p>
			</div> 
			<div class="icon">
				<!-- Ganti kelas ikon di bawah ini dengan ikon FontAwesome yang sesuai -->
				<i class="fas fa-chalkboard-teacher"></i>
			</div>
			<a href="index.php?page=data-bidang" class="small-box-footer">Selengkapnya
				<i class="fas fa-arrow-circle-right"></i>
			</a>
		</div>
	</div>
	<!-- ./col -->
	<div class="col-lg-3 col-6">
		<!-- small box -->
		<div class="small-box bg-success">
			<div class="inner">
				<h3>
					<?php echo $jumlahjurusan ?>
				</h3>

				<p>Jurusan</p>
			</div>
			<div class="icon">
				<i class="fas fa-user-md"></i>
			</div>
			<a href="index.php?page=data-jurusan" class="small-box-footer">Selengkapnya
				<i class="fas fa-arrow-circle-right"></i>
			</a>
		</div>
	</div>
	<!-- ./col -->
	<div class="col-lg-3 col-6">
		<!-- small box -->
		<div class="small-box bg-info">
			<div class="inner">
				<h3>
					<?php echo $jumlahorganisasi ?>
				</h3>

				<p>Ekstrakurikuler</p>
			</div>
			<div class="icon">
				<i class="fa fa-layer-group"></i>
			</div>
			<a href="index.php?page=data-organisasi" class="small-box-footer">Selengkapnya
				<i class="fas fa-arrow-circle-right"></i>
			</a>
		</div>
	</div>
	<!-- ./col -->
	<div class="col-lg-3 col-6">
		<!-- small box -->
		<div class="small-box bg-primary">
			<div class="inner">
				<h3>
					<?php echo $jumlahpengguna ?>
				</h3>

				<p>Pengguna</p>
			</div>
			<div class="icon">
				<i class="ion ion-person-add"></i>
			</div>
			<a href="index.php?page=data-pengguna" class="small-box-footer">Selengkapnya
				<i class="fas fa-arrow-circle-right"></i>
			</a>
		</div>
	</div>