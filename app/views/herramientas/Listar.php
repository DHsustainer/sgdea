<?
    global $c;
?>
<link rel="stylesheet" type="text/css" href="<?=ASSETS?>/styles/nifty.css">
<script src="<?=ASSETS?>/js/jquery.modalEffects.js"></script>
<script>
	$(document).ready(function() {
		var link = document.URL.split('#');
		$('li').removeClass('tab-current');
		$("#mylistmenu li").first().addClass("item-upper-menu adminis-upper adminis");
		$('li.'+link[1]+'-upper').addClass('tab-current');

        $('[data-toggle="tooltip"]').tooltip(); 
        $('[data-toggle="popover"]').popover()
	});

    function save_file(){
		var formData = new FormData($('#firmaform')[0]);
		$.ajax({
            url: '/herramientas/save_file/',  
            type: 'POST',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data){
                $('#firma_img').attr('src',data);
            }
        });
	}

	function select_gestOficinas(item,div, elm){
		var URL = '/seccional/listar/'+elm+'/';
		$.ajax({
            url: URL,  
            type: 'POST',
            cache: false,
            contentType: false,
            processData: false,
            success: function(data){
                $('#form-oficinas').html(data);            
            }
        });

		$('.title-gest').removeClass('active');
		$(div).addClass('active');
		$('.item-gest:not(.'+item+')').hide(500);
		$('.item-gest.'+item).show(500);
	}

	function select_gestSubs(elm){
		var URL = '/dependencias/configurar/'+elm+'/';
		OpenWindow2(URL);
	}

</script>
<section class="m-t-40">
    <div class="sttabs tabs-style-iconbox">
        <nav>
            <ul id="mylistmenu">
<?
        if ($_SESSION['sadmin'] == "1") {
?>                                              
                <li class="item-upper-menu adminis-upper adminis" onClick="window.location.href = '<?= HOMEDIR.DS."herramientas/empresa/#adminis"?>'">
                	<a href="#adminis" class="sticon" <?= $c->Ayuda('100', 'tog') ?>>
                		<span class="mdi mdi-factory fa-fw icon m-0"></span><br>
                		<span><b><?= CAMPOENTIDAD ?></b></span>
                	</a>
                </li>
<?
        }
        if ($_SESSION['areas_trabajo'] == "1") {
?>  
                <li class="item-upper-menu gest-upper gest"  onClick="window.location.href = '<?= HOMEDIR.DS."herramientas/oficinas/#gest"?>';">
                	<a href="#gest" class="sticon" <?= $c->Ayuda('101', 'tog') ?>>
                		<span class="mdi mdi-briefcase fa-fw icon m-0"></span><br>
                		<span><b><?= CAMPOSEDES ?></b></span>
                	</a>
                </li>

                <li class="item-upper-menu grup-upper grup" onClick="window.location.href = '<?= HOMEDIR.DS."herramientas/areas/#grup"?>';">
                	<a href="#grup" class="sticon"  <?= $c->Ayuda('102', 'tog') ?>>
                		<span class="mdi mdi-account-multiple fa-fw icon m-0"></span><br>
                		<span><b><?= CAMPOAREADETRABAJO; ?></b></span>
                	</a>
                </li>        
<?
        }
        if ($_SESSION['usuarios'] == "1" || $_SESSION['permisos_usuarios'] == "1" || $_SESSION['t_cuenta'] == "1" || $_SESSION['sadmin'] == "1") {
?>
                <li class="item-upper-menu usua-upper usua" onClick="window.location.href = '<?= HOMEDIR.DS."herramientas/usuarios/#usua"?>';">
                	<a href="#section-iconbox-2" class="sticon"  <?= $c->Ayuda('103', 'tog') ?>>
                		<span class="mdi mdi-worker fa-fw icon m-0"></span><br>
                		<span><b><?= CAMPOFUNCIONARIOS ?></b></span>
                	</a>
                </li>
<?
        }
        if ($_SESSION['p_suscriptores'] == "1") {
?>  
                <li class="item-upper-menu contacts-upper contacts" onClick="window.location.href = '<?= HOMEDIR.DS."herramientas/suscriptores/#contacts"?>';">
                	<a href="#section-iconbox-2" class="sticon"  <?= $c->Ayuda('105', 'tog') ?> >
                		<span class="mdi mdi-account fa-fw icon m-0"></span><br>
                		<span><b><?= SUSCRIPTORCAMPONOMBRE ?></b></span>
                	</a>
                </li>
<?
        }
        if ($_SESSION['otras_herramientas'] == "1") {
?>  
                <li class="item-upper-menu planti-upper planti" onClick="window.location.href = '<?= HOMEDIR.DS."herramientas/otras/#planti"?>';">
                	<a href="#planti" class="sticon"  <?= $c->Ayuda('106', 'tog') ?>>
                		<span class="mdi mdi-react fa-fw icon m-0"></span><br>
                		<span><b>Otras Herramientas</b></span>
                	</a>
                </li>
<?
        }
?>              
            </ul>
        </nav>

			
		<div class="item-upper-menu proce-upper" style="display:none" onClick="window.location.href = '<?= HOMEDIR.DS."herramientas/gestion/#proce"?>';">
		</div>

