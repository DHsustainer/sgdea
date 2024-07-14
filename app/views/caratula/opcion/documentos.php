<div id="form" class="white">
    <h4 class="title">Lista de Documentos Oficiales
    <?php if ($_SESSION[usuario]==$_SESSION[sadminid] || $_SESSION[sadmin]!=1): ?>
<?
        if ($_SESSION['folder'] == '') {
?>
        <a href="/caratula/opcion/<?=$_GET[id]?>/crear_documento/" class="btn_title">Crear Documento</a>
<?
        }
?>
    <?php endif ?>
     </h4>

    <table border='0' width="100%" cellspacing="0" cellpadding="0" style="margin-bottom: 20px;">
<?php 
    $i = 0;
    global $f;
    global $c;
    while ($col=$con->FetchAssoc($query)) {
        $i++;
        if ($i%2 == 0) {
            $line = "impar";
          }else{
            $line = "impar";
          }
            if ($_SESSION[usuario]==$_SESSION[sadminid] || $_SESSION[sadmin]!=1) {
                if ($_SESSION['folder'] == '') {

                    $car = new MCaratula;
                    $car->CreateCaratula("id", $c->sql_quote($_GET[id])); 

                    $fmp = $car->GetFecha_actualizacion();
                    $fdoc = $col['f_actualizacion'];
                    $fdoc = substr($fdoc, 0, 10);
                    if ($fdoc == "0000-00-00" || $fdoc == "") {
                        $fdoc = $col["f_creacion"];
                        $fdoc = substr($fdoc, 0, 10);
                    }
                    
                    $links   ="<div style='float:left; margin-right:5px;'><a href='/caratula/opcion/$_GET[id]/crear_documento/$col[id]/'><div class='btn btn-info btn-circle' title='editar'></div></a></div>";
                    $links3  ="<div onclick='ExportarAnexo(\"".$col['id']."\", \"".$fmp."\", \"".$fdoc."\")' class='mini-ico green-exp' title='exportar'></div>";
//                    $links3 .="<div onclick='ExportarAnexoWord(\"".$col['id']."\", \"".$fmp."\", \"".$fdoc."\")' class='mini-ico green-word' title='exportar a word'></div>";                    
                    $links2  ="<div style='float:left;' onClick='EliminarAnexo(\"".$col['id']."\")'><div class='btn btn-warning btn-circle mdi mdi-delete' title='eliminar'></div></div>";
                }
            }
    	echo "	
				<tr id='mme".$col[id]."'>
                    <td style='border-bottom:1px solid #CCC; border-top:1px solid #F0F0F0'>
                        <div class='pdf-ico'></div>
                    </td>
					<td width='75%' style='border-bottom:1px solid #CCC;  border-top:1px solid #F0F0F0'>
                        <div class='title_td'>$col[nombre] </div>
                        <div class='time_td'>".$f->ObtenerFecha($fdoc)."</div>
                    </td>
                    <td class='".$line."'style=' border-top:1px solid #F0F0F0; border-bottom:1px solid #CCC;'>
                        $links
                        $links3                        
                        $links2
                    </td>
				</tr>";
    } 

?>
    </table>
    <div class="clear"></div>
    <br>
</div>

    <form action="/caratula/exportaranexoword/" method="post" target="_blank" id="FormularioExportacion">

    <input type="hidden" id="datos_a_enviar" name="datos_a_enviar" value="" />

    </form>

<style>
.title_td{
    font-weight: bold;
    font-size: 12px;
    margin: 0px;    
    line-height: 15px;
    margin-top: 12px;
}
.time_td{
    color: #818E96;
    line-height: 15px;
    margin: 0px;    
    margin-bottom: 9px;
    font-size: 11px;
}

</style>
<script>
    function ExportarAnexo(id, fproceso, fdoc){
        if (fproceso == "0000-00-00 00:00:00") {
            var URL = '/caratula/exportaranexo/'+id+'/';
            $.ajax({
                type: 'POST',
                url: URL,
                success: function(msg){
                    result = msg;
                    if (result == "1") {
                        alert("Documento Exportado a anexos");
                    }else{
                        alert(result);                        
                    }
                    // Some code here!
                }
            }); 
        }else{
            if (Date.parse(fdoc) > Date.parse(fproceso)) {
                var URL = '/caratula/exportaranexo/'+id+'/';
                $.ajax({
                    type: 'POST',
                    url: URL,
                    success: function(msg){
                        result = msg;
                        if (result == "1") {
                            alert("Documento Exportado a anexos");
                        }else{
                            alert(result);                        
                        }
                        // Some code here!
                    }
                }); 
            }else{
                if (confirm("El proceso ha sido actualizado despues de haber sido creado este documento oficial. \nEsta seguro que desea exportarlo a PDF sin actualizar")) {
                    var URL = '/caratula/exportaranexo/'+id+'/';
                    $.ajax({
                        type: 'POST',
                        url: URL,
                        success: function(msg){
                            result = msg;
                            if (result == "1") {
                                alert("Documento Exportado a anexos");
                            }else{
                                alert(result);                        
                            }
                            // Some code here!
                        }
                    }); 
                }else{
                    window.location.href= '/caratula/opcion/<?= $_GET[id] ?>/crear_documento/'+id+'/';
                }
            }
        }
    }
    function ExportarAnexoWord(id, fproceso, fdoc){
        if (fproceso == "0000-00-00 00:00:00") {
            $("#datos_a_enviar").val(id);
            $("#FormularioExportacion").submit();
        }else{
            if (Date.parse(fdoc) > Date.parse(fproceso)) {
                $("#datos_a_enviar").val(id);
                $("#FormularioExportacion").submit();; 
            }else{
                if (confirm("El proceso ha sido actualizado despues de haber sido creado este documento oficial. \nEsta seguro que desea exportarlo a PDF sin actualizar")) {
                    $("#datos_a_enviar").val(id);
                    $("#FormularioExportacion").submit();
                }else{
                    window.location.href= '/caratula/opcion/<?= $_GET[id] ?>/crear_documento/'+id+'/';
                }
            }
        }
    }    

    function EliminarAnexo(id){
        if (confirm("Esta seguro que desea eliminar este documento oficial?")) {
            var URL = '/memoriales/eliminar/'+id+'/';
            $.ajax({
                type: 'POST',
                url: URL,
                success: function(msg){
                    result = msg;
                    alert(result);
                    $("#mme"+id).slideUp();
                }
            }); 
        }
    }
</script>