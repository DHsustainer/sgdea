<style>
	
	#listado_solicitudes{
		margin-top: 10px;
		padding: 0px;	
		display:none;	
	}

	#btn_collapse{
		cursor: pointer;
		width: 50px;
		height: 26px;
		margin-top: 0px;
		margin-bottom: 10px;
		margin-left: 14px;
		border-top: 1px solid #ccc;
		width: 100%;
		background: url(<?= ASSETS ?>images/spancollapseicons.png) no-repeat;
	}

	#btn_collapse.show{
		margin-top: 10px;
		background-position: center -26px;
		background-color: #EDEDF0;
	}
	#btn_collapse.show:hover{
		background-position: center 0px;
		background-color: #454545;
	}
	#btn_collapse.hide{
		margin-top: 10px;
		background-position: center -78px;
		background-color: #EDEDF0;
	}
	#btn_collapse.hide:hover{
		background-position: center -52px;
		background-color: #454545;
	}
	


#listado_solicitudes .titulo{
	float:left;
	width: 150px;
	height: 65px;
	font-size: 13px;
	margin-left: 10px;
	line-height: 65px;
}
#listado_solicitudes .listado_seleccion{
	float:left;
	width: 600px;

}
#listado_solicitudes .usuarios_seleccion{
	float:left;
	width: auto;
}
#listado_solicitudes .usuarios_seleccion #ul_usuarios_seleccion{
	padding: 0px;
}
#listado_solicitudes .usuarios_seleccion #ul_usuarios_seleccion li{
	list-style: none;
	color: #666;
	font-size: 14px;
	line-height: 30px;
}


#listado_solicitudes .usuarios_seleccion #ul_usuarios_seleccion li .t_listado{
	float:left;
	width: 170px;
}
#listado_solicitudes .usuarios_seleccion #ul_usuarios_seleccion li .elm_listado{
	float:right;
	width: 50px;
	font-style: italic;
}
#listado_solicitudes .usuarios_seleccion #ul_usuarios_seleccion li .elm_listado:hover{
	cursor: pointer;
	text-decoration: underline;
}


</style>


<?
	$sadmin = new MSuper_admin;
	$sadmin->CreateSuper_admin("id", "6");

	$config = new MPlantilla_documento_configuracion;
	$config->CreatePlantilla_documento_configuracion("id", "1");

?>

<div class="row bg-title">
    <div class="col-lg-6 col-md-4 col-sm-12 col-xs-12">
        <h4 class="page-title"><?= CAMPOEXPEDIENTE ?>: <?= $object->GetMin_rad()." - ".$object->GetObservacion() ?></h4> 
    </div>
    <div class="col-lg-6 col-sm-12 col-md-8 col-xs-12">       
<?

    $_SESSION["folder_exp"] = "0";
    $_SESSION['mayedit'] = "0";
    $sc = new MSeccional;
    $sc->CreateSeccional("id", $object->GetOficina());
    $city = new MCity;
    $city->CreateCity("code", $object->GetCiudad());
    $ar = new MAreas;
    $ar->CreateAreas("id", $object->GetDependencia_destino());
    $draiz = new MDependencias();
    $draiz->CreateDependencias("id", $object -> GetId_dependencia_raiz());
    $dep = new MDependencias();
    $dep->CreateDependencias("id", $object -> Gettipo_documento());
    $contact = new Msuscriptores_contactos;
    $contact->CreateSuscriptores_contactos("id", $object -> Getsuscriptor_id());
    $insuscriptor = false;
    $inshare = false;
    $gc = new MGestion_compartir;
    $qn = $gc->ListarGestion_compartir(" where usuario_nuevo = '".$_SESSION['usuario']."' and gestion_id = '".$object->GetId()."'");

    $com = $con->NumRows($qn);
    if ($com >= 1) {
        $inshare = true;
        $gc->CreateGestion_compartirQuery("usuario_nuevo='".$_SESSION['usuario']."' and gestion_id = '".$object->GetId()."'");
        $_SESSION['mayedit'] = $gc->GetType();
    }

    $sg = new MGestion_suscriptores;
    $qns = $sg->ListarGestion_suscriptores(" where id_suscriptor = '".$_SESSION['suscriptor_id']."' and id_gestion = '".$object->GetId()."'");
    $coms = $con->NumRows($qns);

    if ($coms >= 1) {
        $insuscriptor = true;
    }

    $nombreraiz=(strlen($draiz->GetNombre()) > 30 )? substr($draiz->GetNombre(), 0, 30)."...":$draiz->GetNombre();
    $nombredependencia=(strlen($dep->GetNombre()) > 30 )? substr($dep->GetNombre(), 0, 30)."...":$dep->GetNombre();
    $nombresuscriptor=(strlen($contact->GetNombre()) > 30 )? substr($contact->GetNombre(), 0, 30)."...":$contact->GetNombre();

    echo ' 
        <ol class="breadcrumb">
            <li class="breadcrumb-item fa fa-archive"><a href="/proceso/1/"></a></li>
            <li title="'.$draiz->GetNombre().'" class="breadcrumb-item">
                <a href="/dependencias/childs/'.$draiz->GetId().'/">'.$nombreraiz.'</a>
            </li>
            <li title="'.$dep->GetNombre().'" class="breadcrumb-item">
                <a href="/dependencias/explorar/'.$dep->GetId().'/">'.$nombredependencia.'</a>
            </li>
            <li title="'.$contact->GetNombre().'" class="breadcrumb-item">
                <a href="/dependencias/verradicaciones/'.$dep->GetId().'/'.$contact->GetId().'/">'.$nombresuscriptor.'</a>
            </li>
            <li class="breadcrumb-item"></li>
            </ol>';
