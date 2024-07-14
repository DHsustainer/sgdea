<?
global $c;
?>
<script type="text/javascript">
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip(); 
        $('[data-toggle="popover"]').popover()
    });
</script>

<?
	if ($_SESSION['usuarios'] == "0" && $_SESSION['permisos_usuarios'] == "0" && $_SESSION['t_cuenta'] == "0" && $_SESSION['sadmin'] == "0") {
		header("LOCATION: ".HOMEDIR.trim(" /dashboard/"));
	}

	$usn = new MUsuarios;
	$usn->CreateUsuarios("user_id", $_SESSION['usuario']);

	$s = new MSuper_admin;
	$s->CreateSuper_admin("id", $usn->GetId_empresa());

	$total_usuarios = $s->GetTotalUsuarios($s->GetId());
	$usuarios_activos = $s->GetTotalUsuariosActivos($s->GetId());
	$cupos_totales = 0;
	if ($_SESSION['MODULES']['total_usuarios'] == "0") {
		$cupos_totales = 9999; 	
	}else{
		$cupos_totales = $_SESSION['MODULES']['total_usuarios'];
	}

	if ($cupos_totales > $usuarios_activos) {
		if ($_SESSION['MODULES']['demandas_en_linea'] != '1'){
			echo '<div class="row"><div class="col-md-12"><div class="btn btn-info btn-lg m-b-20 pull-right md-trigger" data-modal="modal-1" '.$c->Ayuda('178', 'tog').'>Crear Cuenta de Usuario</div></div></div>';
		}else{
			if ($_SESSION['tech_support'] == '1') {
				echo '<div class="row"><div class="col-md-12"><div class="btn btn-info btn-lg m-b-20 pull-right md-trigger" data-modal="modal-1" '.$c->Ayuda('178', 'tog').'>Crear Cuenta de Usuario</div></div></div>';
			}
		}
	}else{
		echo '<div class="row"><div class="col-md-12"><div class="text-muted m-b-20 pull-right"  '.$c->Ayuda('179', 'tog').'>No tienes cupos disponibles</div></div></div>';
	}
?>
<div class="row">
	<div class="col-md-4 bg-success text-white bold p-10" <?= $c->Ayuda('182', 'tog') ?>>Cupo Total <?= $cupos_totales; ?></div>
	<div class="col-md-4 bg-info text-white bold p-10" <?= $c->Ayuda('183', 'tog') ?>>Usuarios Registrados: <?= $total_usuarios; ?></div>
	<div class="col-md-4 bg-danger text-white bold p-10" <?= $c->Ayuda('184', 'tog') ?>>Usuarios Activos: <?= $usuarios_activos ?></div>
