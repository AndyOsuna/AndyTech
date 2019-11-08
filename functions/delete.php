<?php

include '../db.php';

if(isset($_GET['id']))
{
    $id = $_GET['id'];

    $query = "DELETE FROM products WHERE id = $id";
    $mysql->query($query) or $_SESSION['error'] = "No se pudo borrar el producto";
}

header("Location: ../listProd.php");

?>