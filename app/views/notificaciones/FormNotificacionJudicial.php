<?

    global $con; 

    global $c;

    global $f;

?>

<hr>

<h3>Formulario de Notificación Judicial</h3>

<div class="row m-b-10">

    <div class="col-md-12">

        <h4>Información General</h4>

    </div>

</div>

<div class="row m-b-10">

    <div class="col-md-4">

        <label>Tipo de Notificacion</label>

        <select class="form-control" name="notif_tipo_documento" id="notif_tipo_documento">

            <option value=""></option>

            <option value="Notificacion por Aviso Art 292 del C.G.P.">Notificacion por Aviso Art 292 del C.G.P.</option>

            <option value="Citacion Para Diligencia de Notificacion Personal Art. 291 del C.G.P.">Citacion Para Diligencia de Notificacion Personal Art. 291 del C.G.P.</option>

            <option value="Citacion Para Diligencia de Notificacion Personal Art. 315 del C.P.C.">Citacion Para Diligencia de Notificacion Personal Art. 315 del C.P.C.</option>

            <option value="Notificacion por Aviso Art 320 del C.P.C.">Notificacion por Aviso Art 320 del C.P.C.</option>

            <option value="Articulo 29 del C.P.L">Articulo 29 del C.P.L</option>

            <option value="Citacion para Diligencia de Notificacion Personal Art. 41 C.P.T.">Citacion para Diligencia de Notificacion Personal Art. 41 C.P.T.</option>

            <option value="Aviso Judicial Art. 286 C.G.P.">Aviso Judicial Art. 286 C.G.P.</option>

            <option value="Oficio">Oficio</option>

            <option value="ART. 25 DEL C.G.P.">ART. 25 DEL C.G.P.</option>

            <option value="ART. 468 DEL C.G.P.">ART. 468 DEL C.G.P.</option>

        </select>

    </div>

    <div class="col-md-4">

        <label>Naturaleza del proceso:</label>

        <select class="form-control" name="notif_naturaleza_proceso2" id="notif_naturaleza_proceso2" onchange="fnotro('naturaleza_proceso');">

            <option value="Ejecutivo">Ejecutivo</option>

            <option value="Ejecutivo Hipotecario">Ejecutivo Hipotecario</option>

            <option value="Ejecutivo Mixto">Ejecutivo Mixto</option>

            <option value="Ejecutivo Singular">Ejecutivo Singular</option>

            <option value="Ejecutivo Con Garantia Real">Ejecutivo Con Garantia Real</option>

             <option value="Ejecutivo para la Efectividad de la Garantia Real">Ejecutivo para la Efectividad de la Garantia Real</option>

            <option value="Hipotecario">Hipotecario</option>           

            <option value="Laboral">Laboral</option>

            <option value="Otro">Otro</option>

        </select>

    </div>    



    <div class="col-md-4">

        <label>anexo:</label>

        <select class="form-control" name="notif_anexo2" id="notif_anexo2" onchange="fnotro('anexo');">

            <option value=""></option>

            <option value="Copia informal demanda">Copia informal demanda</option>

            <option value="Auto admisorio">Auto admisorio</option>

            <option value="Mandamiento de Pago">Mandamiento de Pago</option>

            <option value="Copia informal mandamiento de Pago">Copia informal mandamiento de Pago</option>

            <option value="Copia informal Demanda y Auto Admisorio">Copia informal Demanda y Auto Admisorio</option>

            <option value="Copia informal Demanda y Mandamiento de Pago">Copia informal Demanda y Mandamiento de Pago</option>

            <option value="Copia informal auto que libro mandamiento de pago y demanda">Copia informal auto que libro mandamiento de pago y demanda</option>

            <option value="Copia informal del auto que se notifica">Copia informal del auto que se notifica</option>

            <option value="Otro">Otro</option>        

        </select>

    </div>

</div>

