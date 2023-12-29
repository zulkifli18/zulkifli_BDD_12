<?php
// File: login.php

// Fungsi untuk melakukan koneksi ke database
function connectToDatabase() {
    $host = "localhost"; // Ganti dengan host database Anda
    $username = "username"; // Ganti dengan username database Anda
    $password = "password"; // Ganti dengan password database Anda
    $database = "nama_database"; // Ganti dengan nama database Anda

    $conn = new mysqli($host, $username, $password, $database);

    if ($conn->connect_error) {
        die("Koneksi ke database gagal: " . $conn->connect_error);
    }

    return $conn;
}

// Fungsi untuk melakukan login
function login($username, $password) {
    $conn = connectToDatabase();

    // Hindari SQL injection dengan menggunakan prepared statement
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);

    $stmt->execute();

    // Ambil hasil query
    $result = $stmt->get_result();

    // Cek apakah ada baris hasil yang sesuai
    if ($result->num_rows > 0) {
        return true; // Login berhasil
    } else {
        return false; // Login gagal
    }

    $stmt->close();
    $conn->close();
}

// Mengambil data dari form login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Memanggil fungsi login
    if (login($username, $password)) {
        echo "Login berhasil!";
    } else {
        echo "Login gagal. Periksa kembali username dan password Anda.";
    }
}
?>

