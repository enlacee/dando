<?php
if (!isset($_SESSION)) {
  session_start();
}

//error_reporting(1);
date_default_timezone_set("America/Caracas");

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', realpath(dirname(__FILE__)) . DS);
define('APP_PATH', ROOT . DS);
include APP_PATH."/config.php";

abstract class Config
{

	//Attribute is defined as Array, returns system settings
	protected $dbh; //DB System
	/**
	* Connect to the database
	* Returns valid data Connection
	* 
	* @access protected
	*/
	protected function connectDataBase()
	{
		$IncArray = $this->configArray = ConfigSQL::configDB();
				
        try {
        	$dbConnect =  $this->dbh = new PDO('mysql:host='.$IncArray["servidor"].';
											dbname='.$IncArray["basedato"].'', 
											$IncArray["usuario"], 
											$IncArray["clave"]);
			$dbConnect->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
			$dbConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $dbConnect->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES utf8");                        
			return $dbConnect;
        } 
		catch (PDOException $e){	
           die ("Error");
        }
	}
	
	
	
	/**
	* Get IP
	* Return IP Browser
	* 
	* @access protected
	*/
	protected function getIP()
	{
		
		if (isset($_SERVER)) {
			if (isset($_SERVER["HTTP_CLIENT_IP"])) {
					
				return $_SERVER["HTTP_CLIENT_IP"];	
			} 
			elseif(isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {			
				return $_SERVER["HTTP_X_FORWARDED_FOR"];		
			} 
			elseif(isset($_SERVER["HTTP_X_FORWARDED"])) {		
				return $_SERVER["HTTP_X_FORWARDED"];		
			} 
			elseif(isset($_SERVER["HTTP_FORWARDED_FOR"])) {		
				return $_SERVER["HTTP_FORWARDED_FOR"];	
			} 
			elseif(isset($_SERVER["HTTP_FORWARDED"])) {						
				return $_SERVER["HTTP_FORWARDED"];	
			} else {		
				return $_SERVER["REMOTE_ADDR"];
			}
		} else {	
			return $_SERVER["REMOTE_ADDR"];	
		}
	}

}


class Apps extends Config
{
	private $_db;
	private $_hasSendResetearClave;
	private $_setRegistroUsuarios;
	private $_accesoUsuario;
	private $_getSaludoBienvenida;
	private $_getPublicaciones;
	private $_getPublicacionDetalle;
	private $_setComprar;
	private $_getUltimasPlublicaciones;
	private $_getCategorias;
	private $_getTopTen;

	
	/**
	* Initializes all attributes
	* 
	* @access public
	*/
	public function __construct()
	{
		$this->_db							= parent::connectDataBase();
		$this->_hasSendResetearClave		= array();
		$this->_setRegistroUsuarios			= array();
		$this->_accesoUsuario				= array();
		$this->_getSaludoBienvenida			= array();
		$this->_getPublicaciones			= array();
		$this->_getPublicacionDetalle		= array();
		$this->_setComprar					= array();
		$this->_getUltimasPlublicaciones	= array();
		$this->_getCategorias				= array();
		$this->_getTopTen					= array();

	}
	

