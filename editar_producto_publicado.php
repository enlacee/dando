<?php require_once("class/class.php"); 

$categorias = $instancia->getCategorias();

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Dando y Dando - Sistema de Trueque</title>
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
      	

        <section id="featured" class="row mt40">
          <h1 class="heading1 mt0"><span class="maintext">Titulo del producto publicado</span></h1>
        </section>
        
        <?php // Condicion Acceso
		if(isset($_SESSION["email"])){
		?>
				  <h1 class="heading1"><span class="maintext">&Aacute;rea de Publicaci&oacute;n</span></h1>
				  <form class="form-horizontal" id="form" name="form" method="post" action="">
					<div class="registerbox">
					  <fieldset>
						<div class="control-group">
						  <label class="control-label"><span class="red">*</span> Categor&iacute;a:</label>
						  <div class="controls">
							<select name="categoriaID" class="span5" id="categoriaID">
							  <option value=""> Seleccione la categor&iacute;a</option>
							  <?php
								for($i=0;$i<sizeof($categorias);$i++){
							  ?>
							  <option value="<?php echo $categorias[$i]["categoriaID"]; ?>"><?php echo $categorias[$i]["categoria"]; ?></option>
							  <?php
								}
							  ?>
							</select>
						  </div>
						</div>
						<div class="control-group">
						  <label class="control-label"><span class="red">*</span> T&iacute;tulo:</label>
						  <div class="controls">
							<input name="titulo" type="text" class="span5" id="titulo" placeholder="Ingrese el título de su producto">
						  </div>
						</div>
		
					  
						<div class="control-group">
						  <label class="control-label"><span class="red">*</span> Foto:</label>
						  <div class="controls perso">
							 <input name="foto" type="text" class="span3" id="foto" readonly />
							 <a href="javascript:void(0);" class="btn perso" title="Subir Imagen" onclick="javascript:$('#modal').dialog('open'); " >Subir Clic Aqui</a>
						  </div>
		
						</div>
						
						
						<div class="control-group">
						  <label class="control-label"><span class="red">*</span> Video:</label>
						  <div class="controls perso">
							 <textarea name="video" id="video" class="span5" placeholder="Ingrese la url del video a compartir"></textarea>
						  </div>
		
						</div>
					  
						<div class="control-group">
						  <label class="control-label"><span class="red">*</span> Producto:</label>
						  <div class="controls">
							<p class="radioFloat">
								<input type="radio" name="productoestado" value="nuevo">Nuevo
								<input type="radio" name="productoestado" value="usado">Usado
							</p>
						  </div>
						</div>
						<div class="control-group">
						  <label class="control-label"><span class="red">*</span> Costo Estimado:</label>
						  <div class="controls">
							<input name="precio" type="text"  class="span5" id="precio" placeholder="Ingrese el valor estimado ejemplo: 900">
						  </div>
						</div>
						
						<div class="control-group">
						  <label for="select01" class="control-label">
						  <span class="red">*</span> Pa&iacute;s:</label>
						  <div class="controls">
							<select name="pais" class="span5" id="select01">
							  <option value=""> Seleccione su pais</option>
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
						
						
						
						
						 <div class="control-group">
						  <label class="control-label"><span class="red">*</span> Ciudad:</label>
						  <div class="controls">
							<input name="ciudad" type="text"  class="span5" id="ciudad" placeholder="Ingrese la ciudad donde se encuentra el producto">
						  </div>
						</div>
						
						
						
						<div class="control-group">
						  <label class="control-label">
						  <span class="red">*</span> Detalles del producto:</label>
						  <div class="controls">
							<textarea name="detalles" rows="6" class="span5" id="detalles" placeholder="Ingrese los detalles de su producto"></textarea>
						  </div>
						</div>
						
						
					  </fieldset>
					</div>
		
					<div class="form-actions">
					  <input type="submit" name="publicar" class="btn btn-primary" id="publicar" value="Publicar">
				  <input type="reset" name="restablecer" class="btn" id="restablecer" value="Restablecer">
				</div>
		
				  </form>
				  <div class="clearfix"></div>
				  <br>
				  
				  
				  
		<?php // Condicion Acceso 	
		} else{
		?>
		
		<h1 class="heading1"><span class="maintext">&Aacute;rea de Publicaci&oacute;n</span></h1>
		
		
		<h2>Entra a tu cuenta para publicar tu producto.</h2>
		<p>Si no te has registrado, puedes hacerlo en el &aacute;rea de registro, para nuevos usuarios <a href="registro.php">Clic Aqui</a></p>
		<p>&nbsp;</p>
		
		
		<section class="newcustomer">
			<h2 class="heading2 arrow_box">Usuario Registrado!</h2>
		<div class="loginbox">
		  <h4 class="heading4">Ingrese sus datos para entrar a su cuenta</h4>
		  <form class="form-vertical" id="formacceso" name="formacceso" method="post" action="">
			<fieldset>
			  <div class="control-group">
				<label class="control-label">Email:</label>
				<div class="controls">
				  <input name="email" type="text" class="span3" id="email" placeholder="Ingrese su email">
				</div>
			  </div>
			  <div class="control-group">
				<label class="control-label">Contrase&ntilde;a:</label>
				<div class="controls">
				  <input name="clave" type="password" class="span3" id="clave" placeholder="Ingrese su contraseña">
				</div>
			  </div>
			  <p>
				<a href="#" class="">¿Olvidaste tu clave?</a>
			  </p>
				<input name="entrar" class="btn btn-primary" type="submit" value="Entrar Ahora">
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
				<p>Para registrate has <a href="registro.php">Clic Aqui!</a> o en el siguiente bot&oacute;n.</p>
				<br>
				
				<a class="btn btn-danger" href="registro.php">Registrame Ahora!</a>
			</div>
		</section>
		
			
		<?php	
		}
		?>         

        
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
<script>
$('#myTabCuenta a').click(function (e) {
	e.preventDefault();
	$(this).tab('show');
})
</script>

</body>
</html>