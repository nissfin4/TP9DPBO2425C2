<?php
interface KontrakPresenterAcara // Mendefinisikan interface bernama KontrakPresenterAcara
{
    public function tampilkanAcara(): string;  
    // Method yang wajib ada di presenter: untuk menampilkan semua daftar acara
    // Return-nya string karena biasanya presenter bikin output HTML

    public function tampilkanFormAcara($id = null): string;
    // Method untuk menampilkan form tambah/ubah acara
 

    public function tambahAcara($namaAcara, $lokasi, $tanggal, $jumlahLap): void;
    // Method wajib untuk proses penambahan acara baru
    // Tidak mengembalikan nilai (void)

    public function ubahAcara($id, $namaAcara, $lokasi, $tanggal, $jumlahLap): void;
    // Method wajib untuk meng-update acara berdasarkan ID

    public function hapusAcara($id): void;
    // Method wajib untuk menghapus acara berdasarkan ID
}
?>
