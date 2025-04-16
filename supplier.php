<?php
include_once 'koneksi.php';

$db = new Koneksi();
$conn = $db->conn;

$sql = "SELECT * FROM supplier";
$data = $conn->query($sql);
$result = $data->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Supplier</title>
</head>
<body>

    <div style="text-align: center;">
        <h2>Daftar Supplier</h2>

        <p>
            <a href="addsupplier.php" style="margin-right: 20px;">+ Tambah Supplier</a>
            <a href="barang.php">Daftar Barang</a>
        </p>


        <table border="1" cellpadding="10" cellspacing="0" style="margin-left: auto; margin-right: auto;">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Supplier</th>
                    <th>Alamat</th>
                    <th>Telepon</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                <?php foreach ($result as $row): ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= htmlspecialchars($row['nama_supplier']) ?></td>
                        <td><?= htmlspecialchars($row['alamat']) ?></td>
                        <td><?= htmlspecialchars($row['kontak']) ?></td>
                        <td>
                            <!-- Edit Button -->
                            <a href="editsupplier.php?id_supplier=<?= $row['id_supplier'] ?>">Edit</a> |
                            <!-- Delete Button -->
                            <a href="supplier_hapus.php?id_supplier=<?= $row['id_supplier'] ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus supplier ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</body>
</html>
