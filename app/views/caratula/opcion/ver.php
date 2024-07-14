<div id="form">
	<table class="tbd">
		<tr>
			<form id="from_pro" name="from_pro">
			<td style="width:65%">
				<div class="title">
					<div style="float:left"><b>Datos del Proceso</b></div>
					<?
						if ($_SESSION[usuario]==$_SESSION[sadminid] || $_SESSION[sadmin]!=1) {
							if ($_SESSION['folder'] == '') {
								echo "<div style='float:right' class='opc' id='edit_opc1_0' onclick='edit_demandante(0)'>Editar</div>
										<div class='opc' id='save_opc1_0' onclick='save_proceso(0, ".$proceso[id].")' style='display:none; float:right'>Guardar</div>";
							}
						}

						$pidx = $proceso[proceso_id];

					?>



					<!--<div style="float:right" class='opc' id='edit_proc' onclick='edit_proc'>editar</div> -->
					<div class="clear"></div>
				</div>
				<table class="left">
					<tr class="impar">
						<td width="200">Título:</td>
						<td><input type='text' name='tit_demanda' disabled class='no_editable input1_0' value='<?=$proceso[tit_demanda]?>'></td>
					</tr>
					<tr class="par">
						<td width="200">Nombre de Entidad:</td>
						<td><input type='text' name='juzgado' disabled class='no_editable input1_0' value='<?=$proceso[juzgado]?>'></td>
					</tr>
					<script>
									
						$(document).ready(function() {

							$("#departamento").change(function(){
								dependencia_ciudad("departamento","ciudad");
							});

						});

					</script>
					<tr class="impar">
						<td width="200">Departamento de Entidad:</td>
						<td>
							<select name="departamento" id="departamento" disabled class='no_editable input1_0'>
								<?
									$pr = new MProvince;
									$q = $pr->ListarProvince(" WHERE Country = 'CO'", '', '');
									while ($rp = $con->FetchAssoc($q)) {
										$path = "";
										if ( $rp['code'] == $proceso[departamento] ) {
											$path = "selected = 'selected'";
										}
										echo '<option value="'.$rp['code'].'" '.$path.'>'.$rp['Name'].'</option>';
									}
								?>
							</select>
						</td>
					</tr>

					<tr class="par">
						<td width="200">Ciudad de Entidad:</td>
						<td>
							<select name="ciudad" id="ciudad" disabled class='no_editable input1_0'>
								<?
									$cityc = new MCity;
									$qd = $cityc->ListarCity(" WHERE Province = '".$proceso[departamento]."'", '', '');;
									while ($rd = $con->FetchAssoc($qd)) {
										$path = "";
										if ( $rd['code'] == trim($proceso[ciudad]) ) {
											$path = "selected = 'selected'";
										}
										echo '<option value="'.$rd['code'].'" '.$path.'>'.$rd['Name'].'</option>';
									}
								?>
							</select>
						</td>
					</tr>


					<tr class="impar">
						<td width="200">Dirección de Entidad:</td>
						<td><input type='text' name='dir_juz' disabled class='no_editable input1_0' value='<?=$proceso[dir_juz]?>'></td>
					</tr>
					<tr class="par">
						<td width="200">Teléfono de Entidad:</td>
						<td><input type='text' name='tel_juz' disabled class='no_editable input1_0' value='<?=$proceso[tel_juz]?>'></td>
					</tr>
					<tr class="impar">
						<td width="200">Email de Entidad:</td>
						<td><input type='text' name='email_juz' disabled class='no_editable input1_0' value='<?=$proceso[email_juz]?>'></td>
					</tr>
					<tr class='par'>
						<td width="200">Naturaleza:</td>
						<td><input type='text' name='tip_demanda' disabled class='no_editable input1_0' value='<?=$proceso[tip_demanda]?>'></td>
					</tr>
					<tr class='impar'>
						<td width="200">Radicado completo:</td>
						<td><input type='text' name='rad_completo' disabled class='no_editable input1_0' value='<?=$proceso[rad_completo]?>'></td>
					</tr>
					<tr class='par'>
						<td width="200">Radicado:</td>
						<td><input type='text' name='rad' disabled class='no_editable input1_0' value='<?=$proceso[rad]?>'></td>
					</tr>
					<tr class='impar'>
						<td width="200">Valor:</td>
						<td><input type='text' name='val_demanda' disabled class='no_editable input1_0' value='<?=$proceso[val_demanda]?>'></td>
					</tr>
				<!--	<tr class="par">
						<td width="200">Valor caución:</td>
						<td><input type='text' name='costas' disabled class='no_editable input1_0' value='<?=$proceso[costas]?>'></td>
					</tr> -->
					<tr class="par">
						<td width="200">Fecha de presentación:</td>
						<td><input type='text' name='fec_pres' disabled class='no_editable input1_0 datepicker' value='<?=$proceso[fec_pres]?>'></td>
					</tr>
					<tr class="impar">
						<td width="200">Fecha de Admisión:</td>
						<td><input type='text' name='fec_auto' disabled class='no_editable input1_0 datepicker' value='<?=$proceso[fec_auto]?>'></td>
					</tr>
					<tr class='par'>
						<td width="200">Número:</td>
						<td><input type='text' name='num_oficio' disabled class='no_editable input1_0' value='<?=$proceso[num_oficio]?>'></td>
					</tr>
					<tr class='impar'>
						<td width="200">Estado del Proceso:</td>
						<td>
							<select name="est_proceso" id="est_proceso" disabled class='no_editable input1_0'>
		                    <?
		                        if ($proceso[est_proceso] == "ACTIVO") {
		                            echo '<option value="ACTIVO">En Curso</option>';
		                            echo '<option value="ARCHIVADO">Archivar</option>';
		                            echo '<option value="DESACTIVAR">Sin Iniciar</option>';
		                            echo '<option value="ELIMINAR">Eliminar</option>';
		                        }
		                        if ($proceso[est_proceso] == "ARCHIVADO") {
		                            echo '<option value="ARCHIVADO">Archivado</option>';
		                            echo '<option value="ACTIVO">En Curso</option>';
		                            echo '<option value="DESACTIVAR">Sin Iniciar</option>';
		                            echo '<option value="ELIMINAR">Eliminar</option>';
		                        }
		                        if ($proceso[est_proceso] == "DESACTIVAR") {
		                            echo '<option value="DESACTIVAR">Sin Iniciar</option>';
		                            echo '<option value="ACTIVO">En Curso</option>';
		                            echo '<option value="ARCHIVADO">Archivar</option>';
		                            echo '<option value="ELIMINAR">Eliminar</option>';
		                        }
		                        if ($proceso[est_proceso] == "ELIMINAR") {
		                            echo '<option value="ELIMINAR">Eliminado</option>';
		                            echo '<option value="ACTIVO">En Curso</option>';
		                            echo '<option value="DESACTIVAR">Sin Iniciar</option>';
		                            echo '<option value="ARCHIVADO">Archivar</option>';
		                        }

		                    ?>
			                </select>
						</td>
					</tr>
				</table>
			</td>
			</form>



		</tr>
		<tr class='impar'>
			<td>
				<table  class="left nopadding" id="ListadoPartes">
					<tr class='impar'>
						<td  style='width:50%'>
							<?
							if ($_SESSION[usuario]==$_SESSION[sadminid] || $_SESSION[sadmin]!=1) {
									if ($_SESSION['folder'] == '') {
										$link="<div class='opc' id='newcliente' onclick='NuevoCliente()' align='right' style='float:right; width:auto'>Agregar Cliente</div>";

										$link2="<div class='opc' id='newcontraparte' onclick='NuevoContraparte()' align='right' style='float:right; width:auto'>Agregar Contraparte</div>";

									}
								}
							?>
							<div class="title2">Clientes <?= $link ?></div>
							<div id='list_clientes'>

							<?php while ($col=$con->FetchAssoc($demandantes)) {
								if ($_SESSION[usuario]==$_SESSION[sadminid] || $_SESSION[sadmin]!=1) {
									if ($_SESSION['folder'] == '') {
										$link="
											<div class='opc' id='edit_opc1_$col[id]' onclick='edit_demandante($col[id])'>editar</div>
											<div class='opc' id='save_opc1_$col[id]' onclick='save_demandante($col[id])' style='display:none'>guardar</div>
											<!--<div class='opc' id='delete_opc1_$col[id]' onclick='delete_demandante($col[id])'>eliminar</div>-->";
									}
								}
								echo "	<div class='title'>$col[nom_entidad]
											$link
										</div>
										<form id='formulario1_$col[id]'>
											<table class='right'>
												<tr class='par'>
													<td colspan='2'>";
													if ($_SESSION[usuario]==$_SESSION[sadminid] || $_SESSION[sadmin]!=1) {
														if ($_SESSION['folder'] == '') {

															if ($col['notif_actuaciones'] == '1') {
																echo "<input type='checkbox' onChange='ChangeStatusNotificationDte(\"".$col['id']."\")' id='dmte_$col[id]' checked = 'checked'> <label for='dmte_$col[id]'>Informar sobre las actualizaciones de este proceso</label>";
															}else{
																echo "<input type='checkbox' onChange='ChangeStatusNotificationDte(\"".$col['id']."\")' id='dmte_$col[id]'> <label for='dmte_$col[id]'>Informar sobre las actualizaciones de este proceso</label>";
															}
														}
													}
								echo "				</td>
												</tr>
												<tr class='impar'>
													<td>Nombre:</td>
													<td><input type='text' name='nom_entidad' disabled class='no_editable input1_$col[id]' value='$col[nom_entidad]'></td>
												</tr>
												<tr class='par'>
													<td>Identificacion:</td>
													<td><input type='text' name='nit_entidad' disabled class='no_editable input1_$col[id]' value='$col[nit_entidad]'></td>
												</tr>
												<tr class='impar'>
													<td>Dirección:</td>
													<td><input type='text' name='dir_entidad' disabled class='no_editable input1_$col[id]' value='$col[dir_entidad]'></td>
												</tr>
												<tr class='par'>
													<td>Ciudad:</td>
													<td><input type='text' name='ciu_entidad' disabled class='no_editable input1_$col[id]' value='$col[ciu_entidad]'></td>
												</tr>
												<tr class='impar'>
													<td>E-mail:</td>
													<td><input type='text' name='telefonos' disabled class='no_editable input1_$col[id]' value='$col[email_repres]'></td>
												</tr>
												<tr class='par'>
													<td>Teléfono:</td>
													<td><input type='text' name='email_repres' disabled class='no_editable input1_$col[id]' value='$col[telefonos]'></td>
												</tr>";
												if ($col[p_nom_repres] != "") {
													echo "	<tr class='impar'>
																<td>Representante Legal:</td>
																<td><input type='text' id='p_nom_repres' name='p_nom_repres' disabled class='no_editable input1_$col[id]' value='$col[p_nom_repres]'></td>
															</tr>
															<tr class='par'>
																<td>Ciudad:</td>
																<td><input type='text' id='ciu_repres' name='ciu_repres' disabled class='no_editable input1_$col[id]' value='$col[ciu_repres]'></td>
															</tr>";
												}
								echo "		</table>
										</form>";
							} ?>
							</div>
							<div id="list_clientes2"></div>
						</td>
						<td>
							<div class="title2">Contraparte <?= $link2 ?></div>
							<div id='list_contraparte'>
							<?php while ($col=$con->FetchAssoc($demandados)) {
								if ($_SESSION[usuario]==$_SESSION[sadminid] || $_SESSION[sadmin]!=1) {
									if ($_SESSION['folder'] == '') {
										$link="<div class='opc' id='edit_opc2_$col[id]' onclick='edit_demandado($col[id])'>editar</div>
											<div class='opc' id='save_opc2_$col[id]' onclick='save_demandado($col[id])' style='display:none'>guardar</div>";
									}									
								}
								echo "	<div class='title left'>$col[p_nombre]
											$link
										</div>
										<form id='formulario2_$col[id]' action=''>
											<table class='left'>
												<tr class='par'>
													<td colspan='2'>";
													if ($_SESSION[usuario]==$_SESSION[sadminid] || $_SESSION[sadmin]!=1) {
														if ($_SESSION['folder'] == '') {

															if ($col['notif_actuaciones'] == '1') {
																echo "<input type='checkbox' onChange='ChangeStatusNotificationDdo(\"".$col['id']."\")' id='dmdo_$col[id]' checked = 'checked'> <label for='dmdo_$col[id]'>Informar sobre las actualizaciones de este proceso</label>";
															}else{
																echo "<input type='checkbox' onChange='ChangeStatusNotificationDdo(\"".$col['id']."\")' id='dmdo_$col[id]'> <label for='dmdo_$col[id]'>Informar sobre las actualizaciones de este proceso</label>";
															}
														}
													}
								echo "				</td>
												</tr>
												<tr class='impar'>
													<td>Nombre:</td>
													<td><input type='text' id='nombre' name='nombre' disabled class='no_editable input2_$col[id]' value='$col[p_nombre]'></td>
												</tr>
												<tr class='par'>
													<td>Identificacion:</td>
													<td><input type='text' id='cedula' name='cedula' disabled class='no_editable input2_$col[id]' value='$col[cedula]'></td>
												</tr>
												<tr class='impar'>
													<td>Dirección:</td>
													<td><input type='text' id='direccion' name='direccion' disabled class='no_editable input2_$col[id]' value='$col[direccion]'></td>
												</tr>
												<tr class='par'>
													<td>Ciudad:</td>
													<td><input type='text' id='ciudad' name='ciudad' disabled class='no_editable input2_$col[id]' value='$col[ciudad]'></td>
												</tr>
												<tr class='impar'>
													<td>E-mail:</td>
													<td><input type='text' id='email' name='email' disabled class='no_editable input2_$col[id]' value='$col[email]'></td>
												</tr>
												<tr class='par'>
													<td>Teléfono:</td>
													<td><input type='text' id='telefono' name='telefono' disabled class='no_editable input2_$col[id]' value='$col[telefonos]'></td>
												</tr>";
												if ($col[s_apellido] != "") {
													echo "	<tr class='impar'>
																<td>Representante Legal:</td>
																<td><input type='text' id='s_apellido' name='s_apellido' disabled class='no_editable input2_$col[id]' value='$col[s_apellido]'></td>
															</tr>
															<tr class='par'>
																<td>Ciudad:</td>
																<td><input type='text' id='departamento' name='departamento' disabled class='no_editable input2_$col[id]' value='$col[departamento]'></td>
															</tr>";
												}
							echo "			</table>
										</form>";
							} ?>
							</div>
							<div id="list_contraparte2"></div>
						</td>
					</tr>
					<tr>
						<td  style='width:50%' id="contact_group">
							<div class="title2">Listado de  Contactos</div>

							<?php 
								$st = $con->Query("Select * from contactos where proceso_id = '".$proceso["id"]."'");
								while ($col=$con->FetchAssoc($st)) {
									/*
									if ($_SESSION[usuario]==$_SESSION[sadminid] || $_SESSION[sadmin]!=1) {
										$link="<div class='opc' id='edit_opc1_$col[id]' onclick='edit_contacto($col[id])'>editar</div>
												<div class='opc' id='save_opc1_$col[id]' onclick='save_contacto($col[id])' style='display:none'>guardar</div>";
									} */

									$direcciones = "";
									$telefonos = "";
									$correos = "";
									$link="<div class='opc' id='edit_opc1_$col[id]' onclick='edit_contacto($col[id])'>editar</div>
												<div class='opc' id='save_opc1_$col[id]' onclick='save_contacto($col[id])' style='display:none'>guardar</div>
												<div class='opc' id='delete_opc1_$col[id]' onclick='delete_contacto($col[id])'>eliminar</div>";


									$strd = $con->Query("select * from contactos_direccion where id_contacto = '".$col["id"]."'");
						    		while ($rd = @$con->FetchAssoc($strd)) {
						    			$direcciones .= $rd["direccion"]." - ".$rd["ciudad"].", ";
						    			# code...
						    		}

						    		$strt = $con->Query("select * from contactos_telefonos where contacto_id = '".$col["id"]."'");
						    		while ($rt = @$con->FetchAssoc($strt)) {
						    			$telefonos.= $rt["telefono"].", ";
						    		}

						    		$strc = $con->Query("select * from contactos_emails where contacto_id = '".$col["id"]."'");
						    		while ($rc = @$con->FetchAssoc($strc)) {
						    			$correos .= $rc["email"].", ";
						    			# code...
						    		}
								echo "	<div class='title' style='cursor:pointer'><span onclick='$(\"#formulario3_$col[id]\").slideToggle(500)'>$col[nombre] $col[apellido]</span>
											$link
										</div>
										<form id='formulario3_$col[id]' style='display:none'>
											<input type='hidden' name='id' value='$col[id]'>
											<table class='right'>
												<tr class='impar'>
													<td>Nombre:</td>
													<td><input type='text' name='nombre' disabled class='no_editable input1_$col[id]' value='$col[nombre] $col[apellido]'></td>
												</tr>
												<tr class='par'>
													<td>Tipo:</td>
													<td><input type='text' name='tipo' disabled class='no_editable input1_$col[id]' value='$col[type]'></td>
												</tr>
												<tr class='impar'>
													<td>Dirección:</td>
													<td><input type='text' name='direccion' disabled class='no_editable input1_$col[id]' value='$direcciones'></td>
												</tr>
												<tr class='par'>
													<td>Teléfono:</td>
													<td><input type='text' name='telefono' disabled class='no_editable input1_$col[id]' value='$telefonos'></td>
												</tr>
												<tr class='impar'>
													<td>E-mail:</td>
													<td><input type='text' name='email' disabled class='no_editable input1_$col[id]' value='$correos'></td>
												</tr>
											</table>
										</form>";
							} ?>
						</td>
						<? 	if ($_SESSION[usuario]==$_SESSION[sadminid] || $_SESSION[sadmin]!=1) {
								if ($_SESSION['folder'] == '') {
						 ?>
						<td>
							<div class="title2 left">Agregar Contacto</div>

							<? include(VIEWS.DS.'contactos'.DS.'FormInsertContactos.php'); ?>

						</td>
						<? 	
								}
							} 
						?>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</div>
