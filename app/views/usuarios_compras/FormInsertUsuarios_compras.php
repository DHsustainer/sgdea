<form id='formusuarios_compras' action='/usuarios_compras/registrar/' method='POST' class="validation-wizard"> 
        <section>
	        <h3 class="box-title m-b-0">1. Seleccionar Paquete</h3>
	        <p class="text-muted m-b-30 font-13">Seleccione el paquete que desea adquirir y realice radicaciones de demandas y notificaciones judiciales electrónicas</p>
	        <label for="paquete_id">Seleccionar Paquete</label>
			<select id="paquete_id" name="paquete_id" class="form-control required">
				<option value="">Seleccione una Opción</option>
				<?php if ($_SESSION['deuda_actual'] > 0): ?>
					<!--<option value="NA">Pagar Deuda Actual (<?= $_SESSION['deuda_actual'] ?>)</option> -->
				<?php endif ?>
			<?
				$paq = new MUsuarios_paquetes;
				$l = $paq->ListarUsuarios_paquetes(" WHERE tipo != '1'");

				$u = new MUsuarios;
				$u->CreateUsuarios("user_id", $_SESSION['usuario']);

				while ($row = $con->FetchAssoc($l)) {
					echo "<option value='".$row["id"]."'>".$row["nombre"]."</option>";
					# code...
				}
			?>	
			</select>
        </section>
        <hr>
        <section>
        	<h3 class="box-title m-b-0">2. Datos Personales</h3>
	        <p class="text-muted m-b-30 font-13">Confirma tus datos personales antes de realizar la compra</p>
	        <div class="row">
	        	<div class="col-md-12">
	        		<div class="form-group">
	        			<label for="nombre_pago">Nombre Completo</label>
	        			<input type="text" value="<?= $u->GetP_nombre()." ".$u->GetP_apellido() ?>" name="nombre_pago" id="nombre_pago" class="form-control required">
	        		</div>
	        	</div>
	        </div>
	        <div class="row">
	        	<div class="col-md-12">
	        		<div class="form-group">
	        			<label for="identificacion_pago">Identificación</label>
	        			<input type="text" value="<?= $u->GetCedula() ?>" name="identificacion_pago" id="identificacion_pago" class="form-control required">
	        		</div>
	        	</div>
	        </div>
	        <div class="row">
	        	<div class="col-md-6">
	        		<div class="form-group">
	        			<label for="telefono_pago">Teléfono</label>
	        			<input type="text" value="<?= $u->GetTelefono() ?>" name="telefono_pago" id="telefono_pago" class="form-control required">
	        		</div>
	        	</div>
	        	<div class="col-md-6">
	        		<div class="form-group">
	        			<label for="email_pago">E-mail</label>
	        			<input type="text" value="<?= $u->GetEmail() ?>" name="email_pago" id="email_pago" class="form-control required">
	        		</div>
	        	</div>
	        </div>
        </section>
	<input type='submit' value='Realizar Pago'  class="m-t-20 btn btn-info "/>
</form>

<link href="<?= HOMEDIR ?>/app/plugins/theme/plugins/bower_components/jquery-wizard-master/steps.css" rel="stylesheet">

<!-- Form Wizard JavaScript -->
<script src="<?= HOMEDIR ?>/app/plugins/theme/plugins/bower_components/moment/moment.js"></script>
<script src="<?= HOMEDIR ?>/app/plugins/theme/plugins/bower_components/jquery.steps-1.1.0/jquery.steps.min.js"></script>
<script src="<?= HOMEDIR ?>/app/plugins/theme/plugins/bower_components/jquery-wizard-master/jquery.validate.js"></script>


<script>

	var form = $(".validation-wizard").show();

	$(".validation-wizard").validate({
    	errorPlacement: function(error, element) {
			// Append error within linked label
			$( element )
				.closest( "form" )
					.find( "label[for='" + element.attr( "id" ) + "']" )
						.append( error );
			$( element )
				.closest( "form" )
					.find( "label[for='" + element.attr( "id" ) + "']" )
						.addClass( 'text-danger' );
		},
		errorElement: "span",
		messages: {
			user: {
				required: " (*)",
				minlength: " (must be at least 3 characters)"
			}
		},
        ignore: "input[type=hidden]",
        errorClass: "text-danger",
        successClass: "text-success",
        highlight: function (element, errorClass) {
            $(element).addClass(errorClass)
        },
        unhighlight: function (element, errorClass) {
            $(element).removeClass(errorClass)
            //$(element).parent().removeClass(errorClass)
        },
        /*errorPlacement: function (error, element) {
            error.insertAfter(element)
        },*/
        rules: {
            email: {
                email: !0
            }
        }
    })

</script>
<style type="text/css">
	.text-danger{
		    border-color: #f44336;
	}
</style>