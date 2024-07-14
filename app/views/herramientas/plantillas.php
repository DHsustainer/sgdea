<link href="<?= ASSETS.DS ?>css/estilo_editor.css" rel="stylesheet" type="text/css" media="all" />
<script language="javascript" type="text/javascript" src="<?= ASSETS.DS ?>js/AjaxUpload.2.0.min.js"></script>
<script language="javascript" type="text/javascript" src="<?= ASSETS.DS ?>js/script_editor.js"></script>

<div id="herr-content" style="margin-left:70px">
	<div class="item-herr gest-herr">
		<div id="gestiones">
			<div id="titles-gest">
				<div class="title-gest" id="onactiona" onclick="window.location.href = '<?= HOMEDIR.DS.'herramientas/#proce' ?>'">Configuracion de Tablas de Retencion</div>
				<div class="title-gest active" id="onactionb" onclick="select_gest('subsr-per',this)">Configurar Sub-Serie</div>
			</div>
			
			<div class="item-gest subsr-per">
				<div id="list_nat" class="item-content-gest">
					<div id="formsubsrs">
						<?
							$dep = new MDependencias;
							$dep->CreateDependencias("id", $id);

					    	include(VIEWS.DS."dependencias/DepDependencias2.php");

					    
						    if ($_GET['cn'] != "") {
					    		$pathurl = "/plantilla_dependencia/actualizar/".$_GET['cn']."/".$_GET['id']."/";

					    	}else{

					    		$pathurl = "/plantilla_dependencia/registrar/";

					    	}
						?>
						<div id="cargador_box">
							<div class="da-message success">En este panel puede crear los documentos genericos de cada sub-serie</div>
							<br>
							<form method="POST" action="<?= $pathurl ?>"> 
							<?
										if ($_GET['cn'] != "") {
								    		$pathurl = "/plantilla_dependencia/actualizar/";

								    		$pd = new MPlantilla_dependencia;
								    		$pd->Createplantilla_dependencia("id", $_GET['cn']);

											$fecha = $pd -> Getf_creacion();
											$nombre =  $pd -> Getnombre(); 
											$usuario = $pd -> Getuser_id();
											$content = $pd -> Getcontenido();
											$id_pl = $pd->GetId();
											$dataupdate = date("Y-m-d");

								    	}else{

								    		$pathurl = "/plantilla_dependencia/registrar/";
								    		$fecha = date("Y-m-d");
											$nombre =  ""; 
											$usuario = $_SESSION['usuario'];
											$content = "";

								    	}
							?>
							    <div id="menu_minutas"style="width:100%; height: 50px; ">
							        <div id="nav" style="width:200px; float:left; margin-left:10px;">
							            <div class = "minutas">DOCUMENTOS
							                <div class="scrollable">
							                    <ul>
							                        <?

							                        $object2 = new MPlantilla_dependencia;

							                        $query2 = $object2->ListarPlantilla_dependencia("WHERE dependencia_id = '".$id."'");    
							                        $i = 0;
							                        while($row = $con->FetchAssoc($query2)){
							                        	$i++;
							                            $ln = new MPlantilla_dependencia;
							                            $ln->Createplantilla_dependencia('id', $row[id]);
							                            ?>
							                                <li id="pl<?=$row[id]?>" class="item-plantilla" title="<?php echo $ln->GetNombre(); ?>" onclick="view_plantilla(<?=$id?>,<?=$row[id]?>)"><?php echo substr($ln->GetNombre(), 0, 40); ?></li>
							                            <?
							                            
							                        }

							                        echo '<li class="item-plantilla" onclick="view_plantilla(\''.$id.'\',\'\')">Crear un nuevo Documento</li>';

							                        if ($i == "0") {
							                        	echo '<li class="item-plantilla" >No hay documentos creados</li>';
							                        }
							                        
							                        ?>
							                    </ul>
							                    <div style="clear:both;"></div>
							                </div>
							            </div>
							        </div>
							        <div style="float:left; ">
							        	<input type='hidden' placeholder="id" name='id' id='id' value='<?= $id_pl ?>' />
										<input type='hidden' placeholder="f_actualizacion" name='f_actualizacion' id='f_actualizacion' maxlength='' value='<?= $dataupdate;  ?>' />
							        	<input type='hidden' placeholder="user_id" name='user_id' id='user_id' maxlength='' value='<? echo $usuario; ?>' />
										<input type='hidden' placeholder="f_creacion" name='f_creacion' id='f_creacion' maxlength='' value='<? echo $fecha; ?>' />
							        	<input type='hidden' placeholder="dependencia_id" name='dependencia_id' id='dependencia_id' maxlength='' value='<? echo $id; ?>' />
							            <input type="text" class="form-control" placeholder="Escriba el Título del Nuevo Documento" id="nombre" name="nombre" value="<?= $nombre; ?>" style="height:42px; width:700px; border-radius: 0px; -moz-border-radius: 0px; margin-bottom: 0px; margin-top: 0px;" placeholder="Título del nuevo documento">
							            
							            <input type="submit" value='GUARDAR' name="submit" style="height:42px; border-radius: 0px; -moz-border-radius: 0px; margin-bottom: 0px; margin-top: 0px;" >
							        </div>
							    </div>
							    <div id="bodyform_minutas" style="width:1000px; margin: 10px auto;">
							        <div class="bloq_newdoc" style="float:left; width: 100%;" id="bloq_editor">
							           	<div id="buttons">
								            <button type="button" class="botone" onClick="format_buttonCSS('bold')"><span class="icon bold"></span></button>
								            <button type="button" class="botone" onClick="format_buttonCSS('italic')"><span class="icon italic"></span></button>
								            <button type="button" class="botone" onClick="format_buttonCSS('underline')"><span class="icon underline"></span></button>
								            <button type="button" class="botone" onClick="format_buttonCSS('sline')"><span class ="icon line"></span></button>
								            <button type="button" class="botone" onClick="align_button('JustifyLeft')"><span class ="icon left"></span></button>
								            <button type="button" class="botone" onClick="align_button('JustifyRight')"><span class ="icon right"></span></button>
								            <button type="button" class="botone" onClick="align_button('JustifyCenter')"><span class ="icon center"></span></button>
								            <button type="button" class="botone" onClick="align_button('JustifyFull')"><span class ="icon justify"></span></button>
								            <button type="button" class="botone" onClick="align_button('indent')"><span class="icon indent"></span></button>
								            <button type="button" class="botone" onClick="align_button('outdent')"><span class="icon outdent"></span></button>
								            <button type="button" class="botone" onClick="align_button('InsertOrderedList')"><span class="icon numberlist"></span></button>
								            <button type="button" class="botone" onClick="align_button('InsertUnorderedList')"><span class="icon dotslist"></span></button>
								            <button type="button" id="fontsize" class="botone"><span class="icon fontsize"></span>
								            <ul>
								                    <li onClick="format_buttonCSS('fontSizeDefault')">Normal</li>         
								                    <li onClick="format_buttonCSS('fontSizeSmall')">Pequeño</li>            
								                    <li onClick="format_buttonCSS('fontSizeBig')">Grande</li>
								                    <li onClick="format_buttonCSS('fontSizeRbig')">Muy Grande</li>
								                </ul>
								            </button>
								            <button type="button" id="fonttype" class="botone"><span class="icon fonttype"></span>
								                <ul>
								                    <li onClick="format_buttonCSS('fontArial')">Arial</li>         
								                    <li onClick="format_buttonCSS('fontCourrier')">Courrier New</li>            
								                    <li onClick="format_buttonCSS('fontVerdana')">Verdana</li>
								                    <li onClick="format_buttonCSS('fontMonotypeCorsiva')">Monotype</li>
								                    <li onClick="format_buttonCSS('fontTahoma')">Tahoma</li>
								                    <li onClick="format_buttonCSS('fontTimes')">Times</li>
								                </ul>
								            </button>
								            <button type="button" class="botone" onClick="InsertQuote('addquote')"><span class="icon quote"></span></button>
								            <button type="button" class="botone" onClick="DoTable()"><span class="icon gird"></span></button>
								            <button type="button" class="botone" id="upload_button"><span class="icon image"></span></button>
								            <button type="button" class="botone" onClick="InsertVideo()"><span class="icon video"></span></button>
								            <button type="button" class="botone" onClick="url_button()"><span class="icon link"></span></button>
								            <button type="button" class="botone" onClick="showhtml()"><span class="icon html"></span></button>
								            <br>
								            <div style="margin: 5px;">
							            	<?
							            		$rf = new MRef_tables;
							            		$query = $rf->ListarRef_tables(" WHERE dependencia_id = '".$id."'");

							        			while($row = $con->FetchAssoc($query)){
													$l = new MRef_tables;
													$l->Createref_tables('id', $row[id]);
													$path = "";
													echo "
															<select class='select-opc' id='sel_".$l->GetId()."' style='margin-bottom:5px; width:150px'>
																<option> ".$l -> GetTitle()." </option>
																<optgroup label = '---'>";
																	$path .= ($l->GetCol_1() != "") ? '<option value="&nbsp;<b>[elemento]'.$l->GetId().'_col_1[/elemento]</b>&nbsp;">col_1: '.$l->GetCol_1().'</option>' : ''; 
																	$path .= ($l->GetCol_2() != "") ? '<option value="&nbsp;<b>[elemento]'.$l->GetId().'_col_2[/elemento]</b>&nbsp;">col_2: '.$l->GetCol_2().'</option>' : ''; 
																	$path .= ($l->GetCol_3() != "") ? '<option value="&nbsp;<b>[elemento]'.$l->GetId().'_col_3[/elemento]</b>&nbsp;">col_3: '.$l->GetCol_3().'</option>' : ''; 
																	$path .= ($l->GetCol_4() != "") ? '<option value="&nbsp;<b>[elemento]'.$l->GetId().'_col_4[/elemento]</b>&nbsp;">col_4: '.$l->GetCol_4().'</option>' : ''; 
																	$path .= ($l->GetCol_5() != "") ? '<option value="&nbsp;<b>[elemento]'.$l->GetId().'_col_5[/elemento]</b>&nbsp;">col_5: '.$l->GetCol_5().'</option>' : ''; 
																	$path .= ($l->GetCol_6() != "") ? '<option value="&nbsp;<b>[elemento]'.$l->GetId().'_col_6[/elemento]</b>&nbsp;">col_6: '.$l->GetCol_6().'</option>' : ''; 
																	$path .= ($l->GetCol_7() != "") ? '<option value="&nbsp;<b>[elemento]'.$l->GetId().'_col_7[/elemento]</b>&nbsp;">col_7: '.$l->GetCol_7().'</option>' : ''; 
																	$path .= ($l->GetCol_8() != "") ? '<option value="&nbsp;<b>[elemento]'.$l->GetId().'_col_8[/elemento]</b>&nbsp;">col_8: '.$l->GetCol_8().'</option>' : ''; 
																	$path .= ($l->GetCol_9() != "") ? '<option value="&nbsp;<b>[elemento]'.$l->GetId().'_col_9[/elemento]</b>&nbsp;">col_9: '.$l->GetCol_9().'</option>' : ''; 
																	$path .= ($l->GetCol_10() != "") ? '<option value="&nbsp;<b>[elemento]'.$l->GetId().'_col_10[/elemento]</b>&nbsp;">col_10: '.$l->GetCol_10().'</option>' : ''; 
																	$path .= ($l->GetCol_11() != "") ? '<option value="&nbsp;<b>[elemento]'.$l->GetId().'_col_11[/elemento]</b>&nbsp;">col_11: '.$l->GetCol_11().'</option>' : ''; 
																	$path .= ($l->GetCol_12() != "") ? '<option value="&nbsp;<b>[elemento]'.$l->GetId().'_col_12[/elemento]</b>&nbsp;">col_12: '.$l->GetCol_12().'</option>' : ''; 
																	$path .= ($l->GetCol_13() != "") ? '<option value="&nbsp;<b>[elemento]'.$l->GetId().'_col_13[/elemento]</b>&nbsp;">col_13: '.$l->GetCol_13().'</option>' : ''; 
																	$path .= ($l->GetCol_14() != "") ? '<option value="&nbsp;<b>[elemento]'.$l->GetId().'_col_14[/elemento]</b>&nbsp;">col_14: '.$l->GetCol_14().'</option>' : ''; 
																	$path .= ($l->GetCol_15() != "") ? '<option value="&nbsp;<b>[elemento]'.$l->GetId().'_col_15[/elemento]</b>&nbsp;">col_15: '.$l->GetCol_15().'</option>' : ''; 
																	$path .= ($l->GetCol_16() != "") ? '<option value="&nbsp;<b>[elemento]'.$l->GetId().'_col_16[/elemento]</b>&nbsp;">col_16: '.$l->GetCol_16().'</option>' : ''; 
																	$path .= ($l->GetCol_17() != "") ? '<option value="&nbsp;<b>[elemento]'.$l->GetId().'_col_17[/elemento]</b>&nbsp;">col_17: '.$l->GetCol_17().'</option>' : ''; 
																	$path .= ($l->GetCol_18() != "") ? '<option value="&nbsp;<b>[elemento]'.$l->GetId().'_col_18[/elemento]</b>&nbsp;">col_18: '.$l->GetCol_18().'</option>' : ''; 
																	$path .= ($l->GetCol_19() != "") ? '<option value="&nbsp;<b>[elemento]'.$l->GetId().'_col_19[/elemento]</b>&nbsp;">col_19: '.$l->GetCol_19().'</option>' : ''; 
																	$path .= ($l->GetCol_20() != "") ? '<option value="&nbsp;<b>[elemento]'.$l->GetId().'_col_20[/elemento]</b>&nbsp;">col_20: '.$l->GetCol_20().'</option>' : ''; 
																	$path .= ($l->GetCol_21() != "") ? '<option value="&nbsp;<b>[elemento]'.$l->GetId().'_col_21[/elemento]</b>&nbsp;">col_21: '.$l->GetCol_21().'</option>' : ''; 
																	$path .= ($l->GetCol_22() != "") ? '<option value="&nbsp;<b>[elemento]'.$l->GetId().'_col_22[/elemento]</b>&nbsp;">col_22: '.$l->GetCol_22().'</option>' : ''; 
																	$path .= ($l->GetCol_23() != "") ? '<option value="&nbsp;<b>[elemento]'.$l->GetId().'_col_23[/elemento]</b>&nbsp;">col_23: '.$l->GetCol_23().'</option>' : ''; 
																	$path .= ($l->GetCol_24() != "") ? '<option value="&nbsp;<b>[elemento]'.$l->GetId().'_col_24[/elemento]</b>&nbsp;">col_24: '.$l->GetCol_24().'</option>' : ''; 
																	$path .= ($l->GetCol_25() != "") ? '<option value="&nbsp;<b>[elemento]'.$l->GetId().'_col_25[/elemento]</b>&nbsp;">col_25: '.$l->GetCol_25().'</option>' : ''; 
																	$path .= ($l->GetCol_26() != "") ? '<option value="&nbsp;<b>[elemento]'.$l->GetId().'_col_26[/elemento]</b>&nbsp;">col_26: '.$l->GetCol_26().'</option>' : ''; 
																	$path .= ($l->GetCol_27() != "") ? '<option value="&nbsp;<b>[elemento]'.$l->GetId().'_col_27[/elemento]</b>&nbsp;">col_27: '.$l->GetCol_27().'</option>' : ''; 
																	$path .= ($l->GetCol_28() != "") ? '<option value="&nbsp;<b>[elemento]'.$l->GetId().'_col_28[/elemento]</b>&nbsp;">col_28: '.$l->GetCol_28().'</option>' : ''; 
																	$path .= ($l->GetCol_29() != "") ? '<option value="&nbsp;<b>[elemento]'.$l->GetId().'_col_29[/elemento]</b>&nbsp;">col_29: '.$l->GetCol_29().'</option>' : ''; 
																	$path .= ($l->GetCol_30() != "") ? '<option value="&nbsp;<b>[elemento]'.$l->GetId().'_col_30[/elemento]</b>&nbsp;">col_30: '.$l->GetCol_30().'</option>' : ''; 

																	echo $path;
													echo "		</optgroup>
															</select>
														";

												}
							            	?>
								            </div>
								        </div>
							            <div  class="container_editor">
							            	<div id="editor" name="editor" class="text_notas scrollable"><?= $content ?></div>
								        </div>
							            <textarea style="display:none" class="text_notas marginbottom_2 scrollable" name='descripcion' id='descripcion' maxlength='' placeholder="Escribe tu nota aquí..."><?= $content ?></textarea>
							        </div>
							    </div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>





    	<div class="clear"></div>
	</div>
