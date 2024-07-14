<?php 



session_start();



date_default_timezone_set("America/Bogota");



require_once "lib.0.9.5/nusoap.php";



require_once "variables_interface_copiar.php";



error_reporting( E_ALL & ~E_NOTICE );



if($_GET['db'] != ''){



	$db_name = $_GET['db'];



}



/*$dbconnection = @mysql_connect( $db_server, $db_username, $db_password ); 



if( $dbconnection){



	mysql_set_charset("utf8");



    $db = mysql_select_db( $db_name );



}



if( !$dbconnection || !$db ) { 



    echo( "<br>" );



    echo( "- La conexion con la Base de datos ha fallado: ".mysql_error()."<br>" );



    exit;



}



else {



    echo( "<br>" );



    echo( "- He establecido conexion con la Base de datos.<br>" );



}*/

$MySqlconn = mysqli_init();

$MySqlconn->options(MYSQLI_OPT_CONNECT_TIMEOUT, 120);

$MySqlconn = new MySQLi($db_server, $db_username, $db_password, $db_name);

if ($MySqlconn ->connect_errno) {

    return json_encode("Fallo al conectar a MySQL: (" . $MySqlconn ->connect_errno . ") " . $MySqlconn ->connect_error."<br>");

}else{

    $MySqlconn ->set_charset("utf8");

    //return json_encode("Conectado a MySQL");

}



echo "<br>";



echo "<br>";



echo "----Inicio";



echo "<br>";



echo "<br>";



$objeto = new nusoap_client("https://expedientesdigitales.com/synchronize_db_structure/ServiceStructureEspejoDB.wsdl", true);



$error = $objeto->getError();



if ($error) {



	echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";



}



$array_asociativo =  array();



$array_asociativo['val1'] = "";



$result = $objeto->call("getStructureEspejoDB", $array_asociativo );



$r_sp = "";



if ($objeto->fault) {



        $r_sp = "<pre>";



        $r_sp .= print_r($result);



        $r_sp .= "</pre>";



        echo $r_sp;



        exit;



}else{



	$error = $objeto->getError();



	if ($error) {



		$r_sp = "<pre>" . $error . "</pre>";



		echo $r_sp;



        exit;



	}



	else {



		#echo $result;



		$r_sp = json_decode($result);



		#echo "El libro ID 1 es: ".$result;



	}



}



$omitir_tablas = array('');



$omitir_campostabla = array('');



$contador = 0;



