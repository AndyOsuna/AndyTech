<?php
include './db.php';
include './includes/header.php';

$productos = Product::getProducts($mysql);

?>

<div class="jumbotron bg-white">
	<h1 class="display-3 my-5">Bievenido!</h1>
</div>

<?php
include './includes/footer.php';
?>