	/**
	* Corrige errores de los acentos
	* 
	* @access private
	*/
	static public function acentos($str)
	{
		$procesa = array(
						'�' => '&aacute;',
						'�' => '&eacute;',
						'�' => '&iacute;',
						'�' => '&oacute;',
						'�' => '&uacute;',
						'�' => '&ntilde;',
						'�' => '&Ntilde;',
						'�' => '&auml;',
						'�' => '&euml;',
						'�' => '&iuml;',
						'�' => '&ouml;',
						'�' => '&uuml;',
						'á' => '&aacute;', 
						'é' => '&eacute;', 
						'í' => '&iacute;', 
						'ó' => '&oacute;', 
						'ú' => '&uacute;',
						'Á' => '&aacute;', 
						'É' => '&eacute;', 
						'Í' => '&iacute;', 
						'Ó' => '&oacute;', 
						'Ú' => '&uacute;', 
						'ñ' => '&ntilde;',
						'Ñ' => '&Ntilde;', 
						'ä' => '&auml;', 
						'ë' => '&euml;',
						'ï' => '&iuml;', 
						'ö' => '&ouml;', 
						'ü' => '&uuml;'); 
		return strtr( $str , $procesa );
		 
		 
	}
	
	

	
	/**
	* Modo de ocnsulta
	*/
	private function acentosQuery()
    {
        return $this->dbh->query("SET NAMES 'utf8'");    
    }
	
	
	
	
	public function enviarCorreo($nombre,$email,$asunto,$contenido,$fromEmail,$responderaNombre, $responderaEmail){
		
		//Correo a donde llegara este email
		$to = $nombre.'<'.$email.'>';
		//Asunto: Se muestra en la bandeja de entrada
		$subject = $asunto;
		//Contenido del email
		$body = $contenido;
		//Desde donde se envia este email
		$headers = "From: ".$fromEmail."\r\n";
		//Enviar a otros de forma oculta CCO
		$headers .= 'Cc: omaira@tb.com.ve' . "\r\n"; //Se muestra en el correo del usuario
		$headers .= 'Bcc: maurox1987@gmail.com' . "\r\n"; //No se muestra en el correo del usuario
		//Responder a est correo
		$headers .= "Reply-To: ".$responderaNombre." <".$responderaEmail.">" . "\r\n";
		//El tipo de documento
		$headers  .= 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=UTF-8\r\n' . "\r\n";
		//Funcion para adjuntar todo y enviarlo
		$success = mail($to, $subject, $body, $headers);	
	}
	
	
	
	
	/**
	* Obtiene informacion para resetear contraseña
	*/
	public function hasSendResetearClave($email)
	{
		$sql = "SELECT email FROM usuarios WHERE email =? ;";
		$sqlQuery = $this->_db->prepare($sql);
		$sqlQuery->setFetchMode(PDO::FETCH_ASSOC);
	
		if($sqlQuery->execute( array( $email ) )){
	
			while($row = $sqlQuery->fetch()){
	
				$verificaEmail = $this->_hasSendResetearClave[] = $row;
			}
			
				if(count($verificaEmail) > 0){
					
					$sql = "SELECT nombres,clave,email FROM usuarios WHERE email =? ;";
					$sqlQuery = $this->_db->prepare($sql);
					$sqlQuery->setFetchMode(PDO::FETCH_ASSOC);
				
					if($sqlQuery->execute( array( $email ) )){
				
						while($row = $sqlQuery->fetch()){
				
							$this->_getRecords[] = $row;
						}
						
						$nombreConf	= $this->_getRecords[0]["nombres"];
						$claveConf 	= $this->_getRecords[0]["clave"];
						$emailConf 	= $this->_getRecords[0]["email"];
						
							//Correo a donde llegara este email
							$to = $nombreConf.'<'.$emailConf.'>';
							//Asunto: Se muestra en la bandeja de entrada
							$subject = 'Solicitud para resetear su clave de acceso';
							//Contenido del email
							$body = '
							<p>Estimado '.$nombreConf.',</p>
							<p>Hemos recibido su solicitud para resetear su clave. Si usted no realizo esta peticion por favor omita este mensaje y comuniquelo a contacto@dando-dando.com</p>
							<p>Haga <a href="http://www.dando-dando.com/resetear-clave.php?reset='.$claveConf.'&emailclavegenerada='.$emailConf.'">Clic Aqui</a> para resetear su clave de acceso.</p>
							<p><strong>IP: </strong>'.$_SERVER['REMOTE_ADDR'].'</p>
							<p><strong>Navegador: </strong>'.$_SERVER['HTTP_USER_AGENT'].'</p>
							<p><strong>Fecha: </strong>'.date("d/m/Y").'</p>
							';
							//Desde donde se envia este email
							$headers = "From: contacto@dando-dando.com\r\n";
							//Responder a est correo
							$headers .= " <no-responder@dando-dando.com>" . "\r\n";
							//El tipo de documento
							$headers  .= 'MIME-Version: 1.0' . "\r\n";
							$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
							//Funcion para adjuntar todo y enviarlo
							$success = mail($to, $subject, $body, $headers);
							
							return header("Location: resetear-clave.php?email=1");
					}
					
				}else{
					return header("Location: resetear-clave.php?email=0");	 
				}
		}
	}
	
	
	
