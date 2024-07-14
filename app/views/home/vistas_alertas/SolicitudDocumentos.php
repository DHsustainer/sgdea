<?
global $c;
?>
<script type="text/javascript">
  $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip(); 
        $('[data-toggle="popover"]').popover()
  });
</script>

	<div class="row fullheight">
		<div class="col-md-12">
			<ul class="nav nav-pills m-b-30 " role="tablist" id="tab_navegacion_widgets">
				<?

						$itdt = $id;
						$totd = 1;
						$tots = 1;
						$totc = 1;
				
						$menuactivea = "display:block";
						$menuactiveb = "";
						$menuactivec = "";

						$tabactivea = "active";
						$tabactiveb = "";
						$tabactivec = "";

						if ($totd <= 0) {
							if ($tots > 0) {
								$menuactiveb = "display:block;";
								$tabactiveb = "active";

								$menuactivea = "";
								$tabactivea = "";
								$menuactivec = "";
								$tabactivec = "";

							}elseif ($totc > 0) {
								$menuactivec = "display:block;";
								$tabactivec = "active";

								$menuactivea = "";
								$tabactivea = "";
								$menuactiveb = "";
								$tabactiveb = "";
							}else{

								$menuactivea = "display:block";
								$menuactiveb = "";
								$menuactivec = "";

								$tabactivea = "active";
								$tabactiveb = "";
								$tabactivec = "";

							}
						}
					

				?>
				<li  <?= $c->Ayuda('164', 'tog') ?> onClick="CargarAlerta2(1, 'Solicitudes de Documentos', 'solicituddocumentos', '1', 'tab1');ActivarTab('tab1', 'buscartab1')" id="buscartab1" role="presentation" class="<?= $tabactivea ?>"><a href="#">Solicitudes Pendientes</a></li>
				<li  <?= $c->Ayuda('165', 'tog') ?> onClick="CargarAlerta2(1, 'Solicitudes de Documentos', 'solicituddocumentos', '1', 'tab2');ActivarTab('tab2', 'buscartab2')" id="buscartab2" role="presentation" class="<?= $tabactiveb ?>"><a href="#">Solicitudes Realizadas</a></li>
				<li  <?= $c->Ayuda('166', 'tog') ?> onClick="CargarAlerta2(1, 'Solicitudes de Documentos', 'solicituddocumentos', '1', 'tab3');ActivarTab('tab3', 'buscartab3')" id="buscartab3" role="presentation" class="<?= $tabactivec ?>"><a href="#">Solicitudes Aceptadas/Rechazadas</a></li>
			</ul>
			<div id="tab1" style="<?= $menuactivea ?>">
				
