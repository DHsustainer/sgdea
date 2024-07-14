<?
$_SESSION['id_trd_empresa'] = $_SESSION['active_vista'];

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
<form id='formgestion' method='POST' action="/informes/getpqr/" target="_blank"> 
    <div class="row">
        <div class="col-md-4">
            <select  placeholder="departamento"  name="departamento" id="departamento" onchange='dependencia_ciudadinExistence("departamento","ciudad")' class='form-control ' disabled="disabled">
                <option value="V">Seleccione un Departamento (Todos)</option>
            </select>
        </div>
        <div class="col-md-4">
            <select  placeholder="ciudad"  name="ciudad" id="ciudad" class='form-control  disabled' disabled="disabled">
                <option value="V">Seleccione una Ciudad (Todos)</option>
            </select>
        </div>
        <div class="col-md-4">
            <select placeholder="Oficina"  name="oficina" id="oficina" class='form-control disabled' disabled="disabled">
                <option value="Seleccione una Oficina">Seleccione una Oficina (Todos)</option>
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
                <option value="V">Seleccione un Usuario de Destino (Todos)</option>
            </select>
        </div>
        <div class="col-md-4">   
            <select   name="rweb" id="rweb" class='form-control '>
                <option value="V">Origen de Registros</option>
                <option value="0">Registrados desde la Ventanilla</option>
                <option value="1">Registrados Desde la Web</option>

            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="titulo" style="margin-top:15px; margin-bottom: 10px;">Seriales Documentales y Estado del Expediente</div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <select  placeholder="Serie Documental"  class="form-control disabled" id="id_dependencia_raiz" name="id_dependencia_raiz" onchange="dependencia_item2('dependencia_destino', 'id_dependencia_raiz','tipo_documento', '/areas_dependencias/GetSubSeriesArea/')" disabled="disabled">
                <option value="V">Seleccione una Serie (Todos)</option>
            </select>
        </div>
        <div class="col-md-3">
            <select  placeholder="Sub Serie Documental"  class="form-control disabled" id="tipo_documento" name="tipo_documento" disabled="disabled">
                <option value="V">Seleccione una Sub-Serie (Todos)</option>
            </select>
        </div>
        <div class="col-md-3" style="display: none">
            <select  placeholder='prioridad'  name='prioridad' id='prioridad' class='form-control ' >
                <option value="V">Seleccione la prioridad de la solicitud</option>
            </select>
        </div>
        <div class="col-md-3" style="display: none">
            <select  name='estado_solicitud' id='estado_solicitud' class='form-control ' >
                <option value="V">Estado de la solicitud</option>
                <?
                    $estados_gestion = new MEstados_gestion;
                    // DE NO RECIBIR PARAMETROS ESTA FUNCION TRAE EL LISTADO COMPLETO DE LIBROS
                    $query_eg = $estados_gestion->ListarEstados_gestion();      
                    while($row_estados = $con->FetchAssoc($query_eg)){
                        $estado_gestion = new MEstados_gestion;
                        $estado_gestion->Createestados_gestion('id', $row_estados[id]);
                        echo "<option value='".$estado_gestion->GetId()."'>".$estado_gestion->GetNombre()."</option>";
                    }
                ?>
            </select>
        </div>
        <div class="col-md-3">
            <select  name="estado_respuesta" id="estado_respuesta" class='form-control '>
                <option value="V">Estado de la Solicitud</option>
                <option value="Abierto">Abierto</option>
                <option value="Cerrado">Cerrado</option>
                <option value="Pendiente">Pendiente</option>
                
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="titulo" style="margin-top:15px; margin-bottom: 10px;">Fechas de Consulta</div>
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

