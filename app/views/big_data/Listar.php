<br><br><div class="title right">Listado de Formularios Creados</div>
<div id="contenido_bloque"> 
	<ul id='listadonovedades'>
<?
	while($row = $con->FetchAssoc($query)){
		$l = new MBig_data;
		$l->Createbig_data('id', $row[id]);

		$ref = new MRef_tables;
		$ref->CreateRef_tables('id', $l -> GetRef_tables_id());
		$path = "";
?>				
        <li id='li<?= $l->GetId() ?>'>
            <div class="titulolista"><?php echo $ref->GetTitle()." (".$l -> GetCol_1().")"; ?></div>
            <div class="cuerpolista">
            	<form id="FormUpdatebig_data<?= $l->GetId() ?>">
            		<table border='0' cellspacing='0' cellpadding='3' width='100%' class='tabla'>
            			<tr>
            				<td colspan="2">

								<input type="button" id='edit_opc' onclick='EliminarBig_data("<?= $l->GetId() ?>")' style="" value="Eliminar Formulario">
								<input type="button" id='edit_opc' onclick='EditForm("<?= $l->GetId() ?>")' style="" value="Editar Formulario">
								<input type="button" id='save_opc' onclick='UpdateBigData("<?= $l->GetId() ?>")' style="display:none;" value="Guardar Formulario">
								<input type="button" onclick='ExportarFormulario("<?= $l->GetId() ?>")' value="Expotar al Expediente">
            				</td>
            			</tr>
            		<?
            			echo '<input type="hidden" name="id" disabled class="no_editable input1" value="'.$l->GetId().'">';
	            		$path .= ($ref->GetCol_1() != "")  ? '<tr class="tblresult"><td style="width:150px" align="left"><b>'.$ref->GetCol_1().':</b></td><td align="left"><input type="text" name="col_1" disabled class="no_editable input1" value="'.$l->GetCol_1().'"></td></tr>' : '';
						$path .= ($ref->GetCol_2() != "")  ? '<tr class="tblresult"><td style="width:150px" align="left"><b>'.$ref->GetCol_2().':</b></td><td align="left"><input type="text" name="col_2" disabled class="no_editable input1" value="'.$l->GetCol_2().'"></td></tr>' : '';
						$path .= ($ref->GetCol_3() != "")  ? '<tr class="tblresult"><td style="width:150px" align="left"><b>'.$ref->GetCol_3().':</b></td><td align="left"><input type="text" name="col_3" disabled class="no_editable input1" value="'.$l->GetCol_3().'"></td></tr>' : '';
						$path .= ($ref->GetCol_4() != "")  ? '<tr class="tblresult"><td style="width:150px" align="left"><b>'.$ref->GetCol_4().':</b></td><td align="left"><input type="text" name="col_4" disabled class="no_editable input1" value="'.$l->GetCol_4().'"></td></tr>' : '';
						$path .= ($ref->GetCol_5() != "")  ? '<tr class="tblresult"><td style="width:150px" align="left"><b>'.$ref->GetCol_5().':</b></td><td align="left"><input type="text" name="col_5" disabled class="no_editable input1" value="'.$l->GetCol_5().'"></td></tr>' : '';
						$path .= ($ref->GetCol_6() != "")  ? '<tr class="tblresult"><td style="width:150px" align="left"><b>'.$ref->GetCol_6().':</b></td><td align="left"><input type="text" name="col_6" disabled class="no_editable input1" value="'.$l->GetCol_6().'"></td></tr>' : '';
						$path .= ($ref->GetCol_7() != "")  ? '<tr class="tblresult"><td style="width:150px" align="left"><b>'.$ref->GetCol_7().':</b></td><td align="left"><input type="text" name="col_7" disabled class="no_editable input1" value="'.$l->GetCol_7().'"></td></tr>' : '';
						$path .= ($ref->GetCol_8() != "")  ? '<tr class="tblresult"><td style="width:150px" align="left"><b>'.$ref->GetCol_8().':</b></td><td align="left"><input type="text" name="col_8" disabled class="no_editable input1" value="'.$l->GetCol_8().'"></td></tr>' : '';
						$path .= ($ref->GetCol_9() != "")  ? '<tr class="tblresult"><td style="width:150px" align="left"><b>'.$ref->GetCol_9().':</b></td><td align="left"><input type="text" name="col_9" disabled class="no_editable input1" value="'.$l->GetCol_9().'"></td></tr>' : '';
						$path .= ($ref->GetCol_10() != "") ? '<tr class="tblresult"><td style="width:150px" align="left"><b>'.$ref->GetCol_10().':</b></td><td align="left"><input type="text" name="col_10" disabled class="no_editable input1" value="'.$l->GetCol_10().'"></td></tr>' : '';
						$path .= ($ref->GetCol_11() != "") ? '<tr class="tblresult"><td style="width:150px" align="left"><b>'.$ref->GetCol_11().':</b></td><td align="left"><input type="text" name="col_11" disabled class="no_editable input1" value="'.$l->GetCol_11().'"></td></tr>' : '';
						$path .= ($ref->GetCol_12() != "") ? '<tr class="tblresult"><td style="width:150px" align="left"><b>'.$ref->GetCol_12().':</b></td><td align="left"><input type="text" name="col_12" disabled class="no_editable input1" value="'.$l->GetCol_12().'"></td></tr>' : '';
						$path .= ($ref->GetCol_13() != "") ? '<tr class="tblresult"><td style="width:150px" align="left"><b>'.$ref->GetCol_13().':</b></td><td align="left"><input type="text" name="col_13" disabled class="no_editable input1" value="'.$l->GetCol_13().'"></td></tr>' : '';
						$path .= ($ref->GetCol_14() != "") ? '<tr class="tblresult"><td style="width:150px" align="left"><b>'.$ref->GetCol_14().':</b></td><td align="left"><input type="text" name="col_14" disabled class="no_editable input1" value="'.$l->GetCol_14().'"></td></tr>' : '';
						$path .= ($ref->GetCol_15() != "") ? '<tr class="tblresult"><td style="width:150px" align="left"><b>'.$ref->GetCol_15().':</b></td><td align="left"><input type="text" name="col_15" disabled class="no_editable input1" value="'.$l->GetCol_15().'"></td></tr>' : '';
						$path .= ($ref->GetCol_16() != "") ? '<tr class="tblresult"><td style="width:150px" align="left"><b>'.$ref->GetCol_16().':</b></td><td align="left"><input type="text" name="col_16" disabled class="no_editable input1" value="'.$l->GetCol_16().'"></td></tr>' : '';
						$path .= ($ref->GetCol_17() != "") ? '<tr class="tblresult"><td style="width:150px" align="left"><b>'.$ref->GetCol_17().':</b></td><td align="left"><input type="text" name="col_17" disabled class="no_editable input1" value="'.$l->GetCol_17().'"></td></tr>' : '';
						$path .= ($ref->GetCol_18() != "") ? '<tr class="tblresult"><td style="width:150px" align="left"><b>'.$ref->GetCol_18().':</b></td><td align="left"><input type="text" name="col_18" disabled class="no_editable input1" value="'.$l->GetCol_18().'"></td></tr>' : '';
						$path .= ($ref->GetCol_19() != "") ? '<tr class="tblresult"><td style="width:150px" align="left"><b>'.$ref->GetCol_19().':</b></td><td align="left"><input type="text" name="col_19" disabled class="no_editable input1" value="'.$l->GetCol_19().'"></td></tr>' : '';
						$path .= ($ref->GetCol_20() != "") ? '<tr class="tblresult"><td style="width:150px" align="left"><b>'.$ref->GetCol_20().':</b></td><td align="left"><input type="text" name="col_20" disabled class="no_editable input1" value="'.$l->GetCol_20().'"></td></tr>' : '';
						$path .= ($ref->GetCol_21() != "") ? '<tr class="tblresult"><td style="width:150px" align="left"><b>'.$ref->GetCol_21().':</b></td><td align="left"><input type="text" name="col_21" disabled class="no_editable input1" value="'.$l->GetCol_21().'"></td></tr>' : '';
						$path .= ($ref->GetCol_22() != "") ? '<tr class="tblresult"><td style="width:150px" align="left"><b>'.$ref->GetCol_22().':</b></td><td align="left"><input type="text" name="col_22" disabled class="no_editable input1" value="'.$l->GetCol_22().'"></td></tr>' : '';
						$path .= ($ref->GetCol_23() != "") ? '<tr class="tblresult"><td style="width:150px" align="left"><b>'.$ref->GetCol_23().':</b></td><td align="left"><input type="text" name="col_23" disabled class="no_editable input1" value="'.$l->GetCol_23().'"></td></tr>' : '';
						$path .= ($ref->GetCol_24() != "") ? '<tr class="tblresult"><td style="width:150px" align="left"><b>'.$ref->GetCol_24().':</b></td><td align="left"><input type="text" name="col_24" disabled class="no_editable input1" value="'.$l->GetCol_24().'"></td></tr>' : '';
						$path .= ($ref->GetCol_25() != "") ? '<tr class="tblresult"><td style="width:150px" align="left"><b>'.$ref->GetCol_25().':</b></td><td align="left"><input type="text" name="col_25" disabled class="no_editable input1" value="'.$l->GetCol_25().'"></td></tr>' : '';
						$path .= ($ref->GetCol_26() != "") ? '<tr class="tblresult"><td style="width:150px" align="left"><b>'.$ref->GetCol_26().':</b></td><td align="left"><input type="text" name="col_26" disabled class="no_editable input1" value="'.$l->GetCol_26().'"></td></tr>' : '';
						$path .= ($ref->GetCol_27() != "") ? '<tr class="tblresult"><td style="width:150px" align="left"><b>'.$ref->GetCol_27().':</b></td><td align="left"><input type="text" name="col_27" disabled class="no_editable input1" value="'.$l->GetCol_27().'"></td></tr>' : '';
						$path .= ($ref->GetCol_28() != "") ? '<tr class="tblresult"><td style="width:150px" align="left"><b>'.$ref->GetCol_28().':</b></td><td align="left"><input type="text" name="col_28" disabled class="no_editable input1" value="'.$l->GetCol_28().'"></td></tr>' : '';
						$path .= ($ref->GetCol_29() != "") ? '<tr class="tblresult"><td style="width:150px" align="left"><b>'.$ref->GetCol_29().':</b></td><td align="left"><input type="text" name="col_29" disabled class="no_editable input1" value="'.$l->GetCol_29().'"></td></tr>' : '';
						$path .= ($ref->GetCol_30() != "") ? '<tr class="tblresult"><td style="width:150px" align="left"><b>'.$ref->GetCol_30().':</b></td><td align="left"><input type="text" name="col_30" disabled class="no_editable input1" value="'.$l->GetCol_30().'"></td></tr>' : '';

						echo $path;
            		?>
            		</table>
           		</form>
            </div>
        </li>		
<?
		}
