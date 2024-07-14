<?

	session_start();

	//Invocando archivos que seran usados en nuestro controlador generico	

	include_once('app/basePaths.inc.php');

	include_once(MODELS.DS.'UsuariosM.php');

	include_once(MODELS.DS.'CaratulaM.php');

	include_once(VIEWS.DS.'events'.DS.'calendar.php');	

	include_once(MODELS.DS.'Super_adminM.php');

	include_once(MODELS.DS.'NotificacionesM.php');

	include_once(MODELS.DS.'Demandado_procesoM.php');

	include_once(MODELS.DS.'GestionM.php');

	include_once(MODELS.DS.'SeccionalM.php');

	include_once(MODELS.DS.'AreasM.php');

	include_once(MODELS.DS.'Seccional_principalM.php');

	include_once(MODELS.DS.'Suscriptores_contactosM.php');

	include_once(MODELS.DS.'Areas_dependenciasM.php');

	include_once(MODELS.DS.'DependenciasM.php');

	include_once(MODELS.DS.'Dependencias_tipologiasM.php');

	include_once(MODELS.DS.'FolderM.php');

	include_once(MODELS.DS.'CityM.php');

	include_once(MODELS.DS.'ProvinceM.php');

	##include_once(PLUGINS.DS.'PHPMailer_5.2.4/class.phpmailer.php');	



	include_once(ROOT.DS.'DALC'.DS.'/mySql.php');

	include_once('consultas.php');

	include_once('funciones.php');	





	// Definiendo variables y conectandonos con la base de datos

	$con = new ConexionBaseDatos;

	$con->Connect($con);

	

	// Llamando al objeto a controlar		

	$ob = new CAreas;

	$c = new Consultas;

	$f = new Funciones;

	

	// DEFINIMOS EN UN VECTOR LOS CAMPOS QUE VAMOS A EDITAR

	$ar2 = array('user_id', 'nombre', 'prefijo');

	// DEFINIMOS EN OTRO VECTOR LOS NUEVOS DATOS QUE VAMOS A METER	

	$ar1 = array($c->sql_quote($_REQUEST['user_id']), $c->sql_quote($_REQUEST['nombre']), $c->sql_quote($_REQUEST['prefijo']));	

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

			$ob->Insertar($c->sql_quote($_REQUEST["user_id"]), $c->sql_quote($_REQUEST["nombre"]), $c->sql_quote($_REQUEST["prefijo"]));

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

		elseif($c->sql_quote($_REQUEST['action']) == 'childs')

			$ob->GetChilds($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']));	

		elseif($c->sql_quote($_REQUEST['action']) == 'GetNuevaArea')

			$ob->GetNuevaArea();

		elseif($c->sql_quote($_REQUEST['action']) == 'abrirareas')
			#echo "<li>prueba</li>";
			$ob->AbrirAreas($c->sql_quote($_REQUEST['id']), $c->sql_quote($_REQUEST['cn']));	

		else

		// SI NO ES NINGUNA DE LAS ANTERIORES ENTONCES CARGA POR DEFECTO LA VISTA DE LISTADO		

			$ob->VistaListar('');		

	

	// DEFINIENDO LA CLASE DEL CONTROLADOR DEL OBJETO QUE TIENE HERENCIA CON EL CONTROLADOR GENERICO PARA CARGAR LA INTERFAZ

	class CAreas extends MainController{

		

		// DEFINIENDO LA FUNCION LISTAR 		

		function VistaListar(){

			// CREANDO UN NUEVO MODELO			

			$object = new MAreas;

			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			

			global $con;

			//CARGANDO LA PAGINA DE INTERFAZ			

			$pagina = $this->load_template('Listar '.CAMPOAREADETRABAJO);			

			// CARGANDO LLAMANDO LA FUNCION LSITAR LIBROS DEL MODELO (FUNCION QUE TRAE DE LA BASE DE DATOS EL LISTADO DE LIBROS

			// DE NO RECIBIR PARAMETROS ESTA FUNCION TRAE EL LISTADO COMPLETO DE LIBROS

			$query = $object->ListarAreas();	    

			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.

			ob_start();

				// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO

		   		if($con->NumRows($query) <= 0 || $query !=''){

					// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA

					include_once(VIEWS.DS.'areas/Listar.php');	   			

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

			$pagina = $this->load_template('Crear '.CAMPOAREADETRABAJO);			

			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.

			ob_start();

			include_once(VIEWS.DS.'areas/FormInsertAreas.php');				

			// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.						

			$path = ob_get_clean();	

			// ASIGNANDOLE A LA VARIABLE  EL CONTENIDO DEL BUFFER																																																															

			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $path  , $pagina);

			// CARGAMOS LA PAGINA EN EL BROWSER	

			$this->view_page($pagina);		

		}

		// FUCNION QUE CARGA LA VISTA PARA EDITAR EL CONTENIDO DE UN REGISTRO

		function VistaEditar($x){



		 	$object = new MAreas;

			// LO CREAMOS 			

			$object->CreateAreas('id', $x);

			// Y FINALMENTE CARGAMOS LA VISTA DE EDICION QUE MUESTRA EL CONTENIDO			

			include_once(VIEWS.DS.'areas/FormUpdateAreas.php');		

	 	}	

	 	function Buscar($x, $cn = 'id'){

	 		// INVOCAMOS UN NUEVO OBJETO						

			$object = new MAreas;

			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL						

			global $con;

			// CARGA EL TEMPLATE						

			$pagina = $this->load_template('Listado de '.CAMPOAREADETRABAJO);			

			// OBTENEMOS EL LISTADO DE LIBROS DE ACUERDO A LOS PARAMETROS QUE LE ENVIAMOS						

			$query = $object->ListarAreas('WHERE '.$cn.' = "'.$x.'"');	    

			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.

			ob_start();		

		   		if($con->NumRows($query) <= 0 || $query !=''){

					// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO							

					include_once(VIEWS.DS.'areas/Listar.php');	   			

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

		function Insertar($user_id, $nombre, $prefijo){

			// DEFINIENDO EL OBJETO			

			global $con;
			global $c;
			global $f;

			$object = new MAreas;



			$query = $object->ListarAreas();



			if ($prefijo == "" || $prefijo == "0") {

				$prefijo = $f->zerofill($con->NumRows($query)+1, 4);

			}

			// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATOA			

			$create = $object->InsertAreas($user_id, $nombre, $prefijo);

			

			// DE NO RECIBIR PARAMETROS ESTA FUNCION TRAE EL LISTADO COMPLETO DE LIBROS

			$query = $object->ListarAreas();	    

			include(VIEWS.DS."areas".DS."Listar.php");



		}

		// FUNCION QUE RECIBE UNASERIE DE PARAMETROS Y LOS ENVIA A LA BASE DE DATOS PARA ACTUALIZAR UN REGISTRO (FUNCION ESPECIAL)		

		function Editar($constrain, $fields, $updates, $output){

			$object = new MAreas;

			$create = $object->UpdateAreas($constrain, $fields, $updates, $output);

			

			echo '<script> window.location.href = "'.HOMEDIR.DS.'herramientas/areas/#grup"</script>';			

			

		}

		// FUCNION QUE RECIBE UN PARAMETRO Y ELIMINA EL REGISTRO DE LA BASE DE DATOS		

		function Eliminar($id){

			// DEFINIMOS UN OBJETO NUEVO						

			$object = new MAreas;

			// LLAMAMOS A LA FUNCION QUE EJECUTA LA ELIMINACION.			

			$delete = $object->DeleteAreas($id); 		

			//SI NO SE ENVIO CORRECTAMENTE ENTONCES GENERA ERROR SINO ENVIA OK

			if($delete != '1')

				echo 'ERROR AL ELIMINAR';

			else

				echo 'OK!';			

			

		}

		function GetChilds($id, $type){

			global $con;

			global $f;



			$_SESSION['area_principal'] = $id;



			$id = $_SESSION['suscriptor_id'];

			// CREANDO UN NUEVO MODELO	

			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			

			$pagina = $this->load_template(PROJECTNAME.ST." Sub Series");

			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.

			ob_start();				

			// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA

#			include_once(VIEWS.DS.'events/default.php');	   			



			$g = new MGestion;

			$qn = $g->ListarGestion("inner join gestion_suscriptores on gestion_suscriptores.id_gestion = gestion.id where ciudad = '".$_SESSION['ciudad']."' and oficina = '".$_SESSION['seccional']."' and dependencia_destino = '".$_SESSION['area_principal']."' and gestion_suscriptores.id_suscriptor = '".$_SESSION['suscriptor_id']."' group by id_dependencia_raiz", "", "");

		/*

				CIUDAD  = CIUDAD

				OFICINA = OFICINA

				AREA PRINCIPAL = DEPENDENCIA_DESTINO

				SERIE = ID_DEPENDENCIA_RAIZ

				SUBSERIE = TIPO_DOCUMENTO				

		*/



			$csusc = new MSuscriptores_contactos;

			$csusc->CreateSuscriptores_contactos("id", $id);



			$sc = new MSeccional;

			$sc->CreateSeccional("id", $_SESSION['seccional']);



			$c = new MCity;

			$c->CreateCity("code", $_SESSION['ciudad']);			



			$ar = new MAreas;

			$ar->CreateAreas("id", $_SESSION['area_principal']);			





			echo '	

					<div id="tools-content">

						<div class="opc-folder blue">

							<div class="ico-content-ps">

								<a href="/gestion/nuevo/"><div class="icon schedule hight-blue"></div></a>

							</div>

							<div class="header-agenda">

								

								<div class="boton-new-proces-blankspace" style="float: left"></div>

								

								<div id="boton-new-proces" style="float: left">

									<a class="no_link" href="/dashboard/">

										<div >'.$_SESSION['nombre'].'</div>

									</a>

								</div>



								<div class="boton-new-proces-blankspace" style="float: left"></div>

								

								<div id="boton-new-proces" style="float: left">

									<a class="no_link" href="/city/childs/'.$c->GetCode().'/0/">

										<div >

											'.$c->GetName().'

										</div>

									</a>

								</div>



								<div class="boton-new-proces-blankspace" style="float: left"></div>

								

								<div id="boton-new-proces" style="float: left">

									<a class="no_link" href="/seccional/childs/'.$sc->GetId().'/0/">

										<div >

											'.$sc->GetNombre().'

										</div>

									</a>

								</div>



								<div class="boton-new-proces-blankspace" style="float: left"></div>			

								

								<div id="boton-new-proces" style="float: left">

									<a class="no_link" href="/areas/childs/'.$ar->GetId().'/0/">

										<div >

											'.$ar->GetNombre().'

										</div>

									</a>

								</div>



								

							</div>

						</div>

					</div>

					<div id="folders-content">

						<div id="folders-list-content">

							<div class="title">Listado de Series Documentales</div><br>

						';

			while ($ro2 = $con->FetchAssoc($qn)) {

				$s = new MDependencias;

				$s->CreateDependencias("id", $ro2['id_dependencia_raiz']);

?>

				<div class='newblock_suscriptor' onclick='window.location.href ="/suscriptores_contactos/dependenciassus2/<?= $id ?>/<?= $s->GetId() ?>/"'>

					<div class='icono'>

						<div class="myicon"></div>

					</div>

					<div class='nombre'><?php echo $s->GetNombre() ?></div>

					<div class='num_exp'><?= $f->Zerofill($s->GetId(), 3) ?></div>

				</div>

<?					

		

			}

			echo '		</div>

					</div>';



						// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.			

			$table = ob_get_clean();	

			// SI NO TRAE NINGUNA VARIABLE ENTONCES GENERA UN ERROR

			// DE LO CONTRARIO ENTONCES CARGA EL CONTENIDO DE LA PAGINA																

			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $table , $pagina);

			// RETORNAME LA PAGINA CARGADA		

			$this->view_page($pagina);

		}



		function GetNuevaArea(){

			global $con;

			echo trim($con->Result($con->Query("select max(id) as id from areas"), 0, 'id'));

		}

		function AbrirAreas($oficina, $ciudad){
			global $con;
			global $f;
			global $c;

			$sql = "select *,(SELECT count(*) FROM usuarios u inner join usuarios_configurar_accesos c on u.user_id = c.user_id where c.tabla='usuario' and id_tabla = concat(u.a_i,areas.id,'$oficina')) cantidad_usuarios from areas";
			$lits = $con->Query($sql);
			
			while($row = $con->FetchAssoc($lits)){

				/*$r = new MAreas;
				$r->CreateAreas("id", $row['regimen']);*/

				echo "<li id ='ax".$row['id']."' class='list-group-item' onClick='CargarListadoUsuarios(\"".$row['id']."\", \"".$oficina."\")' ><div class='waves-effect'>".$row['nombre']." (".$row['cantidad_usuarios'].")</div></li>";
			}
			#echo "<li class='titulolista'>Habilitar Area <span class='fa fa-plus-circle'></span> </li>";
		}

	}

?>

		