</div>
<script>

    function view_plantilla(id, cn){
        window.location.href="<?= HOMEDIR.DS.'dependencias/views_minutas/'?>"+id+"/"+cn+"/";
    }


    $(document).ready(function() {

		var pos = $("#menu_tab").offset().top - 120;
        $('#content').animate({ scrollTop : pos }, 'slow');

        capa = $("#bloq_editor");
        $("#content").scroll(function () {
          var elt = $("#buttons");    
          //Bt = window.name = window.pageYOffset;
          var p = $( "#bloq_editor" );
          var position = p.position();
          Bt = position.top ;
          if (Bt < 0){
            elt.addClass("pointed");
            elt.css("position","fixed");
            elt.css("width", $("#bloq_editor").width()+"px");
            elt.css("top","70px");
            elt.css("-moz-box-shadow","0px 3px 8px 0px rgba(50, 50, 50, 0.21)");
            elt.css("-webkit-box-shadow","0px 3px 8px 0px rgba(50, 50, 50, 0.21)");
            elt.css("box-shadow","0px 3px 8px 0px rgba(50, 50, 50, 0.21)");           
          }else{
            elt.removeClass("pointed");
            elt.css("position","relative");
            elt.css("top","auto");
            elt.css("width","auto");
            elt.css("-moz-box-shadow","none");
            elt.css("-webkit-box-shadow","none");
            elt.css("box-shadow","none");           
          }

        });

        $('.select-opc').change(function() {
            AddHtml($(this).attr("id"), $(this).val());
        });
    });
</script>