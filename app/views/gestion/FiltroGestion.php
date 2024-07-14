<div class="panel panel-default block1 m-t-30">
    <div class="panel-heading">Filtrar Gestión por:</div>
    <div class="panel-wrapper collapse in">
        <div class="panel-body">
			<div class="row">
				<div class="col-md-2">
					<h4>Fecha de Inicio</h4>
				</div>
				<div class="col-md-2">
					<h4>Fecha Fin</h4>
				</div>
				<div class="col-md-2">
					<h4>Estado</h4>
				</div>
				<div class="col-md-2">
					<h4>Prioridad</h4>
				</div>
				<div class="col-md-4"></div>
			</div>
			<form action="/gestion/cambiarfiltro/" method="POST">
				<?
				$style = "display: inline-block; height: 40px; padding: 4px;font-size: 14px;line-height: 20px;color: #555555;vertical-align: middle;-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;";
				?>
				<div class="row">
					<div class="col-md-2">
						<input type="hidden" value="<?= $_SERVER['REQUEST_URI'] ; ?>"  id="retorno" name="retorno">
						<input type="date" class="form-control" value="<?= $_SESSION['filtro_fi'] ?>"  id="f_fi" name="f_fi">
					</div>
					<div class="col-md-2">
						<input type="date" class="form-control" value="<?= $_SESSION['filtro_ff'] ?>" id="f_ff" name="f_ff">
					</div>
					<div class="col-md-2">
						<select name="estado" id="estado"  class="form-control">
							<option value="Todos" <?= ($_SESSION['filtro_estado'] == 'Todos')?"selected='selected'":'' ?> >Todos</option>
							<option value="Abierto" <?= ($_SESSION['filtro_estado'] == 'Abierto')?"selected='selected'":'' ?> >Abierto</option>
							<option value="Cerrado" <?= ($_SESSION['filtro_estado'] == 'Cerrado')?"selected='selected'":'' ?> >Cerrado</option>
							<option value="Pendiente" <?= ($_SESSION['filtro_estado'] == 'Pendiente')?"selected='selected'":'' ?> >Pendiente</option>
						</select>
					</div>
					<div class="col-md-2">
						<select name="prioridad" id="prioridad"  class="form-control">
							<option value="Todos" <?= ($_SESSION['filtro_prioridad'] == 'Todos')?"selected='selected'":'' ?> >Todos</option>
							<option value="2" <?= ($_SESSION['filtro_prioridad'] == '2')?"selected='selected'":'' ?> >Alta</option>
							<option value="1" <?= ($_SESSION['filtro_prioridad'] == '1')?"selected='selected'":'' ?> >Media</option>
							<option value="0" <?= ($_SESSION['filtro_prioridad'] == '0')?"selected='selected'":'' ?> >Baja</option>
						</select>
					</div>
					<div class="col-md-4">
						<button type="submit" class="btn btn-primary" <?= $c->Ayuda("70", 'tog') ?>>Filtrar Gestión</button>
					</div>
				</div>
			</form>
  		</div>
    </div>
</div>
<?
	$minfilt = "";
	if ($_SESSION['filtro_estado'] != "Todos") {
		$minfilt .= " AND estado_respuesta = '".$_SESSION['filtro_estado']."'";
	}
	if ($_SESSION['filtro_prioridad'] != "Todos") {
		$minfilt .= " AND prioridad = '".$_SESSION['filtro_prioridad']."'";
	}
	$pathfiltro = " AND f_recibido between '".$_SESSION['filtro_fi']."' and '".$_SESSION['filtro_ff']."' $minfilt";


?>
<!--
<div class="panel panel-default block1 m-t-30">
    <div class="panel-heading"></div>
    <div class="panel-wrapper collapse in">
        <div class="panel-body">
        </div>
    </div>
</div>
-->