</div>	
<div class="row">
<?php 
	
	if ($_SESSION['sadmin'] == "1") {
		$ro = $con->Query("select seccional from usuarios group by seccional");
	}else{
		$ro = $con->Query("select seccional from usuarios where seccional = '".$usn->GetSeccional()."' group by seccional");
	}


	while ($rox = $con->FetchAssoc($ro)) {
		$s = new MSeccional;
		$s->CreateSeccional("id", $rox['seccional']);

		$sp = new MSeccional_principal;
		$sp->CreateSeccional_principal("id", $s->GetPrincipal());

		echo '<div class="col-md-12">';

		echo "<h3>".$sp->GetNombre()." - ".$s->GetNombre()."</h3>";

		$ror = $con->Query("select regimen from usuarios where seccional = '".$rox['seccional']."' group by regimen");
		echo '<table class="table table-striped">
				<thead>
					<tr>
						<th></th>
						<th>Nombre</th>
						<th>Email</th>
						<th></th>
						<th></th>
					</tr>
				</thead>';
		while ($roxr = $con->FetchAssoc($ror)) {

			$area = $roxr['regimen'];
			$ar = new MAreas;
			$ar->CreateAreas("id", $area);
			#echo '<div class="row p-l-20">';
			#echo '<div class="col-md-12">';
			#echo "<H4><b>".$ar->GetNombre()."</b></H4>";
			$usuarios=$con->Query("SELECT * from usuarios where seccional = '".$rox['seccional']."' and regimen = '".$roxr['regimen']."'");
			#echo '<div class="row p-l-20">';
			while ($col = $con->FetchAssoc($usuarios)) { 


				$stat = $col['estado'];

				if ($stat == "1") {
					$stat = 'activo';
				}elseif ($stat == '0') {
					$stat = 'inactivo';
				}

				$area = $col['regimen'];
				$area = $c->GetDataFromTable("areas", "id", $area, "nombre", " ");
	?>

				<tr>
					<td>
						<img src="<?= HOMEDIR.DS.'app/plugins/thumbnails/'.$col[foto_perfil] ?>" width="50px" alt="">
					</td>
					<td>
						<b><?="$col[p_nombre] $col[p_apellido]"?></b><br>
						<em><?= $area ?></em>
					</td>
					<td>
						<?=$col[email]?>
					</td>
					<td>
						<?
							#$_SESSION['id_empresa'];
							if ($col['estado'] == '1') {
								echo "<label><input type='checkbox' onChange='ActivarUsuario(\"".$col['a_i']."\")' id='us_$col[a_i]' checked='checked' ".$c->Ayuda('180', 'tog').">Desactivar Usuario</label>";
							}else{
								echo "<label><input type='checkbox' onChange='ActivarUsuario(\"".$col['a_i']."\")' id='us_$col[a_i]'>Activar Usuario</label>";
							}
						?>
					</td>
					<td>
						<?
							if ($_SESSION['sadmin'] == "1") {
								if ($col[user_id] != 'sanderkdna@gmail.com') {
									
						?>
								<a href="/herramientas/editarperfil/<?= $col[user_id] ?>/" class="btn btn-info m-t-10 m-b-10" <?= $c->Ayuda('181', 'tog') ?>>Editar Perfil</a>
						<?
								}else{
									if ($_SESSION['tech_support'] == '1') {
						?>
										<a href="/herramientas/editarperfil/<?= $col[user_id] ?>/" class="btn btn-info m-t-10 m-b-10" <?= $c->Ayuda('181', 'tog') ?>>Editar Perfil</a>
						<?
									}
								}
							}
						?>
					</td>
				</tr>
				
<?php 
			}

		} 
		echo '</tbody></table>';
		echo '</div>';
	}
