<?php 
class Acara
{
    // property untuk nyimpen id acara
    public $id;

    // nama acara balapan
    public $nama_acara;

    // lokasi tempat acaranya berlangsung
    public $lokasi;

    // tanggal pelaksanaan acara
    public $tanggal;

    // jumlah lap yang dipakai dalam acara balapan
    public $jumlah_lap;

    // constructor dijalankan otomatis saat objek Acara dibuat
    public function __construct($row)
    {
        // ngambil nilai id dari data hasil query database
        $this->id          = $row['id'];

        // nama acara diisi dari database
        $this->nama_acara  = $row['nama_acara'];

        // lokasi acara juga diambil dari row database
        $this->lokasi      = $row['lokasi'];

        // tanggal pelaksanaan acara
        $this->tanggal     = $row['tanggal'];

        // jumlah lap acara balapan
        $this->jumlah_lap  = $row['jumlah_lap'];
    }
}
?>