<?
			if($tab=='tab1'){
				echo "<ul class='list-group'>";
				$pag = $tipo;
				$RegistrosAMostrar = 5;
				if(isset($pag)){
					$RegistrosAEmpezar=($pag-1)*$RegistrosAMostrar;
					$PagAct=$pag;
				}else{
					$RegistrosAEmpezar=0;
					$PagAct=1;
				}

				$ic = 0;
                $datos = '';
                $ord = 0;
				$MSolicitudes_documentos = new MSolicitudes_documentos;

				$sql = "SELECT * FROM solicitudes_documentos  WHERE usuario_destino ='".$_SESSION['usuario']."' and estado = '0' order by fecha_solicitud";
				$consulta = $sql;
				$sql .= " limit $RegistrosAEmpezar, $RegistrosAMostrar ";
				$qwa = $con->Query($sql); 

				$estados = array("0" => "Pendiente por Aprobar", "1" => "Compartido", "2" => "Rechazado", "3" => "Vencido");

				while($rrt = $con->FetchArray($qwa)){
					$ic++;
					$c = new Consultas;

					$fecha_solicitud = $rrt['fecha_solicitud'];
					
					$usuarios_s = new MUsuarios;
					$usuarios_s->CreateUsuarios("user_id", $rrt['usuario_solicita']);

					$area = $c->GetDataFromTable("areas", "id", $usuarios_s->GetRegimen(), "nombre", $separador = " ");
					$usuario = $usuarios_s->GetP_nombre()." ".$usuarios_s->GetP_apellido()." - $area";

					$gestion_id = "NS";
					if ($rrt['gestion_id'] != "0") {
						$g = new MGestion;
						$g->CreateGestion("id", $rrt['gestion_id']);
						$gestion_id = "<a href='/gestion/ver/".$g->GetId()."/' target='_blank'>".$g->GetMin_rad()."</a>";

						$suscriptordata = $c->GetDataFromTable("dependencias", "id", $g->GetTipo_documento(), "nombre", $separador = " ")." - ".$c->GetDataFromTable("suscriptores_contactos", "id", $g->GetSuscriptor_id(), "nombre", $separador = " ").""; 
						$NUMRADICACION = "<a href='/gestion/ver/".$g->GetId()."/'>".$suscriptordata." <small>".$g->GetMin_rad()."</small></a> - ".$rrt['observacion'];
					}
					$path = '<button type="button" class="btn btn-default btn-circle btn-lg m-r-5 " >
								<i class="faicon fa fa-folder-open-o"></i> 
							</button>';

					echo "	<li class='list-group-item'>
								<div class='row'>
									<div class='col-md-1'>
										$path
									</div>
									<div class='col-md-10' style='cursor:pointer;' onclick='".'window.location.href="/solicitudes_documentos/listar/"'."'>
										<div class='link_asunto'><span class='link_subtitulo' style='color:#666'>Expediente: ".$NUMRADICACION."</span></div>
										<div class='link_asunto'><span class='link_subtitulo' style='color:#666'>Solicitante: ".$usuario."</span></div>
										<div class='link_fecha'>Estado: ".$estados[$rrt['estado']]." Fecha: ".$rrt['fecha_solicitud']."</div>
									</div>
								</div>
							</li>";

				}

				if($ic == '0' ){
					echo "	<li class='list-group-item'>
								<div id='messageSolicitudDocumentos'><div  class='alert alert-info'>No tienes Solicitudes de Documentos :-)</div><br><br></div>
							</li>
						";
				}
				echo "</ul>";
				echo '<div class="btn-group m-t-30">';
				$qwat = $con->Query($consulta);
        		$NroRegistros = $con->NumRows($qwat);

				$PagAnt=$PagAct-1;
		        $PagSig=$PagAct+1;
		        $PagUlt=$NroRegistros/$RegistrosAMostrar;
		        $Res=$NroRegistros%$RegistrosAMostrar;
				if ($bon == "1") {
			        if($Res>0) $PagUlt=floor($PagUlt);if($PagUlt==0){$PagUlt=1;}
				        echo "<button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Solicitudes de Documentos\", \"solicituddocumentos\", \"1\", \"tab1\")' >Pag. 1</button> ";
			        if($PagAct>1) 
				        echo "<button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Solicitudes de Documentos\", \"solicituddocumentos\", \"$PagAnt\", \"tab1\")'>Pag. Ant.</button> ";
				        echo "<button type='button' class='btn btn-info waves-effect'>Pagina ".$PagAct." de ".$PagUlt."</button>";
			        if($PagAct<$PagUlt)  
				        echo " <button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Solicitudes de Documentos\", \"solicituddocumentos\", \"$PagSig\", \"tab1\")'>Pag. Sig.</button>  ";
				        echo " <button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Solicitudes de Documentos\", \"solicituddocumentos\", \"$PagUlt\", \"tab1\")'>Pag. $PagUlt</button> ";
				}else{
			        if($Res>0) $PagUlt=floor($PagUlt);if($PagUlt==0){$PagUlt=1;}
				        echo "<button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Solicitudes de Documentos\", \"solicituddocumentos\", \"1\", \"tab1\")' >Pag. 1</button> ";
			        if($PagAct>1) 
				        echo "<button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Solicitudes de Documentos\", \"solicituddocumentos\", \"$PagAnt\", \"tab1\")'>Pag. Ant.</button> ";
				        echo "<button type='button' class='btn btn-info waves-effect'>Pagina ".$PagAct." de ".$PagUlt."</button>";
			        if($PagAct<$PagUlt)  
				        echo " <button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Solicitudes de Documentos\", \"solicituddocumentos\", \"$PagSig\", \"tab1\")'>Pag. Sig.</button>  ";
				        echo " <button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Solicitudes de Documentos\", \"solicituddocumentos\", \"$PagUlt\", \"tab1\")'>Pag. $PagUlt</button> ";
				}
		   		echo '</div>';
			}
?>			
				
			</div>
			<div id="tab2" style="<?= $menuactiveb ?>">
