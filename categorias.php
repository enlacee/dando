<?php require_once("class/class.php"); ?>
<?php

$publicaciones = $instancia->getPublicaciones();

//ENCRIPTAR*******************************************
require_once("class/enc/encriptar.php");
$encriptar = new Encryption();
//ENCRIPTAR*******************************************


?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Categor&iacute;as</title>
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
          <h1 class="heading1 mt0"><span class="maintext">Categor&iacute;as</span></h1>
          
          
          
          
          
          
          <ul class="thumbnails">

            <li class="span3"> 
                <div class="thumbnail">
                    <a class="prdocutnameII" href="categoria_producto.php">Accesorios para carros</a>
                    <a href="categoria_producto.php"><img alt="" src="images/categorias/accesorios-carro.jpg"></a>
                 <div class="price">
                    <div class="enlaceCategoria"> 
                    	<a href="categoria_producto.php" class="btn btn-small btn-primary">Ver Productos</a> </div>
                    </div>
                </div>
            </li>
            
            <li class="span3"> 
                <div class="thumbnail">
                    <a class="prdocutnameII" href="#">Camaras y Accesorios</a>
                    <a href="#"><img alt="" src="images/categorias/camaras.jpg"></a>
                 <div class="price">
                    <div class="enlaceCategoria"> 
                    	<a href="#" class="btn btn-small btn-primary">Ver Productos</a> </div>
                    </div>
                </div>
            </li>
            
            <li class="span3"> 
                <div class="thumbnail">
                    <a class="prdocutnameII" href="#">Celulares y Tel&eacute;fonos</a>
                    <a href="#"><img alt="" src="images/categorias/celulares.jpg"></a>
                 <div class="price">
                    <div class="enlaceCategoria"> 
                    	<a href="#" class="btn btn-small btn-primary">Ver Productos</a> </div>
                    </div>
                </div>
            </li>
            
            <li class="span3"> 
                <div class="thumbnail">
                    <a class="prdocutnameII" href="#">Computaci&oacute;n</a>
                    <a href="#"><img alt="" src="images/categorias/computadoras.jpg"></a>
                 <div class="price">
                    <div class="enlaceCategoria"> 
                    	<a href="#" class="btn btn-small btn-primary">Ver Productos</a> </div>
                    </div>
                </div>
            </li>
            
            <li class="span3"> 
                <div class="thumbnail">
                    <a class="prdocutnameII" href="#">Consolas y Videojuegos</a>
                    <a href="#"><img alt="" src="images/categorias/consolas.jpg"></a>
                 <div class="price">
                    <div class="enlaceCategoria"> 
                    	<a href="#" class="btn btn-small btn-primary">Ver Productos</a> </div>
                    </div>
                </div>
            </li>
            
            <li class="span3"> 
                <div class="thumbnail">
                    <a class="prdocutnameII" href="#">Deportes y Fitness</a>
                    <a href="#"><img alt="" src="images/categorias/deportes.jpg"></a>
                 <div class="price">
                    <div class="enlaceCategoria"> 
                    	<a href="#" class="btn btn-small btn-primary">Ver Productos</a> </div>
                    </div>
                </div>
            </li>
   
          </ul>
          
          
          
          
          
          
          
          <div class="pagination pull-right">
            <ul>
              <li><a href="#">Prev</a> </li>
              <li class="active"> <a href="#">1</a> </li>
              <li><a href="#">2</a> </li>
              <li><a href="#">3</a> </li>
              <li><a href="#">4</a> </li>
              <li><a href="#">Next</a> </li>
            </ul>
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


</body>
</html>