<?php
session_start();
//archivo que contiene los registros de usuarios y otras opciones de adminsitracion
    include ('lib/ClaseBaseDatos.php');

    $conexion = new ConexionBaseDatos;
    $link = $conexion->Conectarse($conexion);

    $fecha = date("Y-m-d H:i:s");
    $ccaducidad = 10;
    $fecha_c = date_create($fecha);//aca le pasas la fecha actual o ala que le queres sumar los dias.
	date_modify($fecha_c, "-$ccaducidad minutes");//sumas los dias que te hacen falta.
	$f_inactivo = date_format($fecha_c, "Y-m-d H:i:s");//retornas la fecha en el formato que mas te guste.

    $ccaducidad = 15;
    $fecha_c = date_create($fecha);//aca le pasas la fecha actual o ala que le queres sumar los dias.
    date_modify($fecha_c, "-$ccaducidad minutes");//sumas los dias que te hacen falta.
    $f_caducidad = date_format($fecha_c, "Y-m-d H:i:s");//retornas la fecha en el formato que mas te guste.

	#echo "UPDATE usuario set estadochat = 0 where lastlogin < '$f_caducidad'";
    $con->Query("UPDATE usuarios set estadochat = 2 where lastlogin < '$f_inactivo' ");
    $con->Query("UPDATE usuarios set estadochat = 0 where lastlogin < '$f_caducidad' ");
?>