	/*
	*	Edita informacion de la solicitud para resetear contraseña
	*/
	public function updateUserResetPass($email,$claveValida){
	
		$key 			= rand("0000000",9999999);
		$keyEncriptada 	= md5($key);
	
		$sql = "UPDATE 
					usuarios 
				SET 
					clave=:clave
				WHERE 
					email =:email
				AND
					clave=:claveValida";
		$sqlQuery = $this->_db->prepare($sql);

		$sqlQuery->bindValue(":clave",			$keyEncriptada,	PDO::PARAM_STR);
		$sqlQuery->bindValue(":email",			$email,			PDO::PARAM_STR);
		$sqlQuery->bindValue(":claveValida",	$claveValida,	PDO::PARAM_STR);
		$sqlQuery->execute();
		
			//Envia el email con la informacion
			$sql = "SELECT * FROM usuarios WHERE email =? ;";
			$sqlQuery = $this->_db->prepare($sql);
			$sqlQuery->setFetchMode(PDO::FETCH_ASSOC);
			
				if($sqlQuery->execute( array( $email ) )){
				
					while($row = $sqlQuery->fetch()){
				
						$this->_getRecords[] = $row;
					}
					
					$nombre		= $this->_getRecords[0]["nombre"];
					$emailConf 	= $this->_getRecords[0]["email"];
					
						//Correo a donde llegara este email
						$to = $nombre.'<'.$emailConf.'>';
						//Asunto: Se muestra en la bandeja de entrada
						$subject = 'Su nueva clave se genero correctamente.';
						//Contenido del email
						$body = '
						<p>Estimado '.$nombre.',</p>
						<p>Su clave se genero correctamente, ahora puede ingresar a su cuenta y cambiarla.</p>
						<p><strong>Su nueva clave es:</strong> '.$key.'</p>
						<p>Haga <a href="http://www.dando-dando.com/acceso.php">Clic Aqui</a> para ingresar a su cuenta.</p>
						<p><i>Muchas Gracias.</i></p>
						';
						//Desde donde se envia este email
						$headers = "From: contacto@dando-dando.com\r\n";
						//Responder a est correo
						$headers .= " <no-responder@dando-dando.com>" . "\r\n";
						//El tipo de documento
						$headers  .= 'MIME-Version: 1.0' . "\r\n";
						$headers .= 'Content-type: text/html; charset=UTF-8\r\n' . "\r\n";
						//Funcion para adjuntar todo y enviarlo
						$success = mail($to, $subject, $body, $headers);
						
						return header("Location: resetear-clave.php?nuevaClave=2");
				}
	}
	
	
	
	
	
	
	

	/**
	* Registro de usuarios
	*/
	public function setRegistroUsuarios($privilegio,$nombres,$username,$email,$tlfcelular,$tlfcasa,$clave,$empresa,$direccion,$ciudad,$pais,$fecharegistro,$horaregistro,$clavealeatoria,$estadousuario,$ip){
		
		
		//Si el email existe se detiene la aplicación, por que alguién trato de registrarlo forzando el sistema.
		$sql = "SELECT email FROM usuarios WHERE email =? ;";
		$sqlQuery = $this->_db->prepare($sql);
		$sqlQuery->setFetchMode(PDO::FETCH_ASSOC);
		
		if($sqlQuery->execute( array( $email ) )){
			while($row = $sqlQuery->fetch()){

				$emailCuenta = $this->_getRecords[] = $row;
			}
			if(count($emailCuenta) > 0){
				return exit();
			}
		}
	

		//Ingresa el registro
		$sql = "INSERT INTO 
						usuarios  
							(privilegio, nombres, username, email, tlfcelular, tlfcasa, clave, empresa, direccion, ciudad, pais, fecharegistro, horaregistro, clavealeatoria, estadousuario, ip) 
						VALUES
							(:privilegio,:nombres,:username,:email,:tlfcelular,:tlfcasa,:clave,:empresa,:direccion,:ciudad,:pais,:fecharegistro,:horaregistro,:clavealeatoria,:estadousuario,:ip) ";
		
		$sqlQuery = $this->_db->prepare($sql);
		$sqlQuery->bindValue(":privilegio",		$privilegio,		PDO::PARAM_STR);
		$sqlQuery->bindValue(":nombres",		$nombres,			PDO::PARAM_STR);
		$sqlQuery->bindValue(":username",		$username,			PDO::PARAM_STR);
		$sqlQuery->bindValue(":email",			$email,				PDO::PARAM_STR);
		$sqlQuery->bindValue(":tlfcelular",		$tlfcelular,		PDO::PARAM_STR);
		$sqlQuery->bindValue(":tlfcasa",		$tlfcasa,			PDO::PARAM_STR);
		$sqlQuery->bindValue(":clave",			$clave,				PDO::PARAM_STR);
		$sqlQuery->bindValue(":empresa",		$empresa,			PDO::PARAM_STR);
		$sqlQuery->bindValue(":direccion",		$direccion,			PDO::PARAM_STR);
		$sqlQuery->bindValue(":ciudad",			$ciudad,			PDO::PARAM_STR);
		$sqlQuery->bindValue(":pais",			$pais,				PDO::PARAM_STR);
		$sqlQuery->bindValue(":fecharegistro",	$fecharegistro,		PDO::PARAM_STR);
		$sqlQuery->bindValue(":horaregistro",	$horaregistro,		PDO::PARAM_STR);
		$sqlQuery->bindValue(":clavealeatoria",	$clavealeatoria,	PDO::PARAM_STR);
		$sqlQuery->bindValue(":estadousuario",	$estadousuario,		PDO::PARAM_STR);
		$sqlQuery->bindValue(":ip",				$ip,				PDO::PARAM_STR);
		$sqlQuery->execute();
		
		
		//Enviamos el correo de bienvenida
		
		//Correo a donde llegara este email
		$to = $nombres.' <'.$email.'>';
		
		//Asunto: Se muestra en la bandeja de entrada
		$subject = 'Bienvenido '.$nombres.' a dando-dando.com';
		
		//Contenido del email
		$body = '
		<div style="border:5px solid #EEE; margin:0; width:100%; max-width:600px; padding:6px 12px; -webkit-border-radius: 5px; -moz-border-radius: 5px; border-radius: 5px; font-family:Tahoma, Geneva, sans-serif; font-size:13px; color:#4F4F4F;">
		<p>Hola <strong style="text-transform:capitalize !important;">'.$nombres.'</strong>, Bienvenido a <a href="http://www.dando-dando.com">dando-dando.com</a>, el mejor sistema de trueque en l&iacute;nea.</p>
		<p>Esperemos que puedas disfrutar de nuestra plataforma y sacarle todo el partido para intercambiar lo que quieras.</p>
		<p>Para entrar a tu cuenta has clic en este enlace <a href="http://www.dando-dando.com/acceso.php">www.dando-dando.com/acceso.php</a></p>
		<p>Comparte esto con tus amigos en <a href="https://www.facebook.com/">Facebook</a> y <a href="https://www.facebook.com/">Twitter</a></p>
		<p style="font-style:italic;">Muchas Gracias.</p>
		
		<p style="margin:20px 0; text-align:center;"><img src="http://www.dando-dando.com/images/logo.png" alt="SimpleOne" title="SimpleOne"></p>
		
		</div>
		<p style="text-align:center; margin:20px 0 5px 0; font-size:10px; font-family:Tahoma, Geneva, sans-serif; color:#979797">&copy; 2014 dando-dando.com</p>';
		
		//Desde donde se envia este email
		$headers = "From: dando-dando@no-responder.com\r\n";
		
		//Responder a est correo
		$headers .= "Reply-To: dando-dando.com <no-responder@dando-dando.com>" . "\r\n";
		
		//El tipo de documento
		$headers  .= 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=UTF-8\r\n' . "\r\n";
		
		//Funcion para adjuntar todo y enviarlo
		$success = mail($to, $subject, $body, $headers);
		return header("Location: registro.php?registro=1");
	}






