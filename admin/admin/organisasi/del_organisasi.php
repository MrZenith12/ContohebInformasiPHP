<?php

if(isset($_GET['kode'])){
    $sql_cek = "SELECT * from tbl_organisasi where id_organisasi='".$_GET['kode']."'";
    $query_cek = mysqli_query($koneksi, $sql_cek);
    $data_cek = mysqli_fetch_array($query_cek,MYSQLI_BOTH);
}
?>

<?php
    $gambar_organisasi= $data_cek['gambar_organisasi'];
    if (file_exists("foto/$gambar_organisasi")){
        unlink("foto/$gambar_organisasi");
    }

    $sql_hapus = "DELETE FROM tbl_organisasi WHERE id_organisasi='".$_GET['kode']."'";
    $query_hapus = mysqli_query($koneksi, $sql_hapus);
    if ($query_hapus) {
        echo "<script>
        Swal.fire({title: 'Hapus Data Berhasil',text: '',icon: 'success',confirmButtonText: 'OK'
        }).then((result) => {if (result.value) {window.location = 'index.php?page=data-organisasi'
        ;}})</script>";
        }else{
        echo "<script>
        Swal.fire({title: 'Hapus Data Gagal',text: '',icon: 'error',confirmButtonText: 'OK'
        }).then((result) => {if (result.value) {window.location = 'index.php?page=data-organisasi'
        ;}})</script>";
    }
