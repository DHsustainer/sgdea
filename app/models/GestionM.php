<?



// LLAMAMOS A LA ENTIDAD DEL OBJETO



include_once(ENTITIES.DS.'GestionE.php');







// CREAMOS LA CLASE QUE HEREDA DE LA ENTIDAD



	class MGestion extends EGestion{



		



		// CREAMOS EL CONSTRUCTOR DE LA CLASE



		function __construct()



		{				// ASIGNAMOS LOS VALORES AL OBJETO



				parent::SetId("");



				parent::SetRadicado("");



				parent::SetF_recibido("");



				parent::SetNombre_radica("");



				parent::SetFolio("");



				parent::SetTipo_documento("");



				parent::SetDependencia_destino("");



				parent::SetNombre_destino("");



				parent::SetFecha_vencimiento("");



				parent::SetEstado_respuesta("");



				parent::SetNum_oficio_respuesta("");



				parent::SetFecha_respuesta("");



				parent::SetObservacion("");



				parent::SetPrioridad("");



				parent::SetEstado_solicitud("");



				parent::SetSuscriptor_id("");



				parent::SetCiudad("");



				parent::SetUsuario_registra("");



				parent::SetEstado_archivo("");



				parent::SetOficina("");



				parent::SetId_dependencia_raiz("");



				parent::SetFecha_registro("");



				parent::SetMin_rad("");



				parent::SetDocumento_salida("");



				parent::SetUri("");



				parent::SetTs("");



				parent::SetObservacion2("");



				parent::SetTransferencia("");



				parent::SetRweb("");



				parent::SetVersion("");

				parent::SetTipo_almacen("");

				parent::SetUbicacion_fisica("");

				parent::SetEstado_personalizado("");



				parent::SetCampot1("");

				parent::SetCampot2("");

				parent::SetCampot3("");

				parent::SetCampot4("");

				parent::SetCampot5("");



				parent::SetCampot6("");

				parent::SetCampot7("");

				parent::SetCampot8("");

				parent::SetCampot9("");

				parent::SetCampot10("");



				parent::SetCampot11("");

				parent::SetCampot12("");

				parent::SetCampot13("");

				parent::SetCampot14("");

				parent::SetCampot15("");

				parent::Setes_publico("");
				parent::Setsuscriptor_leido("");
				parent::Setusuario_leido("");
				parent::Setsuscriptor_updated("");
				parent::Setusuario_updated("");

	}



		



		// CREAMOS EL DESTRUCTOR DE LA CLASE



		function __destruct(){



		}







		// CREAMOS LA FUNCION QUE OBTIENE EL CONTENIDO DEL OBJETO DE ACUERDO A LOS PARAMETROS RECIBIDOS DE LA BASE DE DATOS 



		function CreateGestion($selector = 'id', $id)



		{



			global $con;



			



			// DEFINIMOS LA CONSULTA QUE BUSCA EL OBJETO EN LA BASE DE DATOS 







			$q_str= "select * from gestion where $selector = '".$id."'";



			// EJECUTAMOS LA CONSULTA



			$query = $con->Query($q_str);



			//OBTENEMOS EL RESULTADO DE LA CONSULTA



			$row = $con->FetchAssoc($query);







				// ASIGNAMOS LOS VALORES AL OBJETO



				parent::SetId($row['id']);



				parent::SetRadicado($row['radicado']);



				parent::SetF_recibido($row['f_recibido']);



				parent::SetNombre_radica($row['nombre_radica']);



				parent::SetFolio($this->GetTotalFolios($row['id']));



				parent::SetTipo_documento($row['tipo_documento']);



				parent::SetDependencia_destino($row['dependencia_destino']);



				parent::SetNombre_destino($row['nombre_destino']);



				parent::SetFecha_vencimiento($row['fecha_vencimiento']);



				parent::SetEstado_respuesta($row['estado_respuesta']);



				parent::SetNum_oficio_respuesta($row['num_oficio_respuesta']);



				parent::SetFecha_respuesta($row['fecha_respuesta']);



				parent::SetObservacion($row['observacion']);



				parent::SetPrioridad($row['prioridad']);



				parent::SetEstado_solicitud($row['estado_solicitud']);



				parent::SetSuscriptor_id($row['suscriptor_id']);



				parent::SetCiudad($row['ciudad']);



				parent::SetUsuario_registra($row['usuario_registra']);



				parent::SetEstado_archivo($row['estado_archivo']);



				parent::SetOficina($row['oficina']);



				parent::SetId_dependencia_raiz($row['id_dependencia_raiz']);



				parent::SetFecha_registro($row['fecha_registro']);



				parent::SetMin_rad($row['min_rad']);



				parent::SetDocumento_salida($row['documento_salida']);





				parent::SetUri($row['uri']);

				parent::SetTs($row['ts']);

				parent::SetObservacion2($row['observacion2']);

				parent::SetTransferencia($row['transferencia']);

				parent::SetRweb($row['rweb']);



				parent::SetVersion($row['version']);

				parent::SetTipo_almacen($row['tipo_almacen']);

				parent::SetUbicacion_fisica($row['ubicacion_fisica']);

				parent::SetEstado_personalizado($row['estado_personalizado']);



				parent::SetCampot1($row['campot1']);

				parent::SetCampot2($row['campot2']);

				parent::SetCampot3($row['campot3']);

				parent::SetCampot4($row['campot4']);

				parent::SetCampot5($row['campot5']);



				parent::SetCampot6($row['campot6']);

				parent::SetCampot7($row['campot7']);

				parent::SetCampot8($row['campot8']);

				parent::SetCampot9($row['campot9']);

				parent::SetCampot10($row['campot10']);



				parent::SetCampot11($row['campot11']);

				parent::SetCampot12($row['campot12']);

				parent::SetCampot13($row['campot13']);

				parent::SetCampot14($row['campot14']);

				parent::SetCampot15($row['campot15']);

				parent::Setes_publico($row['es_publico']);
				parent::Setsuscriptor_leido($row['suscriptor_leido']);
				parent::Setusuario_leido($row['usuario_leido']);
				parent::Setsuscriptor_updated($row['suscriptor_updated']);
				parent::Setusuario_updated($row['usuario_updated']);



		}







		// FUNCION QUE ELIMINA UN REGISTRO DE LA BASE DE DATOS



		function DeleteGestion($id)



		{



			global $con; 







			// DEFINIMOS LA CONSULTA



			$q_str= 'delete from gestion where id = '.$id;



			// EJECUTAMOS LA CONSULTA



			$query = $con->Query($q_str); 







			// VERIFICAMOS SI SE EJECUTO CORRECTAMENTE



			if (!$query) {



				echo 'Invalid query: '.$con->Error($query);



			}else{



				return '1';



			}



		}







		// FUNCION QUE INSERTA UN REGISTRO EN LA BASE DE DATOS



			function InsertGestion($radicado, $f_recibido, $nombre_radica, $folio, $tipo_documento, $dependencia_destino, $nombre_destino, $fecha_vencimiento, $estado_respuesta, $num_oficio_respuesta, $fecha_respuesta, $observacion, $prioridad, $estado_solicitud, $suscriptor_id, $ciudad, $usuario_registra, $estado_archivo, $oficina, $id_dependencia_raiz, $minr,$documento_salida="N", $id_s = "0", $observacion2 = "", $rweb = "0", $t1= "",$t2= "",$t3= "",$t4= "",$t5= "", $t6= "",$t7= "",$t8= "",$t9= "",$t10= "", $t11= "",$t12= "",$t13= "",$t14= "",$t15= "", $estado_personalizado = "", $expediente_publico = "0"){


			global $con; 
			global $c;
			global $f;

			$uid = $c->GetMaxIdTabla("gestion", "id");

			// a la consulta "select  * from gestion where f_recibido = '".$f_recibido."'  and nombre_radica LIKE '%".$nombre_radica."%' and observacion like '%".$observacion."%'" agrega por favor una condicion adicional para que el campo ts este en un rango de 2 minutos a la hora actual, (calcula la hora actual y restale 2 minutos)
			$sql = "SELECT * FROM gestion WHERE f_recibido = '".$f_recibido."' AND nombre_radica LIKE '%".$nombre_radica."%' AND observacion LIKE '%".$observacion."%' AND ts BETWEEN DATE_SUB(NOW(), INTERVAL 1 MINUTE) AND NOW()";	

			$qu = $con->Query($sql);

			$dqu = $con->FetchAssoc($qu);

			$check = true;
			
			if($dqu['id'] != ''){
				$check = false;
			}else{
				$check = true;
			}

			if ($check) {
				# code...


				$q_strx = "SELECT id_version from super_admin WHERE id='6'";
				$queryx = $con->Query($q_strx);
				$id_version = $con->Result($queryx, 0, "id_version");

				$uri = $c->GetIdRecursivo("");
				// DEFINIMOS LA CONSULTA		
				$q_str = "INSERT INTO gestion (ts, radicado, f_recibido, nombre_radica, folio, tipo_documento, dependencia_destino, nombre_destino, fecha_vencimiento, estado_respuesta, num_oficio_respuesta, fecha_respuesta, observacion, prioridad, estado_solicitud, suscriptor_id, ciudad, usuario_registra, estado_archivo, oficina, id_dependencia_raiz, fecha_registro, min_rad,documento_salida, id_servicio, uri, observacion2, rweb, version, campot1, campot2, campot3, campot4,campot5, campot6, campot7, campot8, campot9,campot10, campot11, campot12, campot13, campot14,campot15, estado_personalizado, es_publico) VALUES ('".date("Y-m-d H:i:s")."', '$radicado', '$f_recibido', '$nombre_radica', '$folio', '$tipo_documento', '$dependencia_destino', '$nombre_destino', '$fecha_vencimiento', '$estado_respuesta', '$num_oficio_respuesta', '$fecha_respuesta', '$observacion', '$prioridad', '$estado_solicitud', '$suscriptor_id', '$ciudad', '$usuario_registra', '$estado_archivo', '$oficina', '$id_dependencia_raiz', '".date("Y-m-d")."', '$minr', '$documento_salida', '$id_s', '$uri', '$observacion2', '$rweb', '$id_version', '$t1', '$t2', '$t3', '$t4', '$t5', '$t6', '$t7', '$t8', '$t9', '$t10', '$t11', '$t12', '$t13', '$t14', '$t15', '$estado_personalizado', '$expediente_publico')";

				// if ($_SESSION['usuario'] == 'sanderkdna@gmail.com') {
				// 	echo $q_str;
				// }
				// EJECUTAMOS LA CONSULTA
				$query = $con->Query($q_str); 
				// VERIFICAMOS SI SE EJECUTO CORRECTAMENTE
				if (!$query) {
					return false;
				}else{
					return true;
				}

			}else{
				return false;
			}
		} 







		 // FUNCION BIONICA PARA ACTUALIZAR REGISTROS DE LIBROS







		function UpdateGestion($constrain, $fields, $updates, $output)



		{



			global $con;







			 // DEFINIMOS LOS PARAMETROS INICIALES DE LA CONSULTA



			$str = "UPDATE gestion SET ";



			//HACEMOS UN FOR QUE RECORRA LOS VECTORES DE LOS CAMPOS Y LAS ACTUALIZACIONES PARA ARMAR LA CONSULTA CON CAMPOS FLEXIBLES



			for($i = 0; $i < count($fields); $i++){



				if($i+1 < count($fields)){



					$str .= $fields[$i]. " = '".$updates[$i]."', ";



				}else{



					$str .= $fields[$i]. " = '".$updates[$i]."' ";



				}



			}



			// INGRESAMOS LA CONDICION DE CONSTRAIN (CUIDADO CON ESTO YA QUE NO DEBE IR VACIO NUNCA)



			$str .= " $constrain"; 



			



			// EJECUTAMOS LA CONSULTA UNA VEZ ESTE CONSTRUIDA



			$query = $con->Query($str); 



 



		



			//VERIFICAMOS SI SE EJECUTO CORRECTAMENTE	



			if (!$query) {



				return 'Invalid query: '.$con->Error($query).$str;



			}else{



				return $query[1];



			}



		}







		// FUNCION PARA LISTAR REGISTROS 



		function ListarGestion($constrain = '', $order = 'order by id',   $limit = 'limit 1000')



		{



			global $con;







			// DEFINIMOS LA CONSULTA



			$q_str = "SELECT * FROM gestion $path $constrain $order $limit"; 



			// EJECUTAMOS LA CONSULTA



			$query = $con->Query($q_str); 







			



			//VERIFICAMOS QUE LA CONSULTA SE EJECUTE CORRECTAMENTE



				if (!$query) {



				return 'Invalid query: '.$con->Error($query);



			}else{



				return $query;



			}



		}







		function GetNRadicado($num_oficio_respuesta, $ciudad, $oficina, $dependencia_destino, $id_dependencia_raiz, $tipo_documento){







			global $con; 



			global $f;



			$q_str = "select count(*) as t from gestion where year(fecha_registro) = '".date("Y")."' and dependencia_destino = '$dependencia_destino' and id_dependencia_raiz ='$id_dependencia_raiz' and tipo_documento = '$tipo_documento'";



			$str = $con->Query($q_str);







			$nstr = $con->Result($str, 0, "t") + 1;



			#echo $q_str;

			$q_str2 = "select prefijo as pf from super_admin limit 1";

			$str2 = $con->Query($q_str2);

			$prefijo = $con->Result($str2, 0, "pf");

			if($prefijo != '' && $prefijo != '0'){$prefijo=$prefijo;}else{$prefijo = "";}



			return $prefijo.$num_oficio_respuesta."-".$f->Zerofill($nstr, 4);







		}







		function GetTotalFolios($id){



			global $con; 



			global $f;



			$q_str = "select sum(cantidad) as t from gestion_anexos where gestion_id = '".$id."' and estado = '1' ";







			$str = $con->Query($q_str);







			$nstr = $con->Result($str, 0, "t");



			#echo $q_str;



			return $nstr;







		}







		function GetTotalActuaciones(){



			global $con; 



			global $f;



			$q_str = "select count(*) as t from events_gestion where gestion_id = '".$this->GetId()."'";







			$str = $con->Query($q_str);







			$nstr = $con->Result($str, 0, "t");



			#echo $q_str;n_anexose



			return $nstr;



		}







		function GetMinRadicado($documento_salida="N", $mirad = ""){

			global $con;
			global $f;
			global $c;

			if ($mirad == '') {
				// code...
				$typer = $c->GetDataFromTable("super_admin", "id", "6", "PROJECTNAME", "");

				$separador = "";
				$ow = "";
				if ($typer == "1") {
					$separador = "";
					$ow = "";

				}else{
					$separador = "-";
					$ow = "0";
				}

				$pefijo_documento="1".$ow;
				if($documento_salida=="S"){
					$pefijo_documento="2".$ow;
				}elseif($documento_salida=="C"){
					$pefijo_documento="3".$ow;
				}elseif($documento_salida=="A"){
					$pefijo_documento="4".$ow;
				}else{
					$pefijo_documento="1".$ow;
					$documento_salida = "N";
				}

				$q_str = "select count(*) as t from gestion where documento_salida = '".$documento_salida."' and year(fecha_registro) = '".date("Y")."' ";
				$str = $con->Query($q_str);
				$nstr = $con->Result($str, 0, "t") + 1;

				$q_str2 = "select prefijo as pf from super_admin limit 1";
				$str2 = $con->Query($q_str2);
				$prefijo = $con->Result($str2, 0, "pf");

				if($prefijo != '' && $prefijo != '0'){

					$prefijo=$prefijo.'-';

				}else{
					$prefijo = "";
				}
				
				$minRad = $prefijo.date('Y')."-".$pefijo_documento.$separador.$nstr;

			}else{
				$minRad = $mirad;
			}
			
			return $minRad;
			// nueva implementacion
			// $q_str = "select count(*) as t from gestion where min_rad = '".$minRad."'";
			// $str = $con->Query($q_str);
			// $nstr = $con->Result($str, 0, "t");


			// if ($nstr == 0) {
			// 	return $minRad;
			// }else{
			// 	$this->GetMinRadicado($documento_salida);	
			// }
			



		}

	}	



?>