<script src="<?= ASSETS ?>/js/editor.js"></script>
<script src="<?= ASSETS ?>/styles/editor.css"></script>
<div id="left-content-bar">	
	<div id="title-plantilla">PLANTILLAS</div>

	<?
            $object2 = new MPlantilla;
            $query2 = $object2->ListarPlantilla("WHERE def = 'No' and user_id = '".$_SESSION['usuario']."'");    

            echo '<div class="item-plantilla" onClick="ShowPlants(\'plant_fav\')"><b>Mis Plantillas</b></div>';
            echo '<div id="plant_fav" class="showplant">';
            while($row = $con->FetchAssoc($query2)){
                $ln = new MPlantilla;
                $ln->Createplantilla('id', $row[id]);
                ?>
                    <div class="item-plantilla" onclick="view_plantilla(<?=$row[id]?>,this)"><?php echo $ln->GetNombre(); ?></div>
                <?
                
            }
            echo '</div>';

    $query2 = $object2->ListarPlantilla("WHERE def = 'Si'", "group by t_plantilla");    

    while($row = $con->FetchAssoc($query2)){
        $l = new MPlantilla;
        $lq = $l->ListarPlantilla("WHERE t_plantilla = '".$row['t_plantilla']."' and def='Si' ");

        echo '<div class="item-plantilla" onClick="ShowPlants(\'plant_'.$row["t_plantilla"].'\')"><b>Plantillas Genericas de: '.$row["t_plantilla"].'</b></div>';
        echo '<div id="plant_'.$row["t_plantilla"].'" class="showplant active">';
        while ($rx = $con->FetchAssoc($lq)) {
            $ln = new MPlantilla;
            $ln->Createplantilla('id', $rx[id]);
            ?>
                <div class="item-plantilla" onclick="view_plantilla(<?=$rx[id]?>,this)"><?php echo $ln->GetNombre(); ?></div>
            <?
        }
        echo '</div>';
    }
	?>
	
</div>
<div id="right-content">
	<div id="summernote"></div>
    <div id="text-summernote">Nombre: <input type="text" id="name-summernote"></div>
	<div id="button2-summernote" onclick="new_plantilla()">Nuevo</div>
	<div id="button-summernote" onclick="save_plantilla()">Guardar</div>
	<input type="hidden" id="id-summernote" value="0">

    <textarea id="textarea" class="richtextbox" name="a" style="width:900px;height:450px"></textarea>
</div>
<script>
$(document).ready(function() {
/*
  $('#summernote').summernote({
		toolbar: [
			['style', ['fontname', 'bold', 'italic', 'underline']],
			['para', ['ul', 'ol', 'paragraph']],
		],
		onChange: function(contents, $editable) {
    		var a=$editable.replace(/(<([^>]+)>)/ig,"").replace('&nbsp;','').replace('↵','').split(' ');
            console.log($editable);
    		if ($.inArray('::', a) > 0) {
    		}; 
  		}
	});

});
function insertTextAtCursor(text) {
    var sel, range, html;
    if (window.getSelection) {
        sel = window.getSelection();
        if (sel.getRangeAt && sel.rangeCount) {
            range = sel.getRangeAt(0);
            range.deleteContents();
            range.insertNode( document.createTextNode(text) );
        }
    } else if (document.selection && document.selection.createRange) {
        document.selection.createRange().text = text;
    }
}
function  getCaretPosition()
{
    if (window.getSelection && window.getSelection().getRangeAt)
    {
            var range = window.getSelection().getRangeAt(0);
            var selectedObj = window.getSelection();
            var rangeCount = 0;
            var childNodes = selectedObj.anchorNode.parentNode.childNodes;
            for (var i = 0; i < childNodes.length; i++)
            {
                if (childNodes[i] == selectedObj.anchorNode)
                {
                        break;
                    }
                        if(childNodes[i].outerHTML)
                        {
                rangeCount += childNodes[i].outerHTML.length;
            }
            else if(childNodes[i].nodeType == 3)
            {
                            rangeCount += childNodes[i].textContent.length;                       
            }
        }
        return range.startOffset + rangeCount;
    }
    return -1;
}
$.fn.selectRange = function(start, end) {
    if(!end) end = start;
    return this.each(function() {
        if (this.setSelectionRange) {
            this.focus();
            this.setSelectionRange(start, end);
        } else if (this.createTextRange) {
            var range = this.createTextRange();
            range.collapse(true);
            range.moveEnd('character', end);
            range.moveStart('character', start);
            range.select();
        }
    });
};
$(document).click(function(e){  
    if(e.button == 0){  
        $('#menu').css("display", "none");  
    }  
});   
$(document).keydown(function(e){  
    if(e.keyCode == 27){  
        $('#menu').css("display", "none");  
    }  
}); 
function view_plantilla(id,div){
    $.ajax({
        url:'/herramientas/plantilla/'+id+'/',
        success:function(msg){
            var data = eval('('+msg+')');
            $('#summernote').code(data['content']);
            $('#id-summernote').val(id);
            $('.item-plantilla').removeClass('active');
            $(div).addClass('active');
            $('#name-summernote').val(data['name']);
        }
    })
}
function save_plantilla(){
    var obj ={  str:$('#summernote').code(),
                idplant:$('#id-summernote').val(),
                name:$('#name-summernote').val()};
    $.ajax({
        type:'POST',
        url:'/herramientas/save_plantilla/',
        data:obj,
        success:function(msg){
            $('#left-content-bar').html(msg);
        }
    })
}
function new_plantilla(){
    $('#summernote').code('');
    $('#id-summernote').val(0);
    $('.item-plantilla').removeClass('active');
    $('#name-summernote').val('');
}
*/
</script>       
