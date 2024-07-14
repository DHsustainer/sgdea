<div id="form" class="white" style="margin-bottom:20px;padding-bottom: -bottom:20px;">
    <h4 class="title">Compartir Proceso</h4>
    <?  # print_r($_SESSION) ?>
    <form action="/caratula/opcion/<?=$_GET[id]?>/transferir/" method="POST">
    	<div class="form-item">
    		<span class="title-item">Compartir Con </span>
    		<div class="input-item" id='field_share'>
                <select name="compartir" id="compartir">
                        <option value="">Seleccione un usuario</option>
                        <?
                            $s= $con->Query("select user_id, p_nombre, p_apellido from usuarios where id_empresa = '".$_SESSION['id_empresa']."'"); 
                            while ($xrow = $con->FetchAssoc($s)) {
                                echo '<option value="'.$xrow['user_id'].'">'.$xrow['p_nombre'].' '.$xrow['p_apellido'].'</option>';
                            }
                        ?>
                        <option value="Other">Transferir a otro usuario</option>
                    </select>
                    <script>
                        $("#compartir").on('change', function() {
                            if ($(this).val() == "Other") {
                                $("#field_share").html("<input type='text' id='compartir' name='compartir' placeholder='Escriba el nombre de usuario (email) del usuario a transferir' >");
                            }
                        });
                    </script>
            </div>	
    	</div>
    	<div class="form-item">
    		<input type="hidden" name="proceso_id" value="<?=$_GET[id]?>">
    		<input type="submit" name="submit" Value="Compartir">	
    	</div>
        <div id="shared_list">
            <?
                global $obj;
                $obj->CreateCaratula("id", $_GET['id']);

                $t = new MCompartir;
                $l = $t->ListarCompartir("WHERE proceso_id = '".$obj->GetProceso_id()."' and user_id = '".$_SESSION['usuario']."'");

                echo '<table width="100%" cellpadding="0" cellspacing="0">
                        <tr>
                            <th class="title" colspan="2">Compartiendo proceso con:</th>
                        </tr>';

                while ($rw = $con->FetchAssoc($l)) {
                    $sus = new MUsuarios;
                    $sus->CreateUsuarios("user_id", $rw["compartir"]);
                    echo '  <tr id="r'.$rw['id'].'" class="tblresult">
                                <td  id="u'.$rw['id'].'"> '.$sus->GetP_nombre().' '.$sus->GetP_apellido().' <em>('.$rw["compartir"].')</em></td>
                                <td align="right"><a style="cursor:pointer" onclick="EliminarCompartir(\''.$rw["id"].'\')"><b>Dejar de Compartir</b></a></td>           
                            </tr>';
                }
                echo '</table>';
            ?>
            <?=$error?>
            
        </div>
    </form>
    <h4 class="title">Transferir Proceso</h4>
    <form action="/caratula/ver/<?=$id?>/" method="POST">
        <div class="form-item">
            <span class="title-item">Trasnferir A </span>
            <div class="input-item" id="field_transfer">
                <select name="transferir" id="transferir">
                    <option value="">Seleccione un usuario</option>
                    <?
                        $s= $con->Query("select user_id, p_nombre, p_apellido from usuarios where id_empresa = '".$_SESSION['id_empresa']."'"); 
                        while ($xrow = $con->FetchAssoc($s)) {
                            echo '<option value="'.$xrow['user_id'].'">'.$xrow['p_nombre'].' '.$xrow['p_apellido'].'</option>';
                        }
                    ?>
                    <option value="Other">Transferir a otro usuario</option>
                </select>
                <script>
                    $("#transferir").on('change', function() {
                        if ($(this).val() == "Other") {
                            $("#field_transfer").html("<input type='text' id='transferir' name='transferir' placeholder='Escriba el nombre de usuario (email) del usuario a transferir' >");
                        }
                    });
                </script>
            </div> 
        </div>
        <div class="form-item">
            <input type="hidden" name="proceso_id" value="<?=$_GET[id]?>">
            <input type="submit" name="submit" Value="Transferir">  
        </div>
    </form>	
    <h4 class="title">Mover Proceso</h4>
    <form>
        <div class="form-item">
            <span class="title-item">Mover A </span>
            <div class="input-item">
                <select name="moverfolder" id="moverfolder">
                    <option value="">Selecciona una carpeta</option>
                </select>
            </div>    
        </div>
        <div class="form-item">
            <input type="hidden" name="proceso_id" value="<?=$_GET[id]?>">
            <input type="button" onClick="MoverProceso(<?= $_GET[id] ?>)" Value="Mover Proceso">  
        </div>
    </form> 
</div>
<script>
    var url = "<?= DS.'agenda'.DS.'listadocarpetas'.DS ?>";
    $("#ajax-l-folder").css("display", "inline-block");
    $.get(url,
        function(resultado){

            if(resultado != false){
                $("#moverfolder").attr("disabled",false);
                document.getElementById("moverfolder").options.length=1;
                $('#moverfolder').append(resultado);         
                $("#ajax-l-folder").css("display", "none");
            }
        }
    );      
</script>
<script>
    
    $('tr.tblresult:not([th]):even').addClass('par');
    $('tr.tblresult:not([th]):odd').addClass('impar');

    function EliminarCompartir(id){
        if(confirm('Esta seguro que desea dejar de compartir el proceso con:'+$("#u"+id).html())){
            var URL = '<?= HOMEDIR ?>/compartir/eliminar/'+id+'/';
            $.ajax({
                type: 'POST',
                url: URL,
                success: function(msg){
                    alert(msg);
                    if(msg == 'OK!')
                        $('#r'+id).slideUp();
                }
            });
        }
        
    }   
    function MoverProceso(fl){
        if(confirm('Esta seguro que desea cambiar la carpeta donde se encuentra este proceso?')){
            var id = $("#moverfolder").val();
            var URL = '<?= HOMEDIR ?>/caratula/mover/'+id+'/'+fl+'/';
            $.ajax({
                type: 'POST',
                url: URL,
                success: function(msg){
                    alert(msg);
                    window.location.href = '<?= HOMEDIR ?>/caratula/ver/'+id+'/ACTIVO/';
                }
            });
        }
        
    }
</script>