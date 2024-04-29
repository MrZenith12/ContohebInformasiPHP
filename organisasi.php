<?php 
  include "admin/inc/koneksi.php";
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
    <meta name="author" content="Template Mo">
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
                         <li><a href="index.php">Home</a></li> 
                          <li><a href="berita.php" >Berita</a></li>
                          <li><a href="gallery.php" >Gallery</a></li> 
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
                          <li><a href="organisasi.php" class="active">Ekskul</a></li>
                          <li><a href="index.php">Contact Us</a></li> 
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

  <section class="heading-page header-text" id="top">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
            <h2>Gallery SMKN 2 LANGSA</h2>
        </div>
      </div>
    </div>
  </section>

  <!-- bagian galeri -->
  <section class="upcoming-meetings" id="meetings">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-heading">
                    <h2>Ekstrakurikuler</h2>
                </div>
            </div>
            
            <?php
            // Hitung jumlah total berita dari tabel tbl_organisasi
            $sql_total_ekskul = "SELECT COUNT(*) AS total FROM tbl_organisasi";
            $result_total_ekskul = $koneksi->query($sql_total_ekskul);
            $total_ekskul = $result_total_ekskul->fetch_assoc()['total'];
            $ekskul_per_halaman = 6; // Jumlah berita yang ingin ditampilkan per halaman
            $total_halaman = ceil($total_ekskul / $ekskul_per_halaman);
            $halaman_saat_ini = isset($_GET['halaman']) ? $_GET['halaman'] : 1;

            // Hitung offset berdasarkan nomor halaman dan jumlah berita per halaman
            $offset = ($halaman_saat_ini - 1) * $ekskul_per_halaman;

            // Query untuk mengambil berita terbaru dari tabel tbl_organisasi dengan offset dan limit sesuai halaman yang diminta
            $sql = "SELECT * FROM tbl_organisasi ORDER BY tanggal DESC LIMIT $ekskul_per_halaman OFFSET $offset";
            $result = $koneksi->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $nama_organisasi = $row['nama_organisasi'];
                    $deskripsi = $row['deskripsi'];
                    $deskripsiArray = explode(' ', $deskripsi);
                    $deskripsiShort = implode(' ', array_slice($deskripsiArray, 0, 5)) . '...';
            ?>
                    <div class="col-lg-4">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="meeting-item">
                                    <div class="thumb">
                                        <?php
                                        $gambar = $row['gambar_organisasi'];
                                        $ekstensi = pathinfo($gambar, PATHINFO_EXTENSION);

                                        if ($ekstensi === 'jpg' || $ekstensi === 'jpeg' || $ekstensi === 'png') {
                                            echo '<a href="news_details.html"><img src="admin/foto/' . $gambar . '" alt=""></a>';
                                        } elseif (isYouTubeURL($gambar)) {
                                            echo '<iframe style="width: 100%; height: 200px; object-fit: cover;" src="https://www.youtube.com/embed/' . getYoutubeVideoId($gambar) . '" frameborder="0" allowfullscreen></iframe>';
                                        } else {
                                            echo 'File tidak dikenali';
                                        }
                                        ?>
                                    </div>
                                    <div class="down-content">
                                        <h4><?php echo $nama_organisasi; ?></h4>
                                        <p><?php echo $deskripsiShort; ?> <a href="detail/detailorganisasi.php?id_organisasi=<?php echo $row['id_organisasi']; ?>">Selengkapnya</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php
                }
            }
            ?>

            <?php if ($total_halaman > 1) : ?>
                <div class="row">
                    <div class="col-xl-1 text-center">
                        <div class="single-events-btn mt-15 mb-25">
                            <nav class="course-pagination mb-30" aria-label="Page navigation example">
                                <ul class="pagination justify-content-center">
                                    <?php if ($halaman_saat_ini > 1) : ?>
                                        <li class="page-item"><a class="page-link" href="?halaman=<?php echo $halaman_saat_ini - 1; ?>"><span class="ti-angle-left"></span></a></li>
                                    <?php endif; ?>

                                    <?php for ($i = 1; $i <= $total_halaman; $i++) : ?>
                                        <li class="page-item <?php echo $i == $halaman_saat_ini ? 'active' : ''; ?>"><a class="page-link" href="?halaman=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                                    <?php endfor; ?>

                                    <?php if ($halaman_saat_ini < $total_halaman) : ?>
                                        <li class="page-item"><a class="page-link" href="?halaman=<?php echo $halaman_saat_ini + 1; ?>"><span class="ti-angle-right"></span></a></li>
                                    <?php endif; ?>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="footer">
        <p>Hak Cipta <?php echo date("Y"); ?> SMKN 2 LANGSA.</p>
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
    <script src="assets/js/isotope.js"></script>
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
