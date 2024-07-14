<?
	global $c;
	$totalc = $c->GetTotalFromTable("seccional_principal", "");
	$totalof = $c->GetTotalFromTable("seccional", "");
	if ($_SESSION['recepcion'] == "0") {
		header("LOCATION: ".HOMEDIR.trim(" /dashboard/"));
	}
?>
<div class="row m-t-30">
    <div class="col-md-12">
    	<div class="panel panel-themecolor">
	        <div class="panel-heading">Crear un nuevo Expediente / Unidad Documental</div>
	        <div class="panel-wrapper collapse in" aria-expanded="true">
	            <div class="panel-body">
					<form id='formgestion' action='/gestion/registrar/' method='POST' class='form-horizontal'> 
						<div class="form-body">
                            <h2 class="box-title <?= M_INFORMACION_GENERAL ?>"><?= INFORMACION_GENERAL ?></h2>
						    
						    <hr class="m-t-0 m-b-20">
						    <div class="row">
						        <div class="col-md-12">
						            <div class="form-group">
						                <label class="control-label col-md-1"><?= ASUNTO ?> </label>
						                <div class="col-md-11">
						                    <textarea class="form-control important" type='text' name='observacion' id='observacion' placeholder="Asunto" style="height:50px" <?= $c->Ayuda('33', 'tog') ?>></textarea>
						                </div>
						            </div>
						        </div>
						    </div>
							   <h2 class="box-title m-t-30 <?= M_INFORMACION_SUSCRIPTOR ?>"><?= INFORMACION_SUSCRIPTOR ?></h2>
						    
						    <hr class="m-t-0 m-b-20">
						    <div class="row ">
						        <div class="col-md-3 <?= M_TIPO_DOCUMENTO ?>">
						            <div class="form-group">
						                <label class="control-label"><?= TIPO_DOCUMENTO ?>:</label>
						                <select  name="documento_salida" id="documento_salida" class=' form-control important' <?= $c->Ayuda('34', 'tog') ?>>
											<option value="N">Selecciona una Opción</option>
											<option value="N">Documento de Entrada</option>
											<option value="S">Documento de Salida</option>
											<option value="C">Comunicaciones Internas</option>
											<option value="A">Archivo Central</option>
										</select>
									</div>
						        </div>
						        <!--/span-->
						        <div class="col-md-9">
						            <div class="form-group">
						                <label class="control-label">Información <?= SUSCRIPTORCAMPONOMBRE; ?></label>
						                <input type="text" id="dtform" name="dtform" placeholder='Nombre o <?= SUSCRIPTORCAMPOIDENTIFICACION; ?> del <?= SUSCRIPTORCAMPONOMBRE; ?>' class='form-control important'  <?= $c->Ayuda('35', 'tog') ?>>
										<div id='bloquebusqueda'></div>           
										<input type="hidden"  name="suscriptor_id" id="suscriptor_id" value="N">
									</div>
						        </div>
						        <!--<div class="col-md-3 p-t-30">
									<label for="notifsuscriptoremail">
										<input type="checkbox" id="notifsuscriptoremail" name="notifsuscriptoremail" value="S" class="m-r-10"  <?= $c->Ayuda('36', 'tog') ?>>Informar al Suscriptor del las actuaciones de este expediente
									</label>
								</div>-->
						        <!--/span-->
						    </div>
							<div class="row m-t-10">
								<div class="col-md-2 hideform">
									<input class="form-control" type="text" placeholder="<?= SUSCRIPTORCAMPOIDENTIFICACION; ?>" id="Identificacion_suscriptor" name="Identificacion_suscriptor">
								</div>
								<div class="col-md-2 hideform">
									<select class="form-control"  placeholder="Tipo de Suscriptor"  name="Type_suscriptor22" id="Type_suscriptor22">
										<option value="">Tipo de <?= SUSCRIPTORCAMPONOMBRE; ?></option>
										<?
											$lx = new MSuscriptores_tipos;
											$query_eg = $lx->ListarSuscriptores_tipos(); 
											while($row_type = $con->FetchAssoc($query_eg)){
												echo "<option value='".$row_type['id']."'>".$row_type['nombre']."</option>";
											}
										?>
										<option value="OTRO">OTRO</option>
									</select>
									<input class="form-control" type="hidden" id="Type_suscriptor2" name="Type_suscriptor2">
									<div id='bloquebusquedasuscriptor'></div>   
									<input type="text" class="" style="display:none" name="Type_suscriptor" id="Type_suscriptor" value="">
								</div>
								<div class="col-md-2 hideform">
									<input class="form-control" type="text" placeholder="<?= SUSCRIPTORCAMPODIRECCION; ?>" id="Direccion_suscriptor" name="Direccion_suscriptor">
								</div>
								<div class="col-md-2 hideform">
									<input class="form-control" type="text" placeholder="Ciudad" id="Ciudad_suscriptor" name="Ciudad_suscriptor">
								</div>
								<div class="col-md-2 hideform">
									<input class="form-control" type="text" placeholder="Telefonos" id="Telefonos_suscriptor" name="Telefonos_suscriptor">
								</div>
								<div class="col-md-2 hideform">
									<input class="form-control" type="text" placeholder="E-mail" id="Email_suscriptor" name="Email_suscriptor">
								</div>
							</div>
						    <!--/row-->
						    <?php if (M_DESTINO_DOCUMENTO == "1"): ?>    
								<h2 class="box-title m-t-30"><?= DESTINO_DOCUMENTO ?></h2>
                        	<?php endif ?>
						    <hr class="m-t-0 m-b-20">
							<div class="row m-t-30">
								<div class="col-md-6">
									<label for="departamento"><?= DEPARTAMENTO ?>:</label>
									<select name="departamento" id="departamento" class='form-control important disabled' disabled="disabled" <?= $c->Ayuda('37', 'tog') ?>>
										<option value="">Seleccione un Departamento</option>
									</select>
								</div>
								<div class="col-md-6">
									<label for="ciudad"><?= CIUDAD ?>:</label>
									<select name="ciudad" id="ciudad" class=' form-control important disabled' disabled="disabled" <?= $c->Ayuda('38', 'tog') ?>>
										<option value="">Seleccione una Ciudad</option>
									</select>
								</div>
							</div>
							<div class="row m-t-30">
								<div class="col-md-6">
									<label for="oficina"><?= OFICINA ?>:</label>
									<select name="oficina" id="oficina" class=' form-control important disabled' disabled="disabled"<?= $c->Ayuda('39', 'tog') ?>>
										<option value="">Seleccione una Oficina</option>
									</select>
								</div>
								<div class="col-md-6">
									<label for="dependencia_destino"><?= CAMPOAREADETRABAJO; ?></label>
									<select placeholder="<?= CAMPOAREADETRABAJO; ?>"  name="dependencia_destino" id="dependencia_destino" class=' form-control important disabled' disabled="disabled" <?= $c->Ayuda('40', 'tog') ?> >
										<option value="">Seleccione un <?= CAMPOAREADETRABAJO; ?></option>
									</select>
									<input class="form-control" type='text' name='areatemp' id='areatemp' style="display:none" />
								</div>
							</div>
							<div class="row m-t-30">
								<div class="col-md-6">
									<label for="nombre_destino"><?= RESPONSABLE ?></label>
									<select disabled="disabled" name="nombre_destino" id="nombre_destino" class='form-control important disabled' <?= $c->Ayuda('41', 'tog') ?>>
										<option value="">Seleccione un Usuario de Destino</option>
									</select>
								</div>
								<div class="col-md-6">
									<div class="col-md-6">
										<label for="nombre_destino_compartir_con">¿Compartir?</label>
										<select  disabled="disabled" name="nombre_destino_compartir_con" id="nombre_destino_compartir_con" class='form-control disabled' onchange="fnNombreDestinoCompartirCon();" <?= $c->Ayuda('42', 'tog') ?>>
											<option value="">Compartir con:</option>
											<option value="1">Todos los <?= RESPONSABLE ?>(S) del <?= CAMPOAREADETRABAJO; ?></option>
											<option value="2">Todos los <?= RESPONSABLE ?>(S) del <?= CAMPOENTIDAD ?></option>
											<option value="3">Agregar otro <?= RESPONSABLE ?></option>
											<option value="4">No compartir con Ninguno</option>
										</select>
										<div  id="seleccion_compartir_con2" style="max-height: 100px; overflow: auto; width: 350px;"></div>
										<div  id="seleccion_compartir_con"></div>							
										<input type="hidden"  name="cantidadusuariosagregados" id="cantidadusuariosagregados" value="0">
									</div>
									<div class="col-md-6">
										<label>
											<input type="radio" name="losusuariospuedenalcompartir" value="0" class="m-r-10" checked <?= $c->Ayuda('52', 'tog') ?>>
											Compartir Para Consulta
										</label>
										<label>
											<input type="radio" name="losusuariospuedenalcompartir" value="1" class="m-r-10" <?= $c->Ayuda('53', 'tog') ?>>
											Compartir con Interacción
										</label>
										<label for="informerporemail">
											<input type="checkbox" id="informerporemail" name="informerporemail" checked value="S"  class="m-r-10" <?= $c->Ayuda('54', 'tog') ?>>Informar a los usuarios por email
										</label>
									</div>
								</div>
							</div>
							<div class="row m-t-30">
								<div class="col-md-6">
									<label for="id_dependencia_raiz"><?= SERIE ?></label>
									<select class="form-control important disabled" id="id_dependencia_raiz" name="id_dependencia_raiz"  disabled="disabled" <?= $c->Ayuda('43', 'tog') ?>>
										<option value="">Seleccione una Serie</option>
										<?
											$s = new MDependencias;
											$q = $s->ListarDependencias(" where dependencia = '0' and id_version = '".$_SESSION['id_trd_empresa']."'");
											while ($row = $con->FetchAssoc($q)) {
												echo "<option value='".$row['id']."'> ".$row['nombre']."</option>";
											}
										?>
									</select>
								</div>
								<div class="col-md-6">
									<label for="tipo_documento"><?= SUB_SERIE ?></label>
									<select class="form-control important disabled" id="tipo_documento" name="tipo_documento" disabled="disabled" <?= $c->Ayuda('44', 'tog') ?>>
										<option value="">Seleccione una Sub-Serie</option>
									</select>
								</div>
							</div>
							<div class="row m-t-30">
								<div class="col-md-12">
									<div id="listadotipologiassubserie"></div>
								</div>
							</div>
							<?php if (M_INFORMACION_ADICIONAL == "1"): ?>    
								<h2 class="box-title m-t-30"><?= INFORMACION_ADICIONAL ?></h2>
                        	<?php endif ?>
						    <hr class="m-t-0 m-b-20">
							<div class="row m-t-30">
								<div class="col-md-6">
									<label for="num_oficio_respuesta"><?= CAMPOIDRAD ?></label>
									<input  class="form-control" type='text' name='num_oficio_respuesta' id='num_oficio_respuesta' placeholder="Número de Radicado Interno" maxlength='100' value="<?= date("Y-") ?>" <?= $c->Ayuda('46', 'tog') ?> />
								</div>
								<div class="col-md-6">
									<label for="radicado"><?= CAMPORADEXTERNO ?></label>
									<input class="form-control" type='text' name='radicado' id='radicado' placeholder="Ingresar Numero de Radicado (si aplica)" <?= $c->Ayuda('47', 'tog') ?>/>					
								</div>
							</div>
    						<div class="row m-t-30">
							<?php if (CAMPOT1 != ""): ?>
								<div class="col-md-6 m-b-20 <?= M_CAMPOT1 ?>">
									<label for="campot1"><?= CAMPOT1 ?></label>
									<?
										$x = $con->Query("Select * from meta_listas where titulo = '".CAMPOT1."'");
										$cont = $con->NumRows($x);
										$dat = $con->FetchAssoc($x);
										if ($cont > 0) {
									?>
											<select class="form-control select2" type='text' name='campot1' id='campot1' <?= $c->Ayuda('339', 'tog') ?> >
												<option value="">Seleccione una Opción</option>
												<?
													$x = $con->Query("select * from meta_listas_valores where id_lista = '".$dat['id']."'");
													while ($ror = $con->FetchAssoc($x)) {
														echo '<option value="'.$ror['valor'].'">'.$ror['titulo'].'</option>';
													}
												?>
											</select>
									<?
										}else{
									?>
											<input  class="form-control" type='text' name='campot1' id='campot1'  <?= $c->Ayuda('339', 'tog') ?>  />
									<?
										}
									?>
								</div>
								<?php endif ?>
								<?php if (CAMPOT2 != ""): ?>	
								<div class="col-md-6 m-b-20 <?= M_CAMPOT2 ?>">
									<label for="campot2"><?= CAMPOT2 ?></label>
									<?
										$x = $con->Query("Select * from meta_listas where titulo = '".CAMPOT2."'");
										$cont = $con->NumRows($x);
										$dat = $con->FetchAssoc($x);
										if ($cont > 0) {
									?>
											<select class="form-control select2" type='text' name='campot2' id='campot2'<?= $c->Ayuda('340', 'tog') ?> >
												<option value="">Seleccione una Opción</option>
												<?
													$x = $con->Query("select * from meta_listas_valores where id_lista = '".$dat['id']."'");
													while ($ror = $con->FetchAssoc($x)) {
														echo '<option value="'.$ror['valor'].'">'.$ror['titulo'].'</option>';
													}
												?>
											</select>
									<?
										}else{
									?>
											<input  class="form-control" type='text' name='campot2' id='campot2'  <?= $c->Ayuda('340', 'tog') ?>  />
									<?
										}
									?>
								</div>
								<?php endif ?> 
								<?php if (CAMPOT3 != ""): ?>
									<div class="col-md-6 m-b-20 <?= M_CAMPOT3 ?>">
										<label for="campot3"><?= CAMPOT3 ?></label>
										<?
											$x = $con->Query("Select * from meta_listas where titulo = '".CAMPOT3."'");
											$cont = $con->NumRows($x);
											$dat = $con->FetchAssoc($x);
											if ($cont > 0) {
										?>
												<select class="form-control select2" type='text' name='campot3' id='campot3'<?= $c->Ayuda('341', 'tog') ?> >
													<option value="">Seleccione una Opción</option>
													<?
														$x = $con->Query("select * from meta_listas_valores where id_lista = '".$dat['id']."'");
														while ($ror = $con->FetchAssoc($x)) {
															echo '<option value="'.$ror['valor'].'">'.$ror['titulo'].'</option>';
														}
													?>
												</select>
										<?
											}else{
										?>
												<input  class="form-control" type='text' name='campot3' id='campot3' <?= $c->Ayuda('341', 'tog') ?>  />
										<?
											}
										?>
									</div>
								<?php endif ?> 
								<?php if (CAMPOT4 != ""): ?>
								<div class="col-md-6 m-b-20 <?= M_CAMPOT4 ?>">
									<label for="campot4"><?= CAMPOT4 ?></label>
									<?
										#echo "Select * from meta_listas where titulo = '".CAMPOT4."'";
										$x = $con->Query("Select * from meta_listas where titulo = '".CAMPOT4."'");
										$cont = $con->NumRows($x);
										$dat = $con->FetchAssoc($x);
										if ($cont > 0) {
									?>
											<select class="form-control select2" type='text' name='campot4' id='campot4'<?= $c->Ayuda('342', 'tog') ?> >
												<option value="">Seleccione una Opción</option>
												<?
													$x = $con->Query("select * from meta_listas_valores where id_lista = '".$dat['id']."'");
													while ($ror = $con->FetchAssoc($x)) {
														echo '<option value="'.$ror['valor'].'">'.$ror['titulo'].'</option>';
													}
												?>
											</select>
									<?
										}else{
									?>
											<input  class="form-control" type='text' name='campot4' id='campot4'<?= $c->Ayuda('342', 'tog') ?>  />
									<?
										}
									?>
								</div>
								<?php endif ?> 
								<?php if (CAMPOT5 != ""): ?>
								<div class="col-md-6 m-b-20 <?= M_CAMPOT5 ?>">
									<label for="campot5"><?= CAMPOT5 ?></label>
									<?
										#echo "Select * from meta_listas where titulo = '".CAMPOT5."'";
										$x = $con->Query("Select * from meta_listas where titulo = '".CAMPOT5."'");
										$cont = $con->NumRows($x);
										$dat = $con->FetchAssoc($x);
										if ($cont > 0) {
									?>
											<select class="form-control select2" type='text' name='campot5' id='campot5'<?= $c->Ayuda('343', 'tog') ?> >
												<option value="">Seleccione una Opción</option>
												<?
													$x = $con->Query("select * from meta_listas_valores where id_lista = '".$dat['id']."'");
													while ($ror = $con->FetchAssoc($x)) {
														echo '<option value="'.$ror['valor'].'">'.$ror['titulo'].'</option>';
													}
												?>
											</select>
									<?
										}else{
									?>
											<input  class="form-control" type='text' name='campot5' id='campot5'  <?= $c->Ayuda('343', 'tog') ?>  />
									<?
										}
									?>
								</div>
								<?php endif ?>
								<?php if (CAMPOT6 != ""): ?>
								<div class="col-md-6 m-b-20 <?= M_CAMPOT6 ?>">
									<label for="campot6"><?= CAMPOT6 ?></label>
									<?
										#echo "Select * from meta_listas where titulo = '".CAMPOT6."'";
										$x = $con->Query("Select * from meta_listas where titulo = '".CAMPOT6."'");
										$cont = $con->NumRows($x);
										$dat = $con->FetchAssoc($x);
										if ($cont > 0) {
									?>
											<select class="form-control select2" type='text' name='campot6' id='campot6'<?= $c->Ayuda('344', 'tog') ?> >
												<option value="">Seleccione una Opción</option>
												<?
													$x = $con->Query("select * from meta_listas_valores where id_lista = '".$dat['id']."'");
													while ($ror = $con->FetchAssoc($x)) {
														echo '<option value="'.$ror['valor'].'">'.$ror['titulo'].'</option>';
													}
												?>
											</select>
									<?
										}else{
									?>
											<input  class="form-control" type='text' name='campot6' id='campot6'  <?= $c->Ayuda('344', 'tog') ?>  />
									<?
										}
									?>
								</div>
								<?php endif ?>
								<?php if (CAMPOT7 != ""): ?>
								<div class="col-md-6 m-b-20 <?= M_CAMPOT7 ?>">
									<label for="campot7"><?= CAMPOT7 ?></label>
									<?
										#echo "Select * from meta_listas where titulo = '".CAMPOT7."'";
										$x = $con->Query("Select * from meta_listas where titulo = '".CAMPOT7."'");
										$cont = $con->NumRows($x);
										$dat = $con->FetchAssoc($x);
										if ($cont > 0) {
									?>
											<select class="form-control select2" type='text' name='campot7' id='campot7'<?= $c->Ayuda('345', 'tog') ?> >
												<option value="">Seleccione una Opción</option>
												<?
													$x = $con->Query("select * from meta_listas_valores where id_lista = '".$dat['id']."'");
													while ($ror = $con->FetchAssoc($x)) {
														echo '<option value="'.$ror['valor'].'">'.$ror['titulo'].'</option>';
													}
												?>
											</select>
									<?
										}else{
									?>
											<input  class="form-control" type='text' name='campot7' id='campot7'  <?= $c->Ayuda('345', 'tog') ?>  />
									<?
										}
									?>
								</div>
								<?php endif ?>
								<?php if (CAMPOT8 != ""): ?>
								<div class="col-md-6 m-b-20 <?= M_CAMPOT8 ?>">
									<label for="campot8"><?= CAMPOT8 ?></label>
									<?
										#echo "Select * from meta_listas where titulo = '".CAMPOT8."'";
										$x = $con->Query("Select * from meta_listas where titulo = '".CAMPOT8."'");
										$cont = $con->NumRows($x);
										$dat = $con->FetchAssoc($x);
										if ($cont > 0) {
									?>
											<select class="form-control select2" type='text' name='campot8' id='campot8'<?= $c->Ayuda('346', 'tog') ?> >
												<option value="">Seleccione una Opción</option>
												<?
													$x = $con->Query("select * from meta_listas_valores where id_lista = '".$dat['id']."'");
													while ($ror = $con->FetchAssoc($x)) {
														echo '<option value="'.$ror['valor'].'">'.$ror['titulo'].'</option>';
													}
												?>
											</select>
									<?
										}else{
									?>
											<input  class="form-control" type='text' name='campot8' id='campot8' <?= $c->Ayuda('346', 'tog') ?>  />
									<?
										}
									?>
								</div>
								<?php endif ?>
								<?php if (CAMPOT9 != ""): ?>
								<div class="col-md-6 m-b-20 <?= M_CAMPOT9 ?>">
									<label for="campot9"><?= CAMPOT9 ?></label>
									<?
										#echo "Select * from meta_listas where titulo = '".CAMPOT9."'";
										$x = $con->Query("Select * from meta_listas where titulo = '".CAMPOT9."'");
										$cont = $con->NumRows($x);
										$dat = $con->FetchAssoc($x);
										if ($cont > 0) {
									?>
											<select class="form-control select2" type='text' name='campot9' id='campot9'<?= $c->Ayuda('347', 'tog') ?> >
												<option value="">Seleccione una Opción</option>
												<?
													$x = $con->Query("select * from meta_listas_valores where id_lista = '".$dat['id']."'");
													while ($ror = $con->FetchAssoc($x)) {
														echo '<option value="'.$ror['valor'].'">'.$ror['titulo'].'</option>';
													}
												?>
											</select>
									<?
										}else{
									?>
											<input  class="form-control" type='text' name='campot9' id='campot9'  <?= $c->Ayuda('347', 'tog') ?>  />
									<?
										}
									?>
								</div>
								<?php endif ?>
								<?php if (CAMPOT10 != ""): ?>
								<div class="col-md-6 m-b-20 <?= M_CAMPOT10 ?>">
									<label for="campot10"><?= CAMPOT10 ?></label>
									<?
										#echo "Select * from meta_listas where titulo = '".CAMPOT10."'";
										$x = $con->Query("Select * from meta_listas where titulo = '".CAMPOT10."'");
										$cont = $con->NumRows($x);
										$dat = $con->FetchAssoc($x);
										if ($cont > 0) {
									?>
											<select class="form-control select2" type='text' name='campot10' id='campot10'<?= $c->Ayuda('348', 'tog') ?> >
												<option value="">Seleccione una Opción</option>
												<?
													$x = $con->Query("select * from meta_listas_valores where id_lista = '".$dat['id']."'");
													while ($ror = $con->FetchAssoc($x)) {
														echo '<option value="'.$ror['valor'].'">'.$ror['titulo'].'</option>';
													}
												?>
											</select>
									<?
										}else{
									?>
											<input  class="form-control" type='text' name='campot10' id='campot10'  <?= $c->Ayuda('348', 'tog') ?>  />
									<?
										}
									?>
								</div>
								<?php endif ?>
								<?php if (CAMPOT11 != ""): ?>
								<div class="col-md-6 m-b-20 <?= M_CAMPOT11 ?>">
									<label for="campot11"><?= CAMPOT11 ?></label>
									<?
										#echo "Select * from meta_listas where titulo = '".CAMPOT11."'";
										$x = $con->Query("Select * from meta_listas where titulo = '".CAMPOT11."'");
										$cont = $con->NumRows($x);
										$dat = $con->FetchAssoc($x);
										if ($cont > 0) {
									?>
											<select class="form-control select2" type='text' name='campot11' id='campot11'<?= $c->Ayuda('349', 'tog') ?> >
												<option value="">Seleccione una Opción</option>
												<?
													$x = $con->Query("select * from meta_listas_valores where id_lista = '".$dat['id']."'");
													while ($ror = $con->FetchAssoc($x)) {
														echo '<option value="'.$ror['valor'].'">'.$ror['titulo'].'</option>';
													}
												?>
											</select>
									<?
										}else{
									?>
											<input  class="form-control" type='text' name='campot11' id='campot11'  <?= $c->Ayuda('349', 'tog') ?>  />
									<?
										}
									?>
								</div>
								<?php endif ?>
								<?php if (CAMPOT12 != ""): ?>
								<div class="col-md-6 m-b-20 <?= M_CAMPOT12 ?>">
									<label for="campot12"><?= CAMPOT12 ?></label>
									<?
										#echo "Select * from meta_listas where titulo = '".CAMPOT12."'";
										$x = $con->Query("Select * from meta_listas where titulo = '".CAMPOT12."'");
										$cont = $con->NumRows($x);
										$dat = $con->FetchAssoc($x);
										if ($cont > 0) {
									?>
											<select class="form-control select2" type='text' name='campot12' id='campot12'<?= $c->Ayuda('350', 'tog') ?> >
												<option value="">Seleccione una Opción</option>
												<?
													$x = $con->Query("select * from meta_listas_valores where id_lista = '".$dat['id']."'");
													while ($ror = $con->FetchAssoc($x)) {
														echo '<option value="'.$ror['valor'].'">'.$ror['titulo'].'</option>';
													}
												?>
											</select>
									<?
										}else{
									?>
											<input  class="form-control" type='text' name='campot12' id='campot12'  <?= $c->Ayuda('350', 'tog') ?>  />
									<?
										}
									?>
								</div>
								<?php endif ?>
								<?php if (CAMPOT13 != ""): ?>
								<div class="col-md-6 m-b-20 <?= M_CAMPOT13 ?>">
									<label for="campot13"><?= CAMPOT13 ?></label>
									<?
										#echo "Select * from meta_listas where titulo = '".CAMPOT13."'";
										$x = $con->Query("Select * from meta_listas where titulo = '".CAMPOT13."'");
										$cont = $con->NumRows($x);
										$dat = $con->FetchAssoc($x);
										if ($cont > 0) {
									?>
											<select class="form-control select2" type='text' name='campot13' id='campot13'<?= $c->Ayuda('351', 'tog') ?> >
												<option value="">Seleccione una Opción</option>
												<?
													$x = $con->Query("select * from meta_listas_valores where id_lista = '".$dat['id']."'");
													while ($ror = $con->FetchAssoc($x)) {
														echo '<option value="'.$ror['valor'].'">'.$ror['titulo'].'</option>';
													}
												?>
											</select>
									<?
										}else{
									?>
											<input  class="form-control" type='text' name='campot13' id='campot13'  <?= $c->Ayuda('351', 'tog') ?>  />
									<?
										}
									?>
								</div>
								<?php endif ?>
								<?php if (CAMPOT14 != ""): ?>
								<div class="col-md-6 m-b-20 <?= M_CAMPOT14 ?>">
									<label for="campot14"><?= CAMPOT14 ?></label>
									<?
										#echo "Select * from meta_listas where titulo = '".CAMPOT14."'";
										$x = $con->Query("Select * from meta_listas where titulo = '".CAMPOT14."'");
										$cont = $con->NumRows($x);
										$dat = $con->FetchAssoc($x);
										if ($cont > 0) {
									?>
											<select class="form-control select2" type='text' name='campot14' id='campot14'<?= $c->Ayuda('352', 'tog') ?> >
												<option value="">Seleccione una Opción</option>
												<?
													$x = $con->Query("select * from meta_listas_valores where id_lista = '".$dat['id']."'");
													while ($ror = $con->FetchAssoc($x)) {
														echo '<option value="'.$ror['valor'].'">'.$ror['titulo'].'</option>';
													}
												?>
											</select>
									<?
										}else{
									?>
											<input  class="form-control" type='text' name='campot14' id='campot14' <?= $c->Ayuda('352', 'tog') ?>  />
									<?
										}
									?>
								</div>
								<?php endif ?>
								<?php if (CAMPOT15 != ""): ?>
								<div class="col-md-6 m-b-20 <?= M_CAMPOT15 ?>">
									<label for="campot15"><?= CAMPOT15 ?></label>
									<?
										#echo "Select * from meta_listas where titulo = '".CAMPOT15."'";
										$x = $con->Query("Select * from meta_listas where titulo = '".CAMPOT15."'");
										$cont = $con->NumRows($x);
										$dat = $con->FetchAssoc($x);
										if ($cont > 0) {
									?>
											<select class="form-control select2" type='text' name='campot15' id='campot15'<?= $c->Ayuda('353', 'tog') ?> >
												<option value="">Seleccione una Opción</option>
												<?
													$x = $con->Query("select * from meta_listas_valores where id_lista = '".$dat['id']."'");
													while ($ror = $con->FetchAssoc($x)) {
														echo '<option value="'.$ror['valor'].'">'.$ror['titulo'].'</option>';
													}
												?>
											</select>
									<?
										}else{
									?>
											<input  class="form-control" type='text' name='campot15' id='campot15'  <?= $c->Ayuda('353', 'tog') ?>  />
									<?
										}
									?>
								</div>
								<?php endif ?>
							</div>
							<div class="row m-t-20">
								<div class="col-md-4 <?= M_FECHA_APERTURA ?>">
									<label for="f_recibido"><?= FECHA_APERTURA ?></label>
									<input class="form-control datepicker" type='date' name='f_recibido' id='f_recibido' placeholder="Fecha de Recibido:" maxlength='' value="<?= date('Y-m-d') ?>" <?= $c->Ayuda('48', 'tog') ?> />
								</div>
								<div class="col-md-4 <?= M_FECHA_RESPUESTA ?>">
									<label for="fecha_vencimiento"><?= FECHA_RESPUESTA ?></label>
									<input class="form-control datepicker" type='date' name='fecha_vencimiento' id='fecha_vencimiento' placeholder="Fecha de Vencimiento Respuesta:" maxlength='' <?= $c->Ayuda('49', 'tog') ?> />
								</div>
								<div class="col-md-4 <?= M_PRIORIDAD ?>">
								  <label for="prioridad"><?= PRIORIDAD ?></label>
								  <select name='prioridad' id='prioridad' class='form-control' <?= $c->Ayuda('50', 'tog') ?> >
										<option value="1">Seleccione la prioridad de la solicitud</option>
										<option value="0">Baja</option>
										<option value="1">Media</option>
										<option value="2">Alta</option>
									</select>
								</div>
							</div>
							<div class="row m-t-30">
								<div class="col-md-12">
									<label for="observacion2">Observación del Expediente</label>
									<textarea class="form-control" type='text' name='observacion2' id='observacion2' placeholder="Observación del Expediente" style="height:100px" <?= $c->Ayuda('51', 'tog') ?>></textarea>
								</div>
							</div>
							<div class="row m-t-20">
								<div class="col-md-12">
									<label for="expediente_publico">
											<input type="checkbox" id="expediente_publico" name="expediente_publico" class="m-r-10" <?= $c->Ayuda('54', 'tog') ?>>Desea Compartir este expediente con todos los <?= SUSCRIPTORCAMPONOMBRE; ?>(es)  (Expediente público) 
										</label>
								</div>
							</div>
							<div class="row m-t-30">
								<div class="col-md-12">
									<input type='button' class="btn btn-info btn-lg" value='Crear Documento' onClick="ChecSuscriptoresExistsGestionRegistrar()";/>
								</div>
							</div>	
							<div style="display:none">
								<b>Seleccione "SI", si el <?= SUSCRIPTORCAMPONOMBRE; ?> es un funcionario</b>
								<select class=""  placeholder="Seleccione SI, si la persona a radicar es funcionario de destino"  name="es_externo" id="es_externo">
									<option value="NO">Seleccione una Opción</option>
									<option value="SI">SI</option>
									<option value="NO">NO</option>
								</select>
								<input  class="" type='hidden' name='nombre_radica' id='nombre_radica' placeholder="Nombre de quien radica:" maxlength='90' />
								<select style="height:35px; display:none" name="estado_respuesta" id="estado_respuesta" class=' '>
									<option value="Abierto">Se respondió la solicitúd</option>
								</select>
								<input class="form-control datepicker" type='hidden' name='fecha_respuesta' id='fecha_respuesta' placeholder="Fecha_respuesta:" maxlength='' />
								<input class="form-control" type='hidden' name='usuario_registra' id='usuario_registra' placeholder="Usuario_registra:" maxlength='50' value="<?= $_SESSION['usuario'] ?>" />
								<input class="form-control" type='hidden' name='estado_archivo' id='estado_archivo' placeholder="Estado_archivo:" maxlength='1' value="1" />
								<?
									$cy = new MCity;
									$cy->CreateCity("code", $_SESSION['ciudad']);
								?>
								<input type='hidden' id='mydpto' value="<?= $cy->GetProvince() ?>" />
								<input type='hidden' id='mycity' value="<?= $cy->GetCode() ?>" />
								<input class="form-control" type='hidden' name='depratemp' id='depratemp' maxlength='100' />
								<select style="display:none" name="autorad" id="autorad"><option value="SI">SI</option></select>
								<input class="" type='hidden' name='folio' id='folio'/>
								<input class="" type='hidden' name='num_oficio_respuesta_hid' id='num_oficio_respuesta_hid'/>		
								<input  class="" type='hidden' name='anho_rad' id='anho_rad' value="<?= date('Y-') ?>"/>
								<select  name='estado_solicitud' id='estado_solicitud'>
								<?
									$estados_gestion = new MEstados_gestion;
									$query_eg = $estados_gestion->ListarEstados_gestion("WHERE dependencia = '0'");	    
									while($row_estados = $con->FetchAssoc($query_eg)){
										$estado_gestion = new MEstados_gestion;
										$estado_gestion->Createestados_gestion('id', $row_estados[id]);
										echo "<option value='".$estado_gestion->GetId()."'>".$estado_gestion->GetNombre()."</option>";
									}
								?>
								</select>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<style>	
	.hideform{
		display:none;
	}