	/**
	* Acceso de usuario
	*/
	public function accesoUsuario($email,$clave)
	{
		self::acentosQuery();
		$sql = "SELECT email FROM usuarios WHERE email= ? ;";
	
		$sqlQuery = $this->_db->prepare($sql);
		$sqlQuery->setFetchMode(PDO::FETCH_ASSOC);
	
		if($sqlQuery->execute( array( $email ) )){
	
			while($row = $sqlQuery->fetch()){
	
				$resultadoUser = $this->_accesoUsuario[] = $row;
			}
			if (count($resultadoUser) > 0) {
				$sql = "SELECT clave FROM usuarios WHERE clave= ? ";
				$sqlQuery = $this->_db->prepare($sql);
				$sqlQuery->setFetchMode(PDO::FETCH_ASSOC);

				if($sqlQuery->execute( array( $clave ) )){
					while($row = $sqlQuery->fetch()){
			
						$resultadoPass = $this->_accesoUsuario[] = $row;
					}
					
					if (count($resultadoPass) > 0) {	
						$sql = "SELECT usuarioID, email,clave FROM usuarios WHERE email= ? AND clave= ? ;";
						$sqlQuery = $this->_db->prepare($sql);
						$sqlQuery->setFetchMode(PDO::FETCH_ASSOC);
					
						if($sqlQuery->execute( array( $email, $clave ) )){
							while($row = $sqlQuery->fetch()){
					
								$resultadoAll = $this->_accesoUsuario[] = $row;
							}
							
							if (count($resultadoAll) > 0) {
								$_SESSION["email"] = $email;                                                                
                                                                $_SESSION['usuarioID'] = $resultadoAll['usuarioID'];                                                                
								return header("Location: index.php"); 
								
							} else{
								return header("Location: acceso.php?informacionnull=0");
							}
						}						
					}else{
						return header("Location: acceso.php?clavenull=1");	
					}
				}
			} else{
				
				return header("Location: acceso.php?emailnull=2");	
			}
		}
	}




	/**
	* Bienvenida al usuario
	*/
	public function getSaludoBienvenida($email)
	{
		$sql = "SELECT nombres,email FROM usuarios WHERE email =? ;";
	
		$sqlQuery = $this->_db->prepare($sql);
		$sqlQuery->setFetchMode(PDO::FETCH_ASSOC);

		if($sqlQuery->execute( array( $email ) )){
	
			while($row = $sqlQuery->fetch()){
	
				$this->_getSaludoBienvenida[] = $row;
			}
		}
		return $this->_getSaludoBienvenida;
	}
	
