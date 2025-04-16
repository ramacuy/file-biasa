<?php
include_once 'koneksi.php';
$db = new Koneksi();
$conn = $db->conn;


if(!isset($_GET['id_supplier'])){
    echo "supplier id tidak ditemukan";
    exit;
}

$id_supplier = $_GET['id_supplier'];

// Ambil data barang berdasarkan ID
$query = "SELECT * FROM supplier WHERE id_supplier = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id_supplier);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

if(isset($_POST['update'])){
    $nama =  $_POST['nama_supplier'];
    $alamat = $_POST['alamat'];
    $kontak = $_POST['kontak'];

    $query = "UPDATE supplier SET nama_supplier = ?, alamat = ?, kontak = ? WHERE id_supplier = ?";
    $stmt_update = $conn->prepare($query);
    $stmt_update->bind_param("sssi", $nama, $alamat, $kontak, $id_supplier);

    if($stmt_update->execute()){
        header('location: supplier.php');
    }
}

?>
<html>
    <head></head>
    <body>   
    <div>
        <h3 style="text-align: center;">Edit Supplier</h3>
        <div style="width: 300px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; border-radius: 8px;">
            <form action="editsupplier.php?id_supplier=<?=$id_supplier?>" method="POST">
                <div>
                    <label for="nama_supplier">Nama Supplier</label>
                    <input type="text" id="nama" name="nama_supplier" value="<?= htmlspecialchars($data ['nama_supplier']) ?>" required style="width: 100%; padding: 8px; margin-bottom: 10px;">
                </div>
                <div>
                    <label for="alamat">Alamat</label>
                    <input type="text" id="alamat" name="alamat" value="<?= $data ['alamat'] ?>" required style="width: 100%; padding: 8px; margin-bottom: 10px;">
                </div>
                <div>
                    <label for="kontak">Kontak</label>
                    <input type="number" id="kontak" name="kontak" value="<?= $data ['kontak'] ?>" required style="width: 100%; padding: 8px; margin-bottom: 10px;">
                </div>
                <button type="submit" name="update" style="width: 100%; padding: 10px; background-color: #007bff; color: white; border: none; border-radius: 5px;">Simpan</button>
            </form>
        </div>
    </div>
    </body>
</html>