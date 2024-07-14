	<div id="tools-content">

		<div class="opc-folder blue">

			<div class="header-agenda">



                <div class="boton-new-proces-blankspace" style="float: left"></div>

                <div id="boton-new-proces" style="float: left">

                    <a class="no_link" href="/gestion/InteraccionSuscriptores/">

                        <div class="active">Interaccion con Suscriptores</div>

                    </a>

                </div>



                <div class="boton-new-proces-blankspace" style="float: left"></div>



                <div id="boton-new-proces" style="float: left">

                    <a class="no_link" href="/gestion/InteraccionSuscriptoresCompartir/">

                        <div>Compartir expedientes con suscriptores</div>

                    </a>

                </div>

                

                <div class="boton-new-proces-blankspace" style="float: left"></div>

            </div>

		</div>

	</div>

	<div id="folders-list-content" class="scrollable">

		<br>

		<div class="form">

			<div class="title right">Listado de Suscriptores</div>

			<div class="table" id="listadoexportable" style="margin-bottom:50px">

				<form id="enviarexpedientesinteraccionsuscriptores" action="/gestion/enviarexpedientesinteraccionsuscriptores/">

					

				</form>

			</div>

		</div>

	</div>

<script>

	$(document).ready(function() {
			$("th").parent().addClass("encabezadot");
			$("tr.addd:not([th]):even").addClass("par");
			$("tr.addd:not([th]):odd").addClass("impar");

			$('.datepicker').datepicker({
			dateFormat: 'yy-mm-dd',
			monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio', 'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
			dayNames: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'], // For formatting
			dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'], // For formatting
			dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa'] // Column headings for days starting at Sunday				
		});

	});

	function BuscarExpedientesfecha(){
		document.location.href='/gestion/correspondencia/0/'+$('#fecha_i').val()+'/'+$('#fecha_f').val()+'/';
	}

</script>

<style>

	.addd{

		cursor:pinter;

	}

	.addd td:hover{

		text-decoration:underline;

		cursor:pointer;

	}

    .listado_acciones{

        float:left;

        line-height: 35px;

        font-size: 12px;

        overflow-y: hidden ; 

        overflow-x: hidden ; 

        padding: 5px;

        padding-right: 9px;

        cursor: normal;

    }

    .listado_acciones:hover{

        text-decoration: underline;

        cursor: pointer;

    }

    .listado_acciones .impr_box ul{

		margin-left:-127px;	

		font-size: 10px;

	}

</style>





