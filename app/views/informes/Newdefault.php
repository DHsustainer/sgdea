<?
global $c;
?>
<script type="text/javascript">
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip(); 
        $('[data-toggle="popover"]').popover()
    });
</script>
<!--<div id="left-content" style="margin-top:50px; border:1px solid #f00; width: auto;"></div>-->
<script type="text/javascript">

        function GeneradorDatosWidgetAlertas(tipo,pagina, grupo){
            var URL = '/dashboard/'+tipo+'/'+pagina+'/'+grupo+'/';

                
            $.ajax({
                        url:URL,
                        type:'POST',
                        success:function(msg){

                    $('#widgetactividadesnuevas').append(msg);
                        }

                });
        }


function CargarAlerta(grupo, titulo, tipo, pagina){

        $("#widgetactividadesnuevas").html("");
        $("#tituo_widget").html(titulo);

        $("#listmenuwidgets > a").removeClass("active");
        $("#elm"+tipo).addClass('active');
        GeneradorDatosWidgetAlertas(tipo,pagina, grupo);

}


function GeneradorDatosWidgetAlertas2(tipo){
    var URL = '/informes/'+tipo+'/';  
    $.ajax({
                url:URL,
                type:'POST',
                success:function(msg){

            $('#widgetactividadesnuevas').append(msg);
                }

        });
}


function CargarAlerta2(titulo, tipo){

        $("#widgetactividadesnuevas").html("");
        $("#tituo_widget").html(titulo);

        $("#listmenuwidgets > a").removeClass("active");
        $("#elm"+tipo).addClass('active');
        GeneradorDatosWidgetAlertas2(tipo);

}



</script>


<div class="row">
    <div class="col-md-3" id="widget2">
        <div class="panel panel-default block1 m-t-30">
            <div class="panel-heading">Area de Informes...</div>
            <div class="panel-wrapper collapse in">
                <div class="panel-body p-0">
                    <div class="list-group" style="margin-top:-11px; margin-bottom:0px" id="listmenuwidgets">

                        

                        <?php if ($_SESSION['informe_expedientes'] == "1"): ?>
                        <a href="#" onClick="CargarAlerta2('Informe de Expedientes', 'infoexpedientes')" id="elminfoexpedientes" class="list-group-item" <?= $c->Ayuda('123', 'tog') ?>>
                            <span class="fa fa-archive"></span>
                            Informe de Expedientes
                        </a>    
                        <?php endif ?>
                        <?php if ($_SESSION['informe_documentos'] == "1"): ?>
                        <a href="#" onClick="CargarAlerta2('Informe de Documentos', 'documentos')" id="elmdocumentos" class="list-group-item" <?= $c->Ayuda('55', 'tog') ?>>
                            <span class="fa fa-file-pdf-o"></span>
                            Informe de Documentos
                        </a>    
                        <?php endif ?>
                        <?php if ($_SESSION['informe_metadatos'] == "1"): ?>
                        <a href="#" onClick="CargarAlerta2('Metadatos de los Expedientes', 'metadatos')" id="elmmetadatos" class="list-group-item" <?= $c->Ayuda('124', 'tog') ?>>
                            <span class="fa fa-bar-chart"></span>
                            Metadatos de los Expedientes
                        </a>    
                        <?php endif ?>
                        <?php if ($_SESSION['informe_FUID'] == "1"): ?>
                        <a href="#" onClick="CargarAlerta2('Formato Unico de Inventario Documental', 'fuid')" id="elmfuid" class="list-group-item" <?= $c->Ayuda('125', 'tog') ?>>
                            <span class="fa fa-print"></span>
                            FUID
                        </a>    
                        <?php endif ?>
                        <?php if ($_SESSION['informe_eliminados'] == "1"): ?>
                        <a href="#" onClick="CargarAlerta2('Informe de Documentos Eliminados', 'eliminaciones')" id="elmeliminaciones" class="list-group-item" <?= $c->Ayuda('126', 'tog') ?>>
                            <span class="fa fa-trash-o"></span>
                            Documentos Eliminados
                        </a>    
                        <?php endif ?>
                        <?php if ($_SESSION['informe_PQRs'] == "1"): ?>
                        <a href="#" onClick="CargarAlerta2('Informe de PQRS', 'pqrs')" id="elmpqrs" class="list-group-item" <?= $c->Ayuda('126', 'tog') ?>>
                            <span class="fa fa-question"></span>
                            INFORME DE PQRS
                        </a>    
                        <?php endif ?>
                        <?php if ($_SESSION['informe_notificaciones'] == "1"): ?>
                        <a href="#" onClick="CargarAlerta2('Informe de Correspondencia', 'correspondencia')" id="elmcorrespondencia" class="list-group-item" <?= $c->Ayuda('347', 'tog') ?>>
                            <span class="fa fa-envelope"></span>
                            Informe De Correspondencia
                        </a>    
                        <?php endif ?>
                        <?php if ($_SESSION['informe_callcenter'] == "1"): ?>
                            <a href="#" onClick="CargarAlerta2('Informe de Registros nuevos', 'nuevosusuarios')" id="elmnuevosusuarios" class="list-group-item">
                                <span class="fa fa-users"></span>
                                Nuevos Usuarios
                            </a>    
                        <?php endif ?>

                        <?php if ($_SESSION['estados_cuentas'] == "1"): ?>
                            <a href="#" onClick="CargarAlerta2('Informe de Consumo De los Usuarios', 'estadocuentas')" id="elmestadocuentas" class="list-group-item">
                                <span class="fa fa-users"></span>
                                Estados de Cuenta
                            </a>    
                            <a href="#" onClick="CargarAlerta2('Informe de Consumo De los Usuarios', 'citas')" id="elmcitas" class="list-group-item">
                                <span class="fa fa-users"></span>
                                Agendamiento de Citas
                            </a>    
                        <?php endif ?>
                        
                        
                        
                        
                        
                        
                        <!--<a href="#" onClick="CargarAlerta2('Expedientes Archivados', 'archivados')" id="elmarchivados" class="list-group-item">
                            <span class="fa fa-clock-o"></span>
                            Expedientes Archivados
                        </a>-->
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-9" id="widget1">
        <div class="panel panel-default block1 m-t-30">
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <div class="widget_content" id="contentwidgetactividadesnuevas">
                        <div class="widget_title"> 
                            <h2 class="titulo_widget" id="tituo_widget"> <span title="Actividades Nuevas" class="fa fa-check"></span>Informes...</h2>
                        </div>
                        <div id="widgetactividadesnuevas">
                            <br><br><br>
                            <div class="alert alert-info" role="alert">
                                Seleccione un tipo de informe
                            </div>
                            <br><br><br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>