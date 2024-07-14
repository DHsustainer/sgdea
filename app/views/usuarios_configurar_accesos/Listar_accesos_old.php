<?php 
include_once(MODELS.DS.'Usuarios_configurar_accesosM.php');
?>
<div id="contenido_bloque">
<ul id='listadonovedades'>
    
    <div class="encabezado">Ciudades</div>
	<?php

	$u = new MUsuarios_configurar_accesos;

    $ciudadusuario = $u->CiudadUsuario($object->GetSeccional());
    $oficinausuario = $object->GetSeccional();
    $areausuario = $object->GetRegimen();
    $a_iusuario = $object->GetA_i();
    $concatusuario = $a_iusuario.$areausuario. $oficinausuario;

    $query = $u->ListarCiudades($object->GetSeccional(),$object->GetUser_id());

    $ccode = "";
    $ocode = "";
    $acode = "";
    $ucode = "";

    while ($row = $con->FetchAssoc($query)) {
        $valor = $row['valor'];
        $valortext = 'off';
        if($valor >= 1){
            $valortext = 'on';  
        }

    	if( $ccode == "" ){
    		$ccode = 'c'.$row['code'];
    	}

        $cambiar = '';
        if($ciudadusuario == $row['code']){
            $valor = 1;
            $valortext = 'on';
            $cambiar = '1';
        }

	?>
	<li id="c<?php echo $row['code']; ?>">
		<div class="titulolista" id="c<?php echo $row['code']; ?>">
			
			<?php echo $row['name']; ?> 
		</div>
        <?php 
        if($cambiar == ''){ ?>
        <div style="float:right;margin-top: -28px;"  id="ckciudad<?php echo $row['code']; ?>" value="<?php echo $valor; ?>" onclick='fnactivarciudad("<?php echo $row['code']; ?>");' title="Activar/Desactivar Ciudad" class="on_off_icon <?php echo $valortext; ?>"></div>
        <?php }else{ ?>
        <div style="float:right;margin-top: -28px;"  title="Activar Ciudad" onclick='fnmensajeprincipal("ciudad");' class="on_off_icon <?php echo $valortext; ?>"></div>
        <?php } ?>
        <input type="hidden" name="cckciudad<?php echo $row['code']; ?>" id="cckciudad<?php echo $row['code']; ?>" value="<?php echo $valor; ?>">
		<div class="cuerpolista">
			<div class="encabezado">Oficinas</div>

            <ul id='listadonovedades<?php echo $row['code']; ?>'>
                
                <?php 
                $query2 = $u->ListarCiudadesOficinas($row['id'],$object->GetSeccional(),$object->GetUser_id()); 
                while ($row2 = $con->FetchAssoc($query2)) {
                    $valor2 = $row2['valor'];
                    $valortext2 = 'off';
                    if($valor2 >= 1){
                        $valortext2 = 'on';  
                    }
                    if( $ocode == "" ){
                        $ocode = 'o'.$row2['id'];
                    }

                    $cambiar2 = '';
                    if($oficinausuario == $row2['id']){
                        $valor2 = 1;
                        $valortext2 = 'on';
                         $cambiar2 = 1;
                    }
                ?>
                
                <li id="o<?php echo $row2['id']; ?>">

                    <div class="titulolista2" id="o<?php echo $row2['id']; ?>">
                        <?php echo $row2['nombre']; ?> 
                    </div>
                    <?php if($cambiar2 == ''){?>
                    <div style="float:right;margin-top: -28px;" id="ckoficina<?php echo $row2['id']; ?>" value="<?php echo $valor2; ?>" onclick='fnoficina("<?php echo $row2['id']; ?>");' title="Activar/Desactivar Oficina" class="on_off_icon <?php echo $valortext2; ?>"></div>
                    <?php }else{?>
                    <div style="float:right;margin-top: -28px;" title="Activar Oficina" onclick='fnmensajeprincipal("Oficina");' class="on_off_icon <?php echo $valortext2; ?>"></div>
                    <?php } ?>
                    <input type="hidden" name="cckoficina<?php echo $row2['id']; ?>" id="cckoficina<?php echo $row2['id']; ?>" value="<?php echo $valor2; ?>">
                    <div class="cuerpolista2">
                        <div class="encabezado">Areas</div>
                            <ul id='listadonovedades<?php echo $row2['id']; ?>'>
                            <?php 
                                $query3 = $u->ListarCiudadesOficinasAreas($row2['id'],$object->GetRegimen(),$object->GetUser_id()); 
                                
                                while ($row3 = $con->FetchAssoc($query3)) {
                                    $valor3 = $row3['valor'];
                                    $valortext3 = 'off';
                                    if($valor3 >= 1){
                                        $valortext3 = 'on';  
                                    }
                                    if( $acode == "" ){
                                        $acode = 'a'.$row3['id'].$row2['id'];
                                    }

                                    $cambiar3 = '';
                                    if($areausuario == $row3['id']){
                                        $valor3 = 1;
                                        $valortext3 = 'on';
                                        $cambiar3 = 1;
                                    }
                            ?> 
                                <li id="a<?php echo $row3['id'].$row2['id']; ?>">
                                    
                                    <div class="titulolista3" id="a<?php echo $row3['id'].$row2['id']; ?>">
                                        <?php echo $row3['nombre']; ?> 
                                    </div>
                                    <?php if($cambiar3 == ''){?>
                                    <div style="float:right;margin-top: -28px;" id="ckarea<?php echo $row3['id'].$row2['id']; ?>" value="<?php echo $valor3; ?>" onclick='fnarea("<?php echo $row3['id'].$row2['id']; ?>");' title="Activar/Desactivar <?= CAMPOAREADETRABAJO; ?>" class="on_off_icon <?php echo $valortext3; ?>"></div>
                                    <?php }else{?>
                                    <div style="float:right;margin-top: -28px;" title="Activar <?= CAMPOAREADETRABAJO; ?>" onclick='fnmensajeprincipal("Area");' class="on_off_icon <?php echo $valortext3; ?>"></div>
                                    <?php } ?>
                                    <input type="hidden" name="cckarea<?php echo $row3['id'].$row2['id']; ?>" id="cckarea<?php echo $row3['id'].$row2['id']; ?>" value="<?php echo $valor3; ?>">
                                    <div class="cuerpolista3">
                                        <div class="encabezado">Usuarios</div>
                                        
                                         <ul id='listadonovedades<?php echo $row3['id'].$row2['id']; ?>'>
                                            <?php 
                                                $query4 = $u->ListarCiudadesOficinasAreasUsuarios($row3['id'],$object->GetUser_id());
                                                
                                                while ($row4 = $con->FetchAssoc($query4)) {
                                                    $valor4 = $row4['valor'];
                                                    $valortext4 = 'off';
                                                    if($valor4 >= 1){
                                                        $valortext4 = 'on';  
                                                    }
                                                    if( $ucode == "" ){
                                                        $ucode = 'a'.$row4['id'].$row3['id'].$row2['id'];
                                                    }

                                                    $cambiar4 = '';
                                                    if($concatusuario == $row4['id'].$row3['id'].$row2['id']){
                                                        $valor4 = 1;
                                                        $valortext4 = 'on';
                                                        $cambiar4 = 1;
                                                    }
                                            ?>
                                            
                                            <li id="a<?php echo $row4['id'].$row3['id'].$row2['id']; ?>">
                                    
                                                <div class="titulolista4" id="a<?php echo $row4['id'].$row3['id'].$row2['id']; ?>">
                                                    <?php echo $row4['nombre']; ?> 
                                                </div>
                                                <?php if($cambiar4 == ''){?>
                                                <div style="float:right;margin-top: -28px;" id="ckusuario<?php echo $row4['id'].$row3['id'].$row2['id']; ?>" value="<?php echo $valor4; ?>" onclick='fnusuario("<?php echo $row4['id'].$row3['id'].$row2['id']; ?>");' title="Activar/Desactivar usuario" class="on_off_icon <?php echo $valortext4; ?>"></div>
                                                <?php }else{?>
                                                <div style="float:right;margin-top: -28px;" value="<?php echo $valor4; ?>" onclick='fnmensajeprincipal("Usuario");'  title="Activar usuario" class="on_off_icon <?php echo $valortext4; ?>"></div>
                                                <?php } ?>
                                                <input type="hidden" name="cckusuario<?php echo $row4['id'].$row3['id'].$row2['id']; ?>" id="cckusuario<?php echo $row4['id'].$row3['id'].$row2['id']; ?>" value="<?php echo $valor4; ?>">
                                                <!--<div class="cuerpolista4">

                                                </div>-->

                                            </li>


                                            <?php } ?>

                                        </ul>

                                    </div>

                                </li>               
                                
                            <?php } ?>
                            </ul>
                    </div>
                </li>

                <?php } ?>
                
            </ul>

		</div>
	</li>
	<?php } ?>
