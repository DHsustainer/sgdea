<div id="form" class="white">
    <h4 class="title">Editar Proceso</h4>
    <form action="" method="POST"> 
        <div class="form-item">
    		<span class="title-item">Titulo de demanda </span>
    		<div class="input-item"><input type="text" name="titulo" value="<?=$proceso[tit_demanda]?>"></div>	
    	</div>
    	<div class="form-item">
    		<span class="title-item">Radicado simple </span>
    		<div class="input-item"><input type="text" name="rad" value="<?=$proceso[rad]?>"></div>	
    	</div>
        <?

#            print_r($proceso);


        ?>
    	<div class="form-item">
    		<span class="title-item">Juzgado</span>
    		<div class="input-item"><input type="text" name="juzgado" value="<?=$proceso[juzgado]?>"></div>	
    	</div>
    	<div class="form-item">
    		<span class="title-item">Radicado Completo </span>
    		<div class="input-item"><input type="text" name="rad_completo" value="<?=$proceso[rad_completo]?>"></div>	
    	</div>
    	<div class="form-item">
    		<span class="title-item">Direccion de juzgado</span>
    		<div class="input-item"><input type="text" name="dir_juzgado" value="<?=$proceso[dir_juz]?>"></div>	
    	</div>
    	<div class="form-item">
    		<span class="title-item">Fecha auto </span>
    		<div class="input-item"><input type="text" name="fec_auto" class="datepicker" value="<?=$proceso[fec_auto]?>"></div>	
    	</div>
    	<div class="form-item">
    		<span class="title-item">Telefono del juzgado</span>
    		<div class="input-item"><input type="text" name="tel_juzgado" value="<?=$proceso[tel_juz]?>"></div>	
    	</div>
    	<div class="form-item">
    		<span class="title-item">Numero de consignación </span>
    		<div class="input-item"><input type="text" name="num_obli" value="<?=$proceso[num_oficio]?>"></div>	
    	</div>
    	<div class="form-item">
    		<span class="title-item">Email del juzgado </span>
    		<div class="input-item"><input type="text" name="email_juz" value="<?=$proceso[email_juz]?>"></div>	
    	</div>
    	<div class="form-item">
    		<span class="title-item">Valor de la demanda </span>
    		<div class="input-item"><input type="text" name="valor" value="<?=$proceso[val_demanda]?>"></div>	
    	</div>
        <div class="form-item">
            <span class="title-item">Estado del Proceso </span>
            <div class="input-item">
                <select name="estado" id="estado">
                    <?
                        if ($proceso[est_proceso] == "ACTIVO") {
                            echo '<option value="ACTIVO">Activo</option>';
                            echo '<option value="ARCHIVADO">Archivar</option>';
                            echo '<option value="DESACTIVAR">Desactivar</option>';
                            echo '<option value="ELIMINAR">Eliminar</option>';
                        }
                        if ($proceso[est_proceso] == "ARCHIVADO") {
                            echo '<option value="ARCHIVADO">Archivado</option>';
                            echo '<option value="ACTIVO">Activar</option>';
                            echo '<option value="DESACTIVAR">Desactivar</option>';                            
                            echo '<option value="ELIMINAR">Eliminar</option>';
                        }
                        if ($proceso[est_proceso] == "DESACTIVAR") {
                            echo '<option value="DESACTIVAR">Desactivado</option>';
                            echo '<option value="ACTIVO">Activar</option>';
                            echo '<option value="ARCHIVADO">Archivar</option>';
                            echo '<option value="ELIMINAR">Eliminar</option>';
                        }
                        if ($proceso[est_proceso] == "ELIMINAR") {
                            echo '<option value="ELIMINAR">Eliminado</option>';
                            echo '<option value="ACTIVO">Activar</option>';
                            echo '<option value="DESACTIVAR">Desactivar</option>';
                            echo '<option value="ARCHIVADO">Archivar</option>';
                        }
                    ?>
                </select> 

            </div>   
        </div>
        <div class="form-item">
            <?=$msg?>   
        </div>
        <div class="form-item">  
        </div>
        <?php if ($_SESSION[usuario]==$_SESSION[sadminid] || $_SESSION[sadmin]!=1): ?>
            <input type="submit" value="guardar">
        <?php endif ?>
        
    </form>
</div>
<script type="text/javascript">
    $(document).ready(function() {

        $('.datepicker').datepicker({
            dateFormat: 'yy-mm-dd',
            monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio', 'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
            dayNames: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'], // For formatting
            dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'], // For formatting
            dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa'] // Column headings for days starting at Sunday                
        });
    })
</script>