<div class="row m-b-10">

    <div class="col-md-4">

        <label>Tipo Cartera:<small>(Opcional)</small></label>

        <select class="form-control" name="notif_tipo_cartera2" id="notif_tipo_cartera2">

            <option value=""></option>

            <option value="CONSUMO">CONSUMO</option>

            <option value="VEHICULO">VEHICULO</option>

            <option value="HIPOTECARIO">HIPOTECARIO</option>

            <option value="PYME">PYME</option>

            <option value="PYME B">PYME B</option> 

            <option value="CONSUMO CREDITO">CONSUMO CREDITO</option>

            <option value="CONSUMO CONTADO">CONSUMO CONTADO</option>

            <option value="Otro">Otro</option>

        </select>

    </div>

    <div class="col-md-4">

        <label>Dias Habiles Notificarse:</label>

        <select class="form-control" name="notif_dias_habiles" id="notif_dias_habiles">

            <option value="5"></option>

            <option value="5">5</option>

            <option value="10">10</option>

            <option value="15">15</option>

            <option value="20">20</option>

            <option value="25">25</option>

            <option value="30">30</option>

        </select>

    </div>

    <div class="col-md-4">

        <label>Agencia:<small>(Opcional)</small></label>

        <?

            /*$x = $con->Query("Select * from estadosx where tipo = 'agencia' and estado = '1' and valor = '".$g->GetCampot2()."'");

            $agencia = "";

            $rc = $con->FetchAssoc($x);

            $agencia = $rc['nombre'];*/

        ?>

        <input type="text" class="form-control" name="notif_oficina_productora" id="notif_oficina_productora" value="<?= $g->GetCampot2() ?>">

    </div>

</div>

<div class="row m-b-10">    

    <div class="col-md-4">

        <label>Radicado:</label>

        <input type="text" class="form-control" name="notif_radicado" id="notif_radicado" value="<?= $g->GetRadicado() ?>">

    </div>

    <div class="col-md-4">

        <label>Numero de obligacion:</label>

        <input type="text" class="form-control" name="notif_obligacion" id="notif_obligacion" value="<?= $g->GetCampot1() ?>">

    </div>

    <div class="col-md-4">

        <label>Posicion Sello Cotejo:</label>

        <select class="form-control" name="notif_posicion_cotejo" id="notif_posicion_cotejo">

            <option value="DER_INF">Derecha Inferior</option> 

            <option value="DER_SUP">Derecha Superior</option>

            <option value="IZQ_SUP">Izquierda Superior</option>

            <option value="IZQ_INF">Izquierda Inferior</option>

        </select>

    </div>

</div>

<div class="row">

    <div class="col-md-12">

        <label>Fecha Providencia:</label>

    </div>

</div>

<div class="row m-b-10">    

    <div class="col-md-3">

        <input type="date" class="form-control" placeholder="Fecha 1" name="notif_fecha_providencia" id="notif_fecha_providencia">

    </div>

    <div class="col-md-3">

        <input type="date" class="form-control" placeholder="Fecha 2" name="notif_fecha_providencia2" id="notif_fecha_providencia2">

    </div>

    <div class="col-md-3">

        <input type="date" class="form-control" placeholder="Fecha 3" name="notif_fecha_providencia3" id="notif_fecha_providencia3">

    </div>

    <div class="col-md-3">

        <input type="date" class="form-control" placeholder="Fecha 4" name="notif_fecha_providencia4" id="notif_fecha_providencia4">

    </div>

</div>

<div class="row m-b-10">

    <div class="col-md-6">

        <label>Nombre Apoderado:</label>

         <input type="text" class="form-control" name="notif_nombre_abogado" id="notif_nombre_abogado" value="">

    </div>

</div>

<div class="row m-b-10">

    <div class="col-md-12">

        <h4>Información Del Juzgado</h4>

    </div>

</div>

<?

    $x = $con->Query("Select * from meta_listas_valores where dependencia = '".$g->GetCampot4()."'");

    $direccion_juzado = "";

    $rc = $con->FetchAssoc($x);

    $direccion_juzado = $rc['valor'];

?>

