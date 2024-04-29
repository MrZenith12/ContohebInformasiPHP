<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fa fa-table"></i> Menu
        </h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="table-responsive">
            <div>
                <a href="?page=add-menu" class="btn btn-primary">
                    <i class="fa fa-edit"></i> Tambah Data
                </a>
            </div>
            <br>
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Menu Utama</th>
                        <th>Nama Menu</th>
                        <th>Status</th>
                        <th>Urutan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $no = 1;
                    $sql = $koneksi->query("SELECT tbl_menu.*, tbl_menuutama.nama_menuutama FROM tbl_menu LEFT JOIN tbl_menuutama ON tbl_menu.id_menuutama = tbl_menuutama.id_menuutama");
                    while ($data = $sql->fetch_assoc()) {
                    ?>

                        <tr>
                            <td>
                                <?php echo $no++; ?>
                            </td>
                            <td>
                                <?php echo $data['nama_menuutama'] ?? ''; ?>
                            </td>
                            <td>
                                <?php echo $data['nama_menu'] ?? ''; ?>
                            </td>
                            <td>
                                <?php echo $data['status'] ?? ''; ?>
                            </td>
                            <td>
                                <?php echo $data['urutan'] ?? ''; ?>
                            </td>

                            <td>
                                <a href="?page=edit-menu&kode=<?php echo $data['id_menu']; ?>" title="Ubah" class="btn btn-success btn-sm">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="?page=del-menu&kode=<?php echo $data['id_menu']; ?>" onclick="return confirm('Apakah anda yakin hapus data ini ?')" title="Hapus" class="btn btn-danger btn-sm">
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