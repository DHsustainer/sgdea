<script language='javascript' type='text/javascript' src='<?=ASSETS?>/js/jscripts.js?f=<?php echo date("YmdHi"); ?>'></script>
<h2>Configurar: <?= $dep->GetNombre() ?></h2>

<ul class="nav customtab nav-tabs" role="tablist">
	<?
	if ($_SESSION['MODULES']['formularios'] == "1") {
?>
    <li role="presentation" class="formularios" onclick="OpenWindow('/dependencias/metadatos/<?= $dep->GetId() ?>/')" id="views_formularios">
    	<a href="#home1" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="true">
    		<span>
    			<i class="fa fa-wpforms "></i>
    		</span>
    		<span class="hidden-xs"> Formularios</span>
    	</a>
    </li>
<?
	}
?>
<?
	if ($_SESSION['MODULES']['inmaterializacion'] == "1") {
?>
    <li role="presentation" class="docsnew " onclick="window.location.href='<?=HOMEDIR.DS.'dependencias/views_minutas/'.$dep->GetId().'/' ?>'" id="views_minutas">
    	<a href="#profile1" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false">
    		<span>
    			<i class="fa fa-file-pdf-o"></i>
    		</span>
    		 <span class="hidden-xs">Documentos Genericos</span>
		</a>
	</li>
<?
	}
?>
    <li role="presentation" class="documentos active" onclick="cargador_box('views_tipologias','<?= $dep->GetId() ?>')" id="views_tipologias">
    	<a href="#messages1" aria-controls="messages" role="tab" data-toggle="tab" aria-expanded="false">
			<span>
				<i class="fa fa-tags"></i>
			</span>
			 <span class="hidden-xs">Tipos Documentales</span>
		</a>
	</li>
    <li role="presentation" class="alertas " onclick="cargador_box('views_alertas_subs','<?= $dep->GetId() ?>')" id="views_alertas_subs">
    	<a href="#settings1" aria-controls="settings" role="tab" data-toggle="tab" aria-expanded="false">
			<span>
				<i class="fa fa-bell"></i>
			</span>
			 <span class="hidden-xs">Alertas</span>
		</a>
	</li>
	<li role="presentation" class="estados"  onclick="cargador_box('views_estados','<?= $dep->GetId() ?>')" id="views_estados">
    	<a href="#settings1" aria-controls="settings" role="tab" data-toggle="tab" aria-expanded="false">
			<span>
				<i class="fa fa-list-ul"></i>
			</span>
			 <span class="hidden-xs">Estados Personalizados</span>
		</a>
	</li>
<?
	if ($_SESSION['MODULES']['workflow'] == "1") {
?>
	<div title="Flujos de Trabajo" ></div>
	<li role="presentation"  class="permisosdoc"  onclick="OpenWindow('/flujos/mod/<?= $dep->GetId() ?>/S/')" id="views_permisos_doc">
    	<a href="#settings1" aria-controls="settings" role="tab" data-toggle="tab" aria-expanded="false">
			<span>
				<i class="fa fa-gears"></i>
			</span>
			 <span class="hidden-xs">Flujos de Trabajo</span>
		</a>
	</li>
<?
	}
?>	
</ul>

	<div title="Documentos obiligatorios" class="anexos fa fa-paperclip" onclick="cargador_box('views_doc_obligatorios','<?= $dep->GetId() ?>')" id="views_doc_obligatorios" style="display: none"></div>
<?
	if ($_SESSION['MODULES']['inmaterializacion'] == "1") {
?>
	<div title="Permisos de Documentos"  style="display: none" class="permisosdoc fa fa-lock" onclick="cargador_box('views_permisos_doc','<?= $dep->GetId() ?>')" id="views_permisos_doc"></div>
<?
	}
?>

<script>
	cargador_box('views_tipologias', '<?= $dep->GetId() ?>');
</script>
<div id="cargador_box" class="m-t-30">
	<?
		echo $dep->GetId();
	?>
</div>