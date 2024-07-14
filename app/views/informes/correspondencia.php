<?
$_SESSION['id_trd_empresa'] = $_SESSION['active_vista'];

$u = new MUsuarios;
$u->CreateUsuarios("user_id", $_SESSION['usuario']);
$path = '<div class="row m-b-30">

            <div class="col-md-3 p-t-10" style="margin: 0px;">
                <b>Versión de la tabla</b>
            </div>

            <div class="col-md-8 " style="text-align: left">
                <select name="version_active" id="version_active" '.$c->Ayuda("71", 'tog').' onchange="ChangeVersionConsulta();" class="form-control">';
            
            $q_strx = "SELECT id_version from super_admin WHERE id='6'";
            $queryx = $con->Query($q_strx);
            $idv = $con->Result($queryx, 0, "id_version");
            $nv = $c->GetDataFromTable("dependencias_version", "id", $idv, "nombre", "");
            $path .= '<option value="'.$idv.'">'.$nv.' (Activa en la Empresa)</option>';

            $qvs = $con->Query("select version from gestion where version != '".$idv."' group by version");
            $i = 0;
            while ($row = $con->FetchAssoc($qvs)) {
                $i++;
                $nver = $c->GetDataFromTable("dependencias_version", "id", $row['version'], "nombre", "");
                $active = "";

                if ($_SESSION['active_vista'] == $row['version']) {
                    $active = "selected = 'selected'";
                }
                $path .= "<option value='".$row['version']."' $active>$nver</option>";
            }

$path .= '      </select>
            </div>
        </div>';

    if ($i > 0) {
        echo $path;
    }
?>
<form id='formgestion' method='POST' action="/informes/getcorrespondencia/" target="_blank"> 
    <?php if ($_SESSION['buscador_global'] == "1"): ?>

    <div class="row m-t-20">
        <div class="col-md-12">
            <h4>Ubicación de los Expedientes</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <select  placeholder="departamento"  name="departamento" id="departamento" onchange='dependencia_ciudadinExistence("departamento","ciudad")' class='form-control ' disabled="disabled">
                <option value="V">Seleccione <?= DEPARTAMENTO ?> (Todos)</option>
            </select>
        </div>
        <div class="col-md-4">
            <select  placeholder="ciudad"  name="ciudad" id="ciudad" class='form-control  disabled' disabled="disabled">
                <option value="V">Seleccione <?= CIUDAD ?> (Todos)</option>
            </select>
        </div>
        <div class="col-md-4">
            <select placeholder="Oficina"  name="oficina" id="oficina" class='form-control disabled' disabled="disabled">
                <option value="Seleccione una Oficina">Seleccione <?= OFICINA ?> (Todos)</option>
            </select>
        </div>
    </div>
    <div class="row m-t-20">
        <div class="col-md-4">
            <select placeholder="<?= CAMPOAREADETRABAJO; ?>"  name="dependencia_destino" id="dependencia_destino" class='form-control disabled' disabled="disabled"  onchange="dependencia_item('dependencia_destino','id_dependencia_raiz','/areas_dependencias/GetSeriesArea/')" >
                <option value="V">Seleccione un <?= CAMPOAREADETRABAJO; ?> (Todos)</option>
            </select>
        </div>
        <div class="col-md-4">   
            <select  placeholder="Usuario Destino"  disabled="disabled" name="nombre_destino" id="nombre_destino" class='form-control disabled'>
                <option value="V">Seleccione <?= RESPONSABLE ?> (Todos)</option>
            </select>
        </div>
        <div class="col-md-4">   
            <select   name="rweb" id="rweb" class='form-control dn '>
                <option value="V">Origen de Registros</option>
                <option value="0">Registrados desde la Ventanilla</option>
                <option value="1">Registrados Desde la Web</option>

            </select>
        </div>
    </div>
    <?php else: ?>
        <?
            $city = $con->Query("Select id_tabla from  usuarios_configurar_accesos where user_id = '".$_SESSION['usuario']."' and tabla = 'city'");
            $d = $con->FetchAssoc($city);
            $city = $d['id_tabla'];
        ?>
        <div class="row m-t-30 dn">
            <div class="col-md-6">
                <label for="ciudad"><?= CIUDAD ?>:</label>
                <input  class="form-control" type='text' name="ciudad" id="ciudad" value="<?= $city ?>" />
            </div>
            <div class="col-md-6">
                <label for="oficina"><?= OFICINA ?>:</label>
                <input  class="form-control" type='text' name="oficina" id="oficina" value="<?= $u->GetSeccional() ?>" />
            </div>
            <div class="col-md-6">
                <label for="dependencia_destino"><?= CAMPOAREADETRABAJO; ?></label>
                <input  class="form-control" type='text' name="dependencia_destino" id="dependencia_destino" value="<?= $u->GetRegimen() ?>" />
            </div>
            <div class="col-md-6">
                <label for="nombre_destino"><?= RESPONSABLE ?></label>
                <input  class="form-control" type='text' name="nombre_destino" id="nombre_destino" value="<?= $u->GetA_i() ?>" />
            </div>
        </div>
    <?php endif ?>
    <div class="row m-t-20">
        <div class="col-md-7">
            <h4>Seriales Documentales y Estado del Expediente</h4>
        </div>
        <div class="col-md-4">
            <h4>Estados de la Correspondencia</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <select  placeholder="Serie Documental"  class="form-control disabled" id="id_dependencia_raiz" name="id_dependencia_raiz" onchange="dependencia_item2('dependencia_destino', 'id_dependencia_raiz','tipo_documento', '/areas_dependencias/GetSubSeriesArea/')" disabled="disabled">
                <option value="V">Seleccione <?= SERIE ?> (Todos)</option>
            </select>
        </div>
        <div class="col-md-3">
            <select  placeholder="Sub Serie Documental"  class="form-control disabled" id="tipo_documento" name="tipo_documento" disabled="disabled">
                <option value="V">Seleccione <?= SUB_SERIE ?> (Todos)</option>
            </select>
        </div>
        <div class="col-md-1">
        </div>
        <div class="col-md-4">
            <select  placeholder="Sub Serie Documental"  class="form-control" id="estadoc" name="estadoc">
                <option value="V">Seleccione El Estado de la Correspondencia (Todos)</option>
                <!--<option value="0">Pendiente Por Validar</option>
                <option value="-1">Servicios Anulados por Usuarios</option>
                <option value="1">Servicio Validado Pendiente a Entrega</option>-->
                <option value="2">Entregas Efectivas</option>
                <option value="3">Devoluciones</option>
            </select>
        </div>
        <div class="col-md-3" style="display: none">
            <select  placeholder='prioridad'  name='prioridad' id='prioridad' class='form-control ' >
                <option value="V">Seleccione la prioridad de la solicitud</option>
            </select>
        </div>
        <div class="col-md-3" style="display: none">
            <select  name='estado_solicitud' id='estado_solicitud' class='form-control dn ' >
                <option value="V">Estado de la solicitud</option>
            </select>
        </div>
        <div class="col-md-3">
            <select  name="estado_respuesta" id="estado_respuesta" class='form-control dn '>
                <option value="V">Estado de la Solicitud</option>
            </select>
        </div>
    </div>
    <div class="row m-t-20">
        <div class="col-md-12">
            <h4><?= INFORMACION_SUSCRIPTOR ?></h4>
        </div>
    </div>
    <div class="row">
        <div class="col-md-9">
            <div class="form-group">
                <input type="text" id="dtform" name="dtform" placeholder='Nombre o <?= SUSCRIPTORCAMPOIDENTIFICACION; ?> del <?= SUSCRIPTORCAMPONOMBRE; ?>' class='form-control important'  <?= $c->Ayuda('35', 'tog') ?>>
                <div id='bloquebusqueda'></div>           
                <input type="hidden"  name="suscriptor_id" id="suscriptor_id" value="">
            </div>
        </div>
        
    </div>
    <div class="row m-t-20">
        <div class="col-md-12">
            <h4>Fechas de Consulta</h4>
        </div>
    </div>
    <div class="row m-b-20">
        <div class="col-md-4">
            <input  class="form-control important" type='date' name='f_inicio' id='f_inicio' placeholder="Fecha de Inicio:" maxlength=''/>
        </div>
        <div class="col-md-4">
            <input class="form-control important" type='date' name='f_corte' id='f_corte' placeholder="Fecha de Corte:" maxlength='' />
        </div>
    </div>    
    <div class="row">        
        <div class="col-md-4">
            <input type='submit' class="btn btn-primary" value='Generar Informe'/>
        </div>
    </div>
