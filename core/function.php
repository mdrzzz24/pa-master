<?php 

// Login
function login($conn){
	if (isset($_POST['login'])) {
		$username = $_POST['username'];
		$password = $_POST['password'];

		$query = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
		$result = mysqli_query($conn, $query);

		// Cek
		if (mysqli_num_rows($result) > 0) {
			header('Location: admin.php?pesan=berhasil-login');
		}else{
			header('Location: login.php?pesan=gagal-login');
		}
	}
}

// Logout
function logout(){
	if (isset($_GET['logout'])) {
		header('Location: login.php?pesan=berhasil-logout');
	}
}

// Cari Keluhan
function cariKeluhan($conn){
	if (isset($_POST['search-keluhan'])) {
		$idKeluhan = $_POST['id-keluhan'];

		$query = "SELECT * FROM keluhan WHERE id_keluhan='$idKeluhan'";

		// Mengembalikan nilai
		return mysqli_query($conn, $query);
	}
}

// Feedback
function feedback($conn){
	if (isset($_GET['feedback'])) {
		$idKeluhan = $_GET['id_keluhan'];
		$feedback = $_GET['feedback'];

		// Mengupdate feedback
		if ($feedback == 1) {
			$query = "UPDATE keluhan SET feedback='Puas' WHERE id_keluhan='$idKeluhan'";
		}else if($feedback == 0){
			$query = "UPDATE keluhan SET feedback='Tidak Puas' WHERE id_keluhan='$idKeluhan'";
		}

		$result = mysqli_query($conn, $query);

		if ($result) {
			header('Location: cari-keluhan.php?pesan=feedback-berhasil-dikirim');
		}else{
			header('Location: cari-keluhan.php?pesan=feedback-gagal-dikirim');
		}
	}
}

// Select All Keluhan
function selectAllKeluhan($conn){
	$query = "SELECT * FROM keluhan";

	// Mengembalikan nilai
	return mysqli_query($conn, $query);
}

// Filter Keluhan
function filterKeluhan($conn){
	if (isset($_POST['filter-keluhan'])) {
		$tanggal = $_POST['tanggal'];
		$departemen = $_POST['departemen'];
		$search = $_POST['search'];

		if ($tanggal === null && $departemen === null && $search === null) {
			// Jika semua inputan kosong
			$query = "SELECT * FROM keluhan";
		}else{
			// Jika salah satu atau semua inputan tidak kosong
			$query = "SELECT * FROM keluhan WHERE tanggal LIKE '%$tanggal%' AND departemen LIKE '%$departemen%' AND id_keluhan LIKE '%$search%'";
		}

		// Mengembalikan nilai
		return mysqli_query($conn, $query);
	}
}

// Insert Keluhan
function insertKeluhan($conn){
	if (isset($_POST['kirim-keluhan'])) {
		$idKeluhan = date('dhs').rand(11, 99);
		$departemen = $_POST['departemen'];
		$keluhan = $_POST['keluhan'];
		$status = 'Baru';
		$feedback = 'Belum Ada';

		// Foto
		$file = $_FILES['foto'];

		// Mengambil lokasi awal foto
		$fileTmpName = $file['tmp_name'];

		// Mengambil Ekstensi foto
		$separate = explode('.', $file['name']);
		$ext = strtolower(end($separate));

		// Rename foto
		$foto = date('dhs').rand(11, 99).'.'.$ext;
		
		// Memindahkan foto
		move_uploaded_file($fileTmpName, 'asset/upload/'.$foto);

		// Memasukan data ke database
		$query = "INSERT INTO keluhan(id_keluhan, departemen, keluhan, status, foto, feedback) VALUES('$idKeluhan', '$departemen', '$keluhan', '$status', '$foto', '$feedback')";

		$execute = mysqli_query($conn, $query);

		// Cek apakah berhasil menginsert data
		if ($execute) {
			header("Location: index.php?id_keluhan=$idKeluhan");
		}else{
			header("Location: index.php?pesan=gagal-mengirim-keluhan");
		}
	}
}

// Select All Departemen
function selectAllDepartemen($conn){
	$query = "SELECT * FROM departemen";
	return mysqli_query($conn, $query);
}

// Auto update status
function autoUpdateStatus($conn){
	$query = "SELECT * FROM keluhan";
	$execute = mysqli_query($conn, $query);

	// Looping data
	while ($d = mysqli_fetch_assoc($execute)) {
		$idKeluhan = $d['id_keluhan'];
		$date = $d['tanggal'];

		// Mengambil tanggal sekarang
		$tanggalSekarang = date('d');

		// memisahkan tahun, bulan, dan tanggal. Sekaligus mengambil tanggal
		$tanggal = explode('-', $date)[2];

		// memisahkan tanggal dari waktu
		$tanggal = substr($tanggal, 0, 2);
		
		// Menentukan batas hari untuk perubahan status
		$tanggalProses = $tanggal + 1;
		$tanggalSelesai = $tanggal + 2;
		
		if ($tanggalSekarang == $tanggalProses || $tanggalSekarang > $tanggalProses) {
			$query = "UPDATE keluhan SET status='Proses' WHERE id_keluhan='$idKeluhan'";
		}else if ($tanggalSekarang == $tanggalSelesai || $tanggalSekarang > $tanggalSelesai) {
			$query = "UPDATE keluhan SET status='Proses' WHERE id_keluhan='$idKeluhan'";
		}
		mysqli_query($conn, $query);
	}
}
// Jalankan auto update
autoUpdateStatus($conn);

