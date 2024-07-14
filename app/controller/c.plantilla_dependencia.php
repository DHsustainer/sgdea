<?
	session_start();
	//Invocando archivos que seran usados en nuestro controlador generico	
	include_once('app/basePaths.inc.php');
	include_once(MODELS.DS.'Plantilla_dependenciaM.php');
	include_once(MODELS.DS.'Dependencias_permisos_documentoM.php');
	include_once(MODELS.DS.'Suscriptores_contactosM.php');
	include_once(MODELS.DS.'Suscriptores_tiposM.php');
	include_once(MODELS.DS.'Suscriptores_contactos_direccionM.php');
	include_once(MODELS.DS.'UsuariosM.php');
	include_once(PLUGINS.DS.'parse.php');	
	include_once(ROOT.DS.'DALC'.DS.'/mySql.php');
	include_once('consultas.php');
	include_once('funciones.php');	

	// Definiendo variables y conectandonos con la base de datos
	$con = new ConexionBaseDatos;
	$con->Connect($con);
	
	// Llamando al objeto a controlar		
	$ob = new CPlantilla_dependencia;
	$c = new Consultas;
	$f = new Funciones;
	
	// DEFINIMOS EN UN VECTOR LOS CAMPOS QUE VAMOS A EDITAR
	$ar2 = array('user_id', 'nombre', 'f_creacion', 'f_actualizacion', 'contenido', 'dependencia_id');
	// DEFINIMOS EN OTRO VECTOR LOS NUEVOS DATOS QUE VAMOS A METER	
	$ar1 = array($c->sql_quote($_REQUEST['user_id']), $c->sql_quote($_REQUEST['nombre']), $c->sql_quote($_REQUEST['f_creacion']), $c->sql_quote($_REQUEST['f_actualizacion']), $c->sql_quote($_REQUEST['descripcion']), $c->sql_quote($_REQUEST['dependencia_id']));	
	// DEFINIMOS LOS ESTADOS DE SALIDA
	$output = array('registro actualizado', 'no se pudo actualizar'); 
	// Y POR ULTIMO DEFINIMOS EL CONTRAIN PARA LA ACTUALIZACION	
	$constrain = 'WHERE id = '.$_REQUEST['id'];
	
		// LA FUNCION SQLQUOTE de la clase Consultas se encarga de fultrar las variables recibidas por GET o por POST para evitar la inyeccion de SQL
		// esta funcion solo funciona cuando se ha establecido conexion con la base de datos
		// SI LA ACTION CAPTURADA ES LISTAR ENTONCES LISTA
		if($c->sql_quote($_REQUEST['action']) == 'listar')
			$ob->VistaListar('');	
		// SINO SI ES NUEVO ENTONCES CARGA EL FORMULARIO INSERTAR	
		elseif($c->sql_quote($_REQUEST['action']) == 'nuevo')	
			$ob->VistaInsertar();
		// SINO SI ES INSERTAR ENTONCES CARGA EL INSERTAR	
		elseif($c->sql_quote($_REQUEST['action']) == 'registrar')
		// CAPTURA LAS VARIAABLES Y ENVIALAS A LA FUNCION INSERTAR		
			$ob->Insertar($c->sql_quote($_REQUEST["user_id"]), $c->sql_quote($_REQUEST["nombre"]), $c->sql_quote($_REQUEST["f_creacion"]), $c->sql_quote($_REQUEST["f_actualizacion"]), $c->sql_quote($_REQUEST["descripcion"]), $c->sql_quote($_REQUEST["dependencia_id"]));
		// SINO SI ES EDITAR ENTONCES CARGA EL FORMULARIO EDITAR	
		elseif($c->sql_quote($_REQUEST['action']) == 'editar')
			$ob->VistaEditar($c->sql_quote($_REQUEST['id']));	
		// SINO SI ES ACTUALIZAR ENTONCES ENVIA UNA ACTUALIZACION CON LOS PARAMETROS CAPTURADOS
		elseif($c->sql_quote($_REQUEST['action']) == 'actualizar')
			$ob->Editar($constrain, $ar2, $ar1, $output);
		// SINO SI ES ELIMINAR ENTONCES CARGA LA FUNCION ELIMINAR
		elseif($c->sql_quote($_REQUEST['action']) == 'eliminar')
			$ob->Eliminar($c->sql_quote($_REQUEST['id']));
		elseif($c->sql_quote($_REQUEST['action']) == 'find')
			$ob->Find($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']));
		// SINO SI ES NUEVO BUSCAR CARGA EL BUSCADOR			
		elseif($c->sql_quote($_REQUEST['action']) == 'buscar')
			$ob->Buscar($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']));		
		elseif($c->sql_quote($_REQUEST['action']) == 'GET')
			$ob->GetPlantilla($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']));		
		else
		// SI NO ES NINGUNA DE LAS ANTERIORES ENTONCES CARGA POR DEFECTO LA VISTA DE LISTADO		
			$ob->VistaListar('');		
	
	// DEFINIENDO LA CLASE DEL CONTROLADOR DEL OBJETO QUE TIENE HERENCIA CON EL CONTROLADOR GENERICO PARA CARGAR LA INTERFAZ
	class CPlantilla_dependencia extends MainController{
		
		// DEFINIENDO LA FUNCION LISTAR 		
		function VistaListar(){
			// CREANDO UN NUEVO MODELO			
			$object = new MPlantilla_dependencia;
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			
			global $con;
			//CARGANDO LA PAGINA DE INTERFAZ			
			$pagina = $this->load_template('Listar Plantilla_dependencia');			
			// CARGANDO LLAMANDO LA FUNCION LSITAR LIBROS DEL MODELO (FUNCION QUE TRAE DE LA BASE DE DATOS EL LISTADO DE LIBROS
			// DE NO RECIBIR PARAMETROS ESTA FUNCION TRAE EL LISTADO COMPLETO DE LIBROS
			$query = $object->ListarPlantilla_dependencia();	    
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();
				// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO
		   		if($con->NumRows($query) <= 0 || $query !=''){
					// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA
					include_once(VIEWS.DS.'plantilla_dependencia/Listar.php');	   			
					// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.			
					$table = ob_get_clean();	
					// SI NO TRAE NINGUNA VARIABLE ENTONCES GENERA UN ERROR
					if($message != '')
					$pagina = $this->replace_content('/\#ERROR_MESSAGE\#/ms', $message , $pagina);
					// DE LO CONTRARIO ENTONCES CARGA EL CONTENIDO DE LA PAGINA																
					$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $table , $pagina);
				}else{
					// SI NO SE EJECUTA LA CONSULTA ENTONCES GENERA MENSAJE DE ERROR
		   			$pagina = $this->replace_content('/\#CONTENIDO\#/ms' ,'<h1>No existen resultados</h1>' , $pagina);	
				}
			// RETORNAME LA PAGINA CARGADA		
			$this->view_page($pagina);
		}
		// FUNCION QUE CARGA LA VISTA DE INSERTAR (FORMULARIO DE INSERTAR)
		function VistaInsertar(){
			//CARGA EL TEMPLATE
			$pagina = $this->load_template('Crear Plantilla_dependencia');			
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();
			include_once(VIEWS.DS.'plantilla_dependencia/FormInsertPlantilla_dependencia.php');				
			// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.						
			$path = ob_get_clean();	
			// ASIGNANDOLE A LA VARIABLE  EL CONTENIDO DEL BUFFER																																																															
			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $path  , $pagina);
			// CARGAMOS LA PAGINA EN EL BROWSER	
			$this->view_page($pagina);		
		}
		// FUCNION QUE CARGA LA VISTA PARA EDITAR EL CONTENIDO DE UN REGISTRO
		function VistaEditar($x){
			// CARGA EL TEMPLATE			
	 		$pagina = $this->load_template('Editar Plantilla_dependencia');			
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();		
	 		// INVOCAMOS UN NUEVO OBJETO
		 	$object = new MPlantilla_dependencia;
			// LO CREAMOS 			
			$object->CreatePlantilla_dependencia('id', $x);
			// Y FINALMENTE CARGAMOS LA VISTA DE EDICION QUE MUESTRA EL CONTENIDO			
			include_once(VIEWS.DS.'plantilla_dependencia/FormUpdatePlantilla_dependencia.php');		
			// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.											
			$table = ob_get_clean();	
			// ASIGNANDOLE A LA VARIABLE  EL CONTENIDO DEL BUFFER															
			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $table  , $pagina);
			// CARGAMOS LA PAGINA EN EL BROWSER		
			$this->view_page($pagina);
	 	}	
	 	function Buscar($x, $cn = 'id'){
	 		// INVOCAMOS UN NUEVO OBJETO						
			$object = new MPlantilla_dependencia;
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL						
			global $con;
			// CARGA EL TEMPLATE						
			$pagina = $this->load_template('Listado de Plantilla_dependencia');			
			// OBTENEMOS EL LISTADO DE LIBROS DE ACUERDO A LOS PARAMETROS QUE LE ENVIAMOS						
			$query = $object->ListarPlantilla_dependencia('WHERE '.$cn.' = "'.$x.'"');	    
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();		
		   		if($con->NumRows($query) <= 0 || $query !=''){
					// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO							
					include_once(VIEWS.DS.'plantilla_dependencia/Listar.php');	   			
					// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.								 								
					$table = ob_get_clean();	
					// ASIGNANDOLE A LA VARIABLE  EL CONTENIDO DEL BUFFER																																																		
					$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $table , $pagina);
				}else{
						// ASIGNANDOLE A LA VARIABLE  EL CONTENIDO DEL BUFFER																			
			   			$pagina = $this->replace_content('/\#CONTENIDO\#/ms' ,'<h1>No existen resultados</h1>' , $pagina);	
				}		
			// CARGAMOS LA PAGINA EN EL BROWSER				
			$this->view_page($pagina);
	 	}		
		// FUNCION QUE OBTIENE UNA SERIE DE DATOS Y LOS INSERTA EN LA BASE DE DATOS		
		function Insertar($user_id, $nombre, $f_creacion, $f_actualizacion, $contenido, $dependencia_id){
			// DEFINIENDO EL OBJETO			
			global $con;
			global $c;
			$object = new MPlantilla_dependencia;
			// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATOA			
			$create = $object->InsertPlantilla_dependencia($user_id, $nombre, $f_creacion, $f_actualizacion, $contenido, $dependencia_id);
			
			//SI NO SE ENVIO CORRECTAMENTE ENTONCES GENERA ERROR SINO ENVIA OK
			$nid = $c->GetMaxIdTabla("plantilla_dependencia", "id");

			echo '<script> window.location.href = "'.HOMEDIR.DS.'dependencias/views_minutas/'.$dependencia_id.'/'.$nid.'/"</script>';					

		}
		// FUNCION QUE RECIBE UNASERIE DE PARAMETROS Y LOS ENVIA A LA BASE DE DATOS PARA ACTUALIZAR UN REGISTRO (FUNCION ESPECIAL)		
		function Editar($constrain, $fields, $updates, $output){
			$object = new MPlantilla_dependencia;
			$create = $object->UpdatePlantilla_dependencia($constrain, $fields, $updates, $output);
			
			//SI NO SE ENVIO CORRECTAMENTE ENTONCES GENERA ERROR SINO ENVIA OK
			echo '<script> window.location.href = "'.HOMEDIR.DS.'dependencias/views_minutas/'.$_GET['cn'].'/'.$_GET['id'].'/"</script>';					
			
		}
		// FUCNION QUE RECIBE UN PARAMETRO Y ELIMINA EL REGISTRO DE LA BASE DE DATOS		
		function Eliminar($id){
			// DEFINIMOS UN OBJETO NUEVO						
			$object = new MPlantilla_dependencia;
			// LLAMAMOS A LA FUNCION QUE EJECUTA LA ELIMINACION.			
			$delete = $object->DeletePlantilla_dependencia($id); 		
			//SI NO SE ENVIO CORRECTAMENTE ENTONCES GENERA ERROR SINO ENVIA OK
			if($delete != '1')
				echo 'ERROR AL ELIMINAR';
			else
				echo 'OK!';			
			
		}
		function GetPlantilla($id_gestion, $id_plantilla){
			global $con;
			global $f;

			$pl = new MPlantilla_dependencia;
			$pl->CreatePlantilla_dependencia("id", $id_plantilla);
			$isset = 0;
			$titulo = $pl->GetNombre();
			#$content = $pl->GetContenido();

			$content = $f->parseBBCodex($pl->GetContenido());
			
			$DOM = new DOMDocument();
			$DOM->loadHTML( $content );

			$h2 = $DOM->getElementsByTagName( '.eltof' );
			
			$list_permisos_p2 = "";
			$list_permisos_p2 = "";

			$permisos = new MDependencias_permisos_documento;
			$qp = $permisos->ListarDependencias_permisos_documento("WHERE id_documento = '".$pl->GetId()."'");

			while ($row = $con->FetchAssoc($qp)) {
				$usuario = new Musuarios;
				$usuario->CreateUsuarios("user_id", $row['usuario_permiso']);
				$list_permisos_p1 .= "<li id='elm".$usuario->GetA_i()."'><div class='t_listado'>".$usuario->GetP_nombre()." ".$usuario->GetP_apellido()."</div></li>";
				$list_permisos_p2 .= $row['usuario_permiso'].";";
			}

			echo json_encode(array('isset'=>$isset,'content'=>htmlspecialchars_decode($content),'name'=>$titulo, 'listado_seleccion' => $list_permisos_p1, 'emails_listado_seleccion' => $list_permisos_p2));
		}
		function Find($char, $id){
			global $con;
			global $c;
			$ar = explode("@@@", $char);

			$path = "";
			$elementos_gestion = array( "rad_externo" => "radicado",
										"rad_completo" => "num_oficio_respuesta",
										"rad_rapido" => "min_rad",
										"suscriptor" => "suscriptor_id",
										"Estado" => "estado_solicitud",
										"Fecha_registro" => "fecha_registro",
										"tipo_documento" => "documento_salida",
										"fecha_vence" => "fecha_vencimiento",
										"Resuelto" => "estado_respuesta",
										"fecha_respuesta" => "fecha_respuesta",
										"prioridad" => "prioridad",
										"folios" => "folio",
										"departamento" => "ciudad",
										"ciudad" => "ciudad",
										"oficina" => "oficina",
										"area" => "dependencia_destino",
										"responsable" => "nombre_destino",
										"serie" => "id_dependencia_raiz",
										"sub_Serie" => "tipo_documento",
										"observacion" => "observacion",
										"ubicacion" => "estado_archivo",
										"CAMPOT6" => "campot6",
										"CAMPOT1" => "campot1",
										"CAMPOT4" => "campot4",
										"CAMPOT3" => "campot3",
										"CAMPOT2" => "campot2",
										"CAMPOT7" => "campot7"
									);

			$elementos = array( "rad_externo",	"rad_completo",	"rad_rapido",	"suscriptor",	"Estado",	"Fecha_registro",	"tipo_documento",	"fecha_vence",	"Resuelto",	"fecha_respuesta",	"prioridad",	"folios",	"departamento",	"ciudad",	"oficina",	"area",	"responsable",	"serie",	"sub_Serie",	"observacion",	"ubicacion", "CAMPOT6", "CAMPOT1", "CAMPOT4", "CAMPOT3", "CAMPOT2", "CAMPOT7", "responsable", "responsable_identificacion", "responsable_ciudad", "responsable_tp");

			$qgestion = $con->Query("Select * from gestion where id = '$id'");
			$rresultgestion = $con->FetchAssoc($qgestion);

			for ($i=0; $i < count($ar) ; $i++) { 
				$eltf = explode("_", $ar[$i]);

				#echo "Select col_$eltf[2] from big_data where campo_id = '$eltf[0]' and type_id = '$id' ";
				$q = $con->Query("Select valor from meta_big_data where campo_id = '$eltf[0]' and type_id = '$id'");
				$result = $con->Result($q, 0, 'valor');


				if ($result == "") {
					if (in_array($ar[$i], $elementos)) {
						$valor_elemento = $rresultgestion[$elementos_gestion[$ar[$i]]];
						switch ($ar[$i]) {
							case 'suscriptor':
								$valor_elemento = $c->GetDataFromTable("suscriptores_contactos", "id", $valor_elemento, "nombre", "");
								break;
							case 'Suscriptor':
								$valor_elemento = $c->GetDataFromTable("suscriptores_contactos", "id", $valor_elemento, "nombre", "");
								break;
							case 'Estado':
								$valor_elemento = $c->GetDataFromTable("estados_gestion", "id", $valor_elemento, "nombre", "");
								break;
							case 'tipo_documento':
								$array_d = array("S" => "Documento de Salida", "N" => "Documento de Entrada");
								$valor_elemento = $array_d[$valor_elemento];
								break;
							case 'prioridad':
								$array_d = array("0" => "Baja", "1" => "Media", "2" => "Alta");
								$valor_elemento = $array_d[$valor_elemento];
								break;
							case 'departamento':
								$valor_elemento = $c->GetDataFromTable("city", "code", $valor_elemento, "Province", "");
								$valor_elemento = $c->GetDataFromTable("province", "code", $valor_elemento, "Name", "");
								break;
							case 'ciudad':
								$valor_elemento = $c->GetDataFromTable("city", "code", $valor_elemento, "Name", "");
								break;
							case 'oficina':
								$valor_elemento = $c->GetDataFromTable("seccional", "id", $valor_elemento, "nombre", "");
								break;
							case 'area':
								$valor_elemento = $c->GetDataFromTable("areas", "id", $valor_elemento, "nombre", "");							
								break;
							case 'responsable':
								$valor_elemento = $c->GetDataFromTable("usuarios", "user_id", $_SESSION['usuario'], "p_nombre, p_apellido", " ");
								break;
							case 'responsable_identificacion':
								$valor_elemento = $c->GetDataFromTable("usuarios", "user_id", $_SESSION['usuario'], "id", " ");
								break;
							case 'responsable_ciudad':
								$valor_elemento = $c->GetDataFromTable("usuarios", "user_id", $_SESSION['usuario'], "ciudad", " ");
								break;
							case 'responsable_tp':
								$valor_elemento = $c->GetDataFromTable("usuarios", "user_id", $_SESSION['usuario'], "t_profesional", " ");
								break;			

							case 'serie':
								$valor_elemento = $c->GetDataFromTable("dependencias", "id", $valor_elemento, "nombre", "");
								break;
							case 'sub_Serie':
								$valor_elemento = $c->GetDataFromTable("dependencias", "id", $valor_elemento, "nombre", "");
								break;
							case 'ubicacion':
								$array_d = array("1" => "Archivo de Gestión", "2" => "Archivo Central", "3" => "Archivo Histórico", "-1" => "Eliminación", "-2" => "Conservación Total", "-3" => "Digitalización", "-4" => "Selección", "-5" => "MicroFilmación", "-6" => "Hibrido", "-7" => "Digitalizar y Eliminar", "-8" => "Seleccionar y Eliminar", "-9" => "Conservación Total y Digitalización");
								$valor_elemento = $array_d[$valor_elemento];
								break;
							default:
								$valor_elemento = $rresultgestion[$elementos_gestion[$ar[$i]]];
								break;
						}

						$path .= $ar[$i]."-*.- ".$valor_elemento." @@@";
					}else{
						$buscarmeta = explode("_", $ar[$i]);
						$pm = $buscarmeta[0];
						$qv = $con->Query("select valor from meta_big_data where campo_id = '".$pm."' and type_id = '".$id."' and tipo_form = '1' limit 0, 1");

						$val = $con->FetchAssoc($qv);

						if ($val['valor'] != "") {
							$path .= $ar[$i]."-*.-  ".$val['valor']." @@@";
						}else{

							$buscarmeta = explode("_", $ar[$i]);
							$pm = $buscarmeta[0];
							$qv = $con->Query("SELECT gs.id_suscriptor, sc.type FROM gestion_suscriptores as gs inner join suscriptores_contactos as sc on sc.id = gs.id_suscriptor where gs.id_gestion = '".$id."' and sc.type = '".$pm."'  limit 0, 1");

							
							while ($ros = $con->FetchAssoc($qv)) {
								$s = new MSuscriptores_contactos;
								$s->CreateSuscriptores_contactos("id", $ros["id_suscriptor"]);
								$sd = new MSuscriptores_contactos_direccion;
								$sd->CreateSuscriptores_contactos_direccion("id_contacto", $ros["id_suscriptor"]);
								$valor = "no data";
								switch ($buscarmeta[1]) {
									case 'nombre':
										$valor = $s->GetNombre();
										break;
									case 'id':
										$valor = $s->GetIdentificacion();
										break;
									case 'direccion':
										$valor = $sd->GetDireccion();
										break;
									case 'ciudad':
										$valor = $sd->GetCiudad();
										break;
									case 'telefono':
										$valor = $sd->GetTelefonos();
										break;
									case 'email':
										$valor = $sd->GetEmail();
										break;
									default:
										$valor = $s->GetNombre();
										break;
								}
							/*
							*/
							}

							if ($valor != "") {
								$path .= $ar[$i]."-*.-  ".$valor." @@@";
							}else{
								$path .= $ar[$i]."-*.-  ".$ar[$i]." Sin Información para Combinar @@@";
							}
#							$path .= $ar[$i]."-*.-  ".$ar[$i]." Sin Información para Combinar @@@";
							
						}
					}

				}else{
					$path .= $ar[$i]."-*.- ".$result." @@@";
				}
			}

			echo $path;
		}
	}
?>
		