<ul>
</div>

<style type="text/css">
	
#contenido_bloque ul{
    list-style: none;
    text-align: left;
    width: 100%;
    padding-left: 0px;
    margin-top: 0px;
}
#contenido_bloque li{
    border-bottom: 1px solid #CCC;
    width: 100%;    
}
#contenido_bloque .titulolista, #contenido_bloque .titulolista2, #contenido_bloque .titulolista3, #contenido_bloque .titulolista4{
    font-size:13px;
    font-weight:bold;
    color:#000;
    cursor: pointer;
    padding-left:10px;
    font-size: 14px;
    line-height: 35px;
    min-height: 35px;
}
#contenido_bloque .titulolista:hover, #contenido_bloque .titulolista.active, #contenido_bloque .titulolista2:hover, #contenido_bloque .titulolista2.active, #contenido_bloque .titulolista3:hover, #contenido_bloque .titulolista3.active, #contenido_bloque .titulolista4:hover, #contenido_bloque .titulolista4.active{
	background-color: #f5f5f5;
}

#contenido_bloque .cuerpolista, #contenido_bloque .cuerpolista2, #contenido_bloque .cuerpolista3, #contenido_bloque .cuerpolista4{
    padding-left: 15px;
    padding-bottom: 15px;
    display: none; 
    /*
    */
    margin-bottom: 7px;
    text-align: justify;
    line-height: 17px;
}

