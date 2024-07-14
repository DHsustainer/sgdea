<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>

<html xmlns='http://www.w3.org/1999/xhtml'>

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <title>Reparto del Expediente</title>

    <!-- <link rel='stylesheet' type='text/css' href='http://assets.audiosjuridicos.com/styles/comunes.css'/>

    <link rel='stylesheet' type='text/css' href='http://assets.audiosjuridicos.com/styles/formularios.css'/> -->

    <link rel='stylesheet' type='text/css' href='<?=ASSETS?>/styles/del.mini.css'/>

    <script src="https://code.jquery.com/jquery-1.11.0.min.js"></script>

    <link rel='stylesheet' href='https://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css' />

    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css"> -->
<!--
-->
    <link rel="stylesheet" href="<?= HOMEDIR ?>/app/plugins/bootstrap-3.3.7-dist/css/bootstrap.min.css">



    <script language='javascript' type='text/javascript' src='https://code.jquery.com/ui/1.10.3/jquery-ui.js'></script>



    <script language='javascript' type='text/javascript' src='<?=ASSETS?>/js/jscripts.js'></script>

    <link href="<?=ASSETS?>/images/favicon.png" rel='icon' type='image/x-icon'/>



    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!–[if lt IE 8]>

    <script src="https://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>

    <![endif]–>



</head>

<body>

    <div id="header">

        <?

    $me = new MUsuarios;

    $me->CreateUsuarios("user_id", $_SESSION["usuario"]);



    global $c;



    $nombre_usuario = $me->GetP_nombre()." ".$me->GetP_apellido();



    if ($_SESSION["suscriptor_id"] != "") {

        

        $sus = new MSuscriptores_contactos;

        $sus->CreateSuscriptores_contactos("id", $_SESSION['suscriptor_id']);



        $nombre_usuario = $sus->GetNombre();

    }



    if ($_SESSION['folder'] == "") {

        $u = new MUsuarios;

        $u->CreateUsuarios("user_id", $_SESSION['usuario']);



        if ($u->GetId_empresa() != "0") {

            $sadmin = new MSuper_admin;

            $sadmin->CreateSuper_admin("id", $u->GetId_empresa());



            if ($sadmin->GetFoto_perfil() == "") {

                echo '<div id="del-logo"></div>';

            }else{

                #echo '<div id="del-logo"></div>';

                echo '<div id="del-logo" onClick="window.location.href=\''.HOMEDIR.DS.'dashboard/\'" style="background: URL('.HOMEDIR.DS.'app/plugins/thumbnails/'.$sadmin->GetFoto_perfil().') no-repeat; background-size: 170px; "></div>';

            }

            

        }else{

            echo '<div id="del-logo"></div>';

        }

    }else{

        $u = new MUsuarios;

        $u->CreateUsuarios("user_id", $_SESSION['usuario']);



        $sadmin = new MSuper_admin;

        $sadmin->CreateSuper_admin("id", $u->GetId_empresa());



        if ($sadmin->GetFoto_perfil() == "") {

            echo '<div id="del-logo" onClick="window.location.href=\''.HOMEDIR.DS.'dashboard/\'"></div>';

        }else{

            echo '<div id="del-logo" onClick="window.location.href=\''.HOMEDIR.DS.'dashboard/\'" style="background: URL('.HOMEDIR.DS.'app/plugins/thumbnails/'.$sadmin->GetFoto_perfil().') no-repeat; background-size: 170px; "></div>';

        }

    }



    $archivoloc = array("*" => "Todo el archivo", "1" => "Archivo de Gestión", "2" => "Archivo Central", "3" => "Archivo Histórico");





    $pathsearch = " and estado_archivo = '$p1' ";

    if ($p1 == "*") {

        $pathsearch = "";

    }

?>

        <div id="del-buscar"></div>

        <div id="del-right">

            <div id="del-user">

                <div id="del-user-info">

                    <?

                        #echo $nombre_usuario

                        if ($_SESSION["usuario"] != ""){



                            $cit = new MCity;

                            $cit->CreateCity("code", $_SESSION['ciudad']);



                            $area = new MAreas;

                            $area->CreateAreas("id", $_SESSION['area_principal']);



                            $of = new MSeccional;

                            $of->CreateSeccional("id", $_SESSION['seccional']);



                            #echo $cit->GetName().", <br><b>".$of->GetNombre()." (".$area->GetNombre().")</b>";

                            echo $cit->GetName().", <br><b>".$of->GetNombre()."</b>";



                        }

                    ?>

                </div>

            </div>

        </div>

    </div>

    <div id='content' class="app_container">

        <div class="row" style="padding:50px;">
            <div class="col-md-12">
                <div id="blfile">
                    <h2>Salida de Firma Digital</h2>
                    <?
                        echo $status."<hr>";

                    ?>
                </div>
            </div>
        </div>

    </div>

</body>

</html>



<!-- Latest compiled and minified JavaScript 
-->
<script src="<?= HOMEDIR ?>/app/plugins/bootstrap-3.3.7-dist/js/bootstrap.min.js"   ></script>