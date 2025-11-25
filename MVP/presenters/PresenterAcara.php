<?php

require_once __DIR__ . '/../models/TabelAcara.php';
require_once __DIR__ . '/../views/ViewAcara.php';
require_once __DIR__ . '/KontrakPresenterAcara.php';

class PresenterAcara implements KontrakPresenterAcara   // Kelas presenter yang mengikuti aturan interface
{
    private $model; // Untuk menyimpan objek model (TabelAcara)
    private $view;  // Untuk menyimpan objek view (ViewAcara)

    public function __construct()
    {
        // Ketika presenter dibuat, otomatis membuat model dan view
        $this->model = new TabelAcara();
        $this->view = new ViewAcara();
    }

    public function tampilkanAcara(): string
    {
        // Ambil semua data acara dari model
        $data = $this->model->getAllAcara();

        // Kirim data itu ke view untuk dibuat HTML
        return $this->view->tampilAcara($data);
    }

    public function tampilkanFormAcara($id = null): string
    {
        $data = null; // Defaultnya null, artinya form tambah

        // Kalau ada ID, berarti user sedang edit  ambil data acara berdasarkan ID
        if ($id) {
            $data = $this->model->getAcaraById($id);
        }

       
        return $this->view->tampilFormAcara($data);
    }

    public function tambahAcara($namaAcara, $lokasi, $tanggal, $jumlahLap): void
    {
        // Minta model untuk menambah data acara ke database
        $this->model->addAcara($namaAcara, $lokasi, $tanggal, $jumlahLap);
    }

    public function ubahAcara($id, $namaAcara, $lokasi, $tanggal, $jumlahLap): void
    {
        // Minta model untuk update data acara sesuai ID
        $this->model->updateAcara($id, $namaAcara, $lokasi, $tanggal, $jumlahLap);
    }

    public function hapusAcara($id): void
    {
        // Minta model untuk menghapus data acara berdasarkan ID
        $this->model->deleteAcara($id);
    }
}
?>
