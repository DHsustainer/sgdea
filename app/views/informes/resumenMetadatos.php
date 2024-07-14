<?
    $path = "";
    
    $path .= " AND gestion.f_recibido between '".$f_inicio."' AND '".$f_corte."' ";

    if($ciudad != "V" && $ciudad != "" && isset($ciudad)){
        $path .= " AND ciudad = '".$ciudad."'";
    }
    #$path .= " AND oficina = '".$oficina."'";
    if($oficina != "V" && $oficina != "" && isset($oficina)){
        $path .= " AND oficina = '".$oficina."'";
    }
 
 if($dependencia_destino != "V" && $dependencia_destino != "" && isset($dependencia_destino)){
        $path .= " AND dependencia_destino = '".$dependencia_destino."'";
    }
    if($nombre_destino != "V" && $nombre_destino != "" && isset($nombre_destino)){
        $path .= " AND nombre_destino = '".$nombre_destino."'";
    }
    if($id_dependencia_raiz != "V" && $id_dependencia_raiz != "" && isset($id_dependencia_raiz)){
        $path .= " AND id_dependencia_raiz = '".$id_dependencia_raiz."'";
    }
    if($tipo_documento != "V" && $tipo_documento != "" && isset($tipo_documento)){
        $path .= " AND tipo_documento = '".$tipo_documento."'";
    }

    $base = base64_encode($path);
 /*   
    */
/*
Array ( [m] => informes [action] => GetInformeMetadatos [id] => [departamento] => 73 [ciudad] => 73001 [oficina] => 8 [dependencia_destino] => 3 [prioridad] => V [estado_solicitud] => V [estado_respuesta] => V [nombre_destino] => V [typetipo] => 1 [id_dependencia_raiz] => 248 [tipo_documento] => 249 [tipologia] => [formulario] => 167 [f_inicio] => 2017-12-01 [f_corte] => 2017-12-18 [PHPSESSID] => 3b8d2b85130a6943f0f8bb4e55f938f3 [timezone] => America/Bogota [cpsession] => expvir:km9D_odwc1fqj9vV,6d14aac6ac901a066c7a71e9fd3ba4b1 [_ga] => GA1.2.432605822.1513308129 [jaco_referer] => none [jaco_uid] => 33ccc7ff-3ba9-4ab9-9d12-99fe05298f9f [jaco_provided_id_0d382e8a-9bd1-42c6-bcc5-8c1b8d68b3f0] => 350274a7-3a5c-30b0-6910-5e4392740db9 [_at_id_eig_hostgator_cfcc] => 3e4fb0f00e059c26.1513308128.1.1513308128.1513308128.6.6. )

*/

    $str = "SELECT * from gestion 
                inner join gestion_anexos on gestion_anexos.gestion_id = gestion.id 
                inner join gestion_tipologias_big_data on gestion_tipologias_big_data.proceso_id = gestion_anexos.id 
                    WHERE gestion_anexos.tipologia = '$tipologia' $path";
     #               echo $str;

    $query = $con->Query($str);


    if ($typetipo == "1") {
        $idform = $formulario;
    }else{
        $idform = $metadato;
    }

    $q = $con->Query("select * from meta_referencias_campos where id_referencia = '".$idform."' order by orden");

#    echo "select * from meta_referencias_campos where id_referencia = '".$idform."'";
    $nombre = "Informe_".date("Y-m-d");


    $tit = new MMeta_referencias_titulos;
    $tit->CreateMeta_referencias_titulos("id", $formulario);

    $pathfecha = "";
    if ($f_inicio != "") {
        $pathfecha = "DESDE $f_inicio HASTA $f_corte";
    }
    
?>
  
<div id="exportardocumento" style="padding:20px; background-color: #FFF">
    <div>
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Tabla de Resultados</a></li>
            <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Analizar Datos del Informe</a></li>

        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="home">
                <h4 style="margin-top:30px; margin-bottom: 30px">INFORME DE METADATOS "<?= $tit->GetTitulo() ?>" <?= $pathfecha ?></h4>
                
                <button class="btn btn-primary">
                    <a href="<?= HOMEDIR.DS.'app/plugins/files/'.$nombre.".csv" ?>" style="color:#FFF">Descargar Informe</a>
                </button>
                <br><br>
                <table border='0' cellspacing='0' cellpadding='3' class='table table-striped' id='Tablagestion' style="width:auto">
                    <thead>
                        <tr class='encabezado'>
                            <th class='th_act' style=' font-size: 12px; border-bottom:1px solid #008FC9;'>Radicado</th>
