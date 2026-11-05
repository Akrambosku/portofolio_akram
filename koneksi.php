<?php
/**
 * =========================================================================
 * KONEKSI DATABASE (koneksi.php)
 * Portfolio & Personal Information System
 * =========================================================================
 * File ini bertugas untuk menghubungkan script PHP ke basis data MySQL / MariaDB
 * menggunakan ekstensi MySQLi (MySQL Improved).
 */

// Konfigurasi Parameter Database XAMPP
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "db_portofolio";

// Matikan exception throwing bawaan PHP 8.1+ agar dapat ditangani secara aman
mysqli_report(MYSQLI_REPORT_OFF);

// Inisialisasi koneksi MySQLi
$koneksi = @mysqli_connect($db_host, $db_user, $db_pass, $db_name);

// Verifikasi status koneksi
if (!$koneksi) {
    // Simpan pesan error untuk ditampilkan secara informatif di antarmuka web
    $db_connection_error = mysqli_connect_error();
} else {
    $db_connection_error = null;
    // Set charset UTF-8 untuk memastikan karakter khusus tersimpan dan ditampilkan dengan benar
    mysqli_set_charset($koneksi, "utf8mb4");
}
?>
