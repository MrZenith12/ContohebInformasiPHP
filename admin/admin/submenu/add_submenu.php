<?php
include 'inc/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['Simpan'])) {
    // Ambil data dari form
    $id_menu = $_POST['id_menu'];
    $nama_submenu = $_POST['nama_submenu'];
    $status = $_POST['status'];
    $urutan = $_POST['urutan'];
    $isi = $_POST['isi'];

    // Proses gambar jika diunggah
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
        // Lokasi sementara file gambar yang diunggah
        $file_tmp = $_FILES['gambar']['tmp_name'];

        // Ambil ekstensi file
        $file_ext = strtolower(pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION));

        // Nama baru untuk file gambar (gunakan timestamp unik)
        $file_name = uniqid() . '.' . $file_ext;

        // Lokasi untuk menyimpan file gambar yang diunggah
        $file_destination = 'foto/' . $file_name;

        // Pindahkan file gambar ke lokasi penyimpanan
        if (move_uploaded_file($file_tmp, $file_destination)) {
            // File gambar berhasil diunggah, lanjutkan dengan proses lainnya

            // Ini adalah bagian penyimpanan konten teks yang diubah menjadi HTML menggunakan TinyMCE
            $isi_teks = $_POST['isi'];

            // Query SQL untuk menambahkan data
            $sql_tambah_submenu = "INSERT INTO tbl_submenu (id_menu, nama_submenu, status, urutan, isi, gambar) VALUES (
                '$id_menu',
                '$nama_submenu',
                '$status',
                '$urutan',
                '$isi_teks',  -- Gunakan konten teks yang diubah menjadi HTML
                '$file_name'
            )";

            // Eksekusi query
            $query_tambah_submenu = mysqli_query($koneksi, $sql_tambah_submenu);

            if ($query_tambah_submenu) {
                // Data berhasil ditambahkan
                echo "<script>
                    Swal.fire({title: 'Tambah Data Berhasil', text: '', icon: 'success', confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.value) {
                            window.location = 'index.php?page=data-submenu';
                        }
                    })</script>";
            } else {
                // Data gagal ditambahkan
                echo "<script>
                    Swal.fire({title: 'Tambah Data Gagal', text: '', icon: 'error', confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.value) {
                            window.location = 'index.php?page=add-submenu';
                        }
                    })</script>";
            }
        } else {
            // File gambar gagal diunggah
            echo "<script>
                Swal.fire({title: 'Upload Gambar Gagal', text: '', icon: 'error', confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.value) {
                        window.location = 'index.php?page=add-submenu';
                    }
                })</script>";
        }
    } else {
        // File gambar tidak diunggah
        echo "<script>
            Swal.fire({title: 'Pilih Gambar Terlebih Dahulu', text: '', icon: 'error', confirmButtonText: 'OK'
            }).then((result) => {
                if (result.value) {
                    window.location = 'index.php?page=add-submenu';
                }
            })</script>";
    }

    // Tutup koneksi database
    mysqli_close($koneksi);
}
?>

<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fa fa-edit"></i> Sub Menu
        </h3>
    </div>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="card-body">
            <div class="form-group">
                <label for="id_menu">Pilih Menu</label>
                <select class="form-control" id="id_menu" name="id_menu" required>
                    <option value="">Pilih Menu</option>
                    <?php
                    // Query SQL untuk mengambil data dari tbl_menuutama
                    $sql_menu = "SELECT * FROM tbl_menu";
                    $query_menu = mysqli_query($koneksi, $sql_menu);

                    while ($data_menu = mysqli_fetch_assoc($query_menu)) {
                        echo "<option value='" . $data_menu['id_menu'] . "'>" . $data_menu['nama_menu'] . "</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="nama_submenu">Sub Menu</label>
                <input type="text" class="form-control" id="nama_submenu" name="nama_submenu" placeholder="Nama Sub Menu" required>
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="Aktif">Aktif</option>
                    <option value="Tidak Aktif">Tidak Aktif</option>
                </select>
            </div>
            <div class="form-group">
                <label for="urutan">Urutan</label>
                <input type="number" class="form-control" id="urutan" name="urutan" placeholder="Urutan" required>
            </div>
            <div class="form-group">
                <label class="col-sm-2 col-form-label">File Gambar</label>
                <div class="col-sm-6">
                    <input type="file" id="gambar" name="gambar" accept=".jpg, .png">
                </div>
            </div>
            <div class="form-group">
                <label for="isi">Isi Konten</label>
                <textarea name="isi" id="isi"></textarea>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" name="Simpan" class="btn btn-primary">
                <i class="fa fa-save"></i> Simpan Perubahan
            </button>
            <a href="?page=data-submenu" class="btn btn-secondary">
                <i class="fa fa-arrow-left"></i> Kembali
            </a>
        </div>
    </form>
</div>
    <script src="https://cdn.tiny.cloud/1/7z31gctppnzbjvmolgazesznc2evcvl8xy9il1du6y4gajak/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: 'advlist autolink lists link image charmap print preview anchor',
            toolbar: 'undo redo | formatselect | ' +
                'bold italic backcolor | alignleft aligncenter ' +
                'alignright alignjustify | bullist numlist outdent indent | ' +
                'removeformat | link image',
        });
    </script>
