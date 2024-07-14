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
	$MPlantillas_email->CreatePlantillas_email('id', '25');
	$contenido_email = $MPlantillas_email->GetContenido();
?>
<div class="row bg-title">
    <div class="col-lg-12 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title">CONSULTA PUBLICA DE EXPEDIENTES EN EL ARCHIVO HISTORICO - <?= PROJECTNAME ?></h4> </div>
</div>
<div class="row">
	<div class="col-md-12 panel">
	 	<div class="white-panel">
	 		<div class="row p-30">
	 			<div class="col-md-12">
	 				<form id='formgestion' method='POST'> 
					    <div class="row">
					        <div class="col-md-12">
					            <h4>Ubicacion de los expedientes</h5>
					        </div>
					    </div>
					    <div class="row">
					        <div class="col-md-4">
					            <select  placeholder="departamento" name="departamento" id="departamento" class='form-control disabled' disabled="disabled">
					                <option value="V">Seleccione un Departamento (Todos)</option>
					            </select>
					        </div>
					        <div class="col-md-4">
					            <select  placeholder="ciudad" name="ciudad" id="ciudad" class='form-control important disabled' disabled="disabled">
					                <option value="V">Seleccione una Ciudad (Todos)</option>
					            </select>
					        </div>
					        <div class="col-md-4">
					            <select placeholder="Oficina" name="oficina" id="oficina" class='form-control disabled' disabled="disabled">
					                <option value="Seleccione una Oficina">Seleccione una Oficina (Todos)</option>
					            </select>
					        </div>
					    </div>
					    <div class="row m-t-10">
					        <div class="col-md-4">
					            <select placeholder="<?= CAMPOAREADETRABAJO; ?>" name="dependencia_destino" id="dependencia_destino" class='form-control disabled' disabled="disabled"  onchange="dependencia_item('dependencia_destino','id_dependencia_raiz','/consultapublica/GetSeriesArea/')" >
					                <option value="V">Seleccione un <?= CAMPOAREADETRABAJO; ?> (Todos)</option>
					            </select>
					        </div>
					        <div class="col-md-4">
					            <select  placeholder="Serie Documental" class="form-control disabled" id="id_dependencia_raiz" name="id_dependencia_raiz" onchange="dependencia_item2('dependencia_destino', 'id_dependencia_raiz','tipo_documento', '/consultapublica/GetSubSeriesArea/')" disabled="disabled">
					                <option value="V">Seleccione una Serie (Todos)</option>
					            </select>
					        </div>
					        <div class="col-md-4">
					            <select  placeholder="Sub Serie Documental" class="form-control disabled" id="tipo_documento" name="tipo_documento" disabled="disabled">
					                <option value="V">Seleccione una Sub-Serie (Todos)</option>
					            </select>
					        </div>
					        <div class="col-md-3" style="display: none">
					            <select  placeholder='prioridad' name='prioridad' id='prioridad' class='form-control' >
					                <option value="V">Seleccione la prioridad de la solicitud</option>
					            </select>
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
					        <div class="col-md-4">
					            <input type='button' class="btn btn-info btn-lg" value='Generar Informe' id="btninforme"/>
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
            dependencia_item("ciudad","oficina", "/consultapublica/listadooficinasseccional");
            setTimeout(function(){
                if($("#oficina").val() != "" && $("#oficina").val()  != "Seleccione una Oficina"){
                    $("#oficina").change();
                }
            }, 1000);
        });
        $("#oficina").change(function(){
            dependencia_item("oficina","dependencia_destino", "/consultapublica/listadoareasoficinas");
        });
    	$("#btninforme").click(function(){
    		var str = $("#formgestion").serialize();
		    var URL = '/consultapublica/informehistorico/';
		    $.ajax({
	            type: 'POST',
	            url: URL,
	            data: str,
	            success: function(msg){
                    result = msg;
                    $("#contenido_bloque").html(result);
                }
	        }); 
    	})
    });

    function dependencia_estadoinExistence(departamento){
	    var code = "CO";
	    $.get("/consultapublica/GetProvincesinExistence/"+code+"/", { code: code },
	        function(resultado){
	            if(resultado == false){
	                $("#"+departamento).attr("disabled",true);
	                $("#"+departamento).addClass("disabled");
	            }else{
	                $("#"+departamento).attr("disabled",false);
	                $("#"+departamento).removeClass("disabled");
	                document.getElementById(departamento).options.length=1;
	                $('#'+departamento).append(resultado);          
	            }
	        }
	    );
	}

	function dependencia_ciudadinExistence(departamento, ciudad){

	    var code = $("#"+departamento).val();
	    $.get("/consultapublica/GetCitysinExistence/"+code+"/", { code: code },
        function(resultado){
	        if(resultado == false){
	            Alert2('El Departamento Seleccionado no Tiene Ciudades / Municipios Registradas');
	            $("#"+ciudad).attr("disabled",true);
	            $("#"+ciudad).addClass("disabled");
	        }else{
	            $("#"+ciudad).attr("disabled",false);
	            $("#"+ciudad).removeClass("disabled");
	            document.getElementById(ciudad).options.length=1;
	            $('#'+ciudad).append(resultado);            
	        }
	    }); 
	}
	function dependencia_item(principal, dependencia, pagina){
	    var code = $("#"+principal).val();
	    var page = pagina+"/"+code+"/";
	    //Alert2(page)
	    $.get(page, { code: code }, function(resultado){
	      //  Alert2(resultado);
	        if(resultado == false){
	            $("#"+dependencia).attr("disabled",true);
	            $("#"+dependencia).addClass("disabled");
	            document.getElementById(dependencia).options.length=1;          
	        }else{
	            $("#"+dependencia).attr("disabled",false);
	            $("#"+dependencia).removeClass("disabled");
	            document.getElementById(dependencia).options.length=1;
	            $('#'+dependencia).append(resultado);           
	        }
	    }); 
	}

	function dependencia_item2(itema, itemb, dependencia, pagina){

	    var code = $("#"+itema).val();
	    var code2 = $("#"+itemb).val();
	    var page = pagina+"/"+code+"/"+code2+"/";
	    //Alert2(page)
	    $.get(page, { code: code }, function(resultado){
	      //  Alert2(resultado);
	        if(resultado == false){
	            $("#"+dependencia).attr("disabled",true);
	            $("#"+dependencia).addClass("disabled");
	            document.getElementById(dependencia).options.length=1;          
	        }else{
	            $("#"+dependencia).attr("disabled",false);
	            $("#"+dependencia).removeClass("disabled");
	            document.getElementById(dependencia).options.length=1;
	            $('#'+dependencia).append(resultado);           
	        }
	    }); 
	}	
</script>


	 				
	 			</div>
	 		</div>
	 		<div class="row">
	 			<div class="col-md-12" id="contenido_bloque"></div>
	 		</div>
	 	</div>
	 </div>
</div>



<style type="text/css">
	p{
		text-align: justify;
	}
</style>