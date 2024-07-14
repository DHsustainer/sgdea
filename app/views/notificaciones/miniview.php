<div class="row">
    <div class="col-md-12">
        <ul class="nav nav-pills m-b-30 b-b " role="tablist"  id="menu_tab2">
            <li class=" active" onClick="ShowMailer('/notificaciones/mini_all/<?= $object->GetId(); ?>/', 'mailer_all')" id='mailer_all' role="presentation" ><a href="#">Correspondencia Enviada</a></li>
    <?
        if ($_SESSION['mayedit'] == "1") {
            if (INTERFAZCORRESPONDENCIAV2 == "1") {
    ?>
                <li onClick="ShowMailer('/notificaciones/mini_new/<?= $object->GetId(); ?>/', 'mailer_new')"id='mailer_new' role='presentation'><a href="#">Nueva Correspondencia</a></li>
    <?
            }else{
                
    ?>
            
            <li class="" id='mailer_new' role='presentation'><a href="/gestion/correo/<?= $object->GetId(); ?>/<?= ($object->GetRadicado() != "")?$object->GetRadicado():$object->GetMin_rad() ?>/">Nueva Correspondencia</a></li>
    <?
            }
        }
    ?>
        </ul>
    </div>
</div>
<div class="row">
    <div class="col-md-12" id="cargador_box_upfiles2">
        <?
            $g = new MGestion;
            $g->CreateGestion("id", $object->GetId());

            include(VIEWS.DS."notificaciones".DS."minisent.php");
        ?>
    </div>
</div>