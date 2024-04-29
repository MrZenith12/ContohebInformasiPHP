<?php

if (isset($_GET['kode'])) {
    // Mendapatkan data kepalasekolah sebelum dihapus
    $sql_cek = "SELECT * from tbl_kepalasekolah where id_kepalasekolah='" . $_GET['kode'] . "'";
    $query_cek = mysqli_query($koneksi, $sql_cek);
    $data_cek = mysqli_fetch_array($query_cek, MYSQLI_BOTH);

    // Mendapatkan nama file gambar
    $gambar = $data_cek['gambar'];

    // Menghapus data kepalasekolah dari tabel
    $sql_hapus = "DELETE FROM tbl_kepalasekolah WHERE id_kepalasekolah='" . $_GET['kode'] . "'";
    $query_hapus = mysqli_query($koneksi, $sql_hapus);

    if ($query_hapus) {
        // Pengecekan apakah file gambar ada sebelum dihapus
        if (file_exists("foto/$gambar")) {
            // Menghapus gambar dari direktori
            unlink("foto/$gambar");
            echo "<script>
                Swal.fire({title: 'Hapus Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
                }).then((result) => {if (result.value) {window.location = 'index.php?page=data-kepalasekolah';}});
                </script>";
        } else {
            // Jika file gambar tidak ditemukan
            echo "<script>
                Swal.fire({title: 'File Gambar Tidak Ditemukan',text: '',icon: 'warning',confirmButtonText: 'OK'
                }).then((result) => {if (result.value) {window.location = 'index.php?page=data-kepalasekolah';}});
                </script>";
        }
    } else {
        // Jika query hapus gagal
        echo "<script>
            Swal.fire({title: 'Hapus Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
            }).then((result) => {if (result.value) {window.location = 'index.php?page=data-kepalasekolah';}});
            </script>";
    }
}
?>