foreach ($r_sp as $key => $arr_value) {



	$tabla = $arr_value[0];



	$Field = $arr_value[1];



	$Type = $arr_value[2];



	$Null = $arr_value[3];



	$Key  = $arr_value[4];



	$Default = $arr_value[5];



	$Extra = $arr_value[6];



	$ISNULL = ' NULL ';



	if($Null == 'NO'){



		$ISNULL = ' NOT NULL ';



	}



	$ISDefault = '';



	if($Default != 'NULL'){



		$ISDefault = " Default $Default ";



	}



	$ISExtra = '';



	if($Extra != ''){



		$ISExtra = $Extra;



	}



	$ISKey = '';



	if($Key == 'PRI'){



		$ISKey = 'S';



	}



	$CREATE = 'N';



	if (!in_array($tabla.''.$Field, $omitir_campostabla))



	{



		/*CREAR TABLA SI NO EXISTE*/



		$sql = "SELECT COUNT(*) AS count FROM information_schema.tables WHERE table_name = '$tabla' and TABLE_SCHEMA =  '$db_name'";

		$result =  $MySqlconn -> query($sql);

		while( $currow = $result -> fetch_assoc() ) {

			if($currow['count'] == 0){

				echo $qry = "CREATE TABLE IF NOT EXISTS `$tabla` (`borrador` int(11) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

				$MySqlconn -> query($qry);

				echo "<br>";

				$CREATE = 'S';

				$contador++;

			}

		}

		if (!in_array($tabla, $omitir_tablas))



		{



			$sql = "SHOW COLUMNS FROM $tabla WHERE Field = 'v$Field'";

			$result =  $MySqlconn -> query($sql);

			if ($result->num_rows == 1 ){



				$sql .= " and Type <> '$Type' ";

				$result2 =  $MySqlconn -> query($sql);

				if ($result2->num_rows == 1 ){



					$ISExtra2 = $ISExtra;

					if($ISExtra == 'auto_increment'){

						$ISExtra2 .= " ,ADD PRIMARY KEY (`$Field`) ";

					}



					if($Default == 'CURRENT_TIMESTAMP'){

						$ISExtra2 = "";

					}



					if($Default != ""){

						if($Default == 'CURRENT_TIMESTAMP'){

							$Default = " Default $Default";

						}else{

							$Default = " Default '$Default'";

						}

					}					



					echo $qry = "alter table $tabla modify `$Field` $Type $ISNULL $ISExtra2 $Default;";

					$MySqlconn -> query($qry);

					echo "<br>";	

					$contador++;

				}

			}else{

				$ISExtra2 = $ISExtra;

				if($ISExtra == 'auto_increment'){

					$ISExtra2 .= " ,ADD PRIMARY KEY (`$Field`) ";

				}

				if($Default == 'CURRENT_TIMESTAMP'){

					$ISExtra2 = "";

				}

				if($Default != ""){

					if($Default == 'CURRENT_TIMESTAMP'){

						$Default = " Default $Default";

					}else{

						$Default = " Default '$Default'";

					}

				}

				echo $qry = "alter table $tabla add `$Field` $Type $ISNULL $ISExtra2 $Default;";

				$MySqlconn -> query($qry);

				echo "<br>";

				$contador++;

				if($ISKey == 'S' && $ISExtra != 'auto_increment'){

					echo $qry = "ALTER TABLE `$tabla` ADD PRIMARY KEY (  `$Field` );";

					$MySqlconn -> query($qry);

					echo "<br>";

					$contador++;

				}

				if($CREATE == 'S'){

					echo $qry = "alter table `$tabla` drop `borrador`;";

					$MySqlconn -> query($qry);

					echo "<br>";

					$contador++;

				}



			}



		}



	}



}



/********ACTUALIZAR CHARSET******/

$sql = "SELECT engine, table_collation, CCSA.character_set_name, `table_name`

FROM information_schema.`TABLES` T,

       information_schema.`COLLATION_CHARACTER_SET_APPLICABILITY` CCSA

WHERE CCSA.collation_name = T.table_collation

  AND T.table_schema = '$db_name';";

$result = $MySqlconn -> query($sql);

while( $row = $result -> fetch_assoc() ) {

	echo "OPTIMIZE ".$row['table_name']."<br>";

	$MySqlconn -> query("ALTER TABLE ".$row['table_name']." CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci");

	$MySqlconn -> query("ALTER TABLE ".$row['table_name']." ENGINE=INNODB;");

	$MySqlconn -> query("OPTIMIZE TABLE ".$row['table_name'].";");

}

/*campos*/

$sql2 = "SELECT * FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = '$db_name' AND DATA_TYPE IN ('enum', 'varchar', 'char', 'text', 'mediumtext', 'longtext', 'tinytext');";

$resultf = $MySqlconn -> query($sql2);

while( $currow = $resultf -> fetch_assoc() ) {

	$MySqlconn -> query("ALTER TABLE ".$currow['TABLE_NAME']." MODIFY ".$currow['COLUMN_NAME']." CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci;");

}



/********/

$result = $MySqlconn -> query("SELECT * FROM plantillas_email");

$cantidad_registros = $result->num_rows;

echo "<br>";



echo "<br>";



echo "----Fin";



echo "<br>";



echo "<br>";



echo "consultas ejecutadas ".$contador;



echo "<br>";



echo "<br>";



echo "----INICIO AGREGAR DATOS TABLAS MAESTRAS";



echo "<br>";



echo "<br>";



$objeto = new nusoap_client("https://expedientesdigitales.com/synchronize_db_structure/ServiceTablasDatosDefault.wsdl", true);



