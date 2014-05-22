<?php
require_once './class/funciones.php';


$updir = realpath(__DIR__ ."/images/productos/tmp/")."/";
$dirLocation = realpath(__DIR__ ."/images/productos/thumb") . "/";


echo getFileExtension($image_es);
$img= ".jpg";
$id = '1400635130';
makeThumbnails($updir, $img, $id, $dirLocation='');