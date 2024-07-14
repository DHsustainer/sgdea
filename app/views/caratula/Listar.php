<link rel='stylesheet' type='text/css' href='<?=ASSETS?>/styles/lista_boots.css'/>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<div id="tools-content-ps">
	<?
		global $c;
		if($c->sql_quote($_GET['action']) == 'ver'){

			if ($_SESSION[usuario]==$_SESSION[sadminid] || $_SESSION[sadmin]!=1){
				if ($_SESSION['folder'] == "") {
					echo '<a href="/proceso/nuevo/"><div class="opc-folder blue"><div class="ico-content-ps"><div class="icon plus hight-blue"></div></div><div class="text-folder">Crear carpeta</div></div></a>';
				}
			} 

			if ($_SESSION['folder'] == "") {
?>
		
				<div id="tools-content-ps-sub">
					<div class="opc-folder normal active" onclick="show_folder('all-fl',this);"><div class="icon users-f normal-ic"></div></div>
					<div class="opc-folder normal" onclick="show_folder('fl-jur',this);"><div class="icon juridico-f normal-ic"></div></div>
					<div class="opc-folder normal" onclick="show_folder('fl-nat',this);"><div class="icon natural-f normal-ic"></div></div>
				</div>
		

<?			
			}
		}else{
			echo '<div id="tools-content-ps-sub"></div>';	
		}
?>
</div>
<div id="folders-content">
	<div id="folders-list-content-cara-select">
		<?=$unique?>
	</div>
	<div id="folders-list-content-cara">

		<?=$result?>
	</div>
	<div id="proces-list-content-cara">
		<?
			if ($_SESSION['typefolder'] == "") {
				$_SESSION['typefolder'] = "ACTIVO";
			}
			$act1 = ($_SESSION['typefolder'] == "ACTIVO")?"i-activeind1":"";
			$act2 = ($_SESSION['typefolder'] == "DESACTIVAR")?"i-activeind2":"";
			$act3 = ($_SESSION['typefolder'] == "ARCHIVADO")?"i-activeind3":"";
		?>
		<div class="cont-process">
			<div id="boton-new-proces" title='Procesos Activos' class="proces-1" style="float: left; <?= $act1 ?>"><a class="no_link" id="icon-ind1" href="/caratula/ver/<?=$id?>/ACTIVO/"><div class="icon icon-ind1 <?= $act1 ?>"></div><!--div style="<?= $act1 ?>">En Curso</div--></a></div>	
			<div id="boton-new-proces" title='Procesos Sin Iniciar' class="proces-2" style="float: left; <?= $act2 ?>"><a class="no_link" id="icon-ind2" href="/caratula/ver/<?=$id?>/DESACTIVAR/"><div class="icon icon-ind2 <?= $act2 ?>"></div><!--div style="<?= $act2 ?>">Sin Iniciar</div--></a></div>	
			<div id="boton-new-proces" title='Procesos Archivados' class="proces-3" style="float: left; <?= $act3 ?>"><a class="no_link" id="icon-ind3" href="/caratula/ver/<?=$id?>/ARCHIVADO/"><div class="icon icon-ind3 <?= $act3 ?>"></div><!-- proces-div style="<?= $act3 ?>">Archivados</div--></a></div>	
		<?php 	if ($_SESSION[usuario]==$_SESSION[sadminid] || $_SESSION[sadmin]!=1){ 
					if ($_SESSION['folder'] == "") {
					
						$us = new MUsuarios;
						$us->CreateUsuarios("user_id", $_SESSION['usuario']);

						if ($_SESSION['c_procesos'] == "0") {
		?>
							<div id="boton-new-proces" style="float: right" ><a class="no_link" href="/caratula/nuevo/<?=$id?>/"><div>Crear Proceso</div></a></div>			
		<?						
						}elseif($us->GetTotalProcesos() < $_SESSION['c_procesos']){
		?>	
							<div id="boton-new-proces" style="float: right" ><a class="no_link" href="/caratula/nuevo/<?=$id?>/"><div>Crear Proceso</div></a></div>			
		<?
						}
				
		?>
		</div>

		<div class="clear"><br><br></div>
		<?php 		
					}
				} 
		?>		
		<?= $proces ?>

		<?
			if ($_GET['action'] == "ver") {
				# code...

		   		$query = ($id==0)
		   		?$querypag = "SELECT count(*) as t FROM caratula c,compartir fd where fd.compartir = '$_SESSION[usuario]' and c.id=fd.pid and c.user_id=fd.user_id"
		   		:$querypag = "SELECT count(*) as t FROM caratula c,folder f,folder_demanda fd where fd.folder_id=f.id and fd.user_id = '$_SESSION[usuario]' and c.proceso_id=fd.proceso_id and fd.user_id=c.user_id and f.id='$id'";

				echo '<div class="btn-group m-t-30">';
					$NroRegistros = $con->Result($con->Query($querypag), 0, 't');

					if($NroRegistros == 0){
					echo '<div class="texto_italic">No hay registros de ingresos de este item</div><br><br>';
					}

					$PagAnt=$PagAct-1;
					$PagSig=$PagAct+1;
					$PagUlt=$NroRegistros/$RegistrosAMostrar;

					$Res=$NroRegistros%$RegistrosAMostrar;

					if($Res>0) $PagUlt=floor($PagUlt)+1;

					echo "<button type='button' class='btn btn-default btn-outline waves-effect' href= '".HOMEDIR."/caratula/ver/$id/ACTIVO/1/'>Pagina 1</a> ";

					if($PagAct>1) 
					echo "<button type='button' class='btn btn-default btn-outline waves-effect' href= '".HOMEDIR."/caratula/ver/$id/ACTIVO/$PagAnt/'>Pagina Anterior.</a> ";


					echo "<button type='button' class='btn btn-info waves-effect'>Pagina ".$PagAct." de ".$PagUlt."</button>";

					if($PagAct<$PagUlt)  
					echo " <button type='button' class='btn btn-default btn-outline waves-effect' href= '".HOMEDIR."/caratula/ver/$id/ACTIVO/$PagSig/'>Pagina Siguiente.</a> ";

					echo " <button type='button' class='btn btn-default btn-outline waves-effect' href= '".HOMEDIR."/caratula/ver/$id/ACTIVO/$PagUlt/'>Pagina. $PagUlt</a>";
				echo '</div>';
			}
		?>

	</div>
</div>

<script>
function show_folder(type,div){	
	if (type=='all-fl') {
		$('#folders-list-content-cara .folder-item').show(500);
	}else{
		$('#folders-list-content-cara .folder-item:not(.'+type+')').hide(500);
		$('#folders-list-content-cara .folder-item.'+type).show(500);		
	}
	$('.opc-folder').removeClass('active');
	$(div).addClass('active');
}



$(document).ready(function(){

$("#icon-ind1").click(function(){ 

		$("div").hasClass('i-active'); 
		$("div ").removeClass('i-active'); 
		$("div").removeClass('i-active'); 
	
	}); 

});
</script>	