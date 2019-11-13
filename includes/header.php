<?php
if (isset($_SESSION['login'])) {
	$currentEmail = $_SESSION['login'];
	$user = $mysql->query("SELECT * FROM users WHERE email = '$currentEmail'");
	$user = $user->fetch_object();
}

$cart = 0;
if (isset($_SESSION['carrito'])) {
	for ($i = 0; $i < count($_SESSION['carrito']); $i++) {
		for ($j = 0; $j < $_SESSION['carrito'][$i]["cant"]; $j++) {
			$cart++;
		}
	}
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<script src="https://kit.fontawesome.com/f19754c787.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="css/bootswatch-sandstone.min.css">
	<link rel="stylesheet" href="css/styles.css">
	<title>AndyTech</title>
</head>

<body style="padding-top: 60px;">

	<nav class="navbar navbar-expand-md navbar-light bg-light fixed-top">
		<a href="index.php" class="navbar-brand">AndyTech</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-content="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="collapsibleNavId">
			<div class="navbar-nav">
				<div class="nav-item">
					<a href="listProd.php" class="nav-link">Productos</a>
				</div>
				<div class="nav-item">
					<a href="listProdCat.php" class="nav-link">Por categoría</a>
				</div>

				<?php if (isset($user) && $user->isAdmin) { ?>
					<div class="nav-item">
						<a href="addProd.php" class="nav-link">Añadir productos</a>
					</div>
					<div class="nav-item">
						<a href="addCat.php" class="nav-link">Añadir categoría</a>
					</div>
				<?php } ?>

			</div>
			<div class="ml-auto d-flex justify-content-between align-items-center">
				<a href="carrito.php" class="btn btn-outline-dark mr-3 carrito" id="carrito">
					<!-- <i class="fas fa-shopping-cart"></i> -->
					Carrito:
					<?= $cart ?>
				</a>
				<?php if (!isset($_SESSION['login'])) { ?>
					<a href="login.php" class="btn btn-success">Login</a>
				<?php } else {
					if (isset($_SESSION['username'])) ?> <p class="m-0 pr-3">Bienvenido <?= $_SESSION['username'] ?>!</p><? php; ?>
					<a href="closeSess.php" class="btn btn-warning">Cerrar sesión</a>
				<?php } ?>
			</div>
		</div>
	</nav>