?>
    </div>
</div>
<div class="row">
    <div class="col-md-12 panel">
        <div class="white-panel">

        	<a href="/gestion/ver/<?= $object->GetId() ?>/" class="btn btn-info m-t-20 btn-lg">Volver al <?= CAMPOEXPEDIENTE ?></a>
			
	<link href="<?= ASSETS.DS ?>css/estilo_editor.css" rel="stylesheet" type="text/css" media="all" />
	<script language="javascript" type="text/javascript" src="<?= ASSETS.DS ?>js/AjaxUpload.2.0.min.js"></script>
	<script language="javascript" type="text/javascript" src="<?= ASSETS.DS ?>js/script_editor.js"></script>

	<div id="folders-list-content">
		<?
			$c = new Consultas;
			$editr = false;
		    if ($_GET['cn'] != "") {
	    		$pathurl = "/documentos_gestion/actualizar/".$_GET['cn']."/";

	    		$doc = new MDocumentos_gestion;
	    		$doc->CreateDocumentos_gestion("id", $_GET['cn']);
				
				$user_id = $doc->GetUser_id();
				$gestion_id = $doc->GetGestion_id();
				$nombre = $doc->GetNombre();
				$f_creacion = $doc->GetF_creacion();
				$f_actualizacion = date("Y-m-d");
				$contenido = $doc->GetContenido();
				$tipo_doc = $doc->GetTipo_doc();

		    	$editr  = true;

		    	$docp = new MDocumentos_gestion_permisos;
		    	$qer = $docp->ListarDocumentos_gestion_permisos("WHERE id_documento = '".$doc->GetId()."'");

		    	$listadousuariospermisos = "";
		    	
		    	while ($roo = $con->FetchAssoc($qer)) {
					$permisoss = "";		    		
		    		if ($roo['usuario_permiso'] == $_SESSION['usuario']) {
		    			$observacion = $roo['observacion'];	
		    			if ($roo['estado'] == "0") {
		    				$permisoss = '	<select onChange="apremdoc(\''.$roo['id'].'\')" id="changeactiondoc" style="width:110px">
											<option value="0">Seleccione una Opción</option>
											<option value="1">Aceptar Documento</option>
											<option value="2">Rechazar Documento</option>
										</select>';
		    			}elseif ($roo['estado'] = "1") {
		    				$permisoss = '<div style="float:right; margin-right:5px;">
                							<div class="mini-ico green-act" title="El usuario ha aceptado el documento"></div>
            							</div>';
		    			}else{
		    				$permisoss = '<div style="float:right; margin-right:5px;">
                							<div class="btn btn-warning btn-circle mdi mdi-delete" title="El usuario ha rechazado el documento"></div>
            							</div>';
		    			}
						

		    		}else{
		    			if ($roo['estado'] == "0") {
		    				$permisoss = '<div style="float:right; margin-right:5px;">
                							<div class="mini-ico green-wait" title="El usuario aun no ha revisado el documento"></div>
            							</div>';
		    			}elseif ($roo['estado'] = "1") {
		    				$permisoss = '<div style="float:right; margin-right:5px;">
                							<div class="mini-ico green-act" title="El usuario ha aceptado el documento"></div>
            							</div>';
		    			}else{
		    				$permisoss = '<div style="float:right; margin-right:5px;">
                							<div class="btn btn-warning btn-circle mdi mdi-delete" title="El usuario ha rechazado el documento"></div>
            							</div>';
		    			}
		    		}

		    		$responsable = $c->GetDataFromTable("usuarios", "user_id", $roo['usuario_permiso'], "p_nombre, p_apellido", $separador = " ");
		    		$listadousuariospermisos .= "<li><div class='t_listado'>".$responsable."</div>$permisoss</li>";
		    	
		    		if ($doc->GetUser_id() == $_SESSION['usuario']) {
		    			$observacion = $roo['usuario_permiso'].": ".$roo['observacion']."\n\n";
		    		}
		    	}

	    	}else{
	    		$pathurl = "/documentos_gestion/registrar/";

	    		$user_id = $_SESSION['usuario'];
				$gestion_id = $object->GetId();
				$nombre = "";
				$f_creacion = date("Y-m-d");
				$f_actualizacion = "";
				$contenido = "";
				$tipo_doc = "0";
	    	}
		?>
		<?
		$_SESSION['mayedit'] = 1;
			if ($_SESSION['mayedit'] == "1") {
		?>


		<form id='formdocumentos_gestion' action='<?= $pathurl ?>' method='POST'> 
			<div class="alert alert-info" style="margin-top:10px">Si la plantilla la trae de Microsoft Word o aplicaciones similares, Por favor pegue el texto sin formato</div>
			<div class="row p-t-10">
				<div class="col-md-10 col-md-offset-1">
					<div class="row">
						<div class="col-md-2 col-xs-2">
							<div class="btn-group" data-toggle="popover" data-trigger="hover" data-content="79: Informacion de prueba" data-placement="right" data-original-title="" title="">
								<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Plantillas
								<span class="caret"></span>
								<span class="sr-only">Toggle Dropdown</span>
								</button>
								<ul class="dropdown-menu">			    						
								 <?

		                        $object2 = new MPlantilla_dependencia;

		                        $query2 = $object2->ListarPlantilla_dependencia("WHERE dependencia_id = '".$dep->GetId()."'");
		                        $i = 0;
		                        while($row = $con->FetchAssoc($query2)){
		                        	$i++;
		                            $ln = new MPlantilla_dependencia;
		                            $ln->Createplantilla_dependencia('id', $row[id]);
		                            ?>
		                                <li>
		                                	<a href="#" id="pl<?=$row[id]?>" title="<?php echo $ln->GetNombre(); ?>" onclick="open_plantilla(<?=$id?>,<?=$row[id]?>)"><?php echo substr($ln->GetNombre(), 0, 40); ?></a>
		                                </li>
		                            <?
		                            
		                        }

		                        echo '<li> <a href="#" onclick="window.location.href=\'/documentos_gestion/nuevo/'.$id.'/\'">Crear un nuevo Documento</a></li>';

		                        if ($i == "0") {
		                        	echo '<li ><a href="#"> No hay documentos creados</a></li>';
		                        }
		                        
		                        ?>
								</ul>
							</div>
						</div>
						<div class="col-md-10 col-xs-10">
					<?

						if ($nombre == "") {
					?>
						<select style="height:42px; min-width:700px; margin-bottom: 0px; margin-top: 0px;" class='form-control'  name='titx' id='titx' >
					<?
							echo  "<option value='0'>Título del ".CAMPOEXPEDIENTE."</option>";	
							$tipo = new MDependencias_tipologias;
							$listado = $tipo->ListarDependencias_tipologias("WHERE id_dependencia = '".$dep->GetId()."'");
							while ($rl = $con->FetchAssoc($listado)) {
								if ($rl['tipologia'] != "") {
									echo  "<option value='".$rl['id']."'>".$rl['tipologia']."</option>";	
								}
							}
					?>	
							<option value="0">TÍTULO PERSONALIZADO</option>
						</select>

			        	<input type="text" class="form-control" placeholder="Escriba el Título del Nuevo Documento" id="nombre" name="nombre" value="<?= $nombre; ?>" style="height:42px; width:700px; margin-bottom: 0px; margin-top: 0px; display: none" placeholder="Título del nuevo documento">

			        	<script>
			        		$("#titx").change(function(){
			        			$("#nombre").val($($("#titx option:selected")).html());
			        			if($(this).val() == "0"){
			        				$("#titx").css("display", "none");
			        				$("#nombre").css("display", 'inline-block');
			        				$("#nombre").val("");
			        				$("#nombre").focus();

			        			}
			        		})
			        	</script>
		        	<?
			        	}else{
	        		?>
	        		<input type="text" class="form-control" placeholder="Escriba el Título del Nuevo Documento" id="nombre" name="nombre" value="<?= $nombre; ?>" style="height:42px; width:700px; margin-bottom: 0px; margin-top: 0px;" placeholder="Título del nuevo documento">
	        		<?

			        	}
		        	?>
							<div id="listado_solicitudes" style="display:none">
						    	<div class="listado_seleccion">
						    		<?php if (!$editr): ?>
							    		<input type="text" id="searchbform" style="width:400px; height:35px;" class="form-control" placeholder="Solicitar Revisión a:" >
							    		<select id="diasmaxtoresponse" name="diasmaxtoresponse" style="width:160px; height:42px">
							    			<option value="0">Seleccione los días maximos para revisar el documento</option>
							    			<option value="1">1 Días</option>
							    			<option value="2">2 Días</option>
							    			<option value="3">3 Días</option>
							    			<option value="7">7 Días</option>
							    			<option value="15">15 Días</option>
							    			<option value="30">1 Mes</option>
							    		</select>
							    		<div id="bloquebusqueda"></div>
							    		<textarea id="observacion" name="observacion" class="form-control" placeholder="Observacion" style="width:575px; height:70px; resize:none"><?= $observacion ?></textarea>
						    		<?php else: ?>
						    			<?php if ($doc->GetUser_id() == $_SESSION['usuario']): ?>
							    				<!--<input type="text" id="searchbform" style="width:400px; height:35px;" class="form-control" placeholder="Solicitar Revisión a:" >
									    		<select id="diasmaxtoresponse" name="diasmaxtoresponse" style="width:160px; height:42px">
									    			<option value="0">Seleccione los días maximos para revisar el documento</option>
									    			<option value="1">1 Días</option>
									    			<option value="2">2 Días</option>
									    			<option value="3">3 Días</option>
									    			<option value="7">7 Días</option>
									    			<option value="15">15 Días</option>
									    			<option value="30">1 Mes</option>
									    		</select>
									    		<div id="bloquebusqueda"></div> -->
									    		<textarea disabled="disabled" id="observacion" name="observacion" class="form-control" placeholder="Observacion" style="width:575px; height:70px; resize:none"><?= $observacion ?></textarea>
						    			<?php else: ?>
									    		<textarea disabled="disabled" id="observacion" name="observacion" class="form-control" placeholder="Observacion" style="width:575px; height:70px; resize:none"><?= $observacion ?></textarea>
						    			<?php endif ?>
						    		<?php endif ?>
						    	</div>
						    	<div class="usuarios_seleccion">
						    		<ul id="ul_usuarios_seleccion">
						    			<?= $listadousuariospermisos ?>
						    		</ul>
						    		<input type="hidden" id="emails_listado_seleccion" name="emails_listado_seleccion" value="<?= $emailsseleccion ?>">
						    	</div>
						    	<div style="clear:both;"></div>
						    </div>
						    <!--<div id="btn_collapse" class="show"  style="display:none" title="Mostrar/Ocutar Solicitudes de revision del documento"></div>-->

						</div>
					</div>	
					<div class="row m-t-10">
						<div class="col-md-12">
							<input type="submit" value='Guardar Documento' name="submit" class="btn btn-info pull-right">
						</div>
					</div>
				</div>
			</div>
			<div id="menu_minutas" style="width:100%;">
		        <div style="float:left; margin-bottom: 10px">
				    <input type='hidden' placeholder="user_id" name='user_id' id='user_id'  value = "<?= $user_id ?>" maxlength='100'  />
					<input type='hidden' placeholder="gestion_id" name='gestion_id' id='gestion_id'  value = "<?= $gestion_id ?>" maxlength='9' />

					
					<input type='hidden' placeholder="f_creacion" name='f_creacion' id='f_creacion'  value = "<?= $f_creacion ?>" maxlength=''  />
					<input type='hidden' placeholder="f_actualizacion" name='f_actualizacion' id='f_actualizacion'  value = "<?= $f_actualizacion ?>" maxlength='' />
					<input type='hidden' placeholder="tipo_doc" name='tipo_doc' id='tipo_doc'  value = "<?= $tipo_doc ?>" maxlength='' />
			    </div>
		
			    <div id="bodyform_minutas" style="width:1022px; margin: 10px auto;">
			        <div class="bloq_newdoc" style="float:left; width: 100%;" id="bloq_editor">
			           	<div id="buttons">
				            <button type="button" class="botone" onClick="format_buttonCSS('bold')"><span class="icon bold"></span></button>
				            <button type="button" class="botone" onClick="format_buttonCSS('italic')"><span class="icon italic"></span></button>
				            <button type="button" class="botone" onClick="format_buttonCSS('underline')"><span class="icon underline"></span></button>
				            <button type="button" class="botone" onClick="format_buttonCSS('sline')"><span class ="icon line"></span></button>
				            <button type="button" class="botone" onClick="align_button('JustifyLeft')"><span class ="icon left"></span></button>
				            <button type="button" class="botone" onClick="align_button('JustifyRight')"><span class ="icon right"></span></button>
				            <button type="button" class="botone" onClick="align_button('JustifyCenter')"><span class ="icon center"></span></button>
				            <button type="button" class="botone" onClick="align_button('JustifyFull')"><span class ="icon justify"></span></button>
				            <button type="button" class="botone" onClick="align_button('indent')"><span class="icon indent"></span></button>
				            <button type="button" class="botone" onClick="align_button('outdent')"><span class="icon outdent"></span></button>
				            <button type="button" class="botone" onClick="align_button('InsertOrderedList')"><span class="icon numberlist"></span></button>
				            <button type="button" class="botone" onClick="align_button('InsertUnorderedList')"><span class="icon dotslist"></span></button>
				            <button type="button" id="fontsize" class="botone"><span class="icon fontsize"></span>
				            	<ul>
				                    <li onClick="format_buttonCSS('FontSize<?= $tamano ?>')">Normal (<?= $tamano ?>px)</li>
				                    <li onClick="format_Heading('h3')">Encabezado 1</li>
				                    <li onClick="format_Heading('h4')">Encabezado 2</li>
				                    <li onClick="format_Heading('h5')">Encabezado 3</li>
				                </ul>
				            </button>
				            <!--<button type="button" id="fonttype" class="botone"><span class="icon fonttype"></span>
				                <ul>
				                    <li onClick="format_buttonCSS('fontArial')">Arial</li>         
				                    <li onClick="format_buttonCSS('fontCourrier')">Courrier New</li>            
				                    <li onClick="format_buttonCSS('fontVerdana')">Verdana</li>
				                    <li onClick="format_buttonCSS('fontMonotypeCorsiva')">Monotype</li>
				                    <li onClick="format_buttonCSS('fontTahoma')">Tahoma</li>
				                    <li onClick="format_buttonCSS('fontTimes')">Times</li>
				                </ul>
				            </button>-->
				            <button type="button" class="botone" onClick="InsertQuote('addquote')"><span class="icon quote"></span></button>
				            <button type="button" class="botone" onClick="DoTable()"><span class="icon gird"></span></button>
				            <button type="button" class="botone" id="upload_button"><span class="icon image"></span></button>
				            <button type="button" class="botone" onClick="InsertVideo()"><span class="icon video"></span></button>
				            <button type="button" class="botone" onClick="url_button()"><span class="icon link"></span></button>
				            <button type="button" class="botone" onClick="showhtml()"><span class="icon html"></span></button>
				            <br>
				            <div style="margin: 5px;">
				            	<select class="form-control" id="sel_plantillaemail" style="margin-bottom:5px; width:170px">
									<option value="">Datos del Expediente</option>
									<option value="<?= $object->GetObservacion(); ?>">Título del <?= CAMPOEXPEDIENTE ?></option>
									<option value="<?= $object->GetRadicado(); ?>"><?= CAMPORADEXTERNO ?></option>
									<option value="<?= $object->GetMin_rad(); ?>"><?= CAMPORADRAPIDO ?></option>
									<option value="<?= $nombresuscriptor; ?>"><?= SUSCRIPTORCAMPONOMBRE ?> Principal</option>
									<!--<option value="<?= $object->GetEstado_respuesta(); ?>">Estado de la Solicitud</option>
									<option value="<?= $object->GetF_recibido(); ?>">Fecha de Ingreso</option>
									<option value="<?= $object->GetFecha_vencimiento(); ?>">Fecha de Vencimiento</option> -->
									<!--
									<option value="">¿Resuelto?</option>
									<option value="">Fecha de Respuesta</option>
									<option value="">Prioridad</option>
									-->
									<option value="<?= $object->Getfolio() ?>"># Folios</option>
								<? 
	                                    $u = new MUsuarios;
	                                    $u->CreateUsuarios("a_i", $object -> Getnombre_destino());
	                                    $nombreresponsable = $u->GetP_nombre()." ".$u->GetP_apellido();
                               	?>
								<option value="<?= $nombreresponsable; ?>">Parte Interesada</option>
								<? 
                                    $d = new MDependencias();
                                    $d->CreateDependencias("id", $object -> GetId_dependencia_raiz());

                                ?>
									<option value="<?= $d->GetNombre(); ?>"><?= SERIE ?></option>
								<? 

                                    $d = new MDependencias();
                                    $d->CreateDependencias("id", $object -> Gettipo_documento());

                                ?>
									<option value="<?= $d->GetNombre() ?>"><?= SUB_SERIE ?></option>
									<!--<option value="<?= $object->Getobservacion2() ?>">Observacion</option>-->
								<?
									$ar2 = array("1" => "Archivo de Gestión", "2" => "Archivo Central", "3" => "Archivo Histórico", 
												"-1" => "Eliminación", "-2" => "Conservación Total", "-3" => "Digitalización", "-4" => "Selección", 
												"-5" => "MicroFilmación", "-6" => "Hibrido", "-7" => "Digitalizar y Eliminar", 
												"-8" => "Seleccionar y Eliminar", "-9" => "Conservación Total y Digitalización");
								?>
									<!-- <option value="<?= $ar2[$object -> Getestado_archivo()] ?>">Ubicación</option>-->
					            </select>
			            	<?
		            		$query = $con->Query("select * from meta_big_data where type_id = '".$object->GetId()."' and tipo_form = '1' group by grupo_id order by id");

		        			while($row = $con->FetchAssoc($query)){
								$l = new MMeta_referencias_titulos;
								$l->CreateMeta_referencias_titulos('id', $row['ref_id']);
								$path = "";
								echo "
										<select class='form-control' id='sel_".$l->GetId()."' style='margin-bottom:5px; width:150px'>
											<option> ".$l -> GetTitulo()." </option>
											<optgroup label = '---'>";

											$data = new MMeta_referencias_campos;
											$queryy = $data->ListarMeta_referencias_campos("where id_referencia = '".$l->GetId()."'");
											while ($rx = $con->FetchAssoc($queryy)) {
												$qy = $con->Query("select valor from meta_big_data where  grupo_id = '".$row['grupo_id']."' and campo_id = '".$rx['id']."'");
												$valor = $con->FetchAssoc($qy);

													$path .= '<option value="&nbsp;<b>'.$valor['valor'].'</b>&nbsp;">'.$rx['titulo_campo'].': '.$valor['valor'].'</option>'; 
											}
												echo $path;
								echo "		</optgroup>
										</select>";
							}
			            	?>
				            </div>
				        </div>
				        <?

							$m_t 	= ($config->GetM_t() * 28) - 50;
							$m_r	= $config->GetM_r() * 28;
							$m_b	= $config->GetM_b() * 28;
							$m_l	= $config->GetM_l() * 28;
							$m_e_t	= $config->GetM_e_t() * 28;
							$m_e_b	= $config->GetM_e_b() * 28;
							$m_p_t	= $config->GetM_p_t() * 28;
							$m_p_b	= $config->GetM_p_b() * 28;
							$fuente = $config->GetFuente();
							$tamano = $config->GetTamano();

				        ?>
				        <style>
				        	@font-face {
								font-family: "def_font";
								src: url(<?= HOMEDIR.DS.'app/views/assets/fonts/'.$fuente ?>);
							}
				        	.editor, #editor{
				        		font-family: "def_font", Arial;
								border-top:none;
								border-bottom:none;
								margin-top:0px;
								margin-bottom: 0px;

								padding-left: <?= $m_l; ?>px;
								padding-right: <?= $m_r; ?>px;
								padding-top: <?= $m_t; ?>px;
								padding-bottom: <?= $m_b; ?>px;
								font-size: <?= $tamano; ?>px;
								line-height: <?= $tamano+2; ?>px;
				        	}
				        	.encabezado{
				        		border-top: 1px solid #ccc;
				        		border-left: 1px solid #ccc;
				        		border-right: 1px solid #ccc;
				        		background: #FFF;
				        		padding-top: <?= $m_e_t; ?>px;
				        		padding-bottom: <?= $m_e_b; ?>px;
				        		height: 100px;
				        	}
				        	.pie{
				        		border-bottom: 1px solid #ccc;
				        		border-left: 1px solid #ccc;
				        		border-right: 1px solid #ccc;
				        		padding-top: <?= $m_p_t; ?>px;
				        		padding-bottom: <?= $m_p_b; ?>px;
				        		background-color: #FFF;
				        	}
				        </style>
				        <div  class="container_editor">
				        	<div class="encabezado"><img src="<?= HOMEDIR.DS."app/plugins/thumbnails/".$sadmin->GetEncabezado() ?>" width="100%" style="padding: 0px;margin: 0px;" height="100px"></div>
			            	<div id="editor" name="editor" class="text_notas scrollable"><?= $contenido ?></div>
			            	<div class="pie"><img src="<?= HOMEDIR.DS."app/plugins/thumbnails/".$sadmin->GetPie_pagina() ?>" width="100%" style="padding: 0px;margin: 0px;" height="100px"></div>
				        </div>
			            <textarea style="display:none" class="text_notas marginbottom_2 scrollable" name='descripcion' id='descripcion' maxlength='' placeholder="Escribe tu nota aquí..."><?= $contenido ?></textarea>
			        </div>
			        <div class="clear"></div>
				</div>
			</div>
		</form>
		<?
			}else{
		?>
			<div id="menu_minutas"style="width:100%; height: 50px; ">
		        <div id="nav" style="width:200px; float:left; background:#FFF; border:1px solid #FFF; margin-left:10px;"></div>
		        <div style="float:left; margin-bottom: 10px">
		        	<h2>
		        		<?= $nombre; ?>
		        	</h2>
			    </div>
			    <div id="bodyform_minutas" style="width:1000px; margin: 10px auto;">
			        <div class="bloq_newdoc" style="float:left; width: 100%;" id="bloq_editor">
			           	<div id="buttons">
				            <button type="button" class="botone" onClick="format_buttonCSS('bold')"><span class="icon bold"></span></button>
				            <button type="button" class="botone" onClick="format_buttonCSS('italic')"><span class="icon italic"></span></button>
				            <button type="button" class="botone" onClick="format_buttonCSS('underline')"><span class="icon underline"></span></button>
				            <button type="button" class="botone" onClick="format_buttonCSS('sline')"><span class ="icon line"></span></button>
				            <button type="button" class="botone" onClick="align_button('JustifyLeft')"><span class ="icon left"></span></button>
				            <button type="button" class="botone" onClick="align_button('JustifyRight')"><span class ="icon right"></span></button>
				            <button type="button" class="botone" onClick="align_button('JustifyCenter')"><span class ="icon center"></span></button>
				            <button type="button" class="botone" onClick="align_button('JustifyFull')"><span class ="icon justify"></span></button>
				            <button type="button" class="botone" onClick="align_button('indent')"><span class="icon indent"></span></button>
				            <button type="button" class="botone" onClick="align_button('outdent')"><span class="icon outdent"></span></button>
				            <button type="button" class="botone" onClick="align_button('InsertOrderedList')"><span class="icon numberlist"></span></button>
				            <button type="button" class="botone" onClick="align_button('InsertUnorderedList')"><span class="icon dotslist"></span></button>
				            <button type="button" id="fontsize" class="botone"><span class="icon fontsize"></span>
				            	<ul>
			                        <li onClick="format_buttonCSS('FontSize<?= $tamano ?>')">Normal (<?= $tamano ?>px)</li>
				                    <li onClick="format_Heading('h3')">Encabezado 1</li>
				                    <li onClick="format_Heading('h4')">Encabezado 2</li>
				                    <li onClick="format_Heading('h5')">Encabezado 3</li>
				                </ul>
				            </button>
				            <!--<button type="button" id="fonttype" class="botone"><span class="icon fonttype"></span>
				                <ul>
				                    <li onClick="format_buttonCSS('fontArial')">Arial</li>         
				                    <li onClick="format_buttonCSS('fontCourrier')">Courrier New</li>            
				                    <li onClick="format_buttonCSS('fontVerdana')">Verdana</li>
				                    <li onClick="format_buttonCSS('fontMonotypeCorsiva')">Monotype</li>
				                    <li onClick="format_buttonCSS('fontTahoma')">Tahoma</li>
				                    <li onClick="format_buttonCSS('fontTimes')">Times</li>
				                </ul>
				            </button>-->
				            <button type="button" class="botone" onClick="InsertQuote('addquote')"><span class="icon quote"></span></button>
				            <button type="button" class="botone" onClick="DoTable()"><span class="icon gird"></span></button>
				            <button type="button" class="botone" id="upload_button"><span class="icon image"></span></button>
				            <button type="button" class="botone" onClick="InsertVideo()"><span class="icon video"></span></button>
				            <button type="button" class="botone" onClick="url_button()"><span class="icon link"></span></button>
				            <button type="button" class="botone" onClick="showhtml()"><span class="icon html"></span></button>
				            <br>
				            <div style="margin: 5px;">
				            <?
		            		$query = $con->Query("select * from meta_big_data where type_id = '".$object->GetId()."' and tipo_form = '1' group by grupo_id order by id");

		        			while($row = $con->FetchAssoc($query)){
								$l = new MMeta_referencias_titulos;
								$l->CreateMeta_referencias_titulos('id', $row['ref_id']);
								$path = "";
								echo "
										<select class='form-control' id='sel_".$l->GetId()."' style='margin-bottom:5px; width:150px'>
											<option> ".$l -> GetTitulo()." </option>
											<optgroup label = '---'>";

											$data = new MMeta_referencias_campos;
											$queryy = $data->ListarMeta_referencias_campos("where id_referencia = '".$l->GetId()."'");
											while ($rx = $con->FetchAssoc($queryy)) {
												$qy = $con->Query("select valor from meta_big_data where  grupo_id = '".$row['grupo_id']."' and campo_id = '".$rx['id']."'");
												$valor = $con->FetchAssoc($qy);

													$path .= '<option value="&nbsp;'.$rx['titulo_campo'].': <b>'.$valor['valor'].'</b>&nbsp;">'.$rx['titulo_campo'].': '.$valor['valor'].'</option>'; 
											}
												echo $path;
								echo "		</optgroup>
										</select>";
							}
			            	?>
				            </div>
				        </div>
				        <div  class="container_editor">
			            	<div id="editor" name="editor" class="text_notas scrollable noeditable"><?= $contenido ?></div>
				        </div>
			            <textarea style="display:none" class="text_notas marginbottom_2 scrollable" name='descripcion' id='descripcion' maxlength='' placeholder="Escribe tu nota aquí..."><?= $contenido ?></textarea>
			        </div>
			        <div class="clear"></div>
				</div>
			</div>
		</form>
		<?
			}
		?>
		<div class="clear"></div>
		</div>
	</div>
