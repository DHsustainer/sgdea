<?
	session_start();
	//Invocando archivos que seran usados en nuestro controlador generico	
	include_once('app/basePaths.inc.php');
	include_once(MODELS.DS.'Dependencias_versionM.php');
	include_once(MODELS.DS.'EstadosxM.php');
	include_once(ROOT.DS.'DALC'.DS.'/mySql.php');
	include_once('consultas.php');
	include_once('funciones.php');	

	// Definiendo variables y conectandonos con la base de datos
	$con = new ConexionBaseDatos;
	$con->Connect($con);
	
	// Llamando al objeto a controlar		
	$ob = new CDependencias_version;
	$c = new Consultas;
	$f = new Funciones;
	
	// DEFINIMOS EN UN VECTOR LOS CAMPOS QUE VAMOS A EDITAR
	$ar2 = array('nombre', 'estado', 'fecha_inicio', 'fecha_fin');
	// DEFINIMOS EN OTRO VECTOR LOS NUEVOS DATOS QUE VAMOS A METER	
	$ar1 = array($c->sql_quote($_REQUEST['nombre']), $c->sql_quote($_REQUEST['estado']), $c->sql_quote($_REQUEST['fecha_inicio']), $c->sql_quote($_REQUEST['fecha_fin']));	
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
			$ob->Insertar($c->sql_quote($_REQUEST["nombre"]), $c->sql_quote($_REQUEST["estado"]), $c->sql_quote($_REQUEST["fecha_inicio"]), $c->sql_quote($_REQUEST["fecha_fin"]));
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
		elseif($c->sql_quote($_REQUEST['action']) == 'verversion')
			$ob->VerVersion($c->sql_quote($_REQUEST['id']));
		elseif($c->sql_quote($_REQUEST['action']) == 'clonarversion')
			$ob->ClonarVersion($c->sql_quote($_REQUEST['id']),$c->sql_quote($_REQUEST['cn']));
		elseif($c->sql_quote($_REQUEST['action']) == 'changeversion')
			$ob->ChangeVersion($c->sql_quote($_REQUEST['id']));
		
		else
		// SI NO ES NINGUNA DE LAS ANTERIORES ENTONCES CARGA POR DEFECTO LA VISTA DE LISTADO		
			$ob->VistaListar('');		
	
	// DEFINIENDO LA CLASE DEL CONTROLADOR DEL OBJETO QUE TIENE HERENCIA CON EL CONTROLADOR GENERICO PARA CARGAR LA INTERFAZ
	class CDependencias_version extends MainController{
		
		// DEFINIENDO LA FUNCION LISTAR 		
		function VistaListar(){
			// CREANDO UN NUEVO MODELO			
			$object = new MDependencias_version;
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			
			global $con;
			//CARGANDO LA PAGINA DE INTERFAZ			
			$pagina = $this->load_template('Listar Dependencias_version');			
			// CARGANDO LLAMANDO LA FUNCION LSITAR LIBROS DEL MODELO (FUNCION QUE TRAE DE LA BASE DE DATOS EL LISTADO DE LIBROS
			// DE NO RECIBIR PARAMETROS ESTA FUNCION TRAE EL LISTADO COMPLETO DE LIBROS
			$query = $object->ListarDependencias_version();	    
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();
				// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO
		   		if($con->NumRows($query) <= 0 || $query !=''){
					// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA
					include_once(VIEWS.DS.'dependencias_version/Listar.php');	   			
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
			$pagina = $this->load_template('Crear Dependencias_version');			
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();
			include_once(VIEWS.DS.'dependencias_version/FormInsertDependencias_version.php');				
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
	 		$pagina = $this->load_template('Editar Dependencias_version');			
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();		
	 		// INVOCAMOS UN NUEVO OBJETO
		 	$object = new MDependencias_version;
			// LO CREAMOS 			
			$object->CreateDependencias_version('id', $x);
			// Y FINALMENTE CARGAMOS LA VISTA DE EDICION QUE MUESTRA EL CONTENIDO			
			include_once(VIEWS.DS.'dependencias_version/FormUpdateDependencias_version.php');		
			// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.											
			$table = ob_get_clean();	
			// ASIGNANDOLE A LA VARIABLE  EL CONTENIDO DEL BUFFER															
			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $table  , $pagina);
			// CARGAMOS LA PAGINA EN EL BROWSER		
			$this->view_page($pagina);
	 	}	
	 	function Buscar($x, $cn = 'id'){
	 		// INVOCAMOS UN NUEVO OBJETO						
			$object = new MDependencias_version;
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL						
			global $con;
			// CARGA EL TEMPLATE						
			$pagina = $this->load_template('Listado de Dependencias_version');			
			// OBTENEMOS EL LISTADO DE LIBROS DE ACUERDO A LOS PARAMETROS QUE LE ENVIAMOS						
			$query = $object->ListarDependencias_version('WHERE '.$cn.' = "'.$x.'"');	    
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();		
		   		if($con->NumRows($query) <= 0 || $query !=''){
					// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO							
					include_once(VIEWS.DS.'dependencias_version/Listar.php');	   			
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
		function Insertar($nombre, $estado, $fecha_inicio, $fecha_fin){
			// DEFINIENDO EL OBJETO			
			$object = new MDependencias_version;
			// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATOA			
			$create = $object->InsertDependencias_version($nombre, $estado, $fecha_inicio, $fecha_fin);
			
			//SI NO SE ENVIO CORRECTAMENTE ENTONCES GENERA ERROR SINO ENVIA OK
			if($create != '1')
				$this->VistaListar('ERROR AL REGISTRAR');
			else
				$this->VistaListar('OK!');	

		}
		// FUNCION QUE RECIBE UNASERIE DE PARAMETROS Y LOS ENVIA A LA BASE DE DATOS PARA ACTUALIZAR UN REGISTRO (FUNCION ESPECIAL)		
		function Editar($constrain, $fields, $updates, $output){
			$object = new MDependencias_version;
			$create = $object->UpdateDependencias_version($constrain, $fields, $updates, $output);					
			
		}

		function VerVersion($id){
			global $con;
			global $f;
			global $c;

			$object = new MDependencias_version;
			// LO CREAMOS 			
			$object->CreateDependencias_version('id', $id);
			// Y FINALMENTE CARGAMOS LA VISTA DE EDICION QUE MUESTRA EL CONTENIDO			
			include_once(VIEWS.DS.'dependencias_version/FormUpdateDependencias_version.php');		

		}

		function ClonarVersion($id_version,$nombre){
			global $con;
			global $f;
			global $c;
			
			/*Crear la version*/
			$sql = "insert into dependencias_version(nombre, estado, fecha_inicio, fecha_fin, id_clon)
				SELECT '$nombre','0',fecha_inicio, fecha_fin, '$id_version'
				FROM dependencias_version
				WHERE id = '$id_version';";
			$con->Query($sql);

			/*obtener el id de la nueva version*/
			$MDependencias_version = new MDependencias_version;
			$MDependencias_version->CreateDependencias_version('nombre',$nombre);
			$id_version_new = $MDependencias_version->GetId();

			/*Se crean las dependencias de la version*/
			$sql = "INSERT INTO dependencias(nombre, dependencia, usuario, fecha, estado, id_c, t_g, t_c, t_h, observacion, es_inmaterial, id_version, no_s, dependencia_inversa, es_publico, titulo_publico, dias_vencimiento, id_clon)
			SELECT nombre, dependencia, '".$_SESSION["usuario"]."', fecha, estado, id_c, t_g, t_c, t_h, observacion, es_inmaterial, '$id_version_new', no_s, dependencia_inversa, es_publico, titulo_publico, dias_vencimiento, id
			FROM dependencias
			WHERE id_version = '$id_version';";
			$con->Query($sql);

			$sql = "update `dependencias` d inner join (select id,id_clon from dependencias where id_version = '$id_version_new') as k on d.dependencia = k.id_clon
			set d.dependencia = k.id
			where d.id_version = '$id_version_new' and d.dependencia > 0";
			$con->Query($sql);

			/*Se crean las areas_dependencias de la version*/
			$sql = "INSERT INTO areas_dependencias(id_area, id_dependencia, usuario, fecha, id_dependencia_raiz, observacion, id_version)
			SELECT id_area, (select id from dependencias where dependencias.id_clon = areas_dependencias.id_dependencia and dependencias.id_version = '$id_version_new'), '".$_SESSION["usuario"]."', fecha, id_dependencia_raiz, observacion, '$id_version_new'
			FROM areas_dependencias
			where id_version = '$id_version';";
			$con->Query($sql);

			$sql = "update `areas_dependencias` ad inner join dependencias on ad.id_dependencia = dependencias.id 
			set ad.id_dependencia_raiz = dependencias.dependencia
			where ad.id_version = '$id_version_new';";
			$con->Query($sql);

			/*Se crean las dependencias_alertas de la version*/
			$sql = "INSERT INTO dependencias_alertas(id_dependencia, usuario, fecha, nombre, dias_alerta, descripcion, dias_antes, automatica, es_publico) 
			SELECT dependencias.id, dependencias_alertas.usuario, dependencias_alertas.fecha, dependencias_alertas.nombre, dependencias_alertas.dias_alerta, dependencias_alertas.descripcion, dependencias_alertas.dias_antes, dependencias_alertas.automatica, dependencias_alertas.es_publico
			FROM dependencias_alertas inner join dependencias on dependencias_alertas.id_dependencia = dependencias.id_clon 
			where dependencias.id_version = '$id_version_new';";
			$con->Query($sql);

			/*Se crean las dependencias_tipologias de la version*/
			$sql = "INSERT INTO dependencias_tipologias(id_dependencia, usuario, fecha, tipologia, estado, requiere_firma, es_inmaterial, es_obligatorio, es_entrada, es_publico, observacion, formato, prioridad, dias_vencimiento, soporte, id_clon) 
			SELECT dependencias.id, dependencias_tipologias.usuario, dependencias_tipologias.fecha, dependencias_tipologias.tipologia, dependencias_tipologias.estado, dependencias_tipologias.requiere_firma, dependencias_tipologias.es_inmaterial, dependencias_tipologias.es_obligatorio, dependencias_tipologias.es_entrada, dependencias_tipologias.es_publico, dependencias_tipologias.observacion, dependencias_tipologias.formato, dependencias_tipologias.prioridad, dependencias_tipologias.dias_vencimiento, dependencias_tipologias.soporte, dependencias_tipologias.id
			FROM dependencias_tipologias inner join dependencias on dependencias_tipologias.id_dependencia = dependencias.id_clon 
			where dependencias.id_version = '$id_version_new';";
			$con->Query($sql);

			/*Se crean las dependencias_tipologias de la version*/
			$sql = "INSERT INTO dependencias_documentos(id_dependencia, usuario, fecha, nombre, tipologia)
			SELECT d.id, dd.usuario, dd.fecha, dd.nombre, dt.id
			FROM dependencias_documentos dd inner join dependencias d on dd.id_dependencia = d.id_clon 
			inner join dependencias_tipologias dt on dd.tipologia = dt.id_clon 
			where d.id_version = '$id_version_new';";
			$con->Query($sql);

			/*Se crean las meta_referencias_titulos de la version con dependencias*/
			$sql = "INSERT INTO meta_referencias_titulos(titulo, tipo, es_generico, id_s, id_clon)
				SELECT mft.titulo, mft.tipo, mft.es_generico, d.id, mft.id
				FROM meta_referencias_titulos as mft inner join dependencias as d on mft.id_s = d.id_clon 
				where mft.tipo = '1' and d.id_version = '$id_version_new';";
			$con->Query($sql);

			/*Se crean las meta_referencias_campos de la version con dependencias*/
			$sql = "INSERT INTO meta_referencias_campos(id_referencia, titulo_campo, tipo_elemento, observacion, visible, es_obligatorio, id_lista, placeholder, columnas, orden)
				SELECT mft.id, mrc.titulo_campo, mrc.tipo_elemento, mrc.observacion, mrc.visible, mrc.es_obligatorio, mrc.id_lista, mrc.placeholder, mrc.columnas, mrc.orden
				FROM meta_referencias_campos mrc inner join meta_referencias_titulos as mft on mrc.id_referencia = mft.id_clon 
				inner join dependencias as d on mft.id_s = d.id_clon 
				where mft.tipo = '1' and d.id_version = '$id_version_new';";
			$con->Query($sql);

			/*Se crean las meta_referencias_titulos de la version con tipologias*/
			$sql = "INSERT INTO meta_referencias_titulos(titulo, tipo, es_generico, id_s, id_clon)
				SELECT mft.titulo, mft.tipo, mft.es_generico, dt.id, mft.id
				FROM meta_referencias_titulos as mft inner join dependencias_tipologias dt on mft.id_s = dt.id_clon inner join dependencias as d on dt.id = d.id 
				where mft.tipo = '2' and d.id_version = '$id_version_new';";
			$con->Query($sql);

			/*Se crean las meta_referencias_campos de la version con tipologias*/
			$sql = "INSERT INTO meta_referencias_campos(id_referencia, titulo_campo, tipo_elemento, observacion, visible, es_obligatorio, id_lista, placeholder, columnas, orden)
				SELECT mft.id, mrc.titulo_campo, mrc.tipo_elemento, mrc.observacion, mrc.visible, mrc.es_obligatorio, mrc.id_lista, mrc.placeholder, mrc.columnas, mrc.orden
				FROM meta_referencias_campos mrc inner join meta_referencias_titulos as mft on mrc.id_referencia = mft.id_clon  
				inner join dependencias_tipologias dt on mft.id_s = dt.id_clon inner join dependencias as d on dt.id = d.id 
				where mft.tipo = '2' and d.id_version = '$id_version_new';";
			$con->Query($sql);

			/*Se crean las wf_mapas de la version con dependencias*/
			$sql = "INSERT INTO wf_mapas(titulo, descripcion, usuario, fecha, id_dependencia, tipo_dependencia, id_clon)
			SELECT wm.titulo, wm.descripcion, wm.usuario, wm.fecha, d.id, wm.tipo_dependencia, wm.id
			FROM wf_mapas wm inner join dependencias as d on wm.id_dependencia = d.id_clon
			WHERE wm.tipo_dependencia = 'S' and d.id_version = '$id_version_new';";
			$con->Query($sql);

			$sql = "INSERT INTO wf_mapas_elementos(id_mapa, id_elemento, titulo, fecha, usuario, id_evento, id_dependencia, titulo_conector)
			SELECT wm.id, wme.id_elemento, wme.titulo, wme.fecha, wme.usuario, wme.id_evento, wme.id_dependencia, wme.titulo_conector
			FROM wf_mapas_elementos wme inner join wf_mapas wm on wme.id_mapa = wm.id_clon 
			inner join dependencias as d on wm.id_dependencia = d.id
			WHERE wm.tipo_dependencia = 'S' and d.id_version = '$id_version_new';";
			$con->Query($sql);			

		}

		function ChangeVersion($id){
			$_SESSION['active_vista'] = $id;
		}
	}
?>
		