<?php
// open koneksi
include "../../config/koneksi.php";

// direct link untuk menentukan aksi
$page	= $_GET['page'];
$act	= $_GET['act'];

// Aksi menambah data
if($page == 'hewan' AND $act == 'tambah'){
    try{
        // variabel untuk menampung nilai-nilai dari form tambah
        $id_hewan                = $_POST['txt_id_hewan'];
        $nama_hewan              = $_POST['txt_nama_hewan'];
        $jenis_hewan             = $_POST['txt_jenis_hewan'];
        $kategori_berat          = $_POST['txt_kategori_berat'];
        $harga_hewan             = $_POST['txt_harga_hewan'];
        $id_toko                 = $_POST['txt_id_toko'];

        // query untuk cek apakah primary dapat digunakan
        $cek    = pg_query($koneksi,"SELECT * FROM data_ternak WHERE id_hewan='$id_hewan'");

        // validasi primary 
        if(pg_num_rows($cek) == 0){
            // query tambah data
            $sql    =   "INSERT INTO data_ternak
                            (id_hewan, nama_hewan, jenis_hewan, kategori_berat, harga_hewan,id_toko)
                        VALUES(
                                '$id_hewan',
                                '$nama_hewan',
                                '$jenis_hewan',
                                '$kategori_berat',
                                '$harga_hewan',
                                '$id_toko'
                            )";
            // execute query
            $query  = pg_query($koneksi,$sql);

            // query untuk cek apakah data berhasil disimpan
            $cek    = pg_query($koneksi,"SELECT * FROM data_ternak WHERE id_hewan='$id_hewan'");
            
            // validasi apakah data berhasil disimpan
            if(pg_num_rows($cek) != 0){
                echo "
                    <script type='text/javascript'>
                        alert('Data berhasil disimpan');
                        window.location.href='../../media.php?page=hewan';
                    </script>
                ";
            }else{
                echo "
                    <script type='text/javascript'>
                        alert('Data gagal disimpan');
                        window.location.href='../../media.php?page=hewan';
                    </script>
                ";
            }
        }else{
            echo "
                <script type='text/javascript'>
                    alert('Data gagal disimpan');
                    window.location.href='../../media.php?page=hewan';
                </script>
            ";
        }
    }
    catch(Exception $e){
        echo $e->getMessage();
    }
}

// Aksi merubah data
if($page == 'hewan' AND $act == 'ubah'){
    try{
        // variabel untuk menampung nilai-nilai dari form ubah
        $id_hewan                = $_POST['txt_id_hewan'];
        $nama_hewan              = $_POST['txt_nama_hewan'];
        $jenis_hewan             = $_POST['txt_jenis_hewan'];
        $kategori_berat          = $_POST['txt_kategori_berat'];
        $harga_hewan             = $_POST['txt_harga_hewan'];
        $id_toko                 = $_POST['txt_id_toko'];

        // query ubah data
        $sql    = "UPDATE data_ternak set
                    nama_hewan            = '$nama_hewan',
                    jenis_hewan           = '$jenis_hewan',
                    kategori_berat        = '$kategori_berat',
                    harga_hewan           = '$harga_hewan',
                    id_toko               = '$id_toko'
                        where id_hewan = '$id_hewan';
        ";

        // execute query
        $query  = pg_query($koneksi,$sql);
        
        // cek apakah berhasil diubah
        if($query){
            echo "
                <script type='text/javascript'>
                    alert('Data berhasil disimpan');
                    window.location.href='../../media.php?page=hewan';
                </script>
            ";
        }else{
            echo "
                <script type='text/javascript'>
                    alert('Data gagal disimpan');
                    window.location.href='../../media.php?page=hewan';
                </script>
            ";
        }
    }
    catch(Exception $e){
        echo $e->getMessage();
    }
}

// Aksi menghapus data
if($page == 'hewan' AND $act == 'hapus'){
    try{
        // variabel untuk menampung nilai-nilai dari form hapus
        $id_hewan = $_GET['id_hewan'];

        // Query untuk menghapus data
        $sql = "DELETE FROM data_ternak
                WHERE id_hewan='$id_hewan'
        ";

        // execute query
        $query  = pg_query($koneksi,$sql);

        // cek apakah berhasil diubah
        if($query){
            echo "
                <script type='text/javascript'>
                    alert('Data berhasil dihapus');
                    window.location.href='../../media.php?page=hewan';
                </script>
            ";
        }else{
            echo "
                <script type='text/javascript'>
                    alert('Data gagal dihapus');
                    window.location.href='../../media.php?page=hewan';
                </script>
            ";
        }
    }
    catch(Exception $e){
        echo $e->getMessage();
    }
}

?>