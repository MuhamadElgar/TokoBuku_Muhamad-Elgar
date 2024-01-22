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

$update_success = false;
if (isset($_POST['edit_buku'])) {
    $id_buku = $_POST['id_buku'];
    $kategori = $_POST['kategori'];
    $nama_buku = $_POST['nama_buku'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $penerbit = $_POST['penerbit'];

    $update_query = "UPDATE tabel_buku SET Kategori='$kategori', Nama_Buku='$nama_buku', Harga='$harga', Stok='$stok', Penerbit='$penerbit' WHERE ID_Buku='$id_buku'";
    $update_result = mysqli_query($koneksi, $update_query);

    if ($update_result) {
        $update_success = true;
    }
}

if (isset($_POST['edit_penerbit'])) {
    $id_penerbit = $_POST['id_penerbit'];
    $nama_penerbit = $_POST['nama_penerbit'];
    $alamat = $_POST['alamat'];
    $kota = $_POST['kota'];
    $telepon = $_POST['telepon'];

    $query_update_penerbit = "UPDATE tabel_penerbit 
                              SET Nama = '$nama_penerbit', Alamat = '$alamat', Kota = '$kota', Telepon = '$telepon' 
                              WHERE ID_Penerbit = '$id_penerbit'";
    
    $update_result = mysqli_query($koneksi, $query_update_penerbit);

    if ($update_result) {
        $update_success = true;
    }
}
?>

<div id="myModal" class="modal">
    <div class="modal-content">
        <?php if ($update_success) { ?>
            <p>Perubahan berhasil disimpan ke database.</p>
        <?php } else { ?>
            <p>Gagal menyimpan perubahan ke database.</p>
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