?>
</div>
<div class="md-modal md-effect-1" id="modal-1">
	<div class="md-content">
		<form id="formurusuario" method="POST" action="/herramientas/registrar/"  onsubmit="return CheckImportantes('formurusuario')" class="p-20">
			<h2>CREAR NUEVA CUENTA DE USUARIO</h2>
			<div class="row">
				<div class="col-md-6">
					<div class="form-item">
			      		<label class="col-md-12" for="">Primer Nombre <span class="obligatorio">*</span></label>
			      		<input type="text" class="form-control important"  placeholder="Nombre" name="pnombre">
			      	</div>
				</div>
				<div class="col-md-6">
			      	<div class="form-item">
			      		<label class="col-md-12" for="">Primer Apellido <span class="obligatorio">*</span></label>
			      		<input type="text" class="form-control important"  placeholder="Apellido" name="papellido">
			      	</div>
				</div>
			</div>
			<div class="row m-t-10">
				<div class="col-md-6">
			      	<div class="form-item">
			      		<label class="col-md-12" for="">Identificación <span class="obligatorio">*</span></label>
			      		<input type="text" class="form-control important"  placeholder="Identificacion" name="id">
			      	</div>
				</div>
				<div class="col-md-6">
			      	<div class="form-item">
			      		<label class="col-md-12" for="">Ciudad </label>
			      		<input type="text"  placeholder="ciudad" name="ciudad" class="form-control">
			      	</div>
				</div>
			</div>
			<div class="row m-t-10">
				<div class="col-md-4">
			      	<div class="form-item">
			      		<label class="col-md-12" for="">E-mail <span class="obligatorio">*</span></label>
			      		<input type="text"  class="important form-control" placeholder="Direccion de Correo" name="email" maxlength="50">
			      	</div>
				</div>
				<div class="col-md-6">
			      	<div class="form-item" style="display:none">
			      		<label class="col-md-12" for="">Departamento </label>
			      		<input type="text"  placeholder="departamento" name="departamento" class="form-control">	
			      	</div>
				</div>
				<div class="col-md-4">
			      	<div class="form-item">
			      		<label class="col-md-12" for="">Dirección </label>
			      		<input type="text"  placeholder="direccion" name="direccion" class="form-control">
			      	</div>
				</div>
				<div class="col-md-4">
			      	<div class="form-item">
			      		<label class="col-md-12" for="">Celular </label>
			      		<input type="text"  placeholder="celular" name="celular" class="form-control">
			      	</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<hr>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-item">
			      		<label class="col-md-12" for="">Departamento </label>
			      		
							<select id="departamentolistado" placeholder="departamentolistado" class="form-control">
								<option value="">Seleccione un Departamento</option>
							</select>
			      	</div>
				</div>
				<div class="col-md-6">
			      	<div class="form-item">
			      		<label class="col-md-12" for="">Seccional Principal</label>
			      		
			      			<select id="spadre" placeholder="Ciudad" class="important form-control" name="spadre">
			      				<option value="">Seleccione una Ciudad</option>
							</select>		
			      	</div>
				</div>
			</div>
			<div class="row m-t-10">
				<div class="col-md-6">
			      	<div class="form-item">
			      		<label class="col-md-12" for="">Oficina</label>
			      		
			      			<select id="seccional" placeholder="Oficina" class="important form-control" name="seccional">
								<option value="">Seleccione una Oficina</option>
							</select>		
			      	</div>
				</div>
				<div class="col-md-6">
			      	<?
							$cy = new MCity;
							$cy->CreateCity("code", $_SESSION['ciudad']);

					?>
			      	<div class="form-item">
			      		<label class="col-md-12" for=""><?= CAMPOAREADETRABAJO; ?></label>
			      		
							<select id="area" placeholder="<?= CAMPOAREADETRABAJO; ?>" class="important form-control" name="area">
								<option value="">Seleccione una Oficina</option>
								<?
									$s = new MAreas;
									$lits = $s->ListarAreas();
									while ($row = $con->FetchAssoc($lits)) {
										echo "<option value='".$row['id']."'>".$row["nombre"]."</option>";
									}
								?>
							</select>		
			      	</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<hr>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
			      	<div class="form-item">		 
			      		<label class="col-md-12" for="">Activar Fecha de Caducidad</label>
			      		
							<select id="t_persona" placeholder="t_persona"  class="form-control">
								<option value="NO">NO</option>
								<option value="SI">SI</option>
							</select>
			      	</div>
				</div>
				<div class="col-md-4">
					<div class="form-item">
			      		<label class="col-md-12" for="">Seleccione la Fecha de Caducidad</label>
			      		<input type="date"  placeholder="f_vencimiento" name="f_vencimiento" class="form-control">
			      	</div>
				</div>
				<div class="col-md-4">
					<div class="form-item">
			      		<label class="col-md-12" for="">Seccional Para Correspondencia</label>
			      		<input type="text"  placeholder="seccional_siamm" name="seccional_siamm" class="form-control" value="<?= $usn->GetSeccional_siamm() ?>">
			      	</div>
				</div>
			</div>
			<div class="row m-t-20">
				<div class="col-md-6">
					<input type="submit" class="btn btn-info" value="Registrar Usuario">	
				</div>
				<div class="col-md-6">
	      			<input type="button" class="btn btn-default md-close" value="Cerrar">
				</div>
			</div>
			<input type='hidden'  placeholder='mydpto' id='mydpto' value="<?= $cy->GetProvince() ?>" />
			<input type='hidden'  placeholder='mycity' id='mycity' value="<?= $cy->GetCode() ?>" />
		</form>
	</div>
</div>
<div class="md-overlay"></div>

<script>
$(document).ready(function(){

	//Declare begin
	$('.md-trigger').modalEffects();
	//Declare end

	dependencia_estadoinExistence('departamentolistado');
	$("#departamentolistado").change(function(){
		dependencia_ciudadinExistence("departamentolistado","spadre");
	});

	$("#spadre").change(function(){
		dependencia_item("spadre","seccional", "/seccional/listadooficinasseccional");
		$("#num_oficio_respuesta").val(zeroFill($("#spadre").val(), 3));
	});

	$("body").css("cursor", "wait");
	setTimeout(function(){
		$("#departamentolistado option[value="+ $("#mydpto").val() +"]").attr("selected",true);
	}, 1000);
	setTimeout(function(){
		dependencia_ciudadinExistence("departamentolistado","spadre");
	}, 2000);
	setTimeout(function(){
		$("#spadre option[value="+ $("#mycity").val() +"]").attr("selected",true);
		dependencia_item("spadre","seccional", "/seccional/listadooficinasseccional");
		$("#num_oficio_respuesta").val(zeroFill($("#spadre").val(), 3));
		$("body").css("cursor", "default");
	}, 3000);

});
</script>