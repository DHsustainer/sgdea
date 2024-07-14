<!--<div id="left-content" style="margin-top:50px; border:1px solid #f00; width: auto;"></div>-->
<script type="text/javascript">

        function GeneradorDatosWidgetAlertas(tipo,pagina, grupo){
            var URL = '/dashboard/'+tipo+'/'+pagina+'/'+grupo+'/';

                
            $.ajax({
                        url:URL,
                        type:'POST',
                        success:function(msg){

                    $('#widgetactividadesnuevas').append(msg);
                        }

                });
        }


function CargarAlerta(grupo, titulo, tipo, pagina){

        $("#widgetactividadesnuevas").html("");
        $("#tituo_widget").html(titulo);

        $("#listmenuwidgets > a").removeClass("active");
        $("#elm"+tipo).addClass('active');
        GeneradorDatosWidgetAlertas(tipo,pagina, grupo);
        Updatethatfield(tipo);

}


function GeneradorDatosWidgetAlertas2(tipo,pagina, grupo,tab){
            var URL = '/dashboard/'+tipo+'/'+pagina+'/'+grupo+'/'+tab+'/';
                
            $.ajax({
                        url:URL,
                        type:'POST',
                        success:function(msg){

                    $('#widgetactividadesnuevas').append(msg);
                        }

                });
        }


function CargarAlerta2(grupo, titulo, tipo, pagina, tab){

        $("#widgetactividadesnuevas").html("");
        $("#tituo_widget").html(titulo);

        $(".list-group > a").removeClass("active");
        $("#elm"+tipo).addClass('active');
        GeneradorDatosWidgetAlertas2(tipo,pagina, grupo, tab);
        Updatethatfield(tipo);

}


function Updatethatfield(tipo){
    var URL = '/dashboard/changethat/'+tipo+'/';
    $.ajax({
        url:URL,
        type:'POST',
        success:function(msg){
            // nothing...
        }

    });
}


