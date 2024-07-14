<h3 style="text-transform: uppercase;">LISTADO DE <?= SUSCRIPTORCAMPONOMBRE." ".TITULOSEGUIMIENTOSUSCRIPTORES ?>S</h3>
<?
	$g = new MGestion;
	$g->CreateGestion("id", $id);

	if ($tipo_seguimiento == "") {
		$tipo_seguimiento = ESTADOSEGUIMIENTOSUSCRIPTORES;
	}

	$object = new MGestion_suscriptores;

	$str = "select gestion_suscriptores.id, gestion_suscriptores.id_suscriptor, gestion_suscriptores.aviso  from gestion_suscriptores inner join suscriptores_contactos on suscriptores_contactos.id = gestion_suscriptores.id_suscriptor where gestion_suscriptores.id_gestion = '".$id."' and suscriptores_contactos.type = '".$tipo_seguimiento."'";
	$query = $con->Query($str);

echo '
		<div class="row m-t-30 m-b-30">
			<div class="col-md-6"><label for="tiposiscriptorform">Seleccione un tipo de '.SUSCRIPTORCAMPONOMBRE.'</label></div>
			<div class="col-md-4">
				<select id="tiposiscriptorform" class="form-control">';

			$q = new MSuscriptores_tipos;
			$qq = $q->ListarSuscriptores_tipos();
			while ($row = $con->FetchAssoc($qq)) {
				$sel = ($row['id'] == $tipo_seguimiento)?"selected='selected'":"";
				echo '<option value="'.$row['id'].'" '.$sel.'>'.$row['nombre'].'</option>';
			}

echo '				</select>
			</div>
			<div class="col-md-2"><button type="button" class="btn btn-primary" onclick="BuscarAvisos(\''.$id.'\')"><span class="fa fa-search"></span></buton></div>
		</div>';

echo '<table class="table table-striped">
		<thead>
			<tr>
				<th style="text-transform: uppercase;">'.SUSCRIPTORCAMPONOMBRE.'</th>
				<!--<th style="text-transform: uppercase;">Tipo de <br>'.SUSCRIPTORCAMPONOMBRE.'</th>-->
				<th style="text-transform: uppercase;">'.TITULOSEGUIMIENTOSUSCRIPTORES.'</th>
				<th style="text-transform: uppercase;">Fecha de <br>'.TITULOSEGUIMIENTOSUSCRIPTORES.'</th>
				<th style="text-transform: uppercase;">Observacion</th>
				<th></th>
			</tr>
		</thead>
		<tbody>';

	$i = 0;
	while($row = $con->FetchAssoc($query)){

		$i++;

		$sus = new MSuscriptores_contactos;
		$sus->CreateSuscriptores_contactos("id", $row['id_suscriptor']);

		$susd = new MSuscriptores_contactos_direccion;
		$susd->CreateSuscriptores_contactos_direccion("id_contacto", $sus->GetId());

		$lx = new MSuscriptores_tipos;
		$lx->CreateSuscriptores_tipos("id", $sus->GetType());

		$sn = ($row['aviso'] == "NO")?"selected='selected'":"";
		$ss = ($row['aviso'] == "SI")?"selected='selected'":"";

		echo "	<tr>
					<td>".$sus->GetNombre()."</td>
					<!--<td>".$lx->GetNombre()."</td>--> 
					<td>".$row['aviso']."</td>
					<td>".$row['fecha_aviso']."</td>
					<td>".$row['observacion']."</td>
					<td>
						<button type='button' onclick='LoadModal(\"\",  \"Actualizar Estado de ".TITULOSEGUIMIENTOSUSCRIPTORES." - ".$sus->GetNombre()."\", \"/gestion_suscriptores/cambiaraviso/".$row['id']."/\")' class='btn btn-primary btn-sm'><span class='mdi mdi-eye'></span></button>
					</td>
				</tr>";
	}
	if ($i == 0) {
		echo '<tr><td colspan="4"><div class="alert alert-info">No hay '.SUSCRIPTORCAMPONOMBRE.' de este tipo en este proceso</div></td></tr>';
	}
	echo '</tbody></table>';
?>
<script>
	
	function CambiarAvisoSuscriptor(){

		valor = $("#estadoaviso").val();
		str = $("#formupdateavisos").serialize();
		if(confirm('Esta seguro desea marcar este(a) <?= SUSCRIPTORCAMPONOMBRE ?> como "'+valor+'" <?= TITULOSEGUIMIENTOSUSCRIPTORES ?>')){
			var URL = '/gestion_suscriptores/cambiarestadoaviso/';
			$.ajax({
				type: 'POST',
				data: str,
				url: URL,
				success: function(msg){
					alert(msg);
					window.location.reload();
				}
			});
		}
	}

	function BuscarAvisos(id){
		idseguimiento = $("#tiposiscriptorform").val();
		showfiles('/gestion/Getseguimiento/'+id+'/'+idseguimiento+"/", 'cargador_box_seguimiento');
	}
</script>