	/**
	* Muestra publicaciones
	*/
	public function getPublicaciones($categoriaID = '')
	{
            Apps::acentosQuery();
            $sql = "SELECT * FROM publicaciones WHERE productoestado='disponible' ";
            if (!empty($categoriaID)) {
                $sql .= "AND categoriaID = {$categoriaID} ";
            }
            $sql .= "ORDER BY publicacionID DESC ";
            
            $sqlQuery = $this->_db->query($sql);
            $sqlQuery->setFetchMode(PDO::FETCH_ASSOC);
            $rs = $sqlQuery->fetchAll();
            
            return $rs;
	}
	


	/**
	* Muestra detalles de una publicacion OPTIMIZAR segun
	*/
	public function getPublicacionDetalle($id, $limit = '',$sqlOption = '')
	{
            Apps::acentosQuery();
            //$sql = "SELECT * FROM publicaciones WHERE publicacionID = ? ;";
            $sql = "SELECT ";
            if (!empty($sqlOption)) {
                if($sqlOption == 'basic') {
                    $sql .= "publicaciones_images.id, publicaciones_images.nombre ";
                }
            }else {
                $sql .= "* ";
            }
            $sql .= " FROM publicaciones, publicaciones_images 
            WHERE publicaciones_images.publicacionID  = ? 
            AND publicaciones.publicacionID = ? ";
            if (!empty($limit) && $limit > 0) {
               $sql .="LIMIT $limit ";
            }

            $sqlQuery = $this->_db->prepare($sql);
            $sqlQuery->setFetchMode(PDO::FETCH_ASSOC);
            $rs = false;
            if($sqlQuery->execute( array( $id, $id ) )) {
                $rs = $sqlQuery->fetchAll();
            }
            
            return $rs;
	}

