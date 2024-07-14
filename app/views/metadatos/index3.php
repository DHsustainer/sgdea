<div class="container">

	<div class="row">

		<div class="col-md-12">

			<h2><span class="fa fa-sliders"></span>Administracion de los Formularios de la Subserie <?= $object->GetNombre() ?> </h2>

		</div>

	</div>

<?

	if ($_SESSION['MODULES']['formularios'] == "1") {

?>	

	<div class="row">

		<div class="col-md-12" id="main_form_suscriptores_modulos">



			<div class="row">

				<div class="col-md-3">

				    <!--<div class="col-md-12"> -->

			    		

			    		<div class="navbar navbar-default">

			    			<br>

						    <div class="container-fluid">

						        <div class="navbar-header">

						            <button class="navbar-toggle" data-toggle="collapse" data-target="#mainNav">

						                <span class="icon-bar"></span>

						                <span class="icon-bar"></span>

						                <span class="icon-bar"></span>

						            </button>

						        </div>

						    </div>

							

							<div>

								<div>

							        <div class="collapse navbar-collapse" id="mainNav">

							           <ul id="navlist" class="nav nav-pills nav-stacked">

											<li role="presentation" id="alistas" class="active">

												<a href="#" onClick="GetQuery('/meta_listas/','alistas', 'body-metadatosjs')">

													<span class="fa fa-list"></span> Administrar Listas

												</a>

											</li>
											<!--

											<li role="presentation" id="telementos">

												<a href="#" onClick="GetQuery('/meta_tipos_elementos/','telementos', 'body-metadatosjs')">

													<span class="fa fa-cogs"></span> Tipos de Elementos

												</a>

											</li> -->

											<li role="presentation" id="fmeta">

												<a href="#" onClick="GetQuery('/meta_referencias_titulos/dependencia/<?= $id ?>/form/','fmeta', 'body-metadatosjs')">

													<span class="fa fa-wrench"></span> Formularios de Metadatos

												</a>

											</li>

										</ul>

							        </div>

						  		</div>

							</div>

							<br>

						</div>

				   <!--</div>-->

				</div>



				<div class="col-md-9 body_metadatos">

					<div class="row">

						<div class="col-md-6" style="padding-right:5px ">

							<div class="col-md-12" id="body-metadatosjs" >

								

							</div>

						</div>

						<div class="col-md-6" style="padding-left:5px">

							<div class="col-md-12" id="inner-metadatosjs" style="padding-left:10px; padding-right: 10px" >

								

							</div>

						</div>

					</div>

				</div>



			</div>

		</div>

	</div>





	<!-- Modal -->

	<div class="modal fade bs-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

	  <div class="modal-dialog modal-lg" role="document">

	    <div class="modal-content">

		    <div class="modal-header">

		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

		        <h4 class="modal-title" id="myModalLabel">

					<!-- TITULO DE VENTANA MODAL-->

		        </h4>

		    </div>

	      	<div class="modal-body">

	        	<!-- BODY DE VENTANA MODAL -->



	      	</div>

	    </div>

	  </div>

	  <br>

	</div>

<?

	}

?>



</div>





<script>

$(document).ready(function(){

    $('[data-toggle="tooltip"]').tooltip(); 

});



function GetQuery(show, marker, where){



    //ShowLoader("show");

    var parent = $("#"+marker).parent().attr("id");

    alert

    $('#'+parent+' > li').removeClass('active');

    $('#'+parent+' > div').removeClass('active');

    $('#'+parent+' > a').removeClass('active');

    $("#"+marker).addClass('active');

    //$('#'+where).slideUp('fast');

    //location.replace();

    var URL = show;



    if (where == "body-metadatosjs") {

    	$("#inner-metadatosjs").html('<br><br><div class="alert alert-info" role="alert">Selecciona una Opción</div><br>');

    };



    $.ajax({

        type: 'POST',

        url: URL,

        success: function(msg){

            result = msg;

            $('#'+where).html(result);

            //$('#'+where).slideDown('fast');

        }

    }); 

}





function SendForm(form, rlink , selector, where){

		

	if (CheckImportantes(form)) {

		ShowLoader("show");



		f = $("#"+form);

		URL = f.attr("action");

		DATA = f.serialize();



		$.ajax({

			type: "POST",

			url: URL,

			data: DATA,

			success:function(msg){

				result = msg;

				ShowLoader("hide");

				alert("Registro Realizado");

				$("#salidadetexto").html(msg);

				GetQuery(rlink , selector, where)

			}

		});

	}

}



function ShowLoader(show){

	if(show == "show"){



		$("body").css("cursor", "wait");



	}else if(show == "hide"){



		$("body").css("cursor", "default");



	}

}





function CheckImportantes(vform){



    path = "Faltan por llenar los campos: ";

    $('#'+vform+' .important').each(function(key, value) {

        if ($(this).val() == "") {

            path += "\n"+$(this).attr("placeholder");

        }

    });



    if (path != "Faltan por llenar los campos: ") {

        alert(path);

        return false;

    }else{

        return true;

    }

}



GetQuery('/meta_referencias_titulos/dependencia/<?= $id ?>/form/','fmeta', 'body-metadatosjs');

</script>



<style>

	.body_metadatos {

	    background-color: #f8f8f8;

	    border-top: 1px solid #e7e7e7;

	    border-left: 1px solid #e7e7e7;

	    border-bottom: 1px solid #e7e7e7;

	    border-top-left-radius: 4px;

	    padding-top:20px;

	    padding-right:30px;

	    padding-bottom:20px;

	    margin-bottom:20px;



	}



	.tmain {

	    font-size: 15px;

	    font-weight: 700;

	    color: #959595;

	    text-transform: uppercase;

	    margin-bottom: 15px;

	}

	.align-right {

	    text-align: right;

	}

	.margin_bottom {

	    margin-bottom: 20px !important;

	}

	#body-metadatosjs, #inner-metadatosjs{

		background-color: #FFF;

		border-radius: 4px;

		padding:20px;

	}

	input[type='text'], input[type='password'], input[type='time'] {

	    height: 46px !important;

	}



	select {

	    max-width: 100%;

	}



	.fullwidth {

	    width: 100%;

	    height: 40px;

	}



	.iconbox {

	    width: 50px !important;

	}

</style>