</script>
<?
    $usua = new MUsuarios;
    $usua->CreateUsuarios("user_id", $_SESSION['usuario']);

    $sql = "SELECT * FROM alertas a inner join events_gestion eg  on eg.id = a.id_evento inner join tipos_alertas ta on ta.alt = a.extra  inner join gestion gx on gx.id = a.id_gestion  where gx.estado_respuesta = 'Abierto' and gx.estado_archivo = '1' and a.type = '1' and a.status = '0' and a.user_id = '".$_SESSION['usuario']."' and eg.fecha_realizado = '0000-00-00 00:00:00' and 'SI' != (SELECT estado_respuesta FROM gestion where id = eg.gestion_id) and a.extra not in('trexp', 'texp', 'doc', 'an', 'rad', 'comp') group by eg.id";

    #echo $sql;
    $qwa = $con->Query($sql);
    $contact    = $con->NumRows($qwa);

    $sql = "SELECT * from events_gestion eg  inner join gestion gx on gx.id = eg.gestion_id  where gx.estado_respuesta = 'Abierto' and gx.estado_archivo = '1' and eg.status = '1' and eg.grupo = '".$_SESSION['user_ai']."'";

    $qwa = $con->Query($sql);
    $contacttareas = $con->NumRows($qwa);

    $sql = "SELECT * FROM alertas a inner join events_gestion eg  on eg.id = a.id_evento inner join tipos_alertas ta on ta.alt = a.extra  inner join gestion gx on gx.id = a.id_gestion  where gx.estado_respuesta = 'Abierto' and gx.estado_archivo = '1' and  a.type = '1' and a.status = '0'  and a.user_id = '".$_SESSION['usuario']."' and eg.fecha_realizado = '0000-00-00 00:00:00' and 'SI' != (SELECT estado_respuesta FROM gestion where id = eg.gestion_id) and a.extra in('rad') group by eg.id";

    #echo $sql;
    $qwa = $con->Query($sql);
    $contacte    = $con->NumRows($qwa);

    $sql = "SELECT * FROM alertas a inner join events_gestion eg  on eg.id = a.id_evento inner join tipos_alertas ta on ta.alt = a.extra inner join gestion gx on gx.id = a.id_gestion  where gx.estado_respuesta = 'Abierto' and gx.estado_archivo = '1' and a.type = '1' and a.status = '0'  and a.user_id = '".$_SESSION['usuario']."' and eg.fecha_realizado = '0000-00-00 00:00:00' and 'SI' != (SELECT estado_respuesta FROM gestion where id = eg.gestion_id) and a.extra in('doc', 'an') group by eg.id";

    #echo $sql;
    $qwa = $con->Query($sql);
    $contactd    = $con->NumRows($qwa);


    $sql = "SELECT * FROM alertas a inner join events_gestion eg  on eg.id = a.id_evento inner join tipos_alertas ta on ta.alt = a.extra inner join gestion gx on gx.id = a.id_gestion where gx.estado_respuesta = 'Abierto' and gx.estado_archivo = '1' and a.type = '1' and a.status = '0'  and a.user_id = '".$_SESSION['usuario']."' and eg.fecha_realizado = '0000-00-00 00:00:00' and 'SI' != (SELECT estado_respuesta FROM gestion where id = eg.gestion_id) and a.extra in('comp') group by eg.id";

    #echo $sql;
    $qwa = $con->Query($sql);
    $contactc    = $con->NumRows($qwa);

    $MSolicitudes_documentos = new MSolicitudes_documentos;
    $qwa = $MSolicitudes_documentos->ListarSolicitudes_documentos("WHERE usuario_destino ='".$_SESSION['usuario']."' and estado = '0'");
    $contvenc = $con->NumRows($qwa);

    $sql = "SELECT e.dias, g.id FROM gestion g inner join ( SELECT gestion_id, DATEDIFF(now(),max(fecha)) as dias FROM events_gestion group by gestion_id ) e on g.id = e.gestion_id where g.estado_respuesta = 'Abierto' and g.estado_archivo = '1' and g.oficina = '".$_SESSION['seccional']."' and g.nombre_destino = '".$_SESSION['a_i']."' and $comparacion e.dias > 0 group by g.id";
    $qwa = $con->Query($sql);
    $continact  =  $con->NumRows($qwa);

    $MGestion_anexos_firmas = new MGestion_anexos_firmas;
    $qwa = $MGestion_anexos_firmas->ListarGestion_anexos_firmas("where usuario_firma = '".$_SESSION['usuario']."' and estado_firma = '0'");
    $contfirmas   =  $con->NumRows($qwa);

    $MSolicitudes_documentos = new MSolicitudes_documentos;
    $qwa = $MSolicitudes_documentos->ListarSolicitudes_documentos("WHERE usuario_destino ='".$_SESSION['usuario']."' and estado = '0'");
    $contsol    = $con->NumRows($qwa);

    $newemails = $c->GetNewMailsNumber();

    $MSolicitudes_documentos = new MSolicitudes_documentos;
    $qws = $MSolicitudes_documentos->ListarSolicitudes_documentos("WHERE usuario_destino ='".$_SESSION['usuario']."' and estado = '0'" ,"order by fecha_solicitud","");
    $consolicitudes = $con->NumRows($qws);



    $nsp = $con->Query("select count(*) as t from gestion_transferencias  inner join gestion on gestion.id = gestion_transferencias.gestion_id where user_transfiere = '".$_SESSION['usuario']."' and (gestion_transferencias.estado = '0' or gestion_transferencias.estado = '2')");
    $nspr = $con->FetchAssoc($nsp); 

    $nsr = $con->Query("select count(*) as t from gestion_transferencias  inner join gestion on gestion.id = gestion_transferencias.gestion_id where user_recibe = '".$_SESSION['user_ai']."' and gestion_transferencias.estado = '0'");
    $nsrr = $con->FetchAssoc($nsr);

    $cantidadPendientes = "<span title='Solicitudes de Transferencias: Recibidas - Enviadas'>".$nsrr['t']." - ".$nspr['t']."</span>";


    $total_exp = 0;
    // $sql = "SELECT count(*) as t FROM gestion g inner join gestion_cambio_ubicacion_archivo gcua on g.id = gcua.id_gestion WHERE gcua.estado_archivo_origen = '1' and gcua.estado = '0' UNION SELECT count(*) as t FROM gestion WHERE gestion.id NOT IN(select id_gestion from gestion_cambio_ubicacion_archivo) AND nombre_destino = '".$usua->GetA_i()."' and estado_archivo = '1' and DATE_ADD(f_recibido, INTERVAL (SELECT t_g FROM dependencias where id = tipo_documento) DAY) <= DATE(NOW()) UNION SELECT count(*) as t FROM gestion WHERE gestion.id NOT IN(select id_gestion from gestion_cambio_ubicacion_archivo) and gestion.dependencia_destino = '".$usua->GetRegimen()."' and  nombre_destino <> '".$usua->GetA_i()."' and estado_archivo = '1' and DATE_ADD(gestion.f_recibido, INTERVAL (SELECT t_g FROM dependencias where id = gestion.tipo_documento) DAY) <= DATE(NOW()) UNION SELECT count(*) as t FROM gestion g inner join gestion_cambio_ubicacion_archivo gcua on g.id = gcua.id_gestion WHERE gcua.estado_archivo_origen = '2' and gcua.estado = '0' UNION SELECT count(*) as t FROM gestion WHERE gestion.id NOT IN(select id_gestion from gestion_cambio_ubicacion_archivo) AND nombre_destino = '".$usua->GetA_i()."' and estado_archivo = '2' and DATE_ADD(f_recibido, INTERVAL (SELECT t_c FROM dependencias where id = tipo_documento) DAY) <= DATE(NOW()) UNION SELECT count(*) as t FROM gestion WHERE gestion.id NOT IN(select id_gestion from gestion_cambio_ubicacion_archivo) and gestion.dependencia_destino = '".$usua->GetRegimen()."' and  nombre_destino <> '".$usua->GetA_i()."' and estado_archivo = '2' and DATE_ADD(gestion.f_recibido, INTERVAL (SELECT t_c FROM dependencias where id = gestion.tipo_documento) DAY) <= DATE(NOW())";

    // #echo $sql;

    // $chck = $con->Query($sql);
    // while($row = $con->FetchAssoc($chck)){
    //     $total_exp += $row['t'];
    // }

    $cantidad = $f->Zerofill($total_exp,3);
    $cantidad = 0;


    $cantidadvalidar = 0;
    $myid = $c->GetDataFromTable("usuarios", "user_id", $_SESSION['usuario'], "a_i", $separador = " ");

    $object = new MGestion; 
    // CARGANDO LLAMANDO LA FUNCION LSITAR LIBROS DEL MODELO (FUNCION QUE TRAE DE LA BASE DE DATOS EL LISTADO DE LIBROS
    // DE NO RECIBIR PARAMETROS ESTA FUNCION TRAE EL LISTADO COMPLETO DE LIBROS
    $tipo_d = $con->Query("select id, dependencia from dependencias where es_publico = 1");



    $tipo_documento = "";
    $i = 0;
    while ($row = $con->FetchAssoc($tipo_d)) {
        $i++;
        if ($i < $con->NumRows($tipo_d)) {
            $tipo_documento .= $row['id'].", "; 
        }else{
            $tipo_documento .= $row['id'];  
        }
        # code...
    }
    $queryxr = $object->ListarGestion("WHERE estado_archivo = '1' and estado_respuesta = 'Pendiente' and rweb = '1'");   
    $cantidadvalidar = $con->NumRows($queryxr);


