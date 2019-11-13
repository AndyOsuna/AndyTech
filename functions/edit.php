<?php

include '../db.php';

if(isset($_POST['id']) && isset($_POST['nomProd']))
{
	$id          = $_POST['id'];
	$nameProd    = $_POST['nomProd'];
	$price       = $_POST['price'];
	$description = $_POST['description'];
	$cat         = $_POST['cat'];
	$url         = $_POST['urlImg'];

	// print($id." ".$nameProd." ".$price." ".$description);
	
	$update = "UPDATE `products` SET `name` = '$nameProd', `price` = $price, `descr` = '$description', `cat` = '$cat', `urlImg` = '$url' WHERE id = $id";
	$mysql->query($update) or $_SESSION['error'] = "No se pudo editar el producto";
}
header("Location: ../listProd.php");

?>
