	<div class="row fullheight">
		<div class="col-md-12">
			<ul class="nav nav-tabs" id="tab_navegacion_widgets">
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
				<li onClick="CargarAlerta2(1, 'Ultimos 50 Movimientos Del Usuario', 'ultimosmovimientosglobales', '1', 'tab1');ActivarTab('tab1', 'buscartab1')" id="buscartab1" role="presentation" class="<?= $tabactivea ?>"><a href="#">Ultimos movimientos del usuario</a></li>
			</ul>
			<div class="col-md-12 busquedaresultadotab" id="tab1" style="<?= $menuactivea ?>">
				
<?
			if($tab=='tab1'){
				echo "<ul class='list-group'>";
				$pag = $tipo;
				$RegistrosAMostrar = 50;
				if(isset($pag)){
					$RegistrosAEmpezar=($pag-1)*$RegistrosAMostrar;
					$PagAct=$pag;
				}else{
					$RegistrosAEmpezar=0;
					$PagAct=1;
				}
				$aar = array(   "0" => "azulclaro", 
			                    "1" => "verde", 
			                    "2" => "rojo" 
			                );

				$aar2 = array( 	"0" => "gen-act", 
				                "1" => "my-act", 
				                "2" => "late-act" 
				            );
                $datos = '';
                $i = 0;

			    $j = 0;
				$sql = "SELECT * FROM events_gestion eg  where eg.user_id = '".$_SESSION['usuario']."' and 'SI' != (SELECT estado_respuesta FROM gestion where id = eg.gestion_id) group by eg.id order by id desc ";
				$consulta = $sql;
				$sql .= " limit $RegistrosAEmpezar, $RegistrosAMostrar ";
				$qwa = $con->Query($sql);
				$ic=0;

				while($rrt = $con->FetchArray($qwa)){
					$ic++;

					if ($rrt['gestion_id'] != "0") {
						$g = new MGestion;
						$g->CreateGestion("id", $rrt['gestion_id']);
						$suscriptordata = $c->GetDataFromTable("dependencias", "id", $g->GetTipo_documento(), "nombre", $separador = " ")." - ".$c->GetDataFromTable("suscriptores_contactos", "id", $g->GetSuscriptor_id(), "nombre", $separador = " ").""; 
						$NUMRADICACION = "<a href='/gestion/ver/".$g->GetId()."/'>".$suscriptordata." (<small>".$g->GetMin_rad()."</small>)</a>";
					}

					echo "	<li class='list-group-item'>
								<div class='row'>
									<div class='col-md-1'>

										<span class='btn btn-info btn-lg btn-circle faicon fa fa-globe'></span>
									</div>
									<div class='col-md-10' style='cursor:pointer;'>
										<div class='link_nombre'><span class='link_subtitulo' style='color:#666'>".utf8_decode($rrt['description'])."</div>
										<div class='link_asunto'><span class='link_subtitulo' style='color:#666'>Expediente: ".$NUMRADICACION."</span></div>
										<div class='link_fecha'>Fecha: ".$rrt['fecha']." a las ".$rrt['time']."</div>
									</div>
								</div>
							</li>";
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
				        echo "<button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Ultimos 50 Movimientos Del Usuario\", \"ultimosmovimientosglobales\", \"1\", \"tab1\")' >Pag. 1</button> ";
			        if($PagAct>1) 
				        echo "<button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Ultimos 50 Movimientos Del Usuario\", \"ultimosmovimientosglobales\", \"$PagAnt\", \"tab1\")'>Pag. Ant.</button> ";
				        echo "<button type='button' class='btn btn-info waves-effect'>Pagina ".$PagAct." de ".$PagUlt."</button>";
			        if($PagAct<$PagUlt)  
				        echo " <button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Ultimos 50 Movimientos Del Usuario\", \"ultimosmovimientosglobales\", \"$PagSig\", \"tab1\")'>Pag. Sig.</button>  ";
				        echo " <button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Ultimos 50 Movimientos Del Usuario\", \"ultimosmovimientosglobales\", \"$PagUlt\", \"tab1\")'>Pag. $PagUlt</button> ";
				}else{
			        if($Res>0) $PagUlt=floor($PagUlt);if($PagUlt==0){$PagUlt=1;}
				        echo "<button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Ultimos 50 Movimientos Del Usuario\", \"ultimosmovimientosglobales\", \"1\", \"tab1\")' >Pag. 1</button> ";
			        if($PagAct>1) 
				        echo "<button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Ultimos 50 Movimientos Del Usuario\", \"ultimosmovimientosglobales\", \"$PagAnt\", \"tab1\")'>Pag. Ant.</button> ";
				        echo "<button type='button' class='btn btn-info waves-effect'>Pagina ".$PagAct." de ".$PagUlt."</button>";
			        if($PagAct<$PagUlt)  
				        echo " <button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Ultimos 50 Movimientos Del Usuario\", \"ultimosmovimientosglobales\", \"$PagSig\", \"tab1\")'>Pag. Sig.</button>  ";
				        echo " <button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Ultimos 50 Movimientos Del Usuario\", \"ultimosmovimientosglobales\", \"$PagUlt\", \"tab1\")'>Pag. $PagUlt</button> ";
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
		border: 1px solid #CCC;
	    min-height: 400px;
	    border-top: none;
	    margin-top: -1px;
	    display: none;
	    padding: 20px;
	}

	#tab_navegacion_widgets.nav>li>a {
	    position: relative;
	    display: block;
	    padding: 10px 15px;
	}

</style>
