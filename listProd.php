<?php

include 'db.php';

$productos = Product::getProducts($mysql);

if (isset($_SESSION['login'])) {
	$currentEmail = $_SESSION['login'];
	$user = $mysql->query("SELECT * FROM users WHERE email = '$currentEmail'");
	$user = $user->fetch_object();
}

include 'includes/header.php';
?>
<div class="container-fluid py-3">
	<div class="row">
		<!-- PRODUCTS -->
		<div class="col-md-12 container">

			<?php if (isset($_SESSION['error'])) { ?>
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<strong class="text-center d-block"><?= $_SESSION['error'] ?></strong>
				</div>
			<?php unset($_SESSION['error']);
			} ?>
			<p class="h1 text-center">Productos</p>
		</div>
		<div class="products">
			<!-- <div class="row"> -->

			<?php $hayProductos = false;
			while ($p = $productos->fetch_object()) { ?>
				<div class="product">

					<h4 class="title text-center"><?= $p->name ?></h4>
					<div class="h6 cat"><?= $p->cat ?></div>
					<img class="imgProd" src="img/<?= $p->urlImg ?>.jpg" alt="<?= $p->name ?>">
					<p class="description my-1 small"><?= $p->descr ?></p>
					<p class="price text-right font-italic">$<?= $p->price ?></p>

					<div class="btn-functions">
						<?php if (isset($user) && $user->isAdmin) { ?>
							<a href="editProd.php?id=<?= $p->id ?>" class="btn btn-info">Editar</a>
							<a href="functions/delete.php?id=<?= $p->id ?>" class="btn btn-danger">Borrar</a>
						<?php } ?>
						<a href="functions/addCarrito.php?id=<?= $p->id ?>" class="btn btn-dark">Agregar al carrito</a>
					</div>

				</div>
			<?php $hayProductos = true;
			} // Close 'while'
			if (!$hayProductos) { ?>
				<div class="alert alert-warning my-5 text-center">No hay productos</div>
			<?php } ?>
			<!-- </div> -->
		</div>
	</div>
</div>

<?php
include 'includes/footer.php';
?>