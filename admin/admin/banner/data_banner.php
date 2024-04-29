<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fa fa-table"></i> Banner
        </h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="table-responsive">
            <div>
                <a href="?page=add-banner" class="btn btn-primary">
                    <i class="fa fa-edit"></i> Tambah Data
                </a>
            </div>
            <br>
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
						<th>Gambar</th>
                        <th>Judul Banner</th>
						<th>Status</th>
                        <th>Urutan</th>
                        <th>Deskripsi</th>
						<th>Aksi</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $no = 1;
                    $sql = $koneksi->query("SELECT * FROM tbl_banner");
                    while ($data = $sql->fetch_assoc()) {
                    ?>

                        <tr>
                            <td>
                                <?php echo $no++; ?>
                            </td>
                            <td align="center">
                                <?php
                                $gambar = $data['gambar']; // Ambil nama file dari data

                                // Periksa ekstensi file
                                $ekstensi = pathinfo($gambar, PATHINFO_EXTENSION);

                                if ($ekstensi === 'jpg' || $ekstensi === 'jpeg' || $ekstensi === 'png') {
                                    // Tampilkan gambar jika ekstensi adalah JPG, JPEG, atau PNG
                                    echo '<img src="foto/' . $gambar . '" width="150" height="100" alt="gambar">';
                                } elseif ($ekstensi === 'mp4') {
                                    // Tampilkan video jika ekstensi adalah MP4
                                    echo '<video width="150" height="100" controls>';
                                    echo '<source src="foto/' . $gambar . '" type="video/mp4">';
                                    echo 'Your browser does not support the video tag.';
                                    echo '</video>';
                                } else {
                                    // Tampilkan pesan alternatif jika ekstensi tidak dikenali
                                    echo 'File tidak dikenali';
                                }
                                ?>
                            </td>
                            <td>
                                <?php echo $data['judul_banner']; ?>
                            </td>
                            <td>
                                <?php echo $data['status']; ?>
                            </td>
                            <td>
                                <?php echo $data['urutan']; ?>
                            </td>
                            <td>
                                <?php echo $data['keterangan']; ?>
                            </td>

                            <td>
                                <a href="?page=edit-banner&kode=<?php echo $data['id_banner']; ?>" title="Ubah" class="btn btn-success btn-sm">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="?page=del-banner&kode=<?php echo $data['id_banner']; ?>" onclick="return confirm('Apakah anda yakin hapus data ini ?')" title="Hapus" class="btn btn-danger btn-sm">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>

                    <?php
                    }
                    ?>
                </tbody>
                </tfoot>
            </table>
        </div>
    </div>
    <!-- /.card-body -->
</div>