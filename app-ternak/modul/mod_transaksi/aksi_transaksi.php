<?php
// open koneksi
include "../../config/koneksi.php";

// direct link untuk menentukan aksi
$page	= $_GET['page'];
$act	= $_GET['act'];


// Aksi menambah data
if($page == 'transaksi' AND $act == 'tambah'){
    try{
        // variabel untuk menampung nilai-nilai dari form tambah
        $tanggal_order                = $_POST['txt_tanggal_order'];
        $nik                          = $_POST['txt_nik'];
        $id_hewan                     = $_POST['txt_id_hewan'];
        $id_toko                      = $_POST['txt_id_toko'];
        $jumlah_order                 = $_POST['txt_jumlah_order'];
        $total_pembayaran             = $_POST['txt_total_pembayaran'];

        // validasi primary 
        
            $sql    =   "INSERT INTO data_order
                            (tanggal_order, nik, id_hewan, id_toko, jumlah_order,total_pembayaran)
                        VALUES(
                                '$tanggal_order',
                                '$nik',
                                '$id_hewan',
                                '$id_toko',
                                '$jumlah_order',
                                '$total_pembayaran'
                            )";
            // execute query
            $query  = pg_query($koneksi,$sql);
                     
          
            if($query == TRUE){
                echo "
                    <script type='text/javascript'>
                        alert('Data berhasil disimpan');
                        window.location.href='../../media.php?page=transaksi';
                    </script>
                ";
            }else{
                echo "
                    <script type='text/javascript'>
                        alert('Data gagal disimpan');
                        window.location.href='../../media.php?page=transaksi';
                    </script>
                ";
            }
        
    }
    catch(Exception $e){
        echo $e->getMessage();
    }
}

// Aksi merubah data
if($page == 'transaksi' AND $act == 'ubah') {
    try{
        $id_order = $_POST['id_order'];
        // variabel untuk menampung nilai-nilai dari form ubah
        $tanggal_order                = $_POST['txt_tanggal order'];
        $nik                          = $_POST['txt_nik'];
        $id_hewan                     = $_POST['txt_id_hewan'];
        $id_toko                      = $_POST['txt_id_toko'];
        $jumlah_order                 = $_POST['txt_jumlah_order'];
        $total_pembayaran             = $_POST['txt_total_pembayaran'];
        

        // query ubah data
        $sql    = "UPDATE data_order set
                    tanggal_order         = '$tanggal_order',
                    nik                   = '$nik',
                    id_hewan              = '$id_hewan',
                    id_toko               = '$toko',
                    jumlah_order          = '$jumlah_order',
                    total_pembayaran      = '$total_pembayaran'
                        where id_order         = '$id_order';
        ";

        // execute query
        $query  = pg_query($koneksi,$sql);
        
        // cek apakah berhasil diubah
        if($query){
            echo "
                <script type='text/javascript'>
                    alert('Data berhasil disimpan');
                    window.location.href='../../media.php?page=transaksi';
                </script>
            ";
        }else{
            echo "
                <script type='text/javascript'>
                    alert('Data gagal disimpan');
                    window.location.href='../../media.php?page=transaksi';
                </script>
            ";
        }
    }
    catch(Exception $e){
        echo $e->getMessage();
    }
}

// Aksi menghapus data
if($page == 'transaksi' AND $act == 'hapus'){
    try{
        // variabel untuk menampung nilai-nilai dari form hapus
        $id_order = $_GET['id_order'];

        // Query untuk menghapus data
        $sql = "DELETE FROM data_order
                WHERE id_order='$id_order'
        ";

        // execute query
        $query  = pg_query($koneksi,$sql);

        // cek apakah berhasil diubah
        if($query){
            echo "
                <script type='text/javascript'>
                    alert('Data berhasil dihapus');
                    window.location.href='../../media.php?page=transaksi';
                </script>
            ";
        }else{
            echo "
                <script type='text/javascript'>
                    alert('Data gagal dihapus');
                    window.location.href='../../media.php?page=transaksi';
                </script>
            ";
        }
    }
    catch(Exception $e){
        echo $e->getMessage();
    }
}

?>