<?php

include_once("models/DB.php");
include("models/TabelPembalap.php");
include("views/ViewPembalap.php");
include("presenters/PresenterPembalap.php");

$tabelPembalap = new TabelPembalap('localhost', 'mvp_db', 'root', '');
$viewPembalap = new ViewPembalap();
$presenter = new PresenterPembalap($tabelPembalap, $viewPembalap);



if(isset($_GET['screen'])){
    if($_GET['screen'] == 'add'){
        $formHtml = $presenter->tampilkanFormPembalap();
        echo $formHtml;
    }
    else if($_GET['screen'] == 'edit' && isset($_GET['id'])){
        $formHtml = $presenter->tampilkanFormPembalap($_GET['id']);
        echo $formHtml;
    }
} 


else if(isset($_POST['action'])){

    if($_POST['action'] == "add"){
        $presenter->tambahPembalap(
            $_POST['nama'],
            $_POST['tim'],
            $_POST['negara'],
            $_POST['poinMusim'],
            $_POST['jumlahMenang']
        );
    } 

    else if($_POST['action'] == "edit"){
        $presenter->ubahPembalap(
            $_POST['id'],
            $_POST['nama'],
            $_POST['tim'],
            $_POST['negara'],
            $_POST['poinMusim'],
            $_POST['jumlahMenang']
        );
    }
    else if($_POST['action'] == "delete"){
        $presenter->hapusPembalap($_POST['id']);
    }

    header("Location: index.php");
    exit();
}

else{
    echo '<div style="padding:16px;"><a href="acara.php" style="background:#2563eb;color:white;padding:10px 14px;border-radius:6px;text-decoration:none;">Kelola Acara</a></div>';

    $html = $presenter->tampilkanPembalap();
    echo $html;
}

?>
