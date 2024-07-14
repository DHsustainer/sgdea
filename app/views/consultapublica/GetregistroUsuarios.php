<?
	global $c;
  	$sadmin = new MSuper_admin;
    $sadmin->CreateSuper_admin("id", "6");
    $uri = "";
    if ($sadmin->GetFoto_perfil() == "") {
      	$uri = HOMEDIR.DS."app/views/assets/images/logo_expedientes2.png";
    }else{
    	$uri = HOMEDIR.DS.'app/plugins/thumbnails/'.$sadmin->GetFoto_perfil();
    }

    $MPlantillas_email = new MPlantillas_email;
	$MPlantillas_email->CreatePlantillas_email('id', '65');
	$contenido_email = $MPlantillas_email->GetContenido();

	
?>
<div class="row m-t-30">
	<div class="col-md-6 col-md-offset-3 col-sm-12 panel">
	 	<div class="white-panel">

	 		<div class="row p-30">
	 			<div class="alert alert-info m-t-30 m-b-30">
	 				Modulo desactivado!, contactar con el adminsitrador
	 			</div>
			<?
				$cupo = $c->GetDataFromTable("usuarios_paquetes", "tipo", "1", "valor", "");

				/*if($_SESSION['MODULES']['modo_negocio_correpondencia'] == "1"){

					if ($sadmin->Getcupo_negocio() < $cupo) {
						echo '	<div class="col-md-12">
					 				<header>
					          			<h2>REGISTRO DE USUARIOS DESACTIVADO TEMPORALMENTE</h2>
					        		</header>
					    		</div>';
					}else{
						include_once(VIEWS.DS.'consultapublica'.DS."frm_registro_usuario.php");
	 				}					
				}else{
					include_once(VIEWS.DS.'consultapublica'.DS."frm_registro_usuario.php");
				}*/
 			?>
	 		</div>

	 	</div>
	 </div>
</div>



<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});
</script>
<style type="text/css">
	p{
		text-align: justify;
	}
</style>

<link href="<?= HOMEDIR ?>/app/plugins/theme/plugins/bower_components/jquery-wizard-master/steps.css" rel="stylesheet">
<!-- Form Wizard JavaScript -->
<script src="<?= HOMEDIR ?>/app/plugins/theme/plugins/bower_components/moment/moment.js"></script>
<script src="<?= HOMEDIR ?>/app/plugins/theme/plugins/bower_components/jquery-wizard-master/jquery.validate.js"></script>
<script>
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