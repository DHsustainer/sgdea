
function View292(){


	var hoy = new Date();
	var dd = hoy.getDate();
	var mm = hoy.getMonth()+1;
	var yyyy = hoy.getFullYear();

//	
	var html = "";
	$( ".midestinatario_nombre" ).each(function( index, element ) {

		role = $(this).attr("data-role");

		if ($('#nombre_destinatario'+role).val() != "") {

	
		if ($('#titulo'+role).val() == "CE") {
				html += `
							<table width="600" align="center" cellspacing="0" cellpadding="0"> 
								<tbody> 
									<tr> 
									<td style="background: rgb(252, 252, 252); border: 1px solid rgb(245, 245, 245); margin-top: 10px; padding: 15px;" align="justify">
										<p>
											<font color="#444444"><span style="font-size: 12px;">REMITENTE:&nbsp;</span></font>
											<b style="text-align: left;">`+$('#nombresuscriptor').val()+`</b>
										</p>
										<p>
											<font color="#444444"><span style="font-size: 12px;">DESTINATARIO:&nbsp;</span></font>
											<b style="text-align: left;">`+$('#nombre_destinatario'+role).val()+`</b>
										</p>
										<p>
											<font color="#444444"><span style="font-size: 12px;">DEMANDADO:&nbsp;</span></font>
											<b style="text-align: left;">`+$('#nombre_notificado'+role).val()+`</b>
										</p>
										<p>
											<font color="#444444"><span style="font-size: 12px;">ASUNTO:&nbsp;</span></font>
											<b style="text-align: left;">`+$('#observacion').val()+`.</b>
										</p>
										<p>
											<font color="#444444"><span style="font-size: 12px;">RADICADO:&nbsp;</span></font>
											<b style="text-align: left;">`+$('#radicado').val()+`.</b>
										</p>
										<p style="text-align: justify;"><span style="text-align: left; font-size: 12px;"><font color="#444444">JUZGADO</font></span>
											<span style="text-align: left;">`+$('#campot1').val()+`.</span>
										</p>
										<p style="text-align: justify;">
											<span style="text-align: left; font-size: 12px;"><font color="#444444">CIUDAD JUZGADO</font></span>
										<span style="text-align: left;">`+$('#campot2').val()+`, `+$('#campot3').val()+`, `+$('#campot4').val()+`.</span>
										</p>
										<p style="text-align: justify;">
											<span style="text-align: left; font-size: 12px;"><font color="#444444">ART&Iacute;CULO / TIPO DE CORRESPONDENCIA</font></span>
											<span style="text-align: left;">`+$('#campot5').val()+`.</span>
										</p>
										
										<p style="text-align: justify;">
											<span style="text-align: left; font-size: 12px;"><font color="#444444">NATURALEZA DEL PROCESO</font></span>
											<span style="text-align: left;">`+$('#campot6').val()+`.</span>
										</p>
										<p style="text-align: justify;">
											<span style="text-align: left; font-size: 12px;"><font color="#444444">HORARIO DEL JUZGADO</font></span>
										<span style="text-align: left;">`+$('#campot7').val()+`.</span>
										</p>
										<p style="text-align: justify;">
											<span style="text-align: left; font-size: 12px;"><font color="#444444">DIAS PARA COMPARECER</font></span>
											<span style="text-align: left;">`+$('#campot8').val()+`.</span>
										</p>
										
										<p style="text-align: justify;">
											<span style="text-align: left; font-size: 12px;"><font color="#444444">ANEXO</font></span>
											<span style="text-align: left;">`+$('#campot9').val()+`.</span>
										</p>
										
										<p style="text-align: justify;">
											<span style="text-align: left; font-size: 12px;"><font color="#444444">FECHA PROVIDENCIA 1</font></span>
											<span style="text-align: left;">`+$('#campot11').val()+`.</span>
										</p>
										<p style="text-align: justify;">
											<span style="text-align: left; font-size: 12px;"><font color="#444444">CUERPO DEL MENSAJE</font></span>
											<span style="text-align: left;">`+$('#observacion2').val()+`.</span>
										</p>
									</td>
								</tr>
								</tbody>
							</table>`;
		}else{
 	
			html += `<div style="font-size: 16px; background: URL(https://procesos.controlatuproceso.com/app/views/assets/images/borrador.png); background-size:cover">
				<div class="alert alert-info" role="alert">Antes de Crear la notificación, por favor verifique que toda la información ingresada sea correcta</div>
		  		<table style="width:100%;">
				  	<tr>
				      	<td></td>
				      	<td width="100%" align="center">
				        	<div><b>`+$('#campot1').val()+`</b></div>
				        	<div><small>`+$('#campot2').val()+` `+$('#campot3 option:selected').text()+` - `+$('#campot4').val()+`</small></div>
				      	</td>
				      	<td style="text-align: center;" nowrap>
				        	<div style="border: 1px solid #000;    width: 120px;    height: 25px;">00000000</div>
				        	<div>No. consecutivo</div>
				      	</td>
				    </tr>
				</table>
				<table style="width:100%; text-align:center;margin:0 auto;">
				    <tr>
				      	<td><b>NOTIFICACION POR AVISO ART. 292. DEL C.G.P</b></td>
				    </tr>
				</table>
		    	<br>
		    	<div><b>Señor (a):</b></div>
				<table style="width:100%;">
					<tr>
				    	<td colspan="4">`+$(this).val()+`</td>
					</tr>
					<tr>
						<td colspan="4">
								`+$('#identificacion_destinatario'+role).val()+`
						</td>
					</tr>
					<tr>
			    		<td colspan="4">
			  				`+$('#direccion_destinatario'+role).val()+`
			    		</td>
			    	</tr>
					<tr>
						<td colspan="4">
								`+$('#ciudad_destinatario'+role+' option:selected').text()+` - `+$('#departamento_destinatario'+role+' option:selected').text()+`
						</td>
					</tr>
					<tr>
				    	<td style="width:100%;"></td>
				    	<td style="text-align:center;"><b>DD/</b></td>
				    	<td style="text-align:center;"><b>MM/</b></td>
				   		<td style="text-align:center;"><b>AAAA</b></td>
				    </tr>
				   	<tr>
						<td><b></b></td>
				        <td style="text-align:center;">`+dd+`</td>
				        <td style="text-align:center;">`+mm+`</td>
				       <td style="text-align:center;">`+yyyy+`</td>
				    </tr>
				</table>
				<br>
				<table style="width:100%;" border="1" cellpadding="0" cellspacing="0">
					<tr>
						<td style="width:34%;text-align:center;"><b>No. Radicación del Proceso</b></td>
						<td style="width:33%;text-align:center;"><b>Naturaleza del Proceso</b></td>
						<td style="width:33%;text-align:center;"><b>Fecha de providencia</b></td>
					</tr>
					<tr>
						<td style="width:34%;text-align:center;padding:2px;">`+$('#radicado').val()+`</td>
						<td style="width:33%;text-align:center;padding:2px;">`+$('#campot6 option:selected').val()+`</td>
						<td style="width:33%;text-align:center;padding:2px;">`+$('#campot11').val()+`<br>`+$('#campot12').val()+`<br>`+$('#campot13').val()+` </td>
					</tr>
				</table>
				<br>
				<table style="width:100%;" border="1" cellpadding="0" cellspacing="0">
					<tr> 
						<td style="width:50%;text-align:center;"><b>Demandante</b></td>
						<td style="width:50%;text-align:center;"><b>Demandado</b></td>
					</tr>
					<tr>
						<td style="width:50%;text-align:center;padding:2px;">`+$('#nombresuscriptor').val()+`</td>
						<td style="width:50%;text-align:center;padding:2px;">`+$('#nombre_notificado'+role).val()+`</td> 
					</tr>
				</table>
		    	<br>

		      	<table style="width:100%;">
		      		<tr>
		      			<td style="text-align:justify;">Por intermedio de este aviso le notifico la providencia calendada `+$('#campot11').val()+` - `+$('#campot12').val()+` - `+$('#campot13').val()+` `+$('#campot9').val()+` proferida en el indicado proceso.<br><br>
		  					Se advierte que esta Notificación se considerará cumplida al finalizar el día siguiente al de la FECHA DE ENTREGA de este aviso.<br><br>

		  					PARA NOTIFICAR AUTO ADMISORIO DE DEMANDA O MANDAMIENTO DE PAGO,
		  				</td>
		        	</tr>
		        	<tr>
		        		<td style="text-align:justify;"><br><b>Anexo:</b>  `+$('#campot9').val()+`</td>
		      		</tr>
		    	</table>
		    	<br> 
		    	<div style="border:1px solid #000; width:98%; padding:1%;"> 
				    <table style="width:100%;">
						<tr>
							<td align="center" ><b>PARTE INTERESADA</b></td>
						</tr>
						<tr>
					      <td><br></td>
					    </tr>
						<tr>
							<td style="font-size: 15px;">`+$('#responsble_firma option:selected').text()+`</td>
						</tr>
						<tr>
							<td style="border-top:1px solid #000;"><b>Nombres y Apellidos</b></td>
						</tr>
						<tr>
					      <td><br></td>
					    </tr>
						<tr>
							<td><img src='`+$('#firma_abogado').val()+`'></td>
						</tr>  
						<tr>
							<td style="border-top:1px solid #000;"><b>FIRMA</b></td>
						</tr>
						<tr>
					      <td><br></td>
					    </tr>
						<tr>
							<td >`+$('#cedula_abogado').val()+`</td>
						</tr>
						<tr>
							<td style="border-top:1px solid #000;"><b>C.C.</b></td>
						</tr>
				    </table>
		    	</div>
				<br>
			</div>`;
		}
		}
	});
	return html;
}

