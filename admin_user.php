<?php
//header('Content-Type: text/html; charset=utf8');
require_once("class/class.php");

$id = (isset($_SESSION['usuarioID']) && !empty($_SESSION['usuarioID'])) ? $_SESSION['usuarioID'] : NULL;
$email = (isset($_SESSION['email']) && !empty($_SESSION['usuarioID'])) ? $_SESSION['email'] : NULL; 

if (isset($id)) {
    
    // update data user.
    if (is_array($_POST) && count($_POST)) {
        $data['usuarioID'] = $id;
        $data['nombres'] = $_POST['nombres'];
        $data['email'] = $_POST['email'];
        $data['tlfcelular'] = $_POST['tlfcelular'];
        $data['tlfcasa'] = $_POST['tlfcasa'];
        $data['empresa'] = $_POST['empresa'];
        $data['direccion'] = $_POST['direccion'];
        $data['ciudad'] = $_POST['ciudad'];
        $data['pais'] = $_POST['pais'];        
        if (!empty($_POST['clave'])) {
            if($_POST['clave'] == $_POST['clave1']) {
                $data['clave'] = md5($_POST['clave']);
            }            
        }
        $instancia->updateUser($data);
    }
    
    // 03 editar perfil
    $user = $instancia->getUser($id);
    
    // 01 mis productos
    $productos = $instancia->getPublicacionesByUser($email, 1);
    //ECHO "<PRE>"; print_r($productos); exit;
    
    $pTrueque = $instancia->getPublicacionesByUserTrueque($email);    
}

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

                        <?php if (isset($id) && is_array($user) && $user != FALSE) : ?>
                        <section id="featured" class="row mt40">
                            <h1 class="heading1 mt0"><span class="maintext">Mi Cuenta</span></h1>
                            <ul class="nav nav-tabs" id="myTabCuenta">
                                <li class="active"><a href="#produtos">Mis Productos</a></li>
                                <li><a href="#trueques">Trueques</a></li>
                                <li><a href="#perfil">Editar mi perfil</a></li>
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane active" id="produtos">
                                    <?php if (is_array($productos) && count($productos) > 0 ) :?>
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th width="5%">N</th>
                                                <th width="32%">Titulo</th>
                                                <th width="26%">Precio</th>
                                                <th width="27%">Imagen</th>
                                                <th width="10%" align="center">&nbsp;</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $count = 1; foreach ($productos as $array) : 
                                            $producto_detalle = $instancia->getPublicacionDetalle($array['publicacionID'], 1, 'basic');
                                            $producto_detalle[0]["nombre"] = (isset($producto_detalle[0]["nombre"])) ? $producto_detalle[0]["nombre"] : 'default.jpg';                                            
                                            ?>
                                            <tr>
                                                <td valign="middle" style="vertical-align:middle !important"><?php echo $count?></td>
                                                <td valign="middle" style="vertical-align:middle !important"><?php echo $array['titulo'] ?></td>
                                                <td valign="middle" style="vertical-align:middle !important"><?php echo $array['precio'] ?></td>
                                                <td valign="middle" style="vertical-align:middle !important"><img src="images/productos/thumb/<?php echo $producto_detalle[0]["nombre"] ?>" 
                                                                                                                  alt="<?php echo $array['titulo'] ?>" class="responsive" width="75" height="55"></td>
                                                <td align="center" style="vertical-align:middle !important" valign="middle">
                                                    <a href="editar_producto_publicado.php?p=<?php echo $array['publicacionID'] ?>"><img src="images/iconos/actualizar.png" alt="ACtualizar" width="20" height="20"></a>
                                                    &nbsp;
                                                    <a href="eliminar_publicacion.php?p=<?php echo $array['publicacionID'] ?>"><img src="images/iconos/borrar.png" alt="Actualizar" width="20" height="20"></a>
                                                </td>
                                            </tr>
                                            <?php $count++; endforeach; ?>
                                        </tbody>
                                    </table>
                                    <?php else : ?>
                                    <p>No se encontraron productos.</p>
                                    <?php endif; ?>

                                </div>

                                <div class="tab-pane" id="trueques">
                                    <?php if (is_array($pTrueque) && count($pTrueque) > 0 ) :?>                                    
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th width="5%">N</th>
                                                <th width="32%">Producto</th>
                                                <th width="11%">Precio</th>
                                                <th width="34%">Informaci&oacute; del Vendedor</th>
                                                <th width="8%" align="center">&nbsp;</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $count = 1; foreach ($pTrueque as $array) : 
                                        $producto_detalle = $instancia->getPublicacionDetalle($array['publicacionID'], 1, 'basic');
                                        $producto_detalle[0]["nombre"] = (isset($producto_detalle[0]["nombre"])) ? $producto_detalle[0]["nombre"] : 'default.jpg';
                                        // vendedor
                                        $vendedor = $instancia->getUser($array['vendidopor']);
                                        ?>                                            
                                            <tr>
                                                <td valign="middle" style="vertical-align:middle !important"><?php echo $count ?></td>
                                                <td valign="middle" style="vertical-align:middle !important"><?php echo $array['titulo'] ?></td>
                                                <td valign="middle" style="vertical-align:middle !important">Bs.F <?php echo $array['precio'] ?></td>
                                                <td valign="middle" style="vertical-align:middle !important">
                                                    <p>Nombre: <?php echo $vendedor['nombres']?></p>
                                                    <p>Tel&eacute;fonos: <?php echo $vendedor['tlfcelular'] ?> - <?php echo $vendedor['tlfcasa'] ?></p>
                                                    <p><?php echo $array['vendidopor'] ?></p>

                                                </td>
                                                <td align="center" style="vertical-align:middle !important" valign="middle" style="text-align:center !important">
                                                    <a href="eliminar_trueque.php?p=<?php echo $array['publicacionID'] ?>" class="btn btn-danger">Cancelar</a>
                                                </td>
                                            </tr>
                                            <?php $count++; endforeach; ?>
                                        </tbody>
                                    </table>
                                    <?php else : ?>
                                        <p>No se encontraron datos.</p>
                                    <?php endif; ?>

                                </div>
                                <div class="tab-pane" id="perfil">

                                    <form class="form-horizontal" id="form" name="form" method="post" action="">
                                        <h3 class="heading3">Informaci&oacute;n Personal</h3>


                                        <div class="registerbox">
                                            <fieldset>
                                                <div class="control-group">
                                                    <label class="control-label"><span class="red">*</span> Nombres:</label>
                                                    <div class="controls">
                                                        <input name="nombres" type="text"  class="input-xlarge" id="nombres" placeholder="Ingrese su nombre"
                                                               value="<?php echo $user['nombres']?>">
                                                    </div>
                                                </div>


                                                <div class="control-group">
                                                    <label class="control-label"><span class="red">*</span> Email:</label>
                                                    <div class="controls">
                                                        <input name="email" type="text" autocomplete="off" class="input-xlarge" id="email" placeholder="Ingrese su email" onKeyUp="javascript:validar_usuario();"
                                                               value="<?php echo $user['email']; ?>">
                                                        <span id="mensaje"></span>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label"><span class="red">*</span> TLF Celular:</label>
                                                    <div class="controls">
                                                        <input name="tlfcelular" type="text"  class="input-xlarge" id="tlfcelular" placeholder="Ingrese su número de celular"
                                                               value="<?php echo $user['tlfcelular']; ?>">
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label"> TLF Casa/Oficina:</label>
                                                    <div class="controls">
                                                        <input name="tlfcasa" type="text"  class="input-xlarge" id="tlfcasa" placeholder="Ingrese su numero de casa/oficina"
                                                               value="<?php echo $user['tlfcasa']; ?>">
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
                                                               autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label  class="control-label"><span class="red">*</span>  Repetir Contrase&ntilde;a:</label>
                                                    <div class="controls">
                                                        <input name="clave1" type="password"  class="input-xlarge" id="clave1" placeholder="Coloque nuevamente su contraseña"
                                                               autocomplete="off">
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
                                                        <input name="empresa" type="text"  class="input-xlarge" id="empresa" placeholder="Ingrese su empresa o trabajo"
                                                               value="<?php echo $user['empresa']; ?>">
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label"><span class="red">*</span> Direcci&oacute;n:</label>
                                                    <div class="controls">
                                                        <input name="direccion" type="text"  class="input-xlarge" id="direccion" placeholder="Ingrese su lugar de residencia"
                                                               value="<?php echo $user['direccion']; ?>">
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label">
                                                        <span class="red">*</span> Ciudad:</label>
                                                    <div class="controls">
                                                        <input name="ciudad" type="text"  class="input-xlarge" id="ciudad" placeholder="Ingrese la ciudad donde vive"
                                                               value="<?php echo $user['ciudad']; ?>">
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label for="select01" class="control-label">
                                                        <span class="red">*</span> Pa&iacute;s:</label>
                                                    <div class="controls">
                                                        <select name="pais" class="span3" id="pais">
                                                            <option value="">Seleccione su pais</option>
                                                            <option value="Argentina" <?php echo ($user['pais'] == 'Argentina') ? 'selected=""' : ''; ?>> Argentina</option>
                                                            <option value="Aruba" <?php echo ($user['pais'] == 'Aruba') ? 'selected=""' : ''; ?> > Aruba</option>
                                                            <option value="Chile" <?php echo ($user['pais'] == 'Chile') ? 'selected=""' : ''; ?>> Chile</option>
                                                            <option value="Colombia" <?php echo ($user['pais'] == 'Colombia') ? 'selected=""' : ''; ?>> Colombia</option>
                                                            <option value="Costa Rica" <?php echo ($user['pais'] == 'Costa Rica') ? 'selected=""' : ''; ?>> Costa Rica</option>
                                                            <option value="Cuba" <?php echo ($user['pais'] == 'Cuba') ? 'selected=""' : ''; ?>> Cuba</option>
                                                            <option value="Ecuador" <?php echo ($user['pais'] == 'Ecuador') ? 'selected=""' : ''; ?>> Ecuador</option>
                                                            <option value="El Salvador" <?php echo ($user['pais'] == 'El Salvador') ? 'selected=""' : ''; ?>> El Salvador</option>
                                                            <option value="España" <?php echo ($user['pais'] == 'España') ? 'selected=""' : ''; ?>> España</option>
                                                            <option value="Nicaragua" <?php echo ($user['pais'] == 'Nicaragua') ? 'selected=""' : ''; ?>> Nicaragua</option>
                                                            <option value="Panama" <?php echo ($user['pais'] == 'Panama') ? 'selected=""' : ''; ?>> Panama</option>
                                                            <option value="Paraguay" <?php echo ($user['pais'] == 'Paraguay') ? 'selected=""' : ''; ?>> Paraguay</option>
                                                            <option value="Perú" <?php echo ($user['pais'] == 'Perú') ? 'selected=""' : ''; ?>> Perú</option>
                                                            <option value="República Dominicana" <?php echo ($user['pais'] == 'República Dominicana') ? 'selected=""' : ''; ?>> República Dominicana</option>
                                                            <option value="Uruguay" <?php echo ($user['pais'] == 'Uruguay') ? 'selected=""' : ''; ?>> Uruguay</option>
                                                            <option value="Venezuela" <?php echo ($user['pais'] == 'Venezuela') ? 'selected=""' : ''; ?>> Venezuela</option>
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
                        <?php else : ?>
                        <p><a class="btn btn-primary btn-large" href="acceso.php">Ir a mi cuenta</a></p>
                        <?php endif; ?>
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
            $('#myTabCuenta a').click(function(e) {
                e.preventDefault();
                $(this).tab('show');
            })
            
            function cancelarTrueque(productoID) {
                //cambia el estado del producto a : disponible
            }
            
            function eliminarPublicacion() {
               
                
            }
        </script>

    </body>
</html>