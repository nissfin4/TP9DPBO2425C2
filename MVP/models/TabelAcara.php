<?php
require_once __DIR__ . '/DB.php';              
require_once __DIR__ . '/Acara.php';           
require_once __DIR__ . '/KontrakModelAcara.php'; 

class TabelAcara implements KontrakModelAcara { // Deklarasi class TabelAcara yang mengikuti aturan dari interface KontrakModelAcara

    private $db;                               

    public function __construct() {            
        $this->db = new DB("localhost", "mvp_db", "root", ""); // Bikin koneksi database ke mvp_db
    }

    public function getAllAcara(): array {// Fungsi untuk ambil semua data acara
        $query = "SELECT * FROM acara"; // Query ambil semua baris dari tabel acara
        $rows = $this->db->executeSelect($query); // Jalankan query select dan ambil hasilnya dalam bentuk array

        $hasil = []; // Siapin array kosong buat menampung objek Acara

        foreach ($rows as $row) {// Loop tiap hasil baris dari database
            $hasil[] = new Acara($row); // Setiap baris dibungkus menjadi objek Acara lalu dimasukin ke array hasil
        }

        return $hasil; // Balikin array berisi list objek Acara
    }

    public function getAcaraById($id): ?array {// Fungsi untuk ambil satu acara berdasarkan ID
        $query = "SELECT * FROM acara WHERE id = ?"; // Query cari acara dengan ID tertentu
        $rows = $this->db->executeSelect($query, [$id]); // Eksekusi query dengan parameter ID

        return $rows ? $rows[0] : null;
    }

    public function addAcara($namaAcara, $lokasi, $tanggal, $jumlahLap): void { // Fungsi buat menambah acara baru
        $query = "INSERT INTO acara (nama_acara, lokasi, tanggal, jumlah_lap) VALUES (?, ?, ?, ?)"; // Query insert acara
        $this->db->executeNonSelectQuery($query, [$namaAcara, $lokasi, $tanggal, $jumlahLap]); // Eksekusi query insert
    }

    public function updateAcara($id, $namaAcara, $lokasi, $tanggal, $jumlahLap): void { // Fungsi update data acara
        $query = "UPDATE acara SET nama_acara=?, lokasi=?, tanggal=?, jumlah_lap=? WHERE id=?"; // Query update berdasarkan ID
        $this->db->executeNonSelectQuery($query, [$namaAcara, $lokasi, $tanggal, $jumlahLap, $id]); // Eksekusi query update
    }

    public function deleteAcara($id): void {// Fungsi hapus acara berdasarkan ID
        $query = "DELETE FROM acara WHERE id=?";  // Query delete baris berdasarkan ID
        $this->db->executeNonSelectQuery($query, [$id]); // Eksekusi query delete
    }
}
?>
