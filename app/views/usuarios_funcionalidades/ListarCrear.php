<?php 
include_once(MODELS.DS.'Usuarios_funcionalidadesM.php');
?>

	<form id='formbdata'>
	<!--<div class='title right'>Listado de Permisos</div>-->
		<div class="list-group" id='Tablausuarios_funcionalidades' style="width:400px">
			<div class="list-group-item disabled"> <b>PERMISOS DE GESTION</b></div>

			
<?
		$l = new MUsuarios_funcionalidades;
		$qe = $l->ListarUsuarios_funcionalidadesCrear('user_id', $object->GetUser_id(), "0");
		while($row = $con->FetchAssoc($qe)){
			$mostrar_elemento = "";

			switch ($row["id"]) {
				case '11':
					if ($_SESSION['MODULES']['workflow'] == "0"){
						$mostrar_elemento = "style='display:none'";
					}
					break;
				case '12':
					if ($_SESSION['MODULES']['radicacion_externa'] == "0"){
						$mostrar_elemento = "style='display:none'";
					}
					break;
				
				default:
					$mostrar_elemento = "";
					break;
			}
			$valortext = 'off';
			if($row['valor'] == 1){
				$valortext = 'on';
			}
?>			
			<div class="list-group-item" <? echo $mostrar_elemento  ?> >
				<span style="font-size:14px">
					<?php echo $row['nombre']; ?>
				</span>
				<span style="float:right;"  id="option<?= $row[id]; ?>" data-role="<?= ($row[valor]== '1')?'0':'1' ?>" onclick='EditarSuscriptores_funcionalidades(<?= $row[id]; ?>)' title="Activar/Desactivar Permiso" class="mdi mdi-toggle-switch<?= ($row[valor]== '1')?' text-success':'-off text-muted' ?> icon"></span>
				<?php
	                if ($row['ayuda'] != "") {
                    	echo "<span data-toggle='tooltip' title='".$row["ayuda"]."' class='mdi mdi-comment-question-outline' style='font-size:14px; float:right; margin-right:40px; margin-top:2px'></span>";  
                    }
				?>
			</div>
<?
		}

		$usn = new MUsuarios;
		$usn->CreateUsuarios("user_id", $_SESSION['usuario']);
		if ($usn->GetIsSuperAdministrador() == "1") {

			?>
			<div class="list-group-item disabled"> <b>PERMISOS ADMINISTRATIVOS</b></div>
			<div class="list-group-item">
				<span  style="font-size:14px">Jefe de Area</span>
				<span style="float:right"  id="option1<?= $object->GetA_i(); ?>" data-role="<?= ($object->GetIsAdministrador()== '1')?'0':'1' ?>" onclick='ActivarAdmin2(<?= $object->GetA_i(); ?>)' title="Activar/Desactivar Jefe de Area" class="mdi mdi-toggle-switch<?= ($object->GetIsAdministrador()== '1')?' text-success':'-off text-muted' ?> icon" ></span>
				<span data-toggle='tooltip' title='Permite Que El Usuario Pueda Consultar Cualquier Expediente En Su Area De Trabajo Activa'  class='mdi mdi-comment-question-outline' style='font-size:14px; float:right; margin-right:40px; margin-top:2px'></span>

			</div>

			<div class="list-group-item">
				<span  style="font-size:14px">Super Administración</span>
				<span style="float:right"  id="option2<?= $object->GetA_i(); ?>" data-role="<?= ($object->GetIsSuperAdministrador()== '1')?'0':'1' ?>" onclick='ActivarSuperAdmin2(<?= $object->GetA_i(); ?>)' title="Activar/Desactivar Super Administración" class="mdi mdi-toggle-switch<?= ($object->GetIsSuperAdministrador()== '1')?' text-success':'-off text-muted' ?> icon"></span>
				<span data-toggle='tooltip' title='Permite Que El Usuario Pueda Consultar Y Manipular Cualquier Expediente Registrado En El Sistema' class='mdi mdi-comment-question-outline' style='font-size:14px; float:right; margin-right:40px; margin-top:2px'></span>
			</div>


			<?php
		}


