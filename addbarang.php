<?php
include_once 'koneksi.php';

$db = new Koneksi();
$conn = $db->conn;
$supplier = $conn->query("SELECT * FROM supplier");

if (isset($_POST['simpan'])) {
    $nama = $_POST['nama_barang'];
    $stock = $_POST['stock'];
    $id_supplier = $_POST['id_supplier'];

    $query = "INSERT INTO barang (nama_barang, stock, id_supplier) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssi", $nama, $stock, $id_supplier);

    if ($stmt->execute()) {
        header("Location: barang.php");
        exit;
    } else {
        echo "Gagal menyimpan barang: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Barang</title>
</head>
<body>

    <div>
        <h3 style="text-align: center;">Tambah Barang</h3>
        <div style="width: 300px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; border-radius: 8px;">
            <form action="addbarang.php" method="POST">
                <div>
                    <label for="nama_barang">Nama Barang</label>
                    <input type="text" id="nama_barang" name="nama_barang" required style="width: 100%; padding: 8px; margin-bottom: 10px;">
                </div>
                <div>
                    <label for="stock">Stok</label>
                    <input type="number" id="stock" name="stock" required style="width: 100%; padding: 8px; margin-bottom: 10px;">
                </div>
                <div>
                    <label for="id_supplier">Supplier</label>
                    <select id="id_supplier" name="id_supplier" required style="width: 100%; padding: 8px; margin-bottom: 10px;">
                        <option value="">-- Pilih Supplier --</option>
                        <?php
                        // Menampilkan daftar supplier dari database
                        while ($s = $supplier->fetch_assoc()) {
                            echo "<option value='{$s['id_supplier']}'>{$s['nama_supplier']}</option>";
                        }
                        ?>
                    </select>
                </div>
                <button type="submit" name="simpan" style="width: 100%; padding: 10px; background-color: #007bff; color: white; border: none; border-radius: 5px;">Simpan</button>
            </form>
        </div>
    </div>

</body>
</html>

