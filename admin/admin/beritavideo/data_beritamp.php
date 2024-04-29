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
?>

<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fa fa-table"></i> Berita Video
        </h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="table-responsive">
            <div>
                <a href="?page=add-beritamp" class="btn btn-primary">
                    <i class="fa fa-edit"></i> Tambah Data
                </a>
            </div>
            <br>
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Video</th>
                        <th>Judul Berita</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $no = 1;
                    // Mengambil data dari database
                    $sql = $koneksi->query("SELECT * FROM tbl_berita");
                    while ($data = $sql->fetch_assoc()) {
                        // Check if it's a valid YouTube URL before displaying
                        if (isYouTubeURL($data['gambar_berita'])) {
                    ?>

                    <tr>
                        <td>
                            <?php echo $no++; ?>
                        </td>
                        <td>
                            <iframe width="320" height="180" src="https://www.youtube.com/embed/<?php echo getYoutubeVideoId($data['gambar_berita']); ?>" frameborder="0" allowfullscreen></iframe>
                        </td>
                        <td>
                            <?php echo $data['judul_berita']; ?>
                        </td>
                        <td>
                            <?php echo $data['deskripsi']; ?>
                        </td>
                        <td>
                            <a href="?page=edit-beritamp&kode=<?php echo $data['id_berita']; ?>" title="Ubah" class="btn btn-success btn-sm">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a href="?page=del-beritamp&kode=<?php echo $data['id_berita']; ?>" onclick="return confirm('Apakah anda yakin hapus data ini ?')" title="Hapus" class="btn btn-danger btn-sm">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
                    </tr>

                    <?php
                        }
                    }
                    ?>
                </tbody>
                </tfoot>
            </table>
        </div>
    </div>
    <!-- /.card-body -->
</div>
