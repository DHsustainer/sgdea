<form id='formgestion' method='POST' action="/informes/GetDocumentos/" target="_blank"> 
    <div class="row">
        <div class="col-md-12">
            <h4>Ubicacion de los expedientes</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <select  placeholder="departamento" name="departamento" id="departamento" class='input1_0 form-control disabled' disabled="disabled">
                <option value="V">Seleccione un Departamento (Todos)</option>
            </select>
        </div>
        <div class="col-md-4">
            <select  placeholder="ciudad" name="ciudad" id="ciudad" class='input1_0 form-control important disabled' disabled="disabled">
                <option value="V">Seleccione una Ciudad (Todos)</option>
            </select>
        </div>
        <div class="col-md-4">
            <select placeholder="Oficina" name="oficina" id="oficina" class='input1_0 form-control disabled' disabled="disabled">
                <option value="Seleccione una Oficina">Seleccione una Oficina (Todos)</option>
            </select>
        </div>
    </div>
    <div class="row m-t-10">
        <div class="col-md-4">
            <select placeholder="<?= CAMPOAREADETRABAJO; ?>" name="dependencia_destino" id="dependencia_destino" class='input1_0 form-control disabled' disabled="disabled"  onchange="dependencia_item('dependencia_destino','id_dependencia_raiz','/areas_dependencias/GetSeriesArea/')" >
                <option value="V">Seleccione un <?= CAMPOAREADETRABAJO; ?> (Todos)</option>
            </select>
        </div>
        <div class="col-md-4">   
            <select  placeholder="Usuario Destino" style=" height:35px; display:none" disabled="disabled" name="nombre_destino" id="nombre_destino" class='input1_0 form-control disabled'>
                <option value="V">Seleccione un Usuario de Destino (Todos)</option>
            </select>
        </div>
        <div class="col-md-4">
            <select name="estado_respuesta" id="estado_respuesta" class='input1_0 form-control'>
                <option value="V">Estado de la Solicitud</option>
                <option value="Abierto">Abierto</option>
                <option value="Cerrado">Cerrado</option>
                <option value="Pendiente">Pendiente</option>
                
            </select>
        </div>
    </div>
    <div class="row m-t-30">
        <div class="col-md-12">
            <h4>Seriales Documentales</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <select  placeholder="Serie Documental" class="form-control disabled" id="id_dependencia_raiz" name="id_dependencia_raiz" onchange="dependencia_item2('dependencia_destino', 'id_dependencia_raiz','tipo_documento', '/areas_dependencias/GetSubSeriesArea/')" disabled="disabled">
                <option value="V">Seleccione una Serie (Todos)</option>
            </select>
        </div>
        <div class="col-md-3">
            <select  placeholder="Sub Serie Documental" class="form-control disabled" id="tipo_documento" name="tipo_documento" disabled="disabled" onchange="dependencia_item('tipo_documento','tipologia','/dependencias_tipologias/GetListadoTipologias/'); dependencia_item('tipo_documento','formulario','/gestion/getlistadoformularios/')">
                <option value="V">Seleccione una Sub-Serie (Todos)</option>
            </select>
        </div>
        <div class="col-md-3">
            <select  placeholder="Tipo Documental" class="form-control disabled" id="tipologia" name="tipologia" disabled="disabled">
                <option value="V">Seleccione un Tipo Documental</option>
            </select>
        </div>
    </div>
    <div class="row m-t-30">
        <div class="col-md-12">
            <h4>Fechas de Consulta</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <select  placeholder="Tipo Tener en cuenta la fecha de" class="form-control disabled" id="tenerencuenta" name="tenerencuenta">
                <option value="expediente">Fecha del Expediente</option>
                <option value="documento">Fecha del Documento</option>
            </select>
        </div>
        <div class="col-md-4">
            <input class="form-control  important" type='date' name='f_inicio' id='f_inicio' placeholder="Fecha de Inicio:" maxlength=''/>
        </div>
        <div class="col-md-4">
              <input class="form-control  important" type='date' name='f_corte' id='f_corte' placeholder="Fecha de Corte:" maxlength='' />
        </div>
    </div>    
    <div class="row m-t-20">        
        <div class="col-md-4">
            <input type='submit' class="btn btn-primary" value='Generar Informe'/>
        </div>
    </div>
</form>


<script>
    $(document).ready(function() {
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
        $('.datepicker').datepicker({
            dateFormat: 'yy-mm-dd',
            monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio', 'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
            dayNames: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'], // For formatting
            dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'], // For formatting
            dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa'] // Column headings for days starting at Sunday                
        });

    });
</script>