function View291(){

	var hoy = new Date();
	var dd = hoy.getDate();
	var mm = hoy.getMonth()+1;
	var yyyy = hoy.getFullYear();
	
	var html = "";
	$( ".midestinatario_nombre" ).each(function( index, element ) {

		role = $(this).attr("data-role");

		if ($('#nombre_destinatario'+role).val() != "") {
			
		
	  
	  	if ($('#titulo'+role).val() == "CE") {
			html += `
							<table width="600" align="center" cellspacing="0" cellpadding="0"> 
								<tbody> 
									<tr> 
									<td style="background: rgb(252, 252, 252); border: 1px solid rgb(245, 245, 245); margin-top: 10px; padding: 15px;" align="justify">
										<p>
											<font color="#444444"><span style="font-size: 12px;">REMITENTE:&nbsp;</span></font>
											<b style="text-align: left;">`+$('#nombresuscriptor').val()+`</b>
										</p>
										<p>
											<font color="#444444"><span style="font-size: 12px;">DESTINATARIO:&nbsp;</span></font>
											<b style="text-align: left;">`+$('#nombre_destinatario'+role).val()+`</b>
										</p>
										<p>
											<font color="#444444"><span style="font-size: 12px;">DEMANDADO:&nbsp;</span></font>
											<b style="text-align: left;">`+$('#nombre_notificado'+role).val()+`</b>
										</p>										
										<p>
											<font color="#444444"><span style="font-size: 12px;">ASUNTO:&nbsp;</span></font>
											<b style="text-align: left;">`+$('#observacion').val()+`.</b>
										</p>
										<p>
											<font color="#444444"><span style="font-size: 12px;">RADICADO:&nbsp;</span></font>
											<b style="text-align: left;">`+$('#radicado').val()+`.</b>
										</p>
											<p style="text-align: justify;"><span style="text-align: left; font-size: 12px;"><font color="#444444">JUZGADO</font></span>
											<span style="text-align: left;">`+$('#campot1').val()+`.</span>
										</p>
										<p style="text-align: justify;">
											<span style="text-align: left; font-size: 12px;"><font color="#444444">CIUDAD JUZGADO</font></span>
										<span style="text-align: left;">`+$('#campot2').val()+`, `+$('#campot3').val()+`, `+$('#campot4').val()+`.</span>
										</p>
										<p style="text-align: justify;">
											<span style="text-align: left; font-size: 12px;"><font color="#444444">ART&Iacute;CULO / TIPO DE CORRESPONDENCIA</font></span>
											<span style="text-align: left;">`+$('#campot5').val()+`.</span>
										</p>
										
										<p style="text-align: justify;">
											<span style="text-align: left; font-size: 12px;"><font color="#444444">NATURALEZA DEL PROCESO</font></span>
											<span style="text-align: left;">`+$('#campot6').val()+`.</span>
										</p>
										<p style="text-align: justify;">
											<span style="text-align: left; font-size: 12px;"><font color="#444444">HORARIO DEL JUZGADO</font></span>
										<span style="text-align: left;">`+$('#campot7').val()+`.</span>
										</p>
										<p style="text-align: justify;">
											<span style="text-align: left; font-size: 12px;"><font color="#444444">DIAS PARA COMPARECER</font></span>
											<span style="text-align: left;">`+$('#campot8').val()+`.</span>
										</p>
										
										<p style="text-align: justify;">
											<span style="text-align: left; font-size: 12px;"><font color="#444444">ANEXO</font></span>
											<span style="text-align: left;">`+$('#campot9').val()+`.</span>
										</p>
										
										<p style="text-align: justify;">
											<span style="text-align: left; font-size: 12px;"><font color="#444444">FECHA PROVIDENCIA 1</font></span>
											<span style="text-align: left;">`+$('#campot11').val()+`.</span>
										</p>
										<p style="text-align: justify;">
											<span style="text-align: left; font-size: 12px;"><font color="#444444">CUERPO DEL MENSAJE</font></span>
											<span style="text-align: left;">`+$('#observacion2').val()+`.</span>
										</p>
									</td>
								</tr>
								</tbody>
							</table>`;
		}else{
			
		
	
			html += `<div style="font-size: 16px; background: URL(https://procesos.controlatuproceso.com/app/views/assets/images/borrador.png); background-size:cover">
		<div class="alert alert-info" role="alert">Antes de Crear la notificación, por favor verifique que toda la información ingresada sea correcta</div>
	<table style="width:100%;">
	  <tr>
	      <td></td>
	      <td width="100%" align="center">
	        <div><b>`+$('#campot1').val()+`</b></div>
	        <div><small>`+$('#campot2').val()+` `+$('#campot3 option:selected').text()+` - `+$('#campot4').val()+`</small></div>
	      </td>
	      <td style="text-align: center;" nowrap>
	        <div style="border: 1px solid #000;    width: 120px;    height: 25px;">00000000</div>
	        <div>No. consecutivo</div>
	      </td>
	    </tr>
	 </table>
	<table style="width:100%; text-align:center;margin:0 auto;">
		<tr>
			<td>
				<b>
	        	CITACION PARA DILIGENCIA DE NOTIFICACION PERSONAL ART. 291. DEL C.G.P
	          	</b>
	        </td>
	    </tr>
	  </table>
	  <br>
	  <div><b>Señor (a):</b></div>
	 	<table style="width:100%;">
	  		<tr>
	        	<td colspan="4">`+$(this).val()+`</td>
	    	</tr>
	    	<tr>
	    		<td colspan="4">
	  				`+$('#identificacion_destinatario'+role).val()+`
	    		</td>
	    	</tr>
	    	<tr>
	    		<td colspan="4">
	  				`+$('#direccion_destinatario'+role).val()+`
	    		</td>
	    	</tr>
	    	<tr>
	    		<td colspan="4">
	  				`+$('#ciudad_destinatario'+role+' option:selected').text()+` - `+$('#departamento_destinatario'+role+' option:selected').text()+`
	    		</td>
	    	</tr>
	  		<tr>
	        	<td style="width:100%;"></td>
	        	<td style="text-align:center;"><b>DD/</b></td>
	        	<td style="text-align:center;"><b>MM/</b></td>
	       		<td style="text-align:center;"><b>AAAA</b></td>
		    </tr>
		   	<tr>
				<td><b></b></td>
		        <td style="text-align:center;">`+dd+`</td>
		        <td style="text-align:center;">`+mm+`</td>
		       <td style="text-align:center;">`+yyyy+`</td>
		    </tr>
	  	</table>
	    <br>
	  <br>
	   <table style="width:100%;" border="1" cellpadding="0" cellspacing="0">
	    <tr>
	    <td style="width:34%;text-align:center;"><b>No. Radicación del Proceso</b></td>
	       <td style="width:33%;text-align:center;"><b>Naturaleza del Proceso</b></td>
	      <td style="width:33%;text-align:center;"><b>Fecha de providencia</b></td>
	    </tr>
	    <tr>
	    	<td style="width:34%;text-align:center;padding:2px;">`+$('#radicado').val()+`</td>
			<td style="width:33%;text-align:center;padding:2px;">`+$('#campot6 option:selected').val()+`</td>
			<td style="width:33%;text-align:center;padding:2px;">`+$('#campot11').val()+` <br> `+$('#campot12').val()+` <br> `+$('#campot13').val()+` <br> `+$('#campot14').val()+` </td>
	    </tr>
	  </table>
	    <br>
	    <br>
	  <table style="width:100%;" border="1" cellpadding="0" cellspacing="0">
	    <tr> 
	      <td style="width:50%;text-align:center;"><b>Demandante</b></td>
	      <td style="width:50%;text-align:center;"><b>Demandado</b></td>
	    </tr>
	    <tr>
	    <td style="width:50%;text-align:center;padding:2px;">`+$('#nombresuscriptor').val()+`</td>
	       <td style="width:50%;text-align:center;padding:2px;">`+$('#nombre_notificado'+role).val()+`</td> 
	    </tr>
	  </table>
	  <br>
	    <br>
	    <table style="width:100%;">
	    <tr>
			<td style="text-align:justify;">Sírvase comparecer a este Despacho de inmediato, dentro de los (<b>`+$('#campot8').val()+`</b>), días hábiles siguientes a la entrega de esta comunicación, de `+$('#campot7 option:selected').val()+`, con el fin de notificarle personalmente la providencia proferida en el indicado proceso.</td>
	    </tr>
	  </table>
	  <br>  <br>
	  <div style="border:1px solid #000; width:98%; padding:1%;"> 
	  <table style="width:100%;">
	    <tr>
	      <td align="center" ><b>PARTE INTERESADA</b></td>
	    </tr>
	    <tr>
	      <td><br></td>
	    </tr>
	    <tr>
	      <td style="font-size: 15px;">`+$('#responsble_firma option:selected').text()+`</td>
	    </tr>
	    <tr>
	      <td style="border-top:1px solid #000;"><b>Nombres y Apellidos</b></td>
	    </tr>
	    <tr>
	      <td><br></td>
	    </tr>
	    <tr>
	      <td ><img src='`+$('#firma_abogado').val()+`'></td>
	    </tr>
	  
	     <tr>
	      <td style="border-top:1px solid #000;"><b>FIRMA</b></td>
	    </tr>
	    
	     <tr>
	      <td ><br></td>
	    </tr>
	    <tr>
	      <td >`+$('#cedula_abogado').val()+`</td>
	    </tr>  
	     <tr>
	      <td style="border-top:1px solid #000;"><b>C.C.</b></td>
	    </tr>
	  </table>
	  			</div>
			<br>
		</div>`;
		}  
		}
	});
	

	return html;
}

