<html>
    <head>
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
            <table border="0">
                <tr>
                    <td colspan="4"><b> <h4 style="margin-bottom:0px;">Radicación #<? echo $object -> Getnum_oficio_respuesta(); ?></h4></b></td>
                </tr>
                <tr>
                    <td>
                        <div style="width100%; margin: 0 auto; text-align:center; pading:0">
                            <img src="<?= ASSETS.DS.'images/default_qr.jpg'?>" width="120">
                        </div>
                    </td>
                    <td colspan="3">
                            <table>
                                <tr>
                                    <td>Ciudad</td>
                                    <td>
                                        <?
                                            $campoa = $c->GetDataFromTable("city", "code", $object->GetCiudad(), "name", $separador = " ");
                                            echo $campoa;
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Oficina</td>
                                    <td>
                                        <?
                                            $campob = $c->GetDataFromTable("seccional", "id", $object->GetOficina(), "nombre", $separador = " ");
                                            echo $campob;
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Area</td>
                                    <td>
                                        <?
                                            $campoc = $c->GetDataFromTable("areas", "id", $object->GetDependencia_destino(), "nombre", $separador = " ");
                                            echo $campoc;
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Responsable</td>
                                    <td>
                                        <?
                                            $campod = $c->GetDataFromTable("usuarios", "a_i", $object->GetNombre_destino(), "p_nombre, p_apellido", $separador = " ");
                                            echo $campod;
                                        ?>
                                    </td>
                                </tr>
                            </table>
                    </td>
                </tr>
                <tr>
                    <td width="120px"><strong>Radicado Externo</strong></td>
                    <td width="120px"><?= $object->GetRadicado() ?></td>
                    <td width="120px"><strong>Radicado Rapido</strong></td>
                    <td width="120px"><?= $object->GetMin_rad() ?></td>
                </tr>
                <tr>
                    <td><strong>Fecha Ingreso:</strong></td>
                    <td><?= $object -> Getf_recibido() ?></td>
                    <td><strong>Fecha Impresión:</strong></td>
                    <td><?= date("Y-m-d") ?></td>
                </tr>
                <tr>
                    <td><strong>Serie</strong></td>
                    <td colspan="3">
                    <? 
                        $d = new MDependencias();
                        $d->CreateDependencias("id", $object -> GetId_dependencia_raiz());

                        echo $d->GetNombre();
                        
                    ?>
                    </td>
                </tr>
                <tr>
                    <td><strong>Sub Serie</strong></td>
                    <td colspan="3">
                   <? 
                    
                        $d = new MDependencias();
                        $d->CreateDependencias("id", $object -> Gettipo_documento());

                        echo $d->GetNombre();
                    ?>
                    </td>
                </tr>
                <tr>
                    <td><strong>Suscriptor</strong></td>
                    <td colspan="3">
                    <? 
                        $s = new Msuscriptores_contactos;
                        $s->CreateSuscriptores_contactos("id", $object -> Getsuscriptor_id());

                        echo "<span class='tempspace'>".$s->GetNombre()."</span>";
                    ?>
                    </td>
                </tr>
                <tr>
                    <td><strong>Observación</strong></td>
                    <td colspan="3"><? echo "<span class='tempspace'>".$object ->GetObservacion()."</span>"; ?></td>
                </tr>
            </table>
		</div>
    </body>
</html>