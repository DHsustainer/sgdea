
<form id='FormUpdatedependencias_version' action='/dependencias_version/actualizar/' method='POST'> 
	<h2>EDITAR VERSION: <?= $object->Getnombre() ?> </h2>
		<input type='hidden' name='id' id='id' value='<? echo $object -> GetId(); ?>' />
		<input type='text' class='form-control' placeholder='nombre' name='nombre' id='nombre' maxlength='' value='<? echo $object -> Getnombre(); ?>' />
		
		<select name='estado' id='estado' class="form-control m-t-10 m-b-10" <?= ($object->Getestado() == "1")?"disabled":"" ?>>
			<?
				$opt = new MEstadosx;
				$opt->CreateEstadosxbyTipo($object->Getestado(), 'tipo_version');

				echo '<option value="'.$opt->GetValor().'">'.$opt->GetNombre().'</option>';
			
				$s = $con->Query("select * from estadosx where 
									tipo = 'tipo_version' and valor not in ('".$object->Getestado()."', '1')");
				while ($row = $con->FetchAssoc($s)) {
					echo '<option value="'.$row['valor'].'">'.$row['nombre'].'</option>';
				}
			?>
		</select>
		<input type='button' class="btn btn-info" value='Actualizar' onclick="UpdateVERSIONES()" />
		<br><br>
		<input type='button' class="btn btn-warning" value='Clonar Versión' onclick="ClonarVersion('<? echo $object -> GetId(); ?>','<? echo $object -> Getnombre(); ?>')" />
</form>
<hr>