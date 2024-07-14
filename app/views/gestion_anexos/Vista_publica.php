<?
    $qer = $con->Query("select * from gestion_anexos where id_servicio = '".$_SESSION['smallid']."'");
    while ($rs = $con->FetchAssoc($qer)) {

        echo '  <div class="list-group-item" id="elm_"'.$rs["id"].'">
                    <div class="row" style="padding:0px; margin:0px">
                        <div class="col-md-6 p-t-10" style="padding-right:5px; padding-left:5px;">
                            <input type="hidden" name="C_F_'.$rs["id"].'" id="elm'.$rs["id"].'" value="'.$rs["id"].'">
                            <input type="hidden" name="servicios2[]" id="servicios2_'.$rs["id"].'" value="">
                            <button style="display:none; float:left; line-height:20px; margin-right:5px" title="Documento Cargado" type="button" id="myanexosuc'.$rs['id'].'" class="btn btn-success fa fa-check"></button>

                            <button style="float:left" type="button" id="myanexo'.$rs['id'].'" class="btn btn-info">
                                <span class="fa fa-search"></span> Buscar Documento
                            </button>
                            <button style="display:none" type="button" id="enviarbotonanexo'.$rs['id'].'" class="btn btn-success">
                                <span class="fa fa-upload"></span> Cargando Archivo...
                            </button>

                            <input type="hidden" id="mylist'.$rs['id'].'" value="'.$rs['id'].'">
                            <script type="text/javascript">
                                $("#myanexo'.$rs['id'].'").click(function() {
                                    $(".selfileanexo").click();
                                    $("#fmidanexo").html("'.$rs['id'].'")
                                });
                                $("#enviarbotonanexo'.$rs['id'].'").click(function(){
                                    $("body").css("cursor", "wait");
                                    $("#sendfilesanexo").submit();
                                })
                            </script>
                        </div>
                        <div class="col-md-6" style="padding-top:10px !important">
                            <input type="text" name="N_F_'.$rs['id'].'" id="elmNF'.$rs['id'].'" class="filename form-control" onChange="ChangeNameFile(\''.$rs['id'].'\')" placeholder="Nombre del Documento" />
                        </div>
                    </div>
                </div>';
    }
?>
<div style="display: none">
    <p><strong>Upload Files:</strong>
        <form method="post" id="sendfilesanexo" enctype="multipart/form-data"> 
            <input type="file" name="pictures[]" id="pictures[]" class="selfileanexo" onChange="makeFileListAnexo();" />
        </form>
    </p>
    <ul id="fileListAnexo"><li>No Files Selected</li></ul>
    <div id="output1anexo"></div>   
    <div id="fmidanexo">id</div>
    <div class="progress">
        <div class="bar"></div>
        <div class="percent">0%</div>
    </div>
</div>
<script src="<?= HOMEDIR.DS ?>/app/plugins/malsup/jquery.form.js"></script> 
<script>
    $(document).ready(function() { 
        var options = { 
            target:        '#output1anexo',      // target element(s) to be updated with server response 
            beforeSubmit:  showRequest,    // pre-submit callback 
            success:       showResponse,  // post-submit callback 
            // other available options: 
            url:       "/gestion_anexos/uploadanexopublico/",   // override for form's 'action' attribute 
            type:      "POST",        // 'get' or 'post', override for form's 'method' attribute 
            //dataType:  null        // 'xml', 'script', or 'json' (expected server response type) 
            clearForm: true,        // clear all form fields after successful submit 
            resetForm: true        // reset the form after successful submit 
             // $.ajax options can be used here too, for example: 
            //timeout:   3000 
        }; 
        // bind form using 'ajaxForm' 
        $('#sendfilesanexo').ajaxForm(options); 
    }); 
    // pre-submit callback 
