
<div class="container">
  <div class="headerdetails"> <a class="logo pull-left" href="index.php"><img title="SimpleOne" alt="SimpleOne" src="images/logo.png"></a>
    <div class="pull-left banner"> <img src="images/banner/top-banner1.gif"> </div>
    
    <?php
	if(isset($_SESSION["email"])){
	$saludo = $instancia->getSaludoBienvenida($_SESSION["email"]);
	?>
    
    <div class="pull-right botones">
        <p>Bienvenido, <strong><a href="admin_user.php"><?php echo $saludo[0]["nombres"]; ?></a></strong> | <a href="salir.php">Salir</a></p>
    </div>
    
    <?php
	}else{
	?>
    	<div class="pull-right botones">
            <a href="acceso.php" class="btn btn-primary">Entrar</a>
            <a href="registro.php" class="btn btn-danger">Registrar</a>
    	</div>
    <?php
	}
	?>
    
  </div>
</div>
<div class="container">
  <div class="buscador"> <span class="span7 input-append">
    <form name="form" method="post">
      <input type="text" class="span6" placeholder="Buscar Aqui...">
      <button class="btn" data-original-title="Buscar">Buscar</button>
    </form>
    </span> <span class="span5"> <span class="publicarLista">
    <div id="categorymenu">
      <nav class="subnav">
        <ul>
          <li><a href="publicar.php" class="btn btn-success btn-large">Publicar</a></li>
          <li class="paddings"><a href="#">Contacto</a></li>
          <li class="paddings"><a href="#">Mercadeo</a></li>
          <li class="paddings"><a href="categorias.php">Categorias</a></li>
        </ul>
      </nav>
    </div>
    </span> </span> </div>
</div>

<!--Menu Principal-->
<?php /*?> <div class="container">
    <div id="categorymenu">
      <nav class="subnav">
        <ul class="nav-pills categorymenu container">
          <li> <a class="active home" href="index.php"><i class="icon-home icon-white font18"></i> <span> Inicio</span></a></li>
          <li><a>Categorias</a>
            <div>
              <ul>
                <li><a href="#">Accesorios para carros</a> </li>
                <li><a href="#">Animales y Mascotas</a> </li>
                <li><a href="#">C&aacute;maras y Accesorios</a> </li>
                <li><a href="#">Celulares y Teléfonos</a> </li>
                <li><a href="#">Computación</a> </li>
                <li><a href="#">Consolas y Videojuegos</a> </li>
                <li><a href="#">Computaci&oacute;n</a> </li>
                <li><a href="#">Deportes y Fitness</a> </li>
                <li><a href="#">Electrodom&eacute;sticos</a> </li>
                <li><a href="#">Electr&oacute;nica, Audio y Video</a> </li>
              </ul>
            </div>
          </li>
          <li><a>Publicar Producto</a></li>
          <li><a>Registrate</a></li>
          <li><a>Ingresar</a></li>
          <li><a>Reportar Abuso</a></li>
          <li> <a>Nosotros</a></li>
          <li> <a>Contacto</a></li>
          <li><a>Politicas</a> </li>
        </ul>
      </nav>
    </div>
  </div><?php */?>
<!--Menu Principal-->