</style>
<script>
	var cantidadusuariosagregados = 0;
	var arrusuariosagregados = [];
	function fnNombreDestinoCompartirConE(){
		$('#nombre_destino_compartir_con').val("");
		$('#seleccion_compartir_con').html('');
	}
	function fnNombreDestinoCompartirCon(){
		if($('#nombre_destino_compartir_con').val() == "3"){
			var html = '<div class="input-group"><input type="text" id="dtformcompartircom" name="dtformcompartircom" placeholder="Nombre Usuario" class="form-control important"><span class="input-group-btn"><button class="btn btn-danger" type="button"  onClick="fnNombreDestinoCompartirConE();">X</button></span></div><div id="bloquebusquedacompartircom"></div>';
			$('#seleccion_compartir_con').html(html);
			$('#seleccion_compartir_con2').append('<label id="usuarios_idlabel'+cantidadusuariosagregados+'"></label><input type="hidden" name="usuarios_id'+cantidadusuariosagregados+'" id="usuarios_id'+cantidadusuariosagregados+'" value="N">');
			cantidadusuariosagregados++;
			$('#nombre_destino_compartir_con').val("");
			$('#cantidadusuariosagregados').val(cantidadusuariosagregados);
			$("#dtformcompartircom").on("keyup", function(){
				$("#bloquebusquedacompartircom").fadeIn();					
				$.ajax({
					type: "POST",
					url: '/usuarios/ListadoUsuariosTodos/'+$(this).val()+"/",
					success: function(msg){
						result = msg;
						$("#bloquebusquedacompartircom").html(result);					
					}
				});				
			});
		}
		if($('#nombre_destino_compartir_con').val() == "2"){
			$.ajax({
				type: "POST",
				url: '/usuarios/ListadoUsuariosTodos2/0/',
				success: function(msg){
					result = msg;
					if(result != ''){
						var arr = result.split('###');
						for (var i = 0; i < arr.length; i++) {
							var hght = arr[i].split('|');
							if((arrusuariosagregados[hght[0]] == undefined || arrusuariosagregados[hght[0]] == 'undefined') && $('#nombre_destino').val() != hght[0]){
								$('#seleccion_compartir_con2').append('<label id="usuarios_idlabel'+cantidadusuariosagregados+'"></label><input type="hidden" name="usuarios_id'+cantidadusuariosagregados+'" id="usuarios_id'+cantidadusuariosagregados+'" value="N">');
								cantidadusuariosagregados++;
								$('#cantidadusuariosagregados').val(cantidadusuariosagregados);
								AddUsuario(hght[0], hght[1]);
							}
						}
					}				
				}
			});
		}
		if($('#nombre_destino_compartir_con').val() == "1"){
			$.ajax({
				type: "POST",
				url: '/usuarios/ListadoUsuariosTodos2/0/'+$('#dependencia_destino').val()+'/',
				success: function(msg){
					result = msg;
					if(result != ''){
						var arr = result.split('###');
						for (var i = 0; i < arr.length; i++) {
							var hght = arr[i].split('|');
							if((arrusuariosagregados[hght[0]] == undefined || arrusuariosagregados[hght[0]] == 'undefined') && $('#nombre_destino').val() != hght[0]){
								$('#seleccion_compartir_con2').append('<label id="usuarios_idlabel'+cantidadusuariosagregados+'"></label><input type="hidden" name="usuarios_id'+cantidadusuariosagregados+'" id="usuarios_id'+cantidadusuariosagregados+'" value="N">');
								cantidadusuariosagregados++;
								$('#cantidadusuariosagregados').val(cantidadusuariosagregados);
								AddUsuario(hght[0], hght[1]);
							}	
						}
					}				
				}
			});
		}
		if($('#nombre_destino_compartir_con').val() == "4"){
			$('#seleccion_compartir_con2').html('');
			cantidadusuariosagregados = 0;
			arrusuariosagregados = [];
			arrusuariosagregados = undefined;
			arrusuariosagregados = new Array();
		}
	}
	$(document).ready(function() {
		dependencia_estadoinExistence('departamento');
		$("#departamento").change(function(){
			dependencia_ciudadinExistence("departamento","ciudad");
		});
		$("#ciudad").change(function(){
			dependencia_item("ciudad","oficina", "/seccional/listadooficinasseccional");
//			$("#num_oficio_respuesta").val(zeroFill($("#ciudad").val(), 3));
			setTimeout(function(){
				if($("#oficina").val() != "" && $("#oficina").val()  != "Seleccione una Oficina"){
					$("#oficina").change();
				}
			}, 1000);
		});
		$("#oficina").change(function(){
			dependencia_item("oficina","dependencia_destino", "/usuarios/ListadoAreasOficinaNew");
//			$("#num_oficio_respuesta").val(zeroFill($("#ciudad").val(), 3)+"-"+zeroFill($("#oficina").val(), 3));
			setTimeout(function(){
				if($("#dependencia_destino").val() != "" && $("#dependencia_destino").val()  != "Seleccione un Area de Trabajo"){
					$("#dependencia_destino").change();
				}
			}, 1000);
		});
		$("#es_externo").click(function(){
				$("#suscriptor_id").html();
		})
		$("#autorad").on("change", function(){
			if ($(this).val() == "SI") {
				$("#num_oficio_respuesta").val($("#num_oficio_respuesta_hid").val());
			}else{
				$("#num_oficio_respuesta_hid").val($("#num_oficio_respuesta").val());
				$("#num_oficio_respuesta").val("");
			}
		})
		$("body").css("cursor", "wait");
		setTimeout(function(){
			$("#departamento option[value="+ $("#mydpto").val() +"]").attr("selected",true);
		}, 1000);
		setTimeout(function(){
			dependencia_ciudadinExistence("departamento","ciudad");
		}, 2000);
		setTimeout(function(){
			$("#ciudad option[value="+ $("#mycity").val() +"]").attr("selected",true);
			dependencia_item("ciudad","oficina", "/seccional/listadooficinasseccional");
		//	$("#num_oficio_respuesta").val(zeroFill($("#ciudad").val(), 3));
			$("body").css("cursor", "default");
			setTimeout(function(){
				if($("#oficina").val() != "" && $("#oficina").val()  != "Seleccione una Oficina"){
					$("#oficina").change();
				}
			}, 1000);
		}, 3000);
		$("#dependencia_destino").change(function(){
			GetId_a($("#dependencia_destino").val());
			dependencia_item("dependencia_destino","nombre_destino", "/usuarios/ListadoUsuariosAreasOficina3New/"+$("#oficina").val());
			//$("#num_oficio_respuesta").val(   $("#anho_rad").val()+zeroFill($("#dependencia_destino").val(), 3) );
			$("#nombre_destino_compartir_con").attr("disabled",false);
            $("#nombre_destino_compartir_con").removeClass("disabled");
            $("#informerporemail").attr("disabled",false);
            $("#informerporemail").removeClass("disabled");
            dependencia_item('dependencia_destino','id_dependencia_raiz','/areas_dependencias/GetSeriesArea/');
            setTimeout(function(){
				if($("#id_dependencia_raiz").val() != "" && $("#id_dependencia_raiz").val()  != "Seleccione una Serie"){
					$("#id_dependencia_raiz").change();
				}
			}, 1000);
		});
		$("#id_dependencia_raiz").change(function(){
			GetId_c($("#id_dependencia_raiz").val());
			dependencia_item2('dependencia_destino', 'id_dependencia_raiz','tipo_documento', '/areas_dependencias/GetSubSeriesArea/');
			setTimeout(function(){
				if($("#tipo_documento").val() != "" && $("#tipo_documento").val()  != "Seleccione una Sub-Serie"){
					$("#tipo_documento").change();
				}
			}, 1000);
		});
		$("#tipo_documento").change(function(){
			GetId_c2($("#tipo_documento").val());
			GetTipologiasSubserie($("#tipo_documento").val());
			GetFechaVencimientoExpediente($("#tipo_documento").val());
		});
		$("#documento_salida").change(function(){
			if ($(this).val() == "N") {
				$("#rowobse").css("display", "none");
			}else{
				$("#rowobse").css("display", "block");
			}
		})
	});