<script>
	function edit_demandante(id){
		$('.input1_'+id).removeClass('no_editable');
		$('.input1_'+id).addClass('editable');
		$('.input1_'+id).prop('disabled', false);
		$('#edit_opc1_'+id).hide();
		$('#save_opc1_'+id).show();
	}
	function save_demandante(id){
		$('.input1_'+id).removeClass('editable');
		$('.input1_'+id).addClass('no_editable');
		var str = $('#formulario1_'+id).serialize()
		$('.input1_'+id).prop('disabled', true);
		$('#edit_opc1_'+id).show();
		$('#save_opc1_'+id).hide();
		$.ajax({
			url:'/caratula/save_demandante/'+id+'/',
			type:'POST',
			data:str,
			success:function(msg){
			}
		})
	}
	function save_proceso(id, pid){
		$('.input1_'+id).removeClass('editable');
		$('.input1_'+id).addClass('no_editable');
		var str = $('#from_pro').serialize()
		$('.input1_'+id).prop('disabled', true);
		$('#edit_opc1_'+id).show();
		$('#save_opc1_'+id).hide();
		$.ajax({
			url:'/caratula/opcion/'+pid+'/editar/',
			type:'POST',
			data:str,
			success:function(msg){
			}
		})		
	}
	function edit_demandado(id){

		$('.input2_'+id).removeClass('no_editable');
		$('.input2_'+id).addClass('editable');
		$('.input2_'+id).prop('disabled', false);
		$('#edit_opc2_'+id).hide();
		$('#save_opc2_'+id).show();
	}
	function save_demandado(id){
		$('.input2_'+id).removeClass('editable');
		$('.input2_'+id).addClass('no_editable');
		var str = $('#formulario2_'+id).serialize();
		$('.input2_'+id).prop('disabled', true);
		$('#edit_opc2_'+id).show();
		$('#save_opc2_'+id).hide();	
		$.ajax({
			url:'/caratula/save_demandado/'+id+'/',
			type:'POST',
			data:str,
			success:function(msg){
				alert(msg);
			}
		})
	}


	function edit_contacto(id){

		$('.input1_'+id).removeClass('no_editable');
		$('.input1_'+id).addClass('editable');
		$('.input1_'+id).prop('disabled', false);
		$('#edit_opc1_'+id).hide();
		$('#save_opc1_'+id).show();
		$('#formulario3_'+id).slideToggle(500);
	}

		function save_contacto(id){
		$('.input1_'+id).removeClass('editable');
		$('.input1_'+id).addClass('no_editable');
		var str = $('#formulario3_'+id).serialize();
		$('.input1_'+id).prop('disabled', true);
		$('#edit_opc1_'+id).show();
		$('#save_opc1_'+id).hide();
		$.ajax({
			url:'/caratula/save_contacto/'+id+'/',
			type:'POST',
			data:str,
			success:function(msg){
				alert(msg);
			}
		})
	}

	function delete_contacto(id){


		var confirmar = confirm('desea eliminar este contacto ?');
		if(confirmar == true)
		{

			$.ajax({
				type:'post',
				url:'/caratula/delete_contacto/',
				data:{'id':id},
				success:function(msg){
					alert(msg);
					location.reload();
				}

			});

		}

	}



	function ChangeStatusNotificationDdo(id){
		if($("#dmdo_"+id).is(':checked')) {  
            var URL = '/caratula/updateddo/'+id+'/1/';
        } else {  
            var URL = '/caratula/updateddo/'+id+'/0/';
        } 

        $.ajax({
			url:URL,
			type:'POST',
			success:function(msg){
				alert(msg);
			}
		});

	}

	function ChangeStatusNotificationDte(id){
		if($("#dmte_"+id).is(':checked')) {  
            var URL = '/caratula/updatedte/'+id+'/1/';
        } else {  
            var URL = '/caratula/updatedte/'+id+'/0/';
        } 

        $.ajax({
			url:URL,
			type:'POST',
			success:function(msg){
				alert(msg);
			}
		});

	}

	function NuevoCliente(){
		$("#list_clientes2").html($("#list_clientes").html());
		$('#list_clientes').html('<div class="title left">&nbsp;<a onclick="AddClienteNatural()" class="opc">Natural</a> <a onclick="AddClienteJuridico()" class="opc">Jurídica</a></div>');
	}
	function NuevoContraparte(){
		$("#list_contraparte2").html($("#list_contraparte").html());
		$('#list_contraparte').html('<div class="title left">&nbsp;<a onclick="AddContraparteNatural()" class="opc">Natural</a> <a onclick="AddContraparteJuridica()" class="opc">Jurídica</a></div>');
	}

	function GuardarCliente(){
		var str = $('#fnewcliente').serialize()+"&pid=<?=$pidx?>";
		$.ajax({
			url:'/demandante_proceso_juridico/registrar/<?= $_GET["id"] ?>/',
			type:'POST',
			data:str,
			success:function(msg){
				//alert(msg);
				window.location.reload();
			}
		})		
	}
	function GuardarContraparte(){
		var str = $('#fnewcontraparte').serialize()+"&pid=<?=$pidx ?>";
		$.ajax({
			url:'/demandado_proceso/registrar/<?= $_GET["id"] ?>/',
			type:'POST',
			data:str,
			success:function(msg){
				//alert(msg);
				window.location.reload();
			}
		})		
	}

	function CancelarCliente(){
		$("#list_clientes").html($("#list_clientes2").html());

		$("#newcliente").css("display", "block");
		$("#savecliente").css("display", "none");
		$("#cancelarcliente").css("display", "none");
	}
	function CancelarContraparte(){
		$("#list_contraparte").html($("#list_contraparte2").html());

		$("#newcontraparte").css("display", "block");
		$("#savecontraparte").css("display", "none");
		$("#cancelarcontraparte").css("display", "none");	
	}
		function AddClienteNatural(){
		var num = $('#dem_num').val();
		var content = "<div class='title left'>CLIENTE PERSONA NATURAL<div class='opc' id='cancelarcliente' onclick='CancelarCliente()' style='display:none;float:right'>Cancelar</div><div class='opc' id='savecliente' onclick='GuardarCliente()' style='display:none;float:right'>Guardar</div></div>"+
						"<form id='fnewcliente'>"+
							"<table class='right'>"+
								"<tr class='par'>"+
						      		"<td>Nombre <span class='obligatorio'>*</span></td>"+
						      		"<td><input name='nom_entidad' type='text'></td>	"+
						      	"</tr>"+
						      	"<tr class='impar'>"+
						      		"<td>Número de Identificación <span class='obligatorio'>*</span></td>"+
						      		"<td><input name='nit_entidad' type='text'></td>	"+
						      	"</tr>"+
						      	"<tr class='par'>"+
						      		"<td>Lugar de Expedición</td>"+
						      		"<td><input name='exp_identificacion' type='text'></td>	"+
						      	"</tr>"+
						      	"<tr class='impar'>"+
						      		"<td>Teléfono</td>"+
						      		"<td><input name='telefonos' type='text' class='tags'></td>	"+
						      	"</tr>"+
						      	"<tr class='par'>"+
						      		"<td>Email <span class='obligatorio'>*</span></td>"+
						      		"<td><input name='email_repres' type='text' class='tags'></td>	"+
						      	"</tr>"+
						      	"<tr class='impar'>"+
						      		"<td>Ciudad</td>"+
						      		"<td><input name='ciu_entidad[]' type='text'></td>	"+
						      	"</tr>"+
						      	"<tr class='par'>"+
						      		"<td>Dirección</td>"+
						      		"<td><input name='dir_entidad[]' type='text'></td>	"+
						      	"</tr>"+
					      	"</table>"+
				      	"</form>";
		
		$('#list_clientes').html(content);
		
		$("#newcliente").css("display", "none");
		$("#savecliente").css("display", "block");
		$("#cancelarcliente").css("display", "block");


	}	
	function AddClienteJuridico(){
		var num = $('#dem_num2').val();
		var content = "	<div lass='title left'>CLIENTE PERSONA JURÍDICA <div class='opc' id='cancelarcliente' onclick='CancelarCliente()' style='display:none;float:right'>Cancelar</div><div class='opc' id='savecliente' onclick='GuardarCliente()' style='display:none;float:right'>Guardar</div></div>"+
						"<form id='fnewcliente'>"+
							"<table class='right'>"+
								"<tr class='par'>"+
						      		"<td>Nombre <span class='obligatorio'>*</span></td>"+
						      		"<td><input name='nom_entidad' type='text'></td>	"+
						      	"</div><div class='clear'></tr>"+
						      	"<tr class='impar'>"+
						      		"<td>Numero de Identificación <span class='obligatorio'>*</span></td>"+
						      		"<td><input name='nit_entidad' type='text'></td>	"+
						      	"</tr>"+
						      	"<tr class='par'>"+
						      		"<td>Lugar de Registro</td>"+
						      		"<td><input name='exp_identificacion' type='text'></td>	"+
						      	"</tr>"+
						      	"<tr class='impar'>"+
						      		"<td>Teléfono</td>"+
						      		"<td><input name='telefonos' type='text' class='tags'></td>	"+
						      	"</tr>"+
						      	"<tr class='par'>"+
						      		"<td>Email <span class='obligatorio'>*</span></td>"+
						      		"<td><input name='email_repres' type='text' class='tags'></td>	"+
						      	"</tr>"+
						      	"<tr class='impar'>"+
						      		"<td>Ciudad</td>"+
						      		"<td><input name='ciu_entidad[]' type='text'></td>	"+
						      	"</tr>"+
						      	"<tr class='par'>"+
						      		"<td>Dirección</td>"+
						      		"<td><input name='dir_entidad[]'  type='text'></td>	"+
						      	"</tr>"+
						      	"<tr class='impar'>"+
						      		"<td>Nombre del Representante Legal</td>"+
						      		"<td><input name='p_nom_repres' type='text'></td>	"+
						      	"</tr>"+
						      	"<tr class='par'>"+
						      		"<td>Ciudad del Representante Legal</td>"+
						      		"<td><input name='ciu_repres' type='text'></td>	"+
						      	"</tr>"+
						    "</table>"+
				      	"</form>";
		$('#list_clientes').html(content);

		$("#newcliente").css("display", "none");
		$("#savecliente").css("display", "block");
		$("#cancelarcliente").css("display", "block");
	}

	function AddContraparteNatural(){
		var num = $('#dem_num3').val();
		var content = "	<div class='title left'>CONTRAPARTE 'PERSONA NATURAL<div class='opc' id='cancelarcontraparte' onclick='CancelarContraparte()' style='display:none;float:right'>Cancelar</div><div class='opc' id='savecontraparte' onclick='GuardarContraparte()' style='display:none;float:right'>Guardar</div></div>"+
						"<form id='fnewcontraparte'>"+
							"<table class='right'>"+
								"<tr class='par'>"+
						      		"<td>Nombre <span class='obligatorio'>*</span></td>"+
						      		"<td><input name='p_nombre' type='text'></td>	"+
						      	"</tr>"+
						      	"<tr class='impar'>"+
						      		"<td>Numero de Identificación <span class='obligatorio'>*</span></td>"+
						      		"<td><input name='cedula' type='text'></td>	"+
						      	"</tr>"+
						      	"<tr class='par'>"+
						      		"<td>Lugar de Expedición</td>"+
						      		"<td><input name='exp_identificacion' type='text'></td>	"+
						      	"</tr>"+
						      	"<tr class='impar'>"+
						      		"<td>Teléfono</td>"+
						      		"<td><input name='telefonos' type='text' class='tags'></td>	"+
						      	"</tr>"+
						      	"<tr class='par'>"+
						      		"<td>Email <span class='obligatorio'>*</span></td>"+
						      		"<td><input name='email' type='text' class='tags'></td>	"+
						      	"</tr>"+
						      	"<tr class='impar'>"+
						      		"<td>Ciudad<input type='hidden' value='"+num+"' name='dem2_dirs[]'></td>"+
						      		"<td><input name='ciudad[]' type='text'></td>	"+
						      	"</tr>"+
						      	"<tr class='par'>"+
						      		"<td>Dirección</td>"+
						      		"<td><input name='direccion[]' type='text'></td>	"+
						      	"</tr>"+
					      	"</table>"+
				      	"</form>";
		$('#list_contraparte').html(content);

		$("#newcontraparte").css("display", "none");
		$("#savecontraparte").css("display", "block");
		$("#cancelarcontraparte").css("display", "block");

	}	
	function AddContraparteJuridica(){
		var num = $('#dem_num4').val();
		var content = "	<div class='title left'>CONTRAPARTE 'PERSONA JURÍDICA<div class='opc' id='cancelarcontraparte' onclick='CancelarContraparte()' style='display:none;float:right'>Cancelar</div><div class='opc' id='savecontraparte' onclick='GuardarContraparte()' style='display:none;float:right'>Guardar</div></div>"+
						"<form id='fnewcontraparte'>"+
							"<table class='right'>"+
								"<tr class='par'>"+
						      		"<td>Nombre <span class='obligatorio'>*</span></td>"+
						      		"<td><input name='p_nombre' type='text'></td>	"+
						      	"</tr>"+
						      	"<tr class='impar'>"+
						      		"<td>Numero de Identificación <span class='obligatorio'>*</span></td>"+
						      		"<td><input name='cedula' type='text'></td>	"+
						      	"</tr>"+
						      	"<tr class='par'>"+
						      		"<td>Lugar de Registro</td>"+
						      		"<td><input name='exp_identificacion' type='text'></td>	"+
						      	"</tr>"+
						      	"<tr class='impar'>"+
						      		"<td>Teléfono</td>"+
						      		"<td><input name='telefonos' type='text' class='tags'></td>	"+
						      	"</tr>"+
						      	"<tr class='par'>"+
						      		"<td>Email <span class='obligatorio'>*</span></td>"+
						      		"<td><input name='email' type='text' class='tags'></td>	"+
						      	"</tr>"+
						      	"<tr class='impar'>"+
						      		"<td>Direccion</td>"+
						      		"<td><input name='direccion[]' type='text'></td>	"+
						      	"</tr>"+
						      	"<tr class='par'>"+
						      		"<td>Ciudad</td>"+
						      		"<td><input name='ciudad[]' type='text'></td>	"+
						      	"</tr>"+
						      	"<tr class='impar'>"+
						      		"<td>Nombre del Representante Legal</td>"+
						      		"<td><input name='s_apellido' type='text'></td>	"+
						      	"</tr>"+
						      	"<tr class='par'>"+
						      		"<td>Ciudad del Representante Legal</td>"+
						      		"<td><input name='departamento' type='text'></td>	"+
						      	"</tr>"+
				      		"</table>"+
				      	"</form>";
		$('#list_contraparte').html(content);
		
		$("#newcontraparte").css("display", "none");
		$("#savecontraparte").css("display", "block");
		$("#cancelarcontraparte").css("display", "block");

	}
	$(document).ready(function() {

		$('.datepicker').datepicker({
			dateFormat: 'yy-mm-dd',
			monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio', 'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
			dayNames: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'], // For formatting
			dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'], // For formatting
			dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa'] // Column headings for days starting at Sunday				
		});
	});
</script>


<style type="text/css">
	
.title span:hover{
	text-decoration: underline;
}

</style>