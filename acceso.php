<?php require_once("class/class.php"); ?>
<?php
require_once("class/enc/encriptar.php");
$encriptar = new Encryption();
 

$registro = new Apps();


if(array_key_exists("entrar",$_POST)){

	$acceso_usuario = $instancia->accesoUsuario($_POST["email"],md5($_POST["clave"]));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Área de acceso de usuarios</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<?php include("head.php"); ?>

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
          <h1 class="heading1"><span class="maintext">&Aacute;rea de Acceso y Registro</span></h1>
          
          
          <section class="newcustomer">
				<h2 class="heading2 arrow_box">Usuario Registrado!</h2>
            <div class="loginbox">
              <h4 class="heading4">Ingrese sus datos para entrar a su cuenta</h4>
              
              <div id="mensajes" style="display:none; margin:10px 0;"></div>
              
              <form class="form-vertical" id="form" name="form" method="post" action="">
                <fieldset>
                  <div class="control-group">
                    <label class="control-label">Email:</label>
                    <div class="controls">
                      <input name="email" type="text" class="{required:true} span3" id="email" placeholder="Ingrese su email">
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label">Contrase&ntilde;a:</label>
                    <div class="controls">
                      <input name="clave" type="password" class="{required:true} span3" id="clave" placeholder="Ingrese su contraseña">
                    </div>
                  </div>
                  <p>
                  	<a href="resetear-clave.php" class="">¿Olvidaste tu clave?</a>
                  </p>
  					<input name="entrar" id="entrar" class="btn btn-primary" type="submit" value="Entrar Ahora">
                </fieldset>
              </form>
            </div>
          </section>
          
          
          
          
          
          
          <section class="returncustomer">
          	 <h2 class="heading2 arrow_box">Nuevo Usuario</h2>
            <div class="loginbox">
           
              <h4 class="heading4"> Si no te has registrado que esperas?</h4>
              
              
              
              <p>Reg&iacute;strate y forma parte de nuestra comunidad.</p>
              
              <p>Disfruta de todos los beneficios que tenemos para ti.</p>
              <br>
              <p>Para registrate has <a href="registro.php">Clic Aqui!</a>o  en el siguiente bot&oacute;n.</p>
              <br>
            
              <a class="btn btn-danger" href="registro.php">Registrame Ahora!</a>
            </div>
          
          
            
          </section>
          
          
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





<script type="text/javascript">
//Validar campos
$(function(){

	$('#form').validate({
		//Detecta cuando se realiza el submit o se presiona el boton
		submitHandler: function(){
			
			$("#entrar").attr("type","button");
			$( "#form" ).submit();
			return false;
		},
		
		//Detecta los error y abre los span con los posibles errores
		errorPlacement: function(error, element){
		error.insertAfter(element);
		}
	});
	
	
	
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
	 if(getID(window.location.href) == 0){
		setTimeout(function () {
			$("#mensajes").slideUp("slow");
		}, 6000);
		$("#mensajes").html('<p class="alert-danger">La información que ha colocado es incorrecta.</p>')
		$("#mensajes").slideDown(600);
		$("#mensajes").css("display", "block");	 
	}
	
	//Si la clave no es valida
	if(getID(window.location.href) == 1){
		setTimeout(function () {
			$("#mensajes").slideUp("slow");
		}, 6000);
		$("#mensajes").html('<p class="alert-danger">La contraseña ingresada es incorrecta.</p>')
		$("#mensajes").slideDown(600);
		$("#mensajes").css("display", "block");	 
	}
	
	
	//Si la clave no es valida
	if(getID(window.location.href) == 2){
		setTimeout(function () {
			$("#mensajes").slideUp("slow");
		}, 6000);
		$("#mensajes").html('<p class="alert-danger">El email no existe en nuetra base de datos.</p>')
		$("#mensajes").slideDown(600);
		$("#mensajes").css("display", "block");	 
	}
}
	
	
	
});//Closed
</script>


</body>
</html>