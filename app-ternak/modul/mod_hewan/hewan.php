<?php
    // nemapung lokasi path untuk akses kedatabase
    $aksi = "modul/mod_hewan/aksi_hewan.php";
    
    //mengatasi variabel yang belum di definisikan (notice undefined index)
    $act = isset($_GET['act']) ? $_GET['act'] : '';

    // percabangan untuk memilih tampilan yang ingin ditampilkan
    switch($act){
        default:
            echo "
                <h3 class='page-header text-primary'> Data Hewan Ternak </h3>
            ";
            echo "
                <h3>
                    <button
                        class='btn btn-sm btn-primary'
                        type='button' style='width:20%'
                        onclick=window.location.href='?page=hewan&act=tambah'>
                            <span class='glyphicon glyphicon-plus'></span> Tambah Data
                    </button>
                </h3>
            ";

            // membuat tag table untuk menampilkan data
            echo"<table class='table table-bordered table-hover'>";
                echo"                
                    <thead>
                        <tr>
                            <th width='8%'>ID Hewan</th>
                            <th width='15%'>Nama Hewan</th>
                            <th width='7%'>Jenis</th>
                            <th width='10%'>Kategori berat</th>
                            <th width='15%'>Harga</th>
                            <th width='8%'>ID Toko</th>
                            <th width='13%'>Aksi</th>
                        </tr>
                    </thead>
                ";
                echo "<tbody>";
                    // query untuk menampilkan data
                    $query  = pg_query($koneksi, "SELECT * FROM data_ternak ORDER BY id_hewan ASC");
                    $total  = pg_num_rows($query);
                    $no     = 1;

                    // menampilkan data perbaris ke dalam tag table
                    while($r = pg_fetch_array($query)){
                        echo"
                            <tr>
                                <td>$r[id_hewan]</td>
                                <td>$r[nama_hewan]</td>
                                <td>$r[jenis_hewan]</td>
                                <td>$r[kategori_berat]</td>
                                <td>$r[harga_hewan]</td>
                                <td>$r[id_toko]</td>
                                <td>
                                    <a href='?page=hewan&act=ubah&id_hewan=$r[id_hewan]'>
                                        <button type='button' class='btn btn-sm btn-warning'>
                                            <span class='glyphicon glyphicon-edit'></span>
                                        </button>
                                    </a>
                                    <a href='$aksi?page=hewan&act=hapus&id_hewan=$r[id_hewan]'>
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
                        <form role='form' action='$aksi?page=hewan&act=tambah' method='post' name='frm_tambah' id='frm_tambah' enctype='multipart/form-data'>
                            <div class='form-group'>
                                <label>ID Hewan</label>
                                <input class='form-control' type='text' name='txt_id_hewan' id='txt_id_hewan' placeholder='Masukan ID Hewan' required>
                            </div>

                            <div class='form-group'>
                                <label>Nama Hewan</label>
                                <input class='form-control' type='text' name='txt_nama_hewan' id='txt_nama_hewan' placeholder='Masukkan Nama Hewan' required>
                            </div>

                            <div class='form-group'>
                                <label>Jenis</label>
                                <input class='form-control' type='text' name='txt_jenis_hewan' id='txt_jenis_hewan' placeholder='Masukan Jenis Hewan' required>
                            </div>

                            <div class='form-group'>
                                <label>Kategori Berat</label>
                                <input class='form-control' type='text' name='txt_kategori_berat' id='txt_kategori_berat' placeholder='Masukkan Kategori Berat' required>
                            </div>

                            <div class='form-group'>
                                <label>Harga</label>
                                <input class='form-control' type='number' name='txt_harga_hewan' id='txt_harga_hewan' placeholder='Masukkan Harga Hewan' required>
                            </div>

                            <div class='form-group'>
                                <label>ID Toko</label>
                                <input class='form-control' type='text' name='txt_id_toko' id='txt_id_toko' placeholder='Masukan ID Toko' required>
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
            $query  = pg_query($koneksi,"SELECT * FROM data_ternak WHERE id_hewan='$_GET[id_hewan]'");
            $r      = pg_fetch_array($query);

            // Panel ubah data
            echo "<div class='panel panel-default center-block'>";
                echo "<div class='panel-heading'>Form ubah data</div>";
                echo "<div class='panel-body'>";
                    echo "<form role='form' action='$aksi?page=hewan&act=ubah' method='post' name='frm_ubah' id='frm_ubah' enctype='multipart/form-data'>";
                        
                        // id_hewan
                        echo "
                            <div class='form-group'>
                                <label>ID Hewan</label>
                                <input class='form-control' type='text' name='txt_id_hewan' id='txt_id_hewan' placeholder='Masukan ID Hewan' value='$r[id_hewan]' readonly>
                            </div>
                        ";
                        
                        // Nama Lengkap
                        echo "
                            <div class='form-group'>
                                <label>Nama Hewan</label>
                                <input class='form-control' type='text' name='txt_nama_hewan' id='txt_nama_hewan' placeholder='Masukan Nama Hewan' value='$r[nama_hewan]' required>
                            </div>
                        ";
                        
                         // Nama Lengkap
                         echo "
                         <div class='form-group'>
                             <label>Jenis Hewan</label>
                             <input class='form-control' type='text' name='txt_jenis_hewan' id='txt_jenis_hewan' placeholder='Masukan Jenis Hewan' value='$r[jenis_hewan]' required>
                         </div>
                        ";

                        // Tempat lahir
                        echo"
                            <div class='form-group'>
                                <label>Kategori Berat</label>
                                <input class='form-control' type='text' name='txt_kategori_berat' id='txt_kategori_berat' placeholder='Masukan Kategori Berat' value='$r[kategori_berat]' required>
                            </div>
                        ";

                        // Tanggal lahir
                        echo"
                            <div class='form-group'>
                                <label>Harga Hewan</label>
                                <input class='form-control' type='text' name='txt_harga_hewan' id='txt_harga_hewan' placeholder='Masukan Harga Hewan' value='$r[harga_hewan]' required>
                            </div>
                        ";

                        // Tanggal lahir
                        echo"
                            <div class='form-group'>
                                <label>ID Toko</label>
                                <input class='form-control' type='text' name='txt_id_toko' id='txt_id_toko' placeholder='Masukan ID Toko' value='$r[id_toko]' required>
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