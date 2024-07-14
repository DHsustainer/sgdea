<?







	$me = new MUsuarios;



	$me->CreateUsuarios("user_id", $_SESSION["usuario"]);







	global $c;







 	$nombre_usuario = $me->GetP_nombre();







 	if ($_SESSION["suscriptor_id"] != "") {



 		



 		$sus = new MSuscriptores_contactos;



 		$sus->CreateSuscriptores_contactos("id", $_SESSION['suscriptor_id']);







 		$nombre_usuario = $sus->GetNombre();







 	}

	if ($_SESSION["suscriptor_id"] == "") {
	 		if ($me->GetProcesos() != "1") {
	 			echo "<div class='alert alert-warning' role='alert' style='position:absolute; width:100%; z-index:999; text-align:center' id='panel_alerta_update'>Se ha actualizado su SGDEA descubre <a href='https://laws.com.co/notas-de-actualizacion/' class='alert-link' onClick='DisableAlert()' target='_blank'>aqui</a> las novedades de esta actualización <div style='float:right; cursor:pointer' onClick='DisableAlert()' class='alert-link fa fa-close'></div></div>";
	 		}
	}


?>






	
<script>







setInterval("checksession()",60000);







var SUSCRIPTORCAMPOIDENTIFICACION = "<?= SUSCRIPTORCAMPOIDENTIFICACION; ?>";



var SUSCRIPTORCAMPONOMBRE	 	  = "<?= SUSCRIPTORCAMPONOMBRE; ?>";



var SUSCRIPTORCAMPODIRECCION 	  = "<?= SUSCRIPTORCAMPODIRECCION; ?>";



var CAMPOAREADETRABAJO			  = "<?= CAMPOAREADETRABAJO; ?>";







function checksession(){



//	alert("this");



	$.ajax({



		type: "POST",



		url: "<?= HOMEDIR.DS.'dashboard'.DS.'newevents'.DS ?>",



		success: function(msg){



			if(msg != '0'){



				$('#alertasbloq').html("\n<span id='alerta'>"+msg+"</span>");



			}







		}



	});		







}



</script>



<?



	if ($_SESSION['folder'] == "") {



        $u = new MUsuarios;



        $u->CreateUsuarios("user_id", $_SESSION['usuario']);







        $_SESSION['logo_profile'];







        if ($u->GetId_empresa() != "0") {

	        $sadmin = new MSuper_admin;

	        $sadmin->CreateSuper_admin("id", $u->GetId_empresa());



	        if ($sadmin->GetFoto_perfil() == "") {

	          	echo '<div id="del-logo" onClick="window.location.href=\''.HOMEDIR.DS.'dashboard/\'"></div>';

	        }else{

	        	#echo '<div id="del-logo"></div>';

	        	echo '<div id="del-logo" onClick="window.location.href=\''.HOMEDIR.DS.'dashboard/\'" style="background: URL('.HOMEDIR.DS.'app/plugins/thumbnails/'.$sadmin->GetFoto_perfil().') no-repeat; background-size: contain !important; "></div>';

	        	$_SESSION['logo_profile'] = $sadmin->GetFoto_perfil();

	        }

        	

        }else{

        	echo '<div id="del-logo" onClick="window.location.href=\''.HOMEDIR.DS.'dashboard/\'"></div>';

        }

    }else{

        $u = new MUsuarios;

        $u->CreateUsuarios("user_id", $_SESSION['usuario']);



        $sadmin = new MSuper_admin;

        $sadmin->CreateSuper_admin("id", $u->GetId_empresa());



        if ($sadmin->GetFoto_perfil() == "") {

          	echo '<div id="del-logo" onClick="window.location.href=\''.HOMEDIR.DS.'dashboard/\'"></div>';

        }else{

        	echo '<div id="del-logo" onClick="window.location.href=\''.HOMEDIR.DS.'dashboard/\'" style="background: URL('.HOMEDIR.DS.'app/plugins/thumbnails/'.$sadmin->GetFoto_perfil().')  no-repeat; background-size: contain !important; "></div>';

        }

    }

?>











