<?php require_once("class/class.php"); ?>
<?php

$publicaciones 	= $instancia->getPublicaciones();
$topTen = $instancia->getTopTen();

//ENCRIPTAR*******************************************
require_once("class/enc/encriptar.php");
$encriptar = new Encryption();
//ENCRIPTAR*******************************************


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
      	
        <section>
        	<h1 class="heading1 mt0"><span class="maintext">Top Ten</span></h1>

            <!-- fullwidth slider -->
            <div id="fullwidth_slider" class="milindex fullwidth-slider">
                <ul class="es-slides">
                    <?php foreach($topTen as $row) :                        
                        $publicacion_detalle = $instancia->getPublicacionDetalle($row["publicacionID"], 1);
                    ?>
                    <?php if (is_array($publicacion_detalle) && count($publicacion_detalle) > 0) : ?>
                    <li class="mostrarTituloMouseAct">
                        <img src="images/productos/thumb/<?php echo $publicacion_detalle[0]["nombre"]; ?>" 
                             alt="<?php echo $row['titulo'] ?>" title="<?php echo $row['titulo'] ?>">
                        <div class="fullwidth-title" id="mostrarTitulo">
                            <a style="font-size:11px !important;" href="publicacion-detalle.php?publicacionID=<?php echo $encriptar->encode($row["publicacionID"]); ?>"><?php echo $row["titulo"]; ?></a>
                        </div>
                    </li>
                    <?php else : ?>
                    <li class="mostrarTituloMouseAct">
                        <img src="images/productos/thumb/default.jpg" 
                             alt="default.jpg" title="default.jpg">
                        <div class="fullwidth-title" id="mostrarTitulo">
                            <a style="font-size:11px !important;" href="#">default.jpg</a>
                        </div>                        
                    </li>
                    <?php endif ?>
                    <?php endforeach; ?>
                </ul>
            </div>
            <!-- fullwidth slider -->

        </section>
      
      
      
        <section id="featured" class="row mt40">
          <h1 class="heading1 mt0"><span class="maintext">Productos</span></h1>
          
          <ul class="thumbnails">
            <?php if (is_array($publicaciones) && count($publicaciones) > 0) : ?>
            <?php foreach($publicaciones as $row) : 
                $publicacion_detalle = $instancia->getPublicacionDetalle($row["publicacionID"], 1);
                $publicacion_detalle[0]["nombre"] = (isset($publicacion_detalle[0]["nombre"])) ? $publicacion_detalle[0]["nombre"] : 'default.jpg';
            ?>
            <li class="span3"> 
                <div class="thumbnail">
                    <a class="prdocutname" href="publicacion-detalle.php?publicacionID=<?php echo $encriptar->encode($row["publicacionID"]); ?>"><?php echo $row["titulo"]; ?></a>
                    <a href="publicacion-detalle.php?publicacionID=<?php echo $encriptar->encode($row["publicacionID"]); ?>">
                        <img src="images/productos/thumb/<?php echo $publicacion_detalle[0]["nombre"]; ?>" alt="<?php echo $row["titulo"]; ?>" title="<?php echo $row["titulo"]; ?>"></a>                 
                    <?php /*?> <div class="shortlinks"> Me gustaria cambiar esto por una computadora </div><?php */?>                 
                    <div class="price">
                        <div class="elementI"> <a href="publicacion-detalle.php?publicacionID=<?php echo $encriptar->encode($row["publicacionID"]); ?>" class="btn btn-small addtocartbutton">M&aacute;s Detalles</a> </div>
                        <div class="elementII"> <a  class="btn btn-small btn-primary addtocartbutton"><?php echo "Bs.F ".$row["precio"]; ?></a> </div>
                    </div>
                </div>
            </li>
            <?php endforeach; ?>
            <?php else : ?>
            <li class="span3">No se encontraron datos.</li>
            <?php endif; ?>
          </ul>
          
          
          
          
          
          
          <!--
          <div class="pagination pull-right">
            <ul>
              <li><a href="#">Prev</a> </li>
              <li class="active"> <a href="#">1</a> </li>
              <li><a href="#">2</a> </li>
              <li><a href="#">3</a> </li>
              <li><a href="#">4</a> </li>
              <li><a href="#">Next</a> </li>
            </ul>
          </div>-->
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


</body>
</html>