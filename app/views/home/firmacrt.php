<div class="container">

	<div class="row">

		<div class="col-md-12">

			<h2>

			<?
			    $permisos = $_SESSION['vector'][2];

			    $module = $_REQUEST['m']."/".$_REQUEST['action'];
			    if($_REQUEST['action'] == 'crearfirmacrt'){
			    	 $module = $_REQUEST['m']."/firmacrt";
			    }

			    $exist = true;

			    for ($k=0; $k < count($permisos) ; $k++) { 

			    	$link = explode(":", $permisos[$k])	;

			    	if ($module == $link[1]) {

				        echo '<span class="fa '.$link[2].'"></span>'.$link[0].'';

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

		<div class="col-md-12" id="main_form_suscriptores_modulos">
			<div>
			    <div class='title'>Generar de Firmas Digitales</div>
			</div>
		</div>
	</div>
    <form id='formsuscriptores_modulos' action='/dashboard/crearfirmacrt/' method='POST'> 
		
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="provincia">Región o provincia</label>
					<input type='text' class='form-control' placeholder='Región o provincia' name='provincia' id='provincia' maxlength='255' />
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">	
					<label for="ciudad">Ciudad</label>
					<input type='text' class='form-control' placeholder='Ciudad' name='ciudad' id='ciudad' maxlength='' />
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-4">
				<div class="form-group">	
					<label for="organizacion">Organizacion</label>
					<input type='text' class='form-control' placeholder='Organizacion' name='organizacion' id='organizacion' maxlength='' />
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">	
					<label for="organizacion">Unidad Organizacional</label>
					<input type='text' class='form-control' placeholder='Unidad Organizacional' name='organizacion_unidad' id='organizacion_unidad' maxlength='' />
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">	
					<label for="nombre">Nombre Firmante</label>
					<input type='text' class='form-control' placeholder='Nombre Firmante' name='nombre' id='nombre' maxlength='' />
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6">
				<div class="form-group">	
					<label for="email">Email</label>
					<input type='text' class='form-control' placeholder='Email' name='email' id='email' maxlength='' />
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">	
					<label for="clave">Clave</label>
					<input type='password' class='form-control' placeholder='Clave' name='clave' id='clave' maxlength='' />
				</div>
			</div>
		</div>

		<input type='submit' value='Generar Firma'/>
	
    </form>

<?
	$crt = $_REQUEST['id'];
		if($crt != ''){
			?>
			<script type="text/javascript">
				document.location.href='<?php echo HOMEDIR; ?>/app/archivos_uploads/firmascrt/<?php echo $crt;?>';
			</script>
			<?php
		}
	}

?>

</div>



