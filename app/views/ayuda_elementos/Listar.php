<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-10">
                        <input type="text" class="form-control" placeholder="Buscar" name="id_busqueda_elemento" id="id_busqueda_elemento">
                    </div>
                    <div class="col-md-2">
                       <a href="#" onClick="BuscarElementoAyudaId()" class="btn btn-primary pull-right" data-toggle="modal" data-target="#myModal">Buscar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row m-t-30">
    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Paginas / Capitulos
                <a href="#" onClick="LoadModal('medium', 'Crear Capitulo/Subtitulo', '/ayuda_libros/nuevo/')" class="btn btn-primary pull-right" data-toggle="modal" data-target="#myModal">Crear Elemento</a>
                <!--<span data-toggle="modal" data-target=".bs-example-modal-lg">MODAL GRANDE</span> -->
            </div>

            <div class="panel-wrapper collapse in">
                <div class="panel-body">

                	<div class="list-group">
<?	
					$l = new MAyuda_libros;
					$l->GetArbolLibros("0", "10");
?>                	
					</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading">Elementos de la Pagina / Capitulo</div>
            <div class="panel-wrapper collapse in" aria-expanded="true">
                <div class="panel-body" id="loadElementosPagina"></div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
	
	function InsertAyudaElementos(){
		var str = $("#formayuda_elementos").serialize();
		var enlace = "/ayuda_elementos/registrar/";
		$.ajax({
		    type: 'POST',
		    url: enlace,
		    data: str,
		    success:function(msg){
		        if (msg != "error") {
		        	Alert2("Registro Realizado", "El Elemento a sido creado correctamente", "success");
		        	$("#Tablaayuda_elementos").append('<tr><td>'+msg+'</td><td>'+$("#formayuda_elementos #titulo").val()+'</td><td>'+$("#formayuda_elementos #texto").val()+'</td><td>'+$("#formayuda_elementos #posicion").val()+'</td><td></td></tr>');
		        	$("#formayuda_elementos").reset();
		        }
		    }
		});
	}


    function UpdateElementos(){
        var str = $("#FormUpdateayuda_elementos").serialize();
        var enlace = "/ayuda_elementos/actualizar/";
        $.ajax({
            type: 'POST',
            url: enlace,
            data: str,
            success:function(msg){
                
                Alert2("Registro Actualizado", "El Elemento a sido actualizado correctamente", "success");
                
            }
        });
    }

</script>