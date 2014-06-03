<?php 
require_once("class/class.php");

if (is_array($_POST) && isset($_POST['email'])) {
    
    $response = $instancia->validarEmail($_POST['email']);
    if($response == 0) {
        echo "0";
    } else {
      echo 1;	
    }
}