<?
				if($tab=='tab2'){
				echo "<ul class='list-group'>";
				$pag = $tipo;
				$RegistrosAMostrar = 5;
				if(isset($pag)){
					$RegistrosAEmpezar=($pag-1)*$RegistrosAMostrar;
					$PagAct=$pag;
				}else{
					$RegistrosAEmpezar=0;
					$PagAct=1;
				}
				$ic = 0;
                $datos = '';
                $ord = 0;
				$MSolicitudes_documentos = new MSolicitudes_documentos;

				$sql = "SELECT * FROM solicitudes_documentos  WHERE usuario_solicita ='".$_SESSION['usuario']."' and estado = '0' order by fecha_solicitud";
				$consulta = $sql;
				$sql .= " limit $RegistrosAEmpezar, $RegistrosAMostrar ";
				$qwa = $con->Query($sql); 

				$estados = array("0" => "Pendiente por Aprobar", "1" => "Compartido", "2" => "Rechazado", "3" => "Vencido");

				while($rrt = $con->FetchArray($qwa)){
					$ic++;
					$c = new Consultas;

					$fecha_solicitud = $rrt['fecha_solicitud'];
					
					$usuarios_s = new MUsuarios;
					$usuarios_s->CreateUsuarios("user_id", $rrt['usuario_destino']);

					$area = $c->GetDataFromTable("areas", "id", $usuarios_s->GetRegimen(), "nombre", $separador = " ");
					$usuario = $usuarios_s->GetP_nombre()." ".$usuarios_s->GetP_apellido()." - $area";

					$gestion_id = "NS";
					if ($rrt['gestion_id'] != "0") {
						$g = new MGestion;
						$g->CreateGestion("id", $rrt['gestion_id']);
						$gestion_id = "<a href='/gestion/ver/".$g->GetId()."/' target='_blank'>".$g->GetMin_rad()."</a>";

						$suscriptordata = $c->GetDataFromTable("dependencias", "id", $g->GetTipo_documento(), "nombre", $separador = " ")." - ".$c->GetDataFromTable("suscriptores_contactos", "id", $g->GetSuscriptor_id(), "nombre", $separador = " ").""; 
						$NUMRADICACION = "<a href='/gestion/ver/".$g->GetId()."/'>".$suscriptordata." <small>".$g->GetMin_rad()."</small></a> - ".$rrt['observacion'];
					}

					$path = '<button type="button" class="btn btn-default btn-circle btn-lg m-r-5 " >
								<i class="faicon fa fa-folder-open-o"></i> 
							</button>';

					echo "	<li class='list-group-item'>
								<div class='row'>
									<div class='col-md-1'>
										$path
									</div>
									<div class='col-md-10' style='cursor:pointer;' onclick='".'window.location.href="/solicitudes_documentos/listar/"'."'>
										<div class='link_asunto'><span class='link_subtitulo' style='color:#666'>Expediente: ".$NUMRADICACION."</span></div>
										<div class='link_asunto'><span class='link_subtitulo' style='color:#666'>Solicitado A: ".$usuario."</span></div>
										<div class='link_fecha'>Estado: ".$estados[$rrt['estado']]." Fecha: ".$rrt['fecha_solicitud']."</div>
									</div>
								</div>
							</li>";

				}

				if($ic == '0' ){
					echo "	<li class='list-group-item'>
								<div id='messageSolicitudDocumentos'><div  class='alert alert-info'>No tienes Solicitudes de Documentos :-)</div><br><br></div>
							</li>
						";
				}
				echo "</ul>";
				echo '<div class="btn-group m-t-30">';
				$qwat = $con->Query($consulta);
        		$NroRegistros = $con->NumRows($qwat);

				$PagAnt=$PagAct-1;
		        $PagSig=$PagAct+1;
		        $PagUlt=$NroRegistros/$RegistrosAMostrar;
		        $Res=$NroRegistros%$RegistrosAMostrar;
				if ($bon == "1") {
			        if($Res>0) $PagUlt=floor($PagUlt);if($PagUlt==0){$PagUlt=1;}
				        echo "<button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Solicitudes de Documentos\", \"solicituddocumentos\", \"1\", \"tab2\")' >Pag. 1</button> ";
			        if($PagAct>1) 
				        echo "<button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Solicitudes de Documentos\", \"solicituddocumentos\", \"$PagAnt\", \"tab2\")'>Pag. Ant.</button> ";
				        echo "<button type='button' class='btn btn-info waves-effect'>Pagina ".$PagAct." de ".$PagUlt."</button>";
			        if($PagAct<$PagUlt)  
				        echo " <button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Solicitudes de Documentos\", \"solicituddocumentos\", \"$PagSig\", \"tab2\")'>Pag. Sig.</button>  ";
				        echo " <button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Solicitudes de Documentos\", \"solicituddocumentos\", \"$PagUlt\", \"tab2\")'>Pag. $PagUlt</button> ";
				}else{
			        if($Res>0) $PagUlt=floor($PagUlt);if($PagUlt==0){$PagUlt=1;}
				        echo "<button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Solicitudes de Documentos\", \"solicituddocumentos\", \"1\", \"tab2\")' >Pag. 1</button> ";
			        if($PagAct>1) 
				        echo "<button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Solicitudes de Documentos\", \"solicituddocumentos\", \"$PagAnt\", \"tab2\")'>Pag. Ant.</button> ";
				        echo "<button type='button' class='btn btn-info waves-effect'>Pagina ".$PagAct." de ".$PagUlt."</button>";
			        if($PagAct<$PagUlt)  
				        echo " <button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Solicitudes de Documentos\", \"solicituddocumentos\", \"$PagSig\", \"tab2\")'>Pag. Sig.</button>  ";
				        echo " <button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Solicitudes de Documentos\", \"solicituddocumentos\", \"$PagUlt\", \"tab2\")'>Pag. $PagUlt</button> ";
				}
		   		echo '</div>';
		   	}

