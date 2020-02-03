<?php 
	// Call init.php
	require_once 'core/init.php';

	// Call Login function
	login($conn);
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Login Admin</title>
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
		<form method="post">
			<div class="form-group">
				<label>Username</label>
				<input class="form-control" type="text" name="username" required>
			</div>
			<div class="form-group">
				<label>Password</label>
				<input class="form-control" type="password" name="password" required>
			</div>
			<button type="submit" name="login" class="btn btn-primary mt-3">Login</button>
		</form>
	</div>
	<!-- Akhir Formulir Login -->

<script src="asset/js/bootstrap.min.js"></script>
</body>
</html>