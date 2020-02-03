<?php 
	// Call init.php
	require_once 'core/init.php';

	// Call Cari Keluhan function
	$cariKeluhan = cariKeluhan($conn);

	// Call feedback function
	feedback($conn);

 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Cari keluhan</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="asset/css/bootstrap.min.css">
</head>
<body>

	<!-- Navbar -->
	<nav class="navbar navbar-dark bg-primary">
		<a class="navbar-brand" href="index.php">Web Aplikasi Pengaduan</a>
	</nav>
	<!-- Akhir Navbar -->

	<!-- Formulir Login -->
	<div class="container border p-4 mt-5">
		<form class="form-inline" method="post">
			<div class="form-group">
				<input class="form-control" type="text" name="id-keluhan" placeholder="Cari Keluhan" required>
			</div>
			<div class="form-group">
				<button type="submit" name="search-keluhan" class="btn btn-primary ml-5">Cari</button>
			</div>
		</form>
	</div>
	<!-- Akhir Formulir Login -->

	<!-- Card Keluhan -->
	<div class="container my-5">
		<?php 
			if (mysqli_num_rows($cariKeluhan) > 0) {
				while ($d = mysqli_fetch_assoc($cariKeluhan)) {
					echo("
						<div class='card border-primary my-3'>
							<div class='card-body'>
								<h5 class='card-title text-primary'>".$d['id_keluhan']."</h5>
								<h6 class='card-subtitle mb-2 text-muted'>Departemen : ".$d['departemen']."</h6>
								<h6 class='card-subtitle mb-2 text-muted'>Tanggal : ".$d['tanggal']."</h6>
								<h6 class='card-subtitle mb-2 text-muted'>Status : ".$d['status']."</h6>
								<hr>
								<h6 class='card-subtitle mb-2 text-muted'>Isi Keluhan : </h6>
								<p class='card-text'>".$d['keluhan']."</p>
								<hr>
								<h6 class='card-subtitle mb-2 text-muted'>Foto : </h6>
								<img src='asset/upload/".$d['foto']."' width='400'>
								<hr>
								<h6 class='card-subtitle mb-2 text-muted'>Feedback : ".$d['feedback']."</h6>
								<a href='cari-keluhan.php?id_keluhan=".$d['id_keluhan']."&feedback=1'>&#128077;</a>
								<a href='cari-keluhan.php?id_keluhan=".$d['id_keluhan']."&feedback=0'>&#128078;</a>
							</div>
						</div>
					");			
				}
			}else{
				echo("
					<div class='card border-primary my-3'>
						<div class='card-body'>
							<h5 class='card-title text-center text-primary'>Tidak ada Keluhan yang sesuai</h5>
						</div>
					</div>
				");	
			} 
		?>
		

				
	</div>
	<!-- Akhir Card Keluhan -->

<script src="asset/js/bootstrap.min.js"></script>
</body>
</html>