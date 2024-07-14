<div class="row">
    <div class="col-md-12">
        <ul class="nav nav-pills m-b-30 b-b " role="tablist"  id="menu_tab2">
            <li class=" active" onClick="ShowMailer('/correo/mini_all/<?= $object->GetId(); ?>/', 'mailer_all')" id='mailer_all' role="presentation" ><a href="#">Recibidos</a></li>
	<?
		if ($_SESSION['mayedit'] == "1") {
	?>
    		<li class="" onClick="ShowMailer('/correo/mini_new/<?= $object->GetId(); ?>/', 'mailer_new')" id='mailer_new' role='presentation'><a href="#">Redactar</a></li>
    <?
		}
    ?>
        </ul>
    </div>
</div>
<div class="row">
    <div class="col-md-12" id="cargador_box_upfiles2">
    </div>
</div>

<script type="text/javascript">
	ShowMailer('/correo/mini_all/<?= $object->GetId(); ?>/', 'mailer_all');
</script>