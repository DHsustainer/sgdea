<?
session_start();



#	error_reporting(E_ALL);



#	ini_set('display_errors', '1');



	//Invocando archivos que seran usados en nuestro controlador generico	



	include_once('app/basePaths.inc.php');



	include_once(MODELS.DS.'UsuariosM.php');



	include_once(MODELS.DS.'CaratulaM.php');



	include_once(VIEWS.DS.'events'.DS.'calendar.php');	



	include_once(MODELS.DS.'Super_adminM.php');



	include_once(MODELS.DS.'Suscriptores_contactosM.php');



	include_once(MODELS.DS.'NotificacionesM.php');



	include_once(MODELS.DS.'Demandado_procesoM.php');



	include_once(MODELS.DS.'GestionM.php');



	include_once(MODELS.DS.'SeccionalM.php');



	include_once(MODELS.DS.'AreasM.php');



	include_once(MODELS.DS.'Seccional_principalM.php');



	include_once(MODELS.DS.'Areas_dependenciasM.php');



	include_once(MODELS.DS.'DependenciasM.php');



	include_once(MODELS.DS.'Dependencias_tipologiasM.php');



	include_once(MODELS.DS.'FolderM.php');



	include_once(MODELS.DS.'CityM.php');



	include_once(MODELS.DS.'ProvinceM.php');



	include_once(MODELS.DS.'Usuarios_configurar_accesosM.php');



	#include_once(PLUGINS.DS.'PHPMailer_5.2.4/class.phpmailer.php');	



	include_once(ROOT.DS.'DALC'.DS.'/mySql.php');



	include_once('consultas.php');



	include_once('funciones.php');	



	// Definiendo variables y conectandonos con la base de datos



	$con = new ConexionBaseDatos;



	$con->Connect($con);



	



	// Llamando al objeto a controlar		



	$ob = new CSeccional;



	$c = new Consultas;



	$f = new Funciones;



	



	// DEFINIMOS EN UN VECTOR LOS CAMPOS QUE VAMOS A EDITAR



	$ar2 = array('nombre', 'direccion', 'telefono', 'principal', 'ciudad');



	// DEFINIMOS EN OTRO VECTOR LOS NUEVOS DATOS QUE VAMOS A METER	



	$ar1 = array($c->sql_quote($_REQUEST['nombre']), $c->sql_quote($_REQUEST['direccion']), $c->sql_quote($_REQUEST['telefono']), $c->sql_quote($_REQUEST['principal']), $c->sql_quote($_REQUEST['ciudad']));	



	// DEFINIMOS LOS ESTADOS DE SALIDA



	$output = array('registro actualizado', 'no se pudo actualizar'); 



	// Y POR ULTIMO DEFINIMOS EL CONTRAIN PARA LA ACTUALIZACION	



	$constrain = 'WHERE id = '.$_REQUEST['id'];



	



		// LA FUNCION SQLQUOTE de la clase Consultas se encarga de fultrar las variables recibidas por GET o por POST para evitar la inyeccion de SQL



		// esta funcion solo funciona cuando se ha establecido conexion con la base de datos



		// SI LA ACTION CAPTURADA ES LISTAR ENTONCES LISTA



		if($c->sql_quote($_REQUEST['action']) == 'listar')



			$ob->VistaListar($_REQUEST['id']);	



		// SINO SI ES NUEVO ENTONCES CARGA EL FORMULARIO INSERTAR	



		elseif($c->sql_quote($_REQUEST['action']) == 'nuevo')	



			$ob->VistaInsertar();



		elseif($c->sql_quote($_REQUEST['action']) == 'listadoseccional')	



			$ob->VistaListadoSeccional($_REQUEST['id']);



		elseif($c->sql_quote($_REQUEST['action']) == 'listadooficinasseccional')	



			$ob->VistaOficinasSeccional($_REQUEST['id']);



		



		// SINO SI ES INSERTAR ENTONCES CARGA EL INSERTAR	



		elseif($c->sql_quote($_REQUEST['action']) == 'registrar')



		// CAPTURA LAS VARIAABLES Y ENVIALAS A LA FUNCION INSERTAR		



			$ob->Insertar($c->sql_quote($_REQUEST["nombre"]), $c->sql_quote($_REQUEST["direccion"]), $c->sql_quote($_REQUEST["telefono"]), $c->sql_quote($_REQUEST["principal"]), $c->sql_quote($_REQUEST["ciudad"]));



		// SINO SI ES EDITAR ENTONCES CARGA EL FORMULARIO EDITAR	



		elseif($c->sql_quote($_REQUEST['action']) == 'editar')



			$ob->VistaEditar($c->sql_quote($_REQUEST['id']));	



		// SINO SI ES ACTUALIZAR ENTONCES ENVIA UNA ACTUALIZACION CON LOS PARAMETROS CAPTURADOS



		elseif($c->sql_quote($_REQUEST['action']) == 'actualizar')



			$ob->Editar($constrain, $ar2, $ar1, $output);



		// SINO SI ES ELIMINAR ENTONCES CARGA LA FUNCION ELIMINAR



		elseif($c->sql_quote($_REQUEST['action']) == 'eliminar')



			$ob->Eliminar($c->sql_quote($_REQUEST['id']));



		// SINO SI ES NUEVO BUSCAR CARGA EL BUSCADOR			



		elseif($c->sql_quote($_REQUEST['action']) == 'buscar')



			$ob->Buscar($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']));		



		elseif($c->sql_quote($_REQUEST['action']) == 'ChangeArchivo')



			$ob->ChangeArchivo($c->sql_quote($_REQUEST['id']));	



		elseif($c->sql_quote($_REQUEST['action']) == 'ChangeCiudad')



			$ob->ChangeCiudad($c->sql_quote($_REQUEST['id']));



		elseif($c->sql_quote($_REQUEST['action']) == 'ChangeOficina')



			$ob->ChangeOficina($c->sql_quote($_REQUEST['id']));



		elseif($c->sql_quote($_REQUEST['action']) == 'ChangeArea')



			$ob->ChangeArea($c->sql_quote($_REQUEST['id']));



		elseif($c->sql_quote($_REQUEST['action']) == 'ChangeUsuario')



			$ob->ChangeUsuario($c->sql_quote($_REQUEST['id']));



		elseif($c->sql_quote($_REQUEST['action']) == 'ChangeEmpresa')



			$ob->ChangeEmpresa($c->sql_quote($_REQUEST['id']));



		elseif($c->sql_quote($_REQUEST['action']) == 'ChangeEmpresaTRD')



			$ob->ChangeEmpresaTRD($c->sql_quote($_REQUEST['id']));	



		elseif($c->sql_quote($_REQUEST['action']) == 'childs')



			$ob->GetChilds($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']));	



		elseif($c->sql_quote($_REQUEST['action']) == 'abriroficinas')



			#echo "<li>sander</li>";



			$ob->AbrirOficinas($c->sql_quote($_REQUEST['id']));	



		else



		// SI NO ES NINGUNA DE LAS ANTERIORES ENTONCES CARGA POR DEFECTO LA VISTA DE LISTADO		



			$ob->VistaListar('');		



	



	// DEFINIENDO LA CLASE DEL CONTROLADOR DEL OBJETO QUE TIENE HERENCIA CON EL CONTROLADOR GENERICO PARA CARGAR LA INTERFAZ



	class CSeccional extends MainController{



		



		// DEFINIENDO LA FUNCION LISTAR 		



		function VistaListar($code = ""){



			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			



			global $con;



			// CREANDO UN NUEVO MODELO			



			$object = new MSeccional;



			$query = $object->ListarSeccional("WHERE principal = '".$code."'");



			// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA



			include_once(VIEWS.DS.'seccional/Listar.php');



		}



		// FUNCION QUE CARGA LA VISTA DE INSERTAR (FORMULARIO DE INSERTAR)



		function VistaInsertar(){



			//CARGA EL TEMPLATE



			$pagina = $this->load_template('Crear Seccional');			



			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.



			ob_start();



			include_once(VIEWS.DS.'seccional/FormInsertSeccional.php');				



			// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.						



			$path = ob_get_clean();	



			// ASIGNANDOLE A LA VARIABLE  EL CONTENIDO DEL BUFFER																																																															



			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $path  , $pagina);



			// CARGAMOS LA PAGINA EN EL BROWSER	



			$this->view_page($pagina);		



		}



		// FUCNION QUE CARGA LA VISTA PARA EDITAR EL CONTENIDO DE UN REGISTRO



		function VistaEditar($x){



		 	$object = new MSeccional;



			// LO CREAMOS 			



			$object->CreateSeccional('id', $x);



			// Y FINALMENTE CARGAMOS LA VISTA DE EDICION QUE MUESTRA EL CONTENIDO			



			include_once(VIEWS.DS.'seccional/FormUpdateSeccional.php');		



	 	}	



	 	function Buscar($x, $cn = 'id'){



	 		// INVOCAMOS UN NUEVO OBJETO						



			$object = new MSeccional;



			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL						



			global $con;



			// CARGA EL TEMPLATE						



			$pagina = $this->load_template('Listado de Seccional');			



			// OBTENEMOS EL LISTADO DE LIBROS DE ACUERDO A LOS PARAMETROS QUE LE ENVIAMOS						



			$query = $object->ListarSeccional('WHERE '.$cn.' = "'.$x.'"');	    



			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.



			ob_start();		



		   		if($con->NumRows($query) <= 0 || $query !=''){



					// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO							



					include_once(VIEWS.DS.'seccional/Listar.php');	   			



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



		function Insertar($nombre, $direccion, $telefono, $principal, $ciudad){



			// DEFINIENDO EL OBJETO			



			$object = new MSeccional;



			// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATOA			



			$create = $object->InsertSeccional($nombre, $direccion, $telefono, $principal, $ciudad);



			



			//SI NO SE ENVIO CORRECTAMENTE ENTONCES GENERA ERROR SINO ENVIA OK



			echo '<script> window.location.href = "'.HOMEDIR.DS.'herramientas/#gest"</script>';



		}



		// FUNCION QUE RECIBE UNASERIE DE PARAMETROS Y LOS ENVIA A LA BASE DE DATOS PARA ACTUALIZAR UN REGISTRO (FUNCION ESPECIAL)		



		function Editar($constrain, $fields, $updates, $output){



			$object = new MSeccional;



			$create = $object->UpdateSeccional($constrain, $fields, $updates, $output);



			



			//SI NO SE ENVIO CORRECTAMENTE ENTONCES GENERA ERROR SINO ENVIA OK



			echo '<script> window.location.href = "'.HOMEDIR.DS.'herramientas/#gest"</script>';					



			



		}



		// FUCNION QUE RECIBE UN PARAMETRO Y ELIMINA EL REGISTRO DE LA BASE DE DATOS		



		function Eliminar($id){



			// DEFINIMOS UN OBJETO NUEVO						



			$object = new MSeccional;



			// LLAMAMOS A LA FUNCION QUE EJECUTA LA ELIMINACION.			



			$delete = $object->DeleteSeccional($id); 		



			//SI NO SE ENVIO CORRECTAMENTE ENTONCES GENERA ERROR SINO ENVIA OK



			if($delete != '1')



				echo 'ERROR AL ELIMINAR';



			else



				echo 'OK!';			



			



		}



		function VistaListadoSeccional($code){



			global $con;



			$s = new MSeccional;



			$s->CreateSeccional("id", $code);



			$lits = $s->ListarSeccional("WHERE principal = '".$s->GetPrincipal()."'");



			while ($row = $con->FetchAssoc($lits)) {



				echo "<option value='".$row['id']."'>".$row["nombre"]."</option>";



			}



		}



		function VistaOficinasSeccional($code){



			global $con;



			$s = new MSeccional;



			if ($_SESSION['MODULES']['multioficina'] == "1") {
				$lits = $s->ListarSeccional("WHERE ciudad = '".$code."' and id = '".$_SESSION['seccional']."' ");
			}else{
				$lits = $s->ListarSeccional("WHERE ciudad = '".$code."'");
			}



			$select="";



			if($con->NumRows($lits) == 1){



				$select = " selected ";



			}



			while ($row = $con->FetchAssoc($lits)) {



				echo "<option value='".$row['id']."' $select>".$row["nombre"]."</option>";



			}



		}



		function GetChilds($id, $type){



			global $con;



			global $f;



			global $c;



			$_SESSION["seccional"] = $id;



			$pagina = $this->load_template(utf8_decode(PROJECTNAME).ST."Dashboard");			



			ob_start();



			include_once(VIEWS.DS.'seccional'.DS.'ListadoAreasOficinaSuscriptor.php');				



			// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.						



			$path = ob_get_clean();	



			// ASIGNANDOLE A LA VARIABLE  EL CONTENIDO DEL BUFFER																																																															



			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $path  , $pagina);



			// CARGAMOS LA PAGINA EN EL BROWSER	



			$this->view_page($pagina);



		}



		function ChangeArchivo($id){



			if ($id == "1" || $id == "2" || $id == "3") {



				$_SESSION['typefolder'] = $id;



				echo "Cambio de archivo realizado";



			}else{



				echo "No se pudo cambiar de archivo";



			}



		}



		function ChangeCiudad($id){



			global $con;



			if ($id != "") {



				$_SESSION['ciudad'] = $id;



				$u = new MUsuarios_configurar_accesos;



    			$query = $u->ListarOficinasUsuarioUna($id);



    			if($con->NumRows($query) > 0){



    				$row = $con->FetchAssoc($query);



    				$_SESSION['seccional'] = $row['id'];



    				$query2 = $u->ListarAreasUsuarioUna($row['id']);



    				if($con->NumRows($query2) > 0){



    					$row2 = $con->FetchAssoc($query2);



    					$_SESSION['area_principal'] = $row2['id'];



    				}



    			} else {



    				$_SESSION['seccional'] = '';



    				$_SESSION['area_principal'] = '';



    			}



    		



				echo "Cambio de ciudad realizado";



			}else{



				echo "No se pudo cambiar de ciudad";



			}



		}



		function ChangeOficina($id){



			global $con;



			if ($id != "") {



				$_SESSION['seccional'] = $id;



				$u = new MUsuarios_configurar_accesos;



				$query2 = $u->ListarOficinasUsuarioUna($row['id']);



				if($con->NumRows($query2) > 0){



					$row2 = $con->FetchAssoc($query2);



					$_SESSION['area_principal'] = $row2['id'];



				}else{



					$_SESSION['area_principal'] = '';



				}



				echo "Cambio de oficina realizado";



			}else{



				echo "No se pudo cambiar de oficina";



			}



		}



		function ChangeArea($id){



			if ($id != "") {



				$_SESSION['area_principal'] = $id;



				echo "Cambio de ".CAMPOAREADETRABAJO." realizado";



			}else{



				echo "No se pudo cambiar de ".CAMPOAREADETRABAJO."";



			}



		}



		function ChangeUsuario($id){



			global $con;



			if ($id != "") {



				$u = new MUsuarios;



				if($_SESSION["usuario_real_cambio"] == $id){



					$query2 = $u->CheckSessionCambioUsuario($_SESSION["usuario_real_cambio"]);



					$_SESSION["usuario_real_cambio"] 		 = "";



					$_SESSION["seccional_real_cambio"] 		 = "";



					$_SESSION["area_principal_real_cambio"]  = "";



				}else{



					$_SESSION["usuario_real_cambio"] 		 = $_SESSION["usuario"];



					$_SESSION["seccional_real_cambio"] 		 = $_SESSION["seccional"];



					$_SESSION["area_principal_real_cambio"]  = $_SESSION["area_principal"];



					



					$query2 = $u->CheckSessionCambioUsuario($id);



					if($query2 === false || $query2 == ""){



						$query2 = $u->CheckSessionCambioUsuario($_SESSION["usuario_real_cambio"]);



						$_SESSION["usuario_real_cambio"] 		 = "";



						$_SESSION["seccional_real_cambio"] 		 = "";



						$_SESSION["area_principal_real_cambio"]  = "";



						echo "No se pudo cambiar de usuario. restablecido usuario original";



						exit;



					}



				}



				echo "Cambio de usuario realizado";



			}else{



				echo "No se pudo cambiar de usuario";



			}



		}



		function ChangeEmpresa($id){

			global $con;

			if ($id != "") {

				$_SESSION['71c029wus3yJWEN'] = $id;
				echo "Cambio de Empresa realizado";
			}



		}



		function ChangeEmpresaTRD($id){



			global $con;



			if ($id != "") {



				$_SESSION['id_trd'] = $id;



				echo "Cambio de Version TRD realizado";



			}



		}







		function AbrirOficinas($id){



			global $con;



			global $f;



			global $c;







			$object = new MSeccional;



			$query = $object->ListarSeccional("WHERE principal = '".$id."'");







			while($row = $con->FetchAssoc($query)){



				$l = new MSeccional;



				$l->Createseccional('id', $row[id]);



				echo "<li id='o".$row['id']."' class='list-group-item' onClick='CargarListadoAreas(\"".$row['id']."\", \"".$id."\")' ><div class='waves-effect'>".$l->GetNombre()."<div></li>";



			}



		}



	}



?>