<div class="sidewidt">
  <h2 class="heading2"><span>Categorias</span></h2>
  <ul class="nav nav-list categories">
  
    <?php
		$getCategoras = $instancia->getCategorias();
		for($i=0;$i<sizeof($getCategoras);$i++){
	?>
    	<li><a href="#"><?php echo $getCategoras[$i]['categoria']; ?></a></li>
    
    <?php } ?>
    
  </ul>
</div>

<div class="sidewidt">
  <h1 class="heading2"><span class="maintext">&Uacute;ltimas Publicaciones</span></h1>
  <ul class="bestseller">
    <?php
		$utlimas_publicaciones = $instancia->getUltimasPlublicaciones();
	
		for($i=0;$i<sizeof($utlimas_publicaciones);$i++){
	?>
    <li> <img width="90" height="90" src="images/productos/<?php echo $utlimas_publicaciones[$i]["foto"]; ?>" alt="product" title="product">
    <a class="productname" href="publicacion-detalle.php?publicacionID=<?php echo $publicaciones[$i]["publicacionID"]; ?>"> <?php echo $utlimas_publicaciones[$i]["titulo"]; ?></a>
    <span class="price"><?php echo "Bs.F ".$utlimas_publicaciones[$i]["precio"]; ?></span>
      <div class="ratingstar"> <a href="publicacion-detalle.php?publicacionID=<?php echo $utlimas_publicaciones[$i]["publicacionID"]; ?>" class="btn btn-small">M&aacute;s Detalles</a> </div>
    </li>
   <?php
		}
   ?>
  </ul>
</div>
<div class="sidewidt"> <img src="images/banner/banner3.jpg"> </div>
