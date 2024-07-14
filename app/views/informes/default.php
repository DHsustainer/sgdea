<?
$u = new MUsuarios;
$u->CreateUsuarios("user_id", $_SESSION['usuario']);

?>
<form id='formgestion' method='POST' action="/informes/resultadoinforme/" target="_blank"> 
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
    <div class="row m-t-30">
        <div class="col-md-12">
            <h4>Seriales Documentales y Estado del Expediente</h5>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <select  placeholder="Serie Documental" class="form-control disabled" id="id_dependencia_raiz" name="id_dependencia_raiz" onchange="dependencia_item2('dependencia_destino', 'id_dependencia_raiz','tipo_documento', '/areas_dependencias/GetSubSeriesArea/')" disabled="disabled">
                <option value="V">Seleccione una Serie (Todos)</option>
            </select>
        </div>
        <div class="col-md-3">
            <select  placeholder="Sub Serie Documental" class="form-control disabled" id="tipo_documento" name="tipo_documento" disabled="disabled">
                <option value="V">Seleccione una Sub-Serie (Todos)</option>
            </select>
        </div>
        <div class="col-md-3" style="display: none">
            <select  placeholder='prioridad' name='prioridad' id='prioridad' class='form-control' >
                <option value="V">Seleccione la prioridad de la solicitud</option>
            </select>
        </div>
        <div class="col-md-3">
            <select name="estado_respuesta" id="estado_respuesta" class='form-control'>
                <option value="V">Estado de la Solicitud</option>
                <option value="Abierto">Abierto</option>
                <option value="Cerrado">Cerrado</option>
                <option value="Pendiente">Pendiente</option>
                
            </select>
        </div>
        <div class="col-md-3">
            <select name='estado_solicitud' id='estado_solicitud' class='form-control' >
                <option value="V">Estado de la solicitud</option>
            </select>
        </div>

    </div>
    <div class="row m-t-30">
        <div class="col-md-12">
            <h4><?= INFORMACION_SUSCRIPTOR ?></h4>
        </div>
    </div>
    <div class="row">
        <div class="col-md-9">
            <div class="form-group">
                <input type="text" id="dtform" name="dtform" placeholder='Nombre o <?= SUSCRIPTORCAMPOIDENTIFICACION; ?> del <?= SUSCRIPTORCAMPONOMBRE; ?>' class='form-control important'  <?= $c->Ayuda('35', 'tog') ?>>
                <div id='bloquebusqueda'></div>           
                <input type="hidden"  name="suscriptor_id" id="suscriptor_id" value="N">
            </div>
        </div>
        
    </div>
    <div class="row m-t-30">
        <div class="col-md-12">
            <h4>Fechas de Consulta</h5>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <input  class="form-control important" type='date' name='f_inicio' id='f_inicio' placeholder="Fecha de Inicio:" maxlength=''/>
        </div>
        <div class="col-md-4">
              <input  class="form-control important" type='date' name='f_corte' id='f_corte' placeholder="Fecha de Corte:" maxlength='' />
        </div>
    </div>
    <div class="row m-t-30">
        <div class="col-md-12">
            <h4>Seleccione las columnas que desea ver en el informe</h5>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div style="float:left">
                <input id="checkAll4" onclick="checkTodos(this.id,'tipos_campos');" name="checkAll" type="checkbox" />
                <label for="checkAll4"><strong>Seleccionar / Deseleccionar Todos los campos</strong></label>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12" id="tipos_campos">
            <label style="margin-right: 15px; margin-bottom: 10px">
                <input type="checkbox" name="campos[]" value="coltitulo" id="coltitulo">
                Asunto
            </label>
            <label style="margin-right: 15px; margin-bottom: 10px">
                <input type="checkbox" name="campos[]" value="colrade" id="colrade">
                <?= CAMPORADEXTERNO ?>
            </label>
            <label style="margin-right: 15px; margin-bottom: 10px">
                <input type="checkbox" name="campos[]" value="colradmin" id="colradmin">
                <?= CAMPORADRAPIDO ?>
            </label>
            <label style="margin-right: 15px; margin-bottom: 10px">
                <input type="checkbox" name="campos[]" value="colfullrad" id="colfullrad">
                <?= CAMPOIDRAD ?>
            </label>
            <label style="margin-right: 15px; margin-bottom: 10px">
                <input type="checkbox" name="campos[]" value="colfreg" id="colfreg">
                Fecha de Registro
            </label>
            <label style="margin-right: 15px; margin-bottom: 10px">
                <input type="checkbox" name="campos[]" value="colfrec" id="colfrec">
                Fecha de Recibido
            </label>
            <label style="margin-right: 15px; margin-bottom: 10px">
                <input type="checkbox" name="campos[]" value="colciudad" id="colciudad">
                Ciudad
            </label>
            <label style="margin-right: 15px; margin-bottom: 10px">
                <input type="checkbox" name="campos[]" value="coloficina" id="coloficina">
                Oficina
            </label>
            <label style="margin-right: 15px; margin-bottom: 10px">
                <input type="checkbox" name="campos[]" value="colarea" id="colarea">
                <?= CAMPOAREADETRABAJO; ?>
            </label>
            <label style="margin-right: 15px; margin-bottom: 10px">
                <input type="checkbox" name="campos[]" value="colresponsable" id="colresponsable">
                Usuario Responsable
            </label>
            <label style="margin-right: 15px; margin-bottom: 10px">
                <input type="checkbox" name="campos[]" value="colserie" id="colserie">
                Serie Documental
            </label>
            <label style="margin-right: 15px; margin-bottom: 10px">
                <input type="checkbox" name="campos[]" value="colsubserie" id="colsubserie">
                Sub-Serie documental
            </label>
            <label style="margin-right: 15px; margin-bottom: 10px">
                <input type="checkbox" name="campos[]" value="colnombreradica" id="colnombreradica">
                Nombre de Quien Radica
            </label>
            <label style="margin-right: 15px; margin-bottom: 10px">
                <input type="checkbox" name="campos[]" value="colsuscriptor" id="colsuscriptor">
                Suscriptor
            </label>
            <label style="margin-right: 15px; margin-bottom: 10px">
                <input type="checkbox" name="campos[]" value="colfolios" id="colfolios">
                # Folios
            </label>
            <label style="margin-right: 15px; margin-bottom: 10px">
                <input type="checkbox" name="campos[]" value="colfvencimiento" id="colfvencimiento">
                Fecha de Vencimiento
            </label>
            <label style="margin-right: 15px; margin-bottom: 10px">
                <input type="checkbox" name="campos[]" value="colrespuesta" id="colrespuesta">
                Estado de Respuesta
            </label>
            <label style="margin-right: 15px; margin-bottom: 10px">
                <input type="checkbox" name="campos[]" value="colfrespuesta" id="colfrespuesta">
                Fecha de Respuesta
            </label>
            <label style="margin-right: 15px; margin-bottom: 10px">
                <input type="checkbox" name="campos[]" value="colestado" id="colestado">
                Estado del Expediente
            </label>
            <label style="margin-right: 15px; margin-bottom: 10px">
                <input type="checkbox" name="campos[]" value="colrobservacion" id="colrobservacion">
                Observacion
            </label>
            <label style="margin-right: 15px; margin-bottom: 10px">
                <input type="checkbox" name="campos[]" value="coluregistra" id="coluregistra">
                Usuario Que Registra
            </label>
            <label style="margin-right: 15px; margin-bottom: 10px">
                <input type="checkbox" name="campos[]" value="colubicacion" id="colubicacion">
                Ubicación
            </label>

        <?php if (CAMPOT1 != ""): ?>
            <label style="margin-right: 15px; margin-bottom: 10px">
                <input type="checkbox" name="campos[]" value="<?= CAMPOT1 ?>" id="<?= CAMPOT1 ?>">
                <?= CAMPOT1 ?>
            </label>
        <?php endif ?>
        <?php if (CAMPOT2 != ""): ?>
            <label style="margin-right: 15px; margin-bottom: 10px">
                <input type="checkbox" name="campos[]" value="<?= CAMPOT2 ?>" id="<?= CAMPOT2 ?>">
                <?= CAMPOT2 ?>
            </label>
        <?php endif ?>
        <?php if (CAMPOT3 != ""): ?>
            <label style="margin-right: 15px; margin-bottom: 10px">
                <input type="checkbox" name="campos[]" value="<?= CAMPOT3 ?>" id="<?= CAMPOT3 ?>">
                <?= CAMPOT3 ?>
            </label>
        <?php endif ?>
        <?php if (CAMPOT4 != ""): ?>
            <label style="margin-right: 15px; margin-bottom: 10px">
                <input type="checkbox" name="campos[]" value="<?= CAMPOT4 ?>" id="<?= CAMPOT4 ?>">
                <?= CAMPOT4 ?>
            </label>
        <?php endif ?>
        <?php if (CAMPOT5 != ""): ?>
            <label style="margin-right: 15px; margin-bottom: 10px">
                <input type="checkbox" name="campos[]" value="<?= CAMPOT5 ?>" id="<?= CAMPOT5 ?>">
                <?= CAMPOT5 ?>
            </label>
        <?php endif ?>
        <?php if (CAMPOT6 != ""): ?>
            <label style="margin-right: 15px; margin-bottom: 10px">
                <input type="checkbox" name="campos[]" value="<?= CAMPOT6 ?>" id="<?= CAMPOT6 ?>">
                <?= CAMPOT6 ?>
            </label>
        <?php endif ?>
        <?php if (CAMPOT7 != ""): ?>
            <label style="margin-right: 15px; margin-bottom: 10px">
                <input type="checkbox" name="campos[]" value="<?= CAMPOT7 ?>" id="<?= CAMPOT7 ?>">
                <?= CAMPOT7 ?>
            </label>
        <?php endif ?>
        <?php if (CAMPOT8 != ""): ?>
            <label style="margin-right: 15px; margin-bottom: 10px">
                <input type="checkbox" name="campos[]" value="<?= CAMPOT8 ?>" id="<?= CAMPOT8 ?>">
                <?= CAMPOT8 ?>
            </label>
        <?php endif ?>
        <?php if (CAMPOT9 != ""): ?>
            <label style="margin-right: 15px; margin-bottom: 10px">
                <input type="checkbox" name="campos[]" value="<?= CAMPOT9 ?>" id="<?= CAMPOT9 ?>">
                <?= CAMPOT9 ?>
            </label>
        <?php endif ?>
        <?php if (CAMPOT10 != ""): ?>
            <label style="margin-right: 15px; margin-bottom: 10px">
                <input type="checkbox" name="campos[]" value="<?= CAMPOT10 ?>" id="<?= CAMPOT10 ?>">
                <?= CAMPOT10 ?>
            </label>
        <?php endif ?>
        <?php if (CAMPOT11 != ""): ?>
            <label style="margin-right: 15px; margin-bottom: 10px">
                <input type="checkbox" name="campos[]" value="<?= CAMPOT11 ?>" id="<?= CAMPOT11 ?>">
                <?= CAMPOT11 ?>
            </label>
        <?php endif ?>
        <?php if (CAMPOT12 != ""): ?>
            <label style="margin-right: 15px; margin-bottom: 10px">
                <input type="checkbox" name="campos[]" value="<?= CAMPOT12 ?>" id="<?= CAMPOT12 ?>">
                <?= CAMPOT12 ?>
            </label>
        <?php endif ?>
        <?php if (CAMPOT13 != ""): ?>
            <label style="margin-right: 15px; margin-bottom: 10px">
                <input type="checkbox" name="campos[]" value="<?= CAMPOT13 ?>" id="<?= CAMPOT13 ?>">
                <?= CAMPOT13 ?>
            </label>
        <?php endif ?>
        <?php if (CAMPOT14 != ""): ?>
            <label style="margin-right: 15px; margin-bottom: 10px">
                <input type="checkbox" name="campos[]" value="<?= CAMPOT14 ?>" id="<?= CAMPOT14 ?>">
                <?= CAMPOT14 ?>
            </label>
        <?php endif ?>
        <?php if (CAMPOT15 != ""): ?>
            <label style="margin-right: 15px; margin-bottom: 10px">
                <input type="checkbox" name="campos[]" value="<?= CAMPOT15 ?>" id="<?= CAMPOT15 ?>">
                <?= CAMPOT15 ?>
            </label>
        <?php endif ?>
    
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
    $(document).ready(function() {
    });
        dependencia_estadoinExistence('departamento');
        $("#departamento").change(function(){
            dependencia_ciudadinExistence("departamento","ciudad");
        });
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

        $("#tipo_documento").change(function(){
            dependencia_item("tipo_documento","estado_solicitud", "/dependencias/estadosdependencias/");
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