</script>
<script>
	$("#dtform").on("keyup", function(){
		$("#bloquebusqueda").fadeIn();				
		$.ajax({
			type: "POST",
			url: '/suscriptores_contactos/buscar/'+$(this).val()+"/",
			success: function(msg){
				result = msg;
				$("#bloquebusqueda").html(result);					
			}
		});				
	});
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
	function AddUsuario(id, nombre){
		if (id == "N") {
			$(".hideform").slideDown("fast");
		}else{
			$(".hideform").slideUp("fast");
		}
		if((arrusuariosagregados[id] == undefined || arrusuariosagregados[id] == 'undefined') && $('#nombre_destino').val() != id){
			$('#usuarios_idlabel'+(cantidadusuariosagregados-1)).html('-'+nombre+'<br>');
			$('#usuarios_id'+(cantidadusuariosagregados-1)).val(id);
			$('#seleccion_compartir_con').html('');
			arrusuariosagregados[id] = nombre;
		}else{
			alert('El usuario ya se ha seleccionado');
		}
	}
	function AddSuscriptor(id, nombre){
		$(".hideform").slideDown("fast");
		$.ajax({
			type: "POST",
			dataType: "json",
		  	url: '/suscriptores_contactos/buscarJsuscriptor/'+id+"/",
		  	success: function(msg){
		  		$("#Identificacion_suscriptor").val(msg["Identificacion_suscriptor"]);
				$("#Type_suscriptor").val(msg["Type_suscriptor"]);
				$("#Type_suscriptor2").val(msg["Type_suscriptor"]);
				$("#Direccion_suscriptor").val(msg["Direccion_suscriptor"]);
				$("#Ciudad_suscriptor").val(msg["Ciudad_suscriptor"]);
				$("#Telefonos_suscriptor").val(msg["Telefonos_suscriptor"]);
				$("#Email_suscriptor").val(msg["Email_suscriptor"]);
				$('#Type_suscriptor22 option[value="'+msg["Type_suscriptor"]+'"]').attr("selected", true);
				//$('#Type_suscriptor').show();
				//$("#Type_suscriptor22").css("display", "none");
		  	}
		});	
		$("#suscriptor_id").val(id);
		$("#dtform").val(nombre);
		$("#nombre_radica").val(nombre);
		$("#bloquebusqueda").fadeOut();		
	}
	function Hideform(){
		$("#bloquebusqueda").fadeOut();
		$("#id_suscriptor").val("");
		$("#datasuscriptor").html("");					
	}
	$("#Type_suscriptor2").on("keyup", function(){
		$("#bloquebusquedasuscriptor").fadeIn();				
		$.ajax({
			type: "POST",
			url: '/suscriptores_contactos/buscarsuscriptortipo/'+$(this).val()+"/",
			success: function(msg){
				result = msg;
				$("#bloquebusquedasuscriptor").html(result);					
			}
		});				
	});
	function AddSuscriptorTipo(typo){
		$("#Type_suscriptor2").val(typo);
		$("#Type_suscriptor").val(typo);
		$("#bloquebusquedasuscriptor").fadeOut();		
	}
</script>
<link rel='stylesheet' type='text/css' href='<?= HOMEDIR.DS ?>app/plugins/select2/css/select2.min.css'/>
<script language='javascript' type='text/javascript' src='<?= HOMEDIR.DS ?>app/plugins/select2/js/select2.min.js'></script>
<script type="text/javascript">
    (function($) {
        if ($('.select2').length){
            $(".select2").select2();
        }
    })(jQuery);
</script>