<div class="row m-b-10">

    <div class="col-md-6">

        <label>Juzgado:</label>

        <input type="text" class="form-control" name="notif_juzgado" id="notif_juzgado" value="<?= $g->GetCampot4() ?> ">

    </div>

    <div class="col-md-6">

        <label>Horario Juzgado:</label>

        <select class="form-control" name="notif_horariosjuzgado" id="notif_horariosjuzgado">

            <option value=""></option>

            <option value="lunes a viernes de 8:00a.m. a 12:00p.m. ó de 1:00p.m. a 5:00p.m.">lunes a viernes de 8:00a.m. a 12:00p.m. ó de 1:00p.m. a 5:00p.m.</option>

            <option value="lunes a viernes de 8:00a.m. a 12:00p.m. ó de 1:00p.m. a 5:00p.m.">lunes a viernes de 8:00a.m. a 12:00p.m. ó de 1:00p.m. a 5:00p.m.</option>

            <option value="lunes a viernes de 8:00a.m. a 12:00p.m. ó de 2:00p.m. a 6:00p.m.">lunes a viernes de 8:00a.m. a 12:00p.m. ó de 2:00p.m. a 6:00p.m.</option>

            <option value="lunes a viernes de 7:30a.m. a 12:00p.m. ó de 2:00p.m. a 5:30p.m.">lunes a viernes de 7:30a.m. a 12:00p.m. ó de 2:00p.m. a 5:30p.m.</option>

            <option value="lunes a viernes de 7:00a.m. a 12:00p.m. ó de 1:00p.m. a 4:00p.m.">lunes a viernes de 7:00a.m. a 12:00p.m. ó de 1:00p.m. a 4:00p.m.</option>

            <option value="lunes a viernes de 8:00a.m. a 1:00p.m. ó de 2:00p.m. a 5:00p.m.">lunes a viernes de 8:00a.m. a 1:00p.m. ó de 2:00p.m. a 5:00p.m.</option>

            <option value="lunes a viernes de 8:00a.m. a 12:00p.m. ó de 2:00p.m. a 5:00p.m.">lunes a viernes de 8:00a.m. a 12:00p.m. ó de 2:00p.m. a 5:00p.m.</option>

            <option value="lunes a viernes de 8:00a.m. a 04:00p.m.  jornada continua">lunes a viernes de 8:00a.m. a 04:00p.m.  jornada continua</option>

            <option value="lunes a viernes de 7:00a.m. a 12:00p.m. ó de 2:00p.m. a 5:00p.m.">lunes a viernes de 7:00a.m. a 12:00p.m. ó de 2:00p.m. a 5:00p.m.</option>

            <option value="lunes a viernes de 7:30a.m. a 12:00p.m. ó de 1:30p.m. a 5:00p.m.">lunes a viernes de 7:30a.m. a 12:00p.m. ó de 1:30p.m. a 5:00p.m.</option> 

            <option value="lunes a viernes de 7.00a.m. a 3:00p.m. jornada continua">lunes a viernes de 7.00a.m. a 3:00p.m. jornada continua</option>    

        </select>

    </div>

</div>

<?
    $x = $con->Query("Select * from meta_listas_valores where titulo  = '".$g->GetCampot5()."'");
    $ciudad_juzado = "";
    $rc = $con->FetchAssoc($x);
    $ciudad_juzado = $rc['valor'];
?>

<div class="row m-b-10">

    <div class="col-md-6">

        <label>Ciudad Juzgado:</label>

         <select class="form-control" id="notif_ciudad_juzgado" name="notif_ciudad_juzgado" "">

            <option value="">Selecciona una Opcion</option>

            <?php

                 $x = $con->Query("SELECT concat(t.titulo,' - ', m.titulo) as ciudad, t.valor FROM `meta_listas_valores` m inner join (SELECT titulo,valor,dependencia FROM `meta_listas_valores` where id_lista = '27')as t on m.valor=t.dependencia where id_lista = '26' order by t.titulo,m.titulo");

                 while ($rowb = $con->FetchAssoc($x)) {

                    echo "<option value='".$rowb['valor']."' $checkedcheck>".$rowb['ciudad']."</option>";

                 }

                ?>

        </select>
        <script type="text/javascript">
            $('#notif_ciudad_juzgado').val('<?= $ciudad_juzado; ?>');
        </script>

    </div>

    <div class="col-md-6">

        <label>Direccion Juzgado:</label>

        <input type="text" class="form-control" name="notif_direccion_juzgado" id="notif_direccion_juzgado" value="<?= $direccion_juzado; ?>">

    </div>

