<div id="form" class="white">
    <h4 class="title">Crear Notificación</h4>
    <form action="" method="POST">        
        <div class="form-item">
    		<span class="title-item">Título </span>
    		<div class="input-item"><input type="text" name="titulo"></div>	
    	</div>
    	<div class="form-item">
    		<span class="title-item">Notificado </span>
    		<div class="input-item"><select name="demandado"><option></option><?=$demandado?></select></div>	
    	</div>
    	<div class="form-item">
    		<span class="title-item">Comparecer en </span>
    		<div class="input-item"><input type="text" name="comparecer"></div>	
    	</div>
    	<div class="form-item">
    		<span class="title-item">Dirección </span>
    		<div class="input-item"><select name="direccion" id="direccion"></select></div>	
    	</div>
        <?php if ($_SESSION[usuario]==$_SESSION[sadminid] || $_SESSION[sadmin]!=1): ?>
        <input type="submit" name="guardar" value="guardar">    
        <?php endif ?>
        
    </form>
</div>
<div id="form" class="white">
    <h4 class="title">Lista de Notificaciones</h4>
    </form>
</div>