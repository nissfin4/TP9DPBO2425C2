<?php
interface KontrakViewAcara
{
    public function tampilAcara($listAcara): string;
    // Method untuk menampilkan daftar acara dalam bentuk HTML
    // listAcara berisi array data dari model, hasilnya harus berupa string HTML

    public function tampilFormAcara($data = null): string;
    // Method untuk menampilkan form acara
}
?>