<div id="del-buscar">







		<input type='hidden' name='geturi' id='geturi' value='<?= $_SERVER['REQUEST_URI'] ?>' />

		<form action="/dashboard/buscador/" method="POST">



			<!--<button id="del-button-buscar">Buscar</button>-->
				<!--

			<select id="del-input-buscar2" name= "del-input-buscar2" style="width:110px;height:36px;border-left: 2px solid #e3e2e8;border-right: 2px solid #e3e2e8;border-top: 2px solid #e3e2e8;border-bottom: 2px solid #e3e2e8;" onchange="cambiarbuscarpor(this.value);">

				<option value="radicado:">Buscar por</option>

				<option value="radicado:">Radicado</option>

				<option value="buscar:">Metadatos</option>

				<option value="documentos:">Documentos</option>

				<option value="code:">Consulta jurídica</option>

				<option value="ayuda:">Ayuda</option>

				<option value="identificacion:">Suscriptor</option>

			</select>
			<div id="separadorbuscador"></div>
			-->
			<input type="text" id="del-input-buscar" name= "del-input-buscar" placeholder="Escriba termino a buscar" value="<?= $c->sql_quote($_REQUEST["del-input-buscar"]) ?>" />



		</form>



		<script type="text/javascript">



			$('#del-input-buscar2').val('<?= $c->sql_quote($_REQUEST["del-input-buscar2"]) ?>');



			if('<?= $c->sql_quote($_REQUEST["del-input-buscar2"]) ?>' == ''){



				$('#del-input-buscar2').val('radicado:');



				$('#del-input-buscar').attr("placeholder","Escriba un número de radicado");



			}



			function cambiarbuscarpor(object){



				if(object == "radicado:"){



					$('#del-input-buscar').attr("placeholder","Escriba un número de radicado");



				}



				if(object == "buscar:"){



					$('#del-input-buscar').attr("placeholder","Escriba un metadato a buscar");



				}



				if(object == "code:"){



					$('#del-input-buscar').attr("placeholder","Escriba el tema jurídico a buscar");



				}



				if(object == "ayuda:"){



					$('#del-input-buscar').attr("placeholder","Escriba la ayuda a buscar");



				}



				if(object == "identificacion:"){



					$('#del-input-buscar').attr("placeholder","Escriba un suscriptor a buscar");



				}



			}



		</script>



</div>







<div id="del-right">







