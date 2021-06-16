<?php
    // nemapung lokasi path untuk akses kedatabase
    $aksi = "modul/mod_penjual/aksi_penjual.php";
    
    //mengatasi variabel yang belum di definisikan (notice undefined index)
    $act = isset($_GET['act']) ? $_GET['act'] : '';

    // percabangan untuk memilih tampilan yang ingin ditampilkan
    switch($act){
        default:
            echo "
                <h3 class='page-header text-primary'> Data Penjual Hewan Ternak </h3>
            ";
            echo "
                <h3>
                    <button
                        class='btn btn-sm btn-primary'
                        type='button' style='width:20%'
                        onclick=window.location.href='?page=penjual&act=tambah'>
                            <span class='glyphicon glyphicon-plus'></span> Tambah Data
                    </button>
                </h3>
            ";

            // membuat tag table untuk menampilkan data
            echo"<table class='table table-bordered table-hover'>";
                echo"                
                    <thead>
                        <tr>
                            <th width='8%'>ID Toko</th>
                            <th width='17%'>Nama Toko</th>
                            <th width='25%'>Alamat</th>
                            <th width='9%'>No. Telp</th>
                            <th width='20%'>Email</th>
                            <th width='10%'>Aksi</th>
                        </tr>
                    </thead>
                ";
                echo "<tbody>";
                    // query untuk menampilkan data
                    $query  = pg_query($koneksi, "SELECT * FROM data_penjual ORDER BY id_toko ASC");
                    $total  = pg_num_rows($query);
                    $no     = 1;

                    // menampilkan data perbaris ke dalam tag table
                    while($r = pg_fetch_array($query)){
                        echo"
                            <tr>
                                <td>$r[id_toko]</td>
                                <td>$r[nama_toko]</td>
                                <td>$r[alamat_toko]</td>
                                <td>$r[no_telp]</td>
                                <td>$r[email]</td>
                                <td>
                                    <a href='?page=penjual&act=ubah&id_toko=$r[id_toko]'>
                                        <button type='button' class='btn btn-sm btn-warning'>
                                            <span class='glyphicon glyphicon-edit'></span>
                                        </button>
                                    </a>
                                    <a href='$aksi?page=penjual&act=hapus&id_toko=$r[id_toko]'>
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
                        <form role='form' action='$aksi?page=penjual&act=tambah' method='post' name='frm_tambah' id='frm_tambah' enctype='multipart/form-data'>
                            <div class='form-group'>
                                <label>ID Toko</label>
                                <input class='form-control' type='text' name='txt_id_toko' id='txt_id_toko' placeholder='Masukkan ID Toko' required>
                            </div>

                            <div class='form-group'>
                                <label>Nama Toko</label>
                                <input class='form-control' type='text' name='txt_nama_toko' id='txt_nama_toko' placeholder='Masukkan Nama Toko' required>
                            </div>

                            <div class='form-group'>
                                <label>Alamat</label>
                                <input class='form-control' type='text' name='txt_alamat_toko' id='txt_alamat_toko' placeholder='Masukkan Alamat' required>
                            </div>

                            <div class='form-group'>
                                <label>No. Telepon</label>
                                <input class='form-control' type='text' name='txt_no_telp' id='txt_no_telp' placeholder='Masukkan No. Telepon' required>
                            </div>

                            <div class='form-group'>
                                <label>Email</label>
                                <input class='form-control' type='text' name='txt_email' id='txt_email' placeholder='Masukkan Email' required>
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
            $query  = pg_query($koneksi,"SELECT * FROM data_penjual WHERE id_toko='$_GET[id_toko]'");
            $r      = pg_fetch_array($query);

            // Panel ubah data
            echo "<div class='panel panel-default center-block'>";
                echo "<div class='panel-heading'>Form ubah data</div>";
                echo "<div class='panel-body'>";
                    echo "<form role='form' action='$aksi?page=penjual&act=ubah' method='post' name='frm_ubah' id='frm_ubah' enctype='multipart/form-data'>";
                        
                        // kode mk
                        echo "
                            <div class='form-group'>
                            <label>ID Toko</label>
                            <input class='form-control' type='text' name='txt_id_toko' id='txt_id_toko' placeholder='Masukkan ID Toko' value='$r[id_toko]' readonly>
                            </div>
                        ";
                        
                        // nama mk
                        echo "
                            <div class='form-group'>
                            <label>Nama Toko</label>
                            <input class='form-control' type='text' name='txt_nama_toko' id='txt_nama_toko' placeholder='Masukkan Nama Toko' value='$r[nama_toko]' required>
                            </div>
                        ";

                        // SKS
                        echo "
                            <div class='form-group'>
                            <label>Alamat</label>
                            <input class='form-control' type='text' name='txt_alamat_toko' id='txt_alamat_toko' placeholder='Masukkan Alamat' value='$r[alamat_toko]' required>
                            </div>
                        ";

                        // semester
                        echo "
                            <div class='form-group'>
                            <label>No. Telepon</label>
                            <input class='form-control' type='text' name='txt_no_telp' id='txt_no_telp' placeholder='Masukkan No. Telepon' value='$r[no_telp]' required>
                            </div>
                        ";

                        echo "
                            <div class='form-group'>
                            <label>Email</label>
                                <input class='form-control' type='text' name='txt_email' id='txt_email' placeholder='Masukkan Email' value='$r[email]' required>
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
    }
?> 