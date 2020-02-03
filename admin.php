<?php 
	
	// Call init.php
	require_once 'core/init.php';

	// Call Logout function
	logout();

	// Call list Departemen
	$departemen = selectAllDepartemen($conn);

	// Call Select All Keluhan function
	$keluhan = selectAllKeluhan($conn);

	// Call Filter Function
	$filter = filterKeluhan($conn);

 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Dashboard Admin</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="asset/css/bootstrap.min.css">
</head>
<body>

	<!-- Navbar -->
	<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
		<a class="navbar-brand" href="admin.php">Admin</a>
		<a class="navbar-brand ml-auto" href="admin.php?logout=1">Logout</a>
	</nav>
	<!-- Akhir Navbar -->

	<!-- Menu Filter -->
	<div class="container p-3 mt-5 border">
		<form class="form-inline" method="post">
			<div class="form-group mx-1">
				<input class="form-control" type="date" name="tanggal">
			</div>
			<div class="form-group mx-1">
				<select class="form-control" name="departemen">
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
			<div class="form-group mx-1">
				<input class="form-control" type="text" name="search" placeholder="ID Keluhan">
			</div>
			<div class="form-group">
				<button type="submit" name="filter-keluhan" class="btn btn-primary ml-5">Filter</button>
			</div>
		</form>
	</div>
	<!-- Akhir Menu Filter -->

	<!-- Tabel -->
	<div class="container-fluid p-1 my-5 table-responsive">
		<table class="table" style="font-size: 14px;">
			<thead class="thead-dark">
				<tr>
					<th>ID Keluhan</th>
					<th>Kategori</th>
					<th>Keluhan</th>
					<th>Tanggal</th>
					<th>Status</th>
					<th>Foto</th>
					<th>Feedback</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					if ($filter == 0) {
						if (mysqli_num_rows($keluhan) > 0) {
							while ($d = mysqli_fetch_assoc($keluhan)) {
								echo("
									<tr>
										<td>".$d['id_keluhan']."</td>
										<td>".$d['departemen']."</td>
										<td>".$d['keluhan']."</td>
										<td>".$d['tanggal']."</td>
										<td>".$d['status']."</td>
										<td><img src='asset/upload/".$d['foto']."' width='200'></td>
										<td>".$d['feedback']."</td>
									</tr>
								");
							}
						}else{
							echo("
								<tr>
								 	<td colspan='7' class='text-center'>Data tidak ada</td>
								 </tr>
							");
						}
					}else{
						if (mysqli_num_rows($filter) > 0) {
							while ($d = mysqli_fetch_assoc($filter)) {
								echo("
									<tr>
										<td>".$d['id_keluhan']."</td>
										<td>".$d['departemen']."</td>
										<td>".$d['keluhan']."</td>
										<td>".$d['tanggal']."</td>
										<td>".$d['status']."</td>
										<td><img src='asset/upload/".$d['foto']."' width='200'></td>
										<td>".$d['feedback']."</td>
									</tr>
								");
							}
						}else{
							echo("
								<tr>
								 	<td colspan='7' class='text-center'>Data tidak ada</td>
								 </tr>
							");
						}
					}
				 ?>				
				
			</tbody>
		</table>
	</div>
	<!-- Akhir Tabel -->

<script src="asset/js/bootstrap.min.js"></script>
</body>
</html>