	/**
	* Hace el trueque o compra un producto
	* Envia los correos al vendedor y comprador
	*/
	public function setComprar($compradopor,$compradofecha,$id,$idEncriptado)
	{
		Apps::acentosQuery();
		$sql = "UPDATE 
					publicaciones 
				SET 
					compradopor=:compradopor, compradofecha=:compradofecha, productoestado=:productoestado 
				WHERE 
					publicacionID =:id";
		$sqlQuery = $this->_db->prepare($sql);
		$sqlQuery->bindValue(":compradopor",	$compradopor,	PDO::PARAM_STR);
		$sqlQuery->bindValue(":compradofecha",	$compradofecha,	PDO::PARAM_STR);
		$sqlQuery->bindValue(":productoestado",	"comprado",		PDO::PARAM_STR);
		$sqlQuery->bindValue(":id",				$id,			PDO::PARAM_INT);
		$sqlQuery->execute();
		

		//Enviar email al publicador
		//Obtengo informacion comprador
		$sql = "SELECT * FROM usuarios WHERE email =? ;";
		$sqlQuery = $this->_db->prepare($sql);
		$sqlQuery->setFetchMode(PDO::FETCH_ASSOC);
		
		if($sqlQuery->execute( array( $_SESSION["email"] ) )){
			
			while($row = $sqlQuery->fetch()){
				
				$this->_getDetalleUsuario[] = $row;
			}
			$nombreComprador 	= $this->_getDetalleUsuario[0]["nombres"];
			$emailComprador 	= $this->_getDetalleUsuario[0]["email"];
			$telefonoComprador 	= $this->_getDetalleUsuario[0]["tlfcelular"];
		
				//Obtengo informacion (email) del vendedor para buscar informacion completa
				$sql = "SELECT * FROM publicaciones WHERE publicacionID =? ;";
				$sqlQuery = $this->_db->prepare($sql);
				$sqlQuery->setFetchMode(PDO::FETCH_ASSOC);
				
				if($sqlQuery->execute( array( $id ) )){
					
					while($row = $sqlQuery->fetch()){
						
						$this->_getDetalleVendedor[] = $row;
					}
					$emailVendedor 		= $this->_getDetalleVendedor[0]["publicadopor"];
					$productoVendedor 	= $this->_getDetalleVendedor[0]["titulo"];
					
					
					//Obtengo informacion completa del vendedor
					$sql = "SELECT * FROM usuarios WHERE email =? ;";
					$sqlQuery = $this->_db->prepare($sql);
					$sqlQuery->setFetchMode(PDO::FETCH_ASSOC);
					
					if($sqlQuery->execute( array( $emailVendedor ) )){
						
						while($row = $sqlQuery->fetch()){
							
							$this->_getDetalleVendedorCompleto[] = $row;
						}
						$nombreVendedorCompleto 	= $this->_getDetalleVendedorCompleto[0]["nombres"];
						$emailVendedorCompleto 		= $this->_getDetalleVendedorCompleto[0]["email"];
						$tlfcelularVendedorCompleto = $this->_getDetalleVendedorCompleto[0]["tlfcelular"];
						
							$contenidoVendedor = '<div style="border:5px solid #EBEBEB; margin:0 auto; width:100%; max-width:600px; padding:6px 12px; -webkit-border-radius: 5px; -moz-border-radius: 5px; border-radius: 5px; font-family:Tahoma, Geneva, sans-serif; font-size:13px; color:#4F4F4F;">
							<p>Estimado <strong style="text-transform:capitalize !important;">'.$nombreVendedorCompleto.'</strong>, alguien est&aacute; interesado en la publicaci&oacute;n de algunos de tus productos publicados en <a href="http://www.dando-dando.com">dando-dando.com</a>.</p>
							
							<p><strong>Interesado:</strong> '.$nombreComprador.' </p>
							<p><strong>Producto:</strong> '.$productoVendedor.'</p>
							<p>Puedes ponerte en contacto con el interesado:</p>
							<p><strong>Tel&eacute;fono:</strong> '.$telefonoComprador.' </p>
							<p><strong>Email:</strong> '.$emailComprador.'</p>
							<p style="font-style:italic;">Muchas Gracias por usar nuestra plataforma.</p>
							<p style="margin:20px 0; text-align:center;"><img src="http://www.dando-dando.com/images/logo.png" alt="SimpleOne" title="SimpleOne"></p>
							</div>
							<p style="text-align:center; margin:20px 0 5px 0; font-size:10px; font-family:Tahoma, Geneva, sans-serif; color:#979797">&copy; 2014 dando-dando.com</p>';
							self::enviarCorreo($nombreVendedor,$emailVendedor,"Trueque Realizado",$contenidoVendedor,"contacto@dando-dando.com","","no-responder@dando-dando.com");
							
							
							//Enviar email al comprador
							$contenidoComprador = '<div style="border:5px solid #EBEBEB; margin:0 auto; width:100%; max-width:600px; padding:6px 12px; -webkit-border-radius: 5px; -moz-border-radius: 5px; border-radius: 5px; font-family:Tahoma, Geneva, sans-serif; font-size:13px; color:#4F4F4F;">
<p>Hola <strong style="text-transform:capitalize !important;">'.$nombreComprador.'</strong>, felicitaciones, has realizado el trueque correctamente, ahora puedes ponerte en contacto con el due&ntilde;o del producto con la siguiente informaci&oacute;n.</p>


<p><strong>Nombre:</strong> '.$nombreVendedorCompleto.'</p>
<p><strong>Tel&eacute;fono:</strong> '.$tlfcelularVendedorCompleto.'</p>
<p><strong>Email:</strong> '.$emailVendedorCompleto .'</p>

<p style="font-style:italic;">Muchas Gracias por usar nuestra plataforma.</p>
<p style="margin:20px 0; text-align:center;"><img src="http://www.dando-dando.com/images/logo.png" alt="SimpleOne" title="SimpleOne"></p>

</div>
<p style="text-align:center; margin:20px 0 5px 0; font-size:10px; font-family:Tahoma, Geneva, sans-serif; color:#979797">&copy; 2014 dando-dando.com</p>';
							self::enviarCorreo($nombreComprador,$emailComprador,"Trueque Realizado",$contenidoComprador,"contacto@dando-dando.com","","no-responder@dando-dando.com");
							
							
							return header("Location: publicacion-detalle.php?publicacionID=".$idEncriptado."&comprado=1");
					
					}
				}
		}
	}
	
	
	
	
	
	
	/**
	* Muestra ultimas publicaciones
	*/
	public function getUltimasPlublicaciones()
	{
		Apps::acentosQuery();
		$sql = "SELECT * FROM publicaciones WHERE productoestado='disponible' ORDER BY publicacionID DESC LIMIT 0,4";
		$sqlQuery = $this->_db->query($sql);
		$sqlQuery->setFetchMode(PDO::FETCH_ASSOC);
		foreach($sqlQuery as $row){
	
			$this->_getUltimasPlublicaciones[]=$row;
				
		}
		return $this->_getUltimasPlublicaciones;
	}
	
	
	
	
	
