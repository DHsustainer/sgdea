<div id="form" class="white">
<?
    $xc = new MCaratula;
    $xc->CreateCaratula("id", $_GET["id"]);
?>
    <form action='/caratula/opcion/<?=$_GET[id]?>/documentos/<?=(isset($_GET[p1]))?"$_GET[p1]/":''?>' method="POST">

        <div id="menu_minutas"style="width:100%; height: 50px; ">
            <div id="nav" style="width:200px; float:left">
                <div class = "minutas">MINUTAS
                    <div class="scrollable">
                        <ul>
                            <?
                            $query2 = $object2->ListarPlantilla("WHERE def = 'No' and user_id = '".$_SESSION['usuario']."'");    
                            while($row = $con->FetchAssoc($query2)){
                                $ln = new MPlantilla;
                                $ln->Createplantilla('id', $row[id]);
                                ?>
                                    <li class="item-plantilla" title="<?php echo $ln->GetNombre(); ?>" onclick="view_plantilla(<?=$row[id]?>,this)"><?php echo substr($ln->GetNombre(), 0, 40); ?></li>
                                <?
                                
                            }
                            $query2 = $object2->ListarPlantilla("WHERE def = 'Si'", "group by t_plantilla");    
                            while($row = $con->FetchAssoc($query2)){
                                $l = new MPlantilla;
                                $lq = $l->ListarPlantilla("WHERE t_plantilla = '".$row['t_plantilla']."' and def='Si' ");

                                echo '<li><b>Plantillas Genericas '.$row["t_plantilla"].'</b></li>';
                                while ($rx = $con->FetchAssoc($lq)) {
                                    $ln = new MPlantilla;
                                    $ln->Createplantilla('id', $rx[id]);
                                    ?>
                                        <li class="item-plantilla" onclick="view_plantilla(<?=$rx[id]?>,this)" title='<?php echo $ln->GetNombre(); ?>'><?php echo substr($ln->GetNombre(), 0, 40); ?></li>
                                    <?
                                }
                            }
                            ?>
                        </ul>
                        <div style="clear:both;"></div>
                    </div>
                </div>
            </div>
            <div style="float:right">
                <input type="text" id="name-summernote" name="nombre" value="<?=$content[1]?>" style="width:500px; border-radius: 0px; -moz-border-radius: 0px; margin-bottom: 0px;" placeholder="Título del nuevo documento">
                <input type="submit" value='<?=(isset($_GET[p1]))?"Editar":"Guardar"?>' name="submit">
            </div>
        </div>
        <div id="bodyform_minutas" style="width:100%;">
            <div class="bloq_newdoc" style="float:left; width: 100%;">
                <div id="buttons">
                <button type="button" id="bold" class="botone"><img src="http://assets.audiosjuridicos.com/images/editor-theme/bold.png" alt=""></button>
                <button type="button" id="italic" class="botone"><img src="http://assets.audiosjuridicos.com/images/editor-theme/italic.png" alt=""></button>
                <button type="button" id="underline" class="botone"><img src="http://assets.audiosjuridicos.com/images/editor-theme/underline.png" alt=""></button>
                <!--<button type="button" id="sline" class="botone"><img src="http://assets.audiosjuridicos.com/images/editor-theme/strike_trough.png" alt=""></button> -->

                <span class="spacer"></span>

                <button type="button" id="left" class="botone"><img src="http://assets.audiosjuridicos.com/images/editor-theme/align_left.png" alt=""></button>
                <button type="button" id="right" class="botone"><img src="http://assets.audiosjuridicos.com/images/editor-theme/align_right.png" alt=""></button>
                <button type="button" id="center" class="botone"><img src="http://assets.audiosjuridicos.com/images/editor-theme/align_center.png" alt=""></button>
                <button type="button" id="justify" class="botone"><img src="http://assets.audiosjuridicos.com/images/editor-theme/align_justify.png" alt=""></button>

                <select style="width:100px" id="fontname">
                  <option value="Arial">Arial</option>
                  <option value="Comic Sans MS">Comic Sans MS</option>
                  <option value="Courier New">Courier New</option>
                  <option value="Monotype Corsiva">Monotype</option>
                  <option value="Tahoma">Tahoma</option>
                  <option value="Times">Times</option>
                </select>
                
            </div>
                <div id="editor" name="editor" class="text_notas scrollable"></div>

                <input type="hidden" id="plantchosed" name="plantchosed" value="">
                <input type="hidden" value="0" id="id-summernote">
                <textarea style="display:none" class="text_notas marginbottom_2 scrollable" name='descripcion' id='descripcion' maxlength='' placeholder="Escribe tu nota aquí..."><?= $content[0] ?></textarea>
            </div>
        </div>

    </form>
    <div class="clear"></div>
