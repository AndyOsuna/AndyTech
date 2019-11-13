<?php

include '../db.php';

if (isset($_POST['submit-product'])) {
    $nameProd = $_POST['name'];
    $price    = $_POST['price'];
    $descr    = $_POST['descr'];
    $cat      = $_POST['cat'];
    $url      = $_POST['urlImg'];

    $prod = new Product($nameProd, $price, $descr, $cat, $url);
    $prod->saveProd($mysql);
}

header("Location: ../addProd.php");
