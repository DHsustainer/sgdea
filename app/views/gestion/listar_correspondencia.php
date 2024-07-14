<div id="content" class="app_container">
	<div class="row" style="margin:0px; background: #FFF; padding-left:20px; margin-top:20px">
		<div class="col-md-12">
			<ol class="breadcrumb default">
			  	<li>
			  		<a href="/gestion/correspondencia/">Correspondencia de Entrada</a>
			  	</li>
			  	<li>
			  		<a href="/gestion/CargaMasivaCorrespondencia/">Carga Masiva de Correspondencia</a>
			  	</li>
			</ol>
		</div>
	</div>
</div>


	<div id="folders-list-content" class="scrollable">

		<br>

		<div class="form">



			<h3>Listado de Expedientes</h3>

			<div>

				Fecha inicio: <input class="form-control datepicker" type='text' name='fecha_i' id='fecha_i' style='width:100px' value='<?php echo $fecha_i; ?>' /> 

				Fecha fin: <input class="form-control datepicker" type='text' name='fecha_f' id='fecha_f' style='width:100px' value='<?php echo $fecha_f; ?>' /> 

				<input type="button" value="Buscar" onclick="BuscarExpedientesfecha();">

			</div>

			<div class="accionesformulario">

				<div class="btn_check"  style='float:left; margin-left: 10px; margin-top:10px;'>

					<input id="checkAll4" onclick="checkTodos(this.id,'tipos_campos');" name="checkAll" type="checkbox" />

				    <label for="checkAll4"><strong>Seleccionar / Deseleccionar Todos</strong></label>

				</div>

				<div class="listado_acciones"  style='float:right; margin-right: 10px;'>

					<div class='impr_box'>

			            <ul>

			                <li onclick="EnviarClaves()" class='bl_pro properties' title='Enviar claves de acceso al suscriptor'>Enviar Claves</li>

			                <li onclick="EnviarCorreo()" class='bl_pro share' title='Enviar documentos por correo certificado'>Enviar por Correo Certificado</li>

			                <!--<li onclick="EnviarPorQR()" class='bl_pro properties' title='Generar Codigos QR'>Generar Códigos QR</li>-->

			                <li onclick="EnviarFisico()" class='bl_pro share' title='Enviar por empresa de mensajería'>Enviar Físico</li>

			            </ul>

			        </div>

				</div>

			</div>

			<div class="table" id="listadoexportable" style="margin-bottom:50px">

				<form id="enviarmensajes" action="/gestion/enviarmensajes/">

					<table border="0" cellspacing="0" cellpadding="3" style="width:100%"  class="tabla" id="tipos_campos">

						<thead>

							<tr class="encabezado">

								<th class="th_act" style="width:10px">Sel</th>

								<th class="th_act" style="width:150px">Radicado</th>

								<th class="th_act" style="width:55px">Ingreso</th>

								<th class="th_act" style="width:200px">Serie / Subserie</th>

								<th class="th_act" style="width:120px">Suscriptores</th>

								<th class="th_act" style="width:230px">Observación</th>

								<th class="th_act" style="width:220px">Documentos</th>

								<th class="th_act" style="width:20px;" title="Interacción Electrónica">

									<div class="iconv2 properties"></div>

								</th>

								<th class="th_act" style="width:20px;" title="Correo Electrónico Certificado">

									<div class="iconv2 at"></div>

								</th>

								<th class="th_act" style="width:20px;" title="Envío por Código QR">

									<div class="iconv2 qr"></div>

								</th>

								<th class="th_act" style="width:20px;" title="Envío por Correo Fisico">

									<div class="iconv2 messenger"></div>

								</th>

							</tr>

						</thead>

						<tbody>

