<?
    $archivo = UPLOADS.DS.'tmp_base/'.$_SESSION['smallid'].'/'.$_SESSION['filed'];
    $tipo_documento = $c->sql_quote($_REQUEST['tipo_documento']);
    $arrext=explode('.',$archivo);
    $ext=end($arrext);

    if($ext != 'xlsx' && $ext != 'xls' ){
        echo "Formato del Archivo Incorrecto!";
        exit;
    }
    
    $procesados = 0;
    $noprocesados = 0;
    /*procesar archivo*/
    $archivoList = $archivo;
    $path = "";

    if(file_exists($archivoList)){

        $objPHPExcel = PHPExcel_IOFactory::load($archivoList);
        #foreach que leer el archivo de excel.
        $refcol = "";
        $NOMBRE_DEL_DEMANDANTE_COL = "";
        $IDENTIFICACION_DEL_DEMANDANTE_COL = "";
        $CIUDAD_DEL_DEMANDANTE_COL = "";
        $DIRECCION_DEL_DEMANDANTE_COL = "";
        $TELEFONO_DEMANDANTE_COL = "";
        $EMAIL_DEMANDANTE_COL = "";
        $NOMBRE_DEL_DEMANDADO_COL = "";
        $NOMBRE_DEL_CITADO_COL = "";
        $IDENTIFICACION_DEL_NOTIFICADO_COL = "";
        $DEPARTAMENTO_NOTIFICADO_COL = "";
        $MUNICIPIO_NOTIFICADO_COL = "";
        $CODIGO_MUNICIPIO_COL = "";
        $DIRECCION_NOTIFICADO_COL = "";
        $EMAIL_NOTIFICADO_COL = "";
        $NOTIFICADO_PERSONA_NATURAL_SI_NO_COL = "";
        $TIPO_CORRESPONDENCIA_COL = "";
        $ASUNTO_COL = "";
        $RADICADO_COL = "";
        $EMAIL_PARTE_INTERESADA_COL = "";
        $JUZGADO_COL = "";
        $DIRECCION_JUZGADO_COL = "";
        $DEPARTAMENTO_JUZGADO_COL = "";
        $CIUDAD_JUZGADO_COL = "";
        $ARTICULO_COL = "";
        $NATURALEZA_PROCESO_COL = "";
        $HORARIO_JUZGADO_COL = "";
        $DIAS_PARA_COMPARECER_COL = "";
        $ANEXO_COL = "";
        $FECHA_PROVIDENCIA_COL = "";
        $NUMERO_OBLIGACION_COL = "";



        $refcol_anexo = "";
        $path = '<table id="clmtable" data-height="400" data-show-columns="true" class="table table-hover table-bordered table-striped m-b-0">
                    <thead>
                        <tr>
                            <th style="width:100px;">INFO</th>';

        $countfilas = 0;

        $header = "";
        $body   = "";

        $sheet = 0;

        foreach ($objPHPExcel->getWorksheetIterator() as $worksheet){
            $sheet++;
            if ($sheet == "1") {
                # code...
                $worksheetTitle     = $worksheet->getTitle();
                $highestRow         = $worksheet->getHighestRow();
                $highestColumn      = $worksheet->getHighestColumn();
                $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
                $total_lineas = $highestRow;

                #RECORRO LA FILA
                for ($row = 1; $row <= $total_lineas; ++ $row){

                    $k++;
                    $arrFilas = array();

                    #RECORRO LA COLUMNA
                    for ($col = 0; $col < $highestColumnIndex; ++ $col){

                        $val = "";
                        $cell = $worksheet->getCellByColumnAndRow( $col , $row );
                        $val = $cell->getValue();
                        $dataType = PHPExcel_Cell_DataType::dataTypeForValue($val);
                        #Codigo Supremamente importante para el patron de recocimiento.
                        
                        # code...
                        if($row == 1 && strlen($val) > 0){
                            $arrCabecera[$col] = $val;
                            $header .= "<th>".$val."</th>";
                        }

                        if($row > 1 && strlen($val) > 0){
                            $arrFilas[$col] = $val;
                        }


                        if($row == 1){
                            switch (trim($val)) {
                                case 'NOMBRE_DEL_DEMANDANTE': $NOMBRE_DEL_DEMANDANTE_COL = $col; break;
                                case 'IDENTIFICACION_DEL_DEMANDANTE': $IDENTIFICACION_DEL_DEMANDANTE_COL = $col; break;
                                case 'CIUDAD_DEL_DEMANDANTE': $CIUDAD_DEL_DEMANDANTE_COL = $col; break;
                                case 'DIRECCION_DEL_DEMANDANTE': $DIRECCION_DEL_DEMANDANTE_COL = $col; break;
                                case 'TELEFONO_DEMANDANTE': $TELEFONO_DEMANDANTE_COL = $col; break;
                                case 'EMAIL_DEMANDANTE': $EMAIL_DEMANDANTE_COL = $col; break;
                                case 'NOMBRE_DEL_DEMANDADO': $NOMBRE_DEL_DEMANDADO_COL = $col; break;
                                case 'NOMBRE_DEL_NOTIFICADO': $NOMBRE_DEL_CITADO_COL = $col; break;
                                case 'IDENTIFICACION_DEL_NOTIFICADO': $IDENTIFICACION_DEL_NOTIFICADO_COL = $col; break;
                                case 'DEPARTAMENTO_NOTIFICADO': $DEPARTAMENTO_NOTIFICADO_COL = $col; break;
                                case 'MUNICIPIO_NOTIFICADO': $MUNICIPIO_NOTIFICADO_COL = $col; break;
                                case 'CODIGO_MUNICIPIO': $CODIGO_MUNICIPIO_COL = $col; break;
                                case 'DIRECCION_NOTIFICADO': $DIRECCION_NOTIFICADO_COL = $col; break;
                                case 'EMAIL_NOTIFICADO': $EMAIL_NOTIFICADO_COL = $col; break;
                                case 'NOTIFICADO_PERSONA_NATURAL_SI_NO': $NOTIFICADO_PERSONA_NATURAL_SI_NO_COL = $col; break;
                                case 'TIPO_CORRESPONDENCIA': $TIPO_CORRESPONDENCIA_COL = $col; break;
                                case 'ASUNTO': $ASUNTO_COL = $col; break;
                                case 'RADICADO': $RADICADO_COL = $col; break;
                                case 'EMAIL_PARTE_INTERESADA': $EMAIL_PARTE_INTERESADA_COL = $col; break;
                                case 'JUZGADO': $JUZGADO_COL = $col; break;
                                case 'DIRECCION_JUZGADO': $DIRECCION_JUZGADO_COL = $col; break;
                                case 'DEPARTAMENTO_JUZGADO': $DEPARTAMENTO_JUZGADO_COL = $col; break;
                                case 'CIUDAD_JUZGADO': $CIUDAD_JUZGADO_COL = $col; break;
                                case 'ARTICULO': $ARTICULO_COL = $col; break;
                                case 'NATURALEZA_PROCESO': $NATURALEZA_PROCESO_COL = $col; break;
                                case 'HORARIO_JUZGADO': $HORARIO_JUZGADO_COL = $col; break;
                                case 'DIAS_PARA_COMPARECER': $DIAS_PARA_COMPARECER_COL = $col; break;
                                case 'ANEXO': $ANEXO_COL = $col; break;
                                case 'FECHA_PROVIDENCIA': $FECHA_PROVIDENCIA_COL = $col; break;
                                case 'NUMERO_OBLIGACION': $NUMERO_OBLIGACION_COL = $col; break;
                                default: break;
                            }
                        }else{

                            if ($col == $refcol) {
                                $suscriptor = $val;
                            }
                        }
                    } #ESTE CIERRA FOR DE LA FILA SOLO NECESITO REFCOL, 1


                    if($suscriptor != ""){

                        
                        $countfilas++;   
                        $body .= "<tr>";

                        $bodypath = ""; 

                        $errorclass = "mdi-check text-success";

                        $cellmeta = $worksheet->getCellByColumnAndRow( $NOMBRE_DEL_DEMANDANTE_COL, $row );
                        $NOMBRE_DEL_DEMANDANTE_VALOR = $cellmeta->getValue();
                        $NOMBRE_DEL_DEMANDANTE_VALOR_COLOR = "";
                        if($NOMBRE_DEL_DEMANDANTE_VALOR == ""){
                            $errorclass = "mdi-close text-danger";
                            $NOMBRE_DEL_DEMANDANTE_VALOR_COLOR = "list-group-item-danger";
                        }
                        $bodypath .= "<td class='".$NOMBRE_DEL_DEMANDANTE_VALOR_COLOR."'> <input type='text' class='form-control' name='NOMBRE_DEL_DEMANDANTE_COL[]' value='".$NOMBRE_DEL_DEMANDANTE_VALOR."'></td>";

                        $cellmeta = $worksheet->getCellByColumnAndRow( $IDENTIFICACION_DEL_DEMANDANTE_COL, $row );
                        $IDENTIFICACION_DEL_DEMANDANTE_VALOR = $cellmeta->getValue();
                        $IDENTIFICACION_DEL_DEMANDANTE_VALOR_COLOR = "";
                        if($IDENTIFICACION_DEL_DEMANDANTE_VALOR == ""){
                            $errorclass = "mdi-close text-danger";
                            $IDENTIFICACION_DEL_DEMANDANTE_VALOR_COLOR = "list-group-item-danger";
                        }
                        $bodypath .= "<td class='".$IDENTIFICACION_DEL_DEMANDANTE_VALOR_COLOR."'> <input type='text' class='form-control' name='IDENTIFICACION_DEL_DEMANDANTE_COL[]' value='".$IDENTIFICACION_DEL_DEMANDANTE_VALOR."'></td>";

                        $cellmeta = $worksheet->getCellByColumnAndRow( $CIUDAD_DEL_DEMANDANTE_COL, $row );
                        $CIUDAD_DEL_DEMANDANTE_VALOR = $cellmeta->getValue();
                        $CIUDAD_DEL_DEMANDANTE_VALOR_COLOR = "";
                        if($CIUDAD_DEL_DEMANDANTE_VALOR == ""){
                            $errorclass = "mdi-close text-danger";
                            $CIUDAD_DEL_DEMANDANTE_VALOR_COLOR = "list-group-item-danger";
                        }
                        $bodypath .= "<td class='".$CIUDAD_DEL_DEMANDANTE_VALOR_COLOR."'> <input type='text' class='form-control' name='CIUDAD_DEL_DEMANDANTE_COL[]' value='".$CIUDAD_DEL_DEMANDANTE_VALOR."'></td>";

                        $cellmeta = $worksheet->getCellByColumnAndRow( $DIRECCION_DEL_DEMANDANTE_COL, $row );
                        $DIRECCION_DEL_DEMANDANTE_VALOR = $cellmeta->getValue();
                        $DIRECCION_DEL_DEMANDANTE_VALOR_COLOR = "";
                        $bodypath .= "<td class='".$DIRECCION_DEL_DEMANDANTE_VALOR_COLOR."'> <input type='text' class='form-control' name='DIRECCION_DEL_DEMANDANTE_COL[]' value='".$DIRECCION_DEL_DEMANDANTE_VALOR."'></td>";

                        $cellmeta = $worksheet->getCellByColumnAndRow( $TELEFONO_DEMANDANTE_COL, $row );
                        $TELEFONO_DEMANDANTE_VALOR = $cellmeta->getValue();
                        $TELEFONO_DEMANDANTE_VALOR_COLOR = "";
                        $bodypath .= "<td class='".$TELEFONO_DEMANDANTE_VALOR_COLOR."'> <input type='text' class='form-control' name='TELEFONO_DEMANDANTE_COL[]' value='".$TELEFONO_DEMANDANTE_VALOR."'></td>";

                        $cellmeta = $worksheet->getCellByColumnAndRow( $EMAIL_DEMANDANTE_COL, $row );
                        $EMAIL_DEMANDANTE_VALOR = $cellmeta->getValue();
                        $EMAIL_DEMANDANTE_VALOR_COLOR = "";
                        $bodypath .= "<td class='".$EMAIL_DEMANDANTE_VALOR_COLOR."'> <input type='text' class='form-control' name='EMAIL_DEMANDANTE_COL[]' value='".$EMAIL_DEMANDANTE_VALOR."'></td>";

                        $cellmeta = $worksheet->getCellByColumnAndRow( $NOMBRE_DEL_DEMANDADO_COL, $row );
                        $NOMBRE_DEL_DEMANDADO_VALOR = $cellmeta->getValue();
                        $NOMBRE_DEL_DEMANDADO_VALOR_COLOR = "";
                        if($NOMBRE_DEL_DEMANDADO_VALOR == ""){
                            $errorclass = "mdi-close text-danger";
                            $NOMBRE_DEL_DEMANDADO_VALOR_COLOR = "list-group-item-danger";
                        }
                        $bodypath .= "<td class='".$NOMBRE_DEL_DEMANDADO_VALOR_COLOR."'> <input type='text' class='form-control' name='NOMBRE_DEL_DEMANDADO_COL[]' value='".$NOMBRE_DEL_DEMANDADO_VALOR."'></td>";

                        $cellmeta = $worksheet->getCellByColumnAndRow( $NOMBRE_DEL_CITADO_COL, $row );
                        $NOMBRE_DEL_CITADO_VALOR = $cellmeta->getValue();
                        $NOMBRE_DEL_CITADO_VALOR_COLOR = "";
                        if($NOMBRE_DEL_CITADO_VALOR == ""){
                            $errorclass = "mdi-close text-danger";
                            $NOMBRE_DEL_CITADO_VALOR_COLOR = "list-group-item-danger";
                        }
                        $bodypath .= "<td class='".$NOMBRE_DEL_CITADO_VALOR_COLOR."'> <input type='text' class='form-control' name='NOMBRE_DEL_NOTIFICADO_COL[]' value='".$NOMBRE_DEL_CITADO_VALOR."'></td>";

                        $cellmeta = $worksheet->getCellByColumnAndRow( $IDENTIFICACION_DEL_NOTIFICADO_COL, $row );
                        $IDENTIFICACION_DEL_NOTIFICADO_VALOR = $cellmeta->getValue();
                        $IDENTIFICACION_DEL_NOTIFICADO_VALOR_COLOR = "";
                        if($IDENTIFICACION_DEL_NOTIFICADO_VALOR == ""){
                            $errorclass = "mdi-close text-danger";
                            $IDENTIFICACION_DEL_NOTIFICADO_VALOR_COLOR = "list-group-item-danger";
                        }
                        $bodypath .= "<td class='".$IDENTIFICACION_DEL_NOTIFICADO_VALOR_COLOR."'> <input type='text' class='form-control' name='IDENTIFICACION_DEL_NOTIFICADO_COL[]' value='".$IDENTIFICACION_DEL_NOTIFICADO_VALOR."'></td>";

                        $cellmeta = $worksheet->getCellByColumnAndRow( $DEPARTAMENTO_NOTIFICADO_COL, $row );
                        $DEPARTAMENTO_NOTIFICADO_VALOR = $cellmeta->getValue();
                        $DEPARTAMENTO_NOTIFICADO_VALOR_COLOR = "";
                        if($DEPARTAMENTO_NOTIFICADO_VALOR == ""){
                            $errorclass = "mdi-close text-danger";
                            $DEPARTAMENTO_NOTIFICADO_VALOR_COLOR = "list-group-item-danger";
                        }
                        $bodypath .= "<td class='".$DEPARTAMENTO_NOTIFICADO_VALOR_COLOR."'> <input type='text' class='form-control' name='DEPARTAMENTO_NOTIFICADO_COL[]' value='".$DEPARTAMENTO_NOTIFICADO_VALOR."'></td>";

                        $cellmeta = $worksheet->getCellByColumnAndRow( $MUNICIPIO_NOTIFICADO_COL, $row );
                        $MUNICIPIO_NOTIFICADO_VALOR = $cellmeta->getValue();
                        $MUNICIPIO_NOTIFICADO_VALOR_COLOR = "";
                        if($MUNICIPIO_NOTIFICADO_VALOR == ""){
                            $errorclass = "mdi-close text-danger";
                            $MUNICIPIO_NOTIFICADO_VALOR_COLOR = "list-group-item-danger";
                        }
                        $bodypath .= "<td class='".$MUNICIPIO_NOTIFICADO_VALOR_COLOR."'> <input type='text' class='form-control' name='MUNICIPIO_NOTIFICADO_COL[]' value='".$MUNICIPIO_NOTIFICADO_VALOR."'></td>";

                        $cellmeta = $worksheet->getCellByColumnAndRow( $CODIGO_MUNICIPIO_COL, $row );
                        $CODIGO_MUNICIPIO_VALOR = $cellmeta->getValue();
                        $CODIGO_MUNICIPIO_VALOR_COLOR = "";
                        if($CODIGO_MUNICIPIO_VALOR == ""){
                            $errorclass = "mdi-close text-danger";
                            $CODIGO_MUNICIPIO_VALOR_COLOR = "list-group-item-danger";
                        }
                        $bodypath .= "<td class='".$CODIGO_MUNICIPIO_VALOR_COLOR."'> <input type='text' class='form-control' name='CODIGO_MUNICIPIO_COL[]' value='".$CODIGO_MUNICIPIO_VALOR."'></td>";

                        $cellmeta = $worksheet->getCellByColumnAndRow( $DIRECCION_NOTIFICADO_COL, $row );
                        $DIRECCION_NOTIFICADO_VALOR = $cellmeta->getValue();
                        $DIRECCION_NOTIFICADO_VALOR_COLOR = "";
                        if($DIRECCION_NOTIFICADO_VALOR == ""){
                            $errorclass = "mdi-close text-danger";
                            $DIRECCION_NOTIFICADO_VALOR_COLOR = "list-group-item-danger";
                        }
                        $bodypath .= "<td class='".$DIRECCION_NOTIFICADO_VALOR_COLOR."'> <input type='text' class='form-control' name='DIRECCION_NOTIFICADO_COL[]' value='".$DIRECCION_NOTIFICADO_VALOR."'></td>";

                        $cellmeta = $worksheet->getCellByColumnAndRow( $EMAIL_NOTIFICADO_COL, $row );
                        $EMAIL_NOTIFICADO_VALOR = $cellmeta->getValue();
                        $EMAIL_NOTIFICADO_VALOR_COLOR = "";
                        if($EMAIL_NOTIFICADO_VALOR == ""){
                            $errorclass = "mdi-close text-danger";
                            $EMAIL_NOTIFICADO_VALOR_COLOR = "list-group-item-danger";
                        }
                        $bodypath .= "<td class='".$EMAIL_NOTIFICADO_VALOR_COLOR."'> <input type='text' class='form-control' name='EMAIL_NOTIFICADO_COL[]' value='".$EMAIL_NOTIFICADO_VALOR."'></td>";

                        $cellmeta = $worksheet->getCellByColumnAndRow( $NOTIFICADO_PERSONA_NATURAL_SI_NO_COL, $row );
                        $NOTIFICADO_PERSONA_NATURAL_SI_NO_VALOR = $cellmeta->getValue();
                        $NOTIFICADO_PERSONA_NATURAL_SI_NO_VALOR_COLOR = "";
                        if($NOTIFICADO_PERSONA_NATURAL_SI_NO_VALOR == ""){
                            $errorclass = "mdi-close text-danger";
                            $NOTIFICADO_PERSONA_NATURAL_SI_NO_VALOR_COLOR = "list-group-item-danger";
                        }
                        $bodypath .= "<td class='".$NOTIFICADO_PERSONA_NATURAL_SI_NO_VALOR_COLOR."'> <input type='text' class='form-control' name='NOTIFICADO_PERSONA_NATURAL_SI_NO_COL[]' value='".$NOTIFICADO_PERSONA_NATURAL_SI_NO_VALOR."'></td>";

                        $cellmeta = $worksheet->getCellByColumnAndRow( $TIPO_CORRESPONDENCIA_COL, $row );
                        $TIPO_CORRESPONDENCIA_VALOR = $cellmeta->getValue();
                        $TIPO_CORRESPONDENCIA_VALOR_COLOR = "";
                        if($TIPO_CORRESPONDENCIA_VALOR == ""){
                            $errorclass = "mdi-close text-danger";
                            $TIPO_CORRESPONDENCIA_VALOR_COLOR = "list-group-item-danger";
                        }
                        $bodypath .= "<td class='".$TIPO_CORRESPONDENCIA_VALOR_COLOR."'> <input type='text' class='form-control' name='TIPO_CORRESPONDENCIA_COL[]' value='".$TIPO_CORRESPONDENCIA_VALOR."'></td>";

                        $cellmeta = $worksheet->getCellByColumnAndRow( $ASUNTO_COL, $row );
                        $ASUNTO_VALOR = $cellmeta->getValue();
                        $ASUNTO_VALOR_COLOR = "";
                        if($ASUNTO_VALOR == ""){
                            $errorclass = "mdi-close text-danger";
                            $ASUNTO_VALOR_COLOR = "list-group-item-danger";
                        }
                        $bodypath .= "<td class='".$ASUNTO_VALOR_COLOR."'> <input type='text' class='form-control' name='ASUNTO_COL[]' value='".$ASUNTO_VALOR."'></td>";

                        $cellmeta = $worksheet->getCellByColumnAndRow( $RADICADO_COL, $row );
                        $RADICADO_VALOR = $cellmeta->getValue();
                        $RADICADO_VALOR_COLOR = "";
                        if($RADICADO_VALOR == ""){
                            $errorclass = "mdi-close text-danger";
                            $RADICADO_VALOR_COLOR = "list-group-item-danger";
                        }
                        $bodypath .= "<td class='".$RADICADO_VALOR_COLOR."'> <input type='text' class='form-control' name='RADICADO_COL[]' value='".$RADICADO_VALOR."'></td>";

                        $cellmeta = $worksheet->getCellByColumnAndRow( $EMAIL_PARTE_INTERESADA_COL, $row );
                        $EMAIL_PARTE_INTERESADA_VALOR = $cellmeta->getValue();
                        $EMAIL_PARTE_INTERESADA_VALOR_COLOR = "";
                        if($EMAIL_PARTE_INTERESADA_VALOR == ""){
                            $errorclass = "mdi-close text-danger";
                            $EMAIL_PARTE_INTERESADA_VALOR_COLOR = "list-group-item-danger";
                        }
                        $bodypath .= "<td class='".$EMAIL_PARTE_INTERESADA_VALOR_COLOR."'> <input type='text' class='form-control' name='EMAIL_PARTE_INTERESADA_COL[]' value='".$EMAIL_PARTE_INTERESADA_VALOR."'></td>";

                        $cellmeta = $worksheet->getCellByColumnAndRow( $JUZGADO_COL, $row );
                        $JUZGADO_VALOR = $cellmeta->getValue();
                        $JUZGADO_VALOR_COLOR = "";
                        if($JUZGADO_VALOR == ""){
                            $errorclass = "mdi-close text-danger";
                            $JUZGADO_VALOR_COLOR = "list-group-item-danger";
                        }
                        $bodypath .= "<td class='".$JUZGADO_VALOR_COLOR."'> <input type='text' class='form-control' name='JUZGADO_COL[]' value='".$JUZGADO_VALOR."'></td>";

                        $cellmeta = $worksheet->getCellByColumnAndRow( $DIRECCION_JUZGADO_COL, $row );
                        $DIRECCION_JUZGADO_VALOR = $cellmeta->getValue();
                        $DIRECCION_JUZGADO_VALOR_COLOR = "";
                        if($DIRECCION_JUZGADO_VALOR == ""){
                            $errorclass = "mdi-close text-danger";
                            $DIRECCION_JUZGADO_VALOR_COLOR = "list-group-item-danger";
                        }
                        $bodypath .= "<td class='".$DIRECCION_JUZGADO_VALOR_COLOR."'> <input type='text' class='form-control' name='DIRECCION_JUZGADO_COL[]' value='".$DIRECCION_JUZGADO_VALOR."'></td>";

                        $cellmeta = $worksheet->getCellByColumnAndRow( $DEPARTAMENTO_JUZGADO_COL, $row );
                        $DEPARTAMENTO_JUZGADO_VALOR = $cellmeta->getValue();
                        $DEPARTAMENTO_JUZGADO_VALOR_COLOR = "";
                        if($DEPARTAMENTO_JUZGADO_VALOR == ""){
                            $errorclass = "mdi-close text-danger";
                            $DEPARTAMENTO_JUZGADO_VALOR_COLOR = "list-group-item-danger";
                        }
                        $bodypath .= "<td class='".$DEPARTAMENTO_JUZGADO_VALOR_COLOR."'> <input type='text' class='form-control' name='DEPARTAMENTO_JUZGADO_COL[]' value='".$DEPARTAMENTO_JUZGADO_VALOR."'></td>";

                        $cellmeta = $worksheet->getCellByColumnAndRow( $CIUDAD_JUZGADO_COL, $row );
                        $CIUDAD_JUZGADO_VALOR = $cellmeta->getValue();
                        $CIUDAD_JUZGADO_VALOR_COLOR = "";
                        if($CIUDAD_JUZGADO_VALOR == ""){
                            $errorclass = "mdi-close text-danger";
                            $CIUDAD_JUZGADO_VALOR_COLOR = "list-group-item-danger";
                        }
                        $bodypath .= "<td class='".$CIUDAD_JUZGADO_VALOR_COLOR."'> <input type='text' class='form-control' name='CIUDAD_JUZGADO_COL[]' value='".$CIUDAD_JUZGADO_VALOR."'></td>";

                        $cellmeta = $worksheet->getCellByColumnAndRow( $ARTICULO_COL, $row );
                        $ARTICULO_VALOR = $cellmeta->getValue();
                        $ARTICULO_VALOR_COLOR = "";
                        if($ARTICULO_VALOR == ""){
                            $errorclass = "mdi-close text-danger";
                            $ARTICULO_VALOR_COLOR = "list-group-item-danger";
                        }
                        $bodypath .= "<td class='".$ARTICULO_VALOR_COLOR."'> <input type='text' class='form-control' name='ARTICULO_COL[]' value='".$ARTICULO_VALOR."'></td>";

                        $cellmeta = $worksheet->getCellByColumnAndRow( $NATURALEZA_PROCESO_COL, $row );
                        $NATURALEZA_PROCESO_VALOR = $cellmeta->getValue();
                        $NATURALEZA_PROCESO_VALOR_COLOR = "";
                        if($NATURALEZA_PROCESO_VALOR == ""){
                            $errorclass = "mdi-close text-danger";
                            $NATURALEZA_PROCESO_VALOR_COLOR = "list-group-item-danger";
                        }
                        $bodypath .= "<td class='".$NATURALEZA_PROCESO_VALOR_COLOR."'> <input type='text' class='form-control' name='NATURALEZA_PROCESO_COL[]' value='".$NATURALEZA_PROCESO_VALOR."'></td>";

                        $cellmeta = $worksheet->getCellByColumnAndRow( $HORARIO_JUZGADO_COL, $row );
                        $HORARIO_JUZGADO_VALOR = $cellmeta->getValue();
                        $HORARIO_JUZGADO_VALOR_COLOR = "";
                        if($HORARIO_JUZGADO_VALOR == ""){
                            $errorclass = "mdi-close text-danger";
                            $HORARIO_JUZGADO_VALOR_COLOR = "list-group-item-danger";
                        }
                        $bodypath .= "<td class='".$HORARIO_JUZGADO_VALOR_COLOR."'> <input type='text' class='form-control' name='HORARIO_JUZGADO_COL[]' value='".$HORARIO_JUZGADO_VALOR."'></td>";

                        $cellmeta = $worksheet->getCellByColumnAndRow( $DIAS_PARA_COMPARECER_COL, $row );
                        $DIAS_PARA_COMPARECER_VALOR = $cellmeta->getValue();
                        $DIAS_PARA_COMPARECER_VALOR_COLOR = "";
                        if($DIAS_PARA_COMPARECER_VALOR == ""){
                            $errorclass = "mdi-close text-danger";
                            $DIAS_PARA_COMPARECER_VALOR_COLOR = "list-group-item-danger";
                        }
                        $bodypath .= "<td class='".$DIAS_PARA_COMPARECER_VALOR_COLOR."'> <input type='text' class='form-control' name='DIAS_PARA_COMPARECER_COL[]' value='".$DIAS_PARA_COMPARECER_VALOR."'></td>";

                        $cellmeta = $worksheet->getCellByColumnAndRow( $ANEXO_COL, $row );
                        $ANEXO_VALOR = $cellmeta->getValue();
                        $ANEXO_VALOR_COLOR = "";
                        $bodypath .= "<td class='".$ANEXO_VALOR_COLOR."'> <input type='text' class='form-control' name='ANEXO_COL[]' value='".$ANEXO_VALOR."'></td>";

                        $cellmeta = $worksheet->getCellByColumnAndRow( $FECHA_PROVIDENCIA_COL, $row );
                        $FECHA_PROVIDENCIA_VALOR = $cellmeta->getValue();
                        $FECHA_PROVIDENCIA_VALOR_COLOR = "";
                        $bodypath .= "<td class='".$FECHA_PROVIDENCIA_VALOR_COLOR."'> <input type='text' class='form-control' name='FECHA_PROVIDENCIA_COL[]' value='".$FECHA_PROVIDENCIA_VALOR."'></td>";

                        $cellmeta = $worksheet->getCellByColumnAndRow( $NUMERO_OBLIGACION_COL, $row );
                        $NUMERO_OBLIGACION_VALOR = $cellmeta->getValue();
                        $NUMERO_OBLIGACION_VALOR_COLOR = "";
                        $bodypath .= "<td class='".$NUMERO_OBLIGACION_VALOR_COLOR."'> <input type='text' class='form-control' name='NUMERO_OBLIGACION_COL[]' value='".$NUMERO_OBLIGACION_VALOR."'></td>";


                        $body .= "  <td class='text-center'>
                                        <i class='mdi $errorclass'></i>
                                    </td>".$bodypath;

                        $body .= "</tr>";

                    } 
                }

            }
        }
        echo $path;
        echo $header."
                    <tr>
                </thead>
                <tbody>
                    $body
                </tbody>
            </table>";

    }else{
        echo "No se a podido encontrar el archivo";
    }
?>
<!-- SCROLLABLE -->
<link href="<?= HOMEDIR ?>/app/plugins/theme/plugins/bower_components/bootstrap-table/dist/bootstrap-table.min.css" rel="stylesheet">
<script src="<?= HOMEDIR ?>/app/plugins/theme/plugins/bower_components/bootstrap-table/dist/bootstrap-table.min.js"></script>
<script src="<?= HOMEDIR ?>/app/plugins/theme/plugins/bower_components/bootstrap-table/dist/bootstrap-table.ints.js"></script>