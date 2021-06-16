<?php
    // nemapung lokasi path untuk akses kedatabase
    $aksi = "modul/mod_pembeli/aksi_pembeli.php";
    
    //mengatasi variabel yang belum di definisikan (notice undefined index)
    $act = isset($_GET['act']) ? $_GET['act'] : '';

    // percabangan untuk memilih tampilan yang ingin ditampilkan
    switch($act){
        default:
            echo "
                <h3 class='page-header text-primary'> Data Pembeli </h3>
            ";
            echo "
                <h3>
                    <button
                        class='btn btn-sm btn-primary'
                        type='button' style='width:20%'
                        onclick=window.location.href='?page=pembeli&act=tambah'>
                            <span class='glyphicon glyphicon-plus'></span> Tambah Data
                    </button>
                </h3>
            ";

            // membuat tag table untuk menampilkan data
            echo"<table class='table table-bordered table-hover'>";
                echo"                
                    <thead>
                        <tr>
                            <th width='12%'>NIK</th>
                            <th width='17%'>Nama</th>
                            <th width='20%'>Alamat</th>
                            <th width='14%'>No. HP</th>
                            <th width='17%'>Email</th>
                            <th width='10%'>Aksi</th>
                        </tr>
                    </thead>
                ";
                echo "<tbody>";
                    // query untuk menampilkan data
                    $query  = pg_query($koneksi, "SELECT * FROM data_pembeli ORDER BY nama_pembeli ASC");
                    $total  = pg_num_rows($query);
                    $no     = 1;

                    // menampilkan data perbaris ke dalam tag table
                    while($r = pg_fetch_array($query)){
                        echo"
                            <tr>
                                <td>$r[nik]</td>
                                <td>$r[nama_pembeli]</td>
                                <td>$r[alamat_pembeli]</td>
                                <td>$r[no_hp]</td>
                                <td>$r[email_pembeli]</td>
                                <td>
                                    <a href='?page=pembeli&act=ubah&nik=$r[nik]'>
                                        <button type='button' class='btn btn-sm btn-warning'>
                                            <span class='glyphicon glyphicon-edit'></span>
                                        </button>
                                    </a>
                                    <a href='?page=pembeli&act=history&nik=$r[nik]'>
                                        <button type='button' class='btn btn-sm btn-info'>
                                            <span class='glyphicon glyphicon-hourglass'></span>
                                        </button>
                                    </a>
                                    <a href='$aksi?page=pembeli&act=hapus&nik=$r[nik]'>
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
                echo "<div class='panel-heading'>Form tambah data</div>";
                echo "<div class='panel-body'>";
                    echo "
                        <form role='form' action='$aksi?page=pembeli&act=tambah' method='post' name='frm_tambah' id='frm_tambah' enctype='multipart/form-data'>
                            <div class='form-group'>
                                <label>NIK</label>
                                <input class='form-control' type='number' name='txt_nik' id='txt_nik' placeholder='Masukkan NIK' required>
                            </div>

                            <div class='form-group'>
                                <label>Nama</label>
                                <input class='form-control' type='text' name='txt_nama_pembeli' id='txt_nama_pembeli' placeholder='Masukkan Nama Pembeli' required>
                            </div>

                            <div class='form-group'>
                                <label>Alamat</label>
                                <input class='form-control' type='text' name='txt_alamat_pembeli' id='txt_alamat_pembeli' placeholder='Masukkan Nama Pembeli' required>
                            </div>

                            <div class='form-group'>
                                <label>No. HP</label>
                                <input class='form-control' type='text' name='txt_no_hp' id='txt_no_hp' placeholder='Masukkan Nomor HP' required>
                            </div>

                            <div class='form-group'>
                                <label>Email</label>
                                <input class='form-control' type='text' name='txt_email_pembeli' id='txt_email_pembeli' placeholder='Masukkan Email' required>
                            </div>

                            <div class='form-group'>
                                <button class='btn btn-sm btn-primary' type='submit' style='width:20%'><span class='glyphicon glyphicon-save'></span> Simpan</button>
                            </div>
                        </form>
                    ";
                echo "</div>"; // tutup tag body panel
            echo "</div>"; // tutup tag panel
        break;

        case "ubah":
            // Query SQL
            $query  = pg_query($koneksi,"SELECT * FROM data_pembeli WHERE nik='$_GET[nik]'");
            $r      = pg_fetch_array($query);

            // Panel ubah data
            echo "<div class='panel panel-default center-block'>";
            echo "<div class='panel-heading'>Form ubah data</div>";
            echo "<div class='panel-body'>";
                echo "<form role='form' action='$aksi?page=pembeli&act=ubah' method='post' name='frm_ubah' id='frm_ubah' enctype='multipart/form-data'>";
                    
                    // kode mk
                    echo "
                        <div class='form-group'>
                        <label>NIK</label>
                        <input class='form-control' type='number' name='txt_nik' id='txt_nik' placeholder='Masukkan NIK' value='$r[nik]' readonly>
                        </div>
                    ";
                    
                    // nama mk
                    echo "
                        <div class='form-group'>
                        <label>Nama</label>
                        <input class='form-control' type='text' name='txt_nama_pembeli' id='txt_nama_pembeli' placeholder='Masukkan Nama Pembeli' value='$r[nama_pembeli]' required>
                        </div>
                    ";

                    // SKS
                    echo "
                        <div class='form-group'>
                        <label>Alamat</label>
                        <input class='form-control' type='text' name='txt_alamat_pembeli' id='txt_alamat_pembeli' placeholder='Masukkan Nama Pembeli' value='$r[alamat_pembeli]' required>
                        </div>
                    ";

                    // semester
                    echo "
                        <div class='form-group'>
                        <label>No. HP</label>
                                <input class='form-control' type='text' name='txt_no_hp' id='txt_no_hp' placeholder='Masukkan Nomor HP' value='$r[no_hp]' required>
                        </div>
                    ";

                    echo "
                        <div class='form-group'>
                        <label>Email</label>
                        <input class='form-control' type='text' name='txt_email_pembeli' id='txt_email_pembeli' placeholder='Masukkan Email' value='$r[email_pembeli]' required>
                        </div>
                    ";
                    // Sumbit
                    echo"
                        <div class='form-group'>
                            <button class='btn btn-sm btn-primary' type='submit' style='width:20%'><span class='glyphicon glyphicon-save'></span> Simpan</button>
                        </div>
                    ";

                echo "</form>"; // tutup tag form
            echo "</div>"; // tutup tag body panel
        echo "</div>"; // tutup tag panel
    break;

    case "history":
        
            echo "
                <h3 class='page-header text-primary'> Riwayat Pembelian </h3>
            ";
            
            // membuat tag table untuk menampilkan data
            echo"<table class='table table-bordered table-hover'>";
                echo"                
                    <thead>
                        <tr>
                            <th width='12%'>Tanggal</th>
                            <th width='12%'>Hewan</th>
                            <th width='17%'>Jenis</th>
                            <th width='20%'>Kategori</th>
                            <th width='4%'>Jumlah</th>
                            <th width='17%'>Total Pembayaran</th>
                            <th width='10%'>Toko</th>
                            
                        </tr>
                    </thead>
                ";
                echo "<tbody>";
                    $nik    = $_GET['nik']; 
                    $query  = pg_query($koneksi,"SELECT o.tanggal_order, h.nama_hewan, h.jenis_hewan, h.kategori_berat, o.jumlah_order, o.total_pembayaran, j.nama_toko
                    from data_penjual j, data_ternak h, data_order o, data_pembeli p where h.id_hewan = o.id_hewan and j.id_toko = o.id_toko and p.nik = o.nik order by o.tanggal_order DESC");
                    $no     = 1;
                    while($r      = pg_fetch_array($query)){
                    // query untuk menampilkan data
                    
                        echo"
                            <tr>
                                <td>$r[tanggal_order]</td>
                                <td>$r[nama_hewan]</td>
                                <td>$r[jenis_hewan]</td>
                                <td>$r[kategori_berat]</td>
                                <td>$r[jumlah_order]</td>
                                <td>$r[total_pembayaran]</td>
                                <td>$r[nama_toko]</td>
                                
                            </tr>
                        ";
                        $no++;
                    }
                echo "</tbody>";
            echo"</table>";
        break;
   
    
    
}
?> 