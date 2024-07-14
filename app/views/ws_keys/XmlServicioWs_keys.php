<?php
$ARR_KEY = array('GET' => 'Registro', 'SET' => 'Consulta', 'ADD' => 'Documento');
$city = new MCity;
$city->CreateCity("code", $object -> GetCiudad());
$ciudad = $city->GetName();

$dp = new MProvince;
$dp->CreateProvince("code", $object -> GetDepartamento());
$province = $dp->GetName();

$of = new MSeccional;
$of->CreateSeccional("id", $object -> GetOficina());
$oficina = $of->GetNombre();

$area = new MAreas;
$area->CreateAreas("id", $object -> GetArea());
$narea = $area->GetNombre();

$u = new MUsuarios;
$u->CreateUsuarios("a_i", $object -> GetUsuario_destino());
$nombreresponsable = $u->GetP_nombre()." ".$u->GetP_apellido();

$d = new MDependencias();
$d->CreateDependencias("id", $object -> GetSerie());
$serie = $d->GetNombre();

$d->CreateDependencias("id", $object -> GetSubserie());
$subserie = $d->GetNombre();

$nombre_formulario = '';
if($object -> GetFormulario() > 0){
	$ane = $con->FetchAssoc($con->Query("select * from meta_referencias_titulos where id = '".$object -> GetFormulario()."'"));
	$nombre_formulario = $ane['titulo'];
}
?>
<div class="left-table">

	<div class="row">

		<div class="col-md-6 col-md-offset-3" style="margin-top:50px;">

			<form id='formws_keys' method='POST'> 
				<h5><b>Servicio Web para <?= $ARR_KEY[$object->GetTipokey()]; ?></b></h5>
				<h4><?php echo $object->GetNombre();?></h4>
				<h5><b>Key id:</b> <?php echo $object->GetLlave();?></h5>

				<div class="row" style="margin:10px;">
				 	<div class="12u 12u(narrower)">
						<br><b>Url Consumo Servicio</b><br>
						<?php echo HOMEDIR;?>/ws/xml/ws.xml.gestion.wsdl
					</div>
				</div>
				<div class="row" style="margin:10px;">
				 	<div class="12u 12u(narrower)">
						<br><b>Metodo Consumo Servicio</b><br>
						Gestion.<?php echo ucwords(strtolower($object->GetTipokey()));?>DataXml
					</div>
				</div>

				<div class="row" style="margin:10px;">
				 	<div class="12u 12u(narrower)">
						<br><b>Variables Entrada</b><br>
						<i>xmlstring:</i> Se debe enviar un string xml que se detalla a continuacion cambiando los ? por los valores a enviar
					</div>
				</div>

				<div class="row" style="margin:10px;">
				 	<div class="12u 12u(narrower)">
						<br><b>StrintXml</b><br>
						<?php 
							/*echo htmlentities('<?xml version="1.0" encoding="UTF-8"?>');
							echo "<br>";*/
							//echo htmlentities("<![CDATA[");
							//echo "<br>";
							echo htmlentities("<parametros>");
							echo "<br>";
							echo htmlentities("<keyid>".$object->GetLlave()."</keyid>");
							echo "<br>";
							echo htmlentities("<tipokey>".$ARR_KEY[$object->GetTipokey()]."</tipokey>");
							echo "<br>";
							echo htmlentities("<ipconsumo>".$object->GetIpkey()."</ipconsumo>");
							echo "<br>";
							if($object->GetTipokey() == "SET"){
								echo htmlentities("<codigo_proceso>?</codigo_proceso>");
								echo "<br>";
								/*echo htmlentities("<codigo_externo>?</codigo_externo>");
								echo "<br>";*/
							}else if($object->GetTipokey() == "GET"){
								echo htmlentities("<departamento>".$province."</departamento>");
								echo "<br>";
								echo htmlentities("<municipio>".$ciudad."</municipio>");
								echo "<br>";
								echo htmlentities("<oficina>".$oficina."</oficina>");
								echo "<br>";
								echo htmlentities("<dependencia>".$narea."</dependencia>");
								echo "<br>";
								echo htmlentities("<responsable>".$nombreresponsable."</responsable>");
								echo "<br>";
								echo htmlentities("<nombre_serie>".$serie."</nombre_serie>");
								echo "<br>";
								echo htmlentities("<nombre_subserie>".$subserie."</nombre_subserie>");
								echo "<br>";
								echo htmlentities("<titulo_exp>?</titulo_exp>");
								echo "<br>";
								echo htmlentities("<radicado>?</radicado>");
								echo "<br>";
								echo htmlentities("<fecha_apertura><anio>0000</anio><mes>00</mes><dia>00</dia></fecha_apertura>");
								echo "<br>";
								echo htmlentities("<fecha_cierre><anio>0000</anio><mes>00</mes><dia>00</dia></fecha_cierre>");
								echo "<br>";

								echo htmlentities("<nit_suscriptor>?</nit_suscriptor>");
								echo "<br>";
								echo htmlentities("<nombre_suscriptor>?</nombre_suscriptor>");
								echo "<br>";
								echo htmlentities("<direccion_suscriptor>?</direccion_suscriptor>");
								echo "<br>";
								echo htmlentities("<telefonos_suscriptor>?</telefonos_suscriptor>");
								echo "<br>";
								echo htmlentities("<email_suscriptor>?</email_suscriptor>");
								echo "<br>";
								echo htmlentities("<codigo_externo>?</codigo_externo>");
								echo "<br>";

								if($nombre_formulario != ''){
									echo htmlentities("<formulario>");
									echo "<br>";
									$resulg = $con->Query("select * from meta_referencias_campos where id_referencia = '".$object -> GetFormulario()."'");
									while($rowf = $con->FetchAssoc($resulg)){
										echo htmlentities("<".$rowf['slug'].">?</".$rowf['slug'].">");
										echo "<br>";
									}
									echo htmlentities("</formulario>");
									echo "<br>";
								}

							}else if($object->GetTipokey() == "ADD"){
								echo htmlentities("<codigo_proceso>?</codigo_proceso>");
								echo "<br>";
								echo htmlentities("<documento>");
								echo "<br>";
								echo htmlentities("<nombre_documento>?</nombre_documento>");
								echo "<br>";
								echo htmlentities("<formato_documento>?</formato_documento>");
								echo "<br>";
								echo htmlentities("<paginas_documento>?</paginas_documento>");
								echo "<br>";
								echo htmlentities("<tamano_documento>?</tamano_documento>");
								echo "<br>";
								echo htmlentities("<base64_documento>?</base64_documento>");
								echo "<br>";
								echo htmlentities("</documento>");
								echo "<br>";
							}
							echo htmlentities("</parametros>");
							//echo "<br>";
							//echo htmlentities("]]>");
							
							

						?>
					</div>
				</div>

				<div class="row" style="margin:10px;">
				 	<div class="12u 12u(narrower)">
						<br><b>Variables Salida</b><br>
						Se retorna un string xml.<br>
						<br><i>Retorno Positivo/Efectivo</i><br>
						<?php 
						if($object->GetTipokey() == 'SET'){
							echo '
							Elemento Salida: ok palabra reservada para indicar que se realizo la accion.<br>
							Elemento Mensaje: Descripcion la accion.<br>
							Elemento Expediente: Contine los elementos retornados del expediente.';
						}
						if($object->GetTipokey() == 'ADD'){
							echo '
							Elemento Salida: ok palabra reservada para indicar que se realizo la accion.<br>
							Elemento Mensaje: Descripcion la accion.<br>
							Elemento codigos_add: Contine los Huellas de cada elemento creado separado por coma(,).';
						}
						if($object->GetTipokey() == 'GET'){
							echo '
							Elemento Salida: ok palabra reservada para indicar que se realizo la accion.<br>
							Elemento Mensaje: Descripcion la accion.<br>
							Elemento radicado: Codigo unico que ientifica al expediente creado.<br>
							Elemento uri: Enlace de Consulta Publica.';
						}
						?><br>
						<br><i>Retorno Negativo/Error:</i><br>
						Elemento Salida: ERROR palabra reservada para indicar que se produjo un error.<br>
						Elemento Mensaje: Descripcion del error.<br>
					</div>
				</div>

				<div class="row" style="margin:10px;">
				 	<div class="12u 12u(narrower)">
						<input type="button" value="Regresar" style="margin:10px;" onclick="javascript:document.location.href='/herramientas/otras/oi/';">
					</div>
				</div>
				

			</form>

			<div id="dump"></div>



		</div>

	</div>	

</div>	