<?php require_once("class/class.php"); ?>
<?php
$categorias = $instancia->getCategorias();
// clean images of session
if (isset($_SESSION['productos']) && count($_POST) == 0) { unset($_SESSION['productos']); }

// producto
$id = (isset($_REQUEST['p']) && !empty($_REQUEST['p'])) ? $_REQUEST['p'] : NULL;

if (isset($id)) {    
    
    // UPDATE
    if (count($_POST) > 0) {
        // 01 update        
            $array['categoriaID'] = $_POST['categoriaID'];
            $array['titulo'] = $_POST['titulo'];
            $array['video'] = $_POST['video'];
            $array['productonuevousado'] = $_POST['productonuevousado'];
            $array['precio'] = $_POST['precio'];
            $array['pais'] = $_POST['pais'];
            $array['ciudad'] = $_POST['ciudad'];
            $array['detalles'] = $_POST['detalles'];
            $array['publicacionID'] = $_POST['publicacionID'];
            
            if (!empty($array['publicacionID'])) {
                $instancia->updatePublicacion($array);
            }            
        
        // 02 insert
        if (!empty($_POST['publicacionID'])) {
            saveImage($_POST['publicacionID'], $instancia);            
        }
        $_POST = NULL;
    }
    
   // GET 
   $producto = $instancia->getPublicacion($id);
}

/*
 * Funcion para guardar imagenes (publicaciones_images)
 */