?>

<div class="row bg-title">
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <h4 class="page-title"><?= CAMPOINICIOTITULO ?></h4> 
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">

<?
    global $c;
    $totalc = $c->GetTotalFromTable("seccional_principal", "");
    $totalof = $c->GetTotalFromTable("seccional", "");

    if (!isset($_SESSION['smallid']) || $_SESSION['smallid'] == '') {
        $smallid = $f->GenerarSmallId();
        $_SESSION['smallid'] = $smallid;
    }

    $u = new MUsuarios;
    $u->CreateUsuarios("user_id", $_SESSION['usuario']);



    $query_eg = $con->Query("select * from province where Country = 'CO'");
    $departamentos = "";
    while($row_type = $con->FetchAssoc($query_eg)){
        $departamentos .= "<option value='".$row_type['code']."'>".$row_type['Name']."</option>";
    }

    $countnot = $con->Query("select * from notificaciones where user_id = '".$_SESSION['usuario']."' ");

    $counterfisicas = 0;
    $counterelectro = 0;
    while ($rownot = $con->FetchAssoc($countnot)) {
        if ($rownot['tipo_notificacion'] == "CE") {
            $counterelectro++;
        }
        if ($rownot['tipo_notificacion'] == "CC") {
            $counterfisicas++;
        }
    }


    $disable = false;

    #CORRESPONDENCIAELECTRONICA = "99";

    $totala = CORRESPONDENCIAFISICA + CORRESPONDENCIAELECTRONICA;
    $totalb = $counterfisicas + $counterelectro;


    if ($u->Getfreemium() == "1") {
        if ($totalb >= $totala) {
            $disable = true;
        }

        $CuartoMensaje = new MPlantillas_email;
        $CuartoMensaje->CreatePlantillas_email('id', '69'); 
        $paso4 = $CuartoMensaje->GetContenido();
    }

    if ($_SESSION['MODULES']['tipo_negocio_correpondencia'] == "2") {
        $disable = false;
    }


    #print_r($_SESSION['MODULES']);
    $lx = new MSuscriptores_tipos;
    $query_eg = $lx->ListarSuscriptores_tipos(""); 
    $pathtrs = "";
    while($row_type = $con->FetchAssoc($query_eg)){
        $pathtrs .= "<option value='".$row_type['id']."'>".$row_type['nombre']."</option>";
    }

    $query_eg = $lx->ListarSuscriptores_tipos(""); 
    $pathtrs = "";
    while($row_type = $con->FetchAssoc($query_eg)){
        $pathtrs .= "<option value='".$row_type['id']."'>".$row_type['nombre']."</option>";
    }

    if ($_SESSION['MODULES']['tipo_negocio_correpondencia'] != "2"): 
        if ($_SESSION['MODULES']['tipo_negocio_correpondencia'] == "1") {
            
            $cupo = $u->GetCupo();
        }else{

            $sadmin = new MSuper_admin;
            $sadmin->CreateSuper_admin("id", "6");
            $cupo = CUPOCUENTA;

        }

        #$cupo = $u->GetCupo();

        if ($_SESSION['MODULES']['configuracion_pagos'] == "1"){
        
            $fcaducidad = substr($u->GetF_caducidad(), 0, 10);
?>
            <div class="pull-right">
                <button class='btn btn-success' onclick="LoadModal('','Adquirir Licencia', '/usuarios_compras/nuevo/<?= $u->GetCupo() ?>/')">
                    <?= "Donar" ?>
                </button>
            </div>
            <div class="pull-right m-r-20">
                <h4 class="card-title">
                    Fecha de Caducidad: 
                    <span class="text-success">
                        <b><?= $fcaducidad ?></b>    
                    </span>
                </h4>
            </div>
<?                  
        }elseif($_SESSION['MODULES']['configuracion_pagos'] == "2"){
?>
            <div class="pull-right">
                <button class='btn btn-danger' onclick="LoadModal('',  'Recargar Cuenta', '/usuarios_compras/nuevo/<?= $u->GetCupo() ?>/')">
                    <?= ($cupo <= 0)?"REALIZAR PAGO":"COMPRAR MÁS SALDO" ?>
                </button>
            </div>
            <div class="pull-right m-r-20">
                <h4 class="card-title">
                    Saldo Actual: 
                    <span class="text-success">
                        <b><?= $cupo ?></b>
                    </span>
                </h4>
            </div>
<?
        }
    endif 

    