<?								

					$ar = array("0" => "Baja", "1" => "Media", "2" => "Alta");

					$ar2 = array("1" => "Archivo de Gestión", "2" => "Archivo Central", "3" => "Archivo Histórico");

					

					$usua = new MUsuarios;

					$usua->CreateUsuarios("user_id", $_SESSION['usuario']);

					

					$g = new MGestion;

					$query = $g->ListarGestion(" WHERE (f_recibido between '".$fecha_i."' and '".$fecha_f."')  and nombre_destino = '".$usua->GetA_i()."' and estado_archivo = '".$_SESSION['typefolder']."'");

					$i = 0;

					$if = 0;

					while ($row = $con->FetchAssoc($query)) {

						$i++;

						$rg = new MGestion;

						$rg->CreateGestion("id", $row["id"]);



						$serie = $c->GetDataFromTable("dependencias", "id", $rg->GetId_dependencia_raiz(), "nombre", $separador = " ");

						$subserie = $c->GetDataFromTable("dependencias", "id", $rg->GetTipo_documento(), "nombre", $separador = " ");

						$suscriptor = $c->GetDataFromTable("suscriptores_contactos", "id", $rg->GetSuscriptor_id(), "nombre, type", " (").")";

						$estado = $c->GetDataFromTable("estados_gestion", "id", $rg->GetEstado_solicitud(), "nombre", $separador = " ");

							

						$s = new MDependencias;

						$q = $s->ListarDependencias(" where dependencia = '0'");

						$if += $rg->GetFolio();

						echo '	<tr class="addd" id="wor'.$rg->GetId().'">

									<td>

									<input type="checkbox" id="exp'.$rg->GetId().'" name="gestion[]" value="'.$rg->GetId().'">

									</td> 

									<td>

										<!--<div style=" width:70px; float:left"><b> Num. Rad: </b></div><div style="float:left"><a href="'.HOMEDIR.'/gestion/ver/'.$rg->GetId().'/" target="_blank">'.$rg->GetNum_oficio_respuesta().'</a></div>

										<br>-->

										<div style=" width:70px; float:left"><b> Rad Externo: </b></div><div style="float:left"><a href="'.HOMEDIR.'/gestion/ver/'.$rg->GetId().'/" target="_blank">'.$rg->GetRadicado().'</a></div>

										<br>

										<div style=" width:70px; float:left"><b> Rad Rapido: </b></div><div style="float:left"><a href="'.HOMEDIR.'/gestion/ver/'.$rg->GetId().'/" target="_blank">'.$rg->GetMin_rad().'</a></div>

									</td>

									<td>'.$rg->GetF_recibido().'</td> 



									<td>'.$serie.'<br>('.$subserie.')</td>

									<td>';

											$lgestions = new MGestion_suscriptores;

		                                    $querysuscriptores2 = $lgestions->ListarGestion_suscriptores("WHERE id_gestion = '".$rg->GetId()."'");

		                                    $ixx = 0;



		                                    while($rowsuscriptores = $con->FetchAssoc($querysuscriptores2)){

		                                        $ixx++;

		                                        $llstt = new MGestion_suscriptores;

		                                        $llstt->Creategestion_suscriptores('id', $rowsuscriptores['id']);



		                                        $sustrs = new MSuscriptores_contactos;

		                                        $sustrs->CreateSuscriptores_contactos("id", $llstt -> GetId_suscriptor());



		                                        echo $sustrs->GetNombre().'<br>';

		                                    }



						echo '		</td>

									<td>'.$rg->GetObservacion().'</td>

									<td>';

										$ang = new MGestion_anexos;					

										$queryanexos = $ang->ListarGestion_anexos("WHERE gestion_id = '".$rg->GetId()."' and (estado = '1' or estado = '3') and is_publico = '1'", "", "");



										while ($col=$con->FetchArray($queryanexos)) {

							                $type=explode('.', strtolower($col[url]));

							                $type=array_pop($type);



							                $file = $col["url"];

							                $idb = $col[0];

							                $propietario_documento = false;



							                $bad = (strlen($col[nombre]) > 40)?"...":"";

				 							$nombredoc = substr($col[nombre], 0, 40).$bad;



							                if ($file != "") {



								                $ruta = HOMEDIR.DS."app/archivos_uploads/gestion/".$rg->GetId().trim("/anexos/ ").$file."";

								                $cadena_nombre = substr($file,0,200);

								                $extension = substr($cadena_nombre, strlen($cadena_nombre)-4, strlen($cadena_nombre)); 



							                }



				                	        echo "

				                	        		<div style='float:left'>

				                	        			<input type='checkbox' id='file".$col[id]."' name='anexos[]' value='".$col[id]."'>

				                	        		</div>

				                	        		<div style='float:left' class='nom_anexo' title='$col[nombre]' onclick='AbrirDocumento(\"".$ruta."\",\"".$viewer[$extension]."\",\"".$col["nombre"]."\", \"4\", \"".$col["id"]."\")'>$nombredoc</div>

													<div style='clear:both'></div>

				                	        	";



							            }







						echo '		</td>

									<td>';



									$q = $con->Query("select * from consultas_varias where gestion_id = '".$rg->GetId()."' and type = 'IE'");

									$t = $con->NumRows($q);



									if ($t == "0") {

										echo "<div class='iconv2 line gray' title='No se ha enviado la clave al suscritor de este expediente' ></div>";

									}else{

										$cie = 0;

										while ($rie = $con->FetchAssoc($q)) {

											if ($rie['estado'] == "1") {

												$cie ++;

											}

										}

										if ($cie > 0) {

											echo "<div class='iconv2 properties color' title='Se envió la clave al suscriptor y descargó el documento'></div>";

										}else{

											echo "<div class='iconv2 properties gray' title='Se envió la clave al suscriptor pero este no descargado el documento'></div>";

										}

										

									}



						echo '		</td>

									<td>';

									$q = $con->Query("select * from mailer_message as mm inner join mailer_replys as mr on mr.message_id = mm.message_id where mm.p_id = '".$rg->GetId()."' order by mm.id desc");

									$t = $con->NumRows($q);



									if ($t == "0") {

										echo "<div class='iconv2 line gray' title='Los documentos de este expediente no han sido enviados por correo electrónico certificado' ></div>";

									}else{

										$cie = 0;

										while ($rie = $con->FetchAssoc($q)) {

											if ($rie['message_status'] == "1") {

												$cie ++;

											}

										}

										if ($cie > 0) {

											echo "<div class='iconv2 needtocheck color' title='Se envió este expediente por correo electrónico certificado y fue revisado por el suscriptor'></div>";

										}else{

											if ($rie['exp_day'] >= date("Y-m-d")) {

												echo "<div class='iconv2 waiting color' title='Se envió este expediente por correo electrónico certificado pero no ha tenido acuse de recibido'></div>";

											}else{

												echo "<div class='iconv2 at gray' title='Se envió este expediente por correo electrónico pero no fue revisado por el suscriptor'></div>";

											}

										}

										

									}

						echo '		</td>

									<td>';

									$q = $con->Query("select * from consultas_varias where gestion_id = '".$rg->GetId()."' and type = 'QR'");

									$t = $con->NumRows($q);



									if ($t == "0") {

										echo "<div class='iconv2 line gray' style='cursor:pointer;' onclick='EnviarPorQR(".$rg->GetId().")'  title='No se han generado códigos QR para consultar este expediente\nPresionar para generar QR'></div>";

									}else{

										$cie = 0;

										while ($rie = $con->FetchAssoc($q)) {

											if ($rie['estado'] == "1") {

												$cie ++;

											}

										}

										if ($cie > 0) {

											echo "<div class='iconv2 qr color' title = 'El expediente fue revisado por medio de código QR'></div>";

										}else{

											echo "<div class='iconv2 qr gray' title='El código QR Fue generado pero no ha sido consultado'></div>";

										}

										

									}

						echo '		</td>

									<td>';

										$q = $con->Query("select * from notificaciones where proceso_id = '".$rg->GetId()."' order by id desc");

										$t = $con->NumRows($q);



										if ($t == "0") {

											echo "<div class='iconv2 line gray' title='Este expediente no ha sido enviado por servicios fisicos'></div>";

										}else{

											$cie = 0;

											while ($rie = $con->FetchAssoc($q)) {

												if ($rie['is_certificada'] != "0") {

													$cie ++;

												}

											}

											if ($cie > 0) {

												echo "<div class='iconv2 needtocheck color' title='Este expediente fue enviado y entregado fisicamente'></div>";

											}else{

												if ($rie['guia_id'] != "") {

													echo "<div class='iconv2 messenger color' title='Este expediente se encuentra en proceso de entrega fisica'></div>";

												}else{

													echo "<div class='iconv2 waiting color' title='Este expediente está pendiente de validación en la empresa de mensajería'></div>";

												}

											}

											

										}

						echo '		</td>';

						echo '	</tr>';

					}

