<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fa fa-table"></i> Data Siswa </h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div>
            <?php
            // Query untuk mengambil daftar jurusan yang tersedia dari tabel tbl_siswa
            $result = $koneksi->query("SELECT DISTINCT jurusan FROM tbl_siswa");
            // Memeriksa apakah ada jurusan yang tersedia
            if ($result->num_rows > 0) {
            ?>
                <div class="mb-3">
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Pilih Jurusan
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="?page=siswa-jurusan">Semua Jurusan</a>
                            <?php
                            // Menampilkan pilihan jurusan berdasarkan data yang ada dalam tabel tbl_siswa
                            while ($row = $result->fetch_assoc()) {
                                $jurusan = $row['jurusan'];
                            ?>
                                <a class="dropdown-item" href="?page=siswa-jurusan&jurusan=<?php echo urlencode($jurusan); ?>"><?php echo $jurusan; ?></a>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
            <div>
                <a href="?page=add-siswa" class="btn btn-primary">
                    <i class="fa fa-edit"></i> Tambah Data</a>
                <a href="?page=view-all" class="btn btn-secondary">
                    <i class="fa fa-list"></i> View All</a>
            </div>
            <?php
            if (isset($_GET['jurusan'])) {
                $jurusan = $_GET['jurusan'];
                // Memperbarui query SQL berdasarkan jurusan yang dipilih
                if ($jurusan == 'Semua Jurusan') {
                    $sql = $koneksi->query("SELECT * FROM tbl_siswa");
                } else {
                    $sql = $koneksi->query("SELECT * FROM tbl_siswa WHERE jurusan='$jurusan'");
                }
            ?>
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NISN</th>
                            <th>Nama Siswa</th>
                            <th>Jurusan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        while ($data = $sql->fetch_assoc()) {
                        ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $data['NISN']; ?></td>
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
            <?php
            }
            ?>
        </div>
    </div>
    <!-- /.card-body -->
</div>
