<?php require_once("class/class.php"); ?>
<?php

if(isset($_SESSION["email"])){
	header("Location:index.php");
}

if(array_key_exists("registro", $_POST)){

    $_POST['pais'] = utf8_decode($_POST['pais']);
    
    //echo "<pre>";  print_r($_POST); exit;
    $registro_usuario = $instancia->setRegistroUsuarios("registrado",Apps::acentos($_POST["nombres"]),Apps::acentos("username"),$_POST["email"],$_POST["tlfcelular"],$_POST["tlfcasa"],md5($_POST["clave"]),Apps::acentos($_POST["empresa"]),Apps::acentos($_POST["direccion"]),Apps::acentos($_POST["ciudad"]),$_POST["pais"],date("d/m/Y"),date("h:m:i"),Apps::acentos("username").rand("0000","9999"),$estadousuario="1",$_SERVER['REMOTE_ADDR']);


}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<!--<meta charset="utf-8">-->
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title>&Aacute;rea de regitro de usuarios</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<?php include("head.php"); ?>
<script type="text/javascript">    
 function validar_usuario(){
		
		$("#mensaje").html("<img src='images/iconos/load.gif' alt='loading' />");
		var url_fichero="class/validar.php"; //Cambiar
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
					$("#registro").attr('type','submit');
				}else{
					if(respuesta=="1"){
						  $("#mensaje").html("<img src='images/iconos/no.png' alt='loading' />");
						  $("#registro").attr('type','button');
					}
				}					
			},
			type:"POST"
			
			
		});   
	
 }
   
</script> 

</head>
<body>
<!-- Header Start -->
<header>
<?php include("cabecera.php"); ?>
</header>
<!-- Header End -->

<div id="maincontainer">
  <div class="container">
    <div class="row">
      <div class="span9">
          <h1 class="heading1"><span class="maintext">Registro de USUARIO</span></h1>
          
          <div id="mensajes" style="display:none; margin:10px 0;"></div>
          
          <form class="form-horizontal" id="form" name="form" method="post" action="">
            <h3 class="heading3">Informaci&oacute;n Personal</h3>
            
            
            <div class="registerbox">
              <fieldset>
                <div class="control-group">
                  <label class="control-label"><span class="red">*</span> Nombres:</label>
                  <div class="controls">
                    <input name="nombres" type="text"  class="input-xlarge" id="nombres" placeholder="Ingrese su nombre">
                  </div>
                </div>
                
                
                
                
                
                
                
                
                
                <?php /*?><div class="control-group">
                  <label class="control-label"><span class="red">*</span> Usuario:</label>
                  <div class="controls">
                    <input name="username" type="text" class="input-xlarge minuscula" id="username" placeholder="Ejemplo: vanesa001">
                  </div>
                </div><?php */?>
                
                
                
                
                
                
                
                
                
                
                <div class="control-group">
                  <label class="control-label"><span class="red">*</span> Email:</label>
                  <div class="controls">
                    <input name="email" type="text" autocomplete="off" class="input-xlarge" id="email" placeholder="Ingrese su email" onKeyUp="javascript:validar_usuario();">
                    <span id="mensaje"></span>
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label"><span class="red">*</span> TLF Celular:</label>
                  <div class="controls">
                    <input name="tlfcelular" type="text"  class="input-xlarge" id="tlfcelular" placeholder="Ingrese su número de celular">
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label"> TLF Casa/Oficina:</label>
                  <div class="controls">
                      <input  type="text" name="tlfcasa" id="tlfcasa" placeholder="Ingrese su numero de casa/oficina" 
                              autocomplete="off" value="">
                  </div>
                </div>
              </fieldset>
            </div>
            
            
            
            
            
<h3 class="heading3">Opciones de seguridad</h3>
<div class="registerbox">
  <fieldset>
    <div class="control-group">
      <label  class="control-label"><span class="red">*</span> Contrase&ntilde;a:</label>
      <div class="controls">
        <input name="clave" type="password"  class="input-xlarge" id="clave" placeholder="Ingrese su contraseña"
               autocomplete="off" value="">
      </div>
    </div>
    <div class="control-group">
      <label  class="control-label"><span class="red">*</span>  Repetir Contrase&ntilde;a:</label>
      <div class="controls">
        <input name="clave1" type="password"  class="input-xlarge" id="clave1" placeholder="Coloque nuevamente su contraseña">
      </div>
    </div>
  </fieldset>
