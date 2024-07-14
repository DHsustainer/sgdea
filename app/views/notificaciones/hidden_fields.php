<div style="display: none">
    <textarea class="form-control required" type='text' name='observacion' id='observacion' placeholder="Asunto" style="height:50px" <?= $c->Ayuda('33', 'tog') ?>></textarea>
    <?
        $city = $con->Query("Select id_tabla from  usuarios_configurar_accesos where user_id = '".$_SESSION['usuario']."' and tabla = 'city'");
        $d = $con->FetchAssoc($city);
        $city = $d['id_tabla'];
    ?>
    <input  class="form-control" type='text' name="ciudad" id="ciudad" value="<?= $city ?>" />
    <input  class="form-control" type='text' name="oficina" id="oficina" value="<?= $u->GetSeccional() ?>" />
    <input  class="form-control" type='text' name="dependencia_destino" id="dependencia_destino" value="<?= $u->GetRegimen() ?>" />
    <input  class="form-control" type='text' name="nombre_destino" id="nombre_destino" value="<?= $u->GetA_i() ?>" />
    <select class="form-control important " id="id_dependencia_raiz" name="id_dependencia_raiz"   >
        <?
            $s = new MDependencias;
            $q = $s->ListarDependencias(" where dependencia = '0' and id_version = '".$_SESSION['id_trd_empresa']."'");
            while ($row = $con->FetchAssoc($q)) {
                echo "<option value='".$row['id']."'> ".$row['nombre']."</option>";
            }
        ?>
    </select>
    <select class="form-control required " id="tipo_documento" name="tipo_documento"  <?= $c->Ayuda('44', 'tog') ?>>
        <option value="">Seleccione una Sub-Serie</option>
        <?
            $qs = $con->Query("SELECT *,(select nombre from dependencias where id = areas_dependencias.id_dependencia_raiz) as nd,(select nombre from dependencias where id = areas_dependencias.id_dependencia) as ndd FROM areas_dependencias WHERE id_area = '38' and id_dependencia_raiz = '1' order by id limit 1000");

            while ($ror = $con->FetchAssoc($qs)) {
                echo "<option value='".$ror['id_dependencia']."'>".$ror['ndd']."</option>";
            }
        ?>
    </select>

    <label for="generar_notificacion">¿Generar Formato de Notificación?</label>
    <select class="form-control" name='generar_notificacion' id='generar_notificacion' >
        <option value="">Seleccione una Opción</option>
        <option value="S">SI</option>
        <option value="N">NO</option>
    </select>
    <script>    
        $(document).ready(function() {

            $("#id_dependencia_raiz").change(function(){
                dependencia_item2('dependencia_destino', 'id_dependencia_raiz','tipo_documento', '/areas_dependencias/GetSubSeriesArea/');
                setTimeout(function(){
                    if($("#tipo_documento").val() != "" && $("#tipo_documento").val()  != "Seleccione una Sub-Serie"){
                        $("#tipo_documento").change();
                    }
                }, 1000);
            });
        });
    </script>       

    <input type="text"  name="documento_salida" id="documento_salida" value="N">
    <input type="text"  name="es_externo" id="es_externo" value="NO">
    <input type="text"  name="g_id" id="g_id" value="N">
    <select name="autorad" id="autorad"><option value="SI">SI</option></select>
    <input type='text' name='folio' id='folio' placeholder="Numero de Folios:" maxlength='3' />
    <input type='text' name='num_oficio_respuesta' id='num_oficio_respuesta' placeholder="Número de Radicado Interno"/>
    <input type='text' name='num_oficio_respuesta_hid' id='num_oficio_respuesta_hid' maxlength='100' />
    <input type='text' name='anho_rad' id='anho_rad' value="<?= date('Y-') ?>" maxlength='100' />                           
    <input type='text' name='f_recibido' id='f_recibido' placeholder="Fecha de Recibido:" value="<?= date('Y-m-d') ?>" />
    <input type='text' name='fecha_vencimiento' id='fecha_vencimiento' placeholder="Fecha de Vencimiento Respuesta:" />
    <input type='text' name='prioridad' id='prioridad' placeholder="Fecha de Vencimiento Respuesta:" value="1" />
    <input type='text' name='estado_solicitud' id='estado_solicitud' placeholder="estado de la solicitud" value="1" />
    <input type='text' name='nombre_radica' id='nombre_radica' placeholder="Nombre de quien radica:" />
    <select name="estado_respuesta" id="estado_respuesta"><option value="Abierto">Abierto</option></select>
    <input type='text' name='fecha_respuesta' id='fecha_respuesta' placeholder="Fecha_respuesta:" />
    <input type='text' name='usuario_registra' id='usuario_registra' placeholder="Usuario_registra:" value="<?= $_SESSION['usuario'] ?>" />
    <input type='text' name='estado_archivo' id='estado_archivo' placeholder="Estado_archivo:" value="1" />
    
    <br><?$cy = new MCity;$cy->CreateCity("code", $_SESSION['ciudad']);?>
    <input type='text' id='mydpto' value="<?= $cy->GetProvince() ?>" />
    <input type='text' id='mycity' value="<?= $cy->GetCode() ?>" />
    <input type="text" value="<?= HOMEDIR.DS."app/plugins/thumbnails/".$u->GetFirma(); ?>" name="firma_abogado" id="firma_abogado">
    <input type="text" value="<?= $u->GetId(); ?>" name="cedula_abogado" id="cedula_abogado">

</div>