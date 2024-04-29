<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fa fa-table"></i> Data Siswa </h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="table-responsive">
            <div>
                <a href="?page=add-siswa" class="btn btn-primary">
                    <i class="fa fa-edit"></i> Tambah Data</a>
                <a href="?page=data-siswa" title="Kembali" class="btn btn-danger">Kembali</a>
            </div>
            <br>
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Gambar</th>
                        <th>NISN</th>
                        <th>Nama Siswa</th>
                        <th>Kejuruan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Ubah query SQL untuk mengurutkan data berdasarkan nama siswa dalam urutan abjad
                    $sql = $koneksi->query("SELECT * FROM tbl_siswa ORDER BY nama_siswa ASC");
                    $no = 1;
                    while ($data = $sql->fetch_assoc()) {
                    ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td align="center">
                                <?php
                                $gambar_siswa = $data['gambar']; // Ambil nama file dari data

                                // Periksa ekstensi file
                                $ekstensi = pathinfo($gambar_siswa, PATHINFO_EXTENSION);

                                if ($ekstensi === 'jpg' || $ekstensi === 'jpeg' || $ekstensi === 'png') {
                                    // Tampilkan gambar_siswa jika ekstensi adalah JPG, JPEG, atau PNG
                                    echo '<img src="foto/' . $gambar_siswa . '" width="150" height="100" alt="Gambar_siswa">';
                                } else {
                                    // Tampilkan pesan alternatif jika ekstensi tidak dikenali
                                    echo 'File tidak dikenali';
                                }
                                ?>
                            </td>
                            <td><?php echo sprintf("%010d", $data['NISN']); ?></td>
                            <td><?php echo $data['nama_siswa']; ?></td>
                            <td><?php echo $data['jurusan']; ?></td>
                            <td>
                                <a href="?page=edit-siswa&kode=<?php echo $data['id_siswa']; ?>" title="Ubah" class="btn btn-success btn-sm">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="?page=del-siswa&kode=<?php echo $data['id_siswa']; ?>" onclick="return confirm('Apakah anda yakin hapus data ini ?')" title="Hapus" class="btn btn-danger btn-sm">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- /.card-body -->
</div>
