<?php
include 'inc/koneksi.php';

// Periksa apakah data sudah ada dalam tabel
$sql_cek_data = "SELECT * FROM tbl_visimisi LIMIT 1";
$query_cek_data = mysqli_query($koneksi, $sql_cek_data);
$data_ada = mysqli_fetch_assoc($query_cek_data);


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $gambar_sumber = $_FILES['gambar']['tmp_name'];
    $gambar_nama = $_FILES['gambar']['name'];
    $visi = $_POST['visi'];
    $misi = $_POST['misi'];
    $target_directory = 'foto/';

    // Periksa ekstensi file
    $ekstensi = pathinfo($gambar_nama, PATHINFO_EXTENSION);

    if (!empty($gambar_sumber) && in_array($ekstensi, array('jpg', 'jpeg', 'png'))) {
        // Gambar baru diunggah, proses pembaruan gambar
        if ($data_ada) {
            // Hapus gambar lama jika ada
            if (!empty($data_ada['gambar'])) {
                unlink($target_directory . $data_ada['gambar']);
            }

            // Ganti nama gambar dengan nama yang baru
            $gambar_nama_baru = uniqid() . '.' . $ekstensi;
            $target_gambar_baru = $target_directory . $gambar_nama_baru;

            // Pindahkan file gambar baru ke direktori target
            move_uploaded_file($gambar_sumber, $target_gambar_baru);

            // Update data di database dengan nama gambar yang baru
            $sql_edit = "UPDATE tbl_visimisi SET gambar = '$gambar_nama_baru', visi = '$visi', misi = '$misi'";
            $query_edit = mysqli_query($koneksi, $sql_edit);

            if ($query_edit) {
                echo "<script>
                Swal.fire({title: 'Edit Data Berhasil', text: '', icon: 'success', confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.value) {
                        window.location = 'index.php?page=data-visi';
                    }
                })</script>";
            } else {
                echo "<script>
                Swal.fire({title: 'Edit Data Gagal', text: '', icon: 'error', confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.value) {
                        window.location = 'index.php?page=data-visi';
                    }
                })</script>";
            }
        } else {
            // Jika data belum ada, lakukan penambahan
            $gambar_nama_baru = uniqid() . '.' . $ekstensi;
            $target_gambar_baru = $target_directory . $gambar_nama_baru;

            // Pindahkan file gambar baru ke direktori target
            move_uploaded_file($gambar_sumber, $target_gambar_baru);

            // Simpan data di database dengan nama gambar yang baru
            $sql_simpan = "INSERT INTO tbl_visimisi (gambar, visi, misi) VALUES (
                '" . $gambar_nama_baru . "',
                '" . $visi . "',
                '" . $misi . "')";

            $query_simpan = mysqli_query($koneksi, $sql_simpan);

            if ($query_simpan) {
                echo "<script>
                Swal.fire({title: 'Tambah Data Berhasil', text: '', icon: 'success', confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.value) {
                        window.location = 'index.php?page=data-visi';
                    }
                })</script>";
            } else {
                echo "<script>
                Swal.fire({title: 'Tambah Data Gagal', text: '', icon: 'error', confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.value) {
                        window.location = 'index.php?page=data-visi';
                    }
                })</script>";
            }
        }
    } else {
        // Tidak ada gambar baru diunggah, hanya update teks
        if (isset($_POST['hapus_gambar'])) {
            // Hapus gambar lama jika tombol "Hapus Gambar" diklik
            if (!empty($data_ada['gambar'])) {
                unlink($target_directory . $data_ada['gambar']);
            }
            
            // Update data di database dengan kolom gambar yang kosong
            $sql_edit = "UPDATE tbl_visimisi SET gambar = '', visi = '$visi', misi = '$misi'";
        } else {
            // Jika tidak ada gambar baru atau permintaan untuk menghapus gambar, hanya update teks
            $sql_edit = "UPDATE tbl_visimisi SET visi = '$visi', misi = '$misi'";
        }

        $query_edit = mysqli_query($koneksi, $sql_edit);

        if ($query_edit) {
            echo "<script>
            Swal.fire({title: 'Edit Data Berhasil', text: '', icon: 'success', confirmButtonText: 'OK'
            }).then((result) => {
                if (result.value) {
                    window.location = 'index.php?page=data-visi';
                }
            })</script>";
        } else {
            echo "<script>
            Swal.fire({title: 'Edit Data Gagal', text: '', icon: 'error', confirmButtonText: 'OK'
            }).then((result) => {
                if (result.value) {
                    window.location = 'index.php?page=data-visi';
                }
            })</script>";
        }
    }
}

