<?php
session_start();



/*INSERT NEW --------  Funtion numeros aleatorios*/
function generateString ($length = 8){
  $string = "";
  $possible = "0123456789bcdfghjkmnpqrstvwxyz";
  $i = 0;
  while ($i < $length) {
    $char = substr($possible, mt_rand(0, strlen($possible)-1), 1);
    $string .= $char;
    $i++;
  }
  return $string;
}
$numero=generateString("10"); //Desde la posicion 0 hasta la 35 de $todos 
/*INSERT NEW --------  Funtion numeros aleatorios*/






$uploaddir = '../images/productos/'; 







/*INSERT NEW --------  Funtion numeros aleatorios*/
$trozos = explode(".", $_FILES['uploadfile']['name']); 
$extension = end($trozos); 	
/*INSERT NEW --------  Funtion numeros aleatorios*/





$name=basename("completado_"."$numero"."."."$extension");
$file = $uploaddir . $name; 
$size=$_FILES['uploadfile']['size'];
if($size>26214400)//1048576
{
	//echo "error file size > 25 MB";
	unlink($_FILES['uploadfile']['tmp_name']);
	echo"1";
	exit;
}

if (move_uploaded_file($_FILES['uploadfile']['tmp_name'], $file)) { 
  	
  echo $name; 
} else {
	echo"2";
	//echo "error ".$_FILES['uploadfile']['error']." --- ".$_FILES['uploadfile']['tmp_name']." %%% ".$file."($size)";
}

?>