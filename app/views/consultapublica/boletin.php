<?
    global $c;
    global $con;
?>
<div class="row m-t-30">
    <!-- Left sidebar -->
    <div class="col-md-12">
        <div class="white-box">
            <!-- row -->
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <h4>Consultar <?= CAMPOEXPEDIENTE."s Públicos" ?></h4>                
                </div>
            </div>

            <form id='formgestion' method='POST' action="/consultapublica/boletin/" target="_blank"> 
                <div class="row m-t-30">
                    <div class="col-md-6">
                        <h4>Seriales Documentales</h4>
                    </div>
                    <div class="col-md-6">
                        <h4>Fechas de Consulta</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <select  placeholder="Serie Documental" class="form-control" id="id_dependencia_raiz" name="id_dependencia_raiz">
                            <option value="V">Categoría</option>
                            <?
                                $quey = $con->Query("select * from dependencias where dependencia = '0'");
                                while ($row = $con->FetchAssoc($quey)) {
                                    echo '<option value="'.$row['id'].'">'.$row['nombre'].'</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select  placeholder="Sub Serie Documental" class="form-control" id="tipo_documento" name="tipo_documento" disabled="disabled">
                            <option value="V">Seleccione una Sub Categoría</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <input class="form-control  important" type='date' name='f_inicio' id='f_inicio' placeholder="Fecha de Inicio:"/>
                    </div>
                    <div class="col-md-3">
                          <input class="form-control important" type='date' name='f_corte' id='f_corte' placeholder="Fecha de Corte:"/>
                    </div>
                </div>
                <div class="row m-t-20">        
                    <div class="col-md-6">
                        <h4>O puede consultar por tema</h4>
                    </div>
                    <div class="col-md-12">
                        <textarea name="observacion" id="observacion" class="form-control"></textarea>
                    </div>
                </div>
                <div class="row m-t-30">
                    <div class="col-md-12">
                        <code>Si no seleciona ningúna información en el filtro, el sistema realizará una consulta general</code>
                    </div>
                </div>
                <div class="row m-t-20">        
                    <div class="col-md-12">
                        <div id="optput"></div>
                        <input type='button' class="btn btn-primary" value='Generar Informe' id="searckprodcesos"/>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $("#id_dependencia_raiz").change(function(){
            $.ajax({
                type: "POST",
                url: '/consultapublica/GetDependencias/'+$(this).val()+"/",
                success: function(msg){
                    if(msg != ""){
                        $("#tipo_documento").html(msg);                  
                        $("#optput").html("");
                        $("#tipo_documento").attr("disabled",false);
                    }else{
                        $("#optput").html("<div class='alert alert-info'>No se encontraron subtipos de proceso</div>");
                        $("#tipo_documento").html('<option value="V">Seleccione una Sub Categoría</option>');
                        $("#tipo_documento").attr("disabled",true);
                    }
                }
            });             
        });

        $("#searckprodcesos").click(function(){
            var str = $("#formgestion").serialize();
            $("#resultadosconsulta").slideUp();
            $.ajax({
                type: "POST",
                data: str,
                url: '/consultapublica/GetInforme/',
                success: function(msg){
                    $("#resultadosconsulta").slideDown();
                    $("#resultadosconsulta").html(msg);
                }
            });             

        })
    });
</script>

<div class="row">
    <!-- Left sidebar -->
    <div class="col-md-12">
        <div class="white-box">
            <!-- row -->
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="inbox-center" id="resultadosconsulta"></div>
                </div>
            </div>
            <!-- /.row -->
        </div>
    </div>
</div>