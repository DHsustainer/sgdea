<link href="<?=ASSETS?>/styles/bootstrap.css" rel="stylesheet">
<div id="form">
    <table class="tbd">
        <tr>
            <td style="width:58%">
                <div id="crear-nota" class="left table">
                    <?php if ($_SESSION[usuario]==$_SESSION[sadminid] || $_SESSION[sadmin]!=1): ?>
                    <?
                        if ($_SESSION['folder'] == '') {
                    ?>
                    <form action="/caratula/opcion/<?=$_GET[id]?>/actuaciones/" method="POST">
                        <div class="title">Creación de Actuación</div>
                        <input type="text" placeholder="Actuación" class="form-control" name="form-control" id="title_nota">
                        <input type="text" placeholder="Fecha" class="fecha_act" name="fecha_act" id="fecha_act">
                        <select class="alerta_act" name="alerta_act" id="alerta_act">
                            <optgroup label="Recordarme sobre esta actuacion">
                                <!--<option value="0">Recordarme sobre esta actuacion</option> -->
                                
                        <?

                            global $au;

                            $GetAlertas = $au->ListarAlertas_usuariosByType("2");
                            while ($row = $con->FetchAssoc($GetAlertas)) {
                                echo "<option value='".$row["dias"]."'>".$row["titulo"]."</option>";
                            }

                        ?>
                            </optgroup>
                        </select>
                        <input type="submit" value="Guardar" style="margin:10px;">
                    </form> 
                    <?  
                        }
                    ?>
                    <?php endif ?>
                    
                </div>
            </td>
            <td rowspan="2" style="width:40%">
                <div class="title right">Actuaciones</div>
                <div class="table">
                    <table style="width:100%">
                        <?
                            if ($_SESSION[usuario]==$_SESSION[sadminid] || $_SESSION[sadmin]!=1) {
                                if ($_SESSION['folder'] == '') {
                                    $path = "<th style='width:20px' class='th_act'></th>";
                                }
                            }
                        ?>
                        <tr>
                            <th class="th_act">Actuación</th>
                            <th class="th_act" style="width: 100px">Fecha</th>
                            <?= $path; ?>
                        </tr>
                        <?
                            
                            global $con;
                            $a = new MActuaciones;
                            $q = $a->ListarActuaciones("WHERE proceso_id = '".$proceso[id]."'");

                            while ($r = $con->FetchAssoc($q)) {
                                if ($_SESSION[usuario]==$_SESSION[sadminid] || $_SESSION[sadmin]!=1) {
                                    if ($_SESSION['folder'] == '') {
                                        $links  ="  <td>
                                                        <div onClick='EliminarActuaciones(\"".$r['id']."\")'>
                                                            <div class='btn btn-warning btn-circle mdi mdi-delete' title='eliminar'></div>
                                                        </div>
                                                    </td>";
                                    }
                                }
                                echo    '
                                            <tr id="r'.$r['act'].'">
                                                <td>'.$r['act'].'</td>
                                                <td>'.$r['fecha'].'</td>
                                                '.$links.'
                                        ';

                                echo    '   </tr>';
                            }

                        ?>
                        
                    </table>
                </div>
                
                
            </td>
        </tr>
    </table>
</div>
<script type="text/javascript">
    $(document).ready(function() {

        $('.fecha_act').datepicker({
            dateFormat: 'yy-mm-dd',
        });
    })

function EliminarActuaciones(id){
    if(confirm('Esta seguro desea eliminar esta actuacion?')){
        var URL = '/actuaciones/eliminar/'+id+'/';
        $.ajax({
            type: 'POST',
            url: URL,
            success: function(msg){
                alert("Actuacion Eliminada");
                window.location.reload();
            }
        });
    }
}   
</script>       