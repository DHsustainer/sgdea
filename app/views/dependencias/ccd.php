<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>

<html xmlns='http://www.w3.org/1999/xhtml'>

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <title>CUADRO DE CLASIFICACION DOCUMENTAL</title>

    <!-- <link rel='stylesheet' type='text/css' href='http://assets.audiosjuridicos.com/styles/comunes.css'/>

    <link rel='stylesheet' type='text/css' href='http://assets.audiosjuridicos.com/styles/formularios.css'/> -->

    <link rel='stylesheet' type='text/css' href='<?=ASSETS?>/styles/del.mini.css'/>

    <script src="https://code.jquery.com/jquery-1.11.0.min.js"></script>

	<link rel='stylesheet' href='https://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css' />

    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css"> -->

    <script language='javascript' type='text/javascript' src='https://code.jquery.com/ui/1.10.3/jquery-ui.js'></script>



    <script language='javascript' type='text/javascript' src='<?=ASSETS?>/js/jscripts.js'></script>

	<link href="<?=ASSETS?>/images/favicon.png" rel='icon' type='image/x-icon'/>



	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!–[if lt IE 8]>

    <script src="https://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>

    <![endif]–>

    <style>
		@media print {
		    body {
		        margin:0px !important;
		        padding:0px !important;
		    }

		    .saltoDePagina{
				display:block;
				page-break-before:always;
			}
			td {
			    vertical-align: top;
			    padding: 2px !important;
			}
		    
		}
	</style>



</head>

<body  style="background:#FFF;">

	<div id="header">

<?

	$me = new MUsuarios;

	$me->CreateUsuarios("user_id", $_SESSION["usuario"]);



	global $c;



 	$nombre_usuario = $me->GetP_nombre()." ".$me->GetP_apellido();



 	if ($_SESSION["suscriptor_id"] != "") {

 		

 		$sus = new MSuscriptores_contactos;

 		$sus->CreateSuscriptores_contactos("id", $_SESSION['suscriptor_id']);



 		$nombre_usuario = $sus->GetNombre();



 	}



	if ($_SESSION['folder'] == "") {

        $u = new MUsuarios;

        $u->CreateUsuarios("user_id", $_SESSION['usuario']);



        if ($u->GetId_empresa() != "0") {

	        $sadmin = new MSuper_admin;

	        $sadmin->CreateSuper_admin("id", $u->GetId_empresa());



	        if ($sadmin->GetFoto_perfil() == "") {

	          	echo '<div id="del-logo"></div>';

	        }else{

	        	#echo '<div id="del-logo"></div>';

	        	echo '<div id="del-logo" style="background: URL('.HOMEDIR.DS.'app/plugins/thumbnails/'.$sadmin->GetFoto_perfil().') no-repeat; background-size: 170px 50px; margin-top:13px; height:50px"></div>';

	        }

        	

        }else{

        	echo '<div id="del-logo"></div>';

        }

    }else{

        $u = new MUsuarios;

        $u->CreateUsuarios("user_id", $_SESSION['usuario']);



        $sadmin = new MSuper_admin;

        $sadmin->CreateSuper_admin("id", $u->GetId_empresa());



        if ($sadmin->GetFoto_perfil() == "") {

          	echo '<div id="del-logo" onClick="window.location.href=\''.HOMEDIR.DS.'dashboard/\'"></div>';

        }else{

        	echo '<div id="del-logo" onClick="window.location.href=\''.HOMEDIR.DS.'dashboard/\'" style="background: URL('.HOMEDIR.DS.'app/plugins/thumbnails/'.$sadmin->GetFoto_perfil().')  no-repeat; background-size: 170px; margin-top:13px; height:50px"></div>';

        }

    }







?>





		<div id="del-buscar">

			<h4 style="margin-top: -13px; margin-bottom: 0px;">Proceso: Gestión Documental</h4>

			<h3 style="margin-top: 8px; margin-bottom: 0px;">CUADRO DE CLASIFICACION DOCUMENTAL</h3>

		</div>


					<?

						#echo $nombre_usuario

					    if ($_SESSION["usuario"] != ""){



							$cit = new MCity;

							$cit->CreateCity("code", $_SESSION['ciudad']);



							$area = new MAreas;

							$area->CreateAreas("id", $_SESSION['area_principal']);



							$of = new MSeccional;

							$of->CreateSeccional("id", $_SESSION['seccional']);






						}

					?>

	</div>
	<div id='content' class="app_container" style="padding:10px">

<?
	
	$areas = new MAreas;

	$q = $areas->ListarAreas(" WHERE id = '$id'", "order by nombre");

	
	while ($r = $con->FetchAssoc($q)) {
		$id = $r["id"];
		$area = new MAreas;
		$area->CreateAreas("id", $id);
		// CREANDO UN NUEVO MODELO			
		$object = new MAreas_dependencias;
		// ESTA FUNCIÓN ACTIVARÁ EL ALMACENAMIENTO EN BÚFER DE SALIDA. MIENTRAS DICHO ALMACENAMIENTO ESTÉ ACTIVO, NO SE ENVIARÁ NINGUNA SALIDA DESDE EL SCRIPT (APARTE DE CABECERAS), EN SU LUGAR LA SALIDA SE ALMACENARÁ EN UN BÚFER INTERNO.
		// DE NO RECIBIR PARAMETROS ESTA FUNCION TRAE EL LISTADO COMPLETO DE LIBROS
		$query = $object->ListarAreas_dependencias(" WHERE id_area = '".$id."' AND id_version = '".$_SESSION['id_trd']."' group by id_dependencia_raiz"," order by nd");	    
		
		include(VIEWS.DS."areas_dependencias".DS."Listar.php");
?>


		<table border="0" style="border:1px solid #ccc;">
			<tr>
				<td class="impar" colspan="4"><b>CONVENCIONES:</b></td>
			</tr>
			<tr>
				<td class="impar"><img src="<?= ASSETS.DS.'images/sr.png' ?>"></td>
				<td class="impar">Serie Documental</td>
				<td class="impar"><img src="<?= ASSETS.DS.'images/tip.png' ?>"></td>
				<td class="impar">Tipología Documental</td>
			</tr>
			<tr>
				<td class="impar"><img src="<?= ASSETS.DS.'images/subc.png' ?>"></td>
				<td class="impar">Sub-Serie Documental</td>
				<td class="impar"><img src="<?= ASSETS.DS.'images/matadato.png' ?>"></td>
				<td class="impar">Serie Documental Simple</td>
			</tr>
		</table>
	
		<hr style="height:10px; border:none;  border-top:1px solid #CCC; margin-top:50px; margin-bottom: 50px; ">
		<H1 class="SaltoDePagina"></H1>
<?
	}
?>

	</div>

		

	<script>



	$('tr.tblresult:not([th]):even').addClass('par');

	$('tr.tblresult:not([th]):odd').addClass('impar');

	</script>



	<style>

		.subss{

			border-top: 1px solid #CCC;

		}

		H1.SaltoDePagina{
			PAGE-BREAK-AFTER: always;
		}

	</style>

</body>

</html>

