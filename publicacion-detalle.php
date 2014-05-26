<?php
require_once("class/class.php");

//ENCRIPTAR*******************************************
require_once("class/enc/encriptar.php");
$encriptar = new Encryption();
//ENCRIPTAR*******************************************

$publicacion_detalle = $instancia->getPublicacionDetalle($encriptar->decode($_GET["publicacionID"]));

//echo "<pre>";
//print_r($publicacion_detalle); exit;

if (array_key_exists("comprar", $_POST)) {
    $instancia->setComprar($_SESSION["email"], date("d/m/Y"), $encriptar->decode($_GET["publicacionID"]), $_GET["publicacionID"]);
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Dando y Dando - Sistema de Trueque </title>
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
                    <?php for ($i = 0; $i < sizeof($publicacion_detalle); $i++) { ?>
                        <div class="span9">
                            <div class="row">
                                <!-- Left Image-->
                                <div class="span4">                                    
                                    <!-- template -->
                                    <div class="ms-showcase2-template ms-showcase2-vertical">
                                        <!-- milindexslider -->
                                        <div class="milindex-slider ms-skin-default" id="milindexslider">
                                            <?php for ($i = 0; $i < count($publicacion_detalle); $i++) { ?>
                                                <div class="ms-slide">
                                                    <img src="milindexslider/blank.gif" data-src="images/productos/thumb/<?php echo $publicacion_detalle[$i]["nombre"]; ?>" alt="lorem ipsum dolor sit"/> 
                                                    <img class="ms-thumb" src="images/productos/thumb/<?php echo $publicacion_detalle[$i]["nombre"]; ?>" alt="thumb" />
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <!-- end of milindexslider -->
                                    </div>
                                    <!-- end of template -->   
                                </div>
                                <!-- Right Details-->
                                <div class="span5">
                                    <div class="row">
                                        <div class="span5">
                                            <h1 class="productname"><span class="bgnone"><?php echo $publicacion_detalle[0]["titulo"]; ?></span></h1>

                                            <div id="mensajes" style="display:none; margin:10px 0;"></div>

                                            <div class="productprice">
                                                <div class="productpageprice"><?php echo "Bs.F " . $publicacion_detalle[0]["precio"]; ?></div>

                                            </div>


                                            <div class="productbtn">
                                                <?php
                                                if (isset($_SESSION["email"])) {

                                                    if ($publicacion_detalle[0]["productoestado"] == "comprado") {

                                                        echo '<p class="alert-info">PRODUCTO NO DISPONIBLE! TRUEQUE SOLICITADO</p>';
                                                    } else {
                                                        echo '
										<form name="form" method="post" action="">
                               				<input class="bnt btn-danger btn-large" name="comprar" type="submit" value="Hacer Trueque">
                               			</form>';
                                                    }
                                                } else {
                                                    ?>
                                                    <h4>Para hacer un trueque debes ingresar a tu cuenta</h4>
                                                    <p>
                                                        <a class="btn btn-primary btn-large" href="acceso.php">Ir a mi cuenta</a>

                                                    </p>

                                                    <p>Si no estas registrado puede hacerlo! <a href="registro.php">Clic Aqui</a></p>
                                                    <?php
                                                }
                                                ?>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Product Description tab & comments-->
                            <div class="productdesc">
                                <ul class="nav nav-tabs" id="myTab">
                                    <li class="active"><a href="#description">Descripci&oacute;n</a> </li>
                                    <li><a href="#video">Video</a> </li>
                                </ul>


                                <div class="tab-content">

                                    <div class="tab-pane active" id="description">
                                        <h2><?php echo $publicacion_detalle[0]["titulo"]; ?></h2>
                                        <p><?php echo $publicacion_detalle[0]["detalles"]; ?></p>
                                    </div>


                                    <div class="tab-pane" id="video">

                                        <?php if (!empty($publicacion_detalle[0]["video"])) { ?>
                                            <h2>Video del producto</h2>
                                            <p>Clic sobre el enlace para ver el video</p>
                                            <p>Enlace: <a href="<?php echo $publicacion_detalle[0]["video"]; ?>" target="_blank"><?php echo $publicacion_detalle[0]["video"]; ?></a></p> 
                                        <?php } else { ?>

                                            <h2>Video del producto</h2>
                                            <p>Este producto no tiene video</p>
                                        <?php } ?>
                                    </div>

                                </div>


                            </div>

                        </div>

                        <?php
                    }
                    ?>

















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
            $(function() {

                //Detecta Nombre URL
                function getID(url) {

                    var Marcador = url.lastIndexOf("=");
                    if (Marcador > 0 && url.length - 1 != Marcador) {

                        return url.substring(Marcador + 1);
                    }
                }



                //Obtiene el ID
                if (getID(window.location.href)) {

                    //Si el usuario no es valido
                    if (getID(window.location.href) == 1) {
                        setTimeout(function() {
                            $("#mensajes").slideUp("slow");
                        }, 26000);
                        $("#mensajes").html('<p class="alert-success">Trueque realizado correctamente! Revice su correo ahora mismo!</p>')
                        $("#mensajes").slideDown(600);
                        $("#mensajes").css("display", "block");
                    }

                }



            });//Closed
        </script>

        <script>
            $('#myTab a').click(function(e) {
                e.preventDefault();
                $(this).tab('show');
            })
        </script>

    </body>
</html>