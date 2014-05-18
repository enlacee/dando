<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Validar Username</title>
<script type="text/javascript" src="../jquery-validation/lib/jquery-1.9.0.js"></script>
<script type="text/javascript">    
 function validar_usuario(){
		
		$("#mensaje").html("<img src='images/iconos/load.gif' alt='loading' />");
		var url_fichero="validar.php"; //Cambiar
		$.ajax({
			url:url_fichero, //Cambiar
			data:{"validar":"si","email":$("#email").val()}, //Cambiar
			contentType:"application/x-www-form-urlencoded",
			dataType:"html",//xml,html,script,json
			error:function(){
				alert("ha ocurrido un error");
			},
			ifModified:false,
			processData:true,
			success:function(respuesta){
				
				if(respuesta=="0"){
					$("#mensaje").html("<img src='images/iconos/si.png' alt='loading' />");// antes $("#mensaje").html("Disponible");
					$("input#enviar").attr('type','submit');
				}else{
					if(respuesta=="1"){
						  $("#mensaje").html("<img src='images/iconos/no.png' alt='loading' />");
						  $("#enviar").attr('type','button');
					}
				}					
			},
			type:"POST"
			
			
		});   
	
 }
   
</script> 
</head>

<body style="color:">
<form id="form1" name="form1" method="post" action="">
  <label for="email">Email:</label>
  <input type="text" name="email" id="email" autocomplete="off" onkeyup="javascript:validar_usuario()" /><span id="mensaje"></span>
  <p><input name="enviar" type="submit" id="enviar" value="Enviar" /></p>
</form>


</body>
</html>