?>
			</div>
			<div id="tab3" style="<?= $menuactivec ?>">
<?
			if($tab=='tab3'){
				echo "<ul class='list-group'>";
				$pag = $tipo;
				$RegistrosAMostrar = 5;
				if(isset($pag)){
					$RegistrosAEmpezar=($pag-1)*$RegistrosAMostrar;
					$PagAct=$pag;
				}else{
					$RegistrosAEmpezar=0;
					$PagAct=1;
				}
				$ic = 0;
                $datos = '';
                $ord = 0;
				$MSolicitudes_documentos = new MSolicitudes_documentos;

				$sql = "SELECT * FROM solicitudes_documentos WHERE usuario_destino ='".$_SESSION['usuario']."' order by fecha_solicitud";
				$consulta = $sql;
				$sql .= " limit $RegistrosAEmpezar, $RegistrosAMostrar ";
				$qwa = $con->Query($sql); 				
				$estados = array("0" => "Pendiente por Aprobar", "1" => "Compartido", "2" => "Rechazado", "3" => "Vencido");

				while($rrt = $con->FetchArray($qwa)){
					$ic++;
					$c = new Consultas;

					$fecha_solicitud = $rrt['fecha_solicitud'];
					
					$usuarios_s = new MUsuarios;
					$usuarios_s->CreateUsuarios("user_id", $rrt['usuario_solicita']);

					$area = $c->GetDataFromTable("areas", "id", $usuarios_s->GetRegimen(), "nombre", $separador = " ");
					$usuario = $usuarios_s->GetP_nombre()." ".$usuarios_s->GetP_apellido()." - $area";

					$gestion_id = "NS";
					if ($rrt['gestion_id'] != "0") {
						$g = new MGestion;
						$g->CreateGestion("id", $rrt['gestion_id']);
						$gestion_id = "<a href='/gestion/ver/".$g->GetId()."/' target='_blank'>".$g->GetMin_rad()."</a>";

						$suscriptordata = $c->GetDataFromTable("dependencias", "id", $g->GetTipo_documento(), "nombre", $separador = " ")." - ".$c->GetDataFromTable("suscriptores_contactos", "id", $g->GetSuscriptor_id(), "nombre", $separador = " ").""; 
						$NUMRADICACION = "<a href='/gestion/ver/".$g->GetId()."/'>".$suscriptordata." <small>".$g->GetMin_rad()."</small></a> - ".$rrt['observacion'];
					}
					$path = '<button type="button" class="btn btn-default btn-circle btn-lg m-r-5 " >
								<i class="faicon fa fa-folder-open-o"></i> 
							</button>';

					echo "	<li class='list-group-item'>
								<div class='row'>
									<div class='col-md-1'>
										$path
									</div>
									<div class='col-md-10' style='cursor:pointer;' onclick='".'window.location.href="/solicitudes_documentos/listar/"'."'>
										<div class='link_asunto'><span class='link_subtitulo' style='color:#666'>Expediente: ".$NUMRADICACION."</span></div>
										<div class='link_asunto'><span class='link_subtitulo' style='color:#666'>Solicitante: ".$usuario."</span></div>
										<div class='link_fecha'>Estado: ".$estados[$rrt['estado']]." Fecha: ".$rrt['fecha_solicitud']."</div>
									</div>
								</div>
							</li>";

				}

				if($ic == '0' ){
					echo "	<li class='list-group-item'>
								<div id='messageSolicitudDocumentos'><div  class='alert alert-info'>No tienes Solicitudes de Documentos :-)</div><br><br></div>
							</li>
						";
				}
				echo "</ul>";
				echo '<div class="btn-group m-t-30">';
				$qwat = $con->Query($consulta);
        		$NroRegistros = $con->NumRows($qwat);

				$PagAnt=$PagAct-1;
		        $PagSig=$PagAct+1;
		        $PagUlt=$NroRegistros/$RegistrosAMostrar;
		        $Res=$NroRegistros%$RegistrosAMostrar;
				if ($bon == "1") {
			        if($Res>0) $PagUlt=floor($PagUlt);if($PagUlt==0){$PagUlt=1;}
				        echo "<button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Solicitudes de Documentos\", \"solicituddocumentos\", \"1\", \"tab3\")' >Pag. 1</button> ";
			        if($PagAct>1) 
				        echo "<button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Solicitudes de Documentos\", \"solicituddocumentos\", \"$PagAnt\", \"tab3\")'>Pag. Ant.</button> ";
				        echo "<button type='button' class='btn btn-info waves-effect'>Pagina ".$PagAct." de ".$PagUlt."</button>";
			        if($PagAct<$PagUlt)  
				        echo " <button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Solicitudes de Documentos\", \"solicituddocumentos\", \"$PagSig\", \"tab3\")'>Pag. Sig.</button>  ";
				        echo " <button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Solicitudes de Documentos\", \"solicituddocumentos\", \"$PagUlt\", \"tab3\")'>Pag. $PagUlt</button> ";
				}else{
			        if($Res>0) $PagUlt=floor($PagUlt);if($PagUlt==0){$PagUlt=1;}
				        echo "<button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Solicitudes de Documentos\", \"solicituddocumentos\", \"1\", \"tab3\")' >Pag. 1</button> ";
			        if($PagAct>1) 
				        echo "<button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Solicitudes de Documentos\", \"solicituddocumentos\", \"$PagAnt\", \"tab3\")'>Pag. Ant.</button> ";
				        echo "<button type='button' class='btn btn-info waves-effect'>Pagina ".$PagAct." de ".$PagUlt."</button>";
			        if($PagAct<$PagUlt)  
				        echo " <button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Solicitudes de Documentos\", \"solicituddocumentos\", \"$PagSig\", \"tab3\")'>Pag. Sig.</button>  ";
				        echo " <button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Solicitudes de Documentos\", \"solicituddocumentos\", \"$PagUlt\", \"tab3\")'>Pag. $PagUlt</button> ";
				}
		   		echo '</div>';
			}

?>
			</div>
		</div>
	</div>


	

<script type="text/javascript">
	$(document).ready(function(){
		$(".breadcrumb li").last().addClass("active");
	});

	function ActivarTab(tab, selector){

		$("#buscartab1").removeClass('active');
		$("#buscartab2").removeClass('active');
		$("#buscartab3").removeClass('active');

		$("#tab1").css('display', 'none');
		$("#tab2").css('display', 'none');
		$("#tab3").css('display', 'none');

		$("#"+selector).addClass("active");
		$("#"+tab).css("display", 'block');

	}
	ActivarTab('<?php echo $tab; ?>', 'buscar<?php echo $tab; ?>');
</script>
<style type="text/css">
	
	.busquedaresultadotab{
	    min-height: 400px;
	    border-top: none;
	    margin-top: -1px;
	    display: none;
	}

	#tab_navegacion_widgets.nav>li>a {
	    position: relative;
	    display: block;
	    padding: 10px 15px;
	}

</style>
