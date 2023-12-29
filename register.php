<?php


// Fungsi untuk melakukan pendaftaran
function register($username, $password, $email, $name, $token) {
    $conn = connectToDatabase();

    // Hindari SQL injection dengan menggunakan prepared statement
    $stmt = $conn->prepare("INSERT INTO users (username, password, email, name, token) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $username, $password, $email, $name, $token);

    $result = $stmt->execute();

    $stmt->close();
    $conn->close();

    return $result;
}

// Mengambil data dari form pendaftaran
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["register"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    $name = $_POST["name"];
    $token = $_POST["token"];

    // Validasi sederhana
    if (empty($username) || empty($password) || empty($email) || empty($name) || empty($token)) {
        echo "Semua kolom harus diisi.";
    } else {
        // Memanggil fungsi register
        if (register($username, $password, $email, $name, $token)) {
            echo "Pendaftaran berhasil!";
        } else {
            echo "Pendaftaran gagal. Coba lagi.";
        }
    }
}
?>