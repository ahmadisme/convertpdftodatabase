<html>
<head>
	<title>Form Import</title>
	
	<!-- Load File jquery.min.js yang ada difolder js -->
	<script src="<?php echo base_url('js/jquery.min.js'); ?>"></script>
	
	<script>
	$(document).ready(function(){
		// Sembunyikan alert validasi kosong
		$("#kosong").hide();
	});
	</script>
</head>
<body>
	<h3>Form Import</h3>
	<hr>
	
	<a href="<?php echo base_url("excel/format.xlsx"); ?>">Download Format</a>
	<br>
	<br>
	
	<!-- Buat sebuah tag form dan arahkan action nya ke controller ini lagi -->
	<form method="post" action="<?php echo base_url("index.php/Import_controller/form"); ?>" enctype="multipart/form-data">
		<!-- 
		-- Buat sebuah input type file
		-- class pull-left berfungsi agar file input berada di sebelah kiri
		-->
		<input type="file" name="file">
		
		<!--
		-- BUat sebuah tombol submit untuk melakukan preview terlebih dahulu data yang akan di import
		-->
		<input type="submit" name="preview" value="Preview">
	</form>
	
	<?php
	if(isset($_POST['preview'])){ // Jika user menekan tombol Preview pada form 
		if(isset($upload_error)){ // Jika proses upload gagal
			echo "<div style='color: red;'>".$upload_error."</div>"; // Muncul pesan error upload
			die; // stop skrip
		}
		
		// Buat sebuah tag form untuk proses import data ke database
		echo "<form method='post' action='".base_url("index.php/Import_controller/import")."'>";
		
		// Buat sebuah div untuk alert validasi kosong
		echo "<div style='color: red;' id='kosong'>
		Semua data belum diisi, Ada <span id='jumlah_kosong'></span> data yang belum diisi.
		</div>";
		
		echo "<table border='1' cellpadding='8'>
		<tr>
			<th colspan='5'>Preview Data</th>
		</tr>
		<tr>
			<th>No</th>
			<th>Ruangan</th>
			<th>Pengguna</th>
			<th>Sub Klasifikasi</th>
			<th>Kode Barang</th>
			<th>Merk</th>
			<th>Tipe</th>
			<th>Keterangan</th>
			<th>Referensi</th>
			<th>Tanggal Referensi</th>
			<th>Masa Manfaat</th>
			<th>Pencatatan</th>
			<th>Kondisi</th>
			<th>Status Pemakaian</th>
			<th>Harga Perolehan Barang</th>	
		</tr>";
		
		$numrow = 1;
		$kosong = 0;
		
		// Lakukan perulangan dari data yang ada di excel
		// $sheet adalah variabel yang dikirim dari controller
		foreach($sheet as $row){ 
			// Ambil data pada excel sesuai Kolom
			$no = $row['A']; // Ambil data NIS
			$Ruangan = $row['B']; // Ambil data nama
			$Pengguna_barang = $row['C']; // Ambil data jenis kelamin
			$Sub_klasifikasi = $row['D']; // Ambil data alamat
			$Kode_barang = $row['E'];
			$Merk_barang =$row['F'];
			$Tipe = $row['G'];
			$Keterangan = $row['H'];
			$Referensi = $row['I'];
			$tahun_referensi = $row['J'];
			$Masa_Manfaat = $row['K'];
			$Pencatatan = $row['L'];
			$Kondisi = $row['M'];
			$Status_Pemakaian = $row['N'];
			$harga_perolehan_barang = $row['O'];
			// Cek jika semua data tidak diisi
			if(empty($no) && empty($ruangan) && empty($pengguna_barang) && empty($sub_klasifikasi) && empty($kode_barang) && empty($merk) && empty($tipe) && empty($keterangan) && empty($referensi) && empty($tahun_referensi) && empty($masa_manfaat) && empty($pencatatan) && empty($kondisi) && empty($status_pemakaian) && empty($harga_perolehan_barang) )
				continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)
			
			// Cek $numrow apakah lebih dari 1
			// Artinya karena baris pertama adalah nama-nama kolom
			// Jadi dilewat saja, tidak usah diimport
			if($numrow > 1){
				// Validasi apakah semua data telah diisi
				$no_td = ( ! empty($no))? "" : " style='background: #E07171;'"; // Jika NIS kosong, beri warna merah
				$ruangan_td = ( ! empty($ruangan))? "" : " style='background: #E07171;'"; // Jika Nama kosong, beri warna merah
				$pengguna_barang_td = ( ! empty($pengguna_barang))? "" : " style='background: #E07171;'"; // Jika Jenis Kelamin kosong, beri warna merah
				$sub_klasifikasi_td = ( ! empty($sub_klasifikasi))? "" : " style='background: #E07171;'"; // Jika Alamat kosong, beri warna merah
				$kode_barang_td = ( ! empty($kode_barang))? "" : " style='background: #E07171;'";
				$merk_td = ( ! empty($merk))? "" : " style='background: #E07171;'";
				$tipe_td = ( ! empty($tipe))? "" : " style='background: #E07171;'";
				$keterangan_td = ( ! empty($keterangan))? "" : " style='background: #E07171;'";
				$referensi_td = ( ! empty($referensi))? "" : " style='background: #E07171;'";
				$tahun_referensi_td = ( ! empty($tahun_referensi))? "" : " style='background: #E07171;'";
				$masa_manfaat_td = ( ! empty($masa_manfaat))? "" : " style='background: #E07171;'";
				$pencatatan_td = ( ! empty($pencatatan))? "" : " style='background: #E07171;'";
				$kondisi_td = ( ! empty($kondisi))? "" : " style='background: #E07171;'";
				$status_pemakaian_td = ( ! empty($status_pemakaian))? "" : " style='background: #E07171;'";
				$harga_perolehan_barang_td = ( ! empty($harga_perolehan_barang))? "" : " style='background: #E07171;'";


				
				// Jika salah satu data ada yang kosong
				if(empty($no) && empty($ruangan) && empty($pengguna_barang) && empty($sub_klasifikasi) && empty($kode_barang) && empty($merk) && empty($tipe) && empty($keterangan) && empty($referensi) && empty($tahun_referensi) && empty($masa_manfaat) && empty($pencatatan) && empty($kondisi) && empty($status_pemakaian)){
					$kosong++; // Tambah 1 variabel $kosong
				}
				
				echo "<tr>";
				echo "<td".$no_td.">".$no."</td>";
				echo "<td".$ruangan_td.">$Ruangan</td>";
				echo "<td".$pengguna_barang_td.">$Pengguna_barang</td>";
				echo "<td".$sub_klasifikasi_td.">$Sub_klasifikasi</td>";
				echo "<td".$kode_barang_td.">$Kode_barang</td>";
				echo "<td".$merk_td.">$Merk_barang</td>";
				echo "<td".$tipe_td.">$Tipe</td>";
				echo "<td".$keterangan_td.">$Keterangan</td>";
				echo "<td".$referensi_td.">$Referensi</td>";
				echo "<td".$tahun_referensi_td.">$tahun_referensi</td>";
				echo "<td".$masa_manfaat_td.">$Masa_Manfaat</td>";
				echo "<td".$pencatatan_td.">$Pencatatan</td>";
				echo "<td".$kondisi_td.">$Kondisi</td>";
				echo "<td".$status_pemakaian_td.">$Status_Pemakaian</td>";
				echo "<td".$harga_perolehan_barang_td.">$harga_perolehan_barang</td>";
				echo "</tr>";
			}
			
			$numrow++; // Tambah 1 setiap kali looping
		}
		
		echo "</table>";
		
		// Cek apakah variabel kosong lebih dari 1
		// Jika lebih dari 1, berarti ada data yang masih kosong
		if($kosong > 1){
		?>	
			<script>
			$(document).ready(function(){
				// Ubah isi dari tag span dengan id jumlah_kosong dengan isi dari variabel kosong
				$("#jumlah_kosong").html('<?php echo $kosong; ?>');
				
				$("#kosong").show(); // Munculkan alert validasi kosong
			});
			</script>
		<?php
		}else{ // Jika semua data sudah diisi
			echo "<hr>";
			
			// Buat sebuah tombol untuk mengimport data ke database
			echo "<button type='submit' name='import'>Import</button>";
			echo "<a href='".base_url("Import_controller/form")."'>Cancel</a>";
		}
		
		echo "</form>";
	}
	?>
</body>
</html>