$error = $objeto->getError();



if ($error) {



	echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";



}



$array_asociativo =  array();



$array_asociativo['val1'] = $cantidad_registros;



$result = $objeto->call("getTablasDatosDefault", $array_asociativo );

var_dump($result);

$r_sp = "";



if ($objeto->fault) {



        $r_sp = "<pre>";



        $r_sp .= print_r($result);



        $r_sp .= "</pre>";



        echo $r_sp;



        exit;



}else{



	$error = $objeto->getError();



	if ($error) {



		$r_sp = "<pre>" . $error . "</pre>";



		echo $r_sp;



        exit;



	}



	else {



		#echo $result;



		$r_sp = $result;



		#echo "El libro ID 1 es: ".$result;



	}



}



$arrr = explode('|',$r_sp);



foreach ($arrr as $key => $value) {



	echo $value.';';



	$MySqlconn -> query($value.';');



	echo "<br>";



}



echo "<br>";



echo "<br>";



echo "---FIN AGREGAR DATOS TABLAS MAESTRAS";



echo "<br>";



echo "<br>";



echo "<br>";



echo "<br>";



echo "---ACTUALIZAR USUARIOS FUNCIONALIDAD SOBRE GESTION";



echo "<br>";



echo "<br>";



$sql = "INSERT INTO usuarios_funcionalidades(user_id, id_funcionalidad, valor)



      SELECT t.user_id,t.id,t.valor



      FROM (SELECT usuarios.user_id, funcionalidades.id, '0' as valor FROM usuarios, funcionalidades) t LEFT JOIN 



        usuarios_funcionalidades uf on t.user_id = uf.user_id and t.id = uf.id_funcionalidad where uf.user_id is null ;";



$MySqlconn -> query($sql);



/*Archivo Gesti¨®n*/



$sql = "update usuarios_funcionalidades set valor = '1' where id_funcionalidad = (SELECT id FROM `funcionalidades` where nombre_campo = 'archivo_gestion');";



$MySqlconn -> query($sql);



echo "---ACTUALIZAR ADMINITRADORES CON LOS PERMISOS NUEVOS";



echo "<br>";



echo "<br>";



/*Permisos Administradores*/



$sql = "update usuarios_funcionalidades uf inner join usuarios u on uf.user_id = u.user_id



set uf.valor = '1'



where uf.id_funcionalidad in(SELECT id FROM `funcionalidades` where nombre_campo in('usuarios','areas_trabajo','otras_herramientas','permisos_usuarios','p_suscriptores','modulos_externos','recepcion')) and u.IsSuperAdministrador = '1'";



$MySqlconn -> query($sql);



echo "---ACTUALIZAR USUARIOS CON PERMISO DE RECEPCION";



echo "<br>";



echo "<br>";



/*Permisos recepcion para los que hayan creado un espediente*/



$sql = "update usuarios_funcionalidades uf inner join usuarios u on uf.user_id = u.user_id inner join gestion g on u.user_id = g.usuario_registra



set uf.valor = '1'



where uf.id_funcionalidad in(SELECT id FROM `funcionalidades` where nombre_campo in('recepcion'))



group by g.usuario_registra;";



$MySqlconn -> query($sql);



$sql = "SELECT * FROM usuarios";



