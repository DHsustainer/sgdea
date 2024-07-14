<div>
  <div id="header_login">
    <div class="sizecontainer">
      <?
        include(MODELS.DS."Super_adminM.php");
        global $c;
        $fid = 6;

        if ($fid == "") {
          echo '<div id="logo_login"></div>';
        }else{

          $sadmin = new MSuper_admin;
          $sadmin->CreateSuper_admin("id", $fid);

          if ($sadmin->GetFoto_perfil() == "") {
            echo '<div id="logo_login"></div>';
          }else{
            echo '<div id="logo_login_clientes">'; 
            echo '    <img src="'.HOMEDIR.DS.'app/plugins/thumbnails/'.$sadmin->GetFoto_perfil().'" alt="">';
            echo '</div>';
          }
        }
      ?>

        <div class="clear"></div>
    </div>    
    <div class="clear"></div>  
</div>

<div style="margin:0 auto;">
  <div class="clear">&nbsp;</div>   
  <div>
		<form id='formbdata' action='/login/check/' method='POST'> 
      <table id="tabla_login" cellspacing="10" width="100%">
          <tr style="height:auto;">
              <td style="padding:0px;"> 
                <p>
                  <?= PROJECTNAME ?> es un sistema diseñado y desarrollado a la medida para que la Personería de Bucaramanga sea una de las primeras entidades del estado en cumplir los requerimientos de la Ley 594 del 2000, Decreto 2906 de 2012, Ley 1437 de 2011, Ley 1712 de 2014 y la Directiva Presidencial número 4 de 2012.
                </p>
                <p>
                  El nombre con el que se ha registrado ante Derechos de Autor se debe a las iniciales del doctor Augusto Rueda Gonzales. Personero quien tuvo la iniciativa para lograr la conformación del expediente electrónico y la comunicación electrónica entre la entidad, funcionarios y ciudadanos; quedando abierto para interactuar electrónicamente con las demás entidades del estado a media que cada una de ellas vaya adoptando sistemas similares. 
                </p>
                <!-- <div id="image_password" class="float_icon"></div><div><div></div></div>
                <div class="input_login">
                  <label style="margin:90px;"><input id="image_password" class="icons_login" type="checkbox" name="admin" id="pass" /> Ingresar Como Administrador</label><br />
                </div>                
                 -->
                  
              </td>
          </tr>                   	
      </table>
	  </form>            
	</div>
  <div class="clear">&nbsp;</div>   
</div>