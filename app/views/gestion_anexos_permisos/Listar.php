	<?
		$estado = array("0" => "Pendiente por Revisar", "1" => "Aprobado", "2" => "Rechazado");
		$estado2 = array("0" => "pendiente", "1" => "aprobado", "2" => "rechazado");
		global $c;
		global $f;
	?>
	<div class="descripcion <?= $estado2[$objectgap->GetEstado()] ?>">
		<b>Estado: </b><?= $estado[$objectgap->GetEstado()] ?><br>
		<?
			$revisado = $c->GetDataFromTable("usuarios", "user_id", $objectgap->GetUsuario_permiso(), "p_nombre, p_apellido", $separador = " ");
			if ($objectgap->GetEstado() == 0) {
		?>
				<b>Revisado por: </b><?= $revisado ?> <b>Pendiente por revision</b><br>
		<?							
			}else{
		?>
				<b>Revisado por: </b><?= $revisado ?> el <em><?= $f->ObtenerFecha4($objectgap->GetFecha_actualizacion()) ?></em><br>
		<?				
			}			
		?>
		<b>Observación:</b><br>
		<div class="addmargin">
			<? echo $objectgap -> Getobservacion(); ?>
		</div>
	</div>

<style type="text/css">
	.descripcion {
	    margin: 10px;
	    border: 1px dashed #EDEDED;
	    background-color: #F7F7F7;
	    padding: 10px;
	    line-height: 25px;
	}

	.descripcion.pendiente{
		border: 3px dashed #CCC;
	}

	.descripcion.aprobado{
		border: 3px dashed #24C279;
	}

	.descripcion.rechazado{
		border: 3px dashed #CC3300;
	}

	.addmargin{
		margin-left: 15px;
	}

</style>
