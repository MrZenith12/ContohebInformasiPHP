<?php
	include "../inc/koneksi.php";
	
	$id_pejabat = $_GET['id_pejabat'];

	$sql_cek = "SELECT * FROM tbl_profil";
	$query_cek = mysqli_query($koneksi, $sql_cek);
	$data_cek = mysqli_fetch_array($query_cek,MYSQLI_BOTH);
	{
?>


<!DOCTYPE html>
<html lang="en">

<head>
	<title>CETAK DATA PEJABAT</title>
</head>

<body>
	<center>

		<h2>
			<?php echo $data_cek['nama_profil']; ?>
		</h2>
		<h3>
			<?php echo $data_cek['alamat']; ?>
			<hr / size="2px" color="black">

			<?php
			}

			$sql_tampil = "SELECT * from tbl_pejabat where id_pejabat='$id_pejabat'";
			$query_tampil = mysqli_query($koneksi, $sql_tampil);
			$no=1;
			while ($data = mysqli_fetch_array($query_tampil,MYSQLI_BOTH)) {
		?>
	</center>

	<center>
		<h4>
			<u>DATA PEJABAT</u>
		</h4>
	</center>

	<table border="1" cellspacing="0" style="width: 90%" align="center">
		<tbody>
			<tr>
				<td rowspan="6" align="center">
					<img src="../foto/<?php echo $data['gambar_pejabat']; ?>" width="150px" />
				</td>
			</tr>
			<tr>
				<td>Nama Pejabat</td>
				<td>:</td>
				<td>
					<?php echo $data['nama_pejabat']; ?>
				</td>
			</tr>
            <tr>
                <td>Posisi</td>
                <td>:</td>
                <td>
                    <?php echo $data['posisi']; ?>
                </td>
            </tr>
			<tr>
				<td>Keterangan</td>
				<td>:</td>
				<td>
					<?php echo $data['keterangan']; ?>
				</td>
			</tr>
			<?php } ?>
		</tbody>
	</table>


	<script>
		window.print();
	</script>

</body>

</html>