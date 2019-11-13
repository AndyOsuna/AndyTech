<?php

session_start();

/* Se crea la varible de sesión 'carrito' si no existe. Si existe, no se altera */
if (!isset($_SESSION['carrito'])) $_SESSION['carrito'] = [];

/* Se crea objeto global para conexión con la Base de Datos */
$mysql = new mysqli("localhost", "root", "", "osuna");
if ($mysql->connect_error) $_SESSION['error'] = "Hubo un error al intentar conectarse a la base de datos";

/* Clase para productos */
class Product extends mysqli
{
  function __construct($name, $price, $descr, $cat, $urlImg)
  {
    $this->name   = $name;
    $this->price  = $price;
    $this->descr  = $descr;
    $this->cat    = $cat;
    $this->urlImg = $urlImg;
  }

  /* Guardar al producto */
  public function saveProd($mysql)
  {
    $query = "INSERT INTO products (`name`, `price`, `descr`, `cat`, `urlImg`) VALUES ('$this->name', $this->price, '$this->descr', '$this->cat', '$this->urlImg')";
    echo $query;
    
    $mysql->query($query);
    if ($mysql->error) $_SESSION['error'] = "No se pudo guardar el producto";
    else $_SESSION['prodAdded'] = "Producto guardado correctamente";
  }
  /* Obtener todos los productos */
  public static function getProducts($mysql)
  {
    return $mysql->query("SELECT * FROM `products`");
  }
}