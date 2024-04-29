<?php

if(isset($_GET['kode'])){
    $sql_cek = "select * from tbl_berita where id_berita='".$_GET['kode']."'";
    $query_cek = mysqli_query($koneksi, $sql_cek);
    $data_cek = mysqli_fetch_array($query_cek,MYSQLI_BOTH);
}
?>

<?php
    $gambar= $data_cek['gambar_berita'];
    if (file_exists("foto/$gambar")){
        unlink("foto/$gambar");
    }

    $sql_hapus = "DELETE FROM tbl_berita WHERE id_berita='".$_GET['kode']."'";
    $query_hapus = mysqli_query($koneksi, $sql_hapus);
    if ($query_hapus) {
        echo "<script>
        Swal.fire({title: 'Hapus Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
        }).then((result) => {if (result.value) {window.location = 'index.php?page=data-beritaimg'
        ;}})</script>";
        }else{
        echo "<script>
        Swal.fire({title: 'Hapus Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
        }).then((result) => {if (result.value) {window.location = 'index.php?page=data-beritaimg'
        ;}})</script>";
    }