	/**
	* Muestra categorias
	*/
	public function getCategorias($id = '')
	{
            Apps::acentosQuery();
            $sql = "SELECT * FROM categorias ";
            if (!empty($id)) {
                $sql .= "WHERE categoriaID = {$id} LIMIT 1 ";
            }  else {
                $sql .= "ORDER BY categoria ASC ";
            }            

            $sqlQuery = $this->_db->query($sql);
            $sqlQuery->setFetchMode(PDO::FETCH_ASSOC);
            $rs = false;
            foreach($sqlQuery as $row){
                $rs[] = $row;
            }
            return $rs;
	}
	
	
	
	
	
	
	
	
	
	
	/**
	* Publicar un producto
	*/
	public function setProducto($categoriaID,$publicadopor,$vendidopor,$estadopublicacion,$productonuevousado,$titulo,$video,$productoestado,$precio,$pais,$ciudad,$detalles,$ip,$fecha,$hora)
	{
		Apps::acentosQuery();
		$sql = "INSERT  INTO publicaciones 
                (categoriaID, publicadopor, vendidopor, estadopublicacion,productonuevousado , titulo, video, productoestado, precio, pais, ciudad, detalles, ip, fecha, hora) 
                VALUES
                (:categoriaID,:publicadopor,:vendidopor,:estadopublicacion,:productonuevousado,:titulo,:video,:productoestado,:precio,:pais,:ciudad,:detalles,:ip,:fecha,:hora) ;";
		$sqlQuery = $this->_db->prepare($sql);
		$sqlQuery->bindValue(":categoriaID",		$categoriaID,		PDO::PARAM_STR);
		$sqlQuery->bindValue(":publicadopor",		$publicadopor,		PDO::PARAM_STR);
		$sqlQuery->bindValue(":vendidopor",			$vendidopor,		PDO::PARAM_STR);
		$sqlQuery->bindValue(":estadopublicacion",	$estadopublicacion,	PDO::PARAM_STR);
                $sqlQuery->bindValue(":productonuevousado",	$productonuevousado,	PDO::PARAM_INT);                
		$sqlQuery->bindValue(":titulo",				$titulo,			PDO::PARAM_STR);		
		$sqlQuery->bindValue(":video",				$video,				PDO::PARAM_STR);
		$sqlQuery->bindValue(":productoestado",		$productoestado,	PDO::PARAM_STR);
		$sqlQuery->bindValue(":precio",				$precio,			PDO::PARAM_STR);
		$sqlQuery->bindValue(":pais",				$pais,				PDO::PARAM_STR);
		$sqlQuery->bindValue(":ciudad",				$ciudad,			PDO::PARAM_STR);
		$sqlQuery->bindValue(":detalles",			$detalles,			PDO::PARAM_STR);
		$sqlQuery->bindValue(":ip",					$ip,				PDO::PARAM_STR);
		$sqlQuery->bindValue(":fecha",				$fecha,				PDO::PARAM_STR);
		$sqlQuery->bindValue(":hora",				$hora,				PDO::PARAM_STR);
		$sqlQuery->execute();
                
                return $this->_db->lastInsertId(); // $last_id = $pdo->lastInsertId();	
                
}
	
		
	/**
	* Muestra publicaciones
	*/
	public function getTopTen()
	{
		Apps::acentosQuery();
		$sql = "SELECT * FROM publicaciones WHERE productoestado='disponible' ORDER BY publicacionID DESC";
		$sqlQuery = $this->_db->query($sql);
		$sqlQuery->setFetchMode(PDO::FETCH_ASSOC);
	
		foreach($sqlQuery as $row){
	
			$this->_getTopTen[]=$row;
				
		}
		return $this->_getTopTen;
	}
        
        
        /**
         * anb
         * ------------------------------- user -------------------------------
         * $ID = id o email
         */	
        public function getUser($id)
        {   
            $sql = "SELECT *FROM usuarios ";
            
            $pos = strpos($id, '@');
            if ($pos === false) {
                $sql.="WHERE usuarioID = {$id} ";
            } else {
                $sql.="WHERE email = '{$id}' ";
            }            
            $sql.="LIMIT 1 ";
            
            $sqlQuery = $this->_db->query($sql);
            $sqlQuery->setFetchMode(PDO::FETCH_ASSOC);
            $rs = $sqlQuery->fetch();            
            
            return $rs;           
        }
	
        /**
         * Actualizar datos del usuario.
         * @param type $array
         */
        public function updateUser($array) {
            $sql = "UPDATE usuarios SET "
                    . "nombres = ? "
                    . ",email = ? "
                    . ",tlfcelular = ? "
                    . ",tlfcasa = ? "
                    . ",empresa = ? "
                    . ",direccion = ? "
                    . ",ciudad = ? "
                    . ",pais = ? ";
            if (!empty($array['clave'])) {
                $sql .= ',clave = "'. $array['clave'] .'" ';
            }
            $sql .= "WHERE usuarioID = ? ";            
            
            $sqlQuery = $this->_db->prepare($sql);
            $sqlQuery->bindParam(1, $array['nombres']);
            $sqlQuery->bindParam(2, $array['email']);
            $sqlQuery->bindParam(3, $array['tlfcelular']);
            $sqlQuery->bindParam(4, $array['tlfcasa']);
            $sqlQuery->bindParam(5, $array['empresa']);
            $sqlQuery->bindParam(6, $array['direccion']);
            $sqlQuery->bindParam(7, $array['ciudad']);
            $sqlQuery->bindParam(8, $array['pais']);
            $sqlQuery->bindParam(9, $array['usuarioID']);

            $sqlQuery->execute();            
        }
        
