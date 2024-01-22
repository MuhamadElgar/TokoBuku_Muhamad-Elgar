<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Toko Buku Muhamad Elgar</title>
    <link rel="stylesheet" type="text/css" href="index.css">
    <style>
        header {
            background-image: url('image/Header.jpg');
            background-size: cover;
            background-position: center;
            height: 200px;
            text-align: center;
            color: whitesmoke;
            padding-top: 20px;
        }

        table {
            margin: 0 auto;
            border-collapse: collapse;
            width: 80%;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        /* Style untuk tombol cari */
        form {
            margin-top: 10px;
            text-align: center;
        }

        input[type="text"] {
            padding: 8px;
            font-size: 16px;
        }

        button[type="submit"] {
            padding: 8px 16px;
            font-size: 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button[type="submit"]:hover {
            background-color: #45a049;
        }

        /* Style untuk h2 di tengah-tengah */
        .tabel-container {
            text-align: center;
        }

        .tabel-container h2 {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <header>
        <h1 style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);">Toko Buku Muhamad Elgar</h1>
        <h1 style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);">Mari Memulai Petualangan Literasi Membaca Buku
            Bersama!</h1>
    </header>
    <nav>
        <ul>
            <li><img src="image/Home.png" height="20" width=" " class="active"> <a href="index.php" class="active">HOME</a>
            </li>
            <li><a href="admin.php" class="active">ADMIN</a></li>
            <li><a href="#" class="active">PENGADAAN</a></li>
            <li><a href="#" class="active">ABOUT US</a></li>
        </ul>
    </nav>

    <fieldset>
        <legend align="center">Data Buku dan Penerbit</legend>

        <br>
        <form method="GET" action="index.php">
            <label>Cari Buku : </label>
            <input type="text" name="Cari_Buku" value="<?php echo isset($_GET['Cari_Buku']) ? htmlspecialchars($_GET['Cari_Buku']) : ''; ?>" />
            <button type="submit">Cari</button>
        </form>

        <?php
        include 'koneksi.php';

        if (isset($_GET['Cari_Buku'])) {
            $kata_cari = "%" . $_GET['Cari_Buku'] . "%";
            $query_buku = "SELECT tabel_buku.*, tabel_penerbit.*
                            FROM tabel_buku
                            LEFT JOIN tabel_penerbit ON tabel_buku.Penerbit = tabel_penerbit.Nama
                            WHERE 
                            ID_Buku LIKE ? OR
                            Kategori LIKE ? OR
                            Nama_Buku LIKE ? OR
                            Penerbit LIKE ?";
            $stmt_buku = mysqli_prepare($koneksi, $query_buku);
            mysqli_stmt_bind_param($stmt_buku, 'ssss', $kata_cari, $kata_cari, $kata_cari, $kata_cari);
            mysqli_stmt_execute($stmt_buku);
            $result_buku = mysqli_stmt_get_result($stmt_buku);

            if (!$result_buku) {
                die("Query Error: " . mysqli_error($koneksi));
            }

            $found_buku = mysqli_num_rows($result_buku);
            ?>

            <div class="tabel-container">
                <h2>Buku yang dicari :</h2>
                <?php if ($found_buku > 0) { ?>
                    <table border="1">
                        <thead>
                            <tr>
                                <th>ID Buku</th>
                                <th>Kategori</th>
                                <th>Nama Buku</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Penerbit</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row_buku = mysqli_fetch_assoc($result_buku)) { ?>
                                <tr>
                                    <td><?php echo $row_buku['ID_Buku']; ?></td>
                                    <td><?php echo $row_buku['Kategori']; ?></td>
                                    <td><?php echo $row_buku['Nama_Buku']; ?></td>
                                    <td><?php echo $row_buku['Harga']; ?></td>
                                    <td><?php echo $row_buku['Stok']; ?></td>
                                    <td><?php echo $row_buku['Penerbit']; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                <?php } else { ?>
                    <p>Tidak ada hasil yang ditemukan di kategori buku.</p>
                <?php } ?>

                <h2>Tentang Penerbit:</h2>
                <?php if ($found_buku > 0) { ?>
                    <table border="1">
                        <thead>
                            <tr>
                                <th>ID Penerbit</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Kota</th>
                                <th>Telepon</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php mysqli_data_seek($result_buku, 0); // Reset result set pointer to the beginning
                            while ($row_buku = mysqli_fetch_assoc($result_buku)) { ?>
                                <tr>
                                    <!-- Tampilkan data dari tabel_penerbit -->
                                    <td><?php echo $row_buku['ID_Penerbit']; ?></td>
                                    <td><?php echo $row_buku['Nama']; ?></td>
                                    <td><?php echo $row_buku['Alamat']; ?></td>
                                    <td><?php echo $row_buku['Kota']; ?></td>
                                    <td><?php echo $row_buku['Telepon']; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                <?php } else { ?>
                    <p>Tidak ada hasil yang ditemukan di kategori penerbit.</p>
                <?php } ?>
            </div>
        <?php } ?>
    </fieldset>
</body>
</html>
