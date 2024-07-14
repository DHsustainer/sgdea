<script language='javascript' type='text/javascript' src='<?=ASSETS?>/js/jscripts.js?f=<?php echo date("YmdHi"); ?>'></script>
<h2>Configurar: <?= $dep->GetNombre() ?></h2>

<ul class="nav customtab nav-tabs" role="tablist">
	<?
	if ($_SESSION['MODULES']['formularios'] == "1") {
?>
    <li role="presentation" class="formularios" onclick="OpenWindow('/dependencias/metadatos/<?= $dep->GetId() ?>/')" id="views_formularios">
    	<a href="#home1" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="true">
    		<span>
    			<i class="fa fa-wpforms "></i>
    		</span>
    		<span class="hidden-xs"> Formularios</span>
    	</a>
    </li>
<?
	}
?>
<?
	if ($_SESSION['MODULES']['inmaterializacion'] == "1") {
?>
    <li role="presentation" class="docsnew active " onclick="window.location.href='<?=HOMEDIR.DS.'dependencias/views_minutas/'.$dep->GetId().'/' ?>'" id="views_minutas">
    	<a href="#profile1" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false">
    		<span>
    			<i class="fa fa-file-pdf-o"></i>
    		</span>
    		 <span class="hidden-xs">Documentos Genericos</span>
		</a>
	</li>
<?
	}
?>
    <li role="presentation" class="documentos" onclick="cargador_box('views_tipologias','<?= $dep->GetId() ?>')" id="views_tipologias">
    	<a href="#messages1" aria-controls="messages" role="tab" data-toggle="tab" aria-expanded="false">
			<span>
				<i class="fa fa-tags"></i>
			</span>
			 <span class="hidden-xs">Tipos Documentales</span>
		</a>
	</li>
    <li role="presentation" class="alertas " onclick="cargador_box('views_alertas_subs','<?= $dep->GetId() ?>')" id="views_alertas_subs">
    	<a href="#settings1" aria-controls="settings" role="tab" data-toggle="tab" aria-expanded="false">
			<span>
				<i class="fa fa-bell"></i>
			</span>
			 <span class="hidden-xs">Alertas</span>
		</a>
	</li>
	<li role="presentation" class="estados"  onclick="cargador_box('views_estados','<?= $dep->GetId() ?>')" id="views_estados">
    	<a href="#settings1" aria-controls="settings" role="tab" data-toggle="tab" aria-expanded="false">
			<span>
				<i class="fa fa-list-ul"></i>
			</span>
			 <span class="hidden-xs">Estados Personalizados</span>
		</a>
	</li>
<?
	if ($_SESSION['MODULES']['workflow'] == "1") {
?>
	<div title="Flujos de Trabajo" ></div>
	<li role="presentation"  class="permisosdoc"  onclick="OpenWindow('/flujos/mod/<?= $dep->GetId() ?>/S/')" id="views_permisos_doc">
    	<a href="#settings1" aria-controls="settings" role="tab" data-toggle="tab" aria-expanded="false">
			<span>
				<i class="fa fa-gears"></i>
			</span>
			 <span class="hidden-xs">Flujos de Trabajo</span>
		</a>
	</li>
<?
	}
?>	
</ul>

	<div title="Documentos obiligatorios" class="anexos fa fa-paperclip" onclick="cargador_box('views_doc_obligatorios','<?= $dep->GetId() ?>')" id="views_doc_obligatorios" style="display: none"></div>
<?
	if ($_SESSION['MODULES']['inmaterializacion'] == "1") {
?>
	<div title="Permisos de Documentos"  style="display: none" class="permisosdoc fa fa-lock" onclick="cargador_box('views_permisos_doc','<?= $dep->GetId() ?>')" id="views_permisos_doc"></div>
<?
	}
?>

<div id="cargador_box" class="m-t-30">

<link href="<?= ASSETS.DS ?>css/estilo_editor.css" rel="stylesheet" type="text/css" media="all" />
<script language="javascript" type="text/javascript" src="<?= ASSETS.DS ?>js/AjaxUpload.2.0.min.js"></script>
<script language="javascript" type="text/javascript" src="<?= ASSETS.DS ?>js/script_editor.js"></script>

