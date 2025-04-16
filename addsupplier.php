<?php
include_once 'koneksi.php';
$db = new Koneksi();
$conn = $db->conn;

if(isset($_POST['simpan'])){
    $nama = $_POST['nama_supplier'];
    $alamat = $_POST['alamat'];
    $kontak = $_POST['kontak'];

    $query = "INSERT INTO supplier (nama_supplier, alamat, kontak) VALUES ( ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sss", $nama, $alamat, $kontak);

    if($stmt->execute()){
        header('location: supplier.php');
    } else {
        echo "gagal ditambah";
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
        <h3 style="text-align: center;">Tambah Supplier</h3>
        <div style="width: 300px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; border-radius: 8px;">
            <form action="addsupplier.php" method="POST">
                <div>
                    <label for="nama_supplier">Nama Supplier</label>
                    <input type="text" id="nama_supplier" name="nama_supplier" required style="width: 100%; padding: 8px; margin-bottom: 10px;">
                </div>
                <div>
                    <label for="alamat">Alamat</label>
                    <input type="text" id="alamat" name="alamat" required style="width: 100%; padding: 8px; margin-bottom: 10px;">
                </div>
                <div>
                    <label for="kontak">Kontak</label>
                    <input type="number" id="kontak" name="kontak" required style="width: 100%; padding: 8px; margin-bottom: 10px;">
                </div>
                <button type="submit" name="simpan" style="width: 100%; padding: 10px; background-color: #007bff; color: white; border: none; border-radius: 5px;">Simpan</button>
            </form>
        </div>
    </div>

</body>
</html>

