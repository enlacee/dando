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
<title>Accesorios para carros</title>
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
          <h1 class="heading1 mt0"><span class="maintext">Productos</span></h1>
          
          
          
          
          
          
          <ul class="thumbnails">
          
          <?php 
		  	for($i=1;$i <=9;$i++){
		  ?>

            <li class="span3"> 
                <div class="thumbnail">
                    <a class="prdocutnameII" href="accesorios-para-carros.php">Accesorios para carros</a>
                    <a href="accesorios-para-carros.php"><img alt="" src="images/categorias/accesorios-carro.jpg"></a>
                 <div class="price">
                    <div class="enlaceCategoria"> 
                    	<a href="accesorios-para-carros.php" class="btn btn-small btn-primary">Ver Productos</a> </div>
                    </div>
                </div>
            </li>
   			<?php } ?>
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