        /*
         * Registrar imagenes (de publicacion)
         */
        public function insertImagesByPublicacion($array) {
            $sql = "INSERT  INTO publicaciones_images (publicacionID, nombre, fecha_registro, estado) VALUES (?, ?, ?, ?);";
            $sqlQuery = $this->_db->prepare($sql);
            $sqlQuery->bindParam(1, $array['publicacionID']);
            $sqlQuery->bindParam(2, $array['nombre']);
            $sqlQuery->bindParam(3, $array['fecha_registro']);            
            $sqlQuery->bindParam(4, $array['estado']);
            
            $sqlQuery->execute();
        }
        
        /**
         * lista de productos del usuario
         * @param type $usuarioID
         */
        public function getPublicacionesByUser($email, $status = '') {
            $sql = "SELECT *FROM publicaciones WHERE publicadopor = '{$email}' ";            
            if ($status == 1) {
                $sql.="AND productoestado = 'disponible' ";
            } else if ($status == 0) {
                $sql.="AND productoestado = 'comprado' "; // comprado = trueque echo
            }                        
            $sqlQuery = $this->_db->query($sql);
            $sqlQuery->setFetchMode(PDO::FETCH_ASSOC);
            $rs = $sqlQuery->fetchAll();            
            
            return $rs;
        }
        
        public function getPublicacionesByUserTrueque($email) {
            $sql = "SELECT *FROM publicaciones WHERE compradopor = '{$email}' AND productoestado = 'comprado' ";
            $sqlQuery = $this->_db->query($sql);
            $sqlQuery->setFetchMode(PDO::FETCH_ASSOC);
            $rs = $sqlQuery->fetchAll();
            return $rs;
        }
        
        /**
         * Obtener publicacion por ID
         * @param Integer $id
         * @return Array
         */
        public function getPublicacion($id) {
            $this->acentosQuery();
            $sql = "SELECT *FROM publicaciones WHERE publicacionID = {$id} LIMIT 1";
            $sqlQuery = $this->_db->query($sql);
            $sqlQuery->setFetchMode(PDO::FETCH_ASSOC);
            $rs = $sqlQuery->fetch();
            
            return $rs;              
        }
        
        /*
         * eliminar foto de (publicaciones_images)
         */
        public function deleteImagePublicacion($id) {
            
            $sql = "DELETE FROM publicaciones_images WHERE id = {$id}";            
            $sqlQuery = $this->_db->prepare($sql);
            $sqlQuery->execute();       
        }
        
        /**
         * eliminar publicacion (perfil)
         */
        public function deletePublicacion($id) {
            
            $sql = "DELETE FROM publicaciones WHERE publicacionID = {$id}";            
            $sqlQuery = $this->_db->prepare($sql);
            $sqlQuery->execute();       
        }        
        

        /**
         * Edicion de publicacion (producto)
         * @param type $array
         */
        public function updatePublicacion($array) {
            $sql = "UPDATE publicaciones SET "
                    . "categoriaID = ? "
                    . ",titulo = ? "
                    . ",video = ? "
                    . ",productonuevousado = ? "
                    . ",precio = ? "
                    . ",pais = ? "
                    . ",ciudad = ? "
                    . ",detalles = ? ";
            $sql .= "WHERE publicacionID = ? ";            
            
            $sqlQuery = $this->_db->prepare($sql);
            $sqlQuery->bindParam(1, $array['categoriaID']);
            $sqlQuery->bindParam(2, $array['titulo']);
            $sqlQuery->bindParam(3, $array['video']);
            $sqlQuery->bindParam(4, $array['productonuevousado']);
            $sqlQuery->bindParam(5, $array['precio']);
            $sqlQuery->bindParam(6, $array['pais']);
            $sqlQuery->bindParam(7, $array['ciudad']);
            $sqlQuery->bindParam(8, $array['detalles']);
            $sqlQuery->bindParam(9, $array['publicacionID']);

            $sqlQuery->execute();            
        }
        
        public function eliminarTrueque($id) {
            $sql = "UPDATE publicaciones SET "
                    . "compradopor = '' "
                    . ",compradofecha = '' "
                    . ",productoestado = 'disponible' ";
            $sql .= "WHERE publicacionID = {$id} ";
            $sqlQuery = $this->_db->prepare($sql);
            $sqlQuery->execute();
        }
	
	
}

$instancia = new Apps();