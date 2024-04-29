<?php
    //Mulai Sesion
    session_start();
    if (isset($_SESSION["ses_username"])==""){
	header("location: login.php");
    
    }else{
      $data_id = $_SESSION["ses_id"];
      $data_nama = $_SESSION["ses_username"];
      $data_user = $_SESSION["ses_username"];
	  $data_level = $_SESSION["ses_level"];
    }

    //KONEKSI DB
	include "inc/koneksi.php";
	
	$sql = $koneksi->query("SELECT * from tbl_login");
	while ($data= $sql->fetch_assoc()) {
	
	$nama=$data['username'];
	}
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Administrator</title>
	<link rel="icon" href="dist/img/logo.png">
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Font Awesome -->
	<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<!-- DataTables -->
	<link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">
	<!-- overlayScrollbars -->
	<link rel="stylesheet" href="dist/css/adminlte.min.css">
	<!-- Select2 -->
	<link rel="stylesheet" href="plugins/select2/css/select2.min.css">
	<link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
	<!-- Google Font: Source Sans Pro -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
	<!-- Alert -->
	<script src="plugins/alert.js"></script>
</head>

<body class="hold-transition sidebar-mini">
	<!-- Site wrapper -->
	<div class="wrapper">
		<!-- Navbar -->
		<nav class="main-header navbar navbar-expand navbar-blue navbar-light">
			<!-- Left navbar links -->
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" data-widget="pushmenu" href="#">
						<i class="fas fa-bars text-white"></i>
					</a>
				</li>

			</ul>

			<!-- SEARCH FORM -->
			<ul class="navbar-nav ml-auto">

				<li class="nav-item d-none d-sm-inline-block">
					<a href="index.php" class="nav-link">
						<font color="white">
							<b>
								<?php echo $nama; ?>
							</b>
						</font>
					</a>
				</li>
			</ul>

		</nav>
		<!-- /.navbar -->

		<!-- Main Sidebar Container -->
		<aside class="main-sidebar sidebar-dark-primary elevation-4">
			<!-- Brand Logo -->
			<a href="index.php" class="brand-link">
				<img src="dist/img/logo.png" alt="AdminLTE Logo" class="brand-image" style="opacity: .8">
				<span class="brand-text"> ADMIN </span>
			</a>

			<!-- Sidebar -->
			<div class="sidebar">
				<!-- Sidebar user (optional) -->
				<div class="user-panel mt-2 pb-2 mb-2 d-flex">
					<div class="image">
						<img src="dist/img/user.png" class="img-circle elevation-1" alt="User Image">
					</div>
					<div class="info">
						<a href="index.php" class="d-block">
							<?php echo $data_nama; ?>
						</a>
						<span class="badge badge-success">
							<?php echo $data_level; ?>
						</span>
					</div>
				</div>

				<!-- Sidebar Menu -->
				<nav class="mt-2">
					<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

						<!-- Level  -->
						<?php
						if ($data_level=="Administrator"){
						?>
						<li class="nav-item">
							<a href="index.php" class="nav-link">
								<i class="nav-icon fas fa-tachometer-alt"></i>
								<p>
									Dashboard
								</p>
							</a>
						</li>

							<li class="nav-item">
								<a href="#" class="nav-link">
									<i class="nav-icon fas fa-home"></i>
									<p>
										Menu utama
										<i class="fas fa-angle-left right"></i>
									</p>
								</a>
								<ul class="nav nav-treeview">
										<li class="nav-item">
											<a href="?page=data-banner" class="nav-link">
												<i class="nav-icon fas fa-image"></i>
												<p>Banner</p>
											</a>
										</li>
										<li class="nav-item">
											<a href="?page=data-menuutama" class="nav-link">
												<i class="nav-icon fas fa-bars"></i>
												<p>Menu Utama</p>
											</a>
										</li>
										<li class="nav-item">
											<a href="?page=data-menu" class="nav-link">
												<i class="nav-icon fas fa-bars"></i>
												<p>Menu</p>
											</a>
										</li>
										<li class="nav-item">
											<a href="?page=data-submenu" class="nav-link">
												<i class="nav-icon fas fa-list"></i>
												<p>Sub Menu</p>
											</a>
										</li>
								</ul>
							</li>

							<li class="nav-item">
								<a href="#" class="nav-link">
									<i class="nav-icon far fa-newspaper"></i>
									<p>
										Master Berita
										<i class="fas fa-angle-left right"></i>
									</p>
								</a>
								<ul class="nav nav-treeview">
									<li class="nav-item">
										<a href="?page=data-berita" class="nav-link">
											<i class="nav-icon far fa-newspaper"></i>
											<p>
												Semua Berita
											</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="?page=data-beritamp" class="nav-link">
											<i class="nav-icon far fa-file-video"></i>
											<p>
												Berita Video
											</p>
										</a>
									</li>
									<li class="nav-item">
										<a href="?page=data-beritaimg" class="nav-link">
											<i class="nav-icon far fa-newspaper"></i>
											<p>
												Berita Teks
											</p>
										</a>
									</li>
								</ul>
							</li>

							<li class="nav-item">
							<a href="#" class="nav-link">
								<i class="nav-icon far fa fa-users"></i>
								<p>
									Informasi
									<i class="fas fa-angle-left right"></i>
								</p>
							</a>
							<ul class="nav nav-treeview">
								<li class="nav-item">
									<a href="?page=data-jurusan" class="nav-link">
										<i class="nav-icon fas fa-user-md"></i>
										<p>
											Jurusan
										</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="?page=data-siswa" class="nav-link">
										<i class="nav-icon fas fa-user-graduate"></i>
										<p>
											Siswa
										</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="#" class="nav-link">
										<i class="nav-icon far fa fa-users"></i>
										<p>
											Guru
											<i class="fas fa-angle-left right"></i>
										</p>
									</a>
									<ul class="nav nav-treeview">
										<li class="nav-item">
											<a href="?page=data-kepalasekolah" class="nav-link">
												<i class="nav-icon fas fa-chalkboard-teacher"></i>
												<p>
													Kepala Sekolah
												</p>
											</a>
										</li>
										<li class="nav-item">
											<a href="?page=data-bidang" class="nav-link">
												<i class="nav-icon fas fa-chalkboard-teacher"></i>
												<p>
													Guru dan staf
												</p>
											</a>
										</li>
									</ul>
								</li>
								<li class="nav-item">
									<a href="?page=data-organisasi" class="nav-link">
										<i class="nav-icon far fa fa-layer-group"></i>
										<p>
											Ekstrakurikuler
										</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="?page=data-visi" class="nav-link">
										<i class="nav-icon far fa fa-bullseye"></i>
										<p>
											Visi & Misi
										</p>
									</a>
								</li>
							</ul>
						</li>
						<li class="nav-item">
							<a href="?page=data-galeri" class="nav-link">
								<i class="nav-icon fas fa-image"></i>
								<p>Galeri</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="?page=data-pesan" class="nav-link">
								<i class="nav-icon far fa-file"></i>
								<p>
									Pesan
								</p>
							</a>
						</li>

						<li class="nav-header">Setting</li>
						<li class="nav-item">
							<a href="?page=data-profil" class="nav-link">
								<i class="nav-icon far fa fa-flag"></i>
								<p>
									Profil Sekolah
								</p>
							</a>
						</li>

						<li class="nav-item">
							<a href="?page=data-pengguna" class="nav-link">
								<i class="nav-icon far fa-user"></i>
								<p>
									Pengguna Sistem
								</p>
							</a>
						</li>

						<!-- <?php
          				} elseif($data_level=="Guru"){
          				?>

						<li class="nav-item">
							<a href="index.php" class="nav-link">
								<i class="nav-icon fas fa-tachometer-alt"></i>
								<p>
									Dashboard
								</p>
							</a>
						</li>

						<li class="nav-item">
							<a href="?page=data-berita" class="nav-link">
								<i class="nav-icon far fa fa-users"></i>
								<p>
									Data Pegawai
								</p>
							</a>
						</li>

						<li class="nav-header">Setting</li>

						<?php
							}
						?> -->

						<li class="nav-item">
							<a onclick="return confirm('Apakah anda yakin akan keluar ?')" href="logout.php" class="nav-link">
								<i class="nav-icon far fa-circle text-danger"></i>
								<p>
									Logout
								</p>
							</a>
						</li>

				</nav>
				<!-- /.sidebar-menu -->
			</div>
			<!-- /.sidebar -->
		</aside>

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<section class="content-header">
			</section>

			<!-- Main content -->
			<section class="content">
				
				<div class="container-fluid">

					<?php 
      if(isset($_GET['page'])){
          $hal = $_GET['page'];
  
          switch ($hal) {
              //Klik Halaman Home Pengguna
              	case 'admin':
                  include "home/admin.php";
                  break;

				//banner 
				case 'data-banner':
					include "admin/banner/data_banner.php";
					break;
				case 'add-banner':
					include "admin/banner/add_banner.php";
					break;
				case 'edit-banner':
					include "admin/banner/edit_banner.php";
					break;
				case 'del-banner':
					include "admin/banner/del_banner.php";
					break;

				//menu utama
				case 'data-menuutama':
					include "admin/menuutama/data_menuutama.php";
					break;
				case 'add-menuutama':
					include "admin/menuutama/add_menuutama.php";
					break;
				case 'edit-menuutama':
					include "admin/menuutama/edit_menuutama.php";
					break;
				case 'del-menuutama':
					include "admin/menuutama/del_menuutama.php";
					break;

				//menu 
				case 'data-menu':
					include "admin/menu/data_menu.php";
					break;
				case 'add-menu':
					include "admin/menu/add_menu.php";
					break;
				case 'edit-menu':
					include "admin/menu/edit_menu.php";
					break;
				case 'del-menu':
					include "admin/menu/del_menu.php";
					break;

				//submenu 
				case 'data-submenu':
					include "admin/submenu/data_submenu.php";
					break;
				case 'add-submenu':
					include "admin/submenu/add_submenu.php";
					break;
				case 'edit-submenu':
					include "admin/submenu/edit_submenu.php";
					break;
				case 'del-submenu':
					include "admin/submenu/del_submenu.php";
					break;

				//organisasi
				case 'data-organisasi':
					include "admin/organisasi/data_organisasi.php";
					break;
				case 'add-organisasi':
					include "admin/organisasi/add_organisasi.php";
					break;
				case 'edit-organisasi':
					include "admin/organisasi/edit_organisasi.php";
					break;
				case 'del-organisasi':
					include "admin/organisasi/del_organisasi.php";
					break;

				//Pengguna
				case 'data-pengguna':
					include "admin/pengguna/data_pengguna.php";
					break;
				case 'add-pengguna':
					include "admin/pengguna/add_pengguna.php";
					break;
				case 'edit-pengguna':
					include "admin/pengguna/edit_pengguna.php";
					break;
				case 'del-pengguna':
					include "admin/pengguna/del_pengguna.php";
					break;

				//Kepala Sekolah
				case 'data-kepalasekolah':
					include "admin/kepalasekolah/data_kepalasekolah.php";
					break;
				case 'add-kepalasekolah':
					include "admin/kepalasekolah/add_kepalasekolah.php";
					break;
				case 'edit-kepalasekolah':
					include "admin/kepalasekolah/edit_kepalasekolah.php";
					break;
				case 'del-kepalasekolah':
					include "admin/kepalasekolah/del_kepalasekolah.php";
					break;
				
				//Guru Bidang
				case 'data-bidang':
					include "admin/guruBidang/data_guruBidang.php";
					break;
				case 'add-bidang':
					include "admin/guruBidang/add_guruBidang.php";
					break;
				case 'edit-bidang':
					include "admin/guruBidang/edit_guruBidang.php";
					break;
				case 'del-bidang':
					include "admin/guruBidang/del_guruBidang.php";
					break;

				// Jurusan
				case 'data-jurusan':
					include "admin/jurusan/data_jurusan.php";
					break;
				case 'add-jurusan':
					include "admin/jurusan/add_jurusan.php";
					break;
				case 'edit-jurusan':
					include "admin/jurusan/edit_jurusan.php";
					break;
				case 'del-jurusan':
					include "admin/jurusan/del_jurusan.php";
					break;

				//Berita
				case 'data-berita':
					include "admin/berita/data_berita.php";
					break;
				case 'add-berita':
					include "admin/berita/add_berita.php";
					break;
				case 'edit-berita':
					include "admin/berita/edit_berita.php";
					break;
				case 'del-berita':
					include "admin/berita/del_berita.php";
					break;
				case 'view-berita':
					include "admin/berita/view_berita.php";
					break;

				//Berita video
				case 'data-beritamp':
					include "admin/beritavideo/data_beritamp.php";
					break;
				case 'add-beritamp':
					include "admin/beritavideo/add_beritamp.php";
					break;
				case 'edit-beritamp':
					include "admin/beritavideo/edit_beritamp.php";
					break;
				case 'del-beritamp':
					include "admin/beritavideo/del_beritamp.php";
					break;
				case 'view-beritamp':
					include "admin/beritavideo/view_beritamp.php";
					break;

				//Berita image
				case 'data-beritaimg':
					include "admin/beritaimg/data_beritaimg.php";
					break;
				case 'add-beritaimg':
					include "admin/beritaimg/add_beritaimg.php";
					break;
				case 'edit-beritaimg':
					include "admin/beritaimg/edit_beritaimg.php";
					break;
				case 'del-beritaimg':
					include "admin/beritaimg/del_beritaimg.php";
					break;
				case 'view-beritaimg':
					include "admin/beritaimg/view_beritaimg.php";
					break;
				
				//galeri
				case 'data-galeri':
					include "admin/galeri/data_galeri.php";
					break;
				case 'add-galeri':
					include "admin/galeri/add_galeri.php";
					break;
				case 'edit-galeri':
					include "admin/galeri/edit_galeri.php";
					break;
				case 'del-galeri':
					include "admin/galeri/del_galeri.php";
					break;
				case 'view-galeri':
					include "admin/galeri/view_galeri.php";
					break;

				//siswa
				case 'data-siswa':
					include "admin/siswa/data_siswa.php";
					break;
				case 'siswa-jurusan':
					include "admin/siswa/siswa_jurusan.php";
					break;					
				case 'view-all':
					include "admin/siswa/siswa_all.php";
					break;
				case 'add-siswa':
					include "admin/siswa/add_siswa.php";
					break;
				case 'edit-siswa':
					include "admin/siswa/edit_siswa.php";
					break;
				case 'del-siswa':
					include "admin/siswa/del_siswa.php";
					break;

				//Profil
				case 'data-profil':
					include "admin/profil/data_profil.php";
					break;
				case 'edit-profil':
					include "admin/profil/edit_profil.php";
					break;

				//visi misi
				case 'data-visi':
					include "admin/visimisi/add_visimisi.php";
					break;

				//pesan
				case 'data-pesan':
					include "admin/pesan/data_pesan.php";
					break;

			
              //default
              default:
                  echo "<center><h1> ERROR !</h1></center>";
                  break;    
          }
      }else{
        // Auto Halaman Home Pengguna
          if($data_level=="Administrator"){
              include "home/admin.php";
              }
          elseif($data_level=="Sekretaris"){
              include "home/sekretaris.php";
              }
          }
    ?>

				</div>
			</section>
			<!-- /.content -->
		</div>
		<!-- /.content-wrapper -->

		<footer class="main-footer">
			<div class="float-right d-none d-sm-block">
				Copyright &copy;
				<a target="_blank" href="https://www.youtube.com/channel/UCDxjOzW7F0JOkltlXT6g7AQ">
					<strong> SMKN 2 Langsa </strong>
				</a>
				All rights reserved.
			</div>
			<b>Created <?php echo date("Y"); ?></b>
		</footer>

		<!-- Control Sidebar -->
		<aside class="control-sidebar control-sidebar-dark">
			<!-- Control sidebar content goes here -->
		</aside>
		<!-- /.control-sidebar -->
	</div>
	<!-- ./wrapper -->

	<!-- jQuery -->
	<script src="plugins/jquery/jquery.min.js"></script>
	<!-- Bootstrap 4 -->
	<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<!-- Select2 -->
	<script src="plugins/select2/js/select2.full.min.js"></script>
	<!-- DataTables -->
	<script src="plugins/datatables/jquery.dataTables.js"></script>
	<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
	<!-- AdminLTE App -->
	<script src="dist/js/adminlte.min.js"></script>
	<!-- AdminLTE for demo purposes -->
	<script src="dist/js/demo.js"></script>
	<!-- page script -->
	<script src="plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
	<script src="plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
	<script src="plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
	<script src="plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
	<script src="plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
	<script src="plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
	<script src="plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>

	<script>
		$(function() {
			$("#example1").DataTable();
			$('#example2').DataTable({
				"paging": true,
				"lengthChange": false,
				"searching": false,
				"ordering": true,
				"info": true,
				"autoWidth": false,
			});
		});
	</script>

	<script>
		$(function() {
			//Initialize Select2 Elements
			$('.select2').select2()

			//Initialize Select2 Elements
			$('.select2bs4').select2({
				theme: 'bootstrap4'
			})
		})
	</script>

</body>

</html>