function CheckDocument(idp){
	var hoy = new Date();
	var dd = hoy.getDate();
	var mm = hoy.getMonth()+1;
	var yyyy = hoy.getFullYear();
	var html = "";
	var dias = {"2":"Dos","5":"Cinco","10":"Diez","30":"Treinta"};
	var btnadjuntos = '<ul style="list-style: none;margin-left: 0px;padding-left: 0px;"><li class="list-group-item" style = "list-style: none; border: 1px solid #CCC; padding: 10px;border-radius: 5px; margin-bottom: 5px;"><a href="#" style="font-weight: bold;">Espacio Para Documentos Adjuntos</a></li></ul>';

	if (idp == "") {
		idp = "76";
	}
	
	$("#myXLargeModalBody").css("background", "URL(https://procesos.controlatuproceso.com/app/views/assets/images/borrador.png)");
	$("#myXLargeModalBody").css("background-size", "cover");

	$( ".midestinatario_nombre" ).each(function( index, element ) {

		role = $(this).attr("data-role");

		if ($('#nombre_destinatario'+role).val() != "") {
			
			var newstring = "";
			var URL = '/gestion/getplantilla/'+idp+'/'+$("#responsble_firma").val()+"/"+$("#id_gestion").val()+"/";

	        $.ajax({
	            type: 'POST',
	            url: URL,
	            success:function(msg){
	            	//var newstring = string.replace(/GeeksForGeeks/, 'gfg'); 
	            	newstring = "<div class='alert alert-info'>Solo se visualiza un destinatario</div>"+msg;
	            	newstring = newstring.replace("[elemento]CAMPOT1[/elemento]", 	 				$('#campot1').val() );
					newstring = newstring.replace("[elemento]CAMPOT2[/elemento]", 	 				$('#campot2').val() );
					newstring = newstring.replace("[elemento]CAMPOT2[/elemento]", 	 				$('#campot2').val() );
					newstring = newstring.replace("[elemento]CAMPOT3[/elemento]", 	 				$('#campot3').val() );
					newstring = newstring.replace("[elemento]CAMPOT4[/elemento]", 	 				$('#campot4').val() );
					newstring = newstring.replace("[elemento]CAMPOT6[/elemento]", 	 				$('#campot6').val() );
					newstring = newstring.replace("[elemento]CAMPOT8[/elemento]",  	 				$('#campot8').val() );
					

					fecha_providencia = $('#campot11').val();
					if ($('#campot12').val() != "") {
						fecha_providencia += " <br> "+$('#campot12').val();
					}
					if ($('#campot13').val() != "") {
						fecha_providencia += " <br> "+$('#campot13').val();
					}

					newstring = newstring.replace("[elemento]CAMPOT11[/elemento]", 	 				fecha_providencia );
					
					newstring = newstring.replace("[elemento]CAMPOT15[/elemento]", 	 				$('#campot15').val() );
					newstring = newstring.replace("[elemento]CAMPOT14[/elemento]", 	 				$('#campot14').val() );
					newstring = newstring.replace("[elemento]CAMPOT9[/elemento]", 	 				$('#campot9').val() );
					newstring = newstring.replace("[elemento]GUIA[/elemento]", 		 				"#################" );
					newstring = newstring.replace("[elemento]LOGOCOURRIER[/elemento]", 				"" );
					newstring = newstring.replace("[elemento]LOGO[/elemento]", 		 				"" );
					newstring = newstring.replace("[elemento]BOTON_ADJUNTOS[/elemento]", 		    btnadjuntos );
					newstring = newstring.replace("[elemento]destinatario[/elemento]", 					$('#nombre_destinatario'+role).val() );
					newstring = newstring.replace("[elemento]identificacion_destinatario[/elemento]", 	$('#identificacion_destinatario'+role).val() );
					newstring = newstring.replace("[elemento]email_destinatario[/elemento]", 			$('#email_destinatario'+role).val() );
					newstring = newstring.replace("[elemento]rad_externo[/elemento]",  					$('#radicado').val() );
					newstring = newstring.replace("[elemento]CAMPOT8L[/elemento]", 	 					dias[$('#campot8').val()] );
					newstring = newstring.replace("[elemento]observacion[/elemento]",  					$('#observacion').val() );
					newstring = newstring.replace("[elemento]OBSERVACION2[/elemento]",  				$('#observacion2').val() );					
					newstring = newstring.replace("[elemento]demandante[/elemento]",  				$('#nombresuscriptor').val() );
					newstring = newstring.replace("[elemento]demandado[/elemento]",  				$('#demandados_nombres').val() );

					newstring = newstring.replace("background: #FFF",  				"" );
					newstring = newstring.replace("background: #fcfcfc;",  				"" );

					newstring = newstring.replace('<img src="[elemento]HOMEDIR[/elemento]/s/read_mail/[elemento]TOKEN[/elemento]/" border="0">', 		    "" );

					$("#myXLargeModalBody").append(newstring);
	                
	            }
	        });		
		}
		return false;
	});

}