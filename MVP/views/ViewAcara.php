<?php
include_once __DIR__ . "/KontrakViewAcara.php";
include_once __DIR__ . "/../models/Acara.php";

class ViewAcara implements KontrakViewAcara // Kelas yang bertugas menampilkan HTML
{
    public function tampilAcara($listAcara): string
    {
        $tbody = ""; // Variabel untuk menampung baris-baris tabel
        $no = 1; // Nomor urut tabel

        // Loop setiap objek Acara di dalam listAcara
        foreach ($listAcara as $acara) {
            $tbody .= "<tr>";                              
            $tbody .= "<td class='col-id'>" . $no . "</td>"; // Kolom nomor urut
            $tbody .= "<td>" . htmlspecialchars($acara->nama_acara) . "</td>";  // Nama acara
            $tbody .= "<td>" . htmlspecialchars($acara->lokasi) . "</td>";// Lokasi acara
            $tbody .= "<td>" . htmlspecialchars($acara->tanggal) . "</td>";// Tanggal acara
            $tbody .= "<td>" . htmlspecialchars($acara->jumlah_lap) . "</td>";  // Jumlah lap

            // Kolom aksi: tombol edit + hapus
            $tbody .= "<td class='col-actions'>
                    <a href='acara.php?edit=" . $acara->id . "' class='btn btn-edit'>Edit</a>
                    <a href='acara.php?hapus=" . $acara->id . "' class='btn btn-delete'>Hapus</a>
                </td>";

            $tbody .= "</tr>"; // Tutup baris
            $no++; // Tambah nomor
        }

        // Bagian kepala tabel, isinya statis seperti pembalap
        $thead = '
        <tr>
            <th>No</th>
            <th>Nama Acara</th>
            <th>Lokasi</th>
            <th>Tanggal</th>
            <th>Jumlah Lap</th>
            <th class="col-actions">Aksi</th>
        </tr>';

        // Lokasi file template HTML
        $templatePath = __DIR__ . "/../template/skin_acara.html";

        // Kalau file template ditemukan, lakukan replace placeholder
        if (file_exists($templatePath)) {
            $template = file_get_contents($templatePath);

            // Masukin thead ke template
            $template = str_replace("<!--DATA_THEAD-->", $thead, $template);

            // Masukin tbody ke template
            $template = str_replace("<!--DATA_TBODY-->", $tbody, $template);

            // Ganti judul halaman
            $template = str_replace("<!--PAGE_TITLE-->", "Daftar Acara Balapan", $template);

            // Hitung total data yang tampil
            $total = count($listAcara);
            $template = str_replace("Total:", "Total: " . $total, $template);

            return $template;  
        }

    
        return $tbody;
    }

    public function tampilFormAcara($data = null): string
    {
        // Ambil file template form acara
        $template = file_get_contents(__DIR__ . "/../template/form_acara.html");

     
        if ($data) {
          
            $template = str_replace('value="add" id="acara-action"', 'value="edit" id="acara-action"', $template);

            // Isi ID acara ke input hidden
            $template = str_replace('value="" id="acara-id"', 'value="' . htmlspecialchars($data['id']) . '" id="acara-id"', $template);

            // Prefill nama acara
            $template = str_replace(
                'id="nama_acara" name="nama_acara" type="text" placeholder="Nama acara"', 
                'id="nama_acara" name="nama_acara" type="text" placeholder="Nama acara" value="' . htmlspecialchars($data['nama_acara']) . '"', 
                $template
            );

            // Prefill lokasi acara
            $template = str_replace(
                'id="lokasi" name="lokasi" type="text" placeholder="Lokasi acara"', 
                'id="lokasi" name="lokasi" type="text" placeholder="Lokasi acara" value="' . htmlspecialchars($data['lokasi']) . '"', 
                $template
            );

            // Prefill tanggal acara
            $template = str_replace(
                'id="tanggal" name="tanggal" type="date"', 
                'id="tanggal" name="tanggal" type="date" value="' . htmlspecialchars($data['tanggal']) . '"', 
                $template
            );

            // Prefill jumlah lap
            $template = str_replace(
                'id="jumlah_lap" name="jumlah_lap" type="number" min="1" step="1" placeholder="0"', 
                'id="jumlah_lap" name="jumlah_lap" type="number" min="1" step="1" placeholder="0" value="' . htmlspecialchars($data['jumlah_lap']) . '"', 
                $template
            );
        }

        return $template;
    }
}

?>