$result = $MySqlconn -> query($sql);



 while( $row = $result -> fetch_assoc() ) {



	$seccional = $row['seccional'];



	$area = $row['regimen'];



	$user_id = $row['user_id'];



	$id = $row['a_i'];



	$q_strx = "SELECT ciudad from seccional WHERE id='".$seccional."'";

	$result2 = $MySqlconn -> query($q_strx);

	while( $queryx = $result2 -> fetch_assoc() ) {



		$ciudad = $queryx["ciudad"];

	}



	$q_str = $MySqlconn -> query("delete from usuarios_configurar_accesos where user_id = '$user_id' and tabla = 'city' and id_tabla= '$ciudad'"); 



	$q_str = $MySqlconn -> query("INSERT INTO usuarios_configurar_accesos (user_id, tabla, id_tabla) VALUES ('$user_id', 'city', '$ciudad')");



	$q_str = $MySqlconn -> query("delete from usuarios_configurar_accesos where user_id = '$user_id' and tabla = 'oficina' and id_tabla= '$seccional'"); 



	$q_str = $MySqlconn -> query("INSERT INTO usuarios_configurar_accesos (user_id, tabla, id_tabla) VALUES ('$user_id', 'oficina', '$seccional')");



	$q_str = $MySqlconn -> query("delete from usuarios_configurar_accesos where user_id = '$user_id' and tabla = 'area' and id_tabla= '".$area.$seccional."'"); 



	$q_str = $MySqlconn -> query("INSERT INTO usuarios_configurar_accesos (user_id, tabla, id_tabla) VALUES ('$user_id', 'area', '".$area.$seccional."')");



	$q_str = $MySqlconn -> query("delete from usuarios_configurar_accesos where user_id = '$user_id' and tabla = 'usuario' and id_tabla= '".$id.$area.$seccional."'"); 



	$q_str = $MySqlconn -> query("INSERT INTO usuarios_configurar_accesos (user_id, tabla, id_tabla) VALUES ('$user_id', 'usuario', '".$id.$area.$seccional."')");



}



$sql = "INSERT into usuarios_configurar_firma_digital(user_id,campo1,campo2,campo3,campo4,campo5,campo6,campo7)



SELECT u.user_id,'nombre_usuario_firma','profesional_firma','nombre_area','celular_firma','email_firma','','numero_aleatorio' FROM usuarios u  left join usuarios_configurar_firma_digital uc on u.user_id = uc.user_id 



where uc.user_id is null";



$MySqlconn -> query($sql);



$sql = "SELECT * FROM dependencias_version";



$result = $MySqlconn -> query($sql);



if($result->num_rows <= 0){



	$sql = "INSERT INTO dependencias_version(nombre, estado) VALUES ('".date('Y')."','1')";

	$MySqlconn -> query($sql);



	$id_version = $MySqlconn -> insert_id;



	$sql = "update dependencias set id_version = '".$id_version."'";



	$MySqlconn -> query($sql);



	$sql = "update super_admin set id_version = '".$id_version."'";



	$MySqlconn -> query($sql);



	$sql = "update areas_dependencias set id_version = '".$id_version."'";



	$MySqlconn -> query($sql);



}



$url = '<img src="https://expedientesdigitales.com/app/views/assets/images/logo_expedientes2.png" width="150px">';



$sql = "update plantillas_email set contenido = REPLACE(contenido, '$url', '[elemento]LOGO[/elemento]');";



$MySqlconn -> query($sql);



$sql = "SELECT foto_perfil FROM `super_admin` order by id desc limit 1";



$result = $MySqlconn -> query($sql);

 while( $rdf = $result -> fetch_assoc() ) {



	$url = '<img src="http://pdi.colombiaceropapel.org/app/plugins/thumbnails/'.$rdf['foto_perfil'].'" width="150px">';

	$sql = "update plantillas_email set contenido = REPLACE(contenido, '$url', '[elemento]LOGO[/elemento]');";

	$MySqlconn -> query($sql);



}

/*ACTUALIZAR NOMBRE DE CAMPOS*/



@$MySqlconn -> query("ALTER TABLE `alertas` CHANGE `time` `fechahora` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP;");



@$MySqlconn -> query("ALTER TABLE `usuarios` CHANGE `f_caducidad` `f_caducidad` DATETIME NULL DEFAULT '2025-12-31 00:00:000';");



@$MySqlconn -> query("update `gestion` set version = '1' where version = '0';");



@$MySqlconn -> query("update `usuarios` set f_caducidad = '2025-12-31' where f_caducidad = '' or f_caducidad='0000-00-00' or f_caducidad is null ;");



#<img src="[elemento]LOGO[/elemento]" width="150px">



?>