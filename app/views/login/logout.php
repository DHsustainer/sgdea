<?php
//cerrar sesion... redirecciona a index.php
	session_start();
	//validacion que el nos dice...
	#$_SESSION['usuario'] = "";
	//session_unregister("usuario");
	//session_unregister("perfil");	
	header("Location: ".HOMEDIR.DS."login".DS);	
?>