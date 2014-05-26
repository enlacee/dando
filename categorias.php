<?php require_once("class/class.php");

$categoria = $instancia->getCategorias();

//ENCRIPTAR*******************************************
//require_once("class/enc/encriptar.php");
//$encriptar = new Encryption();
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
          
          <?php if (is_array($categoria) && count($categoria) > 0) : ?>
          <ul class="thumbnails">
            <?php foreach ($categoria as $array) : ?>
            <li class="span3"> 
                <div class="thumbnail">
                    <a class="prdocutnameII" href="categoria_producto.php?cat=<?php echo $array['categoriaID'] ?>"><?php echo $array['categoria'] ?></a>
                    <a href="categoria_producto.php?cat=<?php echo $array['categoriaID'] ?>"><img alt="" src="images/categorias/<?php echo $array['image'] ?>"></a>
                 <div class="price">
                    <div class="enlaceCategoria"> 
                    	<a href="categoria_producto.php?cat=<?php echo $array['categoriaID'] ?>" class="btn btn-small btn-primary">Ver Productos</a> </div>
                    </div>
                </div>
            </li>
            <?php endforeach; ?>
          </ul>
          <?php else : ?>
          <p>No se encontraron resultados.</p>
          <?php endif; ?>
          <!--<div class="pagination pull-right">
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