?>	
<?
		$l = new MUsuarios_funcionalidades;
		$qe = $l->ListarUsuarios_funcionalidadesCrear('user_id', $object->GetUser_id(), "3");
		while($row = $con->FetchAssoc($qe)){

			$valortext = 'off';
			if($row['valor'] == 1){
				$valortext = 'on';
			}
?>			
			<div class="list-group-item">
				<span style="font-size:14px">
					<?php echo $row['nombre']; ?>
				</span>
				<span style="float:right;"  id="option<?= $row[id]; ?>" data-role="<?= ($row[valor]== '1')?'0':'1' ?>" onclick='EditarSuscriptores_funcionalidades(<?= $row[id]; ?>)' title="Activar/Desactivar Permiso" class="mdi mdi-toggle-switch<?= ($row[valor]== '1')?' text-success':'-off text-muted' ?> icon"></span>
				<?php
	                if ($row['ayuda'] != "") {
                    	echo "<span data-toggle='tooltip' title='".$row["ayuda"]."' class='mdi mdi-comment-question-outline' style='font-size:14px; float:right; margin-right:40px; margin-top:2px'></span>";  
                    }
				?>
			</div>
<?
		}		
?>		
		<div class="list-group-item disabled"> <b>PERMISOS DE CONFIGURACION</b></div>
<?
		$l = new MUsuarios_funcionalidades;
		$qe = $l->ListarUsuarios_funcionalidadesCrear('user_id', $object->GetUser_id(), "1");
		while($row = $con->FetchAssoc($qe)){

			$valortext = 'off';
			if($row['valor'] == 1){
				$valortext = 'on';
			}
?>			
			<div class="list-group-item">
				<span style="font-size:14px">
					<?php echo $row['nombre']; ?>
				</span>
				<span style="float:right;"  id="option<?= $row[id]; ?>" data-role="<?= ($row[valor]== '1')?'0':'1' ?>" onclick='EditarSuscriptores_funcionalidades(<?= $row[id]; ?>)' title="Activar/Desactivar Permiso" class="mdi mdi-toggle-switch<?= ($row[valor]== '1')?' text-success':'-off text-muted' ?> icon"></span>
				<?php
	                if ($row['ayuda'] != "") {
                    	echo "<span data-toggle='tooltip' title='".$row["ayuda"]."' class='mdi mdi-comment-question-outline' style='font-size:14px; float:right; margin-right:40px; margin-top:2px'></span>";  
                    }
				?>
			</div>
<?
		}		
?>		
		<div class="list-group-item disabled"> <b>INFORMES</b></div>
<?
		$l = new MUsuarios_funcionalidades;
		$qe = $l->ListarUsuarios_funcionalidadesCrear('user_id', $object->GetUser_id(), "2");
		while($row = $con->FetchAssoc($qe)){

			$valortext = 'off';
			if($row['valor'] == 1){
				$valortext = 'on';
			}
?>			
			<div class="list-group-item">
				<span style="font-size:14px">
					<?php echo $row['nombre']; ?>
				</span>
				<span style="float:right;"  id="option<?= $row[id]; ?>" data-role="<?= ($row[valor]== '1')?'0':'1' ?>" onclick='EditarSuscriptores_funcionalidades(<?= $row[id]; ?>)' title="Activar/Desactivar Permiso" class="mdi mdi-toggle-switch<?= ($row[valor]== '1')?' text-success':'-off text-muted' ?> icon"></span>
				<?php
	                if ($row['ayuda'] != "") {
                    	echo "<span data-toggle='tooltip' title='".$row["ayuda"]."' class='mdi mdi-comment-question-outline' style='font-size:14px; float:right; margin-right:40px; margin-top:2px'></span>";  
                    }
				?>
			</div>
<?
		}		
?>		
		</div>
	</form>
<script>
	$('th').parent().addClass('encabezado');
	$('tr.tblresult:not([th]):even').addClass('par');
	$('tr.tblresult:not([th]):odd').addClass('impar');
 	$('tr.tblresult:not([th])').removeClass('tblresult');	

 function EditarSuscriptores_funcionalidades(id)
 {
 	valor = $("#option"+id).attr("data-role");	
 	var URL = '/usuarios_funcionalidades/actualizar/'+id+'/'+valor+'/';
	$.ajax({
		type: 'POST',
		url: URL,
		success: function(msg){
			if (valor == "1") {
				$("#option"+id).removeClass("text-muted");
				$("#option"+id).addClass("text-success");
				$("#option"+id).removeClass("mdi-toggle-switch-off");
				$("#option"+id).addClass("mdi-toggle-switch");
				$("#option"+id).attr("data-role", "0");
			}else{
				$("#option"+id).removeClass("text-success");
				$("#option"+id).removeClass("mdi-toggle-switch");
				$("#option"+id).addClass("mdi-toggle-switch-off");
				$("#option"+id).addClass("text-muted");
				$("#option"+id).attr("data-role", "1");
			}
		}
	});
}

</script>	


<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});
</script>	
