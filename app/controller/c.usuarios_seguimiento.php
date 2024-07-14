<?
	session_start();
	//Invocando archivos que seran usados en nuestro controlador generico	
	include_once('app/basePaths.inc.php');
	include_once(MODELS.DS.'Usuarios_seguimientoM.php');
	include_once(MODELS.DS.'UsuariosM.php');
	include_once(ROOT.DS.'DALC'.DS.'/mySql.php');
	include_once('consultas.php');
	include_once('funciones.php');	

	// Definiendo variables y conectandonos con la base de datos
	$con = new ConexionBaseDatos;
	$con->Connect($con);
	
	// Llamando al objeto a controlar		
	$ob = new CUsuarios_seguimiento;
	$c = new Consultas;
	$f = new Funciones;
	
	// DEFINIMOS EN UN VECTOR LOS CAMPOS QUE VAMOS A EDITAR
	$ar2 = array('usuario_seguimiento', 'username', 'observacion', 'fecha', 'tipo_seguimiento');
	// DEFINIMOS EN OTRO VECTOR LOS NUEVOS DATOS QUE VAMOS A METER	
	$ar1 = array($c->sql_quote($_REQUEST['usuario_seguimiento']), $c->sql_quote($_REQUEST['username']), $c->sql_quote($_REQUEST['observacion']), $c->sql_quote($_REQUEST['fecha']), $c->sql_quote($_REQUEST['tipo_seguimiento']));	
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
			$ob->VistaInsertar($c->sql_quote($_REQUEST['id']));
		// SINO SI ES INSERTAR ENTONCES CARGA EL INSERTAR	
		elseif($c->sql_quote($_REQUEST['action']) == 'registrar')
		// CAPTURA LAS VARIAABLES Y ENVIALAS A LA FUNCION INSERTAR		
			$ob->Insertar($c->sql_quote($_REQUEST["usuario_seguimiento"]), $c->sql_quote($_REQUEST["username"]), $c->sql_quote($_REQUEST["observacion"]), $c->sql_quote($_REQUEST["fecha"]), $c->sql_quote($_REQUEST["tipo_seguimiento"]));
		// SINO SI ES EDITAR ENTONCES CARGA EL FORMULARIO EDITAR	
		elseif($c->sql_quote($_REQUEST['action']) == 'registrarvencimiento')
		// CAPTURA LAS VARIAABLES Y ENVIALAS A LA FUNCION INSERTAR		
			$ob->registrarvencimiento($c->sql_quote($_REQUEST["usuario_seguimiento"]), $c->sql_quote($_REQUEST["username"]), $c->sql_quote($_REQUEST["observacion"]), $c->sql_quote($_REQUEST["fecha"]), $c->sql_quote($_REQUEST["tipo_seguimiento"]), $c->sql_quote($_REQUEST["fecha_vencimiento"]), $c->sql_quote($_REQUEST["v_recarga"]));
		
		elseif($c->sql_quote($_REQUEST['action']) == 'editar')
			$ob->VistaEditar($c->sql_quote($_REQUEST['id']));	
		// SINO SI ES ACTUALIZAR ENTONCES ENVIA UNA ACTUALIZACION CON LOS PARAMETROS CAPTURADOS
		elseif($c->sql_quote($_REQUEST['action']) == 'actualizar')
			$ob->Editar($constrain, $ar2, $ar1, $output);
		// SINO SI ES ELIMINAR ENTONCES CARGA LA FUNCION ELIMINAR
		elseif($c->sql_quote($_REQUEST['action']) == 'eliminar')
			$ob->Eliminar($c->sql_quote($_REQUEST['id']));
		// SINO SI ES NUEVO BUSCAR CARGA EL BUSCADOR			
		elseif($c->sql_quote($_REQUEST['action']) == 'updatecredit')
			$ob->ActualizarCredito($c->sql_quote($_REQUEST['username']), $c->sql_quote($_REQUEST['actualizar']));

		elseif($c->sql_quote($_REQUEST['action']) == 'updateendeudamiento')
			$ob->ActualizarEndeudamiento($c->sql_quote($_REQUEST['username']), $c->sql_quote($_REQUEST['actualizar']));
		
		elseif($c->sql_quote($_REQUEST['action']) == 'vermovimientos')
			$ob->HistorialUSuario($c->sql_quote($_REQUEST['id']));
		elseif($c->sql_quote($_REQUEST['action']) == 'vermovimientosrenovaciones')
			$ob->HistorialUSuarioRenovaciones($c->sql_quote($_REQUEST['id']));
		
		elseif($c->sql_quote($_REQUEST['action']) == 'buscar')
			$ob->Buscar($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']));		


		elseif($c->sql_quote($_REQUEST['action']) == 'updatefcita')
			$ob->ActualizarFechaCita($c->sql_quote($_REQUEST['username']), $c->sql_quote($_REQUEST['actualizar']));
		elseif($c->sql_quote($_REQUEST['action']) == 'updatehrcita')
			$ob->ActualizarHoracita($c->sql_quote($_REQUEST['username']), $c->sql_quote($_REQUEST['actualizar']));
		else
		// SI NO ES NINGUNA DE LAS ANTERIORES ENTONCES CARGA POR DEFECTO LA VISTA DE LISTADO		
			$ob->VistaListar('');		
	
	// DEFINIENDO LA CLASE DEL CONTROLADOR DEL OBJETO QUE TIENE HERENCIA CON EL CONTROLADOR GENERICO PARA CARGAR LA INTERFAZ
	class CUsuarios_seguimiento extends MainController{
		
		// DEFINIENDO LA FUNCION LISTAR 		
		function VistaListar(){
			// CREANDO UN NUEVO MODELO			
			$object = new MUsuarios_seguimiento;
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			
			global $con;
			//CARGANDO LA PAGINA DE INTERFAZ			
			include_once(VIEWS.DS.'usuarios_seguimiento/Listar.php');	   			
		}
		// FUNCION QUE CARGA LA VISTA DE INSERTAR (FORMULARIO DE INSERTAR)
		function VistaInsertar($userid){
			global $con;
			global $c;
			global $f;

			include_once(VIEWS.DS.'usuarios_seguimiento/FormInsertUsuarios_seguimiento.php');				
		}
		// FUCNION QUE CARGA LA VISTA PARA EDITAR EL CONTENIDO DE UN REGISTRO
		function VistaEditar($x){
			// CARGA EL TEMPLATE			
	 		$pagina = $this->load_template('Editar Usuarios_seguimiento');			
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();		
	 		// INVOCAMOS UN NUEVO OBJETO
		 	$object = new MUsuarios_seguimiento;
			// LO CREAMOS 			
			$object->CreateUsuarios_seguimiento('id', $x);
			// Y FINALMENTE CARGAMOS LA VISTA DE EDICION QUE MUESTRA EL CONTENIDO			
			include_once(VIEWS.DS.'usuarios_seguimiento/FormUpdateUsuarios_seguimiento.php');		
			// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.											
			$table = ob_get_clean();	
			// ASIGNANDOLE A LA VARIABLE  EL CONTENIDO DEL BUFFER															
			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $table  , $pagina);
			// CARGAMOS LA PAGINA EN EL BROWSER		
			$this->view_page($pagina);
	 	}	
	 	function Buscar($x, $cn = 'id'){
	 		// INVOCAMOS UN NUEVO OBJETO						
			$object = new MUsuarios_seguimiento;
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL						
			global $con;
			// CARGA EL TEMPLATE						
			$pagina = $this->load_template('Listado de Usuarios_seguimiento');			
			// OBTENEMOS EL LISTADO DE LIBROS DE ACUERDO A LOS PARAMETROS QUE LE ENVIAMOS						
			$query = $object->ListarUsuarios_seguimiento('WHERE '.$cn.' = "'.$x.'"');	    
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();		
		   		if($con->NumRows($query) <= 0 || $query !=''){
					// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO							
					include_once(VIEWS.DS.'usuarios_seguimiento/Listar.php');	   			
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
		function Insertar($usuario_seguimiento, $username, $observacion, $fecha, $tipo_seguimiento){
			// DEFINIENDO EL OBJETO			
			$object = new MUsuarios_seguimiento;
			// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATOA			
			$create = $object->InsertUsuarios_seguimiento($usuario_seguimiento, $username, $observacion, date("Y-m-d H:i:s"), $tipo_seguimiento);

		}
		// FUNCION QUE RECIBE UNASERIE DE PARAMETROS Y LOS ENVIA A LA BASE DE DATOS PARA ACTUALIZAR UN REGISTRO (FUNCION ESPECIAL)		
		function Editar($constrain, $fields, $updates, $output){
			$object = new MUsuarios_seguimiento;
			$create = $object->UpdateUsuarios_seguimiento($constrain, $fields, $updates, $output);
			
			//SI NO SE ENVIO CORRECTAMENTE ENTONCES GENERA ERROR SINO ENVIA OK
			if($create != '1')
				$this->VistaListar('ERROR AL REGISTRAR');
			else
				$this->VistaListar('OK!');						
			
		}
		// FUCNION QUE RECIBE UN PARAMETRO Y ELIMINA EL REGISTRO DE LA BASE DE DATOS		
		function Eliminar($id){
			// DEFINIMOS UN OBJETO NUEVO						
			$object = new MUsuarios_seguimiento;
			// LLAMAMOS A LA FUNCION QUE EJECUTA LA ELIMINACION.			
			$delete = $object->DeleteUsuarios_seguimiento($id); 		
			//SI NO SE ENVIO CORRECTAMENTE ENTONCES GENERA ERROR SINO ENVIA OK
			if($delete != '1')
				echo 'ERROR AL ELIMINAR';
			else
				echo 'OK!';			
			
		}

		function ActualizarCredito($user, $credito){
			global $c;
			global $f;
			global $con;

			$u = new MUsuarios;
			$u->CreateUsuarios("user_id", $user);

			$cupoactual = $u->GetCupo();

			$observacion = "Se Actualizó el Saldo del Usuario de $cupoactual a $credito";

			$con->Query("update usuarios set cupo = '$credito' where user_id = '$user'");

			$this->Insertar($user, $_SESSION['usuario'], $observacion, date("Y-m-d H:i:s"), "2");

			$MPlantillas_email = new MPlantillas_email;

			$MPlantillas_email->CreatePlantillas_email('id', '75');
			

			$contenido_email = $MPlantillas_email->GetContenido();

			$contenido_email = str_replace("[elemento]USUARIO[/elemento]", $u->GetP_nombre()." ".$u->GetP_apellido(),$contenido_email );
			$contenido_email = str_replace("[elemento]MENSAJE[/elemento]",$observacion,     	   $contenido_email );
			$contenido_email = str_replace("[elemento]PROJECTNAME[/elemento]",      PROJECTNAME,   $contenido_email );
			$contenido_email = str_replace("[elemento]LOGO[/elemento]",      '<img src="'.HOMEDIR.'/app/plugins/thumbnails/'.$c->getLogo().'" width="150px">',   $contenido_email );


			$c->fnEnviaEmailGlobal(CONTACTMAIL,PROJECTNAME,$MPlantillas_email->GetNombre(),$contenido_email,$user);


		}

		function ActualizarEndeudamiento($user, $credito){
			global $c;
			global $f;
			global $con;

			$u = new MUsuarios;
			$u->CreateUsuarios("user_id", $user);

			$cupoactual = $u->GetCupousuario();

			$observacion = "Se Actualizo la capacidad de endeudamiento del Usuario de $cupoactual a $credito";

			$con->Query("update usuarios set cupo_usuario = '$credito' where user_id = '$user'");
			$this->Insertar($user, $_SESSION['usuario'], $observacion, date("Y-m-d H:i:s"), "2");
			$MPlantillas_email = new MPlantillas_email;
			$MPlantillas_email->CreatePlantillas_email('id', '75');
			$contenido_email = $MPlantillas_email->GetContenido();

			$contenido_email = str_replace("[elemento]USUARIO[/elemento]", $u->GetP_nombre()." ".$u->GetP_apellido(),$contenido_email );
			$contenido_email = str_replace("[elemento]MENSAJE[/elemento]",$observacion,     	   $contenido_email );
			$contenido_email = str_replace("[elemento]PROJECTNAME[/elemento]",      PROJECTNAME,   $contenido_email );
			$contenido_email = str_replace("[elemento]LOGO[/elemento]",      '<img src="'.HOMEDIR.'/app/plugins/thumbnails/'.$c->getLogo().'" width="150px">',   $contenido_email );

			$c->fnEnviaEmailGlobal(CONTACTMAIL,PROJECTNAME,$MPlantillas_email->GetNombre(),$contenido_email,$user);

		}


		function HistorialUSuario($userid){
			global $con;
			global $f;
			global $c;

			$u = new Musuarios;
			$u->CreateUSuarios("user_id", $userid);

			echo '<div class="row">
					<div class="col-md-12">';

			$object = new MUsuarios_seguimiento;
			$query = $object->ListarUsuarios_seguimiento('WHERE usuario_seguimiento = "'.$userid.'" and tipo_seguimiento = "2"');	    

			if($con->NumRows($query) <= 0 || $query !=''){
				// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO	
				include_once(VIEWS.DS.'usuarios_seguimiento/Listar.php');	   			
			}else{
				echo "<div class='alert alert-info'>No se han creado seguimientos al usuario</div>";
			}

			echo '	</div>
				</div>';

		}

		function vermovimientosrenovaciones($userid){
			global $con;
			global $f;
			global $c;

			$u = new Musuarios;
			$u->CreateUSuarios("user_id", $userid);

			echo '<div class="row">
					<div class="col-md-12">';

			$object = new MUsuarios_seguimiento;
			$query = $object->ListarUsuarios_seguimiento('WHERE usuario_seguimiento = "'.$userid.'" and tipo_seguimiento = "2"');	    

			if($con->NumRows($query) <= 0 || $query !=''){
				// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO	
				include_once(VIEWS.DS.'usuarios_seguimiento/Listar.php');	   			
			}else{
				echo "<div class='alert alert-info'>No se han creado seguimientos al usuario</div>";
			}

			echo '	</div>
				</div>';

		}

		function HistorialUSuarioRenovaciones($userid){
			global $con;
			global $f;
			global $c;

			$u = new Musuarios;
			$u->CreateUSuarios("user_id", $userid);

			echo '<div class="row">
					<div class="col-md-4">';

			include_once(VIEWS.DS.'usuarios_seguimiento/IsertarSeguimiento.php');

			echo '	</div>
					<div class="col-md-8">';		

			$object = new MUsuarios_seguimiento;
			$query = $object->ListarUsuarios_seguimiento('WHERE usuario_seguimiento = "'.$userid.'" and tipo_seguimiento = "2"');	    

			if($con->NumRows($query) <= 0 || $query !=''){
				// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO	
				include_once(VIEWS.DS.'usuarios_seguimiento/Listar.php');	   			
			}else{
				echo "<div class='alert alert-info'>No se han creado seguimientos al usuario</div>";
			}

			echo '	</div>
				</div>';

		}
		function registrarvencimiento($usuario_seguimiento, $username, $observacion2, $fecha, $tipo_seguimiento, $fvencimiento, $vpago){

			global $con;
			global $f;
			global $c;

			$u = new MUsuarios;
			$u->CreateUsuarios("user_id", $usuario_seguimiento);


			$con->Query("update usuarios set f_caducidad = '".$fvencimiento."' where user_id = '".$usuario_seguimiento."'");
			$observacion = 'El Usuario realizo una compra por un valor de '.$vpago.' su nueva fecha de corte es'.$fvencimiento;

			$this->Insertar($usuario_seguimiento, $_SESSION['usuario'], $observacion, date("Y-m-d H:i:s"), "2");

			$MPlantillas_email = new MPlantillas_email;
			$MPlantillas_email->CreatePlantillas_email('id', '75');

			$contenido_email = $MPlantillas_email->GetContenido();

			$contenido_email = str_replace("[elemento]USUARIO[/elemento]", $u->GetP_nombre()." ".$u->GetP_apellido(),$contenido_email );
			$contenido_email = str_replace("[elemento]MENSAJE[/elemento]",$observacion,     	   $contenido_email );
			$contenido_email = str_replace("[elemento]PROJECTNAME[/elemento]",      PROJECTNAME,   $contenido_email );
			$contenido_email = str_replace("[elemento]LOGO[/elemento]",      '<img src="'.HOMEDIR.'/app/plugins/thumbnails/'.$c->getLogo().'" width="150px">',   $contenido_email );


		//	$c->fnEnviaEmailGlobal(CONTACTMAIL,PROJECTNAME,$MPlantillas_email->GetNombre(),$contenido_email,$usuario_seguimiento);

		}


		function ActualizarFechaCita($user, $credito){
			global $c;
			global $f;
			global $con;

			$u = new MUsuarios;
			$u->CreateUsuarios("user_id", $user);

			$cupoactual = $u->Getfecha_capacitacion();

			$observacion = "Se Actualizo la fecha de capacitacion del Usuario de $cupoactual a $credito";

			$con->Query("update usuarios set fecha_capacitacion = '$credito' where user_id = '$user'");
			$this->Insertar($user, $_SESSION['usuario'], $observacion, date("Y-m-d H:i:s"), "2");
			$MPlantillas_email = new MPlantillas_email;
			$MPlantillas_email->CreatePlantillas_email('id', '75');
			$contenido_email = $MPlantillas_email->GetContenido();

			$contenido_email = str_replace("[elemento]USUARIO[/elemento]", $u->GetP_nombre()." ".$u->GetP_apellido(),$contenido_email );
			$contenido_email = str_replace("[elemento]MENSAJE[/elemento]",$observacion,     	   $contenido_email );
			$contenido_email = str_replace("[elemento]PROJECTNAME[/elemento]",      PROJECTNAME,   $contenido_email );
			$contenido_email = str_replace("[elemento]LOGO[/elemento]",      '<img src="'.HOMEDIR.'/app/plugins/thumbnails/'.$c->getLogo().'" width="150px">',   $contenido_email );

			#$c->fnEnviaEmailGlobal(CONTACTMAIL,PROJECTNAME,$MPlantillas_email->GetNombre(),$contenido_email,$user);

		}


		function ActualizarHoracita($user, $credito){
			global $c;
			global $f;
			global $con;

			$u = new MUsuarios;
			$u->CreateUsuarios("user_id", $user);

			$cupoactual = $u->Gethora_capacitacion();

			$observacion = "Se Actualizo la hora de capacitacion del Usuario de $cupoactual a $credito";

			$con->Query("update usuarios set hora_capacitacion = '$credito' where user_id = '$user'");
			$this->Insertar($user, $_SESSION['usuario'], $observacion, date("Y-m-d H:i:s"), "2");
			$MPlantillas_email = new MPlantillas_email;
			$MPlantillas_email->CreatePlantillas_email('id', '75');
			$contenido_email = $MPlantillas_email->GetContenido();

			$contenido_email = str_replace("[elemento]USUARIO[/elemento]", $u->GetP_nombre()." ".$u->GetP_apellido(),$contenido_email );
			$contenido_email = str_replace("[elemento]MENSAJE[/elemento]",$observacion,     	   $contenido_email );
			$contenido_email = str_replace("[elemento]PROJECTNAME[/elemento]",      PROJECTNAME,   $contenido_email );
			$contenido_email = str_replace("[elemento]LOGO[/elemento]",      '<img src="'.HOMEDIR.'/app/plugins/thumbnails/'.$c->getLogo().'" width="150px">',   $contenido_email );

			#$c->fnEnviaEmailGlobal(CONTACTMAIL,PROJECTNAME,$MPlantillas_email->GetNombre(),$contenido_email,$user);

		}
	}
?>
		