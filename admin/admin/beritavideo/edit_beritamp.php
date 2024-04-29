<?php
function isYouTubeURL($url) {
    $pattern = '/^(?:https:\/\/www\.youtube\.com\/watch\?v=|https:\/\/youtu\.be\/)([a-zA-Z0-9_-]+)/';
    return preg_match($pattern, $url);
}

function getYoutubeVideoId($url) {
    $video_id = 'gambar';
    
    if (isYouTubeURL($url)) {
        $video_id = preg_replace('/^(?:https:\/\/www\.youtube\.com\/watch\?v=|https:\/\/youtu\.be\/)([a-zA-Z0-9_-]+)/', '$1', $url);
    }
    
    return $video_id;
}

if (isset($_GET['kode'])) {
    $sql_cek = "SELECT * FROM tbl_berita WHERE id_berita='" . $_GET['kode'] . "'";
    $query_cek = mysqli_query($koneksi, $sql_cek);
    $data_cek = mysqli_fetch_array($query_cek, MYSQLI_BOTH);
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
                    <input type="hidden" class="form-control" id="id_berita" name="id_berita" value="<?php echo $data_cek['id_berita']; ?>" readonly />
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Judul Berita</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control" id="judul_berita" name="judul_berita" value="<?php echo $data_cek['judul_berita']; ?>" />
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Deskripsi</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="deskripsi" name="deskripsi" value="<?php echo $data_cek['deskripsi']; ?>" />
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Media</label>
                <div class="col-sm-6">
                    <?php
                    $gambar = $data_cek['gambar_berita'];

                    if (isYouTubeURL($data_cek['gambar_berita'])) {
                        echo '<iframe width="320" height="180" src="https://www.youtube.com/embed/' . getYoutubeVideoId($data_cek['gambar']) . '" frameborder="0" allowfullscreen></iframe>';
                    } else {
                        echo 'Media tidak valid';
                    }
                    ?>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Ubah Link Media</label>
                <div class="col-sm-6">
                    <input type="text" id="gambar" name="gambar">
                </div>
            </div>
        </div>

        <div class="card-footer">
            <input type="submit" name="Ubah" value="Simpan" class="btn btn-success">
            <a href="?page=data-beritamp" title="Kembali" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>

<?php
if (isset($_POST['Ubah'])) {
    $new_media = $_POST['gambar_berita'];

    if (isYouTubeURL($new_media)) {
        $sql_ubah = "UPDATE tbl_berita SET
            judul_berita='" . $_POST['judul_berita'] . "',
            deskripsi='" . $_POST['deskripsi'] . "',
            gambar_berita ='" . $new_media . "'
            WHERE id_berita='" . $_POST['id_berita'] . "'";
        $query_ubah = mysqli_query($koneksi, $sql_ubah);
    }

    if ($query_ubah) {
        echo "<script>
        Swal.fire({title: 'Ubah Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
        }).then((result) => {
            if (result.value) {
                window.location = 'index.php?page=data-beritamp';
            }
        })</script>";
    } else {
        echo "<script>
        Swal.fire({title: 'Ubah Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
        }).then((result) => {
            if (result.value) {
                window.location = 'index.php?page=data-beritamp';
            }
        })</script>";
    }
}
?>
