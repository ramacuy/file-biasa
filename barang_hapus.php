<?php
include_once 'koneksi.php';

$db = new Koneksi();
$conn = $db->conn;

// Cek apakah ada ID yang dikirim
if (!isset($_GET['id_barang'])) {
    echo "ID barang tidak ditemukan.";
    exit;
}

$id_barang = $_GET['id_barang'];
// Proses hapus data
$query = "DELETE FROM barang WHERE id_barang = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id_barang);

if ($stmt->execute()) {
    header("location: barang.php");
} else {
    echo "Gagal menghapus barang: " . $conn->error;
}
?>
