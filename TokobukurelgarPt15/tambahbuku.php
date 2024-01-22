<?php
include 'koneksi.php'; // Include the database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['tambah_buku'])) {
        // Proses penambahan buku ke database
        $id_buku = $_POST['id_buku'];
        $kategori = $_POST['kategori'];
        $nama_buku = $_POST['nama_buku'];
        $harga = $_POST['harga'];
        $stok = $_POST['stok'];
        $penerbit = $_POST['penerbit'];

        $query_tambah_buku = "INSERT INTO tabel_buku (ID_Buku, Kategori, Nama_Buku, Harga, Stok, Penerbit) 
                              VALUES ('$id_buku', '$kategori', '$nama_buku', '$harga', '$stok', '$penerbit')";
        
        if (mysqli_query($koneksi, $query_tambah_buku)) {
            echo "<script>alert('Buku berhasil ditambahkan.'); window.location.href = 'admin.php';</script>";
        } else {
            // Tambahkan ini untuk menampilkan pesan kesalahan pada query
            echo "Error: " . $query_tambah_buku . "<br>" . mysqli_error($koneksi);
            echo "<script>alert('Gagal menambahkan buku.');</script>";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Buku</title>
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

        /* Style for the popup */
        .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            z-index: 1000;
        }

        .popup.success {
            border-color: #4CAF50;
        }

        .popup.error {
            border-color: #FF5733;
        }

        .popup h3 {
            margin-top: 0;
        }

        .close-btn {
            cursor: pointer;
            color: #333;
            float: right;
            font-weight: bold;
        }
    </style>
</head>
<body>

<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['tambah_buku'])) {
        $id_buku = $_POST['id_buku'];
        $kategori = $_POST['kategori'];
        $nama_buku = $_POST['nama_buku'];
        $harga = $_POST['harga'];
        $stok = $_POST['stok'];
        $penerbit = $_POST['penerbit'];

        $query_tambah_buku = "INSERT INTO tabel_buku (ID_Buku, Kategori, Nama_Buku, Harga, Stok, Penerbit) 
                              VALUES ('$id_buku', '$kategori', '$nama_buku', '$harga', '$stok', '$penerbit')";

        if (mysqli_query($koneksi, $query_tambah_buku)) {
            echo '<div class="popup success">';
            echo '<span class="close-btn" onclick="closePopup()">X</span>';
            echo '<h3>Buku berhasil ditambahkan.</h3>';
            echo '<button onclick="window.location.href=\'admin.php\'">Kembali</button>';
            echo '</div>';
        } else {
            echo '<div class="popup error">';
            echo '<span class="close-btn" onclick="closePopup()">X</span>';
            echo '<h3>Gagal menambahkan buku.</h3>';
            echo '<button onclick="window.location.href=\'tambahbuku.php\'">Kembali</button>';
            echo '</div>';
        }
    }
}
?>

<div class="navigation">
    <a href="admin.php" class="nav-link">Kembali</a>
    <a href="tambahbuku.php" class="nav-link">Tambah Buku</a>
</div>

<form method="POST" action="">
    <fieldset>
        <legend>Tambah Buku</legend>

        <label for="id_buku">ID Buku:</label>
        <input type="text" name="id_buku" required>

        <label for="kategori">Kategori:</label>
        <input type="text" name="kategori" required>

        <label for="nama_buku">Nama Buku:</label>
        <input type="text" name="nama_buku" required>

        <label for="harga">Harga:</label>
        <input type="number" name="harga" required>

        <label for="stok">Stok:</label>
        <input type="number" name="stok" required>

        <label for="penerbit">Penerbit:</label>
        <input type="text" name="penerbit" required>

        <input type="submit" name="tambah_buku" value="Tambah Buku">
    </fieldset>
</form>

<script>
    function closePopup() {
        const popup = document.querySelector('.popup');
        if (popup) {
            popup.style.display = 'none';
        }
    }
</script>

</body>
</html>
