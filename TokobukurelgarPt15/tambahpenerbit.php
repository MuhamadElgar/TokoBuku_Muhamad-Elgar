<?php
include 'koneksi.php'; // Include the database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['tambah_penerbit'])) {
        // Proses penambahan penerbit ke database
        $id_penerbit = $_POST['id_penerbit']; // You can add this line to get the manually entered ID
        $nama_penerbit = $_POST['nama_penerbit'];
        $alamat = $_POST['alamat'];
        $kota = $_POST['kota'];
        $telepon = $_POST['telepon'];

        $query_tambah_penerbit = "INSERT INTO tabel_penerbit (ID_Penerbit, Nama, Alamat, Kota, Telepon) 
                                  VALUES ('$id_penerbit', '$nama_penerbit', '$alamat', '$kota', '$telepon')";
        
        if (mysqli_query($koneksi, $query_tambah_penerbit)) {
            echo "<script>alert('Penerbit berhasil ditambahkan.'); window.location.href = 'admin.php';</script>";
        } else {
            echo "<script>alert('Gagal menambahkan penerbit.');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Penerbit</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        form {
            text-align: center;
            margin-top: 20px;
            width: 50%;
            margin: auto;
        }

        fieldset {
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        legend {
            font-size: 1.2em;
            margin-bottom: 10px;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="text"], input[type="number"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .navigation {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px;
        background-color: #4CAF50; 
        color: white; 
        border-radius: 8px;
        }

        .nav-link {
            text-decoration: none;
            color: white;
            padding: 8px 12px;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        .nav-link:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<div class="navigation">
    <a href="admin.php" class="nav-link">Kembali</a>
    <a href="tambahbuku.php" class="nav-link">Tambah Buku</a>
</div>

<form method="POST" action="">
    <fieldset>
        <legend>Tambah Penerbit</legend>

        <label for="id_penerbit">ID Penerbit:</label>
        <input type="text" name="id_penerbit" required>

        <label for="nama_penerbit">Nama Penerbit:</label>
        <input type="text" name="nama_penerbit" required>

        <label for="alamat">Alamat:</label>
        <input type="text" name="alamat" required>

        <label for="kota">Kota:</label>
        <input type="text" name="kota" required>

        <label for="telepon">Telepon:</label>
        <input type="text" name="telepon" required>

        <input type="submit" name="tambah_penerbit" value="Tambah Penerbit">
    </fieldset>
</form>

</body>
</html>
