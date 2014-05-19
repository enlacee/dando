<?php

//*SISTEMA DE SEGURIDAD BLOQUEAR ATAQUES SQL*****************************************************************
//echo Seguridad("valor''''","text");

function Seguridad($valor,$type){
	
	switch($type){
		
		case "text":
			$valor = addslashes($valor);
			break;
			
		case "textarea":
			$valor = addslashes($valor);
			$valor = htmlentities($valor, ENT_COMPAT, 'UTF-8');
			break;
		
		case "number":
			$valor = intval($valor);
			break;
			
		case "double":
			$valor = doubleval($valor);
			break;
	}
	
	return $valor;
}
//*SISTEMA DE SEGURIDAD BLOQUEAR ATAQUES SQL*****************************************************************

?>