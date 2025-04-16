<?php
class Koneksi {

    private $host = 'localhost';
    private $name = 'root';
    private $password = '';
    private $db = 'barang';
    public $conn;

    public function __construct() {
        // Membuat koneksi ke database
        $this->conn = new mysqli($this->host, $this->name, $this->password, $this->db);

        // Cek koneksi
        if ($this->conn->connect_error) {
            die("Koneksi gagal: " . $this->conn->connect_error);
        }
    }
}
?>
