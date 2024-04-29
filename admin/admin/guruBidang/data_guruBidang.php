<div class="card card-info">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-table"></i> Guru Bidang </h3>
	</div>
	<!-- /.card-header -->
	<div class="card-body">
		<div class="table-responsive">
			<div>
				<a href="?page=add-bidang" class="btn btn-primary">
					<i class="fa fa-edit"></i> Tambah Data</a>
			</div>
			<br>
			<table id="example1" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>No</th>
						<th>Gambar Guru</th>
						<th>Nama Guru</th>
						<th>NIP</th>
						<th>Jenis Kelamin</th>
						<th>Mapel / Jabatan</th>
						<th>Tugas Tambahan</th>
						<th>Agama</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>

					<?php
              $no = 1;
			  $sql = $koneksi->query("SELECT * from tbl_guru");
              while ($data= $sql->fetch_assoc()) {
            ?>

					<tr>
						<td>
							<?php echo $no++; ?>
						</td>
						<td align="center">
							<img src="foto/<?php echo $data['gambar']; ?>" width="70px" />
						</td>
						<td>
							<?php echo $data['nama_guru']; ?>
						</td>
						<td>
							<?php echo $data['NIP']; ?>
						</td>
						<td>
							<?php echo $data['JK']; ?>
						</td>
						<td>
							<?php echo $data['mapel']; ?>
						</td>
						<td>
							<?php echo $data['tugastambahan']; ?>
						</td>
						<td>
							<?php echo $data['agama']; ?>
						</td>

						<td>
							</a>
							<a href="?page=edit-bidang&kode=<?php echo $data['id_guru']; ?>" title="Ubah" class="btn btn-success btn-sm">
								<i class="fa fa-edit"></i>
							</a>
							<a href="?page=del-bidang&kode=<?php echo $data['id_guru']; ?>" onclick="return confirm('Apakah anda yakin hapus data ini ?')"
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