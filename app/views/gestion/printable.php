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
            <table style="width:700px;">
                <tr>
                    <td style="font-size: 10.5px;">
                        <?php 
                        $codeText = HOMEDIR.DS.'s/'.$object->GetUri().'/';

                        $sigla = $c->GetDataFromTable("seccional_principal", "ciudad_origen", $object->GetCiudad(), "sigla", $separador = " ");
                        $area = $c->GetDataFromTable("areas", "id", $object->GetDependencia_destino(), "nombre", $separador = " ");

                        $responsable = $c->GetDataFromTable("usuarios", "a_i", $object->GetNombre_destino(), "p_nombre, p_apellido", $separador = " ");

                        $qr = '<img style="padding:0px; margin:0px;" src="https://chart.googleapis.com/chart?chs=120x120&cht=qr&chl='.$codeText.'&choe=UTF-8"/>';

                        $siglasempresa = $c->GetDataFromTable("super_admin", "1", "1", "seccional", $separador = " ");

                        $lastdoccarga = $con->Query("SELECT timest FROM `gestion_anexos` where gestion_id = '".$object->GetId()."' order by timest desc limit 0, 1");
                        $lastdocrx = $con->Result($lastdoccarga, 0, "timest");

                        $d = new MDependencias();
                        $d->CreateDependencias("id", $object -> GetId_dependencia_raiz());
                        
                        $ds = new MDependencias();
                        $ds->CreateDependencias("id", $object -> Gettipo_documento());

                        $MUsuarios = new MUsuarios;
                        $MUsuarios->CreateUsuarios("user_id", $object -> Getusuario_registra());

                        $sadmin = new MSuper_admin;
                        $sadmin->CreateSuper_admin("id", "6");

                        $imajotipo   = $sadmin->GetImajotipo();
                        $text_tipo   = $sadmin->GetFoto_perfil();

                        $MPlantillas_email = new MPlantillas_email;
                        $MPlantillas_email->CreatePlantillas_email('id', '12');

                        $contenido_email = $MPlantillas_email->GetContenido();

                        $lsuscriptores = '<table border="1" cellspacing="0" style="width:700px; font-size:12px"><thead><tr><td><b>IDENTIFICACI&Oacute;N</b></td><td><b>NOMBRE</b></td><td><b>PARTE</b></td></tr></thead><tbody>';

                        $lgestions = new MGestion_suscriptores;
                        $querysuscriptores2 = $lgestions->ListarGestion_suscriptores("WHERE id_gestion = '".$object->GetId()."'");
                        
                        $ixx = 0;
                        while($rowsuscriptores = $con->FetchAssoc($querysuscriptores2)){
                            $ixx++;
                            $llstt = new MGestion_suscriptores;
                            $llstt->Creategestion_suscriptores('id', $rowsuscriptores['id']);

                            $sustrs = new MSuscriptores_contactos;
                            $sustrs->CreateSuscriptores_contactos("id", $llstt -> GetId_suscriptor());

                            $ts = $sustrs->GetType();
                            $ts = $c->GetDataFromTable("suscriptores_tipos", "id", $ts, "nombre", "");
                            $lsuscriptores .= '<tr>
                                                    <td>'.$sustrs->GetIdentificacion().'</td>
                                                    <td>'.$sustrs->GetNombre().'</td>
                                                    <td>'.$ts.'</td>
                                                </tr>';
                        }

                        if ($ixx == "0") {
                            $lsuscriptores .=  '<tr><td colspan="4">'.SUSCRIPTORCAMPONOMBRE." SIN DETERMINAR".'</td></tr>';
                        }

                         $lsuscriptores .=    '</tbody></table>';

                        $contenido_email = str_replace("[elemento]PROJECTNAME[/elemento]",      PROJECTNAME,     $contenido_email );
                        $contenido_email = str_replace("[elemento]HOMEDIR[/elemento]",      HOMEDIR,   $contenido_email );
                        $contenido_email = str_replace("[elemento]rad_rapido[/elemento]",      $object->GetMin_rad(),     $contenido_email );
                        $contenido_email = str_replace("[elemento]area[/elemento]",      $area,     $contenido_email );
                        $contenido_email = str_replace("[elemento]USUARIO_NOMBRE[/elemento]", $MUsuarios->GetP_nombre()." ".$MUsuarios->GetP_apellido(),            $contenido_email );
                        $contenido_email = str_replace("[elemento]Fecha_registro[/elemento]",      $object->GetTs(),   $contenido_email );
                        $contenido_email = str_replace("[elemento]ESTAMPADO[/elemento]",    date("Y-m-d H:i:s")  ,   $contenido_email );
                        $contenido_email = str_replace("[elemento]folios[/elemento]",    $object->GetFolio()  ,   $contenido_email );
                        $contenido_email = str_replace("[elemento]ESTAMPADOANEXO[/elemento]",    $lastdocrx  ,   $contenido_email );
                        $contenido_email = str_replace("[elemento]sub_Serie[/elemento]",   $ds->GetNombre()  ,   $contenido_email );
                        $contenido_email = str_replace("[elemento]responsable[/elemento]", $MUsuarios->GetP_nombre()." ".$MUsuarios->GetP_apellido(),            $contenido_email );
                        $contenido_email = str_replace("[elemento]QR[/elemento]", $qr,            $contenido_email );
                        $contenido_email = str_replace("[elemento]suscriptores[/elemento]", $lsuscriptores,            $contenido_email );
                        $contenido_email = str_replace("[elemento]LOGO[/elemento]", '<img src="'.HOMEDIR.'/app/plugins/thumbnails/'.$imajotipo.'" width="120px">',   $contenido_email );

                        

                        ?>
                        <div>
                            <?= $contenido_email ?>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </body>
</html>