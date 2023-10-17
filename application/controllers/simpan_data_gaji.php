<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $totalGaji = $_POST["total_gaji"];
    // Lakukan koneksi ke database dan simpan $totalGaji ke dalam tabel yang sesuai
    $servername = "nama_server";
    $username = "username";
    $password = "password";
    $dbname = "nama_database";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    $sql = "INSERT INTO tabel_gaji (total_gaji) VALUES ('$totalGaji')";

    if ($conn->query($sql) === TRUE) {
        echo "Data total gaji berhasil disimpan ke database.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
