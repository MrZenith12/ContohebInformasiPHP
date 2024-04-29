<?php
include "admin/inc/koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai yang dikirim melalui form
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    
    // Validasi data jika diperlukan
    
    // Masukkan data ke dalam tabel database
    $sql = "INSERT INTO tbl_pesan (name, email, subject, message) VALUES ('$name', '$email', '$subject', '$message')";
    
    if (mysqli_query($koneksi, $sql)) {
        echo "<script>
                alert('Pesan berhasil dikirim. Terima kasih!');
                window.location = 'index.php'; 
            </script>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($koneksi);
    }
}
?>