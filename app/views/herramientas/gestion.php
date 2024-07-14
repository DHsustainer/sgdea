<?
	if ($_SESSION['areas_trabajo'] == "0") {
		header("LOCATION: ".HOMEDIR.trim(" /dashboard/"));
	}
?>

	<div class="item-herr proce-herr">

		<div class="item-content">

			<div id="gestiones">

				<div id="titles-gest">

					<div class="title-gest active" id="onactiona" onclick="select_gest('natu-per',this)">Tablas de Retencion</div>

					<div class="title-gest" id="onactionb" onclick="select_gest('subsr-per',this)">Conf. Sub-Serie</div> 

					

				</div>



				<div class="item-gest natu-per">

					<div id="list_nat" class="item-content-gest">

						<div id="form">

							<div id="gestion-version">

							    <h3 style="margin-left:30px"> Version de la Tabla de Retención Documental: 
							       	<select  name='id_trd' id='id_trd' class="textbox important"  style="font-size: 15px"  onchange="ChangeEmpresaTRD()" >
										<?php
										$MDependencias_version = new MDependencias_version;
										$lits = $MDependencias_version->ListarDependencias_version();
										while ($row = $con->FetchAssoc($lits)) {
											$select = "";
											if($_SESSION['id_trd'] == $row['id']){
												$select = "selected";
											}
											echo "<option value='".$row['id']."' $select>".$row["nombre"]."</option>";
										}
										?>
									</select>
								</h3>

							</div>

						    <div id="gestion-actuaciones">

						        <div id="editararea" class="left table">

						        	<div class="title right">Crear Series Documentales</div>

						        	<br>

									<?

										$id_dependencia = 0;

										echo "<div id='insertdependenciafirst'>";

										include(VIEWS.DS."dependencias".DS."FormInsertDependencias.php");

										echo "</div>

											<div id='listadodependencias'>";

										#echo VIEWS.DS."seccional_principal".DS."Listar.php";

										$areas = new MDependencias;

										// DE NO RECIBIR PARAMETROS ESTA FUNCION TRAE EL LISTADO COMPLETO DE LIBROS

										$query = $areas->ListarDependencias(" WHERE dependencia = '0' and id_version = '".$_SESSION['id_trd']."'");	    

										echo '<div class="title right">Listado de Series Documentales</div>	';

										include(VIEWS.DS."dependencias".DS."Listar.php");

										echo "</div>";

									?>	

								</div>

							</div>

							<div id="gestion-actuaciones">

							    <div class="title right">Sub Series Documentales</div>

							    <br>

						        <div class="table" id="listadosubseries">

									<div class="alert alert-info">Seleccione una Serie Documental</div>

								</div>

							</div>							

						</div>

					</div>

				</div>

				<div class="item-gest subsr-per" style="display:none">

					<div id="list_nat" class="item-content-gest">

						<div id="formsubsrs">

						    <?

						    	include(VIEWS.DS."dependencias/DepDependencias.php");

						    ?>							

						</div>

					</div>

				</div>

			</div>

		</div>

	</div>