function saveImage($idPublicacion, $instancia) {
    require_once 'class/funciones.php';
    
    // 01 session de imagenes
    $dataSession['productos'] = (isset($_SESSION['productos']) && count($_SESSION['productos']) > 0) ? $_SESSION['productos'] : false;
    
    // 02 recorrido de estas ('productos')
    $dataInsert = array();
    if(isset($dataSession['productos']) && count($dataSession['productos']) > 0 && $dataSession['productos'] != false) {
        foreach ($dataSession['productos'] as $array) {
            $targetFile = realpath(__DIR__ ."/images/productos/") .'/'. $array['img_tmp']['name'];
            
            if (!copy($array['img_tmp']['path'], $targetFile)) { echo "failed to copy image"; exit; }
            
            $dataInsert['publicacionID'] = $idPublicacion;
            $dataInsert['nombre'] = $array['img_tmp']['name'];
            $dataInsert['fecha_registro'] = date("Y-m-d h:i:s");
            $dataInsert['estado'] = 1;
            
            $instancia->insertImagesByPublicacion($dataInsert);
            // 02.1 crear thumbnail
            $updir = realpath(__DIR__ ."/images/productos/") . "/";
            $dirLocation = realpath(__DIR__ ."/images/productos/thumb") . "/";            
            $extension = getFileExtension($array['img_tmp']['name']);
            $id = str_replace($extension, '', $array['img_tmp']['name']);
            makeThumbnails($updir, $extension, $id, $dirLocation);
            
        }
    }
    // 03 limpiar imagenes en session
    if (isset($_SESSION['productos'])) { unset($_SESSION['productos']); }    
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
                        <?php if (isset($_SESSION["email"])) : ?>                        
                            <?php if (isset($producto) && $producto != false) : ?>                        
                            <section id="featured" class="row mt40">
                                <h1 class="heading1 mt0"><span class="maintext"><?php echo $producto['titulo'] ?></span></h1>
                            </section>   
                        
                            <h1 class="heading1"><span class="maintext">&Aacute;rea de Publicaci&oacute;n</span></h1>
                            <form class="form-horizontal" id="form" name="form" method="post" action="">
                                <input type="hidden" name="publicacionID" id='publicacionID' value="<?php echo $producto['publicacionID']?>"/>
                                
                                <div class="registerbox">
                                    <fieldset>
                                        <div class="control-group">
                                            <label class="control-label"><span class="red">*</span> Categor&iacute;a:</label>
                                            <div class="controls">
                                                <select name="categoriaID" class="span5" id="categoriaID">
                                                    <option value=""> Seleccione la categor&iacute;a</option>
                                                    <?php for ($i = 0; $i < sizeof($categorias); $i++) : ?>
                                                        <option value="<?php echo $categorias[$i]["categoriaID"]; ?>"
                                                        <?php echo ($producto['categoriaID'] == $categorias[$i]["categoriaID"]) ? 'selected=""' : '' ?> >
                                                            <?php echo $categorias[$i]["categoria"]; ?></option>
                                                    <?php endfor; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label"><span class="red">*</span> T&iacute;tulo:</label>
                                            <div class="controls">
                                                <input name="titulo" type="text" class="span5" id="titulo" placeholder="Ingrese el título de su producto"
                                                       value="<?php echo $producto['titulo'] ?>">
                                            </div>
                                        </div>


                                        <div class="control-group">
                                            <label class="control-label"><span class="red">*</span> Foto:</label>
                                            <div class="controls perso">
                                                <input type="file" id="file" name="file" style="display: none;">
                                            </div>

                                        </div>


                                        <div class="control-group">
                                            <label class="control-label"><span class="red">*</span> Video:</label>
                                            <div class="controls perso">
                                                <textarea name="video" id="video" class="span5" placeholder="Ingrese la url del video a compartir"><?php echo $producto['video'] ?></textarea>
                                            </div>

                                        </div>

                                        <div class="control-group">
                                            <label class="control-label"><span class="red">*</span> Producto:</label>
                                            <div class="controls">
                                                <p class="radioFloat">
                                                    <input type="radio" name="productonuevousado" value="1"<?php echo ($producto['productonuevousado'] == 1) ? 'checked=""' : '' ?> >Nuevo
                                                    <input type="radio" name="productonuevousado" value="0"<?php echo ($producto['productonuevousado'] == 0) ? 'checked=""' : '' ?> >Usado
                                                </p>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label"><span class="red">*</span> Costo Estimado:</label>
                                            <div class="controls">
                                                <input name="precio" type="text"  class="span5" id="precio" placeholder="Ingrese el valor estimado ejemplo: 900" 
                                                       value="<?php echo $producto['precio'] ?>">
                                            </div>
                                        </div>

                                        <div class="control-group">
                                            <label for="select01" class="control-label">
                                                <span class="red">*</span> Pa&iacute;s:</label>
                                            <div class="controls">
                                                <select name="pais" class="span5" id="select01">
                                                    <option value="">Seleccione su pais</option>
                                                    <option value="Argentina" <?php echo ($producto['pais'] == 'Argentina') ? 'selected=""' : ''; ?>> Argentina</option>
                                                    <option value="Aruba" <?php echo ($producto['pais'] == 'Aruba') ? 'selected=""' : ''; ?> > Aruba</option>
                                                    <option value="Chile" <?php echo ($producto['pais'] == 'Chile') ? 'selected=""' : ''; ?>> Chile</option>
                                                    <option value="Colombia" <?php echo ($producto['pais'] == 'Colombia') ? 'selected=""' : ''; ?>> Colombia</option>
                                                    <option value="Costa Rica" <?php echo ($producto['pais'] == 'Costa Rica') ? 'selected=""' : ''; ?>> Costa Rica</option>
                                                    <option value="Cuba" <?php echo ($producto['pais'] == 'Cuba') ? 'selected=""' : ''; ?>> Cuba</option>
                                                    <option value="Ecuador" <?php echo ($producto['pais'] == 'Ecuador') ? 'selected=""' : ''; ?>> Ecuador</option>
                                                    <option value="El Salvador" <?php echo ($producto['pais'] == 'El Salvador') ? 'selected=""' : ''; ?>> El Salvador</option>
                                                    <option value="España" <?php echo ($producto['pais'] == 'España') ? 'selected=""' : ''; ?>> España</option>
                                                    <option value="Nicaragua" <?php echo ($producto['pais'] == 'Nicaragua') ? 'selected=""' : ''; ?>> Nicaragua</option>
                                                    <option value="Panama" <?php echo ($producto['pais'] == 'Panama') ? 'selected=""' : ''; ?>> Panama</option>
                                                    <option value="Paraguay" <?php echo ($producto['pais'] == 'Paraguay') ? 'selected=""' : ''; ?>> Paraguay</option>
                                                    <option value="Perú" <?php echo ($producto['pais'] == 'Perú') ? 'selected=""' : ''; ?>> Perú</option>
                                                    <option value="República Dominicana" <?php echo ($producto['pais'] == 'República Dominicana') ? 'selected=""' : ''; ?>> República Dominicana</option>
                                                    <option value="Uruguay" <?php echo ($producto['pais'] == 'Uruguay') ? 'selected=""' : ''; ?>> Uruguay</option>
                                                    <option value="Venezuela" <?php echo ($producto['pais'] == 'Venezuela') ? 'selected=""' : ''; ?>> Venezuela</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label"><span class="red">*</span> Ciudad:</label>
                                            <div class="controls">
                                                <input name="ciudad" type="text"  class="span5" id="ciudad" placeholder="Ingrese la ciudad donde se encuentra el producto"
                                                       value="<?php echo $producto['ciudad'] ?>">
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label">
                                                <span class="red">*</span> Detalles del producto:</label>
                                            <div class="controls">
                                                <textarea name="detalles" rows="6" class="span5" id="detalles" placeholder="Ingrese los detalles de su producto"><?php echo $producto['detalles'] ?></textarea>
                                            </div>
                                        </div>
                                        
                                        <!-- IMAGENES-->
                                        <table class="table table-bordered table-hover table-striped">
                                                <thead>
                                                    <tr>
                                                        <th width="10%">N</th>
                                                        <th width="82%">Imagen</th>                                                
                                                        <th width="8%" align="center">&nbsp;</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php  $producto_detalle = $instancia->getPublicacionDetalle($producto['publicacionID'], '', 'basic');                                                        
                                                        if (count($producto_detalle) > 0) : $count = 1; ?>
                                                            <?php foreach ($producto_detalle as $array) : 
                                                                $array["nombre"] = (isset($array["nombre"])) ? $array["nombre"] : 'default.jpg';
                                                            ?>
                                                            <tr>
                                                                <td valign="middle" style="vertical-align:middle !important"><?php echo $count ?></td>                                                
                                                                <td valign="middle" style="vertical-align:middle !important">
                                                                    <img src="images/productos/thumb/<?php echo $array["nombre"] ?>" class="responsive" width="75" height="55"></td>
                                                                <td align="center" style="vertical-align:middle !important" valign="middle">                                                    
                                                                    
                                                                    <a href="javascript:void(0);" onclick="eliminarImagen(<?php echo $array['id'] ?>);"><img src="images/iconos/borrar.png" alt="Borrar" width="20" height="20"></a>
                                                                </td>
                                                            </tr>
                                                            <?php $count++; endforeach; ?>
                                                    <?php endif; ?>                                                    
                                                </tbody>
                                            </table>
                                
                                    </fieldset>
                                </div>

                                <div class="form-actions">
                                    <input type="submit" name="publicar" class="btn btn-primary" id="publicar" value="Publicar">
                                    <input type="reset" name="restablecer" class="btn" id="restablecer" value="Restablecer">
                                </div>

                            </form>
                            <div class="clearfix"></div>
                            <br>
                            <?php else : ?>                            
                            <p>No existe producto.<p>
                            <?php endif; ?>
                            
                        <?php else : ?>
                            
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
                        <?php endif; ?>
                    </div>



                    <aside class="span3"> 
                        <?php include("left.php"); ?>
                    </aside>
                </div>
            </div>
        </div>
        <div class="clearfix"></div><!-- /maincontainer -->
        
        <!--Footer-->
        <?php include("footer.php"); ?>
        <!--Footer-->
        <script>
            $('#myTabCuenta a').click(function(e) {
                e.preventDefault();
                $(this).tab('show');
            });
        </script>
        
        <!-- add upload  pekeUpload -->
        <link rel="stylesheet" type="text/css" href="css/custom.css">
        <script src="js/pekeUpload.min.js"></script>
        <script type="text/javascript">
            //$("#file").pekeUpload();
                        
            $("#file").pekeUpload({
                btnText: "Browse files...",
                url: "pekeUpload.php?id=" + $("#publicacionID").val(),
                theme: 'bootstrap',
                multi: true,
                allowedExtensions: "jpeg|jpg|png|gif",
                onFileError: function(file, error) {
                    alert("error on file: " + file.name + " error: " + error + "")
                },
                onFileSuccess: function(file, data) {
                }
            }); 
            function eliminarImagen(id) {
                console.log('id',id);
                var p = $("#publicacionID").val()
                var url = "eliminar_imagen.php?p="+p+"&id="+id;
                location.href = url;
            }               

        </script>        

    </body>
</html>