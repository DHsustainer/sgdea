<?    
	if ($_SESSION['ventanilla'] != "1") {
?>    
		<div class="col-md-12">
			<div class="alert alert-warning" >No tiene permiso para entrar a esta sección.</div>
		</div>
<?
	exit;
    }

global $c;
?>
<script type="text/javascript">
  $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip(); 
        $('[data-toggle="popover"]').popover()
  });
</script>

<link rel='stylesheet' type='text/css' href='<?= HOMEDIR.DS ?>app/plugins/select2/css/select2.min.css'/>
<script language='javascript' type='text/javascript' src='<?= HOMEDIR.DS ?>app/plugins/select2/js/select2.min.js'></script>
<div>
	<div class="row m-t-30 p-b-30" >
		<div class="col-md-3" style="margin: 0px;">
			<h4 >Sistema de Reparto Dinamico: <?= $c->ayuda('169') ?></h4>
		</div>
	</div>
	<form method="POST" id="filtroreparto">
		<div class="row">
			<div class="col-md-2">
				<h4 >Fecha de Inicio</h4>
			</div>
			<div class="col-md-2">
				<h4 >Fecha Fin</h4>
			</div>
			<div class="col-md-2">
				<h4 >Estado</h4>
			</div>
			<div class="col-md-2">
				<h4 >Responsables Actuales</h4>
			</div>
			<div class="col-md-2">
				<h4 >Formulario</h4>
			</div>
			<div class="col-md-2">
				<h4 >Suscriptor</h4>
			</div>
		</div>
		<?
		$style = "display: inline-block; height: 40px; padding: 4px;font-size: 14px;line-height: 20px;color: #555555;vertical-align: middle;-webkit-border-radius: 4px;-moz-border-radius: 4px;border-radius: 4px;";
		?>
		<div class="row">
			<div class="col-md-2">
				<input type="date" placeholder="" value="<?= date("Y-m-d") ?>"  id="f_fi" name="f_fi" class="form-control">
			</div>
			<div class="col-md-2">
				<input type="date" placeholder="" value="<?= date("Y-m-d") ?>" id="f_ff" name="f_ff" class="form-control">
			</div>
			<div class="col-md-2">
				<select name="estado" id="estado"   class="form-control">
					<option value="Pendiente">Pendiente</option>
					<option value="*">Todos</option>
					<option value="Abierto">Abierto</option>
					<option value="Cerrado">Cerrado</option>
					<option value="En Espera Correccion">En Espera Correccion</option>
					<option value="Rechazado">Rechazado</option>
				</select>
			</div>
			<div class="col-md-2">
				<select name="responsable" id="responsable"   class="form-control">
					<option value="me">Yo</option>
					<option value="*">Todos los Usuarios de mi Area</option>
				</select>
			</div>
			<div class="col-md-2">
				<select name="formulario" id="formulario"   class="form-control">
					<option value='*'>Todos</option>
					<?
						$tipo_d = $con->Query("select id from dependencias where es_publico = '1'");
						while ($row = $con->FetchAssoc($tipo_d)) {
							$d = new MDependencias;
							$d->CreateDependencias("id", $row['id']);
							echo "<option value='".$d->GetId()."'>".$d->GetTitulo_publico()."</option>";
						}
					?>
				</select>
			</div>
			<div class="col-md-2">
				<select name="suscriptor" id="suscriptor" class="select2_1"  class="form-control" style="width:150px">
					<option value="*">Todos</option>
					<?
						$tipo_d = $con->Query("select * from suscriptores_contactos where dependencia = '0'");
						while ($row = $con->FetchAssoc($tipo_d)) {
							echo "<option value='".$row['id']."'>".$row['nombre']."</option>";
						}
					?>
				</select>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<hr>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<h4 >Con Quien Desea Distribuir los Expedientes: <?= $c->ayuda('170') ?></h4>
			</div>
		</div>
		<div class="row" >
			<div class="col-md-12">
<?


		$regimen = $_SESSION['area_principal'];
		$id = $_SESSION['seccional'];

			$q_str = "SELECT u.a_i, concat(p_nombre, ' ', s_nombre, ' ', p_apellido, ' ', s_apellido) as nombre
			FROM `usuarios_configurar_accesos` uc inner join usuarios u on uc.id_tabla = concat(u.a_i,'".$regimen."','".$id."') 
			where  uc.tabla = 'usuario' and u.estado = '1'
			group by  u.a_i"; 

		$lits = $con->Query($q_str);

		while ($row = $con->FetchAssoc($lits)) {

			$nombre = ucwords(strtolower($row['nombre']));
			echo '	<label style="margin-right:20px; margin-bottom:10px; cursor:pointer"><input type="checkbox" value="'.$row['a_i'].'" name="usuarios[]" id="users'.$row['a_i'].'" style="margin-right:5px">'.$nombre.'</label>';


			#"<option value='".$row['a_i']."' $select>".$nombre."</option>";

		}

?>				
			</div>
		</div>
		<div class="row m-b-30" >
			<div class="col-md-12">
				<button type="button" class="btn btn-primary" onclick="BtnRepartir()">Distribuir Expedientes</button>
			</div>
		</div>
	</form>
	<div class="row m-b-30" >
		<div class="col-md-12" id="loaderreparto"></div>
	</div>
</div>

<script type="text/javascript">
	
	function BtnRepartir(){
	    var URL = '/gestion/getreparto/';
	    var str = $("#filtroreparto").serialize();
	    $.ajax({
	        type: 'POST',
	        url: URL,
	        data: str,
	        success:function(msg){
	        	$("#loaderreparto").html(msg)
	        }
	    });   
	}
	(function($) {
		if ($('.select2_1').length) $(".select2_1").select2();
	})(jQuery);


</script>