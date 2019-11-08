<?php
include '../db.php';

if ($_GET['id']) {
  $id = $_GET['id'];
  $id = [
    "id" => $id,
    "cant" => 1
  ];
  $repeat = true;
  for ($i = 0; $i < count($_SESSION['carrito']); $i++) {
    if ($id["id"] == $_SESSION['carrito'][$i]["id"]) {
      $_SESSION['carrito'][$i]["cant"]++;
      $repeat = false;
    }
  }
  if($repeat) array_push($_SESSION['carrito'], $id);
} else {
  $_SESSION['error'] = "Hubo un error al intentar guardar el producto en el carrito";
}
header("location: ../listProd.php");
