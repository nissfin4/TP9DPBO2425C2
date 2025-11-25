<?php
require_once __DIR__ . '/presenters/PresenterAcara.php';
$presenter = new PresenterAcara();


if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['action'])) {
    $action = $_POST['action'];

    if ($action === 'add') {
        // tambah
        $presenter->tambahAcara(
            $_POST['nama_acara'] ?? '',
            $_POST['lokasi'] ?? '',
            $_POST['tanggal'] ?? '',
            $_POST['jumlah_lap'] ?? 0
        );
        header("Location: acara.php");
        exit;
    } elseif ($action === 'edit') {
        // ubah
        $presenter->ubahAcara(
            $_POST['id'] ?? null,
            $_POST['nama_acara'] ?? '',
            $_POST['lokasi'] ?? '',
            $_POST['tanggal'] ?? '',
            $_POST['jumlah_lap'] ?? 0
        );
        header("Location: acara.php");
        exit;
    }
}

// hapus
if (!empty($_GET['hapus'])) {
    $presenter->hapusAcara($_GET['hapus']);
    header("Location: acara.php");
    exit;
}

// form tambah
if (!empty($_GET['add'])) {
    echo $presenter->tampilkanFormAcara();
    exit;
}

//form edit
if (!empty($_GET['edit'])) {
    echo $presenter->tampilkanFormAcara($_GET['edit']);
    exit;
}

// list acara 
echo $presenter->tampilkanAcara();
