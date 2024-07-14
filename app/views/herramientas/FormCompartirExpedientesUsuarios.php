<?php

	$MUsuarios = new MUsuarios;
	global $c;
?>
<script type="text/javascript">
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip(); 
        $('[data-toggle="popover"]').popover()
    });
</script>
<form id='FormCompartirExpedientesUsuarios' action='/herramientas/RegistrarCompartirExpedientesUsuarios/' method='POST'> 
	<h2 class="m-t-30 m-b-30">COMPARTIR EXPEDIENTES DE FORMA MASIVA</h2>
	<table class="table">
		<tr>
			<td><b>Usuario Proprietario de los Expedientes: <?= $c->Ayuda('220') ?></b></td>
			<td>
				<select id="usuariop" name="usuariop" class="form-control">
					<option value="">Selecciona un Usuario</option>
					<option value="TODOS">TODOS</option>
					<?php
					$query = $MUsuarios->ListarUsuarios(" where estado = '1'");
					while($row = $con->FetchAssoc($query)){
						echo "<option value='$row[a_i]'>$row[p_nombre] $row[s_nombre] $row[p_apellido] $row[s_apellido]</option>";
					} 
					?>
				</select>
			</td>
		</tr>
		<tr>
			<td><b>Compartir Desde: <?= $c->Ayuda('221') ?></b></td>
			<td><input type="date" class="form-control datepicker" id="fecha_i"  name="fecha_i" placeholder="Fecha de Inicio"></td>
		</tr>
		<tr>
			<td><b>Compartir Hasta: <?= $c->Ayuda('222') ?></b></td>
			<td><input type="date" class="form-control datepicker" id="fecha_f"  name="fecha_f" placeholder="Fecha de Corte"></td>
		</tr>
	 	<tr>
			<td><b>Usuario para Compartir los Expedientes: <?= $c->Ayuda('223') ?></b></td>
			<td>
				<select id="usuariod" name="usuariod" class="form-control">
					<option value="">Selecciona un Usuario</option>
					<?php
					$query = $MUsuarios->ListarUsuarios(" where estado = '1'");
					while($row = $con->FetchAssoc($query)){
						echo "<option value='$row[a_i]'>$row[p_nombre] $row[s_nombre] $row[p_apellido] $row[s_apellido]</option>";
					} 
					?>
				</select>
			</td>
		</tr>
	 	<tr>
			<td><b>Usuario a compartir puede: <?= $c->Ayuda('224') ?></b></td>
			<td>
				<select class="form-control" name="type" id="type">
					<option value="0">El Usuario solo puede Consultar</option>
					<option value="1">El Usuario puede Interactuar</option>
				</select>
			</td>
		</tr>
	 	<tr>
			<td><b>Fecha de Caducidad del Permiso: <?= $c->Ayuda('225') ?></b></td>
			<td>
				<input type="date" class="form-control datepicker" id="fecha_caducidad"  name="fecha_caducidad" placeholder="Fecha de Caducidad del Permiso">
			</td>
		</tr>
		<tr>
			<td colspan="2"><input type="button" value="Compartir Expedientes" class="btn btn-info" onclick="RegistrarCompartirExpedientesUsuarios()"></td>
		</tr>
	</table>
</form>
