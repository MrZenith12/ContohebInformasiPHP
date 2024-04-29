<?php 
  include "../admin/inc/koneksi.php";
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
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">


    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="../assets/css/fontawesome.css">
    <link rel="stylesheet" href="../assets/css/templatemo-edu-meeting.css">
    <link rel="stylesheet" href="../assets/css/owl.css">
    <link rel="stylesheet" href="../assets/css/lightbox.css">
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
                          Edu Meeting
                      </a>
                      <!-- ***** Logo End ***** -->
                      <!-- ***** Menu Start ***** -->
                      <ul class="nav">
                          <li><a href="../index.php">Home</a></li>
                          <li><a href="../berita.php">Berita</a></li>
                          <li><a href="../gallery.php">Gallery</a></li>
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
                                      echo '<li><a href="./submenu.php?id_menu=' . $submenu_row['id_menu'] . '">' . $submenu_row['nama_menu'] . '</a></li>';
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
          <h2>Detail Berita</h2>
        </div>
      </div>
    </div>
  </section>

  <section class="meetings-page" id="meetings">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="row">
          <?php
            function isYouTubeURL($url) {
                // Define a regular expression pattern to match YouTube URLs
                $pattern = '/^(?:https:\/\/www\.youtube\.com\/watch\?v=|https:\/\/youtu\.be\/)([a-zA-Z0-9_-]+)/';
                
                return preg_match($pattern, $url);
            }

            function getYoutubeVideoId($url) {
                $video_id = 'gambar';
                
                // Check if the URL is a valid YouTube URL
                if (isYouTubeURL($url)) {
                    // Extract the video ID from the URL
                    $video_id = preg_replace('/^(?:https:\/\/www\.youtube\.com\/watch\?v=|https:\/\/youtu\.be\/)([a-zA-Z0-9_-]+)/', '$1', $url);
                }
                
                return $video_id;
            }

            // Mendapatkan id_berita dari parameter URL
            $id_berita = $_GET['id_berita'];

            // Kode query untuk mengambil data berita yang dipilih
            $query = "SELECT * FROM tbl_berita WHERE id_berita = '$id_berita'";
            $result = mysqli_query($koneksi, $query);

            // Memeriksa apakah data berita ditemukan
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $gambar = $row['gambar'];
                $judul_berita = $row['judul_berita'];
                $tanggal_dimasukkan = $row['tanggal_dimasukkan'];
                $deskripsi = $row['deskripsi'];
                ?>
            <div class="col-lg-12">
              <div class="meeting-single-item">
                <div class="thumb">
                  <div class="date">
                    <h6>Nov <span>12</span></h6>
                  </div>
                  <?php
                    $gambar = $row['gambar_berita'];
                    $ekstensi = pathinfo($gambar, PATHINFO_EXTENSION);

                    if ($ekstensi === 'jpg' || $ekstensi === 'jpeg' || $ekstensi === 'png') {
                        // Jika ekstensi adalah JPG, JPEG, atau PNG, tampilkan gambar
                        echo '<a href="news_details.html"><img src="../admin/foto/' . $gambar . '" alt=""></a>';
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
                  <a href="meeting-details.php"><h4><?php echo $judul_berita; ?></h4></a>
                  <p>Recreio dos Bandeirantes, Rio de Janeiro - RJ, 22795-008, Brazil</p>
                  <p class="description">
                    <?php echo $deskripsi; ?>
                  </p>
                </div>
              </div>
            </div>
            <?php
            } else {
                echo "Berita tidak ditemukan.";
            }
            ?>
            <div class="col-lg-12">
              <div class="main-button-red">
                <a href="../berita.php">Kembali Ke Halaman Berita</a>
              </div>
            </div>
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
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="../assets/js/isotope.min.js"></script>
    <script src="../assets/js/owl-carousel.js"></script>
    <script src="../assets/js/lightbox.js"></script>
    <script src="../assets/js/tabs.js"></script>
    <script src="../assets/js/video.js"></script>
    <script src="../assets/js/slick-slider.js"></script>
    <script src="../assets/js/custom.js"></script>
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
