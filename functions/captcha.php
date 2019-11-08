<?php
session_start();

$imagen = imagecreate(90, 50);

$fondo = imagecolorallocate($imagen, 170, 170, 170);
$textC = imagecolorallocate($imagen, 0, 0, 0);

$_SESSION['captcha'] = $aleatorio = rand(1000000,9999999);

imagefill($imagen, 50, 0, $fondo);

imagestring($imagen, 5, 20, 5, $aleatorio, $textC);

header("content-type: image/png");
imagepng($imagen);

?>