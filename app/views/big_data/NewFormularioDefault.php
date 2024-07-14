<?

		$row = $con->FetchAssoc($query);
		$l = new MBig_data;
		$l->Createbig_data('id', $row['id']);

		$ref = new MRef_tables;
		$ref->CreateRef_tables('id', $l -> GetRef_tables_id());
		$path = "";

		$nooptions = "1";

?>		

<div id="folders-content" class="row m-t-30">
	<div id="folders-list-content" class="col-md-12">
		<div class="panel p-30">
    		<h2>Paso 2: Registro del Formulario <strong><?= $ref->GetTitle() ?></strong></h2>
			<div id="contenido_bloque"> 
				<ul id='listadonovedades'>
			        <li id='li<?= $l->GetId() ?>'>
			            <div class="cuerpolista">
<?
						include_once(VIEWS.DS."meta_big_data/FormUpdateMeta_big_data.php");

						global $c;
						$redirect = $c->GetDataFromTable("plantillas_email", "nombre", "redirect_to", "contenido", "");
?>
				        </div>
			        	<div class="row" style="margin-left:0px; margin-top: 0px; text-align:right">
			    		    <div class="col-md-12 m-20">
			    		    	<input type="button" class="btn btn-danger btn-lg pull-right" id='save_opc' onclick='window.location.href = "/gestion/ver/<?= $gestion->GetId() ?>/<?= $redirect ?>/"' style="display:none;" value="Ir al Expediente">
			    			<br><br>
			    			</div>
			    		</div>
			        </li>	
				</ul>
			</div>
		</div>
	</div>
</div>



<script>

	$('tr.tblresult:not([th]):even').addClass('par');

	$('tr.tblresult:not([th]):odd').addClass('impar');



    $(".titulolista").click(function(){

        if(!$(this).parent().hasClass("active")){

            

            $('div.cuerpolista').slideUp("fast");

            $("ul#listadonovedades > li").removeClass("active");

            $(".titulolista").removeClass("active");



            $(this).parent().children('div.cuerpolista').slideDown("fast");

            $(this).parent().addClass("active")

            $(this).addClass("active")

        }else{

            $(this).parent().children('div.cuerpolista').slideUp("fast");

            $(this).parent().removeClass("active")

            $(this).removeClass("active")

        }

    })



	function EliminarBig_data(id){

		if(confirm('Esta seguro desea eliminar este formulario')){

			var URL = '/big_data/eliminar/'+id+'/';

			$.ajax({

				type: 'POST',

				url: URL,

				success: function(msg){

					alert(msg);

					$('#li'+id).remove();

				}

			});

		}

		

	}	



	function EditarBig_data(id){

		var URL = '<?= HOMEDIR ?>big_data/editar/'+id+'/';

		$.ajax({

			type: 'POST',

			url: URL,

			success: function(msg){

				$('#divtoshow').html(msg);

			}

		});

	}



	function EditForm(id){

		$('#FormUpdatebig_data'+id+' .input1').removeClass('no_editable');

		$('#FormUpdatebig_data'+id+' .input1').addClass('editable');

		$('#FormUpdatebig_data'+id+' .input1').prop('disabled', false);

		$('#FormUpdatebig_data'+id+' #edit_opc').hide();

		$('#FormUpdatebig_data'+id+' #save_opc').show();

	}	

	EditForm('<?= $bigdata ?>')

</script>		

<style type="text/css">

	#contenido_bloque ul{

	    list-style: none;

	    text-align: left;

	    width: 100%;

	    padding-left: 0px;

	    margin-top: 0px;

	}

	#contenido_bloque li{

	    border-bottom: 1px solid #CCC;

	    width: 100%;    

	}

	#contenido_bloque .titulolista{

	    font-size:13px;

	    font-weight:bold;

	    color:#000;

	    cursor: pointer;

	    padding-left:10px;

	    font-size: 14px;

	    line-height: 35px;

	    min-height: 35px;

	}

	#contenido_bloque .titulolista:hover, #contenido_bloque .titulolista.active{

		background-color: #f5f5f5;

	}



	#contenido_bloque .cuerpolista{

	    padding-left: 15px;

	    padding-right: 15px;

	    padding-bottom: 15px;

	    margin-bottom: 7px;

	    text-align: justify;

	    line-height: 28px;

	}

	label {


	    margin-bottom: 0px;

	    margin-left: -3px;

	    font-weight: bold;

	}

	input[type="text"].editable {

		display:block;

	    width: 90%;

	}







.btn-primary {

    color: #fff !important;

    background-color: #337ab7 !important;

    border-color: #2e6da4 !important;

}

.btn-danger {

    color: #fff !important;

    background-color: #d9534f !important;

    border-color: #d43f3a !important;

}

.btn {

    display: inline-block !important;

    padding: 6px 12px !important;

    margin-bottom: 0 !important;

    font-size: 14px !important;

    font-weight: 400 !important;

    line-height: 1.42857143 !important;

    text-align: center !important;

    white-space: nowrap !important;

    vertical-align: middle !important;

    -ms-touch-action: manipulation !important;

    touch-action: manipulation !important;

    cursor: pointer !important;

    -webkit-user-select: none !important;

    -moz-user-select: none !important;

    -ms-user-select: none !important;

    user-select: none !important;

    background-image: none !important;

    border: 1px solid transparent !important;

    border-radius: 4px !important;

}

</style>