</div>
            
            
            
            
            
            
            
            
            <h3 class="heading3">Tu Direcci&oacute;n</h3>
            <div class="registerbox">
              <fieldset>
                <div class="control-group">
                  <label class="control-label"> Empresa:</label>
                  <div class="controls">
                    <input name="empresa" type="text"  class="input-xlarge" id="empresa" placeholder="Ingrese su empresa o trabajo">
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label"><span class="red">*</span> Direcci&oacute;n:</label>
                  <div class="controls">
                    <input name="direccion" type="text"  class="input-xlarge" id="direccion" placeholder="Ingrese su lugar de residencia">
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">
                  <span class="red">*</span> Ciudad:</label>
                  <div class="controls">
                    <input name="ciudad" type="text"  class="input-xlarge" id="ciudad" placeholder="Ingrese la ciudad donde vive">
                  </div>
                </div>
                <div class="control-group">
                  <label for="select01" class="control-label">
                  <span class="red">*</span> Pa&iacute;s:</label>
                  <div class="controls">
                    <select name="pais" class="span3" id="pais">
                      <option value="">Seleccione su pais</option>
                      <option value="Argentina"> Argentina</option>
                      <option value="Aruba"> Aruba</option>
                      <option value="Chile"> Chile</option>
                      <option value="Colombia"> Colombia</option>
                      <option value="Costa Rica"> Costa Rica</option>
                      <option value="Cuba"> Cuba</option>
                      <option value="Ecuador"> Ecuador</option>
                      <option value="El Salvador"> El Salvador</option>
                      <option value="España"> España</option>
                      <option value="Nicaragua"> Nicaragua</option>
                      <option value="Panama"> Panama</option>
                      <option value="Paraguay"> Paraguay</option>
                      <option value="Perú"> Perú</option>
                      <option value="República Dominicana"> República Dominicana</option>
                      <option value="Uruguay"> Uruguay</option>
                      <option value="Venezuela"> Venezuela</option>
                    </select>
                  </div>
                </div>
              </fieldset>
            </div>
            

		<div class="form-actions">
		  <input type="submit" name="registro" class="btn btn-primary" id="registro" value="Registrar">
          <input type="reset" name="restablecer" class="btn" id="restablecer" value="Restablecer">
		</div>

          </form>
          <div class="clearfix"></div>
          <br>
        </div>
        
        
        
        
      <aside class="span3"> 
			<?php include("left.php"); ?>
      </aside>
      
      
      
      
    </div>
  </div>
</div>
<div class="clearfix"></div>
<!-- /maincontainer --> 


<!--Footer-->
<?php include("footer.php"); ?>
<!--Footer-->

<?php
	if($_GET["error"]){
?>
	<div id="dialog" title="Error al registrar usuario">
		<p><br />Este email<strong> <?php echo $_GET["error"]; ?></strong> ya se encuetra registrado en nuestro sistema!</p>
		<p>Si cree que se trata de un error por favor reportelo a: contacto@dando-dando-com</p>
		<p><i>Muchas Gracias.</i></p>
	</div>
<?php
}
?>

<script type="text/javascript">
//Validar campos
$(function(){	
	
//Detecta Nombre URL
function getID(url) {
	
	var Marcador = url.lastIndexOf("=");
	if(Marcador>0 && url.length-1!=Marcador) {
		
		return url.substring(Marcador+1);
	}
}

	
//Obtiene el ID
if (getID(window.location.href)) {
	 
	 //Si el usuario no es valido
	 if(getID(window.location.href) == 1){
		setTimeout(function () {
			$("#mensajes").slideUp("slow");
		}, 20000);
		$("#mensajes").html('<p class="alert-success" style="font-size: 14px !important;">Registro completado!!! Desde ahora mismo puedes entrar a tu cuenta. <a href="acceso.php">Haz Clic Aqui</a> para entrar.</p>')
		$("#mensajes").slideDown(600);
		$("#mensajes").css("display", "block");	 
	}
}
	
	
	
});//Closed
</script>

<script type="text/javascript">

debug: true,


$(function(){
		$('#form').validate({
			rules: {
				'nombres': 'required',
				'username': {
					required: true,
					minlength: 5,
				},
				email: {
					required: true,
					email: true
				},
				tlfcelular: {
						required:true,
						number:true,
						minlength:7,
						maxlength:20
					},
				clave: {
					required: true,
					minlength: 5
				},
				clave1: {
					required: true,
					minlength: 5,
					equalTo: "#clave"
				},
				'direccion':'required',
				'ciudad':'required',
				pais:{
					required: true	
				}
			
			},
			messages: {
				'nombres': 'Obligatorio!',
				'username':{
					required: "Obligatorio!",
					minlength: "Mínimo 5 caracteres."
				},
				email: {
					required: "Obligatorio!",
					email: "Ingrese una dirección de email válida.",	
				},
				tlfcelular: {
					required: "Obligatorio!",
					number: "Solo números.",
					minlength: "Mínimo 7 Caracteres.",
					maxlength: "Maxímo 20 Caracteres."
				},
				clave: {
				required: "Obligatorio!",
				minlength: "Tu contraseña debe contener mínimo 5 carácteres."
				},
				clave1: {
					required: "Obligatorio!",
					minlength: "Tu contraseña debe contener mínimo 5 carácteres.",
					equalTo: "Las claves no son iguales."
				},
				'direccion': 'Obligatorio!',
				'ciudad': 'Obligatorio!',
				pais: 'Obligatorio!'
			},
			
	
		});
	});
</script>




</body>
</html>