function showRequest(formData, jqForm, options) { 
        // formData is an array; here we use $.param to convert it to a string to display it 
        // but the form plugin does this for you automatically when it submits the data 
    var queryString = $.param(formData); 
        // jqForm is a jQuery object encapsulating the form element.  To access the 
        // DOM element for the form do this: 
        // var formElement = jqForm[0]; 
    //alert('About to submit: \n\n' + queryString); 
        // here we could return false to prevent the form from being submitted; 
        // returning anything other than false will allow the form submit to continue 
    return true; 
} 
// post-submit callback 
function showResponse(responseText, statusText, xhr, $form)  { 
    // for normal html responses, the first argument to the success callback 
    // is the XMLHttpRequest object's responseText property 
    // if the ajaxForm method was passed an Options Object with the dataType 
    // property set to 'xml' then the first argument to the success callback 
    // is the XMLHttpRequest object's responseXML property 
    // if the ajaxForm method was passed an Options Object with the dataType 
    // property set to 'json' then the first argument to the success callback 
    // is the json data object returned by the server 
    //alert('status: ' + statusText + '\n\nresponseText: \n' + responseText); 
    $("#elm"+$("#fmidanexo").text()).val(responseText);
    var imagenes = responseText.split(";");
    var partes = responseText.split("|");
    var mylist = $("#mylist"+$("#fmidanexo").text()).val();
    $("#minilista"+$("#fmidanexo").text()).html(imagenes.length+" Documentos Cargados");
    $("body").css("cursor", "default");
    $("#elmNF"+$("#fmidanexo").text()).val(partes[10]);
    $("#servicios2_"+$("#fmidanexo").text()).val($("#fmidanexo").text());
    //alert(responseText +" => " + partes[10]);
    str = "valor="+responseText+"&id="+$("#fmidanexo").text()+"&nombre="+partes[10];
    $.ajax({
        type: "POST",
        url: "/gestion_anexos/actualizarpublico/",
        data: str,
        success:function(msg){
            $("#output1anexo").html(responseText+"<hr>"+msg)
            var mylist = $("#fmidanexo").text();
            $("#enviarbotonanexo"+mylist).css("display", "none");

            //$("#mydiv"+mylist).html("<em style='padding-top:10px !important'>Documento Cargado...</em>");
            $("#myanexosuc"+mylist).css("display", "block");
            $("#myanexo"+mylist).css("display", "block");
            $("#myanexo"+mylist).html('<span class="fa fa-search"></span> Volver a Cargar');

            result = msg;
            //$("#update_field").html("<div class='alert alert-info'>"+result+"</div>");
        }
    });
}   
function makeFileListAnexo() {
        var input = document.getElementById("pictures[]");
        var cont = 0;
    //    alert("Cargando Documentos, por favor espere un momento");
        var milistado = "innerlista"+$("#fmidanexo").text();
        var ul =   document.getElementById("fileListAnexo");
        var minl = document.getElementById(milistado);
        
        var mylist = $("#fmidanexo").text();
        $("#myanexo"+mylist).css("display", "none");
        $("#enviarbotonanexo"+mylist).css("display", "block");

        setTimeout(function(){
            $("#enviarbotonanexo"+mylist).click();
        }, 1000);

        while (ul.hasChildNodes()) {
            ul.removeChild(ul.firstChild);
        }
        for (var i = 0; i < input.files.length; i++) {
            cont++;
            var li = document.createElement("li");
            li.innerHTML = input.files[i].name;
            ul.appendChild(li);
        }
        if(!ul.hasChildNodes()) {
            var li = document.createElement("li");
            li.innerHTML = 'No Files Selected';
            ul.appendChild(li);
        }
        //while (minl.hasChildNodes()) {
        //    minl.removeChild(minl.firstChild);
        //}
        for (var i = 0; i < input.files.length; i++) {
            cont++;
            var li = document.createElement("li");
            li.innerHTML = input.files[i].name;
            minl.appendChild(li);
        }
        if(!minl.hasChildNodes()) {
            var li = document.createElement("li");
            li.innerHTML = 'No Files Selected';
            minl.appendChild(li);
        }
        $("#num").html(cont);
        
    }

    function ChangeNameFile(id){
        
        $.ajax({
            type: "POST",
            url: "/gestion_anexos/actualizarnombreanexo/"+id+"/"+$("#elmNF"+id).val()+"/",
            success:function(msg){
            }
        });

    }
</script>