<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['messageIds'])) {

    include '../database/koneksi.php'; 

    $messageIds = $_POST['messageIds'];
    $deletedCount = 0;

    foreach ($messageIds as $messageId) {
        $sql = "DELETE FROM tbl_pesan WHERE id_pesan = " . intval($messageId);

        if (mysqli_query($koneksi, $sql)) {
            $deletedCount++;
        }
    }

    mysqli_close($koneksi);

    if ($deletedCount > 0) {
        echo "Berhasil menghapus $deletedCount pesan.";
    } else {
        echo "Gagal menghapus pesan.";
    }
} else {
    echo "Akses tidak valid.";
}
