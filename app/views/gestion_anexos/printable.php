<html>

    <head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">

        <title>Imprimir Expediente <?= $object->Getnum_oficio_respuesta() ?></title>

        <style>

        @charset "utf-8";

        @font-face{

           font-family: "Segoe UI";

           src: url(<?= ASSETS ?>fonts/segoeui.ttf);

        }



            body{

                font-family: "Segoe UI";

            }

        </style>

    </head>

    <!--<body onLoad="window.print();"> -->

    <body>

        <div class="table" id="formprimible" style="width:480px">

            <table style="width:450px; height: 114px;">

                <tr>

                    <td valign="top">

                        <div style="margin: 0 auto; text-align:center; pading:0">

                            <?php $codeText = HOMEDIR.DS.'s/'.$object->GetUri().'/'; ?>

                            <img style="padding:0px; margin:0px;" src="https://chart.googleapis.com/chart?chs=120x120&cht=qr&chl=<?= $codeText; ?>&choe=UTF-8"/>

                        </div>

                    </td>

                    <td colspan="3" style="font-size: 10.5px;">

                        <?php 

                        $sigla = $c->GetDataFromTable("seccional_principal", "ciudad_origen", $object->GetCiudad(), "sigla", $separador = " ");

                        $area = $c->GetDataFromTable("areas", "id", $object->GetDependencia_destino(), "nombre", $separador = " ");

                        $responsable = $c->GetDataFromTable("usuarios", "a_i", $object->GetNombre_destino(), "p_nombre, p_apellido", $separador = " ");

                        $siglasempresa = $c->GetDataFromTable("super_admin", "1", "1", "seccional", $separador = " ");

                        $NUMRADICACION = $object->GetMin_rad();

                        $lastdoccarga = $con->Query("SELECT timest FROM `gestion_anexos` where gestion_id = '".$object->GetId()."' order by timest desc limit 0, 1");
                        $lastdocrx = $con->Result($lastdoccarga, 0, "timest");

                        $d = new MDependencias();
                        $d->CreateDependencias("id", $object -> GetId_dependencia_raiz());
                        
                        $ds = new MDependencias();
                        $ds->CreateDependencias("id", $object -> Gettipo_documento());



                        $MPlantillas_email = new MPlantillas_email;



                        $MPlantillas_email->CreatePlantillas_email('id', '16');



                        $contenido_email = $MPlantillas_email->GetContenido();

                        $contenido_email = str_replace("[elemento]PROJECTNAME[/elemento]",      PROJECTNAME,     $contenido_email );
                        $contenido_email = str_replace("[elemento]HOMEDIR[/elemento]",      HOMEDIR,   $contenido_email );
                        $contenido_email = str_replace("[elemento]rad_rapido[/elemento]",      $object->Getmin_rad()."-".$f->zerofill($ga->GetIndice(), 4),     $contenido_email );
                        $contenido_email = str_replace("[elemento]area[/elemento]",      $area,     $contenido_email );
                        $contenido_email = str_replace("[elemento]USUARIO_NOMBRE[/elemento]", $_SESSION['nombre'],            $contenido_email );
                        $contenido_email = str_replace("[elemento]Fecha_registro[/elemento]",      $object->GetTs(),   $contenido_email );
                        $contenido_email = str_replace("[elemento]ESTAMPADO_DOCUMENTO[/elemento]",    $ga->GetFecha().' '.$ga->GetHora()  ,   $contenido_email );
                        $contenido_email = str_replace("[elemento]folios_documento[/elemento]",    $ga->GetCantidad()  ,   $contenido_email );
                        $contenido_email = str_replace("[elemento]folios[/elemento]",    $object->GetFolio()  ,   $contenido_email );
                        $contenido_email = str_replace("[elemento]ESTAMPADOANEXO[/elemento]",    $lastdocrx  ,   $contenido_email );
                        $contenido_email = str_replace("[elemento]rad_completo[/elemento]",      $NUMRADICACION."-".$f->zerofill($ga->GetIndice(), 4),   $contenido_email );
                        $contenido_email = str_replace("[elemento]observacion_documento[/elemento]",      $ga->GetObservacion(),   $contenido_email );
                        ?>
                        <div>
                            <?= $contenido_email ?>

<!--                         
                            Se&ntilde;or usuario para todos los efectos debe citar este n&uacute;mero de radicado: <b><?= $object->Getmin_rad() ?> </b> A la hora de allegar documentos pertenecientes a este proceso, 

                            Tenga en cuenta que este documento ser&aacute; gestionado en el &aacute;rea: <b><?php echo $area; ?></b>
                            Subserie <b><?= $ds->GetNombre(); ?></b>
                        
                             por el funcionario: <b><?php echo $responsable; ?></b>

                            Fecha de recibido: <b><?php echo date('Y-M-d H:i:s'); ?> </b>
-->


                        </div>

                        <!--<div><b><?php echo $siglasempresa.'-'.$object -> GetMin_rad().'-'.$sigla; ?></b></div>

                        <div><b><?php echo date('Y-M-d H:i:s'); ?></b></div>

                        <div><?php echo $area; ?></div>

                        <div><?php echo $responsable; ?></div> -->

                    </td>

                </tr>

            </table>

        </div>

    </body>

</html>