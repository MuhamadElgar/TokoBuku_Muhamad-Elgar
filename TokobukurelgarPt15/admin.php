<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Toko Buku - Halaman Admin</title>
    <link rel="stylesheet" type="text/css" href="index.css">
    <style>
       
        form {
        text-align: center;
        margin-bottom: 20px;
        }

        fieldset {
            text-align: center;
        }

        legend {
            background-color: #f2f2f2;
            padding: 5px 10px;
            border: 1px solid black;
            border-radius: 4px;
        }

        table {
            margin: 20px auto;
            border-collapse: collapse;
            width: 100%;
        }

        h2 {
            margin-left: 10px;
            float: left;
        }

        .add-btn {
            float: right; 
            margin-right: 10px;
        }

        th, td {
            border: 1px solid black;
            padding: 10px;
        }

        th {
            background-color: #f2f2f2;
        }

        /* Gaya tombol */
        input[type="submit"], .edit-btn, .delete-btn, .add-btn {
            background-color: #4CAF50;
            color: white;
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-decoration: none; /* Added for link styling */
            display: inline-block; /* Added for link styling */
            margin-right: 10px; /* Added for spacing */
        }

        input[type="submit"]:hover, .edit-btn:hover, .delete-btn:hover, .add-btn:hover {
            background-color: #45a049;
        }

        /* Gaya input untuk pengeditan kolom */
        input.edit-field {
            width: 80%; /* Adjust width as needed */
            padding: 5px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Halaman Admin Toko Buku Muhamad Elgar</h1>
    </header>
<nav>
    <ul>
        <li><img src="image/Home.png" height="20" width=" " class="active"> <a href="index.php" class="active">HOME</a></li>
        <li><a href="admin.php" class="active">ADMIN</a></li>
        <li><a href="#" class="active">PENGADAAN</a></li>
        <li><a href="#" class="active">ABOUT US</a></li>
    </ul>
</nav>

<fieldset>
    <legend>Tabel Buku</legend>

    <h2>Tabel Buku</h2>
    <a href="tambahbuku.php" class="add-btn">Tambah Buku</a>
    <table>
        <tr>
            <th>IDBuku</th>
            <th>Kategori</th>
            <th>Nama Buku</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Penerbit</th>
            <th>EDIT</th>
            <th>HAPUS</th>
        </tr>
        <!-- Tampilkan data buku dari database -->
        <?php
        include 'koneksi.php';

        $query_show_buku = "SELECT * FROM tabel_buku";
        $result_show_buku = mysqli_query($koneksi, $query_show_buku);

        if ($result_show_buku && mysqli_num_rows($result_show_buku) > 0) {
            while ($row_buku = mysqli_fetch_assoc($result_show_buku)) {
                echo "<tr>";
                echo "<form method='POST' action='edit.php'>"; // Mengarahkan form ke edit.php
                echo "<td><input type='text' class='edit-field' name='id_buku' value='" . $row_buku['ID_Buku'] . "'></td>";
                echo "<td><input type='text' class='edit-field' name='kategori' value='" . $row_buku['Kategori'] . "'></td>";
                echo "<td><input type='text' class='edit-field' name='nama_buku' value='" . $row_buku['Nama_Buku'] . "'></td>";
                echo "<td><input type='text' class='edit-field' name='harga' value='" . $row_buku['Harga'] . "'></td>";
                echo "<td><input type='text' class='edit-field' name='stok' value='" . $row_buku['Stok'] . "'></td>";
                echo "<td><input type='text' class='edit-field' name='penerbit' value='" . $row_buku['Penerbit'] . "'></td>";
                echo "<td><input type='submit' name='edit_buku' value='Edit' class='edit-btn'></td>"; // Tombol Edit
                echo "</form>";
                echo "<td><form method='POST' action='hapus.php'>"; // Mengarahkan form ke hapus.php
                echo "<input type='hidden' name='id_buku' value='" . $row_buku['ID_Buku'] . "'>";
                echo "<input type='submit' name='hapus_buku' value='Hapus' class='delete-btn'>";
                echo "</form></td>";
                echo "</tr>";
            }
        }
        ?>
    </table>
</fieldset>

<fieldset>
    <legend>Tabel Penerbit</legend>

    <h2>Tabel Penerbit</h2>
    <a href="tambahpenerbit.php" class="add-btn">Tambah Penerbit</a>
    <table>
        <tr>
            <th>IDPenerbit</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Kota</th>
            <th>Telepon</th>
            <th>EDIT</th>
            <th>HAPUS</th>
        </tr>
        <!-- Tampilkan data penerbit dari database -->
        <?php
        $query_show_penerbit = "SELECT * FROM tabel_penerbit";
        $result_show_penerbit = mysqli_query($koneksi, $query_show_penerbit);

        if ($result_show_penerbit && mysqli_num_rows($result_show_penerbit) > 0) {
            while ($row_penerbit = mysqli_fetch_assoc($result_show_penerbit)) {
                echo "<tr>";
                echo "<form method='POST' action='edit.php'>"; // Mengarahkan form ke edit.php
                echo "<td><input type='text' class='edit-field' name='id_penerbit' value='" . $row_penerbit['ID_Penerbit'] . "'></td>";
                echo "<td><input type='text' class='edit-field' name='nama_penerbit' value='" . $row_penerbit['Nama'] . "'></td>";
                echo "<td><input type='text' class='edit-field' name='alamat' value='" . $row_penerbit['Alamat'] . "'></td>";
                echo "<td><input type='text' class='edit-field' name='kota' value='" . $row_penerbit['Kota'] . "'></td>";
                echo "<td><input type='text' class='edit-field' name='telepon' value='" . $row_penerbit['Telepon'] . "'></td>";
                echo "<td><input type='submit' name='edit_penerbit' value='Edit' class='edit-btn'></td>"; // Tombol Edit
                echo "</form>";
                echo "<td><form method='POST' action='hapus.php'>"; // Mengarahkan form ke hapus.php
                echo "<input type='hidden' name='id_penerbit' value='" . $row_penerbit['ID_Penerbit'] . "'>";
                echo "<input type='submit' name='hapus_penerbit' value='Hapus' class='delete-btn'>";
                echo "</form></td>";
                echo "</tr>";
            }
        }
        ?>
    </table>
</fieldset>

<!-- PHP code for handling deletions of Penerbit -->
<?php
if (isset($_POST['hapus_penerbit'])) {
    $id_penerbit = $_POST['id_penerbit'];
    $query_delete_penerbit = "DELETE FROM tabel_penerbit WHERE ID_Penerbit = '$id_penerbit'";
    mysqli_query($koneksi, $query_delete_penerbit);
    header("Location: admin.php"); // Redirect back to the admin.php page after deletion
    exit();
}
?>
</body>
</html>
