<div class="row">
    <div class="col-md-12" id="widget2">
        <div class="panel panel-default block1 m-t-30">
            <div class="panel-heading">
            	<div class="row">
					<div class="col-md-6">Ayuda del Sistema</div>
					<div class="col-md-6" align="right"><span class="text-muted">¿No encontraste lo que buscabas? </span>
						<a href="https://suppport.laws.com.co/" class="btn btn-danger" target="_blank">Crea un Ticket!</a></div>
            	</div>
            	
            </div>
            <div class="panel-wrapper collapse in m-t-20">
                <div class="panel-body">
                	<form action="/ayuda/buscar/" method="POST">
						<div class="row">
						    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			                    <div class="col-md-10">
			                        <input type="text" class="form-control input-lg" placeholder="Buscar" name="id_busqueda_elemento" id="id_busqueda_elemento" value="<?= $termino ?>">
			                    </div>
			                    <div class="col-md-2">
			                    	<button type="submit" class="btn btn-primary pull-right btn-lg">Buscar Tema</button>
			                    </div>
						    </div>
						</div>
                	</form>

					<div class="row m-t-30">
					    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
					        <h3>Paginas / Capitulos</h3>
					        <div class="list-group">
					<?	
							$l = new MAyuda_libros;
							$l->GetArbolLibrosPublic("0", "10");
					?>                	
							</div>        
					    </div>
					    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
				            <div id="loadElementosPagina">#LOADER_HELP#</div>
					    </div>
					</div>

                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
	$(".book_main_item").click(function(){
		$(".book_main_item").removeClass("active");
		$(this).addClass("active")
		//alert("hola!");
	})
</script>