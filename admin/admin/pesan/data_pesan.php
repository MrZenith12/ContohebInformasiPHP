<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php'; // Mengimpor PHPMailer

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['Simpan'])) {
    // Alamat email pengirim
    $to = $_POST["to"];
    $subject = $_POST["subject"];
    $message = $_POST["message"];
    $id_pesan = $_POST["id_pesan"];
    $pesan = "Pesan anda sudah dibalas oleh admin SMKN 2 Langsa";

    $mail = new PHPMailer();

    // Konfigurasi SMTP
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com'; // Ganti dengan server SMTP Anda
    $mail->SMTPAuth = true;
    $mail->Username = 'alif04hilal@gmail.com'; // Ganti dengan alamat email Anda
    $mail->Password = 'alif130706'; // Ganti dengan kata sandi email Anda

    // Opsi keamanan
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Anda dapat menggunakan ENCRYPTION_SMTPS jika menginginkan SSL
    $mail->Port = 587; // Ganti dengan port yang sesuai

    // Alamat email pengirim
    $mail->setFrom('alif04hilal@gmail.com', 'alif'); // Ganti dengan alamat email dan nama Anda
    // Alamat email penerima
    $mail->addAddress($to);
    // Subjek email
    $mail->Subject = $subject;
    // Isi email
    $mail->Body = $pesan;

    // Mengirim email
    if ($mail->send()) {

        $sql = "INSERT INTO tbl_balasadmin (id_pesan, name, to_email, subject, message) VALUES ('$id_pesan', 'SMKN2Langsa', '$to', '$subject', '$message')";

        if ($koneksi->query($sql) === true) {
            echo 'Email terkirim dan disimpan dalam database.';
        } else {
            echo 'Gagal menyimpan email dalam database: ' . $koneksi->error;
        }

    } else {
        echo 'Gagal mengirim email: ' . $mail->ErrorInfo;
    }
}
?>

<div class="container">
    <div class="row">
        <div class="col-md-9">
            <h2>Incoming Messages</h2>
            <button id="refreshButton" class="btn btn-primary">Refresh</button>
            <button id="selectAllButton" class ="btn btn-primary">Pilih Semua</button>
            <button id="deleteButton" class="btn btn-danger">Hapus</button>

            <form id="messageForm" method="POST">
                <?php
                $sql = "SELECT id_pesan, name, email, message FROM tbl_pesan";
                $result = mysqli_query($koneksi, $sql);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<div class="card">';
                        echo '<div class="card-body">';
                        echo '<h5 class="card-title">From: ' . $row['name'] . '</h5>';
                        echo '<h5 class="card-title">Email: ' . $row['email'] . '</h5>';
                        echo '<p class="card-text">' . $row['message'] . '</p>';
                        echo '<input type="checkbox" class="messageCheckbox">';
                        
                        // Tombol "Balas" untuk menampilkan form balasan
                        echo '<button class="btn btn-primary btn-reply">Balas</button>';
                        
                        // Form balasan yang awalnya disembunyikan
                        echo '<div class="reply-form" style="display: none;">';
                        echo '<div class="form-group">';
                        echo '<input type="hidden" name="id_pesan" value="'. $row['id_pesan'] . '">';
                        echo '<label for="to">Tujuan:</label>';
                        echo '<input type="text" name="to" id="to" placeholder="Alamat Email Tujuan">';
                        echo '<label for="subject">Subjek:</label>';
                        echo '<input type="text" name="subject" id="subject" placeholder="Subjek Email">';
                        echo '<label for="message">Balasan:</label>';
                        echo '<textarea class="form-control" name="message" id="message" rows="5" placeholder="Tulis balasan Anda di sini"></textarea>';
                        echo '<button type="submit" name="Simpan" class="btn btn-primary">
                        <i class="fa fa-save"></i> Simpan Perubahan
                    </button>';
                        echo '</div>';
                        echo '</div>';
                        
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo '<p>No incoming messages.</p>';
                }
                ?>
            </form>
        </div>
    </div>
</div>

<script>
    let selectAllButton = document.getElementById("selectAllButton");
    let checkboxes = document.getElementsByClassName("messageCheckbox");

    // Tambahkan event listener untuk tombol "Pilih Semua"
    selectAllButton.addEventListener("click", function() {
        for (let i = 0; i < checkboxes.length; i++) {
            checkboxes[i].checked = !checkboxes[i].checked; // Toggle centang
        }
    });

    // Tambahkan event listener untuk tombol "Hapus"
    document.getElementById("deleteButton").addEventListener("click", function() {
    var selectedMessageIds = [];

    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i].checked) {
            selectedMessageIds.push(checkboxes[i].getAttribute("data-message-id"));
        }
    }

    if (selectedMessageIds.length > 0) {
        if (confirm("Anda yakin ingin menghapus pesan terpilih?")) {
            // Send an AJAX request to delete_messages.php
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "hapus.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    alert(xhr.responseText); // Show the response message
                    // Refresh or update the message list as needed
                }
            };
            xhr.send("messageIds=" + selectedMessageIds.join(","));
        }
    } else {
        alert("Tidak ada pesan yang dipilih untuk dihapus.");
    }
});


    // Tambahkan event listener untuk tombol "Balas"
    let replyButtons = document.getElementsByClassName("btn-reply");
    for (let i = 0; i < replyButtons.length; i++) {
        replyButtons[i].addEventListener("click", function(event) {
            event.preventDefault();
            let replyForm = this.nextElementSibling;
            replyForm.style.display = "block";
        });
    }
</script>

