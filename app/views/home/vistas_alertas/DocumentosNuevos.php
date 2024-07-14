<script type="text/javascript">
	$(document).ready(function(){
		$(".breadcrumb li").last().addClass("active");
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
			<li onClick="CargarAlerta2('1', 'Documentos Nuevos', 'documentosnuevos', '1', 'tab1');ActivarTab('tab1', 'buscartab1')" id="buscartab1" role="presentation" class="<?= $tabactivea ?>"><a href="#"  <?= $c->Ayuda("88", 'tog') ?>>Documentos Nuevos</a></li>
			<li onClick="CargarAlerta2('1', 'Documentos Nuevos', 'documentosnuevos', '1', 'tab2');ActivarTab('tab2', 'buscartab2')" id="buscartab2" role="presentation" class="<?= $tabactiveb ?>"><a href="#" <?= $c->Ayuda("89", 'tog') ?> >Documentos Revisados</a></li>
		</ul>
		<div class="col-md-12 busquedaresultadotab" id="tab1" style="<?= $menuactivea ?>">
			<div class="row" style="margin-bottom:10px">
				<div class="col-md-6">
				</div>
				<div class="col-md-6" align="right">
					<button class="btn btn-info" <?= $c->Ayuda("90", 'tog') ?>  onClick="KillActivities('1', '3')"  <?= $c->Ayuda("20", "tog") ?>>
						<span class="fa fa-archive"></span> Marcar Como Leídas Todas las Actividades
					</button>
				</div>
			</div>
			<?
			if($tab=='tab1'){
				$pag = $tipo;
				$RegistrosAMostrar = 20;
				if(isset($pag)){
					$RegistrosAEmpezar=($pag-1)*$RegistrosAMostrar;
					$PagAct=$pag;
				}else{
					$RegistrosAEmpezar=0;
					$PagAct=1;
				}

				$sql = "SELECT * FROM alertas a inner join events_gestion eg  on eg.id = a.id_evento inner join tipos_alertas ta on ta.alt = a.extra  inner join gestion gx on gx.id = a.id_gestion  where gx.estado_respuesta = 'Abierto' and gx.estado_archivo = '1' and  a.type = '1'  and a.user_id = '".$_SESSION['usuario']."' and a.status = '0' and 'SI' != (SELECT estado_respuesta FROM gestion where id = eg.gestion_id) and a.extra in('doc', 'an')  group by eg.id order by a.id desc";

				$consulta = $sql;
				$sql .= " limit $RegistrosAEmpezar, $RegistrosAMostrar ";
				$qwat = $con->Query($sql);
				$datos = "";
				echo '<div class="comment-center p-10">';
				while($rrt = $con->FetchArray($qwat)){
					include(VIEWS.DS."home/tipos_alerta_html.php");
					$ic++;
				}

				if($datos == ''){
					$datos = "<div id='messagedocumentosnuevos'><div  class='alert alert-info'>No tienes Documentos Nuevos:-)</div><br><br></div>";
				}
				echo $datos;
				echo '</div>';

				echo '<div class="btn-group m-t-30">';
				$qwat = $con->Query($consulta);
        		$NroRegistros = $con->NumRows($qwat);

				$PagAnt=$PagAct-1;
		        $PagSig=$PagAct+1;
		        $PagUlt=$NroRegistros/$RegistrosAMostrar;
		        $Res=$NroRegistros%$RegistrosAMostrar;
				if ($bon == "1") {
			        if($Res>0) $PagUlt=floor($PagUlt);if($PagUlt==0){$PagUlt=1;}
				        echo "<button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Documentos Nuevos\", \"documentosnuevos\", \"1\", \"tab1\")' >Pag. 1</button> ";
			        if($PagAct>1) 
				        echo "<button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Documentos Nuevos\", \"documentosnuevos\", \"$PagAnt\", \"tab1\")'>Pag. Ant.</button> ";
				        echo "<button type='button' class='btn btn-info waves-effect'>Pagina ".$PagAct." de ".$PagUlt."</button>";
			        if($PagAct<$PagUlt)  
				        echo " <button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Documentos Nuevos\", \"documentosnuevos\", \"$PagSig\", \"tab1\")'>Pag. Sig.</button>  ";
				        echo " <button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Documentos Nuevos\", \"documentosnuevos\", \"$PagUlt\", \"tab1\")'>Pag. $PagUlt</button> ";
				}else{
			        if($Res>0) $PagUlt=floor($PagUlt);if($PagUlt==0){$PagUlt=1;}
				        echo "<button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Documentos Nuevos\", \"documentosnuevos\", \"1\", \"tab1\")' >Pag. 1</button> ";
			        if($PagAct>1) 
				        echo "<button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Documentos Nuevos\", \"documentosnuevos\", \"$PagAnt\", \"tab1\")'>Pag. Ant.</button> ";
				        echo "<button type='button' class='btn btn-info waves-effect'>Pagina ".$PagAct." de ".$PagUlt."</button>";
			        if($PagAct<$PagUlt)  
				        echo " <button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Documentos Nuevos\", \"documentosnuevos\", \"$PagSig\", \"tab1\")'>Pag. Sig.</button>  ";
				        echo " <button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Documentos Nuevos\", \"documentosnuevos\", \"$PagUlt\", \"tab1\")'>Pag. $PagUlt</button> ";
				}
		   		echo '</div>';
		   	}
		?>
		</div>
		<div class="busquedaresultadotab" id="tab2" style="<?= $menuactiveb ?>">
			<div class="row" style="margin-bottom:10px">
				<div class="col-md-6">
				</div>
				<div class="col-md-6" align="right">
					<button class="btn btn-info" onClick="KillActivities('2', '3')"  <?= $c->Ayuda("21", "tog") ?>>
						<span class="fa fa-archive"></span> Archivar Todas las Actividades Leídas
					</button>
				</div>
			</div>				
		<?
		if($tab=='tab2'){
			$pag = $tipo;
			$RegistrosAMostrar = 20;
			if(isset($pag)){
				$RegistrosAEmpezar=($pag-1)*$RegistrosAMostrar;
				$PagAct=$pag;
			}else{
				$RegistrosAEmpezar=0;
				$PagAct=1;
			}

			$sql = "SELECT * FROM alertas a inner join events_gestion eg  on eg.id = a.id_evento inner join tipos_alertas ta on ta.alt = a.extra  inner join gestion gx on gx.id = a.id_gestion  where gx.estado_respuesta = 'Abierto' and gx.estado_archivo = '1' and  a.type = '1'  and a.user_id = '".$_SESSION['usuario']."' and a.keep_alive = '1' and a.status = '2' and 'SI' != (SELECT estado_respuesta FROM gestion where id = eg.gestion_id) and a.extra in('doc', 'an')  group by eg.id ";
			$consulta = $sql;
			$sql .= " limit $RegistrosAEmpezar, $RegistrosAMostrar ";
			$qwa = $con->Query($sql);
			$datos = "";
			echo '<div class="comment-center p-10">';
			while($rrt = $con->FetchArray($qwa)){
				include(VIEWS.DS."home/tipos_alerta_html.php");
				$ic++;
			}

			if($datos == ''){
				$datos = "<div id='messagedocumentosnuevos'><div  class='alert alert-info'>No tienes Documentos Nuevos:-)</div><br><br></div>";
			}
			echo $datos;
			echo '</div>';


			echo '<div class="btn-group m-t-30">';
			$qwat = $con->Query($consulta);
    		$NroRegistros = $con->NumRows($qwat);
	       /* if($NroRegistros == 0){
	        	echo '<div class="texto_italic">No hay registros de ingresos de este item</div><br><br>';
	        }*/

			$PagAnt=$PagAct-1;
	        $PagSig=$PagAct+1;
	        $PagUlt=$NroRegistros/$RegistrosAMostrar;
	        $Res=$NroRegistros%$RegistrosAMostrar;
			if ($bon == "1") {
		        if($Res>0) $PagUlt=floor($PagUlt);if($PagUlt==0){$PagUlt=1;}
			        echo "<button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Documentos Nuevos\", \"documentosnuevos\", \"1\", \"tab2\")' >Pag. 1</button> ";
		        if($PagAct>1) 
			        echo "<button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Documentos Nuevos\", \"documentosnuevos\", \"$PagAnt\", \"tab2\")'>Pag. Ant.</button> ";
			        echo "<button type='button' class='btn btn-info waves-effect'>Pagina ".$PagAct." de ".$PagUlt."</button>";
		        if($PagAct<$PagUlt)  
			        echo " <button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Documentos Nuevos\", \"documentosnuevos\", \"$PagSig\", \"tab2\")'>Pag. Sig.</button>  ";
			        echo " <button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Documentos Nuevos\", \"documentosnuevos\", \"$PagUlt\", \"tab2\")'>Pag. $PagUlt</button> ";
			}else{
		        if($Res>0) $PagUlt=floor($PagUlt);if($PagUlt==0){$PagUlt=1;}
			        echo "<button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Documentos Nuevos\", \"documentosnuevos\", \"1\", \"tab2\")' >Pag. 1</button> ";
		        if($PagAct>1) 
			        echo "<button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Documentos Nuevos\", \"documentosnuevos\", \"$PagAnt\", \"tab2\")'>Pag. Ant.</button> ";
			        echo "<button type='button' class='btn btn-info waves-effect'>Pagina ".$PagAct." de ".$PagUlt."</button>";

		        if($PagAct<$PagUlt)  
			        echo " <button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Documentos Nuevos\", \"documentosnuevos\", \"$PagSig\", \"tab2\")'>Pag. Sig.</button>  ";
			        echo " <button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Documentos Nuevos\", \"documentosnuevos\", \"$PagUlt\", \"tab2\")'>Pag. $PagUlt</button> ";
			}
	   		echo '</div>';

		}
		?>
		</div>
		<div class="busquedaresultadotab" id="tab3" style="<?= $menuactivec ?>">
			<div class="row" style="margin-bottom:10px">
				<div class="col-md-6">
				</div>
				<div class="col-md-6" align="right">
					<button class="btn btn-warning" onClick="KillActivities('3', '3')"><span class="fa fa-archive"></span>Eliminar Todas las Actividades Archivadas</button>
				</div>
			</div>				
		<?
		if($tab=='tab3'){
			$pag = $tipo;
			$RegistrosAMostrar = 20;
			if(isset($pag)){
				$RegistrosAEmpezar=($pag-1)*$RegistrosAMostrar;
				$PagAct=$pag;
			}else{
				$RegistrosAEmpezar=0;
				$PagAct=1;
			}

			$sql = "SELECT * FROM alertas a inner join events_gestion eg  on eg.id = a.id_evento inner join tipos_alertas ta on ta.alt = a.extra  inner join gestion gx on gx.id = a.id_gestion  where gx.estado_respuesta = 'Abierto' and gx.estado_archivo = '1' and  a.type = '1'  and /*eg.user_id = '".$_SESSION['usuario']."' and*/ a.user_id = '".$_SESSION['usuario']."' and a.keep_alive = '0'  and 'SI' != (SELECT estado_respuesta FROM gestion where id = eg.gestion_id)  and a.extra in('doc', 'an') group by eg.id ";

			$consulta = $sql;
			$sql .= " limit $RegistrosAEmpezar, $RegistrosAMostrar ";
			$qwa = $con->Query($sql);
			$datos = "";

			echo '<div class="comment-center p-10">';
			while($rrt = $con->FetchArray($qwa)){
				include(VIEWS.DS."home/tipos_alerta_html.php");
				$ic++;
			}

			if($datos == ''){
				$datos = "<div id='messagedocumentosnuevos'><div  class='alert alert-info'>No tienes Documentos Nuevos:-)</div><br><br></div>";
			}
			echo $datos;
			echo '</div>';

			echo '<div class="btn-group m-t-30">';
			$qwat = $con->Query($consulta);
    		$NroRegistros = $con->NumRows($qwat);
	        /*if($NroRegistros == 0){
	        	echo '<div class="texto_italic">No hay registros de ingresos de este item</div><br><br>';
	        }*/

			$PagAnt=$PagAct-1;
	        $PagSig=$PagAct+1;
	        $PagUlt=$NroRegistros/$RegistrosAMostrar;
	        $Res=$NroRegistros%$RegistrosAMostrar;
			if ($bon == "1") {
		        if($Res>0) $PagUlt=floor($PagUlt);if($PagUlt==0){$PagUlt=1;}
			        echo "<button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Documentos Nuevos\", \"documentosnuevos\", \"1\", \"tab3\")' >Pag. 1</button> ";
		        if($PagAct>1) 
			        echo "<button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Documentos Nuevos\", \"documentosnuevos\", \"$PagAnt\", \"tab3\")'>Pag. Ant.</button> ";
			        echo "<button type='button' class='btn btn-info waves-effect'>Pagina ".$PagAct." de ".$PagUlt."</button>";
		        if($PagAct<$PagUlt)  
			        echo " <button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Documentos Nuevos\", \"documentosnuevos\", \"$PagSig\", \"tab3\")'>Pag. Sig.</button>  ";
			        echo " <button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Documentos Nuevos\", \"documentosnuevos\", \"$PagUlt\", \"tab3\")'>Pag. $PagUlt</button> ";
			}else{
		        if($Res>0) $PagUlt=floor($PagUlt);if($PagUlt==0){$PagUlt=1;}
			        echo "<button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Documentos Nuevos\", \"documentosnuevos\", \"1\", \"tab3\")' >Pag. 1</button> ";
		        if($PagAct>1) 
			        echo "<button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Documentos Nuevos\", \"documentosnuevos\", \"$PagAnt\", \"tab3\")'>Pag. Ant.</button> ";
			        echo "<button type='button' class='btn btn-info waves-effect'>Pagina ".$PagAct." de ".$PagUlt."</button>";
		        if($PagAct<$PagUlt)  
			        echo " <button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Documentos Nuevos\", \"documentosnuevos\", \"$PagSig\", \"tab3\")'>Pag. Sig.</button>  ";
			        echo " <button type='button' class='btn btn-default btn-outline waves-effect' onclick='CargarAlerta2(\"1\", \"Documentos Nuevos\", \"documentosnuevos\", \"$PagUlt\", \"tab3\")'>Pag. $PagUlt</button> ";
			}
	   		echo '</div>';
		}
		?>
		</div>
	</div>
</div>
<script type="text/javascript">
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