<div class="card card-info">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fa fa-table"></i> SubMenu
        </h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="table-responsive">
            <div>
                <a href="?page=add-submenu" class="btn btn-primary">
                    <i class="fa fa-edit"></i> Tambah Data
                </a>
            </div>
            <br>
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Menu</th>
                        <th>Nama Sub Menu</th>
                        <th>Status</th>
                        <th>Urutan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $no = 1;
                    $sql = $koneksi->query("SELECT tbl_submenu.*, tbl_menu.nama_menu FROM tbl_submenu LEFT JOIN tbl_menu ON tbl_submenu.id_menu = tbl_menu.id_menu");
                    while ($data = $sql->fetch_assoc()) {
                    ?>

                        <tr>
                            <td>
                                <?php echo $no++; ?>
                            </td>
                            <td>
                                <?php echo $data['nama_menu'] ?? ''; ?>
                            </td>
                            <td>
                                <?php echo $data['nama_submenu'] ?? ''; ?>
                            </td>
                            <td>
                                <?php echo $data['status'] ?? ''; ?>
                            </td>
                            <td>
                                <?php echo $data['urutan'] ?? ''; ?>
                            </td>

                            <td>
                                <a href="?page=edit-submenu&kode=<?php echo $data['id_submenu']; ?>" title="Ubah" class="btn btn-success btn-sm">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="?page=del-submenu&kode=<?php echo $data['id_submenu']; ?>" onclick="return confirm('Apakah anda yakin hapus data ini ?')" title="Hapus" class="btn btn-danger btn-sm">
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