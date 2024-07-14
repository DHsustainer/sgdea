<?
	if ($_SESSION['areas_trabajo'] == "0") {
		header("LOCATION: ".HOMEDIR.trim(" /dashboard/"));
	}
?>
<script type="text/javascript">
	$(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip(); 
        $('[data-toggle="popover"]').popover()
	});
</script>
<h2>Configuracion de <?= CAMPOAREADETRABAJO; ?> <?= $c->Ayuda('135') ?></h2>
<div class="row">
	<div class="col-md-4">
		<label class="p-t-10" >Version de la Tabla de Retención Documental: <?= $c->Ayuda('136') ?></label>
	</div>
	<div class="col-md-3">
       	<select  name='id_trd' id='id_trd' class="form-control" onchange="ChangeEmpresaTRD()" >
			<?php
			$MDependencias_version = new MDependencias_version;
			$lits = $MDependencias_version->ListarDependencias_version();
			$i = 0;
			while ($row = $con->FetchAssoc($lits)) {
				$i++;
				$select = "";
				if($_SESSION['id_trd'] == $row['id']){
					$select = "selected";
				}
				echo "<option value='".$row['id']."' $select>".$row["nombre"]."</option>";
			}
			if ($i == 1) {
				$_SESSION['id_trd'] == $row['id'];
			}
			?>
		</select>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
<?
	if ($i == 0) {
		echo '<br><br><br><div align="center" class="alert alert-warning" style="font-size:20px">No hay Versiones Editables Registradas</div><br><br><br>';
	}else{
	
?>
	<div class="row m-t-30">
		<div class="col-md-6">
			<?
			if ($_SESSION['usuario'] != "sanderkdna@gmail.com") {
				# code...
				include(VIEWS.DS."areas".DS."FormInsertAreas.php");
			}
			?>	
		    <h4 class="m-t-30"><b>Listado de <?= CAMPOAREADETRABAJO; ?></b></h4>
		    <div id="listadoareas">
			<?
				$areas = new MAreas;

				$query = $areas->ListarAreas();	    
				include(VIEWS.DS."areas".DS."Listar.php");
			?>	
		    </div>
		</div>
		<div class="col-md-6">
			<h4 ><b>Configurar <?= CAMPOAREADETRABAJO; ?></b></h4>
	        <div class="table" id="configarea">
				<div class="alert alert-info">Seleccione una <?= CAMPOAREADETRABAJO; ?></div>
			</div>
		</div>
	</div>
	
<?
	}
?>
					
	</div>
</div>