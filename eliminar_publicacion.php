<?php require_once("class/class.php"); ?>
<?php

$id = (!empty($_REQUEST['p'])) ? $_REQUEST['p'] : 0;

if ($id > 0) {  
    $instancia->deletePublicacion($id);
    
    header("Location: admin_user.php");
} else {
    echo "operacion no valida";
}