<?php
    // nemapung lokasi path untuk akses kedatabase
    $aksi = "modul/mod_transaksi/aksi_transaksi.php";
    
    //mengatasi variabel yang belum di definisikan (notice undefined index)
    $act = isset($_GET['act']) ? $_GET['act'] : '';

    // percabangan untuk memilih tampilan yang ingin ditampilkan
    switch($act){
        default:
            echo "
                <h3 class='page-header text-primary'> Data Riwayat Transaksi </h3>
            ";
            echo "
                <h3>
                    <button
                        class='btn btn-sm btn-primary'
                        type='button' style='width:20%'
                        onclick=window.location.href='?page=transaksi&act=tambah'>
                            <span class='glyphicon glyphicon-plus'></span> Tambah Pesanan
                    </button>
                </h3>
            ";

            // membuat tag table untuk menampilkan data
            echo"<table class='table table-bordered table-hover'>";
                echo"                
                    <thead>
                        <tr>
                            <th width='10%'>Tanggal Order</th>
                            <th width='13%'>Pembeli</th>
                            <th width='15%'>Hewan</th>
                            <th width='15%'>Toko</th>
                            <th width='7%'>Jumlah Order</th>
                            <th width='15%'>Total Pembayaran</th>
                            <th width='7%'>Aksi</th>
                        </tr>
                    </thead>
                ";
                echo "<tbody>";
                    // query untuk menampilkan data
                    $query  = pg_query($koneksi, "SELECT tanggal_order, id_toko, nik, id_hewan, jumlah_order, total_pembayaran, id_order from data_order order by tanggal_order desc");
                    $total  = pg_num_rows($query);
                    $no     = 1;

                    // menampilkan data perbaris ke dalam tag table
                    while($r = pg_fetch_array($query)){
                        echo"
                            <tr>
                                <td>$r[tanggal_order]</td>
                                <td>$r[nik]</td>
                                <td>$r[id_hewan]</td>
                                <td>$r[id_toko]</td>
                                <td>$r[jumlah_order]</td>
                                <td>$r[total_pembayaran]</td>
                                <td>
                                    
                                    <a href='$aksi?page=transaksi&act=hapus&id_order=$r[id_order]'>
                                        <button type='button' class='btn btn-sm btn-danger'>
                                            <span class='glyphicon glyphicon-trash'></span>
                                        </button>
                                    </a>
                                </td>
                            </tr>
                        ";
                        $no++;
                    }
                echo "</tbody>";
            echo"</table>";
        break;

        case "tambah":
            echo "<div class='panel panel-default center-block'>";
                echo "<div class='panel-heading'>Form Pemesanan</div>";
                echo "<div class='panel-body'>";
                    echo "
                        <form role='form' action='$aksi?page=transaksi&act=tambah' method='post' name='frm_tambah' id='frm_tambah' enctype='multipart/form-data'>
                            
                        <div class='form-group'>
                                <label>Tanggal Order</label>
                                <input class='form-control' type='date' name='txt_tanggal_order' id='txt_tanggal_order' placeholder='Masukkan tanggal pemesanan' required>
                            </div>

                            <div class='form-group'>
                                <label>NIK</label>
                                <input class='form-control' type='number' name='txt_nik' id='txt_nik' placeholder='Masukkan NIK' required>
                            </div>

                            <div class='form-group'>
                                <label>ID Hewan</label>
                                <input class='form-control' type='text' name='txt_id_hewan' id='txt_id_hewan' placeholder='Masukkan ID Hewan' required>
                            </div>

                            <div class='form-group'>
                                <label>ID Toko</label>
                                <input class='form-control' type='text' name='txt_id_toko' id='txt_id_toko' placeholder='Masukkan ID Toko' required>
                            </div>

                            <div class='form-group'>
                                <label>Jumlah</label>
                                <input class='form-control' type='number' name='txt_jumlah_order' id='txt_jumlah_order' placeholder='Masukkan jumlah pemesanan' required>
                            </div>

                            <div class='form-group'>
                                <label>Total Pembayaran</label>
                                <input class='form-control' type='number' name='txt_total_pembayaran' id='txt_total_pembayaran' placeholder='Masukkan jumlah pemesanan' required>
                            </div>

                            <div class='form-group'>
                                <button class='btn btn-sm btn-primary' type='submit' style='width:20%'><span class='glyphicon glyphicon-save'></span> Simpan</button>
                            </div>
                        </form>
                    ";
                echo "</div>"; // tutup tag body panel
            echo "</div>"; // tutup tag panel
        break;
        
       
    }
?> 