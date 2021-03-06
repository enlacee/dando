<?php require_once("class/class.php"); ?>
<?php
$id = isset($_REQUEST['cat']) ? $_REQUEST['cat'] : '';
$publicaciones = array();
$categoria = '-';
if (!empty($id)) {
    
    // ZEBRA - PAGINATOR    
    $records_per_page = 9;    
    $pagination = new Zebra_Pagination();    
    $pagination->navigation_position(isset($_GET['navigation_position']) && in_array($_GET['navigation_position'], array('left', 'right')) ? $_GET['navigation_position'] : 'outside');
    $offset = (($pagination->get_page() - 1) * $records_per_page); 
    $limit = $records_per_page;
    
    $publicaciones = $instancia->getPublicacionesbyCategory($id, 'disponible', 'desc', $limit, $offset, FALSE);    
    $rows = $instancia->getPublicacionesbyCategory($id, 'disponible', '', '', '', TRUE);
    $pagination->records($rows);
    // records per page
    $pagination->records_per_page($records_per_page);
    
    // list
    $categoriaArray = $instancia->getCategorias($id);
    $categoria = isset($categoriaArray[0]['categoria']) ? $categoriaArray[0]['categoria'] : '';    
}


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
            <h1 class="heading1 mt0"><span class="maintext"><?php echo $categoria ?></span></h1>        
            <?php if (is_array($publicaciones) && count($publicaciones) > 0) : ?>          
                <ul class="thumbnails">
                <?php foreach ($publicaciones as $row) : 
                $publicacion_detalle = $instancia->getPublicacionDetalle($row["publicacionID"], 1);
                $publicacion_detalle[0]["nombre"] = (isset($publicacion_detalle[0]["nombre"])) ? $publicacion_detalle[0]["nombre"] : 'default.jpg';                    
                ?>
                 <li class="span3"> 
                    <div class="thumbnail">
                        <a class="prdocutname" href="publicacion-detalle.php?publicacionID=<?php echo $encriptar->encode($row["publicacionID"]); ?>"><?php echo $row["titulo"]; ?></a>
                        <a href="publicacion-detalle.php?publicacionID=<?php echo $encriptar->encode($row["publicacionID"]); ?>"><img alt="" src="images/productos/thumb/<?php echo $publicacion_detalle[0]["nombre"] ?>"></a>

                     <?php /*?> <div class="shortlinks"> Me gustaria cambiar esto por una computadora </div><?php */?>

                    <div class="price">
                        <div class="elementI"> <a href="publicacion-detalle.php?publicacionID=<?php echo $encriptar->encode($row["publicacionID"]); ?>" class="btn btn-small addtocartbutton">M&aacute;s Detalles</a> </div>
                        <div class="elementII"> <a  class="btn btn-small btn-primary addtocartbutton"><?php echo "Bs.F ".$row["precio"]; ?></a> </div>
                    </div>
                 </li>
                 <?php endforeach; ?>
               </ul>                    
          
            <?php echo $pagination->render(); ?>
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
        <?php else : ?>
          <p>No se encontrarron resultados.</p>
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


</body>
</html>