<?











	$varx = 1;



	if (isset($_SESSION[sadmin])) {



		$varx = "2";



	}







    if ($_SESSION["usuario"] != ""){



		echo '<div id="del-alarmas" class="alarmas">';



		if ($_SESSION['suscriptor_id'] == "" ) {



?>			

<?
			#print_r($_SESSION['MODULES']);

			if ($_SESSION['MODULES']['chat'] == "1") {
			
				$con->Query("UPDATE usuarios set estadochat = '1', lastlogin = '".date("Y-m-d H:i:s")."' where user_id='".$_SESSION['usuario']."'");
			    $fecha = date("Y-m-d H:i:s");
			    $ccaducidad = 10;
			    $fecha_c = date_create($fecha);//aca le pasas la fecha actual o ala que le queres sumar los dias.
				date_modify($fecha_c, "-$ccaducidad minutes");//sumas los dias que te hacen falta.
				$f_inactivo = date_format($fecha_c, "Y-m-d H:i:s");//retornas la fecha en el formato que mas te guste.
			    $ccaducidad = 15;
			    $fecha_c = date_create($fecha);//aca le pasas la fecha actual o ala que le queres sumar los dias.
			    date_modify($fecha_c, "-$ccaducidad minutes");//sumas los dias que te hacen falta.
			    $f_caducidad = date_format($fecha_c, "Y-m-d H:i:s");//retornas la fecha en el formato que mas te guste.

			    $con->Query("UPDATE usuarios set estadochat = 2 where lastlogin < '$f_inactivo' ");

			    $con->Query("UPDATE usuarios set estadochat = 0 where lastlogin < '$f_caducidad' ");
				$conectados = $con->Query("select count(*) as total from chat where recd = '0' and to_name = '".$_SESSION['usuario']."'");
				#echo "select count(*) as total from chat where recd = '0' and to = '".$_SESSION['usuario']."'";
	            $total = $con->Result($conectados,0,'total');

	               echo '  



	                    <div id="chat" class="mod-icon-alerta fa fa-comments yellow">
	                    	<span id="alerta-chat">'.$total.'</span>
	                    </div>';
			}

		    $notificaciones = $me->GetCountNotifications(); 

		    if($notificaciones > 0){
				$notificaciones = "!";



		        echo "	<div class='mod-icon-alerta fa fa-bell-o blue' title='Tienes $notificaciones alertas sin revisar'  onClick='window.location.href=\"".HOMEDIR."/dashboard/\"' id='alertasbloq'>

		        			<span id='alerta'>$notificaciones</span>

		        		</div>";



		    }else{



				echo "<div class='mod-icon-alerta fa fa-bell-o gray' title='No tienes alertas nuevas' onClick='window.location.href=\"".HOMEDIR."/dashboard/\"'></div>";



		    }



	    }



?>







<?



		if ($_SESSION['MODULES']['firma_electronica'] == "1" || $_SESSION['MODULES']['firma_digital'] == "1") {



		$getDocsToSign = $c->GetDocumentosParaFirmar();



			if ($getDocsToSign > 0) {



?>



				<div class="mod-icon-alerta fa fa-check blue" title="Documentos Pendientes de firma" onClick="window.location.href='<?= HOMEDIR."/firmas_usuarios/listar/" ?>'">



					<span id="firmas_pendientes"><?= $getDocsToSign; ?></span>



				</div> 



<?



			}else{



?>



				<div class="mod-icon-alerta fa fa-check gray" title="Documentos Pendientes de firma" onClick="window.location.href='<?= HOMEDIR."/firmas_usuarios/listar/" ?>'"></div> 



<?			



			}



		}







?>











<?



	if ($_SESSION['suscriptor_id'] == "" ) {







		if ($_SESSION['MODULES']['correo_electronico'] == "1"){



		    $newemails = $c->GetNewMailsNumber();



		    if ($newemails > 0) {



?>



				<div id="graphic_statususer" class="mod-icon-alerta fa fa-inbox blue"  style="" >



					<span id="mensaje"><?= $newemails; ?></span>

					<div class="cuadro_white"></div>

					<div class="nivel_white" style="width:360px">

						<?

							include_once(VIEWS.DS.'mailer_message/mini-alerts.php');	   			

						?>

					</div>

				</div>



<?



	    	}else{



?>        	



			<div id="graphic_statususer" class="mod-icon-alerta fa fa-inbox gray" title="No tienes correos sin leer" style="">

					<div class="cuadro_white"></div>

					<div class="nivel_white" style="width:360px">

						<?

							include_once(VIEWS.DS.'mailer_message/mini-alerts.php');

						?>


					</div>

			</div>

<?

	    	}

		}

?>



			



		<?



		



			include_once(MODELS.DS.'Usuarios_configurar_accesosM.php');



		?>



			<div id="graphic_statususer" title="Ubicación Actual" class="mod-icon-alerta fa fa-location-arrow red">



				<div class="cuadro_white"></div>



				<div class="nivel_white" style="width:300px">



					<div class="titulo">Ubicación Actual</div>


						<?php if($_SESSION['MODULES']['multiempresa'] == 1 && count($_SESSION['listempresas']) > 0){ ?>
						<div class="row" style="margin-left:0px; margin-top: 0px; margin-bottom:0px;">

							<div class="col-md-4 tsubtitulo" style="margin: 0px;">

								<b> Empresa: </b>

							</div>
							<div class="col-md-7 " style="text-align: left">
								<select  placeholder="Empresa"  name="currentempresa2" id="currentempresa2" onchange="ChangeEmpresa2(this.value);" style="width:100% !important">									<?php
									foreach ($_SESSION['listempresas'] as $key => $value) {
										$selectf = '';
			                            if(HOMEDIR == $value[3]){
			                                 $selectf = 'selected';
			                            }
										echo '<option value="'.$value[3].'" '.$selectf.'>'.$value[0].'</option>';
									}
									?>
								</select>
								<!--<script type="text/javascript">
									$('#currentempresa2').val("<?php echo $_SESSION['71c029wus3yJWEN']; ?>");
								</script>-->
							</div>

						</div>
						<?php } ?>
						<div class="row" style="margin-left:0px; margin-top: 0px; margin-bottom:0px;">

							<div class="col-md-4 tsubtitulo" style="margin: 0px;">

								<b> Ciudad: </b>

							</div>

							<div class="col-md-7 " style="text-align: left">

								<?

								if($_SESSION['cambio_ciudad'] == 1){

									echo '<select id="currentciudad" onChange="ChangeCiudad()" style="width:100% !important">';
									global $con;
									$MUsuarios_configurar_accesos = new MUsuarios_configurar_accesos;

	    							$query = $MUsuarios_configurar_accesos->ListarCiudadesUsuario();
	    							$carea = "N";
	    							 while ($row = $con->FetchAssoc($query)) {
	    							 	if($_SESSION['ciudad'] == $row['code']){
	    							 		$SESSIONciudad = $row['code'];
	    							 		echo '<option value="'.$row['code'].'" selected>'.$row['Name'].'</option>';

	    							 	} else {

	    							 		echo '<option value="'.$row['code'].'">'.$row['Name'].'</option>';
	    							 		if($carea == "N"){
	    							 			$SESSIONciudad = $row['code'];
	    							 			$carea = "S";
	    							 		}

	    							 	}							 	

	    							 }
	    							 $_SESSION['ciudad'] = $SESSIONciudad;

									echo '</select>';

								} else{

									$cit = new MCity;

									$cit->CreateCity("code", $_SESSION['ciudad']);

									echo '<b>'.$cit->GetName().'</b>';

								}			

								?>

							</div>

						</div>

						<div class="row" style="margin-left:0px; margin-top: 0px; margin-bottom:0px;">

							<div class="col-md-4 tsubtitulo" style="margin: 0px;">

								<b> Oficina: </b>

							</div>

							<div class="col-md-7 " style="text-align: left">

							<?

							if($_SESSION['cambio_ciudad'] == 1){

								echo '<select id="currentoficina" onChange="ChangeOficina()" style="width:100% !important">';

								$MUsuarios_configurar_accesos = new MUsuarios_configurar_accesos;

    							$query = $MUsuarios_configurar_accesos->ListarOficinasUsuario();
    							$carea = "N";
    							 while ($row = $con->FetchAssoc($query)) {

    							 	if($_SESSION['seccional'] == $row['id']){
    							 		$SESSIONseccional = $row['id'];
    							 		echo '<option value="'.$row['id'].'" selected>'.$row['nombre'].'</option>';

    							 	} else {

    							 		echo '<option value="'.$row['id'].'">'.$row['nombre'].'</option>';
    							 		if($carea == "N"){
    							 			$SESSIONseccional = $row['id'];
    							 			$carea = "S";
    							 		}
    							 	}	

    							 }
    							 $_SESSION['seccional'] = $SESSIONseccional;

								echo '</select>';

							} else{

								$of = new MSeccional;

								$of->CreateSeccional("id", $_SESSION['seccional']);

								echo '<b>'.$of->GetNombre()."</b>";

							}

							?>

							</div>

						</div>

						<div class="row" style="margin-left:0px; margin-top: 0px; margin-bottom:0px;">

							<div class="col-md-4 tsubtitulo" style="margin: 0px;">

								<b> Area: </b>

							</div>

							<div class="col-md-7 " style="text-align: left">

							<?

							if($_SESSION['cambio_area'] == 1){

								echo '<select id="currentarea" onChange="ChangeArea()" style="width:100% !important" >';

								$u = new MUsuarios_configurar_accesos;

    							$query = $u->ListarAreasUsuarioNew();
    							$carea = "N";

    							 while ($row = $con->FetchAssoc($query)) {

    							 	if($_SESSION['area_principal'] == $row['id']){
    							 		$SESSIONarea_principal = $row['id'];
    							 		$carea = "S";
    							 		echo '<option value="'.$row['id'].'" selected>'.$row['nombre'].'</option>';

    							 	} else {

    							 		echo '<option value="'.$row['id'].'">'.$row['nombre'].'</option>';
    							 		if($carea == "N"){
    							 			$SESSIONarea_principal = $row['id'];
    							 			$carea = "S";
    							 		}

    							 	}

    							 }
    							 $_SESSION['area_principal'] = $SESSIONarea_principal;

								echo '</select>';

							} else{

								$ar = new MAreas;

								$ar->CreateAreas("id", $_SESSION['area_principal']);

								echo '<b>'.$ar->GetNombre()."</b>";

							}

							?>

							</div>

						</div>

						<div class="row" style="margin-left:0px; margin-top: 0px; margin-bottom:0px;">

							<div class="col-md-4 tsubtitulo" style="margin: 0px;">

								<b> Archivo: </b>

							</div>

							<div class="col-md-7 " style="text-align: left">

							<select id="currentseccional" onChange="ChangeArchivo()" style="width:100% !important" >

							<?

								if ($_SESSION["typefolder"] == "1") {

									if($_SESSION['archivo_gestion'] == '1'){

										echo '<option value="1">Archivo Gestión</option>';

									}

									if($_SESSION['archivo_central'] == '1'){

										echo '<option value="2">Archivo Central</option>';

									}

									if($_SESSION['archivo_historico'] == '1'){

										echo '<option value="3">Archivo Histórico</option>';

									}

								}elseif ($_SESSION["typefolder"] == "2") {								

									if($_SESSION['archivo_central'] == '1'){

										echo '<option value="2">Archivo Central</option>';

									}

									if($_SESSION['archivo_gestion'] == '1'){

										echo '<option value="1">Archivo Gestión</option>';

									}

									if($_SESSION['archivo_historico'] == '1'){

										echo '<option value="3">Archivo Histórico</option>';

									}

								}elseif ($_SESSION['typefolder'] == "3") {

									if($_SESSION['archivo_historico'] == '1'){

										echo '<option value="3">Archivo Histórico</option>';

									}

									if($_SESSION['archivo_central'] == '1'){

										echo '<option value="2">Archivo Central</option>';

									}

									if($_SESSION['archivo_gestion'] == '1'){

										echo '<option value="1">Archivo Gestión</option>';

									}

								}else{

									if($_SESSION['archivo_gestion'] == '1'){

										echo '<option value="1">Archivo Gestión</option>';

									}

									if($_SESSION['archivo_central'] == '1'){

										echo '<option value="2">Archivo Central</option>';

									}

									if($_SESSION['archivo_historico'] == '1'){

										echo '<option value="3">Archivo Histórico</option>';

									}

								}

							?>

							</select>

							</div>

						</div>

						<?php 

						if($_SESSION['cambio_usuario'] == 1){ 

							$MUsuarios_configurar_accesos = new MUsuarios_configurar_accesos;

							if($_SESSION["usuario_real_cambio"] != ""){

								$query = $MUsuarios_configurar_accesos->ListarUsuarioUsuario($_SESSION["usuario_real_cambio"],$_SESSION["seccional_real_cambio"],$_SESSION["area_principal_real_cambio"]);

							} else {

								$query = $MUsuarios_configurar_accesos->ListarUsuarioUsuario($_SESSION["usuario"],$_SESSION["seccional"],$_SESSION["area_principal"]);

							}

							if($con->NumRows($query) > 0){

							?>

							<div class="row" style="margin-left:0px; margin-top: 0px; margin-bottom:0px;">

								<div class="col-md-4 tsubtitulo" style="margin: 0px;">

									<b>Usuario: </b>

								</div>

								<div class="col-md-7 " style="text-align: left">

								<?php

								echo '<select id="currentusuariocambio" onChange="ChangeUsuario()" style="width:100% !important" >';

								

								echo '<option value="">Usuario actual</option>';

								while ($row = $con->FetchAssoc($query)){

								  	if($_SESSION['usuario'] == $row['user_id']){

								 		echo '<option value="'.$row['user_id'].'" selected>'.$row['nombre'].'</option>';

								 	}else{

								 		echo '<option value="'.$row['user_id'].'">'.$row['nombre'].'</option>';
								 	}
								}
								if($_SESSION["usuario_real_cambio"] != ""){
							 		echo '<option value="'.$_SESSION["usuario_real_cambio"].'">Volver al usuario inicial</option>';
							 	}
								echo '</select>';
								?>
								</div>
							</div>
							<?php }
						} ?>
				</div>
			</div>


			
		<? } ?>
				<div id="graphic_statususer" class="mod-icon-alerta fa fa-leaf green">
					<div class="cuadro_white"></div>
					<div class="nivel_white">
						<div class="titulo">Consumo Responsable</div>
							<div class="row" style="margin-left:0px; margin-top: 0px;">
								<div class="col-md-7 min_subtitulo" style="text-align: left">
									<b>Menos Papel: </b>
								</div>
								<div class="col-md-5 min_subtitulo" style="text-align: left">
									<?= $c->GetCalculoPapel("a") ?>
								</div>
							</div>
							<div class="row" style="margin-left:0px; margin-top: 0px;">
								<div class="col-md-7 min_subtitulo" style="text-align: left">
									<b>Menos Resmas: </b>
								</div>
								<div class="col-md-5 min_subtitulo" style="text-align: left">
									<?= $c->GetCalculoPapel("b") ?>
								</div>
							</div>
							<div class="row" style="margin-left:0px; margin-top: 0px;">
								<div class="col-md-7 min_subtitulo" style="text-align: left">
									<b>Más Arboles: </b>
								</div>
								<div class="col-md-5 min_subtitulo" style="text-align: left">
									<?= $c->GetCalculoPapel("c") ?>
								</div>
							</div>
							<div class="row" style="margin-left:0px; margin-top: 0px;">
								<div class="col-md-12 min_subtitulo" style="text-align: center">
									<b><a href="/dashboard/VerCalculodeAhorro/" target="_blank">VER MÁS DETALLES</a></b>
								</div>
							</div>
					</div>
				</div>
	</div>

	<div id="del-user">

	<?php 

		if ($_SESSION["suscriptor_id"] == ""){

	?>

		<div class="icon user" id="thumb_pic">

			<img src="<?= HOMEDIR.DS.'app/plugins/thumbnails/'.$me->GetFoto_perfil() ?>" alt="">

		</div>

	<?php 

		}else{

	?>

			<div style="width:10px; height:10px; float: left"></div>

	<?php 

		}

	?>

		<div id="del-user-info">

			<li class="nivel1">

				<a class="nivel1"><?= $nombre_usuario ?></a><div class="icon arrow"></div>

				<div class="cuadro"></div>

				<ul class="nivel2">

				<?php 



						if ($_SESSION["suscriptor_id"] == ""){

				?>

						<li>

							<span class="icon cuentaconfig"></span>

							<a class="nivel2" href="/dashboard/profile/">Configurar Cuenta</a>

						</li>

						

				<?php 

						}else{

				?>

						<li>

							<span class="icon cuentaconfig"></span>

							<a class="nivel2" href="/dashboard/profileSuscriptor/">Cuenta</a>

						</li>

						

				<?php 

						}

					?> 

					<li>

						<span class="icon cerrarsesion"></span>

						<a class="nivel2" href="<?= HOMEDIR.DS."login".DS."kill".DS ?>">Salir</a>

					</li>

				</ul>

			</li>

		</div>

	</div>

<?

	}

?>

</div>
<style>
	.addd{
		cursor:pinter;
	}
	.addd td:hover{
		text-decoration:underline;
		cursor:pointer;
	}
	.row > * {
	   		padding: 0px 0 0 0px !important;
	   		margin-bottom:0px !important;
	}
	.row {
	    margin: -50px 0 -1px -50px;
	}
	.row.ultima{
	    margin: -50px 0 20px -50px;
	    border-bottom: 1px solid #DDD !important;
	}
	.row.primera{
	    border-top: 1px solid #f5f5f5 !important;
	}
	div.table, div.table_2 {
	    background-color: #fff;
	    padding: 20px 0px 20px 20px;
	}
	.tsubtitulo{
		color: #1263a1;
		font-size: 12px !important;
		text-align: left;
	}
</style>