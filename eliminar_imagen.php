<?php require_once("class/class.php"); ?>
<?php

$id = (!empty($_REQUEST['id'])) ? $_REQUEST['id'] : 0;

if ($id > 0) {
    $p = !empty($_REQUEST['p']) ? $_REQUEST['p'] : NULL;    
    $instancia->deleteImagePublicacion($id);
    
    header("Location: editar_producto_publicado.php?p=".$p);
} else {
    echo "operacion no valida";
}