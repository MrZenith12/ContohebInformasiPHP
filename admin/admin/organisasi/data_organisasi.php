<div class="card card-info">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-table"></i> Organisasi </h3>
	</div>
	<!-- /.card-header -->
	<div class="card-body">
		<div class="table-responsive">
			<div>
                <a href="?page=add-organisasi" class="btn btn-primary">
                    <i class="fa fa-edit"></i> Tambah Data
                </a>
            </div>
            <br>
			<table id="" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>No</th>
						<th>Gambar Organisasi</th>
						<th>Nama Organisasi</th>
						<th>Deskripsi</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>

					<?php
              $no = 1;
			  $sql = $koneksi->query("SELECT * from tbl_organisasi");
              while ($data= $sql->fetch_assoc()) {
            ?>

					<tr>
						<td>
							<?php echo $no++; ?>
						</td>
						<td align="center">
							<img src="foto/<?php echo $data['gambar_organisasi']; ?>" width="140px" />
						</td>
						<td>
							<?php echo $data['nama_organisasi']; ?>
						</td>
						<td>
							<?php echo $data['deskripsi']; ?>
						</td>

						<td>
							<a href="?page=edit-organisasi&kode=<?php echo $data['id_organisasi']; ?>" title="Ubah" class="btn btn-success btn-sm">
								<i class="fa fa-edit"></i>
							</a>
							<a href="?page=del-organisasi&kode=<?php echo $data['id_organisasi']; ?>" onclick="return confirm('Apakah anda yakin hapus data ini ?')"
							 title="Hapus" class="btn btn-danger btn-sm">
								<i class="fa fa-trash"></i>
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