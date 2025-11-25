<?php

class DB{
    // Menyimpan nama host database
    private $host = "localhost";
    // Nama database (kosong dulu, nanti diisi lewat constructor)
    private $db_name = "";
    // Username untuk login database
    private $username = "";
    // Password database
    private $password = "";
    
    // Properti untuk menyimpan koneksi PDO
    private $conn;
    // Menyimpan hasil query terakhir
    private $result;

    // Constructor untuk inisialisasi detail koneksi database
   function __construct($host, $db_name, $username, $password) {
        // Set host dari parameter
        $this->host = $host;
        // Set nama database dari parameter
        $this->db_name = $db_name;
        // Set username dari parameter
        $this->username = $username;
        // Set password dari parameter
        $this->password = $password;
        // Panggil fungsi connect() untuk langsung membuat koneksi
        $this->conn = $this->connect();
    }

    // Method untuk membuat koneksi database menggunakan PDO
    public function connect() {

        // Awalnya koneksi diset null
        $conn = null;

        // Coba lakukan koneksi ke database
        try {
            // DSN adalah format penulisan untuk koneksi PDO ke MySQL
            $dsn = "mysql:host={$this->host};dbname={$this->db_name};charset=utf8mb4"; // Charset UTF-8 biar aman buat karakter
            // Opsi tambahan untuk PDO
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,        // Error langsung lempar exception biar gampang debug
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,   // Hasil query otomatis berupa array asosiatif
                PDO::ATTR_EMULATE_PREPARES => false,               // Biar prepared statement beneran, bukan emulasi
            ];

            // Buat objek PDO baru sebagai koneksi database
            $conn = new PDO($dsn, $this->username, $this->password, $options);

        } catch (PDOException $exception) {
            // Kalau koneksi gagal, lempar error dengan pesan lebih jelas
            throw new RuntimeException("Koneksi gagal: " . $exception->getMessage(), 0, $exception);
        }

        // Kembalikan koneksi ke pemanggil
        return $conn;
    }

    // Method umum untuk menjalankan query SQL dengan prepared statement
    public function executeQuery($query, $params = []) {

        // Pastikan koneksi sudah ada
        if ($this->conn === null) {
            throw new RuntimeException('No database connection. Make sure connect() succeeded.');
        }

        // Coba eksekusi query
        try {
            // Siapkan querynya
            $stmt = $this->conn->prepare($query);
            // Jalankan query dengan parameter
            $stmt->execute($params);
            // Simpan hasilnya ke properti result
            $this->result = $stmt;
            return $stmt;

        } catch (PDOException $e) {
            // Kalau gagal, lempar error biar mudah dilacak
            throw new RuntimeException('Query gagal: ' . $e->getMessage(), 0, $e);
        }
    }

    // Mengambil semua hasil query dalam bentuk array
    public function getAllResult() {
        // Kalau belum ada hasil query, kembalikan array kosong
        if ($this->result === null) {
            return [];
        }
        // Ambil semua data sebagai array asosiatif
        return $this->result->fetchAll(PDO::FETCH_ASSOC);
    }

    // Menutup koneksi database
    public function close() {
        // Set koneksi ke null supaya benar-benar tertutup
        $this->conn = null;
    }

    // Method khusus untuk SELECT yang langsung mengembalikan array
    public function executeSelect(string $query, array $params = []): array {
        // Siapkan query
        $stmt = $this->conn->prepare($query);
        // Eksekusi query
        $stmt->execute($params);
        // Ambil semua hasilnya
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Method untuk query yang tidak butuh hasil (INSERT, UPDATE, DELETE)
    public function executeNonSelectQuery($query, $params = []) {
        // Siapkan querynya
        $stmt = $this->conn->prepare($query);
        // Jalankan query
        $stmt->execute($params);
    }
}

?>
