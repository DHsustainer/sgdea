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
<form id='FormTransferirExpedientesUsuarios' action='/herramientas/RegistrarTransferirExpedientesUsuarios/' method='POST'> 
	<h2 class="m-t-30 m-b-30">TRANSFERIR EXPEDIENTES DE FORMA MASIVA</h2>
	<table class="table">
		<tr>
			<td><b>Transferir: <?= $c->Ayuda('226') ?></b></td>
			<td>
				<select id="transferir_por" name="transferir_por" class="form-control" >
					<option value="Propietario">Propietario</option>
					<option value="Usuario que registra">Usuario que registra</option>
				</select>
			</td>
		</tr>
		<tr>
			<td><b>Transferir desde: <?= $c->Ayuda('227') ?></b></td>
			<td><input type="date" id="fechai" name="fechai" class="form-control" placeholder="Fecha de Inicio:"></td>
		</tr>
		<tr>
			<td><b>Transferir hasta: <?= $c->Ayuda('228') ?></b></td>
			<td><input type="date" id="fechaf" name="fechaf" class="form-control" placeholder="Fecha de Final:"></td>
		</tr>
		<tr>
			<td><b>Usuario de los Expedientes(origen): <?= $c->Ayuda('229') ?></b></td>
			<td>
				<select id="usuariop" name="usuariop" class="form-control" >
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
			<td><b>Usuario ha Transferir los Expedientes(destino): <?= $c->Ayuda('230') ?></b></td>
			<td>
				<select id="usuariod" name="usuariod" class="form-control" >
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
			<td colspan="2">
				<input type="button" value="Transferir Expedientes" class="btn btn-info" onclick="RegistrarTransferirExpedientesUsuarios()">
			</td>
		</tr>
	</table>
</form>