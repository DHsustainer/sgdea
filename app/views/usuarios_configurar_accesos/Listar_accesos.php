<?php 
include_once(MODELS.DS.'Usuarios_configurar_accesosM.php');
?>
<style type="text/css">
    .headers_tabla{
        font-weight: bold;
        font-size: 16px;
        color: #FFF;
        background-color: #546674;
        line-height: 35px;
        padding-left: 10px !important;
    }

    .coldeelementos{
        border-right: 1px solid #CCC;
        min-height: 400px;
        border-top:1px solid #CCC;
        border-bottom:1px solid #CCC;
    }

</style>
<div id="contenido_bloque">

    <input type="hidden" id="a_iusuario" name="a_iusuario" value="<?php echo $a_iusuario = $object->GetA_i(); ?>">

    <div class="row" >
        <div class="col-md-3"><h5><b>Ciudades</b></h5></div>
        <div class="col-md-3"><h5><b>Oficinas</b></h5></div>
        <div class="col-md-3"><h5><b>Areas</b></h5></div>
        <div class="col-md-3"><h5><b>Usuarios</b></h5></div>
    </div>

    <div class="row" style="margin-top:0px;">
        <div class="col-md-3 coldeelementos p-0" style="border: 1px solid rgba(120, 130, 140, 0.13);">
            <ul id="cargarlistadodeciudades" class="list-group">
            <?php

                global $con;
                
                $query = $con->Query("select * from seccional_principal");
                while ($row = $con->FetchAssoc($query)) {
                
                    echo '  <li id="c'.$row['id'].'" class="list-group-item">
                                <div class="waves-effect" onClick="CargarListadoOficinas(\''.$row['id'].'\')">';
                    echo            $row['nombre'];
                    echo '      </div>
                            </li>';
                }
            ?>
                
            </ul>
        </div>
        <div class="col-md-3 coldeelementos scrollable p-0" style="height:400px; overflow:hidden;overflow-y: auto;border: 1px solid rgba(120, 130, 140, 0.13);">
            <ul id="cargarlistadodeoficinas" class="list-group"></ul>
            
        </div>
        <div class="col-md-3 coldeelementos scrollable p-0" style="height:400px; overflow:hidden;overflow-y: auto;border: 1px solid rgba(120, 130, 140, 0.13);">
            <ul id="cargarlistadodeareas" class="list-group"></ul>
        </div>
        <div class="col-md-3 coldeelementos scrollable p-0" style="height:400px; overflow:hidden;overflow-y: auto;border: 1px solid rgba(120, 130, 140, 0.13);">
            <ul id="cargarlistadodeusuarios" class="list-group"></ul>
            
        </div>
    </div>
<script type="text/javascript">
    var ciudad_activa = 0;
    function CargarListadoOficinas(idoficina){
        $("#cargarlistadodeciudades li").removeClass("active");
        $("#cargarlistadodeciudades li#c"+idoficina).addClass("active");

        var URL = '/seccional/abriroficinas/'+idoficina+"/";
        $.ajax({
           type: 'POST',
            url: URL,
            success:function(msg){
                $("#cargarlistadodeoficinas").html(msg);
                $("#cargarlistadodeareas").html("");
                $("#cargarlistadodeusuarios").html("");
            }
        }); 
    }

    function CargarListadoAreas(idoficina, id_ciudad){
        $("#cargarlistadodeoficinas li").removeClass("active");
        $("#cargarlistadodeoficinas li#o"+idoficina).addClass("active");

        ciudad_activa = id_ciudad;
        var URL = '/areas/abrirareas/'+idoficina+"/"+id_ciudad+"/";
        $.ajax({
           type: 'POST',
            url: URL,
            success:function(msg){
                $("#cargarlistadodeareas").html(msg);
                $("#cargarlistadodeusuarios").html("");
            }
        }); 
    }

    function CargarListadoUsuarios(area, oficina){
        $("#cargarlistadodeareas li").removeClass("active");
        $("#cargarlistadodeareas li#ax"+area).addClass("active");
        var URL = '/usuarios/abrirusuarios/'+area+"/"+oficina+"/";
        $.ajax({
           type: 'POST',
            url: URL,
            data: { a_iusuario: $('#a_iusuario').val()},
            success:function(msg){
                $("#cargarlistadodeusuarios").html(msg);
            }
        }); 
    }

    function CargarListadoAreas2(idoficina, id_ciudad,area){

        ciudad_activa = id_ciudad;
        var URL = '/areas/abrirareas/'+idoficina+"/"+id_ciudad+"/";
        $.ajax({
           type: 'POST',
            url: URL,
            success:function(msg){
                $("#cargarlistadodeareas").html(msg);
                $("#cargarlistadodeusuarios").html("");
                CargarListadoUsuarios(area, idoficina);
            }
        }); 
    }


</script>


</div>

<style type="text/css">
	
#contenido_bloque .titulolista, #contenido_bloque .titulolista2, #contenido_bloque .titulolista3, #contenido_bloque .titulolista4{
    font-size:13px;
    font-weight:bold;
    color:#000;
    cursor: pointer;
    padding-left:10px;
    font-size: 14px;
    line-height: 35px;
    min-height: 35px;
}
#contenido_bloque .titulolista:hover, #contenido_bloque .titulolista.active, #contenido_bloque .titulolista2:hover, #contenido_bloque .titulolista2.active, #contenido_bloque .titulolista3:hover, #contenido_bloque .titulolista3.active, #contenido_bloque .titulolista4:hover, #contenido_bloque .titulolista4.active{
	background-color: #f5f5f5;
}

#contenido_bloque .cuerpolista, #contenido_bloque .cuerpolista2, #contenido_bloque .cuerpolista3, #contenido_bloque .cuerpolista4{
    padding-left: 15px;
    padding-bottom: 15px;
    display: none; 
    /*
    */
    margin-bottom: 7px;
    text-align: justify;
    line-height: 17px;
}

.encabezado{
    color:#fff;
    background:#4F81BD;
    text-align: left;
}
.list-group-item div:hover{
    cursor: pointer;
    text-decoration: underline;
}

</style>

<script type="text/javascript">
function sleep(ms) {
  return new Promise(resolve => setTimeout(resolve, ms));
}
    function fnUsuarios_configurar_accesos(tipo,usuario,area,seccional){
        var URL = '/usuarios_configurar_accesos/RegistrarConfigurarAccesos/'+tipo+"/"+$('#a_iusuario').val()+"."+usuario+"."+area+"."+seccional+"/";
        $.ajax({
           type: 'POST',
            url: URL,
            success:function(msg){
                CargarListadoAreas2(seccional, ciudad_activa, area);
                
            }
        });
       
    }
    

</script>