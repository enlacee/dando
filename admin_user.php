<?php require_once("class/class.php"); ?>
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
          <h1 class="heading1 mt0"><span class="maintext">Mi Cuenta</span></h1>
          
            <ul class="nav nav-tabs" id="myTabCuenta">
                  <li class="active"><a href="#produtos">Mis Productos</a></li>
                <li><a href="#trueques">Trueques</a></li>
                <li><a href="#perfil">Editar mi perfil</a></li>
            </ul>
             
            <div class="tab-content">
            
                <div class="tab-pane active" id="produtos">
                	<table class="table table-bordered table-hover table-striped">
                    	<thead>
                        	<tr>
                                <th width="32%">Titulo</th>
                                <th width="26%">Precio</th>
                                <th width="34%">Imagen</th>
                                <th width="8%" align="center">&nbsp;</th>
							</tr>
                        </thead>
                        <tbody>
                        	<tr>
                            	<td valign="middle" style="vertical-align:middle !important">Titulo</td>
                                <td valign="middle" style="vertical-align:middle !important">Precio</td>
                                <td valign="middle" style="vertical-align:middle !important"><img src="images/productos/completado_0mqj9xx8b7.jpg" alt="Televisor" class="responsive" width="75" height="55"></td>
                                <td align="center" style="vertical-align:middle !important" valign="middle"><a href="#"><img src="images/iconos/actualizar.png" alt="ACtualizar" width="20" height="20"></a>
                                    &nbsp;
                                    <a href="#"><img src="images/iconos/borrar.png" alt="ACtualizar" width="20" height="20"></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    
                </div>
                
                <div class="tab-pane" id="trueques">
                
                <table class="table table-bordered table-hover table-striped">
                    	<thead>
                        	<tr>
                                <th width="32%">Producto</th>
                                <th width="26%">Precio</th>
                                <th width="34%">Informaci&oacute; del Vendedor</th>
                                <th width="8%" align="center">&nbsp;</th>
							</tr>
                        </thead>
                        <tbody>
                        	<tr>
                            	<td valign="middle" style="vertical-align:middle !important">Nevera Samsung dos puertas</td>
                                <td valign="middle" style="vertical-align:middle !important">Bs.F 17.500</td>
                                <td valign="middle" style="vertical-align:middle !important">
                                	<p>Nombre: Luis Figuera</p>
                                    <p>Tel&eacute;fonos: (0281) - 999.99.99</p>
                                    <p>Email: email@email.com</p>
                                
                                </td>
                                <td align="center" style="vertical-align:middle !important" valign="middle" style="text-align:center !important">
                                    <a href="#" class="btn btn-danger">Cancelar</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                
                
                </div>
                <div class="tab-pane" id="perfil">
                
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
                    <input name="tlfcasa" type="text"  class="input-xlarge" id="tlfcasa" placeholder="Ingrese su numero de casa/oficina">
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
        <input name="clave" type="password"  class="input-xlarge" id="clave" placeholder="Ingrese su contraseña">
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
		  <input type="submit" name="registro" class="btn btn-primary" id="actualizar" value="Actualizar">
          <input type="button" name="Botón" class="btn" id="cancelar" value="Cancelar">
		</div>

          </form>
                
                </div>
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
<script>
$('#myTabCuenta a').click(function (e) {
	e.preventDefault();
	$(this).tab('show');
})
</script>

</body>
</html>