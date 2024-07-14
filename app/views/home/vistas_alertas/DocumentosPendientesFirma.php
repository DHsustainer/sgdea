<?
	$sent = false;
	if (!isset($_SESSION['ACTIVEKEY'])) {
		if($_SESSION['MODULES']['firma_electronica'] == "1"){
			$sent = true;
		}
	}		
	if ($_SESSION['MODULES']['firma_electronica'] == "1" || $_SESSION['MODULES']['firma_digital'] == "1") {
	
?>

			<!--<ul class="nav customtab nav-tabs" role="tablist">
			    <li role="presentation" class="active">
			    	<a href="#home1" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="true">
			    		<span class="visible-xs"><i class="ti-home"></i></span>
			    		<span class="hidden-xs"> Home</span>
			    	</a>
			    </li>
			    <li role="presentation" class="">
			    	<a href="#profile1" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false">
			    		<span class="visible-xs"><i class="ti-user"></i></span> 
			    		<span class="hidden-xs">Profile</span>
			    	</a>
			    </li>
			</ul>-->

	<div class="row fullheight">
		<div class="col-md-12">
			<ul class="nav nav-pills m-b-30 " role="tablist" id="tab_navegacion_widgets">
				<?

					$menuactiveb = "display:block;";
					$tabactiveb = "active";

					$menuactivea = "";
					$tabactivea = "";
					$menuactivec = "";
					$tabactivec = "";
					$tabactived = "";
				?>
				<li onClick="CargarAlerta2(1, 'Documentos Para Firmar', 'documentospendientesfirma', '1', 'tab1');ActivarTab('tab1', 'buscartab1')" id="buscartab1" role="presentation" class="<?= $tabactivea ?>">
					<a href="#" <?= $c->Ayuda("95", 'tog') ?>>Pendientes Para Firmar</a>
				</li>
				<li onClick="CargarAlerta2(1, 'Documentos Para Firmar', 'documentospendientesfirma', '1', 'tab2');ActivarTab('tab2', 'buscartab2')" id="buscartab2" role="presentation" class="<?= $tabactiveb ?>">
					<a href="#"<?= $c->Ayuda("96", 'tog') ?>>Firmados o Revisados</a>
				</li>
				<li onClick="CargarAlerta2(1, 'Documentos Para Firmar', 'documentospendientesfirma', '1', 'tab3');ActivarTab('tab3', 'buscartab3')" id="buscartab3" role="presentation" class="<?= $tabactivec ?>">
					<a href="#"<?= $c->Ayuda("97", 'tog') ?>>Documentos Rechazados</a>
				</li>
				<li onClick="CargarAlerta2(1, 'Documentos Para Firmar', 'documentospendientesfirma', '1', 'tab4');ActivarTab('tab4', 'buscartab4')" id="buscartab4" role="presentation" class="<?= $tabactived ?>">
					<a href="#"<?= $c->Ayuda("98", 'tog') ?>>Solicitudes Enviadas</a>
				</li>
			</ul>
			<div id="tab1" style="<?= $menuactivea ?>">
<?				
				if($tab=='tab1'){
					echo "<div class='list-group'>";
				
					$pag = $tipo;
					$RegistrosAMostrar = 5;
					if(isset($pag)){
						$RegistrosAEmpezar=($pag-1)*$RegistrosAMostrar;
						$PagAct=$pag;
					}else{
						$RegistrosAEmpezar=0;
						$PagAct=1;
					}
					$ic=0;
	                $datos = '';
	                $ord = 0;
					$MGestion_anexos_firmas = new MGestion_anexos_firmas;
					$q_str = "SELECT * FROM gestion_anexos_firmas where usuario_firma = '".$_SESSION['usuario']."' and estado_firma = '0'"; 
					$consulta = $q_str;
					$q_str .= " limit $RegistrosAEmpezar, $RegistrosAMostrar ";
					$qwa = $con->Query($q_str); 
					#$qwa = $MGestion_anexos_firmas->ListarGestion_anexos_firmas("where usuario_firma = '".$_SESSION['usuario']."' and estado_firma = '0'");

					$query = $qwa;
					$firmar = true;
					include(VIEWS.DS.'gestion_anexos_firmas/Listar.php');
					
					echo "</div>";
				echo '<div class="btn-group m-t-30">';
				$qwat = $con->Query($consulta);
        		$NroRegistros = $con->NumRows($qwat);

				$PagAnt=$PagAct-1;
		        $PagSig=$PagAct+1;
		        $PagUlt=$NroRegistros/$RegistrosAMostrar;
		        $Res=$NroRegistros%$RegistrosAMostrar;
				if ($bon == "1") {
			        if($Res>0) $PagUlt=floor($PagUlt);if($PagUlt==0){$PagUlt=1;}
				        echo "<button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Documentos Para Firmar\", \"documentospendientesfirma\", \"1\", \"tab1\")' >Pag. 1</button> ";
			        if($PagAct>1) 
				        echo "<button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Documentos Para Firmar\", \"documentospendientesfirma\", \"$PagAnt\", \"tab1\")'>Pag. Ant.</button> ";
				        echo "<button type='button' class='btn btn-info waves-effect'>Pagina ".$PagAct." de ".$PagUlt."</button>";
			        if($PagAct<$PagUlt)  
				        echo " <button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Documentos Para Firmar\", \"documentospendientesfirma\", \"$PagSig\", \"tab1\")'>Pag. Sig.</button>  ";
				        echo " <button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Documentos Para Firmar\", \"documentospendientesfirma\", \"$PagUlt\", \"tab1\")'>Pag. $PagUlt</button> ";
				}else{
			        if($Res>0) $PagUlt=floor($PagUlt);if($PagUlt==0){$PagUlt=1;}
				        echo "<button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Documentos Para Firmar\", \"documentospendientesfirma\", \"1\", \"tab1\")' >Pag. 1</button> ";
			        if($PagAct>1) 
				        echo "<button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Documentos Para Firmar\", \"documentospendientesfirma\", \"$PagAnt\", \"tab1\")'>Pag. Ant.</button> ";
				        echo "<button type='button' class='btn btn-info waves-effect'>Pagina ".$PagAct." de ".$PagUlt."</button>";
			        if($PagAct<$PagUlt)  
				        echo " <button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Documentos Para Firmar\", \"documentospendientesfirma\", \"$PagSig\", \"tab1\")'>Pag. Sig.</button>  ";
				        echo " <button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Documentos Para Firmar\", \"documentospendientesfirma\", \"$PagUlt\", \"tab1\")'>Pag. $PagUlt</button> ";
				}
		   		echo '</div>';
			}
?>
			</div>
			<div class="busquedaresultadotab " id="tab2" style="<?= $menuactiveb ?>">
<?
				if($tab=='tab2'){
				echo "<div class='list-group'>";
			
				$pag = $tipo;
				$RegistrosAMostrar = 5;
				if(isset($pag)){
					$RegistrosAEmpezar=($pag-1)*$RegistrosAMostrar;
					$PagAct=$pag;
				}else{
					$RegistrosAEmpezar=0;
					$PagAct=1;
				}
				$ic=0;
                $datos = '';
                $ord = 0;
				$MGestion_anexos_firmas = new MGestion_anexos_firmas;
				$q_str = "SELECT * FROM gestion_anexos_firmas where usuario_firma = '".$_SESSION['usuario']."' and estado_firma = '1' order by fecha_solicitud"; 
				$consulta = $q_str;
				$q_str .= " limit $RegistrosAEmpezar, $RegistrosAMostrar ";
				$qwa = $con->Query($q_str);
				$query = $qwa;
				$firmar = false;
				include(VIEWS.DS.'gestion_anexos_firmas/Listar.php'); 
				
				echo "</div>";
				echo '<div class="btn-group m-t-30">';
				$qwat = $con->Query($consulta);
        		$NroRegistros = $con->NumRows($qwat);

				$PagAnt=$PagAct-1;
		        $PagSig=$PagAct+1;
		        $PagUlt=$NroRegistros/$RegistrosAMostrar;
		        $Res=$NroRegistros%$RegistrosAMostrar;
				if ($bon == "1") {
			        if($Res>0) $PagUlt=floor($PagUlt);if($PagUlt==0){$PagUlt=1;}
				        echo "<button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Documentos Para Firmar\", \"documentospendientesfirma\", \"1\", \"tab2\")' >Pag. 1</button> ";
			        if($PagAct>1) 
				        echo "<button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Documentos Para Firmar\", \"documentospendientesfirma\", \"$PagAnt\", \"tab2\")'>Pag. Ant.</button> ";
				        echo "<button type='button' class='btn btn-info waves-effect'>Pagina ".$PagAct." de ".$PagUlt."</button>";
			        if($PagAct<$PagUlt)  
				        echo " <button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Documentos Para Firmar\", \"documentospendientesfirma\", \"$PagSig\", \"tab2\")'>Pag. Sig.</button>  ";
				        echo " <button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Documentos Para Firmar\", \"documentospendientesfirma\", \"$PagUlt\", \"tab2\")'>Pag. $PagUlt</button> ";
				}else{
			        if($Res>0) $PagUlt=floor($PagUlt);if($PagUlt==0){$PagUlt=1;}
				        echo "<button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Documentos Para Firmar\", \"documentospendientesfirma\", \"1\", \"tab2\")' >Pag. 1</button> ";
			        if($PagAct>1) 
				        echo "<button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Documentos Para Firmar\", \"documentospendientesfirma\", \"$PagAnt\", \"tab2\")'>Pag. Ant.</button> ";
				        echo "<button type='button' class='btn btn-info waves-effect'>Pagina ".$PagAct." de ".$PagUlt."</button>";
			        if($PagAct<$PagUlt)  
				        echo " <button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Documentos Para Firmar\", \"documentospendientesfirma\", \"$PagSig\", \"tab2\")'>Pag. Sig.</button>  ";
				        echo " <button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Documentos Para Firmar\", \"documentospendientesfirma\", \"$PagUlt\", \"tab2\")'>Pag. $PagUlt</button> ";
				}
		   		echo '</div>';
			}
?>
				
			</div>
			<div class="busquedaresultadotab " id="tab3" style="<?= $menuactivec ?>">
<?
				if($tab=='tab3'){
				echo "<div class='list-group'>";
			
				$pag = $tipo;
				$RegistrosAMostrar = 5;
				if(isset($pag)){
					$RegistrosAEmpezar=($pag-1)*$RegistrosAMostrar;
					$PagAct=$pag;
				}else{
					$RegistrosAEmpezar=0;
					$PagAct=1;
				}
				$ic=0;
                $datos = '';
                $ord = 0;
				$MGestion_anexos_firmas = new MGestion_anexos_firmas;
				$q_str = "SELECT * FROM gestion_anexos_firmas where usuario_firma = '".$_SESSION['usuario']."' and estado_firma = '2' order by fecha_solicitud"; 
				$consulta = $q_str;
				$q_str .= " limit $RegistrosAEmpezar, $RegistrosAMostrar ";
				$qwa = $con->Query($q_str); 
				
				$query = $qwa;
				$firmar = false;
				include(VIEWS.DS.'gestion_anexos_firmas/Listar.php'); 

				echo "</div>";
				echo '<div class="btn-group m-t-30">';
				$qwat = $con->Query($consulta);
        		$NroRegistros = $con->NumRows($qwat);

				$PagAnt=$PagAct-1;
		        $PagSig=$PagAct+1;
		        $PagUlt=$NroRegistros/$RegistrosAMostrar;
		        $Res=$NroRegistros%$RegistrosAMostrar;
				if ($bon == "1") {
			        if($Res>0) $PagUlt=floor($PagUlt);if($PagUlt==0){$PagUlt=1;}
				        echo "<button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Documentos Para Firmar\", \"documentospendientesfirma\", \"1\", \"tab3\")' >Pag. 1</button> ";
			        if($PagAct>1) 
				        echo "<button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Documentos Para Firmar\", \"documentospendientesfirma\", \"$PagAnt\", \"tab3\")'>Pag. Ant.</button> ";
				        echo "<button type='button' class='btn btn-info waves-effect'>Pagina ".$PagAct." de ".$PagUlt."</button>";
			        if($PagAct<$PagUlt)  
				        echo " <button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Documentos Para Firmar\", \"documentospendientesfirma\", \"$PagSig\", \"tab3\")'>Pag. Sig.</button>  ";
				        echo " <button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Documentos Para Firmar\", \"documentospendientesfirma\", \"$PagUlt\", \"tab3\")'>Pag. $PagUlt</button> ";
				}else{
			        if($Res>0) $PagUlt=floor($PagUlt);if($PagUlt==0){$PagUlt=1;}
				        echo "<button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Documentos Para Firmar\", \"documentospendientesfirma\", \"1\", \"tab3\")' >Pag. 1</button> ";
			        if($PagAct>1) 
				        echo "<button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Documentos Para Firmar\", \"documentospendientesfirma\", \"$PagAnt\", \"tab3\")'>Pag. Ant.</button> ";
				        echo "<button type='button' class='btn btn-info waves-effect'>Pagina ".$PagAct." de ".$PagUlt."</button>";
			        if($PagAct<$PagUlt)  
				        echo " <button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Documentos Para Firmar\", \"documentospendientesfirma\", \"$PagSig\", \"tab3\")'>Pag. Sig.</button>  ";
				        echo " <button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Documentos Para Firmar\", \"documentospendientesfirma\", \"$PagUlt\", \"tab3\")'>Pag. $PagUlt</button> ";
				}
		   		echo '</div>';
			}
?>
			</div>
			<div class="busquedaresultadotab " id="tab4" style="<?= $menuactived ?>">
<?
				if($tab=='tab4'){
				echo "<div class='list-group'>";
			
				$pag = $tipo;
				$RegistrosAMostrar = 5;
				if(isset($pag)){
					$RegistrosAEmpezar=($pag-1)*$RegistrosAMostrar;
					$PagAct=$pag;
				}else{
					$RegistrosAEmpezar=0;
					$PagAct=1;
				}
				$ic=0;
                $datos = '';
                $ord = 0;
				$MGestion_anexos_firmas = new MGestion_anexos_firmas;
				$q_str = "SELECT * FROM gestion_anexos_firmas where usuario_solicita = '".$_SESSION['usuario']."' and estado_firma = '0' order by fecha_solicitud"; 
				$consulta = $q_str;
				$q_str .= " limit $RegistrosAEmpezar, $RegistrosAMostrar ";
				$qwa = $con->Query($q_str); 
				

				$query = $qwa;
				$firmar = false;
				include(VIEWS.DS.'gestion_anexos_firmas/Listar.php'); 


				echo "</div>";
				echo '<div class="btn-group m-t-30">';
				$qwat = $con->Query($consulta);
        		$NroRegistros = $con->NumRows($qwat);

				$PagAnt=$PagAct-1;
		        $PagSig=$PagAct+1;
		        $PagUlt=$NroRegistros/$RegistrosAMostrar;
		        $Res=$NroRegistros%$RegistrosAMostrar;
				if ($bon == "1") {
			        if($Res>0) $PagUlt=floor($PagUlt);if($PagUlt==0){$PagUlt=1;}
				        echo "<button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Documentos Para Firmar\", \"documentospendientesfirma\", \"1\", \"tab2\")' >Pag. 1</button> ";
			        if($PagAct>1) 
				        echo "<button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Documentos Para Firmar\", \"documentospendientesfirma\", \"$PagAnt\", \"tab2\")'>Pag. Ant.</button> ";
				        echo "<button type='button' class='btn btn-info waves-effect'>Pagina ".$PagAct." de ".$PagUlt."</button>";
			        if($PagAct<$PagUlt)  
				        echo " <button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Documentos Para Firmar\", \"documentospendientesfirma\", \"$PagSig\", \"tab2\")'>Pag. Sig.</button>  ";
				        echo " <button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Documentos Para Firmar\", \"documentospendientesfirma\", \"$PagUlt\", \"tab2\")'>Pag. $PagUlt</button> ";
				}else{
			        if($Res>0) $PagUlt=floor($PagUlt);if($PagUlt==0){$PagUlt=1;}
				        echo "<button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Documentos Para Firmar\", \"documentospendientesfirma\", \"1\", \"tab2\")' >Pag. 1</button> ";
			        if($PagAct>1) 
				        echo "<button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Documentos Para Firmar\", \"documentospendientesfirma\", \"$PagAnt\", \"tab2\")'>Pag. Ant.</button> ";
				        echo "<button type='button' class='btn btn-info waves-effect'>Pagina ".$PagAct." de ".$PagUlt."</button>";
			        if($PagAct<$PagUlt)  
				        echo " <button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Documentos Para Firmar\", \"documentospendientesfirma\", \"$PagSig\", \"tab2\")'>Pag. Sig.</button>  ";
				        echo " <button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Documentos Para Firmar\", \"documentospendientesfirma\", \"$PagUlt\", \"tab2\")'>Pag. $PagUlt</button> ";
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
	    display: none;
	}


</style>
<?
	}else{
		echo "<div class='alert alert-info'>Este modulo no se encuentra activo</div>";
	}
?>