</div>
<script>

    function open_plantilla(id_gestion, id_plantilla){
        $.ajax({
            url:'/plantilla_dependencia/GET/'+id_gestion+'/'+id_plantilla+'/',
            success:function(msg){
                var data = eval('('+msg+')');
                $('#editor').html('');
                $("#descripcion").val('');
                $('#editor').focus();
                document.execCommand("inserthtml", null, data['content']);
                $("#descripcion").val(data['content']);
                $('#tipo_doc').val(id_plantilla);
                $('#nombre').val(data['name']);
                $('#ul_usuarios_seleccion').append(data['listado_seleccion']);

                var value = $("#emails_listado_seleccion").val()+""+data['emails_listado_seleccion'];
				$("#emails_listado_seleccion").val(value);

                path = "";
                $( "#editor .eltof" ).each(function( index ) {
                	path += $(this).text()+"@@@";
				});
				var URL = '/plantilla_dependencia/find/'+path+'/'+id_gestion+'/';
			    $.ajax({
			        type: 'POST',
			        url: URL,
			        success: function(nmsg){
			            result = nmsg;

			            part = result.split("@@@");

			            for (var i = 0; i <= part.length; i++) {
			            	var elm = part[i].split("-*.-");
			            	clase = elm[0];
			            	$("."+clase.trim()).html(elm[1]);

			            };
			        }
			    });   
            }
        })
    }

    function BorrarDelListado(elmm, id){

		$("#elm"+id).remove();

		var xl   = $("#emails_listado_seleccion").val();
		vector  = xl.split(";");
		var xt = "";

		for (var i = 0 ; i < vector.length ; i++){
			if(vector[i] == elmm){
				vector.slice(i);                        
			}else{
				xt += vector[i]+";";
			}
		}
		$("#emails_listado_seleccion").val(xt);
    }


    $(document).ready(function() {


        capa = $("#bloq_editor");
        $(window).scroll(function () {
          var elt = $("#buttons");    
          Bt = window.name = window.pageYOffset;
          //var p = $( "bloq_editor" );
          //var position = p.position();
          //Bt = position.top ;

          if (Bt > 180){
            elt.addClass("pointed");
            elt.css("position","fixed");
            elt.css("width", $("#bloq_editor").width()+"px");
            elt.css("top","69px");
            elt.css("-moz-box-shadow","0px 3px 8px 0px rgba(50, 50, 50, 0.21)");
            elt.css("-webkit-box-shadow","0px 3px 8px 0px rgba(50, 50, 50, 0.21)");
            elt.css("box-shadow","0px 3px 8px 0px rgba(50, 50, 50, 0.21)");           
          }else{
            elt.removeClass("pointed");
            elt.css("position","relative");
            elt.css("top","auto");
            elt.css("width","auto");
            elt.css("-moz-box-shadow","none");
            elt.css("-webkit-box-shadow","none");
            elt.css("box-shadow","none");           
          }

        });

        $('.select-opc').change(function() {
            AddHtml($(this).attr("id"), $(this).val());
        });

        $("#btn_collapse").click(function(){

        	if(!$(this).hasClass("show")){
            
	            $("#listado_solicitudes").slideUp("fast");
	            $(this).addClass("show")
	            $(this).removeClass("hide")

	        }else{
	            $("#listado_solicitudes").slideDown("fast");
	            $(this).addClass("hide")
	            $(this).removeClass("show")
	        }

        })
    });