</div>
<script>

    function view_plantilla(id,div){
        $.ajax({
            url:'/herramientas/plantilla/'+id+'/2/<?=$xc->GetProceso_id()?>/',
            success:function(msg){
                var data = eval('('+msg+')');
                $('#editor').html('');
                $("#descripcion").val('');
                $('#editor').focus();
                document.execCommand("inserthtml", null, data['content']);
                $("#descripcion").val(data['content']);
                $('#id-summernote').val(id);
                $('.item-plantilla').removeClass('active');
                $(div).addClass('active');
                $('#name-summernote').val(data['name']);
            }
        })
    }

    function ShowPlants(wich){
        if ($("#"+wich).hasClass('active')) {
            $("#"+wich).slideUp();
            $("#"+wich).removeClass('active');
        }else{
            $("#"+wich).slideDown();
            $("#"+wich).addClass('active');
        }
    }

</script>
<style>

    textarea.text_notas, div.text_notas{
        width:846px; 
        height: 340px;
        padding-left: 20px;
        padding-right: 20px;
        line-height: 27px;
        color: #000;
        background: #FFF;
    }

    #text-summernote input[type='text']{
        height: 40px;
        margin-top: 3px;
        margin-right: 20px;
        width: 500px;
        padding: 0px;
        padding-top: 0px;
        line-height: 40px;

    }

    #editor {   overflow: none; overflow-y: auto; height: 800px; margin-bottom: 50px;}
    #bold   {   font-weight: bold;      }
    #italic {   font-style: italic;     }
    #underline  {   text-decoration: underline;     }
    #sline {    text-decoration: line-through       }

    #left   {   text-align: left;       }
    #right  {   text-align: right;      }
    #center {   text-align: center;     }
    #justify{   text-align: justify;    }

    .botone{
        background:none;
        color: #666;
        font-weight:bold;
        font-size:11px;
        height:27px;
        margin:5px 2px;
        cursor:pointer;
        border:1px solid #DDD;      
        -moz-border-radius: 3px;
        -webkit-border-radius: 3px;
        border-radius: 3px; 
        padding:0px 5px 0px 5px;
        margin-top: 5px;
    }
    .botone{
        width:27px;
    }
    .botone img{
        border:0px;
        margin:0px;
        padding:0px !important;
        width:16px;
        height:16px;
    }
    .botone:hover{
        border:1px solid #CCC;
    }

    .spacer{
        width:10px;
        margin-left:10px;
    }
    #buttons{
        background-color: #1263A1;
    }
    .btn_plantilla{
        cursor: pointer;
    }
    .btn_plantilla:hover{
        text-decoration: underline;
    }
</style>
<script type="text/javascript">

/* NUEVO EDITOR A PARTIR DE AQUI*/

