<?
	if ($_SESSION['otras_herramientas'] == "0") {
		header("LOCATION: ".HOMEDIR.trim(" /dashboard/"));
	}
	global $c;
?>
<script type="text/javascript">
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip(); 
        $('[data-toggle="popover"]').popover()
    });
</script>
<div data-example-id="togglable-tabs" class="bs-example bs-example-tabs">
    <ul role="tablist" class="nav nav-tabs" id="myTabs">
		<li class="title-gest active" id="oa" onclick="select_gest('natu-per',this)">
			<a href="#home6" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="false">
			Origen de los Expediente
			</a>
		</li>
		<li class="title-gest" id="oc" onclick="select_gest('fuentes-per',this)">
			<a href="#home6" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="false">
			Fuentes
			</a>
			</li> 
		<li class="title-gest" id="oe" onclick="select_gest('email-per',this)">
			<a href="#home6" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="false">
			Plantillas del Sistema
			</a>
		</li>
		<li class="title-gest" id="kw" onclick="select_gest('keywords',this)">
			<a href="#home6" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="false">
			Palabras Claves
			</a>
		</li>
		<li class="title-gest" id="of" onclick="select_gest('version-trd',this)">
			<a href="#home6" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="false">
			Versiones TRD
			</a>
		</li>
		<li class="title-gest" id="og" onclick="select_gest('transferencias',this)">
			<a href="#home6" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="false">
			 Transferencias
			</a>
			</li>
		<li class="title-gest" id="oh" onclick="select_gest('config-per',this)">
			<a href="#home6" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="false">
			Configuraciones
			</a>
		</li>
        <li class="dropdown" role="presentation"> 
        	<a aria-controls="myTabDrop1-contents" data-toggle="dropdown" class="dropdown-toggle" id="myTabDrop1" href="#" aria-expanded="false">Más <span class="caret"></span></a>
            <ul id="myTabDrop1-contents" aria-labelledby="myTabDrop1" class="dropdown-menu pull-right">
				<li id="oi" onclick="select_gest('sdk-per',this)">
					<a href="#home6" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="false">
					<span class="fa fa-cogs"></span> SDK
					</a>
				</li>
            	<?
                    $permisos = $_SESSION['vector'][2];
                    if ($permisos[0] == "") {
                        echo '<li><a href="#" class="link-blanco">No hay modulos extras Implementados</a></li>';
                    }else{
                        for ($k=0; $k < count($permisos) ; $k++) { 
                        	$link = explode(":", $permisos[$k])	;
                        	if ($link[0] != "") {
                                echo '<li>
                                        <a href="/'.$link[1].'/" target="_blank">
                                            <span class="fa '.$link[2].'"></span>
                                            '.$link[0].'
                                        </a>
                                    </li>';
                        	}
                        }
                    }
                    if ($_SESSION['MODULES']['metadatos'] == "1") {
                    	echo '<li>
                                        <a href="/metadatos/"  target="_blank">
                                            <span class="fa fa-sliders"></span>
                                            Metadatos
                                        </a>
                                    </li>';
                    }
                ?>
            </ul>
        </li>
    </ul>