</div>

<div class="row m-b-10">    

    <div class="col-md-12">

        <h4>Información Del Demandante</h4>

    </div>

</div>

<div class="row m-b-10">

<?

    $dpa = $con->Query("select id from suscriptores_tipos where nombre = 'DEMANDANTE'");

    $val = $con->FetchAssoc($dpa);

    $type = $val['id'];



    $gets = $con->Query("select sc.id from suscriptores_contactos as sc inner join gestion_suscriptores as gs on gs.id_suscriptor = sc.id where sc.type = '$type' and gs.id_gestion = '".$g->GetId()."' ");

    $dat = $con->FetchAssoc($gets);



    $sus = new MSuscriptores_contactos;

    $sus->CreateSuscriptores_contactos("id", $dat['id']);



    $sdata = new MSuscriptores_contactos_direccion;

    $sdata->CreateSuscriptores_contactos_direccion("id_contacto", $dat['id']);



?>

    <div class="col-md-4">

        <label>Demandante:</label>

        <input type="text" class="form-control" name="notif_demandante" id="notif_demandante" value="<?= $sus->GetNombre() ?>">

    </div>

    <div class="col-md-4">    

        <label>Direccion Demandante:</label>

        <input type="text" class="form-control" name="notif_direccion_r" id="notif_direccion_r" value="<?= $sdata->GetDireccion() ?>">

    </div>

    <div class="col-md-4">

        <label>Telefono Demandante</label>

        <input type="text" class="form-control" name="notif_telefono_c" id="notif_telefono_c" value="<?= $sdata->GetTelefonos() ?>">

    </div>

</div>

<div class="row m-b-10">

    <div class="col-md-12">

        <h4>Información Del Demandado / Notificado</h4>

    </div>

</div>

<div class="row m-b-10">    

    <div class="col-md-4">

        <label>Cedula Demandado:<small>(Opcional)</small></label>

        <input type="text" class="form-control" name="notif_cedula_demandado" id="notif_cedula_demandado">

    </div>

    <div class="col-md-4">

        <label>Demandado:</label>

        <input type="text" class="form-control" name="notif_demandado" id="notif_demandado">

    </div>

    <div class="col-md-4">

        <label>Notificado:</label>

        <input type="text" class="form-control" name="notif_nombre" id="notif_nombre">

    </div>

</div>

<div class="row m-b-10">

    <div class="col-md-4">

        <label>Departamento:</label>

        <?

            $lista = new MMeta_Listas_valores;

            $ql = $lista->ListarMeta_listas_valores("where id_lista = '26'");

        ?>

        <select class="form-control" id="notif_departamento" name="notif_departamento"  onchange="SetRefMMetaListasValoresOption('notif_ciudad',27,this.value)">

            <option value="">Selecciona una Opcion</option>

            <?

                $options = "";

                while ($rowb = $con->FetchAssoc($ql)) {

                    $checkedcheck = "";

                    echo "<option value='".$rowb['valor']."' $checkedcheck>".$rowb['titulo']."</option>";

                }

            ?>

        </select>

    </div>

    <div class="col-md-4">

        <label>Ciudad:</label>

        <select class="form-control" id="notif_ciudad" name="notif_ciudad">

            <option value="">Selecciona una Opcion</option>

        </select>

    </div>

    <div class="col-md-4">

        <label>Direccion:</label>

        <input type="text" class="form-control" name="notif_direccion" id="notif_direccion">

    </div>

</div>

<div class="row m-b-10">

    <div class="col-md-4">

        <label>Email Demandado:</label>

        <input type="text" class="form-control" name="notif_emaildemandado" id="notif_emaildemandado">

    </div>

</div>