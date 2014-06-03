<?php require_once("class/class.php"); ?>
<?php
$categorias = $instancia->getCategorias();
// clean images of session
if (isset($_SESSION['productos']) && count($_POST) == 0) { unset($_SESSION['productos']); }

//Valida información de acceso si el suuario llega a esta area sin estar logueado o registrado.
if (array_key_exists("entrar", $_POST)) {
    $acceso_usuario = $instancia->accesoUsuario($_POST["email"], md5($_POST["clave"]));
}

if (array_key_exists("publicar", $_POST)) {        
    $_POST['productonuevousado'] = empty($_POST['productonuevousado']) ? 1 : $_POST['productonuevousado'];    
    $productoID = $instancia->setProducto(Apps::acentos($_POST["categoriaID"]), $_SESSION["email"], $_SESSION["email"], "1", $_POST['productonuevousado'], Apps::acentos($_POST["titulo"]), Apps::acentos($_POST["video"]), "disponible", $_POST["precio"], $_POST["pais"], Apps::acentos($_POST["ciudad"]), Apps::acentos($_POST["detalles"]), $_SERVER["REMOTE_ADDR"], date("d/m/Y"), date("h:m:i"));
    // registrar imagenes de la publicacion de (SESSION)
    saveImage($productoID, $instancia);
    $_SESSION['message'] = "Tu publicaci&oacuten fue registrado correctamente.";
    header("Location: index.php");
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
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <title>Área de publicación</title>
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





                        <?php
// Condicion Acceso
                        if (isset($_SESSION["email"])) {
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
                                                    for ($i = 0; $i < sizeof($categorias); $i++) {
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
                                               <!--<input name="foto" type="text" class="span3" id="foto" readonly />
                                                  <a href="javascript:void(0);" class="btn perso" title="Subir Imagen" onclick="javascript:$('#modal').dialog('open'); " >Subir Clic Aqui</a>-->
                                                <!-- input --->
                                                <input type="file" id="file" name="file" style="display: none;">
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
                                                    <input type="radio" name="productonuevousado" value="1">Nuevo
                                                    <input type="radio" name="productonuevousado" value="0">Usado
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
                                                    <option value="Perú">Perú</option>
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



                            <?php
                            // Condicion Acceso 	
                        } else {
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
        <script type="text/javascript" src="swfupload/js/swfupload/swfupload.js"></script>
        <script type="text/javascript" src="swfupload/js/jquery.swfupload.js"></script>
        <?php include("swfupload.php"); ?>


        <!--Footer-->














        <script type="text/javascript">
            //Validar Acceso de usuario
            debug: true,
                    $(function() {
                        $('#formacceso').validate({
                            rules: {
                                email: {
                                    required: true,
                                    email: true
                                },
                                clave: {
                                    required: true,
                                },
                            },
                            messages: {
                                email: {
                                    required: "Obligatorio!",
                                    email: "Ingrese una dirección de email válida.",
                                },
                                clave: {
                                    required: "Obligatorio!",
                                },
                            },
                        });
                    });
            //Validar Acceso de usuario
        </script>




        <script type="text/javascript">

            debug: true,
                    $(function() {
                        $('#form').validate({
                            rules: {
                                categoriaID: {
                                    required: true
                                },
                                titulo: {
                                    required: true,
                                    minlength: 10,
                                    maxlength: 50
                                },
                                foto: {
                                    required: true,
                                    uploadFile: true

                                },
                                productoestado: {
                                    required: true,
                                },
                                precio: {
                                    required: true,
                                    number: true
                                },
                                pais: {
                                    required: true
                                },
                                ciudad: {
                                    required: true
                                },
                                detalles: {
                                    required: true
                                },
                            },
                            messages: {
                                categoriaID: 'Obligatorio!',
                                titulo: {
                                    required: "Obligatorio!",
                                    minlength: 'Mínimo 10 carácteres.',
                                    maxlength: 'Máximo 50 carácteres.',
                                },
                                foto: {
                                    required: 'Obligatorio!',
                                },
                                productoestado: {
                                    required: 'Obligatorio!',
                                },
                                precio: {
                                    required: 'Obligatorio!',
                                    number: 'Solo números'
                                },
                                pais: {
                                    required: 'Obligatorio!',
                                },
                                ciudad: {
                                    required: 'Obligatorio!',
                                },
                                detalles: {
                                    required: 'Obligatorio!',
                                },
                            },
                        });
                    });


            //Validate Filemage
            $.validator.addMethod("uploadFile", function(val, element) {
                var ext = $(element).val().split('.').pop().toLowerCase();
                console.log(ext);
                var allow = new Array('jpg', 'png');
                var size = element.files[0].size;
                console.log(size);

                if (jQuery.inArray(ext, allow) == -1 || size > 1048576) {
                    console.log("returning false");
                    return false;
                } else {
                    console.log("returning true");
                    return true;
                }

            }, "Error: Solo imagenes jpg, png - Max 1 MB");
        </script>

        <!-- add upload  pekeUpload -->
        <link rel="stylesheet" type="text/css" href="css/custom.css">
        <script src="js/pekeUpload.min.js"></script>
        <script type="text/javascript">
            //$("#file").pekeUpload();
            // 
            $("#file").pekeUpload({
                btnText: "Browse files...",
                url: "pekeUpload.php",
                theme: 'bootstrap',
                multi: true,
                allowedExtensions: "jpeg|jpg|png|gif",
                onFileError: function(file, error) {
                    alert("error on file: " + file.name + " error: " + error + "")
                },
                onFileSuccess: function(file, data) {
                }
            });
        </script>
    </body>
</html>