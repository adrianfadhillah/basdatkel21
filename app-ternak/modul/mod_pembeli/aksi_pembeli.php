<?php
// open koneksi
include "../../config/koneksi.php";

// direct link untuk menentukan aksi
$page	= $_GET['page'];
$act	= $_GET['act'];

// Aksi menambah data
if($page == 'pembeli' AND $act == 'tambah'){
    try{
        // variabel untuk menampung nilai-nilai dari form tambah
        $nik                     = $_POST['txt_nik'];
        $nama_pembeli            = $_POST['txt_nama_pembeli'];
        $alamat_pembeli          = $_POST['txt_alamat_pembeli'];
        $no_hp                   = $_POST['txt_no_hp'];
        $email_pembeli           = $_POST['txt_email_pembeli'];
        
        // query untuk cek apakah primary dapat digunakan
        $cek    = pg_query($koneksi,"SELECT * FROM data_pembeli WHERE nik='$nik'");

        // validasi primary 
        if(pg_num_rows($cek) == 0){
            // query tambah data
            $sql    =   "INSERT INTO data_pembeli
                            (nik, nama_pembeli, alamat_pembeli, no_hp, email_pembeli)
                        VALUES(
                                '$nik',
                                '$nama_pembeli',
                                '$alamat_pembeli',
                                '$no_hp',
                                '$email_pembeli'
                            )";
            // execute query
            $query  = pg_query($koneksi,$sql);

            // query untuk cek apakah data berhasil disimpan
            $cek    = pg_query($koneksi,"SELECT * FROM data_pembeli WHERE nik ='$nik'");
            
            // validasi apakah data berhasil disimpan
            if(pg_num_rows($cek) != 0){
                echo "
                    <script type='text/javascript'>
                        alert('Data berhasil disimpan');
                        window.location.href='../../media.php?page=pembeli';
                    </script>
                ";
            }else{
                echo "
                    <script type='text/javascript'>
                        alert('Data gagal disimpan');
                        window.location.href='../../media.php?page=pembeli';
                    </script>
                ";
            }
        }else{
            echo "
                <script type='text/javascript'>
                    alert('Data gagal disimpan');
                    window.location.href='../../media.php?page=pembeli';
                </script>
            ";
        }
    }
    catch(Exception $e){
        echo $e->getMessage();
    }
}

// Aksi merubah data
if($page == 'pembeli' AND $act == 'ubah'){
    try{
        // variabel untuk menampung nilai-nilai dari form ubah
        $nik                     = $_POST['txt_nik'];
        $nama_pembeli            = $_POST['txt_nama_pembeli'];
        $alamat_pembeli          = $_POST['txt_alamat_pembeli'];
        $no_hp                   = $_POST['txt_no_hp'];
        $email_pembeli           = $_POST['txt_email_pembeli'];

        // query ubah data
        $sql    = "UPDATE data_pembeli set
                    nama_pembeli          = '$nama_pembeli',
                    alamat_pembeli        = '$alamat_pembeli',
                    no_hp                 = '$no_hp',
                    email_pembeli         = '$email_pembeli'
                        where nik         = '$nik';
        ";

        // execute query
        $query  = pg_query($koneksi,$sql);
        
        // cek apakah berhasil diubah
        if($query){
            echo "
                <script type='text/javascript'>
                    alert('Data berhasil disimpan');
                    window.location.href='../../media.php?page=pembeli';
                </script>
            ";
        }else{
            echo "
                <script type='text/javascript'>
                    alert('Data gagal disimpan');
                    window.location.href='../../media.php?page=pembeli';
                </script>
            ";
        }
    }
    catch(Exception $e){
        echo $e->getMessage();
    }
}

// Aksi menghapus data
if($page == 'pembeli' AND $act == 'hapus'){
    try{
        // variabel untuk menampung nilai-nilai dari form hapus
        $nik = $_GET['nik'];

        // Query untuk menghapus data
        $sql = "DELETE FROM data_pembeli
                WHERE nik='$nik'
        ";

        // execute query
        $query  = pg_query($koneksi,$sql);

        // cek apakah berhasil diubah
        if($query){
            echo "
                <script type='text/javascript'>
                    alert('Data berhasil dihapus');
                    window.location.href='../../media.php?page=pembeli';
                </script>
            ";
        }else{
            echo "
                <script type='text/javascript'>
                    alert('Data gagal dihapus');
                    window.location.href='../../media.php?page=pembeli';
                </script>
            ";
        }
    }
    catch(Exception $e){
        echo $e->getMessage();
    }
}





?>