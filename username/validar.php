<?php

$conexion = mysqli_connect("localhost","root","","dando-dando");

$sql = "SELECT * FROM usuarios WHERE email='".$_POST["email"]."'";
$sqlQuery = mysqli_query($conexion,$sql);

if(mysqli_num_rows($sqlQuery) == 0){
	echo "0";
}else{
	echo 1;	
}


?>