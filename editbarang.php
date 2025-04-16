<?php
include_once 'koneksi.php';
$db = new Koneksi();
$conn = $db->conn;
$supplier = $conn->query('SELECT * FROM supplier')->fetch_all(MYSQLI_ASSOC);

if (!isset($_GET['id_barang'])) {
    echo "ID barang tidak ditemukan.";
    exit;
}

$id_barang = $_GET['id_barang'];

// Ambil data barang berdasarkan ID
$query = "SELECT * FROM barang WHERE id_barang = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id_barang);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

// Proses update saat form disubmit
if (isset($_POST['update'])) {
    $nama = $_POST['nama'];
    $stock = $_POST['stock'];
    $id_supplier = $_POST['id_supplier'];

    $update = "UPDATE barang SET nama_barang = ?, stock = ?, id_supplier = ? WHERE id_barang = ?";
    $stmt_update = $conn->prepare($update);
    $stmt_update->bind_param("siii", $nama, $stock, $id_supplier, $id_barang);

    if ($stmt_update->execute()) {
        header("location: barang.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Barang</title>
</head>
<body>

    <div style="width: 100%; display: flex; justify-content: center; align-items: center; height: 100vh;">
        <div style="width: 400px; padding: 20px; border: 1px solid #ddd; border-radius: 8px; background-color: #f9f9f9;">
            <h2 style="text-align: center; margin-bottom: 20px;">Edit Barang</h2>

            <!-- Form Edit Barang -->
            <form action="editbarang.php?id_barang=<?= $id_barang ?>" method="POST">
                <div style="margin-bottom: 15px;">
                    <label for="nama_barang" style="display: block; margin-bottom: 5px;">Nama Barang</label>
                    <input type="text" id="nama_barang" name="nama" value="<?= htmlspecialchars($data['nama_barang']) ?>" required style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ccc;">
                </div>

                <div style="margin-bottom: 15px;">
                    <label for="stock" style="display: block; margin-bottom: 5px;">Stok</label>
                    <input type="number" id="stock" name="stock" value="<?= $data['stock'] ?>" required style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ccc;">
                </div>

                <div style="margin-bottom: 15px;">
                    <label for="id_supplier" style="display: block; margin-bottom: 5px;">Supplier</label>
                    <select id="id_supplier" name="id_supplier" required style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ccc;">
                <option value="">-- Pilih Supplier --</option>
                <?php foreach ($supplier as $s) : ?>
                <option value="<?= $s['id_supplier']; ?>" <?= ($s['id_supplier'] == $data['id_supplier']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($s['nama_supplier']); ?>
                </option>
                <?php endforeach; ?>
                </select>
                </div>

                <button type="submit" name="update" style="width: 100%; padding: 10px; background-color: #007bff; color: white; border: none; border-radius: 5px;">Update</button>
            </form>
        </div>
    </div>

</body>
</html>