.encabezado{
    color:#fff;
    background:#4F81BD;
    text-align: left;
}

</style>

<script type="text/javascript">
	
	$(".titulolista").click(function(){
        if(!$(this).parent().hasClass("active")){
            
            $('div.cuerpolista').slideUp("fast");
            $("ul#<?php echo $ccode; ?> > li").removeClass("active");
            $(".titulolista").removeClass("active");

            $(this).parent().children('div.cuerpolista').slideDown("fast");
            $(this).parent().addClass("active");
            $(this).addClass("active");
        }else{
            $(this).parent().children('div.cuerpolista').slideUp("fast");
            $(this).parent().removeClass("active");
            $(this).removeClass("active");
        }
    });

    $(".titulolista2").click(function(){
        if(!$(this).parent().hasClass("active")){
            
            $('div.cuerpolista2').slideUp("fast");
            $("ul#<?php echo $ocode; ?> > li").removeClass("active");
            $(".titulolista2").removeClass("active");

            $(this).parent().children('div.cuerpolista2').slideDown("fast");
            $(this).parent().addClass("active");
            $(this).addClass("active");
        }else{
            $(this).parent().children('div.cuerpolista2').slideUp("fast");
            $(this).parent().removeClass("active");
            $(this).removeClass("active");
        }
    });

    /*$(".titulolista4").click(function(){
        if(!$(this).parent().hasClass("active")){
            
            $('div.cuerpolista4').slideUp("fast");
            $("ul#<?php echo $acode; ?> > li").removeClass("active");
            $(".titulolista4").removeClass("active");

            $(this).parent().children('div.cuerpolista4').slideDown("fast");
            $(this).parent().addClass("active")
            $(this).addClass("active")
        }else{
            $(this).parent().children('div.cuerpolista4').slideUp("fast");
            $(this).parent().removeClass("active")
            $(this).removeClass("active")
        }
    });*/

    $(".titulolista3").click(function(){
        if(!$(this).parent().hasClass("active")){
            
            $('div.cuerpolista3').slideUp("fast");
            $("ul#<?php echo $acode; ?> > li").removeClass("active");
            $(".titulolista3").removeClass("active");

            $(this).parent().children('div.cuerpolista3').slideDown("fast");
            $(this).parent().addClass("active")
            $(this).addClass("active");
        }else{
            $(this).parent().children('div.cuerpolista3').slideUp("fast");
            $(this).parent().removeClass("active");
            $(this).removeClass("active");
        }
    });

    $("#<?php echo $ccode; ?>").click();
    $("#<?php echo $ocode; ?>").click();
    $("#<?php echo $acode; ?>").click();
    //$("#<?php echo $ucode; ?>").click();

    function fnactivarciudad(object){
        if($('#ckciudad'+object).val() == 0){

            $('#ckciudad'+object).removeClass("off");
            $('#ckciudad'+object).addClass("on");
            $('#ckciudad'+object).val('1');
            $('#cckciudad'+object).val('1');
            $('#c'+object).click();

        }else{

            $('#ckciudad'+object).removeClass("on");
            $('#ckciudad'+object).addClass("off");
            $('#ckciudad'+object).val('0');
            $('#cckciudad'+object).val('0');
        }
    }

    function fnoficina(object){
        if($('#ckoficina'+object).val() == 0){

            $('#ckoficina'+object).removeClass("off");
            $('#ckoficina'+object).addClass("on");
            $('#ckoficina'+object).val('1');
            $('#cckoficina'+object).val('1');
            $('#o'+object).click();

        }else{

            $('#ckoficina'+object).removeClass("on");
            $('#ckoficina'+object).addClass("off");
            $('#ckoficina'+object).val('0');
            $('#cckoficina'+object).val('0');
        }
    }

    function fnarea(object){
        if($('#ckarea'+object).val() == 0){

            $('#ckarea'+object).removeClass("off");
            $('#ckarea'+object).addClass("on");
            $('#ckarea'+object).val('1');
            $('#cckarea'+object).val('1');
            $('#a'+object).click();

        }else{

            $('#ckarea'+object).removeClass("on");
            $('#ckarea'+object).addClass("off");
            $('#ckarea'+object).val('0');
            $('#cckarea'+object).val('0');
        }
    }

    function fnusuario(object){
        if($('#ckusuario'+object).val() == 0){

            $('#ckusuario'+object).removeClass("off");
            $('#ckusuario'+object).addClass("on");
            $('#ckusuario'+object).val('1');
            $('#cckusuario'+object).val('1');
            $('#u'+object).click();

        }else{

            $('#ckusuario'+object).removeClass("on");
            $('#ckusuario'+object).addClass("off");
            $('#ckusuario'+object).val('0');
            $('#cckusuario'+object).val('0');
        }
    }

    function fnmensajeprincipal(texto){
        alert(texto+' principal del usuario no se puede desactivar');
    }
    

</script>