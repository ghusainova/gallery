<?php
header('Content-Type: image/jpeg');
$imgname = $_GET['img'];
$dir = './img/';
$imgwm = @imagecreatefromjpeg('./watermark.jpg');
$img = @imagecreatefromjpeg($dir.$imgname);
list($w, $h, $type, $attr) = getimagesize($dir.$imgname);
$wwm = $w;
$wmk = $wwm/84;
$hwm = 8*$wmk;
imagecopyresampled($img,$imgwm,0,($h-$hwm)/2,0,0,$wwm,$hwm,84,8);
imagejpeg($img);
?>