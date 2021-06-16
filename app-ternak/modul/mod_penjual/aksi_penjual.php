<?php
// open koneksi
include "../../config/koneksi.php";

// direct link untuk menentukan aksi
$page	= $_GET['page'];
$act	= $_GET['act'];

// Aksi menambah data
if($page == 'penjual' AND $act == 'tambah'){
	try{
		// variabel untuk menampung nilai-nilai dari form tambah
		$id_toko            = $_POST['txt_id_toko'];
		$nama_toko          = $_POST['txt_nama_toko'];
		$alamat_toko        = $_POST['txt_alamat_toko'];
		$no_telepon         = $_POST['txt_no_telp'];
		$email              = $_POST['txt_email'];

		// query untuk cek apakah primary dapat digunakan
		$cek    = pg_query($koneksi,"SELECT * FROM data_penjual WHERE id_toko='$id_toko'");

		// validasi primary 
		if(pg_num_rows($cek) == 0){
			// query tambah data
			$sql    =   "INSERT INTO data_penjual
							(id_toko, nama_toko, alamat_toko, no_telp, email)
						VALUES(
								'$id_toko',
								'$nama_toko',
								'$alamat_toko',
								'$no_telepon',
								'$email'
							)";
			// execute query
			$query  = pg_query($koneksi,$sql);

			// query untuk cek apakah data berhasil disimpan
			$cek    = pg_query($koneksi,"SELECT * FROM data_penjual WHERE id_toko='$id_toko'");
			
			// validasi apakah data berhasil disimpan
			if(pg_num_rows($cek) != 0){
				echo "
					<script type='text/javascript'>
						alert('Data berhasil disimpan');
						window.location.href='../../media.php?page=penjual';
					</script>
				";
			}else{
				echo "
					<script type='text/javascript'>
						alert('Data gagal disimpan');
						window.location.href='../../media.php?page=penjual';
					</script>
				";
			}
		}else{
			echo "
				<script type='text/javascript'>
					alert('Data gagal disimpan');
					window.location.href='../../media.php?page=penjual';
				</script>
			";
		}
	}
	catch(Exception $e){
		echo $e->getMessage();
	}
}

// Aksi merubah data
if($page == 'penjual' AND $act == 'ubah'){
	try{
		// variabel untuk menampung nilai-nilai dari form tambah
		$id_toko            = $_POST['txt_id_toko'];
		$nama_toko          = $_POST['txt_nama_toko'];
		$alamat_toko        = $_POST['txt_alamat_toko'];
		$no_telepon         = $_POST['txt_no_telp'];
		$email              = $_POST['txt_email'];

		// query ubah data
		$sql    = "UPDATE data_penjual set
					id_toko            	= '$id_toko',
					nama_toko			= '$nama_toko',
					alamat_toko    		= '$alamat_toko',
					no_telp          	= '$no_telepon',
					email            	= '$email'
						where id_toko 	= '$id_toko';
		";

		// execute query
		$query  = pg_query($koneksi,$sql);
		
		// cek apakah berhasil diubah
		if($query){
			echo "
				<script type='text/javascript'>
					alert('Data berhasil disimpan');
					window.location.href='../../media.php?page=penjual';
				</script>
			";
		}else{
			echo "
				<script type='text/javascript'>
					alert('Data gagal disimpan');
					window.location.href='../../media.php?page=penjual';
				</script>
			";
		}
	}
	catch(Exception $e){
		echo $e->getMessage();
	}
}

// Aksi menghapus data
if($page == 'penjual' AND $act == 'hapus'){
	try{
		// variabel untuk menampung nilai-nilai dari form hapus
		$id_toko = $_GET['id_toko'];

		// Query untuk menghapus data
		$sql = "DELETE FROM data_penjual
				WHERE id_toko ='$id_toko'
		";

		// execute query
		$query  = pg_query($koneksi,$sql);

		// cek apakah berhasil diubah
		if($query){
			echo "
				<script type='text/javascript'>
					alert('Data berhasil dihapus');
					window.location.href='../../media.php?page=penjual';
				</script>
			";
		}else{
			echo "
				<script type='text/javascript'>
					alert('Data gagal dihapus');
					window.location.href='../../media.php?page=penjual';
				</script>
			";
		}
	}
	catch(Exception $e){
		echo $e->getMessage();
	}
}

?>