<?php
    $ge = new MGestion_anexos;
    $ge->CreateGestion_anexos("id", $idb);
    
    
    
    $g = new MGestion;
    $g->CreateGestion("id", $ge->GetGestion_id());
    
    $url = HOMEDIR.DS."app/archivos_uploads/gestion/".$ge->GetGestion_id().trim("/anexos/ ").$ge->GetUrl();
    
    
    
    echo '    <div class="row" style="margin:0px">
    <div class="col-md-8 scrollable" style="overflow: hidden;overflow-y: auto;height: 630px;">
    <iframe src="https://docs.google.com/gview?url='.$url.'&embedded=true" style="width:99%; height:620px;" frameborder="0"></iframe>
    </div>
    <div class="col-md-4">
    <h3>Procesando el Archivo...</h3>';
    
    if ($_SERVER['SERVER_NAME'] == 'expedientesdigitales.com' || $_SERVER['SERVER_NAME'] == 'ventanilla.comfatolima.com.co'){
        if ($ge->GetTipologia() == "169") {
            
            #echo $url;
            #exit;
            $archivolist = $_SERVER["DOCUMENT_ROOT"]."/app/archivos_uploads/gestion/".$ge->GetGestion_id()."/anexos".DS.$ge->GetUrl();
            
            $objPHPExcel = PHPExcel_IOFactory::load($archivolist);
            #foreach que leer el archivo de excel.
            $body = '<h4>Listado de Empleados Ingresados o Actualizados en el Sistema</h4><br>';
            $body .= '<table border="1" width="100%" cellpadding="5" cellspacing="0">
            <tr>
            <td>NOMBRE</td>
            <td width="100px"><b>IDENTIFICACION</b></td>
            <td width="80px"><b>USUARIO</b></td>
            <td width="80px"><b>CLAVE</b></td>
            <td width="100px"><b>ESTADO</b></td>
            </tr>';
            foreach ($objPHPExcel->getWorksheetIterator() as $worksheet){
                
                $worksheetTitle     = $worksheet->getTitle();
                $highestRow         = $worksheet->getHighestRow();
                $highestColumn      = $worksheet->getHighestColumn();
                $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
                $total_lineas = $highestRow;
                
                for ($row = 1; $row <= $total_lineas; ++ $row){
                    
                    
                    $arrFilas = array();
                    
                    for ($col = 0; $col < $highestColumnIndex; ++ $col){
                        
                        $val = "";
                        $cell = $worksheet->getCellByColumnAndRow( $col , $row );
                        $val = $cell->getValue();
                        $dataType = PHPExcel_Cell_DataType::dataTypeForValue($val);
                        
                        if($row == 1 && strlen($val) > 0)
                        {
                            $arrCabecera[$col] = $val;
                        }
                        if($row > 1 && strlen($val) > 0)
                        {
                            $arrFilas[$col] = $val;
                        }
                    }
                    if($row == 1){
                        if(in_array("IDENTIFICACION", $arrCabecera)){$col_IDENTIFICACION = array_search("IDENTIFICACION", $arrCabecera);}
                        if(in_array("NOMBRE", $arrCabecera)){$col_NOMBRE = array_search("NOMBRE", $arrCabecera);}
                        if(in_array("EMAIL", $arrCabecera)){$col_EMAIL = array_search("EMAIL", $arrCabecera);}
                        
                        
                    }
                    if($row > 1 && $val != ""){
                        $k++;
                        if(isset($col_IDENTIFICACION) ){$IDENTIFICACION = $c->sql_quote(trim( $arrFilas[$col_IDENTIFICACION]));}
                        if(isset($col_NOMBRE) ){$NOMBRE = $c->sql_quote(trim( $arrFilas[$col_NOMBRE]));}
                        if(isset($col_EMAIL) ){$EMAIL = $c->sql_quote(trim( $arrFilas[$col_EMAIL]));}
                        
                        
                        $object = new MSuscriptores_contactos;
                        $object->CreateSuscriptores_contactos("identificacion", $IDENTIFICACION);
                        
                        $registrar = 0;
                        
                        if ($object->GetId() <= 0) {
                            $registrar = 1;
                            
                        }else{
                            
                            $registrar =2;
                            
                        }
                        
                        $estado = "REGISTRADO";
                        
                        switch ($registrar) {
                            case '1':
                                
                                $estado = "REGISTRADO";
                                
                                $suscrr = new MSuscriptores_contactos;
                                $createsuscr = $suscrr->InsertSuscriptores_contactos($IDENTIFICACION, $NOMBRE, "1", $_SESSION['usuario'], date("Y-m-d"), $g->GetSuscriptor_id());
                                
                                $suscriptor_id = $c->GetMaxIdTabla("suscriptores_contactos", "id");
                                
                                $suscd = new MSuscriptores_contactos_direccion;
                                $suscd->InsertSuscriptores_contactos_direccion($suscriptor_id,"","","",$EMAIL,"");
                                
                                $objectx = new MSuscriptores_contactos;;
                                
                                $objectx->CreateSuscriptores_contactos("id", $suscriptor_id);
                                $usuario = $objectx->GetCod_ingreso();
                                $clave = $objectx->GetDec_pass();
                                
                                break;
                                
                            case '2':
                                
                                $estado = "ACTUALIZADO";
                                
                                $objectx = new MSuscriptores_contactos;
                                $objectx->CreateSuscriptores_contactos("identificacion", $IDENTIFICACION);
                                
                                $usuario = $objectx->GetCod_ingreso();
                                $clave = $objectx->GetDec_pass();
                                $SSC = new MSuscriptores_contactos_direccion;
                                $SSC->CreateSuscriptores_contactos_direccion("id_contacto", $objectx->GetId());
                                
                                $constrain = 'WHERE id = '.$objectx->GetId();
                                $fields = array('nombre', 'dependencia');
                                $updates= array($NOMBRE, $g->GetSuscriptor_id());
                                $output = array("", "");
                                $objectx->UpdateSuscriptores_contactos($constrain, $fields, $updates, $output);
                                
                                $constrain = 'WHERE id = '.$SSC->GetId();
                                $fields = array('email', 'salario');
                                $updates= array($EMAIL, $SALARIO, $SSC->GetId());
                                $output = array("", "");
                                $SSC->UpdateSuscriptores_contactos_direccion($constrain, $fields, $updates, $output);
                                break;
                            default:
                                $estado = "REGISTRADO";
                                $registrar = "error";
                                break;
                        }
                        
                        $body .= "<tr>
                        <td>".$NOMBRE."</td>
                        <td>".$IDENTIFICACION."</td>
                        <td>".$usuario."</td>
                        <td>".$clave."</td>
                        <td>".$estado."</td>
                        </tr>";
                    }
                    
                    
                }
            }
            $body .= '</table>';
            
            echo $body;
            $t = $k;
            $body .= $t." Registros procesados";
            echo $t." Registros procesados";
            
            $gestion_id = $g->GetId();
            
            
            $name = md5($_SESSION["usuario"].date("Y-m-d H:i:s")).".pdf";
            $nameqr = md5($_SESSION["usuario"].date("Y-m-d H:i:s")).".png";
            
            $urlfile = UPLOADS.DS.$gestion_id.'/anexos/'.$name;
            $urlfilqr = FILESAT.DS.$gestion_id.'/anexos/'.$name;
            #$urlqr = UPLOADS.DS.'qr/'.$nameqr;
            
            $sadmin = new MSuper_admin;
            $sadmin->CreateSuper_admin("id", "6");
            
            $config = new MPlantilla_documento_configuracion;
            $config->CreatePlantilla_documento_configuracion("id", "1");
            
            
            #QRcode::png($urlfilqr, $urlqr); // creates file
            
            $string = hash("sha256", $id.$_SESSION["usuario"].date("Y-m-d").date("H:i:s").$_SERVER["REMOTE_ADDR"]);
            $timestamp = "";
            $foot = "<div><div style='font-size:10px; float:left'>";
            
            $foot .= $pathp;
            
            $fpath = '<html><head></head><body>'.$timestamp;
            $lpath = $foot.'</body></html>';
            
            $html = utf8_decode($fpath.html_entity_decode($body).$lpath);
            
            $em = new MSuper_admin;
            $em->CreateSuper_admin("id", $_SESSION['id_empresa']);
            
            $encabezado = HOMEDIR.DS."app/plugins/thumbnails/".$em->GetEncabezado();
            $pie_pagina = HOMEDIR.DS."app/plugins/thumbnails/".$em->GetPie_pagina();
            
            
            $m_t     = ($config->GetM_t() * 28) -100;
            $m_r    = $config->GetM_r() * 28;
            $m_b    = 100 - ($config->GetM_b() * 28);
            $m_l    = ($config->GetM_l() * 28) -20;
            $m_e_t    = 150 - ($config->GetM_e_t() * 28);
            $m_e_b    = $config->GetM_e_b() * 28;
            $m_p_t    = $config->GetM_p_t() * 28;
            $m_p_b    = $config->GetM_p_b() * 28;
            $fuente = $config->GetFuente();
            $tamano = $config->GetTamano();
            
            $html2 = '
            <html>
            <head>
            <style>
            @font-face {
                font-family: "def_font";
            src: url('.HOMEDIR.DS.'app/views/assets/fonts/'.$fuente.');
            }
            @page { margin: 150px 0px; font-size: '.$tamano.'px; font-family: "def_font", Arial; }
            #header { position: fixed; top:-'.$m_e_t.'px; width:120%; height: 100px; background: url('.$encabezado.') no-repeat; background-size: contain; text-align: center; }
            #footer { position: fixed; bottom: -130px; height: 110px; background: url('.$pie_pagina.') no-repeat; }
            #content{margin: '.$m_t.'px '.$m_r.'px -'.$m_b.'px '.$m_l.'px; font-family: "def_font", Arial; }
            </style>
            <body>
            <div id="header">&nbsp;</div>
            <div id="footer"><p class="page">&nbsp;</p></div>
            <div id="content">
            '.$html.'
            </div>
            </body>
            </html>';
            
            $dompdf = new DOMPDF();
            
            $html2 = preg_replace('/>\s+</', '><', $html2);
            $dompdf->set_paper('letter','');
            $dompdf->load_html($html2);
            ini_set("memory_limit","512M");
            $dompdf->render();
            
            $pdf = $dompdf->output();
            
            if (file_put_contents($urlfile, $pdf)) {
                
                $car = new MGestion_anexos;
                $tot  = $car->ListarGestion_anexos("WHERE gestion_id = '".$gestion_id."'");
                
                $fol = $con->NumRows($tot);
                $fol += 1;
                $user_id = $_SESSION['usuario'];
                
                //base 64
                $base_file = '';
                $data_base_file = file_get_contents($_SERVER["DOCUMENT_ROOT"]."/app/archivos_uploads/gestion/".$gestion_id."/anexos".DS.$name);
                
                $base_file = base64_encode($data_base_file);
                
                $con->Query("INSERT into gestion_anexos (timest, gestion_id,nombre,url,user_id, ip, fecha, hora, folio, hash,base_file, tipologia) values ('".date("Y-m-d H:i:s")."', '".$gestion_id."','INFORME DE CARGA DE EMPLEADOS ".date("Y-m-d").".pdf','".$name."','$user_id', '$_SERVER[REMOTE_ADDR]', '".date("Y-m-d")."', '".date("H:i:s")."', '".$fol."', '".$string."','".$base_file."', '')");
                
                
                $id = $c->GetMaxIdTabla("gestion_anexos", "id");
                
                $objecte = new MEvents_gestion;
                // USANDO LA FUNCION DE INSERTAR DEL OBJETO PARA ENVIAR LA INFORMACION A LA BASE DE DATO
                $objecte->InsertEvents_gestion($_SESSION['usuario'], $gestion_id, date("Y-m-d"), "Documento Exportado", "El Documento: \"INFORME DE CARGA DE EMPLEADOS ".date("Y-m-d")."\" ha sido exportado al expediente", date("Y-m-d"), 0, date("H:i:s"), 0, 0, 0, date("Y-m-d"), 0, $_SESSION['seccional'], $_SESSION['area_principal'], $_SESSION['area_principal'], "*", "expdpc", $id);
                
            }
            
            
            
            echo "<br>Detalle de la importación anexada al expediente!";
            
            
            
        }else{
            echo "No se puede procesar el archivo";
        }
    }else{
        echo "No se puede procesar el archivo";
    }
    
    echo '            </div>
    </div>';
    ?>