?>
    </div>
</div>
<?
    if ($_SESSION['MODULES']['configuracion_pagos'] == "1"){
        
        $fcaducidad = substr($u->GetF_caducidad(), 0, 10);

        if ($fcaducidad < date("Y-m-d")) {
            echo "<div class='alert alert-danger'>Tu Suscripción ha expirado el día $fcaducidad. Extiende tu licencia para poder continuar disfrutando de nuestros servicios</div>";
        }

    }elseif($_SESSION['MODULES']['configuracion_pagos'] == "2"){
        
        $cupodeuda = $u->Getcupousuario() * -1 ;
        
        if ($u->GetCupo() < "4000") {
            if ($u->GetCupo() <= $cupodeuda) {
                echo "<div class='alert alert-danger'>Tu Saldo disponible es menor a $ 300 y su capacidad de endeudamiento es $cupodeuda, recarga tu cuenta para poder continuar disfrutando de nuestros servicios</div>";
            }else{
                echo "<div class='alert alert-warning'>Tienes menos de $ 4.000 en tu saldo disponible, no olvides recargar tu cuenta para que puedas seguir disfrutando de nuestros servicios</div>";
            }
        }

        if ($_SESSION['MODULES']['tipo_negocio_correpondencia'] == "2") {
            
        }

    }
?>
<button class="right-side-toggle waves-effect waves-light btn btn-info m-r-20 pull-left dn" id="btn_sidebar">Ver Solicitud</button>
<?php if ($u->getupdatepassword() == "1"): ?>
    
    <div class="alert alert-warning">Estimado Usuario, por motivos de seguridad se le aconseja cambiar su contraseña, para realizarlo, ingrese a la configuración de su perfil o haga clic <a href="/dashboard/profile/">aqui</a></div>   
<?php endif ?>