<div id="herr-content" style="margin-left:70px">
	<div class="item-herr gest-herr">
		<div id="gestiones">
			<div class="item-gest subsr-per">
				<div id="list_nat" class="item-content-gest">
					<div id="formsubsrs">
						<div id="LoadDetailDependencia">
							<div class="submenu_box menu-expediente" id="menu_tab"></div>
						</div>
						<?
							$dep = new MDependencias;
							$dep->CreateDependencias("id", $id);
					    
						    if ($_GET['cn'] != "") {
					    		$pathurl = "/plantilla_dependencia/actualizar/".$_GET['cn']."/".$_GET['id']."/";

					    	}else{

					    		$pathurl = "/plantilla_dependencia/registrar/";

					    	}
						?>
						<div id="cargador_box">
							<div class="alert alert-warning">En este panel puede crear los documentos genericos de cada sub-serie</div>
							<br>
							<form method="POST" action="<?= $pathurl ?>"> 
							<?
								if ($_GET['cn'] != "") {
						    		$pathurl = "/plantilla_dependencia/actualizar/";

						    		$pd = new MPlantilla_dependencia;
						    		$pd->Createplantilla_dependencia("id", $_GET['cn']);

									$fecha = $pd -> Getf_creacion();
									$nombre =  $pd -> Getnombre(); 
									$usuario = $pd -> Getuser_id();
									$content = $pd -> Getcontenido();
									$id_pl = $pd->GetId();
									$dataupdate = date("Y-m-d");

						    	}else{

						    		$pathurl = "/plantilla_dependencia/registrar/";
						    		$fecha = date("Y-m-d");
									$nombre =  ""; 
									$usuario = $_SESSION['usuario'];
									$content = "";

						    	}
							?>
							    <div id="menu_minutas"style="width:100%; height: 50px; ">
							    	<div class="row">
						        		<div class="col-md-2">
											<div class="btn-group">
												<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
													Documentos
													<span class="caret"></span>
													<span class="sr-only">Toggle Dropdown</span>
												</button>
												<ul class="dropdown-menu">			    						
												<?

							                        $object2 = new MPlantilla_dependencia;

							                        $query2 = $object2->ListarPlantilla_dependencia("WHERE dependencia_id = '".$id."'");    
							                        $i = 0;
							                        while($row = $con->FetchAssoc($query2)){
							                        	$i++;
							                            $ln = new MPlantilla_dependencia;
							                            $ln->Createplantilla_dependencia('id', $row[id]);
							                            ?>
							                                <li id="pl<?=$row[id]?>" title="<?php echo $ln->GetNombre(); ?>" onclick="view_plantilla(<?=$id?>,<?=$row[id]?>)"><a href="#"><?php echo substr($ln->GetNombre(), 0, 40); ?></a></li>
							                            <?
							                            
							                        }

							                        echo '<li onclick="view_plantilla(\''.$id.'\',\'\')"><a href="#">Crear un nuevo Documento</a></li>';

							                        if ($i == "0") {
							                        	echo '<li><a href="#">No hay documentos creados</a></li>';
							                        }
							                        
							                    ?>
												</ul>
											</div>
						        		</div>
						        		<div class="col-md-10">
								        	<div class="row">
								        		<div class="col-md-10">
								        			<input type="text" class="form-control" placeholder="Escriba el Título del Nuevo Documento" id="nombre" name="nombre" value="<?= $nombre; ?>" placeholder="Título del nuevo documento">
								        		</div>
								        		<div class="col-md-2">
								        			<input type="submit" value='GUARDAR' name="submit" class="btn btn-info" >
								        		</div>
								        	</div>

								        	<input type='hidden' placeholder="id" name='id' id='id' value='<?= $id_pl ?>' />
											<input type='hidden' placeholder="f_actualizacion" name='f_actualizacion' id='f_actualizacion' maxlength='' value='<?= $dataupdate;  ?>' />
								        	<input type='hidden' placeholder="user_id" name='user_id' id='user_id' maxlength='' value='<? echo $usuario; ?>' />
											<input type='hidden' placeholder="f_creacion" name='f_creacion' id='f_creacion' maxlength='' value='<? echo $fecha; ?>' />
								        	<input type='hidden' placeholder="dependencia_id" name='dependencia_id' id='dependencia_id' maxlength='' value='<? echo $id; ?>' />
						        		</div>
						        	</div>
		
							    </div>
							     <div class="alert alert-info" style="margin-top:10px">Si la plantilla la trae de Microsoft Word o aplicaciones similares, Por favor pegue el texto sin formato</div>

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
								                    <li onClick="format_buttonCSS('FontSize8')">8</li>
								                    <li onClick="format_buttonCSS('FontSize9')">9</li>
								                    <li onClick="format_buttonCSS('FontSize10')">10</li>
								                    <li onClick="format_buttonCSS('FontSize11')">Normal (11)</li>
								                    <li onClick="format_buttonCSS('FontSize12')">12</li>
								                    <li onClick="format_buttonCSS('FontSize14')">14</li>
								                    <li onClick="format_buttonCSS('FontSize16')">16</li>
								                    <li onClick="format_buttonCSS('FontSize18')">18</li>
								                    <li onClick="format_buttonCSS('FontSize20')">20</li>
								                    <li onClick="format_buttonCSS('FontSize22')">22</li>
								                    <li onClick="format_buttonCSS('FontSize24')">24</li>
								                    <li onClick="format_buttonCSS('FontSize26')">26</li>
								                    <li onClick="format_buttonCSS('FontSize28')">28</li>
								                    <li onClick="format_buttonCSS('FontSize30')">30</li>
								                    <li onClick="format_buttonCSS('FontSize32')">32</li>
								                    <li onClick="format_buttonCSS('FontSize34')">34</li>
								                    <li onClick="format_buttonCSS('FontSize36')">36</li>
								                </ul>
								            </button>
								            <button type="button" id="fonttype" class="botone"><span class="icon fonttype"></span>
								                <ul>
								                    <li onClick="format_buttonCSS('fontArial')">Arial</li>         
								                    <li onClick="format_buttonCSS('fontCourrier')">Courrier New</li>            
								                    <li onClick="format_buttonCSS('fontVerdana')">Verdana</li>
								                    <li onClick="format_buttonCSS('fontMonotypeCorsiva')">Monotype</li>
								                    <li onClick="format_buttonCSS('fontTahoma')">Tahoma</li>
								                    <li onClick="format_buttonCSS('fontTimes')">Times</li>
								                </ul>
								            </button>
								            <button type="button" class="botone" onClick="InsertQuote('addquote')"><span class="icon quote"></span></button>
								            <button type="button" class="botone" onClick="DoTable()"><span class="icon gird"></span></button>
								            <button type="button" class="botone" id="upload_button"><span class="icon image"></span></button>
								            <button type="button" class="botone" onClick="InsertVideo()"><span class="icon video"></span></button>
								            <button type="button" class="botone" onClick="url_button()"><span class="icon link"></span></button>
								            <button type="button" class="botone" onClick="showhtml()"><span class="icon html"></span></button>
								            <br>
								            <select class='select-opc form-control' id='sel_".$l->GetId()."' style='margin-bottom:5px; width:170px; display: inline !important;'>
												<option>Datos del Expediente</option>
												<option value="&nbsp;<b>[elemento]rad_externo[/elemento]</b>&nbsp;">Radicado Externo</option>
												<option value="&nbsp;<b>[elemento]rad_completo[/elemento]</b>&nbsp;">Radicado Completo</option>
												<option value="&nbsp;<b>[elemento]rad_rapido[/elemento]</b>&nbsp;">Radicado Rapido</option>
												<option value="&nbsp;<b>[elemento]Suscriptor[/elemento]</b>&nbsp;">Nombre del Suscriptor Principal</option>
												<option value="&nbsp;<b>[elemento]Estado[/elemento]</b>&nbsp;">Estado de la Solicitud</option>
												<option value="&nbsp;<b>[elemento]Fecha_registro[/elemento]</b>&nbsp;">Fecha de Ingreso</option>
												<option value="&nbsp;<b>[elemento]tipo_documento[/elemento]</b>&nbsp;">Tipo de Documento</option>
												<option value="&nbsp;<b>[elemento]fecha_vence[/elemento]</b>&nbsp;">Fecha de Vencimiento</option>
												<option value="&nbsp;<b>[elemento]Resuelto[/elemento]</b>&nbsp;">¿Resuelto?</option>
												<option value="&nbsp;<b>[elemento]fecha_respuesta[/elemento]</b>&nbsp;">Fecha de Respuesta</option>
												<option value="&nbsp;<b>[elemento]prioridad[/elemento]</b>&nbsp;">Prioridad</option>
												<option value="&nbsp;<b>[elemento]folios[/elemento]</b>&nbsp;"># Folios</option>
												<option value="&nbsp;<b>[elemento]departamento[/elemento]</b>&nbsp;">Departamento de Origen</option>
												<option value="&nbsp;<b>[elemento]ciudad[/elemento]</b>&nbsp;">Ciudad de Origen</option>
												<option value="&nbsp;<b>[elemento]oficina[/elemento]</b>&nbsp;">Oficina de Origen</option>
												<option value="&nbsp;<b>[elemento]area[/elemento]</b>&nbsp;">Area Asignada</option>
												<option value="&nbsp;<b>[elemento]responsable[/elemento]</b>&nbsp;">Usuario Responsable</option>
												<option value="&nbsp;<b>[elemento]serie[/elemento]</b>&nbsp;">Serie Documental</option>
												<option value="&nbsp;<b>[elemento]sub_Serie[/elemento]</b>&nbsp;">Sub Serie Documental</option>
												<option value="&nbsp;<b>[elemento]observacion[/elemento]</b>&nbsp;">Observacion</option>
												<option value="&nbsp;<b>[elemento]ubicacion[/elemento]</b>&nbsp;">Ubicación</option>
								            </select>
								           	<?

						            		$query = $con->Query("select * from suscriptores_tipos where correspondencia in('1', '2')");

						        			while($row = $con->FetchAssoc($query)){

												$path = "";
												echo "
													<select class='select-opc  form-control' id='sel_".$row['id']."' style='margin-bottom:5px; width:150px; display:inline !important;'>
														<option> ".$row['nombre']." </option>
														<optgroup label = '---'>
															<option value='&nbsp;<b>[sc]".$row['id']."_nombre[/sc]</b>'>Nombre del Suscriptor</option>
															<option value='&nbsp;<b>[sc]".$row['id']."_id[/sc]</b>'>Identificación del Suscriptor</option>
															<option value='&nbsp;<b>[sc]".$row['id']."_direccion[/sc]</b>'>Dirección del Suscriptor</option>
															<option value='&nbsp;<b>[sc]".$row['id']."_ciudad[/sc]</b>'>Ciudad del Suscriptor</option>
															<option value='&nbsp;<b>[sc]".$row['id']."_telefono[/sc]</b>'>Teléfono del Suscriptor</option>
															<option value='&nbsp;<b>[sc]".$row['id']."_email[/sc]</b>'>E-mail del Suscriptor</option>
															<option value='&nbsp;<b>".$row['nombre']."</b>'>Tipo de Suscriptor</option>
														</optgroup>
													</select>";
											}
							            	?>
								            <br>
								            <div style="margin: 5px;">
							            	<?
							            		$rf = new MMeta_referencias_titulos;
							            		$query = $rf->ListarMeta_referencias_titulos(" WHERE id_s = '".$id."' and tipo = '1'");

							        			while($row = $con->FetchAssoc($query)){
													$l = new MMeta_referencias_titulos;
													$l->CreateMeta_referencias_titulos('id', $row[id]);
													$path = "";
													echo "
															<select class='form-control' id='sel_".$l->GetId()."' style='margin-bottom:5px; width:150px'>
																<option> ".$l -> GetTitulo()." </option>
																<optgroup label = '---'>";

																$data = new MMeta_referencias_campos;
																$queryy = $data->ListarMeta_referencias_campos("where id_referencia = '".$l->GetId()."'");
																while ($rx = $con->FetchAssoc($queryy)) {

																	$path .= '<option value="&nbsp;<b>'.$rx['titulo_campo'].': [meta]'.$rx['id'].'_'.$rx['slug'].'[/meta]</b>&nbsp;">'.$rx['titulo_campo'].'</option>'; 
																}
																	 


																	echo $path;
													echo "		</optgroup>
															</select>";
												}
							            	?>

								            </div>
								        </div>
							            <div  class="container_editor">
							            	<div id="editor" name="editor" class="text_notas scrollable"><?= $content ?></div>
								        </div>
							            <textarea style="display:none" class="text_notas marginbottom_2 scrollable" name='descripcion' id='descripcion' maxlength='' placeholder="Escribe tu nota aquí..."><?= $content ?></textarea>
							        </div>
							    </div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
    	<div class="clear"></div>
	</div>
</div>
<script>

    function view_plantilla(id, cn){
        window.location.href="<?= HOMEDIR.DS.'dependencias/views_minutas/'?>"+id+"/"+cn+"/";
    }


    $(document).ready(function() {

		var pos = $("#menu_tab").offset().top - 120;
        $('#content').animate({ scrollTop : pos }, 'slow');

        capa = $("#bloq_editor");
        $("#content").scroll(function () {
          var elt = $("#buttons");    
          //Bt = window.name = window.pageYOffset;
          var p = $( "#bloq_editor" );
          var position = p.position();
          Bt = position.top ;
          if (Bt < 0){
            elt.addClass("pointed");
            elt.css("position","fixed");
            elt.css("width", $("#bloq_editor").width()+"px");
            elt.css("top","70px");
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
            select = $(this);
            select.val($('option:first', select).val());

        });
    });
</script>


</div>