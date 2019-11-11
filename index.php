<?php
include './db.php';
include './includes/header.php';

$productos = Product::getProducts($mysql);
$categorias = $mysql->query("SELECT * FROM `cats`");

?>
<div class="bg-index">
	
	<div class="jumbotron bg-light">
		<h1 class="display-3 my-5">Bievenido!</h1>
	</div>

</div>
<!-- <div class="h1 mx-0 mb-4 text-center bg-primary text-white py-5 rounded-0">Categorías</div>
<div class="container-fluid">
	<div class="row text-center">
		<?php $i = 1;
		while ($cat = $categorias->fetch_object()) { ?>
			<div class="col-md-3 py-5">
				<p class="lead">
					<?= $cat->name ?>
				</p>
			</div>
		<?php $i++;
		} ?>
	</div>
</div> -->


<?php
include './includes/footer.php';
?>