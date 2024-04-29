<div class="card card-info">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-table"></i> Profil Sekolah</h3>
	</div>
	<!-- /.card-header -->
	<div class="card-body">
		<div class="table-responsive">
			<table id="" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>Nama Sekolah</th>
						<th>Deskripsi</th>
						<th>Alamat</th>
						<th>Icon</th>
						<th>Jam Masuk</th>
						<th>Jam Pulang</th>
						<th>Facebook</th>
						<th>Instagram</th>
						<th>Youtube</th>
						<th>No Telepon</th>
						<th>Email</th>
						<th>Kelola</th>
					</tr>
				</thead>
				<tbody>

				<?php
$no = 1;
$sql = $koneksi->query("SELECT * FROM tbl_profil");
while ($data = $sql->fetch_assoc()) {
?>

    <tr>
        <td>
            <?php echo $data['nama_profil']; ?>
        </td>
		<td>
            <?php echo $data['deskripsi']; ?>
        </td>
        <td>
            <?php echo $data['alamat']; ?>
        </td>
        <td align="center">
			<?php
			$logo = $data['logo']; // Ambil nama file dari data

			// Periksa ekstensi file
			$ekstensi = pathinfo($logo, PATHINFO_EXTENSION);

			if ($ekstensi === 'jpg' || $ekstensi === 'jpeg' || $ekstensi === 'png') {
				// Tampilkan logo jika ekstensi adalah JPG, JPEG, atau PNG
				echo '<img src="foto/' . $logo . '" width="150" height="100" alt="logo">';
			} else {
				// Tampilkan pesan alternatif jika ekstensi tidak dikenali
				echo 'File tidak dikenali';
			}
			?>
		</td>
        <td>
            <?php echo $data['jam_masuk']; ?>
        </td>
		<td>
            <?php echo $data['jam_pulang']; ?>
        </td>
        <td>
            <?php echo $data['facebook']; ?>
        </td>
        <td>
            <?php echo $data['instagram']; ?>
        </td>
        <td>
            <?php echo $data['youtube']; ?>
        </td>
        <td>
            <?php echo $data['no_tlpn']; ?>
        </td>
        <td>
            <?php echo $data['email']; ?>
        </td>
        <td>
            <a href="?page=edit-profil&kode=<?php echo $data['id_profil']; ?>" title="Ubah" class="btn btn-success btn-sm">
                <i class="fa fa-wrench"></i>
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