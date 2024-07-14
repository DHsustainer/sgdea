<div class="container">

	<div class="row">

		<div class="col-md-12">

			<h2>

			<?

			    $permisos = $_SESSION['vector'][2];

			    $module = $_REQUEST['m']."/".$_REQUEST['action'];

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
	<form id="formulario" action="/dashboard/ofuscador2/" method="post" enctype="multipart/form-data">
		<div class="row">

			<div class="col-md-12" id="main_form_suscriptores_modulos">

				<div>

				    <div class='title'>Generar Key</div>

					<div align="center" style="font-family:Verdana, Geneva, sans-serif; font-size:12px; margin-top:100px; width:400px; margin:0 auto;">
						<div style="margin:20px;">
							<h2>Ofuscador PHP</h2>
							<label for="archivo">Archivo PHP a ofuscar:</label>
							<br>
							<input type="file" id="archivo" name="archivo" value="" style="font-family:Verdana, Geneva, sans-serif; font-size:12px;" class="required">
							<br>
							<br>
							<br>
							<input type="submit" id="enviar" name="enviar" value="Enviar" style="font-family:Verdana, Geneva, sans-serif; font-size:12px;">
						</div>
					</div>

				</div>

			</div>

		</div>
	</form>

	<!--<div class="row">

		<div class="col-md-12" id="main_form_suscriptores_modulos">

			<div>

			    <div class='title'>Generar Key</div>

				<iframe id="se" src="http://elhappy.net/happy_proyectos/ofuscador/" style="width:100%; height: 300px; border:none"></iframe>

			</div>

		</div>

	</div>-->

<?

	}

?>

</div>



