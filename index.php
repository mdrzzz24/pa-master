<?php 
	// Call init.php
	require_once 'core/init.php';

	// Call Insert keluhan function
	insertKeluhan($conn);

	// Call list Departemen
	$departemen = selectAllDepartemen($conn);
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Formulir Pengaduan</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="asset/css/bootstrap.min.css">
</head>
<body>

	<!-- Navbar -->
	<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
		<a class="navbar-brand" href="index.php">Web Aplikasi Pengaduan</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbar">
			<div class="navbar-nav">
				<a class="nav-item nav-link" href="cari-keluhan.php">Cari Keluhan</a>
				<a class="nav-item nav-link" href="profile.php">Tentang Kami</a>
			</div>
		</div>
		<a class="navbar-brand ml-auto" href="login.php">
			<img src="">Logo Web
		</a>
	</nav>
	<!-- Akhir Navbar -->

	<?php if (isset($_GET['id_keluhan'])): ?>
	<!-- Box -->
	<div class="container border p-2 mt-5">
		<span class="d-block text-primary">Keluhan berhasil dikirim!</span>
		<span class="text-danger">ID Keluhan Anda : <?= $_GET['id_keluhan']; ?></span>
	</div>
	<!-- Akhir Box -->
	<?php endif ?>


	<!-- Formulir Keluhan -->
	<div class="container border p-4 mt-2">
		<form method="post" enctype="multipart/form-data">
			<div class="form-group">
				<label>Departemen</label>
				<select class="custom-select" name="departemen">
					<option value="">Departemen</option>
					<?php 
						while ($d = mysqli_fetch_assoc($departemen)) {
							echo("
								<option value='".$d['departemen']."'>".$d['departemen']."</option>
							");
						}
					 ?>
				</select>
			</div>
			<div class="form-group">
				<label>Keluhan</label>
				<textarea class="form-control" rows="5" name="keluhan"></textarea>
			</div>
			<div class="form-group">
				<label>Foto</label>
				<input class="d-block" type="file" name="foto">
			</div>
			<button type="submit" name="kirim-keluhan" class="btn btn-primary mt-3">Kirim</button>
		</form>
	</div>
	<!-- Akhir Formulir Keluhan -->

<script src="asset/js/bootstrap.min.js"></script>
</body>
</html>