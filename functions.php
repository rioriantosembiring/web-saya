<?php 
// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "phppemula");

function query($query) {
    global $conn;
    $result =mysqli_query($conn, $query);
    $rows = [];

    while($row = mysqli_fetch_assoc($result) ){
        $rows[] = $row;
    }

    return $rows;
}

function tambah($data) {
global $conn;
$nama = htmlspecialchars($data["nama"]);
$nim = htmlspecialchars($data["nim"]);
$email = htmlspecialchars($data["email"]);
$jurusan = htmlspecialchars($data["jurusan"]);
$gambar = htmlspecialchars($data["gambar"]);


$query = "INSERT INTO mahasiswa VALUES
        ('', '$nama', '$nim', '$email', '$jurusan', '$gambar')
";

mysqli_query($conn, $query);

return mysqli_affected_rows($conn);
}


function hapus($id) {
    global $conn;
    mysqli_query($conn, "DELETE FROM mahasiswa WHERE id = $id " );
    return mysqli_affected_rows($conn);
}


function ubah($data) {

global $conn;
$id = $data["id"];
$nama = htmlspecialchars($data["nama"]);
$nim = htmlspecialchars($data["nim"]);
$email = htmlspecialchars($data["email"]);
$jurusan = htmlspecialchars($data["jurusan"]);
$gambar = htmlspecialchars($data["gambar"]);


$query = "UPDATE mahasiswa SET
            nama = '$nama',
            nim = '$nim',
            email = '$email',
            jurusan = '$jurusan',
            gambar = '$gambar'

            WHERE id = $id
             ";

mysqli_query($conn, $query);

return mysqli_affected_rows($conn);



}

function cari($key) {
    $query = "SELECT * FROM mahasiswa
                WHERE

                nama LIKE '%$key%' OR
                nim LIKE '%$key%'
            ";
    return query($query);
}


function registrasi($data) {
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

    // cek username sudah ada atau belum
    $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username' ");

    if( mysqli_fetch_assoc($result) ) {
        echo "<script> alert('username sudah terdaftar!!') </script>";

        return false;
    }

    // cek konfirmasi password
    if ( $password !== $password2) {
        echo "<script>
            alert('Password tidak sesuai!!');
        </script>";

        return false;
    }


    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);
    

    // tambahkan user baru ke database
    mysqli_query($conn, "INSERT INTO user VALUES ('', '$username', '$password')");

    return mysqli_affected_rows($conn);
}



?>