<?

    if($_SESSION['usuariosuscriptor'] == "0"){
?>            

<div class="row">
    <!-- Left sidebar -->
    <div class="col-md-12">
        <div class="white-box" style="padding: 15px !important;">
            <!-- row -->
            <div class="row">
                <div class="col-lg-3 col-md-3  col-sm-12 col-xs-12 inbox-panel p-0" id="widget2">
                    <?
                    if (INTERFAZCORRESPONDENCIAV2 == "0") {
                    ?>
                        <a href="/gestion/correo/" class="btn btn-custom btn-block waves-effect waves-light">Registar Envío</a>
                    <?
                    }
                    ?>
                    <div class="list-group mail-list m-t-20"> 
                        <a href="#" onClick="CargarAlerta2(1, 'Mis <?= CAMPOEXPEDIENTE."s" ?>', 'ver', '1','tab1')" id="elmver" <?= $c->Ayuda('349', 'tog') ?>class="list-group-item active" style="padding-top: 15px !important; padding-bottom: 15px !important;"><span class="fa fa-bell-o m-r-10"></span> Mis <?= CAMPOEXPEDIENTE ?>s</a> 
                        
                        <a  href="#" onClick="CargarAlerta2(1, '<?= CAMPOEXPEDIENTE."s Favoritos" ?>', 'favoritos', '1','tab1')" id="elmfavoritos" <?= $c->Ayuda('350', 'tog') ?>class="list-group-item " style="padding-top: 15px !important; padding-bottom: 15px !important;"><span class="fa fa-star-o m-r-10"></span>Favoritos</a> 
                        
                        <a href="#"  onClick="CargarAlerta2(1, '<?= CAMPOEXPEDIENTE."s Cerrados o Finalizados" ?>', 'archivados', '1','tab1')" id="elmarchivados"  <?= $c->Ayuda('351', 'tog') ?>class="list-group-item " style="padding-top: 15px !important; padding-bottom: 15px !important;"><span class="fa fa-lock m-r-10"></span>Cerrados</a> 
                    </div>
                    <hr>
                    <div class="list-group mail-list m-t-20"> 
                        <a href="#" onClick="CargarAlerta2(1, 'Documentos Nuevos', 'documentosnuevos', '1','tab1')" id="elmdocumentosnuevos" class="list-group-item  <?= M_ALERTA_NEWDOCS ?>" <?= $c->Ayuda("1", "tog") ?> style="padding-top: 15px !important; padding-bottom: 15px !important;">
                            <?php if ($contactd != 0 ): ?>
                            <span class="badge "><?= $contactd; ?></span>
                            <?php endif ?>
                            <span class="fa fa-paperclip m-r-10"></span> <?= ALERTA_NEWDOCS ?>
                        </a>
                        <a href="#" style="padding-top: 15px !important; padding-bottom: 15px !important;" onClick="CargarAlerta2(1, 'Documentos Para Firmar', 'documentospendientesfirma', '1', 'tab1')" id="elmdocumentospendientesfirma" class="list-group-item <?= M_ALERTA_FIRMAS ?>"  <?= $c->Ayuda("2", "tog") ?>>
                            <?php if ($contfirmas != 0 ): ?>
                                <span class="badge"><?= $contfirmas; ?></span>
                            <?php endif ?>
                            <span class="fa fa-pencil m-r-10"></span> <?= ALERTA_FIRMAS ?>
                        </a>
                    
                        <a href="#" style="padding-top: 15px !important; padding-bottom: 15px !important;" onClick="CargarAlerta2(1, 'Actividades Nuevas', 'actividadesnuevas', '1','tab1')" id="elmactividadesnuevas" class="list-group-item  <?= M_ALERTA_ACTIVIDADES ?>" <?= $c->Ayuda("3", "tog") ?>>
                            <?php if ($contact != 0 ): ?>
                                <span class="badge "><?= $contact; ?></span>
                            <?php endif ?>
                            <span class="fa fa-check m-r-10"></span><?= ALERTA_ACTIVIDADES ?>
                        </a>

                        <a href="#" style="padding-top: 15px !important; padding-bottom: 15px !important;" onClick="CargarAlerta2(1, 'Tareas', 'tareas', '1','tab1')" id="elmtareas" class="list-group-item  <?= M_ALERTA_ACTIVIDADES ?>" <?= $c->Ayuda("3", "tog") ?>>
                            <?php if ($contacttareas != 0 ): ?>
                                <span class="badge "><?= $contacttareas; ?></span>
                            <?php endif ?>
                            <span class="fa fa-check m-r-10"></span>Tareas
                        </a>

                        <a href="#" style="padding-top: 15px !important; padding-bottom: 15px !important;" onClick="CargarAlerta2(1, 'Expedientes Compartidos', 'expedientescompartidos', '1','tab1')" id="elmexpedientescompartidos" class="list-group-item  <?= M_ALERTA_COMPARTIDOS ?>" <?= $c->Ayuda("12", "tog") ?>>
                            <?php if ($contactc != 0 ): ?>
                                <span class="badge "><?= $contactc; ?></span>
                            <?php endif ?>
                            <span class="fa fa-share m-r-10"></span>
                            <?= ALERTA_COMPARTIDOS ?>
                        </a>
                        <?php if ($_SESSION['MODULES']['digitalizacion'] == "0"): ?>
                        <a href="#" style="padding-top: 15px !important; padding-bottom: 15px !important;" onClick="CargarAlerta2(1, 'Expedientes Inactivos', 'expedientesinactivos', '1' , 'tab1')" id="elmexpedientesinactivos" class="list-group-item <?= M_ALERTA_INACTIVOS ?>" <?= $c->Ayuda("13", "tog") ?>>
                            <?php if ($continact != 0 ): ?>
                                <span class="badge "><?= $continact; ?></span>
                            <?php endif ?>
                            <span class="fa fa-ban m-r-10"></span>
                            <?= ALERTA_INACTIVOS ?>
                        </a> 
                        <?php endif ?>


                        <a href="/gestion/vencimientoexpedientesarchivo/1/" id="elmexpedientesvencer" style="padding-top: 15px !important; padding-bottom: 15px !important;" class="list-group-item <?= M_ALERTA_ARCHIVAR ?>" <?= $c->Ayuda("14", "tog") ?>>
                            <?php if ($cantidad != 0 ): ?>
                                <span class="badge "><?= $cantidad; ?></span>
                            <?php endif ?>
                            <span class="fa fa-calendar-times-o m-r-10"></span>
                            <?= ALERTA_ARCHIVAR ?>
                        </a> 
                        <?php if($_SESSION['archivo_central']): ?>
                            
                            <a href="/gestion/archivocentral/<?= $_SESSION['area_principal'] ?>/"  style="padding-top: 15px !important; padding-bottom: 15px !important;" class="list-group-item <?= M_ALERTA_ARCHIVAR ?>">
                                <span class="fa fa-calendar-times-o m-r-10"></span>
                                Archivo Central
                            </a> 

                        <?php endif?>

                        <?php if ($_SESSION['MODULES']['digitalizacion'] == "0"): ?>
                            <a href="#" style="padding-top: 15px !important; padding-bottom: 15px !important;" onClick="CargarAlerta2(1, 'Solicitudes de Expedientes', 'solicituddocumentos', '1', 'tab1')" id="elmsolicituddocumentos" class="list-group-item <?= M_ALERTA_SOLICITUDES ?>" <?= $c->Ayuda("15", "tog") ?>>
                                <?php if ($consolicitudes != 0 ): ?>
                                    <span class="badge "><?= $consolicitudes ?></span>
                                <?php endif ?>
                                <span class="fa fa-folder m-r-10"></span>
                                <?= ALERTA_SOLICITUDES ?>
                            </a>
                        <?php if ($_SESSION['ventanilla'] == '1'): ?>
                            <a href="#" style="padding-top: 15px !important; padding-bottom: 15px !important;" onClick="CargarAlerta2(1, 'Expedientes Pendientes por Validar', 'pendientesvalidar', '1', 'tab1')" id="elmpendientesvalidar" class="list-group-item <?= M_ALERTA_WEB ?>" <?= $c->Ayuda("16", "tog") ?>>
                                <?php if ($cantidadvalidar != 0 ): ?>
                                    <span class="badge "><?= $cantidadvalidar ?></span>
                                <?php endif ?>
                                <span class="fa fa-bell-o m-r-10"></span>
                                <?= ALERTA_WEB ?>
                            </a>
                        <?php endif ?>
                            <a href="#" style="padding-top: 15px !important; padding-bottom: 15px !important;" onClick="CargarAlerta2(1, 'Transferencias Pendientes', 'transferenciaspendientes', '1', 'tab1')" id="elmtransferenciaspendientes" class="list-group-item <?= M_ALERTA_TRANSFERENCIAS ?>" <?= $c->Ayuda("17", "tog") ?>>
                                <?php if ($cantidadPendientes != 0 ): ?>
                                <?php endif ?>
                                    <span class="badge "><?= $cantidadPendientes ?></span>
                                <span class="fa fa-check-square-o m-r-10"></span>
                                <?= ALERTA_TRANSFERENCIAS ?>
                            </a>
                        <?php endif ?>
                        <a href="#" style="padding-top: 15px !important; padding-bottom: 15px !important;" onClick="CargarAlerta2(1, 'Ultimos 50 Movimientos Del Usuario', 'ultimosmovimientosglobales', '1', 'tab1')" id="elmultimosmovimientosglobales" class="list-group-item <?= M_ALERTA_MOVIMIENTOS ?>" <?= $c->Ayuda("19", "tog") ?>>
                            <span class="fa fa-globe m-r-10"></span>
                            <?= ALERTA_MOVIMIENTOS ?>
                        </a>

                        <a href="#" style="padding-top: 15px !important; padding-bottom: 15px !important;" onClick="CargarAlerta2(1, 'Cambios de Estados de los <?= CAMPOEXPEDIENTE ?>(s)', 'seguimientoestados', '1', 'tab1')" id="elmseguimientoestados" class="list-group-item <?= M_TITULOSEGUIMIENTOESTADOS ?>" <?= $c->Ayuda("19", "tog") ?>>
                            <span class="fa fa-globe m-r-10"></span>
                            <?= TITULOSEGUIMIENTOESTADOS ?>
                        </a>
                    </div>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 mail_listing">
                    <div class="row m-t-30" id="listmenuwidgets">
                        <div class="widget col-md-12 minimizar expandir">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 p-0">
                                <div id="contentwidgetactividadesnuevas">
                                    <h4 class="widget_title">
                                        <span title="Actividades Nuevas" class="fa fa-check"></span> 
                                        <span class="titulo_widget" id="tituo_widget">titulo</span>
                                    </h4>
                                    <div class="panel-wrapper collapse in">
                                        <div class="panel-body" id="widgetactividadesnuevas">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
    </div>
</div>
<?
    $u = new MUsuarios;
    $u->CreateUsuarios("user_id", $_SESSION['usuario']);
    if ($u->GetFirma() == "firma-de-fidel-10-de-septiembre-de-2009.jpg") {
?>
        <div class="col-lg-3 col-xs-12 dn">
            <div class="white-box">
                <a href="#" id="sa-warning2">Warning message</a> 
            </div>
        </div>
        <script type="text/javascript">
            /*
                setTimeout(function(){
                    $( "#sa-warning2" ).trigger( "click" );
                }, 500);
            */
        </script>
<?
    }
?>
<script type="text/javascript">
    function AbrirAlerta(id, pagina){
        var URL = '/dashboard/f/'+id+'/'+pagina+'/';
        $("#detgraph").html('');
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: URL,
            success:function(msg){
                $("#detgraph").html(msg['a']);

                    
                    var id = msg['pag_oficina'];
                    var pagant = parseInt(msg['PagAnt']);
                    var pagsig = parseInt(msg['PagSig']);
                    var pagult = parseInt(msg['PagUlt']);

                    pathAnt = "";
                    pathSig = "";

                    if (pagant == "0") {
                        $pathAnt = '<button type="button" id="navprev" disabled class="btn btn-default waves-effect"><i class="fa fa-chevron-left"></i></button>';
                    }else{
                        $pathAnt = '<button type="button" id="navprev" onClick="AbrirAlerta(\''+id+'\', \''+pagant+'\')" class="btn btn-default waves-effect"><i class="fa fa-chevron-left"></i></button>';
                    }
                    if (pagsig > pagult) {
                        $pathSig = '<button type="button" id="navnext" disabled class="btn btn-default waves-effect"><i class="fa fa-chevron-right"></i></button>';
                    }else{
                        $pathSig = '<button type="button" id="navnext" onClick="AbrirAlerta(\''+id+'\', \''+pagsig+'\')" class="btn btn-default waves-effect"><i class="fa fa-chevron-right"></i></button>';
                    }   
                    $(".navigation_bar").html($pathAnt+$pathSig);

            }
        });
    }
    function LoadAlertas(idg){
        $("#btn_sidebar").click();

        var URL = '/dashboard/ald/'+idg+'/U/';
        $("#detail_alerta").html('<svg class="circular" viewBox="25 25 50 50"><circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/></svg>');
        $.ajax({
            type: 'POST',
            url: URL,
            success:function(msg){
                $("#detail_alerta").html(msg);
            }
        });
    }
