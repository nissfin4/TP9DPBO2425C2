<?php
// Interface untuk Model Acara isinya aturan/fungsi apa saja yang wajib dimiliki Model Acara
interface KontrakModelAcara
{
    // Method untuk mengambil semua data acara, hasilnya dalam bentuk array
    public function getAllAcara(): array;

    // Method untuk mengambil satu acara berdasarkan id, kalau tidak ada hasilnya null
    public function getAcaraById($id): ?array;

    // Method untuk menambahkan acara baru ke database
    public function addAcara($namaAcara, $lokasi, $tanggal, $jumlahLap): void;

    // Method untuk memperbarui data acara berdasarkan id
    public function updateAcara($id, $namaAcara, $lokasi, $tanggal, $jumlahLap): void;

    // Method untuk menghapus acara dari database berdasarkan id
    public function deleteAcara($id): void;
}
?>
