 <div class="container">
	<div class="row">
		<div class="col-md-12">
			<h2>
			<?
			    $permisos = $_SESSION['vector'][3];
			    $module = $_REQUEST['m'];
			    $exist = true;
			    global $f;
			    for ($k=0; $k < count($permisos) ; $k++) { 
			    	$link = explode(":", $permisos[$k])	;
			    	if ($module == $link[1]) {

						$smf = new MSuscriptores_modulos_funciones;
						
			

	#					if ($smf->GetId() == "") {
			    			$qi = $con->Query("select * from suscriptores_modulos");
							
						    while ($r = $con->FetchAssoc($qi)) {

								$smf->InsertSuscriptores_modulos_funciones($id, $r['id'], "0");
								$smf->CreateSuscriptores_modulos_funciones('id_suscriptor', $id);
						    	# code...
						    }
	#					}

						$s = new MSuscriptores_contactos;
						$s->CreateSuscriptores_contactos("id", $id);

				        echo '<span class="fa '.$link[2].'"></span>'.$link[0].' Para: '.$s->GetNombre();
				        $exist = true;
				        break;
			    	}else{
			    		$exist = false;
			    	}
			    }




			?>
			</h2>
		</div>
	</div>
<?
	if ($exist) {
?>	
	<div class="row">
		<div class="col-md-6" id="main_form_suscriptores_modulos">
			<?
				$query = $con->Query("SELECT suscriptores_modulos_funciones.id FROM suscriptores_modulos_funciones inner join suscriptores_modulos on suscriptores_modulos.id = suscriptores_modulos_funciones.id_suscriptores_modulos WHERE  suscriptores_modulos.tipo = '-1' and suscriptores_modulos_funciones.user_id = '".$id."'");
				$tipo = -1;
				include(VIEWS.DS."suscriptores_modulos_funciones/Listar.php");
			?>
		</div>
		<div class="col-md-6" id="main_form_suscriptores_modulos">
			<?
				$query = $con->Query("SELECT suscriptores_modulos_funciones.id FROM suscriptores_modulos_funciones inner join suscriptores_modulos on suscriptores_modulos.id = suscriptores_modulos_funciones.id_suscriptores_modulos WHERE  suscriptores_modulos.tipo = '0' and suscriptores_modulos_funciones.user_id = '".$id."'");
				$tipo = 0;
				include(VIEWS.DS."suscriptores_modulos_funciones/Listar.php");
			?>
		</div>

	</div>
	<div class="row">
		<div class="col-md-6" id="main_form_suscriptores_modulos">
			<?
				$query = $con->Query("SELECT suscriptores_modulos_funciones.id FROM suscriptores_modulos_funciones inner join suscriptores_modulos on suscriptores_modulos.id = suscriptores_modulos_funciones.id_suscriptores_modulos WHERE  suscriptores_modulos.tipo = '1' and suscriptores_modulos_funciones.user_id = '".$id."'");
				$tipo = 1;
				include(VIEWS.DS."suscriptores_modulos_funciones/Listar.php");
			?>
		</div>
				<div class="col-md-6" id="main_form_suscriptores_modulos">
			<?
				$query = $con->Query("SELECT suscriptores_modulos_funciones.id FROM suscriptores_modulos_funciones inner join suscriptores_modulos on suscriptores_modulos.id = suscriptores_modulos_funciones.id_suscriptores_modulos WHERE  suscriptores_modulos.tipo = '2' and suscriptores_modulos_funciones.user_id = '".$id."'");
				$tipo = 2;
				include(VIEWS.DS."suscriptores_modulos_funciones/Listar.php");
			?>
		</div>		
	</div>
	<div class="row">
		<div class="col-md-6" id="main_form_suscriptores_modulos">
			<?
				$query = $con->Query("SELECT suscriptores_modulos_funciones.id FROM suscriptores_modulos_funciones inner join suscriptores_modulos on suscriptores_modulos.id = suscriptores_modulos_funciones.id_suscriptores_modulos WHERE  suscriptores_modulos.tipo = '3' and suscriptores_modulos_funciones.user_id = '".$id."'");
				$tipo = 3;
				include(VIEWS.DS."suscriptores_modulos_funciones/Listar.php");
			?>
		</div>
				<div class="col-md-6" id="main_form_suscriptores_modulos">
			<?
				$query = $con->Query("SELECT suscriptores_modulos_funciones.id FROM suscriptores_modulos_funciones inner join suscriptores_modulos on suscriptores_modulos.id = suscriptores_modulos_funciones.id_suscriptores_modulos WHERE  suscriptores_modulos.tipo = '4' and suscriptores_modulos_funciones.user_id = '".$id."'");
				$tipo = 4;
				include(VIEWS.DS."suscriptores_modulos_funciones/Listar.php");
			?>
		</div>		
	</div>
	<div class="row">
		<div class="col-md-6" id="main_form_suscriptores_modulos">
			<?
				$query = $con->Query("SELECT * from suscriptores_empresas where id_suscriptor = '".$id."'");
				include(VIEWS.DS."suscriptores_empresas/Listar.php");
			?>
		</div>	
		<div class="col-md-6" id="main_form_suscriptores_modulos">
			<?
				$query = $con->Query("SELECT * from suscriptores_interoperabilidad where suscriptor_origen = '".$id."'");
				include(VIEWS.DS."suscriptores_interoperabilidad/Listar.php");
			?>
		</div>	
	</div>
<?
	}
?>
</div>


<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});
</script>