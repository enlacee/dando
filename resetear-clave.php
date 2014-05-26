<?php require_once("class/class.php"); ?>
<?php

if(array_key_exists("resetear",$_POST)){
	
	$instancia->hasSendResetearClave($_POST["email"]);
}

if(isset($_GET["reset"]) && isset($_GET["emailclavegenerada"])) {
	
	$instancia->updateUserResetPass($_GET["emailclavegenerada"],$_GET["reset"]);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Sistema de recuperaci&oacute;n de contrase&ntilde;a</title>
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
          <h1 class="heading1"><span class="maintext">Recuperaci&oacute;n de Contrase&ntilde;a</span></h1>
          
          <div id="mensajes" style="display:none"></div>
          
          <section>
            <div class="loginbox">
              <h4 class="heading4">Ingrese el correo que utiliz&oacute; al registrarse</h4>
              
              <div id="mensajes" style="display:none; margin:10px 0;"></div>
              
              <form class="form-vertical" id="form" name="form" method="post" action="">
                <fieldset>
                  <div class="control-group">
                    <label class="control-label">Email:</label>
                    <div class="controls">
                      <input name="email" type="text" class="{required:true} span3" id="email" placeholder="Ingrese su email">
                    </div>
                  </div>
  					<input name="resetear" id="resetear" class="btn btn-primary" type="submit" value="Enviar">
                </fieldset>
              </form>
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
		$("#mensajes").html('<p class="alert-danger">El correo ingresado no existe en nuestra base de datos.</p>')
		$("#mensajes").slideDown(600);
		$("#mensajes").css("display", "block");	 
	}
	
	//Si la clave no es valida
	if(getID(window.location.href) == 1){
		setTimeout(function () {
			$("#mensajes").slideUp("slow");
		}, 60000);
		$("#mensajes").html('<p class="alert-info">Su solicitud se realizó correctamente! Revice su correo, le hemos enviado todos los pasos a seguir para recuperar su contraseña.</p>')
		$("#mensajes").slideDown(600);
		$("#mensajes").css("display", "block");	 
	}
	
	
	//Si la clave no es valida
	if(getID(window.location.href) == 2){
		setTimeout(function () {
			$("#mensajes").slideUp("slow");
		}, 60000);
		$("#mensajes").html('<p class="alert-success">Su clave se reseteo correctamente, revise su correo le hemos enviado su nueva contraseña.</p>')
		$("#mensajes").slideDown(600);
		$("#mensajes").css("display", "block");	 
	}
}
	
	
	
});//Closed
</script>


</body>
</html>