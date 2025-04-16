<?php
include_once "koneksi.php";
$db = new Koneksi();
$conn = $db->conn;


if(!isset($_GET['id_supplier'])){
    echo "berhasil dihapus";
}

$id_supplier = $_GET['id_supplier'];
$query = "DELETE FROM supplier WHERE id_supplier = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id_supplier);

if ($stmt->execute()){
    header('location: supplier.php');
}
?>