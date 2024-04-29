<?php 
  include "admin/inc/koneksi.php";

  // Mengambil jumlah siswa dari tabel tbl_siswa
  $sql = "SELECT COUNT(*) AS total_siswa FROM tbl_siswa";
  $result = mysqli_query($koneksi, $sql);
  $row = mysqli_fetch_assoc($result);
  $total_siswa = $row['total_siswa'];

  // Mengambil jumlah siswa dari tabel tbl_guru
  $sql = "SELECT COUNT(*) AS total_guru FROM tbl_guru";
  $result = mysqli_query($koneksi, $sql);
  $row = mysqli_fetch_assoc($result);
  $total_guru = $row['total_guru'];
?>

<!DOCTYPE html>
<html lang="en">
  <?php 
    $sql = $koneksi->query("SELECT * FROM tbl_profil");
    while ($data = $sql->fetch_assoc()) {
  ?>
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="TemplateMo">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="icon" href="admin/foto/<?php echo $data['logo']; ?>">
    <title><?php echo $data['nama_profil']; ?></title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">


    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-edu-meeting.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <link rel="stylesheet" href="assets/css/lightbox.css">
<!--

TemplateMo 569 Edu Meeting

https://templatemo.com/tm-569-edu-meeting

-->
  </head>
  

<body>

  <!-- Sub Header -->
  <div class="sub-header">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-sm-12">
          <div class="right-icons">
            <ul>
              <li><a href="<?php echo $data['facebook']; ?>"><i class="fa fa-facebook"></i></a></li>
              <li><a href="<?php echo $data['instagram']; ?>"><i class="fa fa-instagram"></i></a></li>
              <li><a href="<?php echo $data['youtube']; ?>"><i class="fa fa-youtube"></i></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php
    }
  ?>

  <!-- ***** Header Area Start ***** -->
  <header class="header-area header-sticky">
      <div class="container">
          <div class="row">
              <div class="col-12">
                  <nav class="main-nav">
                      <!-- ***** Logo Start ***** -->
                      <a href="index.php" class="logo">
                          SMKN 2 LANGSA
                      </a>
                      <!-- ***** Logo End ***** -->
                      <!-- ***** Menu Start ***** -->
                      <ul class="nav">
                          <li class="scroll-to-section"><a href="#top" class="active">Home</a></li>
                          <li><a href="berita.php">Berita</a></li>
                          <li><a href="gallery.php">Gallery</a></li>
                          <?php
                            // Query untuk mengambil data menu utama yang memiliki status "aktif" dan diurutkan berdasarkan kolom 'urutan'
                            $sql_menuutama = "SELECT * FROM tbl_menuutama WHERE status = 'aktif' ORDER BY urutan";
                            $result_menuutama = $koneksi->query($sql_menuutama);

                            if ($result_menuutama->num_rows > 0) {
                                while ($row_menuutama = $result_menuutama->fetch_assoc()) {
                                  echo '<li class="has-sub">';
                                  echo '<a href="javascript:void(0)" id="' . $row_menuutama['id_menuutama'] . '" >' . $row_menuutama['nama_menuutama'] . '</a>';
                                  echo '<ul class="sub-menu">';

                                  // Query untuk mengambil submenu yang memiliki status "aktif" dan diurutkan berdasarkan kolom 'urutan'
                                  $submenu_sql = "SELECT * FROM tbl_menu WHERE id_menuutama=" . $row_menuutama['id_menuutama'] . " AND status = 'aktif' ORDER BY urutan";
                                  $submenu_result = $koneksi->query($submenu_sql);
                                  if ($submenu_result->num_rows > 0) {
                                    while ($submenu_row = $submenu_result->fetch_assoc()) {
                                      echo '<li><a href="submenu.php?id_menu=' . $submenu_row['id_menu'] . '">' . $submenu_row['nama_menu'] . '</a></li>';
                                    }
                                  } 
                                  echo '</ul>';
                                  echo '</li>';
                                }
                              } else {
                                  echo "";
                              }
                          ?>
                          <li><a href="organisasi.php">Ekskul</a></li>
                          <li class="scroll-to-section"><a href="#contact">Contact Us</a></li> 
                      </ul>        
                      <a class='menu-trigger'>
                          <span>Menu</span>
                      </a>
                      <!-- ***** Menu End ***** -->
                  </nav>
              </div>
          </div>
      </div>
  </header>
  <!-- ***** Header Area End ***** -->

  <!-- ***** Main Banner Area Start ***** -->
  <?php
    // Query untuk mengambil data dari tabel tbl_banner
    $sql_banner = "SELECT * FROM tbl_banner WHERE status='Aktif' ORDER BY urutan ASC";
    $query_banner = mysqli_query($koneksi, $sql_banner);

    // Variabel untuk menghitung jumlah banner yang sudah ditampilkan
    $bannerCount = 0;

    // Loop untuk menampilkan data banner dalam slider dengan batasan 3 banner
    while ($data_banner = mysqli_fetch_array($query_banner)) {
        $gambar = $data_banner['gambar'];
        $judul_banner = $data_banner['judul_banner'];
        $keterangan = $data_banner['keterangan'];

        // Hentikan loop jika sudah menampilkan 1 banner
        if ($bannerCount >= 1) {
            break;
        }
        
        // Tampilkan banner
  ?>
  <section class="section main-banner" id="top" data-section="section1">
      <video autoplay muted loop id="bg-video">
          <source src="admin/foto/<?php echo $gambar; ?>" type="video/mp4" />
      </video>

      <div class="video-overlay header-text">
          <div class="container">
            <div class="row">
              <div class="col-lg-12">
                <div class="caption">
              <h6>Hello Students</h6>
              <h2><?php echo $judul_banner; ?></h2>
              <p><?php echo $keterangan; ?></p>
          </div>
              </div>
            </div>
          </div>
      </div>
  </section>
  <?php
                    
          // Tambahkan 1 ke variabel jumlah banner yang sudah ditampilkan
          $bannerCount++;
      }
  ?>
  <!-- ***** Main Banner Area End ***** -->

  <section class="services">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="owl-service-item owl-carousel" style="display: flex; justify-content: center; align-items: center;">
            <?php 
            // Query untuk mengambil data dari tabel tbl_jurusan
            $query = "SELECT * FROM tbl_jurusan";
            $result = mysqli_query($koneksi, $query);

            // Periksa apakah ada hasil yang dikembalikan
            if(mysqli_num_rows($result) > 0) {
              // Looping untuk menampilkan data dalam markup HTML
              while ($row = mysqli_fetch_assoc($result)) {
                $nama_jurusan = $row['namajurusan'];
                $deskripsi_jurusan = $row['deskripsi'];
                // Pisahkan deskripsi menjadi array kata-kata
                $deskripsiArray = explode(' ', $deskripsi_jurusan);
                // Ambil 15 kata pertama dan gabungkan kembali
                $deskripsi_jurusan = implode(' ', array_slice($deskripsiArray, 0, 15));
            ?>
            <div class="item">
              <div class="down-content">
                <h4><?php echo $nama_jurusan; ?></h4>
                <p><?php echo $deskripsi_jurusan; ?><a href="detail/detailjurusan.php?id_jurusan=<?php echo $row['id_jurusan']; ?>"> Telusuri</a></p>
              </div>
            </div>
            <?php
              }
            } else {
              // Tampilkan pesan jika tidak ada data yang ditemukan
              echo "<p>Tidak ada data yang ditemukan.</p>";
            }
            ?>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- bagian berita -->
  <section class="upcoming-meetings" id="meetings">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="section-heading">
            <h2>Berita Terbaru <?php echo date("Y"); ?></h2>
          </div>
        </div>
        
        <?php
            function isYouTubeURL($url) {
                // Define a regular expression pattern to match YouTube URLs
                $pattern = '/^(?:https:\/\/www\.youtube\.com\/watch\?v=|https:\/\/youtu\.be\/)([a-zA-Z0-9_-]+)/';
                
                return preg_match($pattern, $url);
            }

            function getYoutubeVideoId($url) {
                $video_id = 'gambar_berita';
                
                // Check if the URL is a valid YouTube URL
                if (isYouTubeURL($url)) {
                    // Extract the video ID from the URL
                    $video_id = preg_replace('/^(?:https:\/\/www\.youtube\.com\/watch\?v=|https:\/\/youtu\.be\/)([a-zA-Z0-9_-]+)/', '$1', $url);
                }
                
                return $video_id;
            }
            // Query untuk mengambil 3 berita terbaru dari tabel tbl_berita
            $sql = "SELECT * FROM tbl_berita ORDER BY tanggal_dimasukkan DESC LIMIT 6";
            $result = $koneksi->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                  $judul_berita = $row['judul_berita'];
                  $deskripsi = $row['deskripsi'];
                  // Batasi deskripsi menjadi sekitar 20 kata dan tambahkan tiga titik
                  $deskripsiArray = explode(' ', $deskripsi);
                  $deskripsiShort = implode(' ', array_slice($deskripsiArray, 0, 5));
                  $deskripsiShort .= '...';
        ?>
        <div class="col-lg-4">
          <div class="row">
            <div class="col-lg-12">
              <div class="meeting-item">
                <div class="thumb">
                  <?php
                    $gambar = $row['gambar_berita'];
                    $ekstensi = pathinfo($gambar, PATHINFO_EXTENSION);

                    if ($ekstensi === 'jpg' || $ekstensi === 'jpeg' || $ekstensi === 'png') {
                        // Jika ekstensi adalah JPG, JPEG, atau PNG, tampilkan gambar
                        echo '<a href="news_details.html"><img src="admin/foto/' . $gambar . '" alt=""></a>';
                    }elseif (isYouTubeURL($gambar)) {
                        // Jika tautan YouTube diberikan, tampilkan video YouTube
                        echo '<iframe style="width: 100%; height: 200px; object-fit: cover;" src="https://www.youtube.com/embed/' . getYoutubeVideoId($gambar) . '" frameborder="0" allowfullscreen></iframe>';
                    } else {
                        // Jika ekstensi tidak dikenali, Anda dapat menampilkan pesan atau tindakan lain sesuai kebutuhan.
                        echo 'File tidak dikenali';
                    }
                  ?>
                </div>
                <div class="down-content">
                  <div class="date">
                    <h6><?php echo date('F j, Y', strtotime($row['tanggal_dimasukkan'])); ?> <span></span></h6>
                  </div>
                  <h4><?php echo $judul_berita; ?></h4>
                  <p><?php echo $deskripsiShort; ?> <a href="detail/detailberita.php?id_berita=<?php echo $row['id_berita']; ?>">Selengkapnya</a></p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php
            }
        }
        
        ?>
      </div>
    </div>
  </section>

  <!-- bagian visi misi -->
  <section class="apply-now" id="apply">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
            <div class="section-heading">
              <h2>Informasi</h2>
            </div>
          </div>
          <?php
              // Query SQL untuk mengambil data dari tabel tbl_kepalasekolah
              $sql = "SELECT * FROM tbl_kepalasekolah";
              $result = mysqli_query($koneksi, $sql);

              if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
          ?>
          <div class="col-lg-4">
            <div class="categories">
              <h4><?php echo $row['jabatan']?></h4>
              <img src="admin/foto/<?php echo $row['gambar']; ?>" alt="Kepala Sekolah">
              <h5><?php echo $row['nama']?></h5>
              <div class="main-button-red">
                <a href="daftarguru.php">Staf Pengajar</a>
              </div>
            </div>
          </div>
          <?php
              }
          }
          ?>
        <?php
            // Query SQL untuk mengambil data dari tabel tbl_visimisi
            $sql = "SELECT * FROM tbl_visimisi";
            $result = mysqli_query($koneksi, $sql);

            if (mysqli_num_rows($result) > 0) {
              while ($row = mysqli_fetch_assoc($result)) {
                $visi = $row['visi'];
                $misi = $row['misi'];
        ?>
        <div class="col-lg-6">
          <div class="accordions is-first-expanded">
            <article class="accordion">
                <div class="accordion-head">
                    <span>Visi Sekolah </span>
                    <span class="icon">
                        <i class="icon fa fa-chevron-right"></i>
                    </span>
                </div>
                <div class="accordion-body">
                    <div class="content">
                        <p><?php echo $visi ?></p>
                    </div>
                </div>
            </article>
            <article class="accordion last-accordion">
                <div class="accordion-head">
                    <span>Misi Sekolah</span>
                    <span class="icon">
                        <i class="icon fa fa-chevron-right"></i>
                    </span>
                </div>
                <div class="accordion-body">
                    <div class="content">
                        <p><?php echo $misi ?></p>
                    </div>
                </div>
            </article>
        </div>
        <?php
            }
        }
        
        ?>
        </div>
      </div>
    </div>
  </section>

  <section class="our-courses" id="courses">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="section-heading">
            <h2>Guru dan Staf SMKN 2 Langsa</h2>
          </div>
        </div>
        <div class="col-lg-12">
          <div class="owl-courses-item owl-carousel">
            <?php 
              // Query untuk mengambil data dari dua tabel dan menggabungkannya
              $query = "SELECT nama_guru, NIP, gambar, mapel, JK, agama FROM tbl_guru ";
              $result = mysqli_query($koneksi, $query);

              // Periksa apakah ada hasil yang dikembalikan
              if(mysqli_num_rows($result) > 0) {
                // Looping untuk menampilkan data dalam markup HTML
                while ($row = mysqli_fetch_assoc($result)) {
                  $nama_guru = $row['nama_guru'];
                  $NIP = $row['NIP'];
                  $mapel = $row['mapel'];
                  $JK = $row['JK'];
                  $agama = $row['agama'];
                  $gambar = $row['gambar'];
            ?>
            <div class="item">
              <img src="admin/foto/<?php echo $gambar; ?>" alt="<?php echo $nama_guru; ?>">
              <div class="down-content">
                <h4><?php echo $nama_guru; ?></h4>
                <p style="margin-left: 20px;">NIP          : <?php echo $NIP; ?></p>
                <p style="margin-left: 20px;">Jenis Kelamin: <?php echo $JK; ?></p>
                <p style="margin-left: 20px;">Mapel        :<?php echo $mapel; ?></p>
                <p style="margin-left: 20px;">Agama        :<?php echo $agama; ?></p>
                <div class="info">
                  <div class="row">
                    <div class="col-8">
                      
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php
                }
              } else {
                // Tampilkan pesan jika tidak ada data yang ditemukan
                echo "<p>Tidak ada data yang ditemukan.</p>";
              }
            ?>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="our-facts">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <div class="row">
            <div class="col-lg-12">
              <h2>Beberapa Informasi Tentang SMKN 2 Langsa</h2>
            </div>
            <div class="col-lg-6">
              <div class="row">
                  <div class="col-12">
                      <div class="count-area-content">
                          <div class="count-digit"><?php echo $total_guru; ?></div>
                          <div class="count-title">Guru Pengajar</div>
                      </div>
                  </div>
              </div>
          </div>
            <div class="col-lg-6">
              <div class="row">
                  <div class="col-12">
                      <div class="count-area-content new-students">
                          <div class="count-digit"><?php echo $total_siswa; ?></div>
                          <div class="count-title">Total Siswa</div>
                      </div>
                  </div>
              </div>
          </div>
          </div>
        </div> 
        <div class="col-lg-6 align-self-center">
          <div class="video">
            <a href="https://youtu.be/0F2ph_m4HUI?si=AZr-orlUuxFAKptQ" target="_blank"><img src="assets/images/play-icon.png" alt=""></a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="contact-us" id="contact">
    <div class="container">
      <div class="row">
        <div class="col-lg-9 align-self-center">
          <div class="row">
            <div class="col-lg-12">
              <form id="contact" action="prosespesan.php" method="post">
                <div class="row">
                  <div class="col-lg-12">
                    <h2>Mari kita menghubungi</h2>
                  </div>
                  <div class="col-lg-4">
                    <fieldset>
                      <input name="name" type="text" id="name" placeholder="NAMA...*" required="">
                    </fieldset>
                  </div>
                  <div class="col-lg-4">
                    <fieldset>
                    <input name="email" type="text" id="email" pattern="[^ @]*@[^ @]*" placeholder="EMAIL..." required="">
                  </fieldset>
                  </div>
                  <div class="col-lg-4">
                    <fieldset>
                      <input name="subject" type="text" id="subject" placeholder="SUBJECT...*" required="">
                    </fieldset>
                  </div>
                  <div class="col-lg-12">
                    <fieldset>
                      <textarea name="message" type="text" class="form-control" id="message" placeholder="YOUR MESSAGE..." required=""></textarea>
                    </fieldset>
                  </div>
                  <div class="col-lg-12">
                    <fieldset>
                      <button type="submit" id="form-submit" class="button">KIRIM</button>
                    </fieldset>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="col-lg-3">
            <div class="right-info">
                <ul>
                    <?php
                    // Query untuk mengambil data dari tabel tbl_profil
                    $query = "SELECT * FROM tbl_profil";
                    $result = mysqli_query($koneksi, $query);

                    // Periksa apakah ada hasil yang dikembalikan
                    if (mysqli_num_rows($result) > 0) {
                        // Looping untuk menampilkan data dalam markup HTML
                        while ($row = mysqli_fetch_assoc($result)) {
                            $phoneNumber = $row['no_tlpn'];
                            $emailAddress = $row['email'];
                            $streetAddress = $row['alamat'];
                            ?>
                            <li>
                                <h6>Phone Number</h6>
                                <span><?php echo $phoneNumber; ?></span>
                            </li>
                            <li>
                                <h6>Email Address</h6>
                                <span><?php echo $emailAddress; ?></span>
                            </li>
                            <li>
                                <h6>Street Address</h6>
                                <span><?php echo $streetAddress; ?></span>
                            </li>
                            <?php
                        }
                    } else {
                        // Tampilkan pesan jika tidak ada data yang ditemukan
                        echo "<p>Tidak ada data profil yang ditemukan.</p>";
                    }
                    ?>
                </ul>
            </div>
        </div>
      </div>
    </div>
    <div class="footer">
      <p>Copyright <?php echo date("Y"); ?> SMKN 2 LANGSA. 
    </div>
  </section>

  <!-- Scripts -->
  <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="assets/js/isotope.min.js"></script>
    <script src="assets/js/owl-carousel.js"></script>
    <script src="assets/js/lightbox.js"></script>
    <script src="assets/js/tabs.js"></script>
    <script src="assets/js/video.js"></script>
    <script src="assets/js/slick-slider.js"></script>
    <script src="assets/js/custom.js"></script>
    <script>
        //according to loftblog tut
        $('.nav li:first').addClass('active');

        var showSection = function showSection(section, isAnimate) {
          var
          direction = section.replace(/#/, ''),
          reqSection = $('.section').filter('[data-section="' + direction + '"]'),
          reqSectionPos = reqSection.offset().top - 0;

          if (isAnimate) {
            $('body, html').animate({
              scrollTop: reqSectionPos },
            800);
          } else {
            $('body, html').scrollTop(reqSectionPos);
          }

        };

        var checkSection = function checkSection() {
          $('.section').each(function () {
            var
            $this = $(this),
            topEdge = $this.offset().top - 80,
            bottomEdge = topEdge + $this.height(),
            wScroll = $(window).scrollTop();
            if (topEdge < wScroll && bottomEdge > wScroll) {
              var
              currentId = $this.data('section'),
              reqLink = $('a').filter('[href*=\\#' + currentId + ']');
              reqLink.closest('li').addClass('active').
              siblings().removeClass('active');
            }
          });
        };

        $('.main-menu, .responsive-menu, .scroll-to-section').on('click', 'a', function (e) {
          e.preventDefault();
          showSection($(this).attr('href'), true);
        });

        $(window).scroll(function () {
          checkSection();
        });
    </script>
</body>

</body>
</html>