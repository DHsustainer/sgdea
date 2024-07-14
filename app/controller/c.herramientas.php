<?php 
session_start();
date_default_timezone_set("America/Bogota");
#error_reporting(E_ALL);
#ini_set('display_errors', '1');
	//Invocando archivos que seran usados en nuestro controlador generico	
	include_once('app/basePaths.inc.php');
	include_once(MODELS.DS.'UsuariosM.php');
	include_once(MODELS.DS.'PlantillaM.php');
	include_once(MODELS.DS.'Super_adminM.php');
	include_once(MODELS.DS.'MemorialesM.php');
	include_once(MODELS.DS.'FuentesM.php');
	include_once(MODELS.DS.'AreasM.php');
	include_once(MODELS.DS.'SeccionalM.php');
	include_once(MODELS.DS.'DependenciasM.php');
	include_once(MODELS.DS.'Dian_facturacionM.php');
	include_once(MODELS.DS.'Estados_gestionM.php');
	include_once(MODELS.DS.'Seccional_principalM.php');
	include_once(MODELS.DS.'Suscriptores_contactosM.php');
	include_once(MODELS.DS.'Suscriptores_contactos_direccionM.php');
	include_once(MODELS.DS.'Suscriptores_tiposM.php');
	include_once(MODELS.DS.'Alertas_usuariosM.php');
	include_once(MODELS.DS.'Super_adminM.php');
	include_once(MODELS.DS.'CityM.php');
	include_once(MODELS.DS.'ProvinceM.php');
	include_once(MODELS.DS.'Dependencias_versionM.php');
	include_once(MODELS.DS.'GestionM.php');
	include_once(MODELS.DS.'Usuarios_configurar_accesosM.php');
	include_once(MODELS.DS.'Solicitudes_documentosM.php');
	include_once(MODELS.DS.'Gestion_compartirM.php');
	##include_once(PLUGINS.DS.'PHPMailer_5.2.4/class.phpmailer.php');	
	include_once(MODELS.DS.'Plantillas_emailM.php');
	include_once(MODELS.DS.'Events_gestionM.php');
	include_once(MODELS.DS.'KeywordsM.php');
	include_once(ROOT.DS.'DALC'.DS.'/mySql.php');
	include_once('consultas.php');
	include_once('funciones.php');
	include_once('EnLetras.php');	
	// Definiendo variables y conectandonos con la base de datos
	$con = new ConexionBaseDatos;
	$con->Connect($con);
	$EL=new EnLetras;
	// Llamando al objeto a controlar		
	$ob = new CHerramientas;
	$c = new Consultas;
	$f = new Funciones;
	$user = new MUsuarios;
	$_SESSION["helper"] = "gestion";	
		if($c->sql_quote($_REQUEST['action']) == 'plantillas')
			$ob->VistaPlantilla('');
		elseif($c->sql_quote($_REQUEST['action']) == 'plantilla')
			$ob->Load_Plantilla($c->sql_quote($_REQUEST[id]));
		elseif($c->sql_quote($_REQUEST['action']) == 'save_plantilla')
			$ob->Save_Plantilla();
		elseif($c->sql_quote($_REQUEST['action']) == 'save_file')
			$ob->Save_File();
		elseif($c->sql_quote($_REQUEST['action']) == 'naturalezas')
			$ob->Naturalezas();
		elseif($c->sql_quote($_REQUEST['action']) == 'juzgados')
			$ob->Juzgados();
		elseif($c->sql_quote($_REQUEST['action']) == 'refreshdoc')
			$ob->RefreshTemplate($c->sql_quote($_REQUEST['id']));
		elseif($c->sql_quote($_REQUEST['action']) == 'editarperfil')
			$ob->EditProfile($c->sql_quote($_REQUEST['id']));
		elseif($c->sql_quote($_REQUEST['action']) == 'actualizarperfil'){
			$ob->ActualizarPerfilUsuario();
		}
		elseif($c->sql_quote($_REQUEST['action']) == 'registrar')
			$ob->RegistrarUsuario($c->sql_quote($_REQUEST['id']));
		elseif($c->sql_quote($_REQUEST['action']) == 'empresa' || $c->sql_quote($_REQUEST['action']) == 'gestion' || $c->sql_quote($_REQUEST['action']) == 'areas' || $c->sql_quote($_REQUEST['action']) == 'oficinas' || $c->sql_quote($_REQUEST['action']) == 'usuarios' || $c->sql_quote($_REQUEST['action']) == 'suscriptores' ||  $c->sql_quote($_REQUEST['action']) == 'otras' ||  $c->sql_quote($_REQUEST['action']) == 'plantillas')
			$ob->LoadHerramientas($c->sql_quote($_REQUEST['action']));
		elseif($c->sql_quote($_REQUEST['action']) == 'CompartirExpedientesUsuarios')
			$ob->CompartirExpedientesUsuarios($c->sql_quote($_REQUEST['id']));
		elseif($c->sql_quote($_REQUEST['action']) == 'RegistrarCompartirExpedientesUsuarios')
			$ob->RegistrarCompartirExpedientesUsuarios($c->sql_quote($_REQUEST['id']));
		elseif($c->sql_quote($_REQUEST['action']) == 'TransferirExpedientesUsuarios')
			$ob->TransferirExpedientesUsuarios($c->sql_quote($_REQUEST['id']));
		elseif($c->sql_quote($_REQUEST['action']) == 'RegistrarTransferirExpedientesUsuarios')
			$ob->RegistrarTransferirExpedientesUsuarios($c->sql_quote($_REQUEST['id']));		
		else
			$ob->LoadHerramientas('usuarios');
	class CHerramientas extends MainController{
		function RegistrarUsuario(){
			global $con;
			global $f;
			global $c;
			$sadmin_id=$_SESSION[sadminidnum];
			
			if($_POST['f_vencimiento'] == ""){
				$fvencimiento = "2099-12-31";
			}else{
				$fvencimiento = $_POST['f_vencimiento'];
			}

			$con->Query("INSERT into usuarios (id, user_id, p_nombre, s_nombre, p_apellido, s_apellido, password, direccion, telefono, email, 
												ciudad, t_profesional, universidad,  cedula, celular, departamento, id_empresa, isAdministrador, t_cuenta, seccional, regimen, estado, f_caducidad, t_persona, procesos, seccional_siamm)
									values ('$_POST[id]','$_POST[email]','$_POST[pnombre]','$_POST[snombre]','$_POST[papellido]','$_POST[sapellido]','".md5($_POST[id])."', '$_POST[direccion]','$_POST[telefono]','$_POST[email]', '$_POST[ciudad]',
									'$_POST[tprofesional]','$_POST[universidad]','$_POST[id]','$_POST[celular]','$_POST[departamento]',
									'".$_SESSION['id_empresa']."', '0', '1', '$_POST[seccional]','$_POST[area]', '1', '$fvencimiento', '$_POST[t_persona]', '1', '$_POST[seccional_siamm]')");

			$usuario_a_i = $c->GetMaxIdTabla("usuarios", "a_i");

			$suscrr = new MSuscriptores_contactos;
			$createsuscr = $suscrr->InsertSuscriptores_contactos($_POST[id], $_POST[pnombre]." ".$_POST[papellido], "Operador/Empleado", $_SESSION['usuario'], date("Y-m-d"));
			$suscriptor_id = $c->GetMaxIdTabla("suscriptores_contactos", "id");
			$suscrd = new MSuscriptores_contactos_direccion;
			$suscrd->InsertSuscriptores_contactos_direccion($suscriptor_id, $_POST[direccion], $_POST[ciudad], $_POST[celular], $_POST[email], "");
			$q_str = "
			insert into usuarios_funcionalidades(user_id, id_funcionalidad, valor)
			select t.user_id,t.id,t.valor
			from (select usuarios.user_id, funcionalidades.id, '0' as valor from usuarios, funcionalidades) t left join 
				usuarios_funcionalidades uf on t.user_id = uf.user_id and t.id = uf.id_funcionalidad
			where uf.user_id is null and t.user_id = '".$_POST['email']."' ";
			$con->Query($q_str);

			$qfuncionalidades = $con->Query("select id from funcionalidades where campo_default = '1' ");
			while ($funct = $con->FetchAssoc($qfuncionalidades)) {
				$con->Query("UPDATE usuarios_funcionalidades set valor = '1' where id_funcionalidad = '".$funct['id']."' AND user_id = '".$_POST['email']."'");	
			}

			//$con->Query("UPDATE usuarios_funcionalidades set valor = '1' where id_funcionalidad in ('2', '3', '8', '11','13', '25', '32', '34', '35', '37') AND user_id = '".$_POST['email']."';");


			$MUsuarios_configurar_accesos = new MUsuarios_configurar_accesos;
			$MUsuarios_configurar_accesos -> CrearCiudadUsuario($usuario_a_i,$_POST['email']);
			echo '<script>window.location.href = "'.HOMEDIR.DS."herramientas/#usua".'"</script>';
			#header("Location: ");
		}
		function LoadHerramientas($idplantilla='usuarios'){
			$object = new MPlantilla;
			global $con;
			global $f;
			$sadmin_id=$_SESSION[sadmin];#$con->Result($con->Query("SELECT * from super_admin where user_id = '$_SESSION[usuario]'") ,0,'id');
			if (isset($_POST[submit])) {
				switch ($_POST[submit]) {
					case 'add_group':
						$con->Query("INSERT into grupos (sadmin_id,titulo) values ('$sadmin_id','$_POST[nombre]')");
						break;
					case 'add_user':
						$con->Query("INSERT into grupos_usuarios (grupo_id,user_id) values('$_POST[grupo]','$_POST[usuario]')");
						break;
					case 'registrar':
						$con->Query("INSERT into usuarios (id, user_id, p_nombre, s_nombre, p_apellido, s_apellido, password, 
									direccion, telefono, email, ciudad, t_profesional, universidad,  
									cedula, celular, departamento, id_empresa, isAdministrador, t_cuenta)
									values ('$_POST[id]','$_POST[email]','$_POST[pnombre]','$_POST[snombre]','$_POST[papellido]','$_POST[sapellido]','".md5($_POST[id])."',
									'$_POST[direccion]','$_POST[telefono]','$_POST[email]','$_POST[ciudad]','$_POST[tprofesional]','$_POST[universidad]',
									'$_POST[id]','$_POST[celular]','$_POST[departamento]','".$_SESSION['id_empresa']."', '1', '1')");
						$con->Query("INSERT into arbol_super_admin (id_super_admin,id_usuario, id_empresa) values('$sadmin_id','$_POST[email]','".$_SESSION['id_empresa']."')");
						global $c;
						$c->Insert_Event(	$id,
											'Usuario Creado',
											"Se ha creado una nuevo usuario en <a class=\'link_event\'>$_POST[pnombre] $_POST[papellido]</a>",
											'1',
											'1');
						break;
					default:
						# code...
						break;
				}
			}
			if ($sadmin_id != "") {
				$usuarios=$con->Query("SELECT * from usuarios u where seccional = '".$_SESSION['seccional']."'");
				$grupos=$con->Query("SELECT * from grupos where sadmin_id = '$sadmin_id'");	
				$user_list=$f->Create_Select($con->Query("SELECT u.user_id, concat(u.p_nombre,' ',u.p_apellido) as nombre from usuarios u, arbol_super_admin asa where asa.id_usuario=u.user_id and asa.id_super_admin=$sadmin_id"),'user_id','nombre');
				# code...
			}
			$pagina = $this->load_template('Herramientas');
			ob_start();			
			$query = $object->ListarPlantilla("WHERE user_id = '$_SESSION[usuario]'");
#			$naturalezas=$con->Query("SELECT * FROM demandas where user_id = '$_SESSION[usuario]'");
#			$juzgados=$con->Query("SELECT * FROM juzgados where user_id = '$_SESSION[usuario]'");
			$firma_img=$con->Result($con->Query("SELECT * from usuarios where user_id = '$_SESSION[usuario]' and estado = '1'"),0,'firma');
			// CREANDO UN NUEVO MODELO	
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA
			include_once(VIEWS.DS.'herramientas/Listar.php');	
			echo '  <div class="content-wrap">
            			<section>';
			include_once(VIEWS.DS.'herramientas/'.$idplantilla.'.php');			   	
			echo '
					    </section>
					</div>
				</div>
			</section>';
			// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.			
			$table = ob_get_clean();	
			// SI NO TRAE NINGUNA VARIABLE ENTONCES GENERA UN ERROR
			// DE LO CONTRARIO ENTONCES CARGA EL CONTENIDO DE LA PAGINA																
			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $table , $pagina);
			// RETORNAME LA PAGINA CARGADA		
			$this->view_page($pagina);
		}
		function VistaPlantilla(){
			// CREANDO UN NUEVO MODELO			
			$object = new MPlantilla;
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			
			global $con;
			//CARGANDO LA PAGINA DE INTERFAZ			
			$pagina = $this->load_template('Listar Plantilla');			
			// CARGANDO LLAMANDO LA FUNCION LSITAR LIBROS DEL MODELO (FUNCION QUE TRAE DE LA BASE DE DATOS EL LISTADO DE LIBROS
			// DE NO RECIBIR PARAMETROS ESTA FUNCION TRAE EL LISTADO COMPLETO DE LIBROS
			$query = $object->ListarPlantilla("WHERE user_id = '$_SESSION[usuario]'");	    
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();
				// SI LA CONSULTA NO SE EJECUTA ENTONCES RETORNA VACIO
		   		if($con->NumRows($query) <= 0 || $query !=''){
					// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA
					include_once(VIEWS.DS.'plantilla/Listar.php');	   			
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
		function Load_Plantilla($id){
			global $con;
			global $EL;
			$object = new MPlantilla;
			$object->CreatePlantilla('id',$id);
			$contenido_pl=$con->Result($con->Query("SELECT * from plantilla where id = '$id'"),0,'contenido');
			$search = array('::abogado::','::ciudadabogado::','::cedulaabogado::', '::tarjetaprofesional::', '::universidad::',
							'::direccionabogado::', '::telefono::', '::email::', '::firma::', 
							'::titulo::', '::valornumero::', '::valorletras::', '::naturalezaproceso::',  
							'::fechapresentacion::', '::radicado::', '::juzgado::', '::entidad::', '::direccionentidad::', 
							'::telefonoentidad::', '::ciudadentidad::','::fechaadmision::', '::radicadocompleto::',
							'::numconsecutivo::', '::estado::',
							'::nombredemandante::', '::identificaciondemandante::', '::expedicionidentificaciondemandante::',
							'::telefonodemandante::', '::emaildemandante::','::direcciondemandante::','::ciudaddemandante::',  
							'::INFORMACIONDEMANDANTES::', '::demandantesnotificacion::', '::representantelegaldemandante::', 
							'::ciudadrepresentantelegaldemandante::', 
							'::nombredemandado::', '::identificaciondemandado::', '::expedicionidentificaciondemandado::',
							'::telefonodemandado::', '::emaildemandado::', '::direcciondemandado::', '::ciudaddemandados::',
							'::INFORMACIONDEMANDADOS::', '::demandadosnotificacion::', '::representantelegal::', 
							'::ciudadrepresentantelegal::');
				$abo   = $con->FetchAssoc($con->Query("SELECT * from usuarios where user_id = '$_SESSION[usuario]'"));
				$pros  = $con->FetchAssoc($con->Query("SELECT * from caratula where user_id = '$_SESSION[usuario]' and proceso_id = '$_GET[p1]'"));
				$demx1 = $con->Query("SELECT * from demandante_proceso_juridico where user_id = '$_SESSION[usuario]' and proceso_id = '$_GET[p1]'");
				$demx2 = $con->Query("SELECT * from demandado_proceso where user_id = '$_SESSION[usuario]' and proceso_id = '$_GET[p1]'");
				$abogado = "<span class='abogado'>"."$abo[p_nombre] $abo[p_nombre] $abo[p_apellido] $abo[s_apellido]"."</span>";
				$ciudadabogado = "<span class='ciudadabogado'>".$abo[ciudad]."</span>";
				$cedulaabogado = "<span class='cedulaabogado'>".$abo[cedula]."</span>";
				$tarjetaprofesional	= "<span class='tarjetaprofesional'>".$abo[t_profesional]."</span>";
				$universidad = "<span class='universidad'>".$abo[universidad]."</span>";
				$direccionabogado = "<span class='direccionabogado'>".$abo[direccion]."</span>";
				$telefonoabogado = "<span class='telefonoabogado'>".$abo[telefono]."</span>";
				$emailabogado = "<span class='emailabogado'>".$abo[email]."</span>";
				$firma = "<span class='firmaabogado'>".'<img style="width:190px; border:none" src="'.HOMEDIR.'/app/plugins/thumbnails/'.$abo[firma].'">'."</span>";
				$titulo = "<span class='titulo'>".$pros[tit_demanda]."</span>";
				$valornumero = "<span class='valornumero'>".$pros[val_demanda]."</span>";
				$valorletras = "<span class='valorletras'>".$EL->ValorEnLetras($pros[val_demanda])."</span>";
				$naturalezaproceso = "<span class='naturalezaproceso'>".$pros[tip_demanda]."</span>";
				$fechapresentacion = "<span class='fechapresentacion'>".$pros[fec_pres]."</span>";
				$radicado = "<span class='radicado'>".$pros[rad]."</span>";
				$juzgado = "<span class='juzgado'>".$pros[juzgado]."</span>";
				$entidad = "<span class='entidad'>".$pros[juzgado]."</span>";
				$direccionentidad = "<span class='direccionentidad'>".$pros[dir_juz]."</span>";
				$telefonoentidad = "<span class='telefonoentidad'>".$pros[tel_juz]."</span>";
				$ciudadentidad = "<span class='ciudadentidad'>".$pros[ciu_juzgado]."</span>";
				$fechaadmision = "<span class='fechaadmision'>".$pros[fec_auto]."</span>";
				$radicadocompleto = "<span class='radicadocompleto'>".$pros[rad_completo]."</span>";
				$numconsecutivo = "<span class='numconsecutivo'>".$pros[num_oficio]."</span>";
				$estado = "<span class='estado'>".$pros[est_proceso]."</span>";
#	INFORMACION DE DEMANDANTES
				$nombredemandante_ar 					= array(); 
				$identificaciondemandante_ar 			= array(); 
				$expedicionidentificaciondemandante_ar 	= array(); 
				$telefonodemandante_ar 					= array(); 
				$emaildemandante_ar 					= array(); 
				$direcciondemandante_ar 				= array(); 
				$ciudaddemandante_ar 					= array(); 
				$INFORMACIONDEMANDANTES_ar 				= array(); 
				$demandantesnotificacion_ar 			= array(); 
				$representantelegaldemandante_ar 		= array(); 
				$ciudadrepresentantelegaldemandante_ar 	= array(); 
				while ($dem1 = $con->FetchAssoc($demx1)) {
					# code...
					array_push($nombredemandante_ar,$dem1[nom_entidad]);
					array_push($identificaciondemandante_ar,$dem1[nit_entidad]);
					array_push($expedicionidentificaciondemandante_ar,$dem1[exp_identificacion]);
					array_push($telefonodemandante_ar,$dem1[telefonos]);
					array_push($emaildemandante_ar,$dem1[email_repres]);
					array_push($direcciondemandante_ar,$dem1[dir_entidad]);
					array_push($ciudaddemandante_ar,$dem1[ciu_entidad]);
					array_push($INFORMACIONDEMANDANTES_ar,$dem1[id]);
					array_push($demandantesnotificacion_ar,$dem1[id]);
					array_push($representantelegaldemandante_ar,$dem1[p_nom_repres]);
					array_push($ciudadrepresentantelegaldemandante_ar,$dem1[ciu_repres]);
					break;
				}
				$nombredemandante = "<span class='nombredemandante'>".$this->ArmarCadena($nombredemandante_ar, 1)."</span>";
				$identificaciondemandante = "<span class='identificaciondemandante'>".$this->ArmarCadena($identificaciondemandante_ar)."</span>";
				$expedicionidentificaciondemandante = "<span class='expedicionidentificaciondemandante'>".$this->ArmarCadena($expedicionidentificaciondemandante_ar)."</span>";
				$telefonodemandante = "<span class='telefonodemandante'>".$this->ArmarCadena($telefonodemandante_ar)."</span>";
				$emaildemandante = "<span class='emaildemandante'>".$this->ArmarCadena($emaildemandante_ar)."</span>";
				$direcciondemandante = "<span class='direcciondemandante'>".$this->ArmarCadena($direcciondemandante_ar)."</span>";
				$ciudaddemandante = "<span class='ciudaddemandante'>".$this->ArmarCadena($ciudaddemandante_ar)."</span>";
				$INFORMACIONDEMANDANTES = "<span class='INFORMACIONDEMANDANTES'>".$this->ArmarCadenaDemandantes($INFORMACIONDEMANDANTES_ar, 1)."</span>";
				$demandantesnotificacion = "<span class='demandantesnotificacion'>".$this->ArmarCadenaDemandantes($demandantesnotificacion_ar, 2)."</span>";
				$representantelegaldemandante = "<span class='representantelegaldemandante'>".$this->ArmarCadena($representantelegaldemandante_ar)."</span>";
				$ciudadrepresentantelegaldemandante = "<span class='ciudadrepresentantelegaldemandante'>".$this->ArmarCadena($ciudadrepresentantelegaldemandante_ar)."</span>";
#INFORMACION DE DEMANDADOS
				$nombredemandado_ar 					= array();
				$identificaciondemandado_ar 			= array();
				$expedicionidentificaciondemandado_ar 	= array();
				$telefonodemandado_ar 					= array();
				$emaildemandado_ar 						= array();
				$direcciondemandado_ar 					= array();
				$ciudaddemandados_ar 					= array();
				$INFORMACIONDEMANDADOS_ar 				= array();
				$demandadosnotificacion_ar 				= array();
				$representantelegal_ar 					= array();
				$ciudadrepresentantelegal_ar 			= array();
				while ($dem2 = $con->FetchAssoc($demx2)) {
					array_push($nombredemandado_ar , $dem2[p_nombre]);
					array_push($identificaciondemandado_ar , $dem2[cedula]);
					array_push($expedicionidentificaciondemandado_ar , $dem2[exp_identificacion]);
					array_push($telefonodemandado_ar , $dem2[telefonos]);
					array_push($emaildemandado_ar , $dem2[email]);
					array_push($direcciondemandado_ar , $dem2[direccion]);
					array_push($ciudaddemandados_ar , $dem2[ciudad]);
					array_push($INFORMACIONDEMANDADOS_ar , $dem2[id]);
					array_push($demandadosnotificacion_ar , $dem2[id]);
					array_push($representantelegal_ar , $dem2[s_apellido]);
					array_push($ciudadrepresentantelegal_ar , $dem2[departamento]);
					break;
				}
				$nombredemandado = "<span class='nombredemandado'>".$this->ArmarCadena($nombredemandado_ar, 1)."</span>";
				$identificaciondemandado = "<span class='identificaciondemandado'>".$this->ArmarCadena($identificaciondemandado_ar)."</span>";
				$expedicionidentificaciondemandado = "<span class='expedicionidentificaciondemandado'>".$this->ArmarCadena($expedicionidentificaciondemandado_ar)."</span>";
				$telefonodemandado = "<span class='telefonodemandado'>".$this->ArmarCadena($telefonodemandado_ar)."</span>";
				$emaildemandado = "<span class='emaildemandado'>".$this->ArmarCadena($emaildemandado_ar)."</span>";
				$direcciondemandado = "<span class='direcciondemandado'>".$this->ArmarCadena($direcciondemandado_ar)."</span>";
				$ciudaddemandados = "<span class='ciudaddemandados'>".$this->ArmarCadena($ciudaddemandados_ar)."</span>";
				$INFORMACIONDEMANDADOS = "<span class='INFORMACIONDEMANDADOS'>".$this->ArmarCadenaDemandados($INFORMACIONDEMANDADOS_ar, 1)."</span>";
				$demandadosnotificacion = "<span class='demandadosnotificacion'>".$this->ArmarCadenaDemandados($demandadosnotificacion_ar, 2)."</span>";
				$representantelegal = "<span class='representantelegal'>".$this->ArmarCadena($representantelegal_ar)."</span>";
				$ciudadrepresentantelegal = "<span class='ciudadrepresentantelegal'>".$this->ArmarCadena($ciudadrepresentantelegal_ar)."</span>";
//			}
			$replace = array(	$abogado, $ciudadabogado, $cedulaabogado, $tarjetaprofesional, $universidad, 
								$direccionabogado, $telefonoabogado, $emailabogado, $firma,
								$titulo, $valornumero, $valorletras, $naturalezaproceso, $fechapresentacion, $radicado, 
								$juzgado, $entidad, $direccionentidad, $telefonoentidad, $ciudadentidad, 
								$fechaadmision, $radicadocompleto, $numconsecutivo, $estado,	
								$nombredemandante, $identificaciondemandante, $expedicionidentificaciondemandante, 
								$telefonodemandante, $emaildemandante, $direcciondemandante, $ciudaddemandante, 
								$INFORMACIONDEMANDANTES, $demandantesnotificacion, $representantelegaldemandante, 
								$ciudadrepresentantelegaldemandante, 	
								$nombredemandado, $identificaciondemandado, $expedicionidentificaciondemandado, 
								$telefonodemandado, $emaildemandado, $direcciondemandado, $ciudaddemandados, 
								$INFORMACIONDEMANDADOS, $demandadosnotificacion, $representantelegal, 
								$ciudadrepresentantelegal );
			#$replace =array($juzgado,$titulo,$abogado,$ciudadabogado,$cedulaabogado,$tarjetaprofesional,
			#				$direccionabogado,$direcciondemandante,$demandadosnotificacion,
			#				$nombredemandante,$ciudaddemandante,$ciudaddemandados,$valorletras,$valornumero);
			#global $f;
			#$contenido_pl = $f->CharsSearchEngine($contenido_pl);
			$isset = (isset($_GET[cn]))?0:1;
			$content = (isset($_GET[cn]))?str_replace($search, $replace, $contenido_pl):$contenido_pl;
			echo json_encode(array('isset'=>$isset,'content'=>htmlspecialchars_decode($content),'name'=>$object->GetNombre()));
		}
		function ArmarCadena($array, $z = '0'){
				$string = "";
				for($sn = 0; $sn < count($array); $sn++){
					$cuma = ""; $x = count($array)-1; $zuma = "";
					if($sn == 0){ 
						$cuma = ""; 
					}elseif($sn == $x){ 
						$cuma = " y "; 
						if ($z == '0') {
							$zuma = " respectivamente ";
						}
					}else{ 
						$cuma = ", "; 
					}
					if ($z == "3") {
						$string .= $cuma.strtoupper($array[$sn])." ".$zuma." ";
					}else{
						$string .= $cuma."<strong>".strtoupper($array[$sn])."</strong> ".$zuma." ";
					}
				}
				return $string;
		}
		function ArmarCadenaDemandantes($array, $type){
			global $con;
			$string = "";
				for($sn = 0; $sn < count($array); $sn++){
					$id = $array[$sn];
					$demx1 = $con->Query("SELECT * from demandante_proceso_juridico where id = '".$id."'");
					$rc = $con->FetchAssoc($demx1);
					if ($type == "1") {
						#AQUI INFORMACION DE IDENTIFICACION
						$string .= "".$rc['nom_entidad']." IDENTIFICADO CON ".$rc['nit_entidad']." DE ".$rc['exp_identificacion'].", ";
					}else{
						#AQUI INFORMACION DE CONTACTO
						$string .= "".$rc['nom_entidad']." Ubicado en ".$rc['ciu_repres']." En la direccion ".$rc['dir_entidad']." al telefono ".$rc['telefonos']." O a la direccion de correo ".$rc['email_repres'].", ";
					/*
						telefonos
						email_repres
						dir_entidad
						ciu_entidad
					*/
					}
				}
				$string .= "";
				return $string;
		}
		function ArmarCadenaDemandados($array, $type){
			global $con;
			$string = "";
				for($sn = 0; $sn < count($array); $sn++){
					$id = $array[$sn];
					$demx1 = $con->Query("SELECT * from demandado_proceso where id = '".$id."'");
					$rc = $con->FetchAssoc($demx1);
					if ($type == "1") {
						#AQUI INFORMACION DE IDENTIFICACION
						$string .= "".$rc['p_nombre']." IDENTIFICADO CON ".$rc['cedula']." DE ".$rc['exp_identificacion'].", ";
					}else{
						#AQUI INFORMACION DE CONTACTO
						$string .= "".$rc['p_nombre']." Ubicado en ".$rc['ciudad']." En la direccion ".$rc['direccion']." al telefono ".$rc['telefonos']." O a la direccion de correo ".$rc['email'].", ";
					}
				}
				$string .= "";
				return $string;
		}
		function Save_Plantilla(){
			$plants='<div id="title-plantilla">PLANTILLAS</div>';
			$object = new MPlantilla;
			global $con;
			global $c;
			global $f;
			$date = date('Y-m-d');
			$str = $f->CharsSearchEngine($c->sql_quote($_POST[str]));
			if ($c->sql_quote($_POST[idplant]==0)) {
				#echo "creo plantilla";
				$con->Query("INSERT into plantilla (user_id,nombre,f_creacion,contenido, def) values('$_SESSION[usuario]','".$c->sql_quote($_POST[name])."','$date','".$str."','No')");
				$id=mysql_insert_id();
			}else{
				$type_plan = $con->Result($con->Query("SELECT * from plantilla where id = '".$c->sql_quote($_POST[idplant])."'"),0,'def');
				if ($type_plan=='No') {
					#echo "actualizo plantilla";
					$con->Query("UPDATE plantilla set nombre='".$c->sql_quote($_POST[name])."', contenido='".$str."',f_actualizacion='$date' where id='".$c->sql_quote($_POST[idplant])."'");
					$id=$_POST[idplant];
				}else{
					#echo "creo plantilla a partir de un MODELO";
					$con->Query("INSERT into plantilla (user_id,nombre,f_creacion,contenido, def) values('$_SESSION[usuario]','".$c->sql_quote($_POST[name])."','$date','".$str."','No')");
					$id=mysql_insert_id();
				}				
			}
 			$object2 = new MPlantilla;
            $query2 = $object2->ListarPlantilla("WHERE def = 'No' and user_id = '".$_SESSION['usuario']."'");    
            echo '<div id="title-plantilla">PLANTILLAS</div>';
            echo '<div class="item-plantilla" onClick="ShowPlants(\'plant_fav\')"><b>Mis Plantillas</b></div>';
            echo '<div id="plant_fav" class="showplant">';
            while($row = $con->FetchAssoc($query2)){
                $ln = new MPlantilla;
                $ln->Createplantilla('id', $row[id]);
                ?>
                    <div class="item-plantilla" onclick="view_plantilla(<?=$row[id]?>,this)"><?php echo $ln->GetNombre(); ?></div>
                <?
            }
            echo '</div>';
		    $query2 = $object2->ListarPlantilla("WHERE def = 'Si'", "group by t_plantilla");    
		    while($row = $con->FetchAssoc($query2)){
		        $l = new MPlantilla;
		        $lq = $l->ListarPlantilla("WHERE t_plantilla = '".$row['t_plantilla']."' and def='Si' ");
		        echo '<div class="item-plantilla" onClick="ShowPlants(\'plant_'.$row["t_plantilla"].'\')"><b>Plantillas Genericas de: '.$row["t_plantilla"].'</b></div>';
		        echo '<div id="plant_'.$row["t_plantilla"].'" class="showplant active">';
		        while ($rx = $con->FetchAssoc($lq)) {
		            $ln = new MPlantilla;
		            $ln->Createplantilla('id', $rx[id]);
		            ?>
		                <div class="item-plantilla" onclick="view_plantilla(<?=$rx[id]?>,this)"><?php echo $ln->GetNombre(); ?></div>
		            <?
		        }
		        echo '</div>';
		    }
/*
			$result=$object->ListarPlantilla("WHERE user_id = '$_SESSION[usuario]'");
			while ($col=$con->FetchAssoc($result)) {
				$plants.=($col[id]==$id)?"<div class='item-plantilla active' onclick='view_plantilla($col[id],this)'>$col[nombre]</div>":
								"<div class='item-plantilla' onclick='view_plantilla($col[id],this)'>$col[nombre]</div>";
			}
			echo $plants;	
			*/
		}
		function Naturalezas(){
			global $con;
			$id=$con->Query("INSERT into demandas (nom,user_id) values ('$_POST[nom]','$_SESSION[usuario]')",'insert');
			echo $id;
		}
		function Juzgados(){
			global $con;
			$id=$con->Query("INSERT into juzgados (nom,user_id) values ('$_POST[nom]','$_SESSION[usuario]')",'insert');
			echo $id;
		}
		function Save_File(){
			global $con;
			$rand = md5(date('Y-m-d').rand().$_SESSION[usuario]);
			$filename=UPLOADS.DS.$_SESSION[usuario].'/';
			if (!file_exists($filename)) {
			    mkdir(UPLOADS.DS . $_SESSION[usuario], 0777);
			}
			$filename=UPLOADS.DS.$_SESSION[usuario].'/firmas/';
			if (!file_exists($filename)) {
			    mkdir(UPLOADS.DS . $_SESSION[usuario].'/firmas', 0777);
			}
			if(isset($_FILES['archivo']) && $_FILES['archivo']['error'] == 0){
				if(move_uploaded_file($_FILES['archivo']['tmp_name'], UPLOADS.DS.$_SESSION[usuario].'/firmas/'.$rand.'_'.$_FILES['archivo']['name'])){
#					$con->Query("UPDATE firmas set estado = '0' where user_id = '$_SESSION[usuario]'");
					$con->Query("UPDATE usuarios set firma = '".$rand.'_'.$_FILES['archivo']['name']."' WHERE user_id = '$_SESSION[usuario]'");
					echo HOMEDIR.'/app/archivos_uploads/'.$_SESSION[usuario].'/firmas/'.$rand.'_'.$_FILES['archivo']['name'];
				}
			}
		}
		function RefreshTemplate($id){
			global $con;
			$m = new MMemoriales;
			$m->CreateMemoriales("id", $id);
			$pid = $m->GetProceso_id();
			$demx1 = $con->Query("SELECT * from demandante_proceso_juridico where user_id = '$_SESSION[usuario]' and proceso_id = '$pid'");
			$demx2 = $con->Query("SELECT * from demandado_proceso where user_id = '$_SESSION[usuario]' and proceso_id = '$pid'");
			$abo   = $con->FetchAssoc($con->Query("SELECT * from usuarios where user_id = '$_SESSION[usuario]'"));
			$pros  = $con->FetchAssoc($con->Query("SELECT * from caratula where user_id = '$_SESSION[usuario]' and proceso_id = '$pid'"));
			$dem1  = $con->Query("SELECT * from demandante_proceso_juridico where user_id = '$_SESSION[usuario]' and proceso_id = '$pid'");
			$dem2  = $con->Query("SELECT * from demandado_proceso where user_id = '$_SESSION[usuario]' and proceso_id = '$pid'");
				$abogado = "$abo[p_nombre] $abo[p_apellido]";
				$ciudadabogado = $abo[ciudad];
				$cedulaabogado = $abo[cedula];
				$tarjetaprofesional	= $abo[t_profesional];
				$universidad = $abo[universidad];
				$direccionabogado = $abo[direccion];
				$telefonoabogado = $abo[telefono];
				$emailabogado = $abo[email];
				$titulo = $pros[tit_demanda];
				$valornumero = $pros[val_demanda];
				$valorletras = $pros[val_demanda];
				$naturalezaproceso = $pros[tip_demanda];
				$fechapresentacion = $pros[fec_pres];
				$radicado = $pros[rad];
				$juzgado = $pros[juzgado];
				$entidad = $pros[juzgado];
				$direccionentidad = $pros[dir_juz];
				$telefonoentidad = $pros[tel_juz];
				$ciudadentidad = $pros[juzgado];
				$nombredemandante_ar 					= array(); 
				$identificaciondemandante_ar 			= array(); 
				$expedicionidentificaciondemandante_ar 	= array(); 
				$telefonodemandante_ar 					= array(); 
				$emaildemandante_ar 					= array(); 
				$direcciondemandante_ar 				= array(); 
				$ciudaddemandante_ar 					= array(); 
				$INFORMACIONDEMANDANTES_ar 				= array(); 
				$demandantesnotificacion_ar 			= array(); 
				$representantelegaldemandante_ar 		= array(); 
				$ciudadrepresentantelegaldemandante_ar 	= array(); 
				while ($dem1 = $con->FetchAssoc($demx1)) {
					# code...
					array_push($nombredemandante_ar,$dem1[nom_entidad]);
					array_push($identificaciondemandante_ar,$dem1[nit_entidad]);
					array_push($expedicionidentificaciondemandante_ar,$dem1[exp_identificacion]);
					array_push($telefonodemandante_ar,$dem1[telefonos]);
					array_push($emaildemandante_ar,$dem1[email_repres]);
					array_push($direcciondemandante_ar,$dem1[dir_entidad]);
					array_push($ciudaddemandante_ar,$dem1[ciu_entidad]);
					array_push($INFORMACIONDEMANDANTES_ar,$dem1[id]);
					array_push($demandantesnotificacion_ar,$dem1[id]);
					array_push($representantelegaldemandante_ar,$dem1[p_nom_repres]);
					array_push($ciudadrepresentantelegaldemandante_ar,$dem1[ciu_repres]);
					break;
				}
			$nombredemandante 					= $this->ArmarCadena($nombredemandante_ar, 3);
			$identificaciondemandante 			= $this->ArmarCadena($identificaciondemandante_ar, 3);
			$expedicionidentificaciondemandante = $this->ArmarCadena($expedicionidentificaciondemandante_ar, 3);
			$telefonodemandante 				= $this->ArmarCadena($telefonodemandante_ar, 3);
			$emaildemandante 					= $this->ArmarCadena($emaildemandante_ar, 3);
			$direcciondemandante 				= $this->ArmarCadena($direcciondemandante_ar, 3);
			$ciudaddemandante 					= $this->ArmarCadena($ciudaddemandante_ar, 3);
			$INFORMACIONDEMANDANTES 			= $this->ArmarCadenaDemandantes($INFORMACIONDEMANDANTES_ar, 1);
			$demandantesnotificacion 			= $this->ArmarCadenaDemandantes($demandantesnotificacion_ar, 2);
			$representantelegaldemandante 		= $this->ArmarCadena($representantelegaldemandante_ar, 3);
			$ciudadrepresentantelegaldemandante = $this->ArmarCadena($ciudadrepresentantelegaldemandante_ar, 3);
		#INFORMACION DE DEMANDADOS
			$nombredemandado_ar 					= array();
			$identificaciondemandado_ar 			= array();
			$expedicionidentificaciondemandado_ar 	= array();
			$telefonodemandado_ar 					= array();
			$emaildemandado_ar 						= array();
			$direcciondemandado_ar 					= array();
			$ciudaddemandados_ar 					= array();
			$INFORMACIONDEMANDADOS_ar 				= array();
			$demandadosnotificacion_ar 				= array();
			$representantelegal_ar 					= array();
			$ciudadrepresentantelegal_ar 			= array();
				while ($dem2 = $con->FetchAssoc($demx2)) {
					array_push($nombredemandado_ar , $dem2[p_nombre]);
					array_push($identificaciondemandado_ar , $dem2[cedula]);
					array_push($expedicionidentificaciondemandado_ar , $dem2[exp_identificacion]);
					array_push($telefonodemandado_ar , $dem2[telefonos]);
					array_push($emaildemandado_ar , $dem2[email]);
					array_push($direcciondemandado_ar , $dem2[direccion]);
					array_push($ciudaddemandados_ar , $dem2[ciudad]);
					array_push($INFORMACIONDEMANDADOS_ar , $dem2[id]);
					array_push($demandadosnotificacion_ar , $dem2[id]);
					array_push($representantelegal_ar , $dem2[s_apellido]);
					array_push($ciudadrepresentantelegal_ar , $dem2[departamento]);
					break;
				}
			$nombredemandado					= $this->ArmarCadena($nombredemandado_ar, 3);
			$identificaciondemandado			= $this->ArmarCadena($identificaciondemandado_ar, 3);
			$expedicionidentificaciondemandado	= $this->ArmarCadena($expedicionidentificaciondemandado_ar, 3);
			$telefonodemandado					= $this->ArmarCadena($telefonodemandado_ar, 3);
			$emaildemandado					 	= $this->ArmarCadena($emaildemandado_ar, 3);
			$direcciondemandado					= $this->ArmarCadena($direcciondemandado_ar, 3);
			$ciudaddemandados					= $this->ArmarCadena($ciudaddemandados_ar, 3);
			$INFORMACIONDEMANDADOS				= $this->ArmarCadenaDemandados($INFORMACIONDEMANDADOS_ar, 1);
			$demandadosnotificacion				= $this->ArmarCadenaDemandados($demandadosnotificacion_ar, 2);
			$representantelegal					= $this->ArmarCadena($representantelegal_ar, 3);
			$ciudadrepresentantelegal			= $this->ArmarCadena($ciudadrepresentantelegal_ar, 3);
/*
			$nombredemandante = $dem1[nom_entidad];
			$identificaciondemandante = $dem1[nit_entidad];
			$expedicionidentificaciondemandante = $dem1[exp_identificacion];
			$telefonodemandante = $dem1[telefonos];
			$emaildemandante = $dem1[email_repres];
			$direcciondemandante = $dem1[dir_entidad];
			$ciudaddemandante = $dem1[ciu_entidad];
			#$INFORMACIONDEMANDANTES = $dem1[nom_entidad];
			#$demandantesnotificacion = $dem1[nom_entidad];
			$representantelegaldemandante = $dem1[p_nom_repres];
			$ciudadrepresentantelegaldemandante = $dem1[ciu_repres];
			$nombredemandado = $dem2[p_nombre];
			$identificaciondemandado = $dem2[cedula];
			$expedicionidentificaciondemandado = $dem2[exp_identificacion];
			$telefonodemandado = $dem2[telefonos];
			$emaildemandado = $dem2[email];
			$direcciondemandado = $dem2[direccion];
			$ciudaddemandados = $dem2[ciudad];
		#	$INFORMACIONDEMANDADOS = $dem2[p_nombre];
		#	$demandadosnotificacion = $dem2[p_nombre];
			$representantelegal = $dem2[s_apellido];
			$ciudadrepresentantelegal = $dem2[departamento];
*/
			#echo $abogado." -> ".$entidad;
			$arr = array
			(	"abogado" => $abogado, "ciudadabogado" => $ciudadabogado, "cedulaabogado" => $cedulaabogado, 
				"tarjetaprofesional" => $tarjetaprofesional, "universidad" => $universidad, "direccionabogado" => $direccionabogado, 
				"telefonoabogado" => $telefonoabogado, "emailabogado" => $emailabogado, "titulo" => $titulo, 
				"valornumero" => $valornumero, "valorletras" => $valorletras, "naturalezaproceso" => $naturalezaproceso, 
				"fechapresentacion" => $fechapresentacion, "radicado" => $radicado, "juzgado" => $juzgado, "entidad" => $entidad, 
				"direccionentidad" => $direccionentidad, "telefonoentidad" => $telefonoentidad, "ciudadentidad" => $ciudadentidad, 
				"nombredemandante" => $nombredemandante, "identificaciondemandante" => $identificaciondemandante, 
				"expedicionidentificaciondemandante" => $expedicionidentificaciondemandante, 
				"telefonodemandante" => $telefonodemandante, "emaildemandante" => $emaildemandante, 
				"direcciondemandante" => $direcciondemandante, "ciudaddemandante" => $ciudaddemandante, 
				"INFORMACIONDEMANDANTES" => $INFORMACIONDEMANDANTES, "demandantesnotificacion" => $demandantesnotificacion, 
				"representantelegaldemandante" => $representantelegaldemandante, 
				"ciudadrepresentantelegaldemandante" => $ciudadrepresentantelegaldemandante, "nombredemandado" => $nombredemandado, 
				"identificaciondemandado" => $identificaciondemandado, 
				"expedicionidentificaciondemandado" => $expedicionidentificaciondemandado, "telefonodemandado" => $telefonodemandado, 
				"emaildemandado" => $emaildemandado, "direcciondemandado" => $direcciondemandado, 
				"ciudaddemandados" => $ciudaddemandados, "INFORMACIONDEMANDADOS" => $INFORMACIONDEMANDADOS, 
				"demandadosnotificacion" => $demandadosnotificacion, "representantelegal" => $representantelegal, 
				"ciudadrepresentantelegal" => $ciudadrepresentantelegal );
			echo json_encode($arr);	
		}
		function GetEmpresa(){
		}
		function EditProfile($emailp){
			$object = new MUsuarios;
			global $con;
			$object->CreateUsuarios("user_id", $emailp);
			// CREANDO UN NUEVO MODELO	
			//	DEFINIENDO LA VARIABLE DE CONEXION CON LA BASE COMO UNA VARIABLE GLOBAL			
			$pagina = $this->load_template(PROJECTNAME.ST." Configurar Cuenta");
			// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
			ob_start();				
			// SI LA CONSULTA SE EJECUTA ENTONCES CARGA EL LISTADO DE LIBROS DE LA VISTA
			include_once(VIEWS.DS.'herramientas'.DS.'myprofile.php');
			// OBTIENE EL CONTENIDO DEL BÚFER ACTUAL Y ELIMINA EL BÚFER DE SALIDA ACTUAL.			
			$table = ob_get_clean();	
			// SI NO TRAE NINGUNA VARIABLE ENTONCES GENERA UN ERROR
			// DE LO CONTRARIO ENTONCES CARGA EL CONTENIDO DE LA PAGINA																
			$pagina = $this->replace_content('/\#CONTENIDO\#/ms', $table , $pagina);
			// RETORNAME LA PAGINA CARGADA		
			$this->view_page($pagina);
		}
		function ActualizarPerfilUsuario(){
			global $con;
			global $c;
			global $f;
			$usuario = new MUsuarios;
			$usuario->CreateUsuarios("a_i", $c->sql_quote($_REQUEST['a_i']));
			$path = "";
    		$change = false;
			$newpassword 	= $c->sql_quote($_REQUEST['newpassword']);
			$p_nombre 		= $c->sql_quote($_REQUEST['p_nombre']);
			$p_apellido 	= $c->sql_quote($_REQUEST['p_apellido']);
			$sexo 			= $c->sql_quote($_REQUEST['sexo']);
			$cedula 		= $c->sql_quote($_REQUEST['cedula']);
			$exp_cedula 	= $c->sql_quote($_REQUEST['exp_cedula']);
			$direccion 		= $c->sql_quote($_REQUEST['direccion']);
			$ciudad 		= $c->sql_quote($_REQUEST['ciudad']);
			$departamento 	= $c->sql_quote($_REQUEST['departamento']);
			$telefono 		= $c->sql_quote($_REQUEST['telefono']);
			$celular 		= $c->sql_quote($_REQUEST['celular']);
			$email 			= $c->sql_quote($_REQUEST['email']);
			$universidad 	= $c->sql_quote($_REQUEST['universidad']);
			$t_profesional 	= $c->sql_quote($_REQUEST['t_profesional']);
			$t_persona 		= $c->sql_quote($_REQUEST['t_persona']);
			$oficina 		= $c->sql_quote($_REQUEST['oficina']);
			$area 			= $c->sql_quote($_REQUEST['area']);
			$caducidad 		= $c->sql_quote($_REQUEST['caducidad']);
			$ciudad_code 	= $c->sql_quote($_REQUEST['ciudad_oficina']);

			$smtp_host 		= $c->sql_quote($_REQUEST['smtp_host']);
			$smtp_puerto 	= $c->sql_quote($_REQUEST['smtp_puerto']);
			$smtp_user 		= $c->sql_quote($_REQUEST['smtp_user']);
			$smtp_pww 		= $c->sql_quote($_REQUEST['smtp_pww']);
			$smtp_aut 		= $c->sql_quote($_REQUEST['smtp_aut']);
			$smtp_es 		= $c->sql_quote($_REQUEST['smtp_es']);
			$smtp_helo 		= $c->sql_quote($_REQUEST['smtp_helo']);
			$smtp_tls 		= $c->sql_quote($_REQUEST['smtp_tls']);
			$id 			= $c->sql_quote($_REQUEST['c_unica']);


			if ($_REQUEST['mover_expedientes'] == "SI") {
				$str = "update gestion set oficina = '".$oficina."' where nombre_destino = '".$usuario->GetA_i()."'";
				$con->Query($str);

				$con->Query("update gestion set ciudad = '".$ciudad_code."' where nombre_destino = '".$usuario->GetA_i()."'");

				$con->Query("update gestion set dependencia_destino = '".$area."' where nombre_destino = '".$usuario->GetA_i()."'");
			}






		
			if ($newpassword != "") {
				$path .= "<li>Se edito el campo Contraseña de '".$usuario->GetPassword()."' por '$newpassword' </li>";  
				$change = true;
			}
			if ($p_nombre != $usuario->GetP_nombre()) {
				$path .= "<li>Se edito el campo Primer Nombre de '".$usuario->GetP_nombre()."' por '$p_nombre' </li>";  
				$change = true;
			}
			if ($p_apellido != $usuario->GetP_apellido()) {
				$path .= "<li>Se edito el campo Primer Apellido de '".$usuario->GetP_apellido()."' por '$p_apellido' </li>";  
				$change = true;
			}
			if ($sexo != $usuario->GetSexo()) {
				$path .= "<li>Se edito el campo Sexo de '".$usuario->GetSexo()."' por '$sexo' </li>";  
				$change = true;
			}
			if ($cedula != $usuario->GetCedula()) {
				$path .= "<li>Se edito el campo Identificación de '".$usuario->GetCedula()."' por '$cedula' </li>";  
				$change = true;
			}
			if ($exp_cedula != $usuario->GetExp_cedula()) {
				$path .= "<li>Se edito el campo Fecha de expedición de '".$usuario->GetExp_cedula()."' por '$exp_cedula' </li>";  
				$change = true;
			}
			if ($direccion != $usuario->GetDireccion()) {
				$path .= "<li>Se edito el campo Dirección de '".$usuario->GetDireccion()."' por '$direccion' </li>";  
				$change = true;
			}
			if ($ciudad != $usuario->GetCiudad()) {
				$path .= "<li>Se edito el campo Ciudad de '".$usuario->GetCiudad()."' por '$ciudad' </li>";  
				$change = true;
			}
			if ($departamento != $usuario->GetDepartamento()) {
				$path .= "<li>Se edito el campo Departamento de '".$usuario->GetDepartamento()."' por '$departamento' </li>";  
				$change = true;
			}
			if ($telefono != $usuario->GetTelefono()) {
				$path .= "<li>Se edito el campo Teléfono de '".$usuario->GetTelefono()."' por '$telefono' </li>";  
				$change = true;
			}
			if ($celular != $usuario->GetCelular()) {
				$path .= "<li>Se edito el campo Celular de '".$usuario->GetCelular()."' por '$celular' </li>";  
				$change = true;
			}
			if ($email != $usuario->GetEmail()) {
				$path .= "<li>Se edito el campo E-mail de '".$usuario->GetEmail()."' por '$email' </li>";  
				$change = true;
			}
			if ($universidad != $usuario->GetUniversidad()) {
				$path .= "<li>Se edito el campo Universidad de '".$usuario->GetUniversidad()."' por '$universidad' </li>";  
				$change = true;
			}
			if ($t_profesional != $usuario->GetT_profesional()) {
				$path .= "<li>Se edito el campo Tarjeta Profesional de '".$usuario->GetT_profesional()."' por '$t_profesion' </li>";  
				$change = true;
			}
			if ($notif != $usuario->Getnotif_usuario()) {
				$path .= "<li>Se edito el campo Recibir Notificaciones por Correo de '".$usuario->Getnotif_usuario()."' por '$notif' </li>";  
				$change = true;
			}
			if ($oficina != $usuario->Getseccional()) {
				$path .= "<li>Se edito el campo Oficina de '".$usuario->Getseccional()."' por '$oficina' </li>";  
				$change = true;
			}
			if ($area != $usuario->Getregimen()) {
				$path .= "<li>Se edito el campo ".CAMPOAREADETRABAJO." de '".$usuario->Getregimen()."' por '$area' </li>";  
				$change = true;
			}

			if($smtp_host != $usuario->Getsmtp_host()){
				$change = true;
			}
			if($smtp_puerto != $usuario->Getsmtp_puerto()){
				$change = true;
			}
			if($smtp_user != $usuario->Getsmtp_user()){
				$change = true;
			}
			if($smtp_pww != $usuario->Getsmtp_pww()){
				$change = true;
			}
			if($smtp_aut != $usuario->Getsmtp_aut()){
				$change = true;
			}
			if($smtp_es != $usuario->Getsmtp_es()){
				$change = true;
			}
			if($smtp_helo != $usuario->Getsmtp_helo()){
				$change = true;
			}
			if($id != $usuario->Getid()){
				$change = true;
			}
			if($smtp_tls != $usuario->Getsmtp_tls()){
				$change = true;
			}
			if ($change) {
				//echo $path;
				if($newpassword == ""){

					$ar2 = array('p_nombre', 'p_apellido', 'sexo', 'cedula', 'exp_cedula', 'direccion', 'ciudad', 'departamento', 'telefono', 'celular', 'email', 'universidad', 't_profesional', 'notif_usuario', 'seccional', 'regimen', 'auditoria', 't_persona', 'smtp_host', 'smtp_puerto', 'smtp_user', 'smtp_pww', 'smtp_aut', 'smtp_es', 'smtp_helo','smtp_tls', 'id');
					$ar1 = array($p_nombre, $p_apellido, $sexo, $cedula, $exp_cedula, $direccion, $ciudad, $departamento, $telefono, $celular, $email, $universidad, $t_profesional, $notif,$oficina, $area, htmlspecialchars($c->sql_quote(str_replace("'", "\'", $path))), $t_persona, $smtp_host, $smtp_puerto, $smtp_user, $smtp_pww, $smtp_aut, $smtp_es, $smtp_helo, $smtp_tls, $id);	

				}else{
					$ar2 = array('password', 'p_nombre', 'p_apellido', 'sexo', 'cedula', 'exp_cedula', 'direccion', 'ciudad', 'departamento', 'telefono', 'celular', 'email', 'universidad', 't_profesional', 'notif_usuario', 'seccional', 'regimen', 'auditoria', 't_persona', 'smtp_host', 'smtp_puerto', 'smtp_user', 'smtp_pww', 'smtp_aut', 'smtp_es', 'smtp_helo', 'smtp_tls', 'id', 'updatepassword', 'sha2pww', 'fecha_cambio_clave');
					$ar1 = array($f->EncriptarPassword($newpassword), $p_nombre, $p_apellido, $sexo, $cedula, $exp_cedula, $direccion, $ciudad, $departamento, $telefono, $celular, $email, $universidad, $t_profesional, $notif,$oficina, $area,htmlspecialchars($c->sql_quote(str_replace("'", "\'", $path))) ,$t_persona, $smtp_host, $smtp_puerto, $smtp_user, $smtp_pww, $smtp_aut, $smtp_es, $smtp_helo, $smtp_tls, $id, '0', '1', date("Y-m-d"));
				}
					// DEFINIMOS LOS ESTADOS DE SALIDA
					$output = array('Usuario actualizado', 'No se pudo actualizar el usuario'); 
					// Y POR ULTIMO DEFINIMOS EL CONTRAIN PARA LA ACTUALIZACION	
					$constrain = 'WHERE a_i = "'.$c->sql_quote($_REQUEST['a_i']).'"';	
					$act = $usuario->UpdateUsuarios($constrain, $ar2, $ar1, $output);
					echo $act;
			}
		}
		function TransferirExpedientesUsuarios($x){
			global $con;
			// Y FINALMENTE CARGAMOS LA VISTA DE EDICION QUE MUESTRA EL CONTENIDO			
			include_once(VIEWS.DS.'herramientas/FormTransferirExpedientesUsuarios.php');		
	 	}
	 	function RegistrarTransferirExpedientesUsuarios($x){
	 		global $con;
	 		global $c;
	 		$MGestion_compartir = new MGestion_compartir;
	 		$usuariop = $c->sql_quote($_REQUEST['usuariop']);
	 		$usuariod = $c->sql_quote($_REQUEST['usuariod']);

	 		$fechai = $c->sql_quote($_REQUEST['fechai']);
	 		$fechaf = $c->sql_quote($_REQUEST['fechaf']);

	 		$transferir_por = $c->sql_quote($_REQUEST['transferir_por']);

	 		$whe = "";
	 		if($fechai != "" || $fechaf != ""){
	 			if($fechai == ""){
	 				$fechai = "0000-00-0";
	 			}
	 			if($fechaf == ""){
	 				$fechaf = date('Y-m-');
	 			}
	 			$whe = " f_recibido BETWEEN '$fechai' and '$fechaf'";
	 		}

	 		if($whe != ""){
	 			$whe = " and ".$whe;
	 		}

			$usd = new MUsuarios;
			$usd->CreateUsuarios("a_i", $usuariod);
			$username = $usd->GetP_nombre()." ".$usd->GetP_apellido();
			$usuario_nuevo = $usd->Getuser_id();
			$fecha = date('Y-m-d H:i:s');
			$observacion = '';

			$usp = new MUsuarios;
			$usp->CreateUsuarios("a_i", $usuariop);
			$usuario_viejo = $usp->Getuser_id();

			if($transferir_por == 'Propietario'){
		 		$query  = $con->Query("SELECT * from gestion where nombre_destino = '".$usuariop."' $whe");
				while ($rowrr = $con->FetchAssoc($query)) {
			 		$usp = new MUsuarios;
					$usp->CreateUsuarios("a_i", $rowrr['nombre_destino']);
					$usuario_comparte = $usp->Getuser_id();
					$gestion_id = $rowrr['id'];
					$username_comparte = $usp->GetP_nombre()." ".$usp->GetP_apellido();
					
					$con->Query("update gestion set nombre_destino = '".$usuariod."' where nombre_destino = '".$rowrr['nombre_destino']."' and id = '$gestion_id'");

					$objecte = new MEvents_gestion;
					$objecte->InsertEvents_gestion($_SESSION['usuario'], $gestion_id, date("Y-m-d"), "Expediente Transferido", "Se ha cambiado el propietario del expediente  $username_comparte por $username", date("Y-m-d"), 0, date("H:i:s"), 0, 0, 0, date("Y-m-d"), 0, $_SESSION['seccional'], $_SESSION['area_principal'], $_SESSION['area_principal'], $usp->GetA_i(), "trans", $id);
				}
			}else{
				$query  = $con->Query("SELECT * from gestion where usuario_registra = '".$usuario_viejo."' $whe");
				while ($rowrr = $con->FetchAssoc($query)) {
			 		$usp = new MUsuarios;
					$usp->CreateUsuarios("user_id", $rowrr['usuario_registra']);
					$usuario_comparte = $usp->Getuser_id();
					$gestion_id = $rowrr['id'];
					$username_comparte = $usp->GetP_nombre()." ".$usp->GetP_apellido();
					
					$con->Query("update gestion set usuario_registra = '".$usuario_nuevo."' where usuario_registra = '".$rowrr['user_id']."' and id = '$gestion_id'");

					$objecte = new MEvents_gestion;
					$objecte->InsertEvents_gestion($_SESSION['usuario'], $gestion_id, date("Y-m-d"), "Expediente Transferido", "Se ha cambiado el usuario que registro el expediente $username_comparte por $username", date("Y-m-d"), 0, date("H:i:s"), 0, 0, 0, date("Y-m-d"), 0, $_SESSION['seccional'], $_SESSION['area_principal'], $_SESSION['area_principal'], $usp->GetA_i(), "trans", $id);
				}
			}
	 	}
		function CompartirExpedientesUsuarios($x){
			global $con;
			// Y FINALMENTE CARGAMOS LA VISTA DE EDICION QUE MUESTRA EL CONTENIDO			
			include_once(VIEWS.DS.'herramientas/FormCompartirExpedientesUsuarios.php');
	 	}	
	 	function RegistrarCompartirExpedientesUsuarios($x){
	 		global $con;
	 		global $c;
	 		$MGestion_compartir = new MGestion_compartir;
	 		$usuariop = $c->sql_quote($_REQUEST['usuariop']);
	 		$usuariod = $c->sql_quote($_REQUEST['usuariod']);

	 		$fecha_i = $c->sql_quote($_REQUEST['fecha_i']);
	 		$fecha_f = $c->sql_quote($_REQUEST['fecha_f']);

			$usd = new MUsuarios;
			$usd->CreateUsuarios("a_i", $usuariod);
			$username = $usd->GetP_nombre()." ".$usd->GetP_apellido();
			$usuario_nuevo = $usd->Getuser_id();
			$fecha = date('Y-m-d H:i:s');
			$observacion = '';
			$type = $c->sql_quote($_REQUEST['type']);
			$fecha_caducidad = $c->sql_quote($_REQUEST['fecha_caducidad']);
			$usuariopWHERE = "";

			$path = "";

			if ($fecha_i == "") {
				$fecha_i = "1999-01-01";
			}
			if ($fecha_f == "") {
				$fecha_f = date("Y-m-d");
			}

			$path = " and gestion.f_recibido between '$fecha_i' and '$fecha_f'";

	 		if($usuariop != 'TODOS'){
				$usuariopWHERE  = " and nombre_destino = '$usuariop' $path ";
			}else{
				$usuariopWHERE  = "  $path ";
			}

	 		$query  = $con->Query("SELECT gestion.id as id,gestion.nombre_destino
			FROM gestion left join (select gestion_id as ida from gestion_compartir where usuario_nuevo = '$usuario_nuevo') t on gestion.id = t.ida
			where t.ida is null $usuariopWHERE");

			
	 		$i = 0;
			while ($rowrr = $con->FetchAssoc($query)) {
				$i++;
		 		$usp = new MUsuarios;
				$usp->CreateUsuarios("a_i", $rowrr['nombre_destino']);
				$usuario_comparte = $usp->Getuser_id();
				$gestion_id = $rowrr['id'];
				$create = $MGestion_compartir->InsertGestion_compartir($usuario_comparte, $usuario_nuevo, $gestion_id, $fecha, $observacion, $type, "1", $fecha_caducidad);
				$id = $c->GetMaxIdTabla("gestion_compartir", "id");
				$objectgs = new MSolicitudes_documentos;
				// USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATOA			
				$objectgs->InsertSolicitudes_documentos($usuario_nuevo, $_SESSION['usuario'], date("Y-m-d H:i:s"), date("Y-m-d H:i:s"), $fecha_caducidad, $gestion_id, $observacion, "1");
				$objecte = new MEvents_gestion;
				$objecte->InsertEvents_gestion($_SESSION['usuario'], $gestion_id, date("Y-m-d"), "Expediente Compartido", "Se ha compartido el expediente con el usuario $username", date("Y-m-d"), 0, date("H:i:s"), 0, 0, 0, date("Y-m-d"), 0, $_SESSION['seccional'], $_SESSION['area_principal'], $_SESSION['area_principal'], $usp->GetA_i(), "comp", $id);
			}
			echo $i;
	 	}
	}
 ?>