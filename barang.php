<?php
include_once 'koneksi.php';
$db = new Koneksi();
$conn = $db->conn;
$sql = "SELECT * FROM barang JOIN supplier ON barang.id_supplier = supplier.id_supplier";
$data = $conn->query($sql);
$result = $data->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<head>
    <title>Data Barang</title>
</head>
<body>
    <div style="text-align: center;">
        <h2>Daftar Barang</h2>
        
        <!-- Tombol tambah dan daftar supplier disamping -->
        <p>
            <a href="addbarang.php" style="margin-right: 20px;">+ Tambah Barang</a>
            <a href="supplier.php">Daftar Supplier</a>
        </p>

        <table border="1" cellpadding="10" cellspacing="0" style="margin-left: auto; margin-right: auto;">
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Stok</th>
                <th>Supplier</th>
                <th>Aksi</th>
            </tr>
            <?php $no = 1; ?>
            <?php foreach ($result as $row): ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= htmlspecialchars($row['nama_barang']); ?></td>
                <td><?= $row['stock']; ?></td>
                <td><?= htmlspecialchars($row['nama_supplier']); ?></td>
                <td>
                    <a href="editbarang.php?id_barang=<?= $row['id_barang'] ?>">Edit</a> |
                    <a href="barang_hapus.php?id_barang=<?= $row['id_barang'] ?>" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>