</script>
<?
    if ($_REQUEST['action'] == 'n') {
        echo '  <script>
                    AbrirAlerta("'.$_REQUEST['id'].'", "1")
                </script>';
    }else{
        echo '  <script>
                    AbrirAlerta("*", "1")
                </script>';
    }
?>
<script type="text/javascript">
  $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip(); 
        $('[data-toggle="popover"]').popover()
  });

</script>
<!-- ============================================================== -->
<!-- start right sidebar -->
<!-- ============================================================== -->
<div class="right-sidebar" style="display: block;">
    <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 100%;">
        <div class="slimscrollright" style="overflow: hidden; width: auto; height: 100%;">
            <div class="rpanel-title"> RESUMEN DE LA SOLICITUD <span><i class="ti-close right-side-toggle"></i></span></div>
            <div class="r-panel-body" id="detail_alerta">
                
            </div>
        </div>
    </div>
</div>
<style type="text/css">
    @media (max-width: 1350px){
        .inbox-center a {
            width: 600px;
        }
    }
</style>

<!-- ============================================================== -->
<!-- end right sidebar -->
<!-- ============================================================== -->
<?

    if ($_REQUEST['id'] != "") {
        switch ($_REQUEST['id']) {
            case 'inbox':
?>
                <script type="text/javascript">
                    CargarAlerta2("1", 'Bandeja de Correos Electr贸nicos', 'correoelectronico', '1', 'tab1')
                </script>
<?
            break;
            case 'outbox':
?>
                <script type="text/javascript">
                    CargarAlerta(1, 'Bandeja de Correspondencia Fisica', 'correspondencia_fisica', '1');
                </script>
<?
            break;
            case 'firmas':
?>
                <script type="text/javascript">
                    CargarAlerta2(1, 'Documentos Pendientes Para Firmar Y/O Revisar', 'documentospendientesfirma', '1', 'tab1');
                </script>
<?
            break;
            case 'inactivos':
?>
                <script type="text/javascript">
                    CargarAlerta2(1, 'Expedientes Inactivos', 'expedientesinactivos', '1', 'tab1');
                </script>
<?
            break;
            case 'archivar':
?>
                <script type="text/javascript">
                    CargarAlerta(1, 'Expedientes Para Archivar', 'expedientesvencer', '1');
                </script>
<?
            break;
            case 'validar':
?>
                <script type="text/javascript">
                    CargarAlerta2(1, 'Expedientes pendientes para validar.', 'pendientesvalidar', '1', 'tab1');
                </script>
<?
            break;
            case 'solicitudes':
?>
                <script type="text/javascript">
                    CargarAlerta2(1, 'Solicitudes de Documentos', 'solicituddocumentos', '1', 'tab1');
                </script>
<?
            break;
            case 'transferencias':
?>
                <script type="text/javascript">
                    CargarAlerta2(1, 'Listado de Expedientes por Transferir', 'transferenciaspendientes', '1', 'tab1');
                </script>
<?
            break;
            case 'globales':
?>
                <script type="text/javascript">
                    CargarAlerta2(1, 'Ultimos 50 Movimientos Del Usuario', 'ultimosmovimientosglobales', '1', 'tab1');
                </script>
<?
            break;
            case 'tareas':
?>
                <script type="text/javascript">
                    CargarAlerta2(1, 'Tareas', 'tareas', '1','tab1')
                </script>
<?
            break;
            case 'documentosnuevos':
?>
                <script type="text/javascript">
                    CargarAlerta2(1, 'Documentos Nuevos', 'documentosnuevos', '1','tab1')
                </script>
<?
            break;    
            case 'seguimientoestados':
?>
                <script type="text/javascript">
                    CargarAlerta2(1, 'Documentos Nuevos', 'seguimientoestados', '1','tab1')
                </script>
<?
            break;                           
            default:
?>
                <script type="text/javascript">
                    CargarAlerta2("1", 'Actividades Nuevas', 'actividadesnuevas', '1', 'tab1')
                </script>
<?
            break;
        }
    }else{
        #echo "Actual: ".$_SESSION['alerta_activa'];
        $variablesmen = array(  "1" => "inbox", "2" => "outbox", "3" => "firmas", "4" => "inactivos", "5" => "archivar", 
                                "6" => "validar", "7" => "solicitudes", "8" => "transferencias", "9" => "globales");

        switch ($variablesmen[$_SESSION['alerta_activa']]) {
            case 'inbox':
?>
                <script type="text/javascript">
                    CargarAlerta2("1", 'Bandeja de Correos Electrónicos', 'correoelectronico', '1', 'tab1')
                </script>
<?
            break;
            case 'outbox':
?>
                <script type="text/javascript">
                    CargarAlerta(1, 'Bandeja de Correspondencia Fisica', 'correspondencia_fisica', '1');
                </script>
<?
            break;
            case 'firmas':
?>
                <script type="text/javascript">
                    CargarAlerta2(1, 'Documentos Pendientes Para Firmar Y/O Revisar', 'documentospendientesfirma', '1', 'tab1');
                </script>
<?
            break;
            case 'inactivos':
?>
                <script type="text/javascript">
                    CargarAlerta2(1, 'Expedientes Inactivos', 'expedientesinactivos', '1', 'tab1');
                </script>
<?
            break;
            case 'archivar':
?>
                <script type="text/javascript">
                    CargarAlerta(1, 'Expedientes Para Archivar', 'expedientesvencer', '1');
                </script>
<?
            break;
            case 'validar':
?>
                <script type="text/javascript">
                    CargarAlerta2(1, 'Expedientes pendientes para validar.', 'pendientesvalidar', '1');
                </script>
<?
            break;
            case 'solicitudes':
?>
                <script type="text/javascript">
                    CargarAlerta2(1, 'Solicitudes de Documentos', 'solicituddocumentos', '1', 'tab1');
                </script>
<?
            break;
            case 'tareas':
?>
                <script type="text/javascript">
                    CargarAlerta2(1, 'Tareas', 'tareas', '1','tab1')
                </script>
<?
            break;            
            case 'transferencias':
?>
                <script type="text/javascript">
                    CargarAlerta2(1, 'Listado de Expedientes por Transferir', 'transferenciaspendientes', '1', 'tab1    ');
                </script>
<?
            break;
            case 'globales':
?>
                <script type="text/javascript">
                    CargarAlerta2(1, 'Ultimos 50 Movimientos Del Usuario', 'ultimosmovimientosglobales', '1', 'tab1');
                </script>
<?
            break;
            case 'documentosnuevos':
?>
                <script type="text/javascript">
                    CargarAlerta2(1, 'Documentos Nuevos', 'documentosnuevos', '1','tab1')
                </script>
<?
            break;            
            case 'ver':
?>
                <script type="text/javascript">
                    CargarAlerta2(1, 'Mis <?= CAMPOEXPEDIENTE."s" ?>', 'ver', '1','tab1')
                </script>
<?
            break;            
            case 'favoritos':
?>
                <script type="text/javascript">
                    CargarAlerta2(1, '<?= CAMPOEXPEDIENTE."s Favoritos" ?>', 'favoritos', '1','tab1')
                </script>
<?
            break;            
            case 'archivados':
?>
                <script type="text/javascript">
                    CargarAlerta2(1, '<?= CAMPOEXPEDIENTE."s Cerrados o Finalizados" ?>', 'archivados', '1','tab1')
                </script>
<?
            break;   
            case 'seguimientoestados':
?>
                <script type="text/javascript">
                    CargarAlerta2(1, '<?= CAMPOEXPEDIENTE."s con cambio de Estados" ?>', 'seguimientoestados', '1','tab1')
                </script>
<?
            break;                                                            
            default:
?>
                <script type="text/javascript">
                    CargarAlerta2("1", 'Mis Expedientes', 'ver', '1', 'tab1')
                </script>
<?
            break;
        }       
    }
