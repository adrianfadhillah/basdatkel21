<?php
    // load koneksi dan library
    include "config/koneksi.php";
    include "config/library.php";

    // default halaman
    if($_GET["page"] == "home"){
        $tgl=date("Y-m-d");
		$tanggal=tgl_indo($tgl);
		
		// Menampilkan selamat datang dan tanggal
		echo "<p align=\"center\">Hai <b>".strtoupper($_SESSION["ses_nama"])."</b> selamat datang dihalaman <b>Administrator</b>.</p>";
		echo "<p align=\"center\">Login saat ini tanggal $tanggal</p>"; echo "<br>";

    }
    // mengecek hamalam berdasarkan modul-modulnya
    else if($_GET["page"] == "penjual"){
        include "modul/mod_penjual/penjual.php";
    }
    // mengecek hamalam berdasarkan modul-modulnya
    else if($_GET["page"] == "hewan"){
        include "modul/mod_hewan/hewan.php";
    }
    // mengecek hamalam berdasarkan modul-modulnya
    else if($_GET["page"] == "pembeli"){
        include "modul/mod_pembeli/pembeli.php";
    }
        // mengecek hamalam berdasarkan modul-modulnya
    else if($_GET["page"] == "transaksi"){
        include "modul/mod_transaksi/transaksi.php";
    }
    

?>