<?
                            while ($row = $con->FetchAssoc($q)) {
                                echo "<th class='th_act' style=' font-size: 12px; border-bottom:1px solid #008FC9;'>".$row['titulo_campo']."</th>";
                                $archivo_csv .= $f->Reemplazo2($row['titulo_campo']).";";
                            }
                            $archivo_csv .= "\n";
?>
                        </tr>
                    </thead>
                    <tbody>
<?
    #ESTA ES LA CONSULTA QUE SE DEBE OPTIMIZAR...
    #TYPE_ID = CAMPO DE REFERENCIA PARA ID DE GESTION O ID DE DOCUMENTO
    #CAMPO FECHA PARA FILTRO

    if ($consultaglobal == "1") {
        if ($typetipo == "1") {
            $q = $con->Query("select * from meta_big_data inner join gestion on gestion.id = meta_big_data.type_id where 
                                    ref_id = '".$idform."' and tipo_form = '".$typetipo."' and gestion.f_recibido between '".$f_inicio."' AND '".$f_corte."' group by grupo_id ");
        }else{
            $q = $con->Query("select * from meta_big_data where 
                                    ref_id = '".$idform."' and tipo_form = '".$typetipo."' group by grupo_id ");
        }
    }else{

        $q = $con->Query("select * from meta_big_data inner join gestion on gestion.id = meta_big_data.type_id where 
                                    ref_id = '".$idform."' and tipo_form = '".$typetipo."' $path group by grupo_id ");
    }


    while ($rol = $con->FetchAssoc($q)) {
        
        $consul = "select valor from meta_big_data as mb inner join meta_referencias_campos as mr on mb.campo_id = mr.id where grupo_id = '".$rol['grupo_id']."' order by mr.orden";

        $q2 = $con->Query($consul);
        $minr = $c->GetDataFromTable("gestion", "id", $rol['type_id'], "min_rad", $separador = " ");
        $idr  = $c->GetDataFromTable("gestion", "id", $rol['type_id'], "id", $separador = " ");

        if ($minr != "") {
            
            echo "<tr>";
            echo "<td><a href='/gestion/ver/$idr/' target='_blank'>$minr</a></td>";

            while ($rowx = $con->FetchAssoc($q2)) {
                echo "<td>".$rowx['valor']."</td>";
                $valor = Inverse($rowx['valor']);
                $archivo_csv .= $valor.";";
            }

            echo "</tr>";
            $archivo_csv .= "\n";
        }
    }

    $f->fichero_csv($archivo_csv,$nombre);
?>          
                    </tbody>
                </table>
            </div>
            <div role="tabpanel" class="tab-pane" id="profile">
                <h4 style="margin-top:30px; margin-bottom: 30px">ANALISIS DE DATOS DEL INFORME "<?= $tit->GetTitulo() ?>" <?= $pathfecha ?></h4>
                <form id="data-analize">
                    <div class="row" style="margin-bottom: 20px">
                        <div class="col-md-6">
                            <small>
                                &#9733; = Campo Recomendado (Lista desplegable, campo numérico)
                            </small>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            
                            <input type="hidden" name="base" id="base" value="<?= $base ?>">
                            <input type="hidden" name="cglobal" id="cglobal" value="<?= $consultaglobal ?>">
                            <input type="hidden" name="idform" id="idform" value="<?= $idform ?>">
                            <input type="hidden" name="f_inicio" id="f_inicio" value="<?= $f_inicio ?>">
                            <input type="hidden" name="f_corte" id="f_corte" value="<?= $f_corte ?>">
                            <label for="">Seleccione un tipo de Grafica</label>
                                <select name="typechart" id="typechart" style="width:100%">
                                    <option value="column">Grafica de Barras</option>
                                    <option value="line">Grafica de Lineas</option>
                                    <option value="pie">Grafica Tipo Torta</option>
                                </select>
                        </div>
                        <div class="col-md-3" id="main_box">
                            <label>Referencia Principal</label>
                                <select name="main_ref" id="main_ref" style="width:100%">
                                    <option value="">Seleccione una Referencia</option>
                                <?
                                    $q = $con->Query("select * from meta_referencias_campos where id_referencia = '".$idform."'");
                                    while ($row = $con->FetchAssoc($q)) {
                                        $star = "";
                                        if ($row['tipo_elemento'] == "11") {
                                            $star = "&#9733; ";
                                        }
                                        echo "<option value='".$row['id']."'>".$star.$row['titulo_campo']."</option>";
                                        
                                    }
                                ?>
                                </select>

                            <div id="main_ref_box" class="mylittlebox scrollable"><div class="alert alert-info">Seleccione un Campo</div></div>
                            
                        </div>
                        <div class="col-md-3" id="seccond_box">
                            <label for="">Segunda Referencia (No Obligatoria)</label>
                                <select name="seccond_ref" id="seccond_ref" style="width:100%">
                                    <option value="">Seleccione una Referencia</option>
                                <?
                                    $q = $con->Query("select * from meta_referencias_campos where id_referencia = '".$idform."'");
                                    while ($row = $con->FetchAssoc($q)) {
                                        $star = "";
                                        if ($row['tipo_elemento'] == "11" || $row['tipo_elemento'] == "8") {
                                            $star = "&#9733; ";
                                        }
                                        echo "<option value='".$row['id']."'>".$star.$row['titulo_campo']."</option>";
                                        
                                    }
                                ?>
                                </select>
                                <div id="seccond_ref_box" class="mylittlebox scrollable"><div class="alert alert-info">Seleccione un Campo</div></div>
                            
                        </div>
                        <div class="col-md-3" id="third_box">
                            <label for="">Referencia de Valores Numericos</label>
                                <select name="third_ref" id="third_ref" style="width:100%">
                                    <option value="">Seleccione una Referencia</option>
                                    <option value="*">&#9733; CONTAR</option>
                                <?
                                    $q = $con->Query("select * from meta_referencias_campos where id_referencia = '".$idform."'");
                                    while ($row = $con->FetchAssoc($q)) {
                                        $star = "";
                                        if ($row['tipo_elemento'] == "11" || $row['tipo_elemento'] == "8") {
                                            $star = "&#9733; ";
                                        }
                                        echo "<option value='".$row['id']."'>".$star.$row['titulo_campo']."</option>";
                                        
                                    }
                                ?>
                                </select>
                                <div id="third_ref_box" class="mylittlebox scrollable"><div class="alert alert-info">Seleccione un Campo</div></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-primary btn-lg" onclick="GetGrafica()">Generar Informe</button>
                        </div>
                    </div>
                    <div class="row">
                        <div id="mygrap" class="col-md-12"></div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
<script>
    $(document).ready(function() {
        $('#Tablagestion tr.tblresult:not([th]):odd').addClass('par');
        $('#Tablagestion tr.tblresult:not([th]):even').addClass('impar');  
    }); 

    $("#main_ref").change(function(){
        Load("/informes/load_filter/", "main_ref_box", "main_ref"); 
    })
    $("#seccond_ref").change(function(){
        Load("/informes/load_filter/", "seccond_ref_box", "seccond_ref"); 
    })
    $("#third_ref").change(function(){
        Load("/informes/load_filter/", "third_ref_box", "third_ref"); 
    })


    function GetGrafica(){
        $("body").css("cursor", "wait");
        var URL = '/informes/getgraficas/';
        var str = $("#data-analize").serialize();
        $.ajax({
            type: 'POST',
            url: URL,
            data: str,
            success:function(msg){
                $("body").css("cursor", "default");
                $("#mygrap").html(msg);
            }
        });
    }

    function Load(urlx, where, ref){
        var URL = urlx;
        var str = $("#data-analize").serialize()+"&filter="+ref;
        $.ajax({
            type: 'POST',
            url: URL,
            data: str,
            success: function(msg){
                $("#"+where).html(msg)
            }
        });    
    }


</script>
<style>
    select {
        background: #FFF !important;
        border: 1px solid #DFDFDF;
        max-width: 100% !important;
        height: 35px;
        line-height: 35px;
        margin-bottom: 20px;
    }
    .mylittlebox{
        max-height: 200px;
        width: 100%;
        overflow: hidden;
        overflow-y: auto;
        border:1px solid #CCC;
        padding: 5px;
    }
</style>
<?
    function Inverse($temp){

        $b=array("&OACUTE;","&EACUTE;","&AACUTE;","&NTILDE;","&IACUTE;","&UACUTE;","&oacute;","&eacute;","&aacute;","&ntilde;","&iacute;","&uacute;", "&Oacute;","&Eacute;","&Aacute;","&Ntilde;","&Iacute;","&Uacute;");
        $c=array("O"       ,"E"       ,"A"       ,"N"       ,"I"       ,"U"       ,"o"       ,"e"       ,"a"       ,"n"       ,"i"       ,"u", "O"       ,"E"       ,"A"       ,"N"       ,"I"       ,"U");
        $temp=str_replace($b,$c,$temp);
        return $temp;

    }


?>