</script>
<script>
		
	$("#searchbform").on("keyup", function(){

		$("#bloquebusqueda").fadeIn();				

		$.ajax({
			type: "POST",
			url: '/usuarios/GestListadoUsuarios/'+$(this).val()+"/",
			success: function(msg){
				result = msg;
				$("#bloquebusqueda").html(result);					
			}
		});				
	})
	
	function onTecla(e){	
		var num = e?e.keyCode:event.keyCode;
		if (num == 9 || num == 27){
			$("#bloquebusqueda").fadeOut();		
		}
	}
	
	document.onkeydown = onTecla;
	if(document.all){
		document.captureEvents(Event.KEYDOWN);	
	}

	function AddUsuarioToListado(nombre, email, id){
		
		$("#searchbform").val("");
		var value = $("#emails_listado_seleccion").val()+""+email+";";
		$("#emails_listado_seleccion").val(value);

		var string = "<li id='elm"+id+"'><div class='t_listado'>"+nombre+"</div><div class='elm_listado' onClick='BorrarDelListado(\""+email+"\", \""+id+"\")'>Borrar</div></li>";
		$("#ul_usuarios_seleccion").append(string);
		$("#bloquebusqueda").fadeOut();		
	}

</script>
<style type="text/css">

     .black_space{
        height: 30px;
        line-height: 18px;
        color: #fff;
        background-color: #585858;
        padding: 8px;
        float: left;
        border-radius: 6px
    }

</style>