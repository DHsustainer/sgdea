<div style="display:inline-block; width:48%; background:#FFF;">
        <div class="title">Crear Correspondencia</div>
        <br>
        <table border="0" style="width:100%" cellpadding="4"> 
        <form action="" method="POST">
    <?
        $demandado;
        global $c;

        $pid = $c->sql_quote($_REQUEST['id']);
        $usuario = $_SESSION['usuario']; 

        $me = new MUsuarios;
        $me->CreateUsuarios("user_id", $_SESSION['usuario']);

        $usuario_nombre = strtolower($me->GetP_nombre()." ".$me->GetP_apellido());
    ?>
            <tr>
                <td>
                    <input type="text" style="width: 185px;"id="remitente" placeholder ="Remitente Ej: <?= $usuario_nombre; ?>" name="remitente" class="important">
                </td>
                <td>
                    <select style="width:200px;" name="spostal" id="spostal"class="important">
                        <option>Servicio Postal Autorizado</option>
                        <?
                            global $con;
                            $q = $con->Query("select * from servicio_postal");

                            while ($row = $con->FetchAssoc($q)) {

                                echo "<option value='".$row['id']."'>".$row['nom']."</option>";
                            }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td style="width:50px" align="left">
                    <select style="width:200px;" name="titulo" id="titulo" class="important">
                        <option>Seleccione un tipo de Correspondencia</option>
                            <option value="CC">Correo Certificado</option>
                            <option value="315">Notificacion Personal</option>
                            <option value="320">Notificacion Por Aviso</option>
                            <option value="POL">Gestionar Poliza</option>
                    </select>
                </td>
                <td style="width:50px" align="left">
                    <select style="width:200px;" name="demandado" id="demandado" onChange="DependenciaDireccionesDemandados()"class="important">
    <?

                        echo "<option value='-'>Seleccione un Destinatario</option>";
                            echo "<optgroup label='Entidad'>";
                            #PANEL PARA ENTIDAD
                            $q_str = "SELECT * FROM caratula WHERE id= '".$pid."'";
                            $query = $con->Query($q_str);
                            $npid = $con->Result($query, 0, 'proceso_id');
                                echo "<option value='".$pid."@@ENT'>".$con->Result($query, 0, 'juzgado')."</option>";
                            echo "</optgroup>";
                        #PANEL PARA DEMANDANTES
                        $str = "select * from demandante_proceso_juridico where proceso_id = '".$npid."' and user_id = '".$usuario."' ";
                        $que =  $con->Query($str);
                            echo "<optgroup label='Clientes'>";
                                while($rox = $con->FetchAssoc($que)){
                                    echo "<option value='".$rox["id"]."@@DTE'>".$rox["nom_entidad"]."</option>";
                                }
                            echo "</optgroup>";
                        #PANEL PARA DEMANDADOS
                        $str = "select * from demandado_proceso where proceso_id = '".$npid."' and user_id = '".$usuario."'";
                        $que =  $con->Query($str);
                            echo "<optgroup label='Contraparte'>";
                                while($rox = $con->FetchAssoc($que)){
                                    echo "<option value='".$rox['id']."@@DDO'>".$rox["p_nombre"]." ".$rox["p_apellido"]."</option>";
                                }
                            echo "</optgroup>";
                        
                        #PANEL PARA OTROS CONTACTOS
                        $str = "select * from contactos inner join contactos_direccion on contactos_direccion.contacto_id = contactos.id where proceso_id = '".$pid."' and user_id = '".$usuario."'";
                        $que =  $con->Query($str);
                            echo "<optgroup label='Otros Contactos'>";
                                while($rox = $con->FetchAssoc($que)){
                                    echo "<option value='".$rox['id']."@@OC'>".$rox["nombre"]." ".$rox["apellido"]."</option>";
                                }
                            echo "</optgroup>";
                        echo "</select>";
    ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <select style="width:200px;" name="comparecer" id="comparecer">
                        <option>Días para Comparecer</option>
                        <option value="0">No Comparecer</option>
                        <option value="1">De Inmediato</option>
                        <option value="5">5 Días</option>
                        <option value="10">10 Días</option>
                        <option value="30">30 Días</option>
                    </select>
                    <input type="hidden" id="nom_destinatario" name="nom_destinatario">
                </td>
                <td>
                    <select style="width:200px;" name="direccion" id="direccion" disabled="disabled"class="important">
                        <option>Seleccione una Direccion</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td align="left" colspan="2">
                    <textarea name="dcontenido" id="dcontenido" cols="15" rows="4" style="height:40px; width:400px" placeholder="Describa en 140 Caracteres el Contenido"></textarea>
                </td>
            </tr>
            <tr>
                <td>
                    <?php if ($_SESSION[usuario]==$_SESSION[sadminid] || $_SESSION[sadmin]!=1): ?>
                        <input type="submit" name="guardar" value="Enviar Correspondencia">    
                    <?php endif ?>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <div id="list">
                        <div class="mailer_new_element" style="display:none">
                              <input type="hidden" id="anexos_listado" name="anexos_listado">
                              <input type="hidden" id="archivos_anexos_listado" name="archivos_anexos_listado">
                              <input type="hidden" id="titulos_anexos_listado" name="titulos_anexos_listado">
                              <ul id="listado_anexos">
                              </ul>                  
                        </div>
                        <div id="listfiles">
                    <?php 

                        $viewer = array (   ".doc" => "google"  , "docx" => "google"    , ".zip" => "google"    ,   ".rar" => "google"  , 
                                            ".tar" => "google"  , ".xls" => "google"    , "xlsx" => "google"    ,   ".ppt" => "google"  , 
                                            ".pps" => "google"  , "pptx" => "google"    , "ppsx" => "google"    ,   ".pdf" => "google"  ,
                                            ".txt" => "google"  , ".jpg" => "image"     , "jpeg" => "image"     ,   ".bmp" => "image"   , 
                                            ".gif" => "image"   , ".png" => "image"     , ".dib" => "image"     ,   ".tif" => "image"   , 
                                            "tiff" => "image"   , "mpeg" => "video"     , ".avi" => "video"     ,   ".mp4" => "video"   ,
                                            "midi" => "audio"   , ".acc" => "audio"     , ".wma" => "audio"     ,   ".ogg" => "audio"   , 
                                            ".mp3" => "audio"   , ".flv" => "video"     , ".wmv" => "video"     );
                    ?>  
                            <div id="cargar_listas_demandas" class="scrollable">
                                <div align="center" style="border:0px solid #333;">
                                    <div id="laderdata">
                                        <div class="titulo" align="left" style="margin-bottom: 5px;">Adjuntar Documentos</div>
                            <?php
                                $sql = "SELECT * FROM anexos WHERE user_id= '".$_SESSION['usuario']."' AND proceso_id = '".$con->Result($query, 0, 'proceso_id')."' order by id desc";
                                $query_sql = $con->Query($sql);
                                        
                                for( $i=0;$i<$con->NumRows($query_sql);$i++ ){
                                    $imid = $con->Result($query_sql, $i, 'id');

                                    $file = $con->Result($query_sql, $i, 'nom_img');
                                    #$ruta = "archivos_uploads/anexos/".$usuario."/".$file."";
                                    $ruta = "app/archivos_uploads/".$usuario.trim(" /anexos/").$file;
                                    $cadena_nombre = substr($file,0,200);
                                    $extension = substr($cadena_nombre, strlen($cadena_nombre)-4, strlen($cadena_nombre));  

                                    $URL = "archivos_uploads/".$usuario.trim(" /anexos/ ").$file;
                                    $titulo = $con->Result($query_sql, $i, 'nom_palabra');
                ?>
                                        <div id='<?= $imid ?>' title="<?= $title ?>" >
                                            <div  class="main_elm" title="<?= $title ?>" style="background: url(<?= $extensiones[$extension] ?>) no-repeat; background-size:<?= $size[$extension] ?>; background-position:center left">
                                                <div class="check_elm" title="<?= $title ?>" >
                                                    <input type="checkbox" alt="<?= $URL ?>" id="a<?= $con->Result($query_sql, $i, 'id') ?>" value="<?= $con->Result($query_sql, $i, 'id') ?>" class="active_check" title="<?= $titulo ?>" />
                                                </div>
                                                <div class="title_elm" title="<?= $title ?>" onclick="AbrirDocumento('<?= $ruta ?>','<?= $viewer[$extension] ?>','<?= $titulo ?>')">
                                                    <?= substr($titulo, 0, 25); ?>
                                                </div>
                                            </div>
                                        </div> 
                <?
                                }
                ?>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </td>
            </tr>
        </form>
        </table>
    </div>    