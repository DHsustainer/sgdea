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
			<li onClick="ActivarTab('tab1', 'buscartab1')" id="buscartab1" role="presentation" class="<?= $tabactivea ?>"><a href="#">Expedientes Pendientes Para Archivar</a></li>
		</ul>
		<div class="col-md-12 busquedaresultadotab" id="tab1" style="<?= $menuactivea ?>">
			<ul class='list-group'>
<?

			$ic = 0;
            $datos = '';
            $ord = 0;
			$MSolicitudes_documentos = new MSolicitudes_documentos;
			$qwa = $MSolicitudes_documentos->ListarSolicitudes_documentos("WHERE usuario_destino ='".$_SESSION['usuario']."' and estado = '0'" ,"order by fecha_solicitud","LIMIT $ini, $cantidad");
			while($rrt = $con->FetchArray($qwa)){
				$ic++;
				$c = new Consultas;

				$fecha_solicitud = $rrt['fecha_solicitud'];
				
				$usuarios_s = new MUsuarios;
				$usuarios_s->CreateUsuarios("user_id", $rrt['usuario_solicita']);

				$area = $c->GetDataFromTable("areas", "id", $usuarios_s->GetRegimen(), "nombre", $separador = " ");
				$usuario = $usuarios_s->GetP_nombre()." ".$usuarios_s->GetP_apellido()."<br> ($area)";

				$gestion_id = "NS";
				if ($rrt['gestion_id'] != "0") {
					$g = new MGestion;
					$g->CreateGestion("id", $rrt['gestion_id']);
					$gestion_id = "<a href='/gestion/ver/".$g->GetId()."/' target='_blank'>".$g->GetMin_rad()."</a>";
				}

				$datos .= "<div class='notification_bloq' style='cursor:pointer;' onclick='".'window.location.href="/gestion/vencimientoexpedientesarchivo/1/"'."'><div class='flag_icon'><i class='fa fa-yelp' aria-hidden='true'></i></div><div class='texto' style='padding-left: 30px;margin-bottom: 5px;'>".$fecha_solicitud." El usuario ".$usuario." solicita acceso al expediente $gestion_id ".$rrt['observacion']."</div><div class='clearb'></div></div>";
			}
			
			if($datos == ''){
				$datos = "<div id='messageExpedientesVencer'><div  class='alert alert-info'>No tienes Expedientes por Vencer :-)</div><br><br></div>";
			}
?>
			</ul>
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