?>			
	</ul>
</div>

<script>
	$('tr.tblresult:not([th]):even').addClass('par');
	$('tr.tblresult:not([th]):odd').addClass('impar');

    $(".titulolista").click(function(){
        if(!$(this).parent().hasClass("active")){
            
            $('div.cuerpolista').slideUp("fast");
            $("ul#listadonovedades > li").removeClass("active");
            $(".titulolista").removeClass("active");

            $(this).parent().children('div.cuerpolista').slideDown("fast");
            $(this).parent().addClass("active")
            $(this).addClass("active")
        }else{
            $(this).parent().children('div.cuerpolista').slideUp("fast");
            $(this).parent().removeClass("active")
            $(this).removeClass("active")
        }
    })

	function EliminarBig_data(id){
		if(confirm('Esta seguro desea eliminar este formulario')){
			var URL = '/big_data/eliminar/'+id+'/';
			$.ajax({
				type: 'POST',
				url: URL,
				success: function(msg){
					alert(msg);
					$('#li'+id).remove();
				}
			});
		}
		
	}	

	function EditarBig_data(id){
		var URL = '<?= HOMEDIR ?>big_data/editar/'+id+'/';
		$.ajax({
			type: 'POST',
			url: URL,
			success: function(msg){
				$('#divtoshow').html(msg);
			}
		});
	}

	function EditForm(id){
		$('#FormUpdatebig_data'+id+' .input1').removeClass('no_editable');
		$('#FormUpdatebig_data'+id+' .input1').addClass('editable');
		$('#FormUpdatebig_data'+id+' .input1').prop('disabled', false);
		$('#FormUpdatebig_data'+id+' #edit_opc').hide();
		$('#FormUpdatebig_data'+id+' #save_opc').show();
	}	
</script>		
<style type="text/css">
	#contenido_bloque ul{
	    list-style: none;
	    text-align: left;
	    width: 100%;
	    padding-left: 0px;
	    margin-top: 0px;
	}
	#contenido_bloque li{
	    border-bottom: 1px solid #CCC;
	    width: 100%;    
	}
	#contenido_bloque .titulolista{
	    font-size:13px;
	    font-weight:bold;
	    color:#000;
	    cursor: pointer;
	    padding-left:10px;
	    font-size: 14px;
	    line-height: 35px;
	    min-height: 35px;
	}
	#contenido_bloque .titulolista:hover, #contenido_bloque .titulolista.active{
		background-color: #f5f5f5;
	}

	#contenido_bloque .cuerpolista{
	    padding-left: 15px;
	    padding-right: 15px;
	    padding-bottom: 15px;
	    display: none;
	    margin-bottom: 7px;
	    text-align: justify;
	    line-height: 17px;
	}
</style>