</div>
<div class="row">
	<div class="col-md-12 m-t-10">
	<div class="item-herr proce-herr">
		<div class="item-content">
			<div id="gestiones">
				<div class="item-gest natu-per">
					<div id="list_nat" class="item-content-gest">
					    <div id="gestion-actuaciones" class="row" >
					        <div id="editararea" class="col-md-12">
								<?
									echo "	<div id='insertdependenciafirst'>";
									echo '		<div class="row">
													<div class="col-md-4">';
									include(VIEWS.DS."estados_gestion".DS."FormInsertEstados_gestion.php");
									echo "			</div>
												</div>
											</div>
											<hr>
										<div id='listadodependencias'>";
									#echo VIEWS.DS."seccional_principal".DS."Listar.php";
									$areas = new MEstados_gestion;
									// DE NO RECIBIR PARAMETROS ESTA FUNCION TRAE EL LISTADO COMPLETO DE LIBROS
									$query = $areas->ListarEstados_gestion("WHERE dependencia = '0'");	    
									echo '<h2>Listado de Origen de los Expedientes</h2>';
									include(VIEWS.DS."estados_gestion".DS."Listar.php");
									echo "</div>";
								?>	
							</div>
						</div>
					</div>
				</div>
				<div class="item-gest fuentes-per" style="display:none">
					<div id="list_nat" class="item-content-gest">
						<div id="formsubsrs" class="left-table">
							<h2>Instalar una fuente  <?= $c->Ayuda('208') ?></h2>
						    <?
						    	include(VIEWS.DS."fuentes/FormInsertFuentes.php");
						    ?>
						    <div class="clear"></div>	
						    <h2>Listado de Fuentes Instaladas <?= $c->Ayuda('209') ?></h2>
						    <?	
						    	$o = new MFuentes;
						    	$query = $o->ListarFuentes();
								include(VIEWS.DS."fuentes/Listar.php");
						    ?>
						</div>
					</div>
				</div>
				<div class="item-gest dian-per" style="display:none">
					<div id="list_nat" class="item-content-gest">
						<div id="formsubsrs" class="left-table">
							<div class="title right">Configurar datos de Facturación Dian</div>
						    <?
						    	 		// INVOCAMOS UN NUEVO OBJETO
							 	$object = new MDian_facturacion;
								// LO CREAMOS 			
								$object->CreateDian_facturacion('id', "1");
						    	include(VIEWS.DS."dian_facturacion/FormUpdateDian_facturacion.php");
						    ?>
						    <div class="clear"></div>	
						</div>
					</div>
				</div>
				<div class="item-gest sdk-per" style="display:none">
					<div id="list_nat" class="item-content-gest">
						<div class="row">
							<div class="col-md-4">
						        <div id="mainNav">
						        	<h3>Configuración de Servicios Web <?= $c->Ayuda('244') ?></h3>
						           	<ul id="navlist" class="nav nav-pills nav-stacked">
										<li role="presentation"  <?= $c->Ayuda('245', 'tog') ?> id='listkeys' onClick="LoadWsCofig('/ws_keys/listar/', 'listkeys')"><a href="#"><span class="fa fa-lock"></span> Keys Para Servicios Web</a></li>
										<!--<li role="presentation" id='listservices' onClick="LoadWsCofig('/ws_keys/listar/', 'listservices')"><a href="#"><span class="fa fa-code"></span> Servicios Disponibles</a></li>-->
									</ul>
						        </div>
							</div>
							<div class="col-md-8">
								<div class="col-md-12" id="loaderconfigService">
										<script type="text/javascript">
											LoadWsCofig('/ws_keys/listar/', 'listkeys')
										</script>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="item-gest email-per" style="display:none">
					<div id="list_nat" class="item-content-gest">
						<div class="row">
							<div class="col-md-12">
							    <h2>Configuración Plantillas del Sistema  <?= $c->Ayuda('214') ?></h2>
							</div>
							<div class="col-md-4">
								<div class="navbar navbar-default" style="background:#FFF;">
							        <div id="mainNav">

									<style>
										#mytabx.nav>li>a {
										    padding: 10px 15px !important;
										}
									</style>
									  <!-- Nav tabs -->
									  	<ul class="nav nav-tabs" role="tablist" id="mytabx">
										    <li <?= $c->Ayuda('211', 'tog') ?> role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">E-mails</a></li>
										    <li <?= $c->Ayuda('212', 'tog') ?> role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Msj. del Sistema</a></li>
									  	</ul>
										<div class="tab-content">
										    <div role="tabpanel" class="tab-pane active" id="home">
												<div id="navlist2" class="list-group">
												<?php
													$MPlantillas_email = new MPlantillas_email;
													$queryp = $MPlantillas_email->ListarPlantillas_email("WHERE tipo_plantilla = '0'","order by nombre");
													while ($rowp = $con->FetchAssoc($queryp)) {
														echo '<a href="#" class="list-group-item" id="'.$rowp['id'].'" onClick="LoadWsCofig2(\'/plantillas_email/editar/'.$rowp['id'].'/\', \''.$rowp['id'].'\')"><span class="fa fa-envelope"></span> '.$rowp['nombre'].'</a>';
														#echo '<li role="presentation" ><class="taga"></a></li>';
													}										           			
												?>
												</div>
										    </div>
										    <div role="tabpanel" class="tab-pane" id="profile">
										    	<div id="navlist2" class="list-group">    		
												<?php
													$MPlantillas_email = new MPlantillas_email;
													$queryp = $MPlantillas_email->ListarPlantillas_email("WHERE tipo_plantilla = '1'","order by nombre");
													while ($rowp = $con->FetchAssoc($queryp)) {
														echo '<a href="#" class="list-group-item" id="'.$rowp['id'].'" onClick="LoadWsCofig2(\'/plantillas_email/editar/'.$rowp['id'].'/\', \''.$rowp['id'].'\')"><span class="fa fa-envelope"></span> '.$rowp['nombre'].'</a>';
														#echo '<li role="presentation" ><class="taga"></a></li>';
													}										           			
												?>
										    	</div>
										    </div>
										    <div role="tabpanel" class="tab-pane" id="messages">
										    	<div id="navlist2" class="list-group">    		
												<?php
													$MPlantillas_email = new MPlantillas_email;
													$queryp = $MPlantillas_email->ListarPlantillas_email("WHERE tipo_plantilla = '2'","order by nombre");
													while ($rowp = $con->FetchAssoc($queryp)) {
														echo '<a href="#" class="list-group-item" id="'.$rowp['id'].'" onClick="LoadWsCofig2(\'/plantillas_email/editar/'.$rowp['id'].'/\', \''.$rowp['id'].'\')"><span class="fa fa-envelope"></span> '.$rowp['nombre'].'</a>';
														#echo '<li role="presentation" ><class="taga"></a></li>';
													}										           			
												?>
												</div>
										    </div>
										</div>
									</div>
								</div>
							</div>
							<style type="text/css">
								a.taga{
									background: #f5f5f5 !important;
									border-radius: 4px !important;
									padding: 5px 15px !important;
				
								}
								a.taga:hover{
									color:#FFF !important;
								}
								div.container_editor2 {
								    padding: 10px 15px !important;
								}
								#mytabx li.active, #mytabx  a.active {
									color: #337ab7 !important;
								    background-color: #FFF !important;
								}
							</style>
							<div class="col-md-8">
								<div class="col-md-12" id="loaderconfigService2">
										<!--<script type="text/javascript">
											LoadWsCofig('/ws_keys/listar/', 'listkeys')
										</script>-->
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="item-gest keywords" style="display:none">
					<div id="list_nat" class="item-content-gest">
						<div class="row">
							<div class="col-md-12">
							    <h2>Configurar Palabras Claves del Sistema  <?= $c->Ayuda('345') ?></h2>
								<div class="vtabs">
	                                <ul class="nav tabs-vertical">
	                                    <li class="tab active">
	                                        <a aria-expanded="true" data-toggle="tab" href="#vihome3"> 
	                                        	<span><i class="ti-home"></i> Campos T</span>
	                                        </a>
	                                    </li>
	                                    <li class="tab">
	                                        <a aria-expanded="false" data-toggle="tab" href="#viprofile3"> 
	                                        	<span><i class="ti-user"></i> Palabras Reservadas</span>
	                                        </a>
	                                    </li>
	                                    <li class="tab">
	                                        <a aria-expanded="false" data-toggle="tab" href="#vimessages3"> 
	                                        	<span><i class="ti-email"></i> Campos no Obligatorios</span>
	                                        </a>
	                                    </li>
	                                    <li class="tab ">
	                                        <a aria-expanded="false" data-toggle="tab" href="#vimessages4"> 
	                                        	<span><i class="mdi mdi-av-timer"></i> Inicio</span>
	                                        </a>
	                                    </li>
	                                    <?php if ($_SESSION['tech_support'] == '1'): ?>
	                                   	<li class="tab ">
	                                        <a aria-expanded="false" data-toggle="tab" href="#vimessages5"> 
	                                        	<span><i class="mdi mdi-coin"></i> Valores de Negocios</span>
	                                        </a>
	                                    </li>
	                                    <li class="tab ">
	                                        <a aria-expanded="false" data-toggle="tab" href="#vimessages6"> 
	                                        	<span><i class="mdi mdi-email"></i> Configuración SMTP</span>
	                                        </a>
	                                    </li>
	                                    <li class="tab ">
	                                        <a aria-expanded="false" data-toggle="tab" href="#vimessages7"> 
	                                        	<span><i class="mdi mdi-settings"></i> Configuraciónes de Applicacion</span>
	                                        </a>
	                                    </li>
	                                    <li class="tab ">
	                                        <a aria-expanded="false" data-toggle="tab" href="#vimessages8"> 
	                                        	<span><i class="mdi mdi-close"></i> Variables Obsoletas</span>
	                                        </a>
	                                    </li>
	                                    <?php endif ?>
	                                </ul>
	                                <div class="tab-content">
	                                    <div id="vihome3" class="tab-pane active">
	                                        <table class="table table-striped">
	                                        	<tr>
	                                        		<th style="width: 200px">P. Clave</th>
	                                        		<th style="width: 50px"><?= $c->Ayuda('346') ?></th>
	                                        		<th style="width: 200px">Término</th>
	                                        		<th style="width: 100px">Keyword</th>
	                                        		<th style="width: 100px">Mostrar</th>
	                                        		<th style="width: 50px">OP</th>
	                                        	</tr>
	                                        	<?
	                                        		$k = new MKeywords;
	                                        		$query = $k->ListarKeywords("WHERE tipo = '3'");
	                                        		while ($row = $con->FetchAssoc($query)) {
	                                        			$kw = new MKeywords;
	                                        			$kw->CreateKeywords("id", $row['id']);
	                                        			include(VIEWS.DS.'keywords/FormUpdateKeywords.php');
	                                        		}
	                                        	?>
	                                        </table>
	                                    </div>
	                                    <div id="viprofile3" class="tab-pane">
	                                        <table class="table table-striped">
	                                        	<tr>
	                                        		<th style="width: 200px">P. Clave</th>
	                                        		<th style="width: 50px"><?= $c->Ayuda('346') ?></th>
	                                        		<th style="width: 200px">Término</th>
	                                        		<th style="width: 100px">Keyword</th>
	                                        		<th style="width: 100px">Mostrar</th>
	                                        		<th style="width: 50px">OP</th>
	                                        	</tr>
	                                        	<?
	                                        		$k = new MKeywords;
	                                        		$query = $k->ListarKeywords("WHERE tipo = '2'");
	                                        		while ($row = $con->FetchAssoc($query)) {
	                                        			$kw = new MKeywords;
	                                        			$kw->CreateKeywords("id", $row['id']);
	                                        			include(VIEWS.DS.'keywords/FormUpdateKeywords.php');
	                                        		}
	                                        	?>
	                                        </table>
	                                    </div>
	                                    <div id="vimessages3" class="tab-pane">
	                                        <table class="table table-striped">
	                                        	<tr>
	                                        		<th style="width: 200px">P. Clave</th>
	                                        		<th style="width: 50px"><?= $c->Ayuda('346') ?></th>
	                                        		<th style="width: 200px">Término</th>
	                                        		<th style="width: 100px">Keyword</th>
	                                        		<th style="width: 100px">Mostrar</th>
	                                        		<th style="width: 50px">OP</th>
	                                        	</tr>
	                                        	<?
	                                        		$k = new MKeywords;
	                                        		$query = $k->ListarKeywords("WHERE tipo = '1'");
	                                        		while ($row = $con->FetchAssoc($query)) {
	                                        			$kw = new MKeywords;
	                                        			$kw->CreateKeywords("id", $row['id']);
	                                        			include(VIEWS.DS.'keywords/FormUpdateKeywords.php');
	                                        		}
	                                        	?>
	                                        </table>
	                                    </div>
	                                    <div id="vimessages4" class="tab-pane">
	                                        <table class="table table-striped">
	                                        	<tr>
	                                        		<th style="width: 200px">P. Clave</th>
	                                        		<th style="width: 50px"><?= $c->Ayuda('346') ?></th>
	                                        		<th style="width: 200px">Término</th>
	                                        		<th style="width: 100px">Keyword</th>
	                                        		<th style="width: 100px">Mostrar</th>
	                                        		<th style="width: 50px">OP</th>
	                                        	</tr>
	                                        	<?
	                                        		$k = new MKeywords;
	                                        		$query = $k->ListarKeywords("WHERE tipo = '4'");
	                                        		while ($row = $con->FetchAssoc($query)) {
	                                        			$kw = new MKeywords;
	                                        			$kw->CreateKeywords("id", $row['id']);
	                                        			include(VIEWS.DS.'keywords/FormUpdateKeywords.php');
	                                        		}
	                                        	?>
	                                        </table>
	                                    </div>
	                                    <?php if ($_SESSION['tech_support'] == '1'): ?>
	                                    <div id="vimessages5" class="tab-pane">
	                                        <table class="table table-striped">
	                                        	<tr>
	                                        		<th style="width: 200px">P. Clave</th>
	                                        		<th style="width: 50px"><?= $c->Ayuda('346') ?></th>
	                                        		<th style="width: 200px">Término</th>
	                                        		<th style="width: 100px">Keyword</th>
	                                        		<th style="width: 100px">Mostrar</th>
	                                        		<th style="width: 50px">OP</th>
	                                        	</tr>
	                                        	<?
	                                        		$k = new MKeywords;
	                                        		$query = $k->ListarKeywords("WHERE tipo = '5'");
	                                        		while ($row = $con->FetchAssoc($query)) {
	                                        			$kw = new MKeywords;
	                                        			$kw->CreateKeywords("id", $row['id']);
	                                        			include(VIEWS.DS.'keywords/FormUpdateKeywords.php');
	                                        		}
	                                        	?>
	                                        	<tr>
	                                        		<td colspan="6">
	                                        			<h4>Logo del Courrier de Correos Electrónicos  <?= $c->Ayuda('242') ?></h4>	
														<div class="photo_encabezado">
														<?
														    $object = new MSuper_admin;
														    $object->CreateSuper_admin("id", "6");

													    	$logo_courrier = ROOT.DS.'plugins/thumbnails/'.$object->Getlogo_courrier();
													    	$exists = file_exists( $logo_courrier );
													    	if ($object->Getlogo_courrier() == "") {
													    		$logo_courrier = HOMEDIR.DS.'app/plugins/thumbnails/b278ee6bae30d6b7f62cf4ebb3d9ce.png';
													    	}else{
													    		$logo_courrier = HOMEDIR.DS.'app/plugins/thumbnails/'.$object->Getlogo_courrier();
													    	}
													    #	echo $logo_courrier;
														?>
															<img id="ppic_logo_courrier"  class="imtochange" src="<?= $logo_courrier  ?>" alt="" style="width:140px; height: 40px; cursor: pointer">
															<form action="<?= HOMEDIR; ?>/super_admin/upload/r/logo_courrier/" id="formpicturelogo_courrier" method="post" enctype="multipart/form-data">
														        <div style="display:none">
															        <input name="archivo" id="selfile_logo_courrier" type="file" size="35"/>
														        </div>
													      	</form>
														</div>
														<div class="leyenda">
															Se recomienda que la imagen esté en formato .png o .jpg y maneje una resolución
																no mayor y proporcional a 140 x 40 pixeles
														</div>
														<script>
															$("#ppic_logo_courrier").click(function() {
																$("#selfile_logo_courrier").click();
															});

															$("#selfile_logo_courrier").change(function() {
																$("#formpicturelogo_courrier").submit();
															});
														</script>


	                                        		</td>
	                                        	</tr>
	                                        </table>
	                                    </div>
	                                    <div id="vimessages6" class="tab-pane">
	                                        <table class="table table-striped">
	                                        	<tr>
	                                        		<th style="width: 200px">P. Clave</th>
	                                        		<th style="width: 50px"><?= $c->Ayuda('346') ?></th>
	                                        		<th style="width: 200px">Término</th>
	                                        		<th style="width: 100px">Keyword</th>
	                                        		<th style="width: 100px">Mostrar</th>
	                                        		<th style="width: 50px">OP</th>
	                                        	</tr>
	                                        	<?
	                                        		$k = new MKeywords;
	                                        		$query = $k->ListarKeywords("WHERE tipo = '6'");
	                                        		while ($row = $con->FetchAssoc($query)) {
	                                        			$kw = new MKeywords;
	                                        			$kw->CreateKeywords("id", $row['id']);
	                                        			include(VIEWS.DS.'keywords/FormUpdateKeywords.php');
	                                        		}
	                                        	?>
	                                        </table>
	                                    </div>
	                                    <div id="vimessages7" class="tab-pane">
	                                        <table class="table table-striped">
	                                        	<tr>
	                                        		<th style="width: 200px">P. Clave</th>
	                                        		<th style="width: 50px"><?= $c->Ayuda('346') ?></th>
	                                        		<th style="width: 200px">Término</th>
	                                        		<th style="width: 100px">Keyword</th>
	                                        		<th style="width: 100px">Mostrar</th>
	                                        		<th style="width: 50px">OP</th>
	                                        	</tr>
	                                        	<?
	                                        		$k = new MKeywords;
	                                        		$query = $k->ListarKeywords("WHERE tipo = '7'");
	                                        		while ($row = $con->FetchAssoc($query)) {
	                                        			$kw = new MKeywords;
	                                        			$kw->CreateKeywords("id", $row['id']);
	                                        			include(VIEWS.DS.'keywords/FormUpdateKeywords.php');
	                                        		}
	                                        	?>
	                                        </table>
	                                    </div>
	                                    <div id="vimessages8" class="tab-pane">
	                                        <table class="table table-striped">
	                                        	<tr>
	                                        		<th style="width: 200px">P. Clave</th>
	                                        		<th style="width: 50px"><?= $c->Ayuda('346') ?></th>
	                                        		<th style="width: 200px">Término</th>
	                                        		<th style="width: 100px">Keyword</th>
	                                        		<th style="width: 100px">Mostrar</th>
	                                        		<th style="width: 50px">OP</th>
	                                        	</tr>
	                                        	<?
	                                        		$k = new MKeywords;
	                                        		$query = $k->ListarKeywords("WHERE tipo = '8'");
	                                        		while ($row = $con->FetchAssoc($query)) {
	                                        			$kw = new MKeywords;
	                                        			$kw->CreateKeywords("id", $row['id']);
	                                        			include(VIEWS.DS.'keywords/FormUpdateKeywords.php');
	                                        		}
	                                        	?>
	                                        </table>
	                                    </div>
	                                    <?php endif ?>
	                                </div>
	                                <script>
										function EditarKeywords(id){
											var URL = '/keywords/actualizar/';
											var str = $("#"+id).serialize();
											$.ajax({
												type: 'POST',
												url: URL,
												data: str,
												success: function(msg){
													Alert2(msg);
												}
											});
										}	
									</script>		

	                            </div>
							</div>
						</div>
					</div>
				</div>
				<div class="item-gest transferencias" style="display:none">
					<div id="list_nat" class="item-content-gest">
						<div class="row">
							<div class="col-md-12">
						        <h2>Transferencias o Compartir Expedientes <?= $c->Ayuda('217') ?></h2>
							</div>
							<div class="col-md-4">
						        <div id="mainNav">
						        	<div id="navlist3" class="list-group">
						           		<a href="#" class="list-group-item" id="transferenciacompartir" onClick="LoadWsCofig3('/herramientas/CompartirExpedientesUsuarios/0/','transferenciacompartir')"><span class="fa fa-share-alt"></span> Compartir <?= $c->Ayuda('218') ?></a>
						           		<a href="#" class="list-group-item" id="transferenciacompartir2" onClick="LoadWsCofig3('/herramientas/TransferirExpedientesUsuarios/0/','transferenciacompartir2')"><span class="fa fa-share-alt"></span> Transferir  <?= $c->Ayuda('219') ?></a>
									</div>
						        </div>
							</div>
							<div class="col-md-8">
								<div class="col-md-12" id="loaderconfigService3">
										<script type="text/javascript">
											LoadWsCofig3('/herramientas/CompartirExpedientesUsuarios/0/','transferenciacompartir');
										</script>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="item-gest version-trd"  style="display:none">
					<div id="list_nat" class="item-content-gest">
						<div class="row">
							<div class="col-md-12">
								<h2>Crear Version de la Tabla de Retención Documental <?= $c->Ayuda("215") ?></h2>
							</div>
						    <div id="gestion-actuaciones" class="col-md-6">
						        <div id="editararea">
									<?
										echo "<div id='insertdependenciafirst'>";
										include(VIEWS.DS."dependencias_version".DS."FormInsertDependencias_version.php");
										echo "</div>
											<div id='listadodependencias'>";
											$MDependencias_version = new MDependencias_version;
								           	$query = $MDependencias_version->ListarDependencias_version();
										include(VIEWS.DS."dependencias_version".DS."Listar.php");
										echo "</div>";
									?>	
								</div>
							</div>
							<div id="gestion-actuaciones" class="AbrirVersion col-md-6"></div>
						</div>
					</div>
				</div>
				<div class="item-gest config-per" style="display:none">
					<div id="list_nat" class="item-content-gest">
						<div class="row">
							<?
							include(VIEWS.DS."herramientas".DS."configuraciones.php");
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	</div>
</div>
<script>
	open('<?= $_REQUEST['id'] ?>')
	function open(id){
		//alert(id);
		$("#"+id).click();
	}
	function select_gest(item,div){
		$('.title-gest').removeClass('active');
		$(div).addClass('active');
		$('.item-gest:not(.'+item+')').hide(500);
		$('.item-gest.'+item).show(500);
	}
</script>