?>
<?
    }else{
?>

<div class="row">
    <!-- Left sidebar -->
    <div class="col-md-12">
        <div class="white-box" style="padding: 15px !important;">
            <!-- row -->
            <div class="row">
                <div class="col-lg-3 col-md-3  col-sm-12 col-xs-12 inbox-panel p-0" id="widget2">
                    <div class="list-group mail-list m-t-20"> 
                        <a href="#" onClick="CargarAlerta2(1, 'Mis <?= CAMPOEXPEDIENTE."s" ?>', 'ver', '1','tab1')" id="elmver" <?= $c->Ayuda('349', 'tog') ?>class="list-group-item active" style="padding-top: 15px !important; padding-bottom: 15px !important;"><span class="fa fa-bell-o m-r-10"></span> Alertas</a> 
                    </div>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 mail_listing">
                    <div class="row m-t-30" id="listmenuwidgets">
                        <div class="widget col-md-12 minimizar expandir">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 p-0">
                                <div id="contentwidgetactividadesnuevas">
                                    <h4 class="widget_title">
                                        <span title="Actividades Nuevas" class="fa fa-check"></span> 
                                        <span class="titulo_widget" >Mis Aletas</span>
                                    </h4>
                                    <div class="panel-wrapper collapse in">
                                        <div class="panel-body" id="widgetactividadesnuevas">
                                            <div class="list-group">
                                                <?
                                                    global $con;
                                                    $str = "select * from alertas_suscriptor where suscriptor_id = '".$_SESSION['usuario']."' and type = 'global'";
                                                    $lgroup = $con->Query($str);
                                                    while($row = $con->FetchAssoc($lgroup)) {
                                                        echo '<div class="list-group-item">'.$row['alerta'].'</div>';

                                                    }
/*
*/


                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
    </div>
</div>

<?        
    }
?>