</form>
<script>    
    $(document).ready(function() {
        dependencia_item('dependencia_destino','id_dependencia_raiz','/areas_dependencias/GetSeriesArea/');
            setTimeout(function(){
                if($("#id_dependencia_raiz").val() != "" && $("#id_dependencia_raiz").val()  != "Seleccione una Serie"){
                    $("#id_dependencia_raiz").change();
                }
            }, 1000);
        $("#id_dependencia_raiz").change(function(){
            dependencia_item2('dependencia_destino', 'id_dependencia_raiz','tipo_documento', '/areas_dependencias/GetSubSeriesArea/');
            setTimeout(function(){
                if($("#tipo_documento").val() != "" && $("#tipo_documento").val()  != "Seleccione una Sub-Serie"){
                    $("#tipo_documento").change();
                }
            }, 1000);
        });
    });
</script>

<script>
    dependencia_estadoinExistence('departamento');
    $("#ciudad").change(function(){
        dependencia_item("ciudad","oficina", "/seccional/listadooficinasseccional");
        setTimeout(function(){
            if($("#oficina").val() != "" && $("#oficina").val()  != "Seleccione una Oficina"){
                $("#oficina").change();
            }
        }, 1000);
    });
        $("#oficina").change(function(){
            dependencia_item("oficina","dependencia_destino", "/usuarios/ListadoAreasOficinaNew");
        });
        $("#dependencia_destino").change(function(){
            dependencia_item("dependencia_destino","nombre_destino", "/usuarios/ListadoUsuariosAreasOficina3New/"+$("#oficina").val());
        });
    $(document).ready(function() {
    });
</script>
<script>
    $("#dtform").on("keyup", function(){
        $("#bloquebusqueda").fadeIn();              
        $.ajax({
            type: "POST",
            url: '/suscriptores_contactos/buscar/'+$(this).val()+"/1/",
            success: function(msg){
                result = msg;
                $("#bloquebusqueda").html(result);                  
            }
        });             
    });
    function onTecla(e){    
        var num = e?e.keyCode:event.keyCode;
        if (num == 9 || num == 27){
            $("#bloquebusqueda").fadeOut();     
        }
    }
    document.onkeydown = onTecla;
    if(document.all){
        document.captureEvents(Event.KEYDOWN);  
    }

    function AddSuscriptor(id, nombre){

        $("#suscriptor_id").val(id);
        $("#dtform").val(nombre);
        $("#bloquebusqueda").fadeOut();     
    }
    function Hideform(){
        $("#bloquebusqueda").fadeOut();
        $("#id_suscriptor").val("");
        $("#datasuscriptor").html("");                  
    }
</script>

