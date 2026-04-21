<!-- web hosting : 000webhost.com, infinityfree.net
    nama domain : freenom.com, dot.tk, name.com
-->

<?php 
// session
session_start();

if( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
}

// memanggil file function
require 'functions.php'; 

$mahasiswa = query("SELECT * FROM mahasiswa");

// ketika tombol cari diklik
if( isset($_POST["cari"])) {
    $mahasiswa = cari($_POST["key"]);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Admin</title>
    <style>
        @media print {
            .logout {
                display: none;
            }
        }
    </style>
</head>
<body>

    <a href="logout.php" class="logout">Logout!</a>

    <h1>Daftar Mahasiswa</h1>

    <a href="tambah.php">Tambah data mahasiswa</a>
    <br><br>

    <form action="" method="post">
        <input type="text" name="key" size="50" autofocus placeholder="masukkan keyword pencarian..." autocomplete="off" id="key">
        <button type="submit" name="cari" id="tombol-cari">Cari!!</button>
    
    </form>
    <br>

    <div id="container">
    <table border="1" cellpadding="9" cellspacing="0">

        <tr>
            <th>No.</th>
            <th>Aksi</th>
            <th>Gambar</th>
            <th>Nim</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Jurusan</th>
        </tr>

        <?php $i = 1; ?>
        <?php foreach($mahasiswa as $row) : ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td>
                <a href="ubah.php?id=<?php echo $row["id"]; ?>" onclick="return confirm('Yakin Ingin dibuah ?');">Ubah</a> | <a href="hapus.php?id=<?php echo $row["id"]; ?>" onclick="return confirm
                ('Yakin ingin menghapus ?');">Hapus</a>
            </td>

            <td><img src="img/<?php echo $row["gambar"]; ?>" alt="" height="90" width="90"></td>
            <td><?php echo $row["nim"]; ?></td>
            <td><?php echo $row["nama"]; ?></td>
            <td><?php echo $row["email"]; ?></td>
            <td><?php echo $row["jurusan"]; ?></td>
        </tr>
        <?php $i++; ?>
        <?php endforeach; ?>

    </table>
    </div>
    
    <script src="js/jquery-4.0.0.min.js"></script>
    <script src="js/script.js"></script>
</body>
</html>