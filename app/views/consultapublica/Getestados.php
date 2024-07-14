<?
    global $c;
    $valor = $c->sql_quote($_REQUEST['id']);

    if ($valor == "" || $valor == "*") {
        $valor = "";
    }
?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
<script>
$( function() {
    // An array of dates
    var eventDates = {};
    <?
        global $con;
        $path = "";
        if ($valor != "") {
            $path = " and tipoalerta = '$valor'";
        }
        $s1 = "select fecha from events_gestion where es_publico = '1' $path group by fecha";	
		$query = $con->Query($s1);
		while($row = $con->FetchAssoc($query)){
		    $originalDate = $row['fecha'];
		    $newDate = date("m/d/Y", strtotime($originalDate));
		    echo "eventDates[ new Date( '".$newDate."' )] = new Date( '".$newDate."' );";
		    //echo "eventDates[ new Date( '".$row['fecha']."' )] = new Date( '".$row['fecha']."' );";
		}
    ?>
    
    
    // datepicker
    $.datepicker.regional['es'] = {clearText: 'Borrar', clearStatus: '',
    closeText: 'Cerrar', closeStatus: 'Cerrar sin modificar',
    prevText: '<Prev', prevStatus: 'Ver mes anterior',
    nextText: 'Sig>', nextStatus: 'Ver mes siguiente',
    currentText: 'Actual', currentStatus: 'Ver mes actual',
    monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
    'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
    monthNamesShort: ['Ene','Frb','Mar','Abr','May','Jun',
    'Jul','Ago','Sep','Oct','Nov','Dic'],
    monthStatus: 'Ver otro mes', yearStatus: 'ver otro año',
    weekHeader: 'fs', weekStatus: '',
    dayNames: ['Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado'],
    dayNamesShort: ['Dom','Lun','Mar','Mie','Jue','Vie','Sab'],
    dayNamesMin: ['Do','Lu','Ma','Mi','Ju','i','Sa'],
    dayStatus: 'Utilice DD como el primer día de la semana', dateStatus: 'Escoja le DD, MM d',
    dateFormat: 'dd/mm/yy', firstDay: 0, 
    initStatus: 'Escoja una Fecha', isRTL: false};
    $.datepicker.setDefaults($.datepicker.regional['es']);

    $('#datepicker').datepicker({
        dateFormat: 'yy-mm-dd',
        beforeShowDay: function( date ) {
            var highlight = eventDates[date];
            if( highlight ) {
                 return [true, "event", 'Tooltip text'];
            } else {
                 return [true, '', ''];
            }
        }
    });
});
</script>
<style>
    .event a {
        background-color: #5FBA7D !important;
        color: #ffffff !important;
    }
</style>
<div class="row m-t-30">
	<div class="col-md-6 panel">
	 	<div class="white-panel">
	 		<div class="row p-30">
	 			<div class="col-md-12">
				  	<h2><span class="fa fa-search"></span> Consulta De Estados Firmados</h2>
					<p class="m-t-30 m-b-30">Desde el <?= PROJECTNAME ?> puede seleccionar la fecha de consulta para visualizar los estados publicados</p>
					<form  action='<?= HOMEDIR.DS.'consultapublica'.DS.'resultados_estados'.DS ?>' method='POST'>
					    <div class="row">
                            <div class="col-md-12">
                                <label for="id_consulta">Seleccione el tipo de Actuación a Consultar</label>
                                <div class="input-group m-b-30">
                                  <span class="input-group-addon" id="basic-addon1"><span class="fa fa-location-arrow"></span></span>
                                  <select class="form-control " style="width: 100%;" name='tipoalerta' id='tipoalerta'>
                                        <option value="">Seleccione un tipo de Alerta o Actuación</option>
                                        <option value="*">Todos</option>
                                        <?
                                            $GetAlertas = $con->Query("select * from estadosx where tipo = 'tipoalerta' and estado = '1'");
                                            while ($row = $con->FetchAssoc($GetAlertas)) {
                                                $sel = "";
                                                if ($row['nombre'] == $valor) {
                                                    $sel = "selected = 'selected'";
                                                }
                                                echo "<option value='".$row["valor"]."' $sel>".$row["nombre"]."</option>";
                                            }
                                        ?>
                                    </select>
                                </div>

                            </div>
                        </div>
                        <div class="row">
					        <div class="col-md-12">
								<label for="id_consulta">Seleccione la Fecha de Consulta</label>
								<div class="input-group m-b-30">
                                  <span class="input-group-addon" id="basic-addon1"><span class="fa fa-calendar"></span></span>
                                  <input type="text" class="form-control" id="datepicker"  name="id_consulta" >
                                <div id="datepicker"></div>
                                </div>

					        </div>
					    </div>
					    <div class="row">
					      	<div class="col-md-12" >
					        	<button type="submit" id="btn_login" class="btn btn-success btn-lg fullwidth">Buscar Estados</button>
					      	</div>
					    </div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>





<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 

    $("#tipoalerta").change(function(){
        url = '/consultapublica/estados/'+$(this).val()+"/";

        window.location.href = url;

    })

});

</script>