?>

<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fa fa-edit"></i> Visi & Misi Sekolah
        </h3>
    </div>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="card-body">

        <div class="form-group">
            <label for="gambar">Gambar</label>
            <input type="file" id="gambar" name="gambar" accept=".jpg, .jpeg, .png">
            <p class="help-block">
                <font color="red">Format file JPG, JPEG & PNG</font>
            </p>
            <?php
            // Periksa apakah gambar sudah ada
            if (isset($data_ada['gambar']) && !empty($data_ada['gambar'])) {
                echo '<br>';
                echo '<img src="foto/' . $data_ada['gambar'] . '" style="max-width: 200px;">';
                // Tambahkan tombol "Hapus Gambar"
                echo '<div>';
                echo '<input type="checkbox" name="hapus_gambar" value="1"> Hapus Gambar';
                echo '</div>';
            }
            ?>
        </div>

        <div class="form-group">
            <label for="visi">Visi</label>
            <textarea class="form-control" id="visi" name="visi" rows="4" placeholder="Visi Anda"><?php echo isset($data_ada['visi']) ? $data_ada['visi'] : ''; ?></textarea>
        </div>

        <div class="form-group">
            <label for="misi">Misi</label>
            <textarea class="form-control" id="misi" name="misi" rows="4" placeholder="Misi Anda"><?php echo isset($data_ada['misi']) ? $data_ada['misi'] : ''; ?></textarea>
        </div>


        </div>
        <div class="card-footer">
            <?php if ($data_ada) : ?>
                <input type="submit" name="Simpan" value="Simpan" class="btn btn-info">
            <?php else : ?>
                <input type="submit" name="Simpan" value="Simpan" class="btn btn-info">
            <?php endif; ?>
        </div>
    </form>
</div>

<!-- Menggunakan TinyMCE sebagai editor -->
<script src="https://cdn.tiny.cloud/1/ss39ko90axoqmp6g9j8t1n5acq9268n5aobkzlu10y0qgqzl/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '#visi',
        height: 300,
        plugins: 'advlist autolink lists link image charmap print preview anchor',
        toolbar: 'undo redo | formatselect | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | custom_line_spacing custom_large_font custom_italic custom_semicolon',
        formats: {
            custom_line_spacing: { selector: 'p,h1,h2,h3,h4,h5,h6', block: 'p,h1,h2,h3,h4,h5,h6', styles: { 'line-height': '2' } },
            custom_large_font: { inline: 'span', styles: { 'font-size': '24px' } },
            custom_italic: { inline: 'span', styles: { 'font-style': 'italic' } },
            custom_semicolon: { inline: 'span', styles: { 'font-size': '24px' } }
        },
        style_formats: [
            { title: 'Custom Line Spacing', format: 'custom_line_spacing' },
            { title: 'Custom Large Font', format: 'custom_large_font' },
            { title: 'Custom Italic', format: 'custom_italic' },
            { title: 'Custom Semicolon', format: 'custom_semicolon' }
        ]
    });

    tinymce.init({
        selector: '#misi',
        height: 300,
        plugins: 'advlist autolink lists link image charmap print preview anchor',
        toolbar: 'undo redo | formatselect | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image'
    });
</script>