?>

								<tr class="encabezado">

									<th class="th_act" colspan="2" >Total de Expedientes</th>

									<th class="th_act"><?= $i ?></th>

									<th class="th_act" colspan="8"></th>

									

								</tr>

							</tbody>

						</table>

					</form>

				</div>

			</div>

		</div>

<script>

	$(document).ready(function() {

			$("th").parent().addClass("encabezadot");

			$("tr.addd:not([th]):even").addClass("par");

			$("tr.addd:not([th]):odd").addClass("impar");




	})

	function checkTodos (id,pID) {

		$( "#" + pID + " :checkbox").attr('checked', $('#' + id).is(':checked')); 

	}



	function EnviarClaves(){

		var DATA = $("#enviarmensajes").serialize();

		if (confirm("¿Esta Seguro que desea enviar las claves de acceso al suscriptor?")) {

	        var URL = '/suscriptores_contactos/EnviarClaves/';

	        $.ajax({

	            type: 'POST',

	            url: URL,

	            data: DATA,

	            success:function(msg){

	                alert(msg);

	            }

	        });

    	}

	}

	function EnviarCorreo(){

		var DATA = $("#enviarmensajes").serialize();

		if (confirm("¿Esta Seguro que desea enviar estos documentos por correo electrónico?")) {

	        var URL = '/correo/EnviarDocumentosCorreo/';

	        $.ajax({

	            type: 'POST',

	            url: URL,

	            data: DATA,

	            success:function(msg){

	                alert(msg);

	            }

	        });

    	}

	}

	function EnviarPorQR(id){

		$("#checkAll4").prop( "checked", false );

		

		checkTodos('checkAll4','tipos_campos');

		$("#exp"+id).prop( "checked", true );

		var DATA = $("#enviarmensajes").serialize();

		if (confirm("¿Esta Seguro que desea generar el codigos QR para estos documentos?")) {

	        var URL = '/correo/EnviarPorQR/';

	        $.ajax({

	            type: 'POST',

	            url: URL,

	            data: DATA,

	            success:function(msg){

	            	//alert(msg);

	            	window.open(msg);

	            }

	        });

    	}

	}

	function EnviarFisico(){

		var DATA = $("#enviarmensajes").serialize();

		if (confirm("¿Esta Seguro que desea enviar estos documentos por mensajería fisica?")) {

	        var URL = '/notificaciones/EnviarFisico/';

	        $.ajax({

	            type: 'POST',

	            url: URL,

	            data: DATA,

	            success:function(msg){

	                alert(msg);

	            }

	        });

    	}

	}

	function BuscarExpedientesfecha(){

		document.location.href='/gestion/correspondencia/0/'+$('#fecha_i').val()+'/'+$('#fecha_f').val()+'/';

	}

</script>

<style>

	.addd{

		cursor:pinter;

	}

	.addd td:hover{

		text-decoration:underline;

		cursor:pointer;

	}

    .listado_acciones{

        float:left;

        line-height: 35px;

        font-size: 12px;

        overflow-y: hidden ; 

        overflow-x: hidden ; 

        padding: 5px;

        padding-right: 9px;

        cursor: normal;

    }

    .listado_acciones:hover{

        text-decoration: underline;

        cursor: pointer;

    }

    .listado_acciones .impr_box ul{

		margin-left:-127px;	

		font-size: 10px;

	}

</style>





