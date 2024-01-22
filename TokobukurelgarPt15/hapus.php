<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Data Buku</title>
    <link rel="stylesheet" type="text/css" href="index.css">
    <style>
        /* Gaya visual untuk form */
        form {
            width: 400px;
            margin: auto;
        }

        /* Gaya visual untuk modal */
        .modal {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            background-color: #f1f1f1;
            z-index: 1;
        }

        .modal-content {
            text-align: center;
        }

        .close-btn {
            background-color: #4CAF50;
            color: white;
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .close-btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<?php
include 'koneksi.php';

$update_success = false; // Initialize the variable

if (isset($_POST['hapus_buku'])) {
    $id_buku = $_POST['id_buku'];
    $query_delete_buku = "DELETE FROM tabel_buku WHERE ID_Buku = '$id_buku'";
    $delete_result = mysqli_query($koneksi, $query_delete_buku);

    if ($delete_result) {
        $update_success = true; // Set the variable to true if the deletion is successful
    }
}

if (isset($_POST['hapus_penerbit'])) {
    $id_penerbit = $_POST['id_penerbit'];
    $query_delete_penerbit = "DELETE FROM tabel_penerbit WHERE ID_Penerbit = '$id_penerbit'";
    $delete_result = mysqli_query($koneksi, $query_delete_penerbit);

    if ($delete_result) {
        $update_success = true; // Set the variable to true if the deletion is successful
    }
}
?>

<div id="myModal" class="modal">
    <div class="modal-content">
        <?php if ($update_success) { ?>
            <p>Menghapus ke database berhasil!</p>
        <?php } else { ?>
            <p>Gagal menghapus ke database.</p>
        <?php } ?>
        <button class="close-btn" onclick="window.location.href='admin.php'">Kembali</button>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        var modal = document.getElementById('myModal');
        modal.style.display = 'block';
    });
</script>

</body>
</html>
