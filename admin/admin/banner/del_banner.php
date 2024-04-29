<?php
if(isset($_GET['kode'])){
    $sql_cek = "SELECT * FROM tbl_banner WHERE id_banner='".$_GET['kode']."'";
    $query_cek = mysqli_query($koneksi, $sql_cek);
    $data_cek = mysqli_fetch_array($query_cek, MYSQLI_BOTH);

    // Hapus gambar terkait jika file gambar ada
    $gambar = $data_cek['gambar'];
    if (file_exists("foto/$gambar")) {
        unlink("foto/$gambar");
    }

    $sql_hapus = "DELETE FROM tbl_banner WHERE id_banner='".$_GET['kode']."'";
    $query_hapus = mysqli_query($koneksi, $sql_hapus);

    if ($query_hapus) {
        echo "<script>
        Swal.fire({title: 'Hapus Data Berhasil', text: '', icon: 'success', confirmButtonText: 'OK'
        }).then((result) => {
            if (result.value) {
                window.location = 'index.php?page=data-banner';
            }
        })</script>";
    } else {
        echo "<script>
        Swal.fire({title: 'Hapus Data Gagal', text: '', icon: 'error', confirmButtonText: 'OK'
        }).then((result) => {
            if (result.value) {
                window.location = 'index.php?page=data-banner';
            }
        })</script>";
    }
}
?>
