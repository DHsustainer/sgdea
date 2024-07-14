<?
        global $c;
        global $f;

        $fid = 6;
        $sadmin = new MSuper_admin;
        $sadmin->CreateSuper_admin("id", $fid);
?>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script>
  //Declaramos la función que recibe el tiempo
  function refrescar(tiempo){
    //Cuando pase el tiempo elegido la página se refrescará 
    setTimeout("location.reload(true);", tiempo);
  }
  //Podemos ejecutar la función de este modo
  //La página se actualizará dentro de 10 segundos
  refrescar(900000);
</script>
<div class="login-box login-sidebar" style="background-color: rgba(255, 255, 255, 0.85);">
    <div class="white-box" style="background: none">
      <form class="form-horizontal form-material" action="<?= HOMEDIR ?>/login/check/" id="loginform" method="POST">
        <input type="hidden" name="auth_token" value="<?= $f->generateFormToken('loginform')?>" />
        <a href="javascript:void(0)" class="text-center db">
            <?

                $path = ROOT.DS.'plugins/thumbnails/';
                $image_white = $sadmin->Getimage_white();
                $imajotipo   = $sadmin->GetImajotipo();
                $logo_white  = $sadmin->Getlogo_white();
                $text_tipo   = $sadmin->GetFoto_perfil();

                $exists = file_exists( $path.$image_white );
                if (!$exists) { $image_white = 'logo_color.png'; }else{ $image_white = $image_white; }

                $exists = file_exists( $path.$imajotipo );
                if (!$exists) { $imajotipo = 'logo_color.png'; }else{ $imajotipo = $imajotipo; }

                $exists = file_exists( $path.$logo_white );
                if (!$exists) { $logo_white = 'text_color.png'; }else{ $logo_white = $logo_white; }

                $exists = file_exists( $path.$text_tipo );
                if (!$exists) { $text_tipo = 'text_color.png'; }else{ $text_tipo = $text_tipo; }


                if ($sadmin->GetFoto_perfil() == "") {
                    echo '<div class="light-logo" id="del-logo" onClick="window.location.href=\''.HOMEDIR.DS.'dashboard/\'"></div>';
                }else{
                    echo '<img src="'.HOMEDIR.DS.'app/plugins/thumbnails/'.$imajotipo.'" alt="home" style="width:60px" class="light-logo" /><br>
                          <img src="'.HOMEDIR.DS.'app/plugins/thumbnails/'.$text_tipo.'" alt="home" style="width:170px" class="light-logo" />';
                }
            ?>

        </a>  
    <?php if($_SESSION['MODULES']['multiempresa'] == 1 && count($_SESSION['listempresas']) > 0){ ?>

        <div class="form-group m-t-40">
            <div class="col-xs-12">
                <select  placeholder="Empresa" name="currentempresae" id="currentempresae" class="form-control" onchange="ChangeEmpresa(this.value);">
                    <?php
                    foreach ($_SESSION['listempresas'] as $key => $value) {
                        $selectf = '';
                        if(HOMEDIR == $value[3]){
                            $selectf = 'selected';
                        }
                        echo '<option value="'.$value[3].'" '.$selectf.'>'.$value[0].'</option>';
                    }
                    ?>
                </select>
            </div>
        </div>
    <?php } ?> 

        <div class="form-group m-t-40">
          <div class="col-xs-12">
            <input class="form-control" type="text" required="" name="username" id="username" placeholder="Nombre de Usuario ejemplo@mail.com">
          </div>
        </div>

        <div class="form-group">
          <div class="col-xs-12">
            <input class="form-control" type="password" required="" id="pass" name="pass" placeholder="Su contraseña">
          </div>
        </div>
        <div class="form-group" align="center">
            <div class="g-recaptcha" data-sitekey="6LeuotIZAAAAAOTQSoPvFhzRrQIeAQcXPqlAcd2x"></div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <div id="msg_field" class="text-danger p-l-10"><b><?= $error ?></b></div>
            </div>
        </div>
        <div class="form-group text-center m-t-20">
          <div class="col-xs-12">
            <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Iniciar Sesión</button>
          </div>
        </div>
        <div class="form-group">
            <!-- <div class="checkbox checkbox-primary pull-left p-t-0">
              <a href="/consultapublica/registro_usuarios/" class="btn btn-success">REGISTRARSE</a>
            </div> -->
            <a href="/login/restablecer/" id="to-recover" class="text-dark pull-right"><i class="fa fa-lock m-r-5"></i> Olvidaste tu clave?</a> 

        </div>

      </form>
      <div class="row m-t-10">
        <div class="col-md-12">
            <?= date("Y") ?> &copy; <?= PROJECTNAME ?> by Laws Leyes Sistematizadas 
        </div>
      </div>
        <div class="row m-t-10">
            <div class="col-md-4" align="center">
                <a href="/consultapublica/terminos_y_condiciones/" target="_blank" class="text-info font-12">
                    <b>Terminos y Condiciones</b>
                </a>
            </div>

            <div class="col-md-4" align="center">
                <a href="/consultapublica/privacidad_de_datos/" target="_blank" class="text-info font-12">
                    <b>Privicidad de Datos</b>
                </a>
            </div>

            <div class="col-md-4" align="center">
                <a href="<?= HOMEDIR.DS."consultapublica/licencia_de_uso/" ?>" target="_blank" class="text-info font-12">
                    <b>Licencia de Uso</b>
                </a>
            </div>
        </div>
    </div>
  </div>

<script type="text/javascript">
function ChangeEmpresa(){
     document.location.href=$("#currentempresae").val();
}
</script>