$(document).ready(function() {

    function format_button(a,p) {
        $('#editor').focus();
        if (p == null) 
            p = false;
        document.execCommand(a, null, p);
        $("#descripcion").val($(this).html());
    }

    function AddHtml(id, p) {
        $('#editor').focus();
        if (p == null) 
            p = false;
        document.execCommand("inserthtml", false, p);       
        //document.execCommand(a, null, p);
        $("#descripcion").val($(this).html());
         $('#'+id).prop('selectedIndex',0);

        //$("#"+id).find('option :eq(0)').attr('selected', true);
    }


    function align_button(a, p)
    {
        $('#editor').focus();
        if (p == null) 
            p = false;
        document.execCommand(a, null, p);
        $("#descripcion").val($(this).html());
    }
    $( "#editor" ).keyup(function( event ) {
        $("#descripcion").val($(this).html());
    });
    $('#editor').get(0).contentEditable = "true";
    $('#fontname').change(function() {
        format_button('fontname', $(this).val());
    });


    $('#bold').click(function()     {   format_button('bold');      });
    $('#italic').click(function()   {   format_button('italic');    });

    $('#underline').click(function(){   format_button('underline'); });
    $('#sline').click(function()    {   format_button('sline');     });
    $('#left').click(function()     {   align_button('JustifyLeft');    });
    $('#right').click(function()    {   align_button('JustifyRight');   });
    $('#center').click(function()   {   align_button('JustifyCenter');});
    $('#justify').click(function()  {   align_button('JustifyFull');    });


/*
    bar.appendChild(align_button('<img src="images/editor-theme/indent.png" title="Identar">','indent'));
    bar.appendChild(align_button('<img src="images/editor-theme/outdent.png" title="Identar">','outdent'));
    bar.appendChild(list_button('<img src="images/editor-theme/edit-list-order.png" title="Lista Numerica">','InsertOrderedList')); 
    bar.appendChild(list_button('<img src="images/editor-theme/edit-list.png" title="Lista Numerica">','InsertUnorderedList'));
        
    bar.appendChild(spacer());  
    bar.appendChild(url_button('<img src="images/editor-theme/insert_link.png" title="Insertar link">', 'url'));
    bar.appendChild(format_button('<img src="images/editor-theme/unlink.png" title="Negrita">','unlink'));  
    bar.appendChild(url_button('<img src="images/editor-theme/image.png" title="Insertar imagen">', 'image'));

*/

});
</script>
<?
    if ($_GET[p1] != "") {
        # code...
    
?>
<script>
    function Open_plantilla(text){
        
        $('#editor').html('');
        //$("#descripcion").val('');
        $('#editor').focus();
        document.execCommand("inserthtml", null, $("#descripcion").val());
        $("#descripcion").val($("#descripcion").val());

        var URL = '/herramientas/refreshdoc/<?= $_GET[p1] ?>/';
        data = "";
        $.ajax({
            dataType: "json",
            url: URL,
            data: data,
            success: function(msg){
                
                $(".abogado").text(msg['abogado']);
                $(".ciudadabogado").text(msg['ciudadabogado']);
                $(".cedulaabogado").text(msg['cedulaabogado']);
                $(".tarjetaprofesional").text(msg['tarjetaprofesional']);
                $(".universidad").text(msg['universidad']);
                $(".direccionabogado").text(msg['direccionabogado']);
                $(".telefonoabogado").text(msg['telefonoabogado']);
                $(".emailabogado").text(msg['emailabogado']);
                $(".titulo").text(msg['titulo']);
                $(".valornumero").text(msg['valornumero']);
                $(".valorletras").text(msg['valorletras']);
                $(".naturalezaproceso").text(msg['naturalezaproceso']);
                $(".fechapresentacion").text(msg['fechapresentacion']);
                $(".radicado").text(msg['radicado']);
                $(".juzgado").text(msg['juzgado']);
                $(".entidad").text(msg['entidad']);
                $(".direccionentidad").text(msg['direccionentidad']);
                $(".telefonoentidad").text(msg['telefonoentidad']);
                $(".ciudadentidad").text(msg['ciudadentidad']);
                $(".nombredemandante").text(msg['nombredemandante']);
                $(".identificaciondemandante").text(msg['identificaciondemandante']);
                $(".expedicionidentificaciondemandante").text(msg['expedicionidentificaciondemandante']);
                $(".telefonodemandante").text(msg['telefonodemandante']);
                $(".emaildemandante").text(msg['emaildemandante']);
                $(".direcciondemandante").text(msg['direcciondemandante']);
                $(".ciudaddemandante").text(msg['ciudaddemandante']);
                $(".INFORMACIONDEMANDANTES").text(msg['INFORMACIONDEMANDANTES']);
                $(".demandantesnotificacion").text(msg['demandantesnotificacion']);
                $(".representantelegaldemandante").text(msg['representantelegaldemandante']);
                $(".ciudadrepresentantelegaldemandante").text(msg['ciudadrepresentantelegaldemandante']);
                $(".nombredemandado").text(msg['nombredemandado']);
                $(".identificaciondemandado").text(msg['identificaciondemandado']);
                $(".expedicionidentificaciondemandado").text(msg['expedicionidentificaciondemandado']);
                $(".telefonodemandado").text(msg['telefonodemandado']);
                $(".emaildemandado").text(msg['emaildemandado']);
                $(".direcciondemandado").text(msg['direcciondemandado']);
                $(".ciudaddemandados").text(msg['ciudaddemandados']);
                $(".INFORMACIONDEMANDADOS").text(msg['INFORMACIONDEMANDADOS']);
                $(".demandadosnotificacion").text(msg['demandadosnotificacion']);
                $(".representantelegal").text(msg['representantelegal']);
                $(".ciudadrepresentantelegal").text(msg['ciudadrepresentantelegal']);
            alert("Documento Actualizado")

            }
        }); 
    }
    
    $(document).ready(function(){

        Open_plantilla();

    })

</script>


<?
    }
?>