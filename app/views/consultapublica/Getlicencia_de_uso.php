<?
  	$sadmin = new MSuper_admin;
    $sadmin->CreateSuper_admin("id", "6");
    $uri = "";
    if ($sadmin->GetFoto_perfil() == "") {
      	$uri = HOMEDIR.DS."app/views/assets/images/logo_expedientes2.png";
    }else{
    	$uri = HOMEDIR.DS.'app/plugins/thumbnails/'.$sadmin->GetFoto_perfil();
    }
?>

<div class="container bodycontainer">
	<div class="row">
		<div class="col-md-12">
        
			<header>
	          <h2>Licencia de Uso</h2>
	        </header>

			<p> 
			<strong>CLAUSULA PRIMERA. NATURALEZA.-</strong>  <em><?= HOMEDIR ?></em>, es un software hecho para abogados basado en el código general del proceso, facilitándoles a los profesionales en derecho la posibilidad de ejercer el litigio en línea, realizado con últimas tecnologías de la computación en nuestro  aplicativo web  el procesamiento y almacenamiento de información se hace en los servidores de <strong><?= $sadmin->Getp_nombre(); ?></strong>. </p>
			<p> 
			<strong>CLAUSULA SEGUNDA. CONFIGURACIÓN.</strong> Aceptado el plan y realizados los pagos correspondientes, <strong><?= $sadmin->Getp_nombre(); ?></strong> previo acuerdo entre las partes, hará entrega de un usuario y contraseña necesarios para el ingreso a <em><?= HOMEDIR ?></em>, documentación y manuales necesarios para operar el mismo. Estas claves son de uso personal y exclusivo, el uso inadecuado será responsabilidad única y exclusiva del usuario. </p>
			<p>  
			<strong>CLAUSULA TERCERA. VIGENCIA.</strong>- la vigencia de la prestación del servicio será la indicada y aceptada en los planes acordados en nuestra propuesta comercial. La prestación del servicio se inicia una vez realizado y efectivamente recaudado el pago de la  factura. En caso de facturación mensual, la prestación del servicio se inicia una vez realizado y efectivamente recaudado el pago de la primera factura. <strong><?= $sadmin->Getp_nombre(); ?></strong> puede suspender el servicio en el evento de falta de pago dentro de los cinco (5) días siguientes a la fecha de pago establecido en la factura. </p>
			<p>  
			<strong>CLAUSULA CUARTA. TITULARIDAD.</strong>- EL USUARIO   no adquirirá la propiedad sobre <em><?= HOMEDIR ?></em>  y no podrá utilizarlo para fines distintos a los aquí previstos. EL USUARIO reconoce que <strong><?= $sadmin->Getp_nombre(); ?></strong> es la única titular de los derechos de autor sobre <em><?= HOMEDIR ?></em>. Así mismo, <strong><?= $sadmin->Getp_nombre(); ?></strong> reconoce que la titularidad de los derechos de autor sobre la información y los contenidos generados por el  USUARIO pertenece de forma exclusiva a EL USUARIO. </p>
			<p>  
			<strong>CLAUSULA QUINTA. SEGURIDAD.</strong>- <strong><?= $sadmin->Getp_nombre(); ?></strong> cuenta con la infraestructura de seguridad necesaria que incluye políticas de administración de información, sistema de respaldo, seguridad perimetral necesaria FIREWALL, REUTERS y SSL, entre otros y las que se consideren necesarias de acuerdo con las mejores prácticas de seguridad informática. <em><?= HOMEDIR ?></em> solo opera vía SSL, para garantizar que la información se transmite con un encriptado de alta seguridad. </p>
			<p>  
				<strong>CLAUSULA SEXTA.</strong> Manera en la que se suministra <em><?= HOMEDIR ?></em>. el usuario acepta que el servicio se provee “tal y como se presenta”, es decir, que no es un servicio a la medida, por lo que  <strong><?= $sadmin->Getp_nombre(); ?></strong>  no garantiza en ningún caso que las funciones que contiene, satisfagan las necesidades individuales y especiales del usuario, ni que la aplicación funcione ininterrumpidamente o sin errores, y que en caso de que se presenten se harán las respectivas correcciones estipulados en los acuerdos de servicios.
			</p>
			<p> 
				<strong>CLAUSULA SÉPTIMA. REQUERIMIENTOS TÉCNICOS DEL USUARIO.</strong>- para el correcto funcionamiento de <em><?= HOMEDIR ?></em>, el usuario debe contar con la siguiente configuración:
	 	  <ul>
			 		<li><strong>navegador:</strong> Mozilla Firefox o Chrome.</li>
			 
					<li><strong>conectividad a internet:</strong> la de velocidad con la que funcione <em><?= PROJECTNAME ?></em> depende de esta conexión, que es responsabilidad exclusiva del usuario. <strong><?= $sadmin->Getp_nombre(); ?></strong> en ningún caso responde por las fallas de internet que tenga contratado el usuario. en todo caso, <strong><?= $sadmin->Getp_nombre(); ?></strong> cuenta con un ancho de banda suficiente y redundante para atender las necesidades de los usuarios.</li>
			 	</ul>
			</p>
			<p> 			
				<strong>CLAUSULA OCTAVA. OBLIGACIONES DEL USUARIO.</strong>-
				<ol>
					<li>Es responsabilidad exclusiva del usuario el manejo y buen uso de las contraseñas suministradas por <strong><?= $sadmin->Getp_nombre(); ?></strong> EL USUARIO no permitirá su utilización por parte de terceras personas.</li>
					
					<li>Utilizar <em><?= HOMEDIR ?></em> conforme a lo dispuesto  en el manual del USUARIO</li>
					
					<li>Contar con un sistema informático en buen estado, libre de virus y spyware.</li> 
					
					<li>El Usuario será responsable por todos los perjuicios que pueda causar a <strong><?= $sadmin->Getp_nombre(); ?></strong>  o a terceros derivados del uso inadecuado de las claves de acceso  y mantendrá indemne a <strong><?= $sadmin->Getp_nombre(); ?></strong> frente a cualquier reclamación que se presente con ocasión de dichos actos. <strong><?= $sadmin->Getp_nombre(); ?></strong> comunicará al usuario las reclamaciones que recibiera, para que el usuario pueda intervenir a su cargo la defensa legal, debiendo EL USUARIO actuar en todo momento de forma coordinada con <strong><?= $sadmin->Getp_nombre(); ?></strong> y preservando la imagen de <strong><?= $sadmin->Getp_nombre(); ?></strong>.</li>
				</ol>
			</p>
			<p> 		  
				<strong>CLAUSULA NOVENA. OBLIGACIONES DE  <strong><?= $sadmin->Getp_nombre(); ?></strong>.</strong>
				<ol>
			  		<li>JIMAJO TECNOLOGIA JURIDICA se obliga para con EL USUARIO a permitirle el acceso y utilización en línea de <em><?= PROJECTNAME ?></em>, durante el tiempo que dure la suscripción, que forma parte y se encontrará en la plataforma de <strong><?= $sadmin->Getp_nombre(); ?></strong> alojado en los servidores con los que cuente <strong><?= $sadmin->Getp_nombre(); ?></strong>, de acuerdo con los términos aquí previstos, los que estén especificados en el manual del usuario y en cualquier otra documentación que resulte aplicable, ya conste en papel, disco, en memoria de solo lectura del computador, o bien en cualquier otro soporte que en cada momento sea de aplicación,  por el término que dure la afiliación.</li>
			  
			  		<li>JIMAJO TECNOLOGIA JURIDICA cumplirá adecuadamente y en todo momento las disposiciones contenidas en la normativa de protección de datos que sea aplicable con respecto de las informaciones y datos manejados durante la vigencia de la afiliación a <em><?= HOMEDIR ?></em>.</li>
			  
			  		<li>Realizar la capacitación inicial y entregar manual del usuario. </li>
			  
			  		<li>Cumplir con lo establecido en el acuerdo  de servicio.</li>
			  
			  		<li>JIMAJO TECNOLOGIA JURIDICA garantiza una capacidad de almacenamiento ilimitado.</li>
			  </ol>		  
			</p>
			<p> 		  
				<strong>CLAUSULA DÉCIMA. ACUERDO DE SERVICIO. <strong><?= $sadmin->Getp_nombre(); ?></strong></strong> se compromete a garantizar el 99% de disponibilidad de <em><?= HOMEDIR ?></em>.
			</p>
			<p> 		  
				<strong>CLAUSULA DÉCIMA PRIMERA. EXONERACIÓN DE RESPONSABILIDAD. <strong><?= $sadmin->Getp_nombre(); ?></strong></strong> no será en ningún caso responsable por:
				<ol>
				  	<li>El uso indebido de las claves por parte del usuario o de terceros, no  responderá por sanciones y gastos derivados de reclamaciones de las personas afectadas, por negligencia y/o falta de confidencialidad, uso y/o tratamientos indebidos de los datos de carácter personal, incluyendo expresamente cualesquiera importes derivados de las sanciones que, eventualmente, pudieran imponer la autoridad competente en materia de protección de datos por el incumplimiento o cumplimiento defectuoso de la normativa aplicable en esta materia.</li>

				  	<li>La suspensión de <em><?= HOMEDIR ?></em> originada en fallas técnicas u operativas ajenas a su voluntad, ni de aquellas que escapen de su control tales como cortes de energía eléctrica, fallas en los equipos o programas de computación, o en general por eventos de fuerza mayor o caso fortuito.</li>
				  	
				  	<li>Los errores de funcionamiento o de los daños provocados por el incumplimiento de las obligaciones del usuario que le sean de aplicación de conformidad con lo previsto en los presentes términos. </li>
				  	
				  	<li>Cualesquiera daños o perjuicios que puedan ser calificados como lucro cesante, daño emergente, pérdida de negocios, daños a la imagen o pérdida de reputación comercial del usuario.</li>
				  	
				  	<li>Retrasos, fallos de entrega u otros daños provocados por problemas inherentes al uso de internet, pues el correcto funcionamiento de <em><?= HOMEDIR ?></em> puede estar sujeto a limitaciones, retrasos y otros problemas inherentes a internet y las comunicaciones electrónicas.</li>
			  	</ol>		  
			</p>
			<p> 		  
				<strong>CLAUSULA DÉCIMA SEGUNDA. PRECIO Y FORMA DE PAGO.</strong>- EL USUARIO pagará por la afiliación a <em><?= HOMEDIR ?></em> el valor que aparece especificado en la factura debidamente aceptada.
			</p>
			<p> 		  
			<strong>CLAUSULA DÉCIMA TERCERA. MORA EN EL PAGO DE LAS TARIFAS</strong>, al vencerse el plazo señalado en la factura para pagar los valores causados, EL USUARIO no reconocerá a <strong><?= $sadmin->Getp_nombre(); ?></strong> intereses de mora sobre las sumas adeudadas. </p>
			<p> 
				<strong>CLAUSULA DÉCIMA CUARTA.</strong> EL SOPORTE SE OFRECE A PARTIR DE LA ACEPTACIÓN DE LA FACTURA Y SE PRESTARÁ DURANTE LA VIGENCIA DE LA AFILIACIÓN.
				A .El soporte será brindado en las siguientes modalidades:
				<ol>
				  	<li>soporte por E-mail: recepción de preguntas y/o reportes de error por parte de usuario a través de la cuenta  <?= $sadmin->GetEmail() ?>. Se recibirán casos en esta cuenta 7/24 </li>
				  	
				  	<li>SOPORTE PRESENCIAL: CUANDO TODOS LOS OTROS MECANISMOS DE SOPORTE hayan fallado y habiéndose documentado de forma exhaustiva el caso para permitir al equipo técnico tener un entendimiento suficiente del asunto un funcionario de  <strong><?= $sadmin->Getp_nombre(); ?></strong> será agendado para presentarse en las instalaciones del cliente a realizar el soporte. Este servicio estará disponible solo en los casos mencionados y de lunes a viernes entre las 9:00 a.m. y las 5:00 p.m. este método permitirá a nuestro personal de soporte hacer un diagnóstico preciso en casos complejos de funcionalidades con eventuales errores y tener la información necesaria para resolverlos inmediatamente o para trabajar posteriormente en su solución. Es posible que al final de la sesión presencial el caso no pueda ser cerrado definitivamente en situaciones en las que el equipo de soporte deba escalar el asunto al equipo técnico o incluso a un tercero, de cualquier forma, en estos casos, se dará al usuario una solución temporal o alterna de operación. </li>
				</ol>		  
			</p>
			<p> 		  
				<strong>CLAUSULA DÉCIMA QUINTA. FINALIZACIÓN DE LA AFILIACIÓN.</strong>- <strong><?= $sadmin->Getp_nombre(); ?></strong> reconoce que la información es del usuario y en caso de no renovación de la afiliación,  <strong><?= $sadmin->Getp_nombre(); ?></strong> entregará una copia electrónica de los documentos con sus versiones, en caso de que estas existan, organizados en una estructura de carpetas por cliente y caso,o como se encuentren en el momento. Esta información se entregará en un medio adecuado, dependiendo del volumen de la información, la información se entregará en un periodo máximo de 5 días hábiles, contados a partir de la solicitud por escrito por parte del usuario. El usuario reconoce que <strong><?= $sadmin->Getp_nombre(); ?></strong> no tiene la obligación de conservar los datos del usuario, <strong><?= $sadmin->Getp_nombre(); ?></strong> podrá borrar dichos datos al ser entregada al usuario.
			</p> 
			<p> 		  
			<strong>CLAUSULA DÉCIMA SEXTA. PROPIEDAD INTELECTUAL DE <em><?= HOMEDIR ?></em>:</strong> <em><?= HOMEDIR ?></em> ha sido creada por  <strong><?= $sadmin->Getp_nombre(); ?></strong>, quien conservará todos los derechos de propiedad intelectual, industrial o cualesquiera otros, que no podrá ser objeto de posterior modificación, copia, alteración, reproducción, adaptación o traducción por parte del usuario. la estructura, características, códigos, métodos de trabajo, sistemas de información, herramientas de desarrollo, know-how, metodologías, procesos, tecnologías o algoritmos de <em><?= HOMEDIR ?></em> son propiedad de <strong><?= $sadmin->Getp_nombre(); ?></strong> y están protegidos por las normas colombianas e  internacionales de propiedad intelectual e industrial, y no pueden ser objeto de posterior modificación, copia, alteración, reproducción, adaptación o traducción por parte del usuario. Así mismo, todos los manuales de uso, textos, dibujos gráficos, bases de datos, vídeos o soportes de audio referidos o que complementan <em><?= HOMEDIR ?></em> son propiedad de <strong><?= $sadmin->Getp_nombre(); ?></strong> y no pueden ser objeto de posterior modificación, copia, alteración, reproducción, adaptación o traducción por parte del  usuario. la puesta a disposición del  USUARIO de <em><?= PROJECTNAME ?></em> y de los materiales asociados no implica, en ningún caso, la cesión de su titularidad ni la concesión de un derecho de uso en favor del  usuario distinto del aquí previsto. en consecuencia, queda terminantemente prohibido cualquier uso por el usuario de <em><?= PROJECTNAME ?></em> o de los materiales asociados que se realice sin la autorización expresa y por escrito de <strong><?= $sadmin->Getp_nombre(); ?></strong>, incluida su explotación, reproducción, difusión, transformación, distribución, transmisión por cualquier medio, posterior publicación, exhibición, comunicación pública o representación total o parcial, las cuales, de producirse, constituirán infracciones de los derechos de propiedad intelectual o industrial de <strong><?= $sadmin->Getp_nombre(); ?></strong>, sancionadas por la legislación vigente. </p>
			<p> 		  
				<strong>CLAUSULA DÉCIMA SÉPTIMA. DURACIÓN.</strong> La duración de la afiliación será la que parece en la factura.
			</p>
			<p> 		  
				<strong>CLAUSULA DÉCIMA OCTAVA. CONFIDENCIALIDAD. <strong><?= $sadmin->Getp_nombre(); ?></strong></strong> se obliga a mantener en estricta reserva toda la información que conozca de EL USUARIO que se refiera a las operaciones que se  desarrollen bajo la oferta. las restricciones sobre el uso de la divulgación de la información confidencial no se aplicarán a información alguna que sea divulgada para cumplir con un requerimiento legal de una autoridad competente, siempre y cuando se informe al propietario de la información confidencial, antes de tal divulgación, para efectos de que tenga la oportunidad de defenderla, limitarla o protegerla, y siempre y cuando <strong><?= $sadmin->Getp_nombre(); ?></strong>  haya divulgado exclusivamente la parte de la información confidencial legalmente solicitada.
			</p>
			<p> 		 
				<strong>CLAUSULA DÉCIMA NOVENA. DOMICILIO.</strong> Para todos los efectos de la prestación del servicio <em><?= HOMEDIR ?></em>, se fija como domicilio contractual la ciudad de Cali Valle.
			</p>
			<p> 		                                                                                
				<strong>CLAUSULA VIGÉSIMA. ARBITRAMENTO.</strong> las partes acuerdan que en el evento que surjan diferencias entre ellas por razón o con ocasión de la suscripción, su desarrollo, ejecución y/o finalización, que no sean resueltas de común acuerdo en un término de treinta (30) días calendario siguientes a la notificación de tales diferencias,  se someterán a la decisión de un tribunal de arbitramento, el tribunal estará integrado por un (1) árbitro designado por el centro de arbitraje y conciliación de la cámara de comercio de Cali, el cual se sujetará  a sus reglas y el tribunal fallará en derecho.
			</p>
			<p> 		  
				<strong>CLAUSULA VIGÉSIMA PRIMERA.  ADAPTACIONES O NUEVAS VERSIONES DE LA APLICACIÓN</strong> <strong><?= $sadmin->Getp_nombre(); ?></strong> podrá realizar nuevas versiones de <em><?= HOMEDIR ?></em>.
			</p>
			<p> <strong><?= $sadmin->Getp_nombre(); ?></strong> se reserva el derecho a generar nuevas versiones de <em><?= HOMEDIR ?></em>, con la condición que estas no tengan repercusiones materiales negativas para el usuario.
			</p>
			<p> 		  
				<strong>CLAUSULA VIGÉSIMA SEGUNDA. DECLARACION DEL USUARIO.</strong> Con conocimiento de las especificaciones y características de <em><?= HOMEDIR ?></em>, EL USUARIO reconoce y acepta:
				<ol>
					<li>que <em><?= HOMEDIR ?></em> es un producto estándar y por lo tanto  <strong><?= $sadmin->Getp_nombre(); ?></strong> no está obligado a realizar ajustes al programa para funcionalidades no descritas en la propuesta comercial y/o en el anexo técnico.</li>
					<li>que la funcionalidad de <em><?= HOMEDIR ?></em> dependen fundamentalmente de la forma en que debe incluirse la información en el mismo, según sus funcionalidades y características así como de conformidad con las instrucciones y capacitación impartida por <strong><?= $sadmin->Getp_nombre(); ?></strong></li>
					<li>que conoce los requerimientos técnicos y de hardware que requiere <em><?= HOMEDIR ?></em> para su normal funcionamiento.</li>
				</ol>
			</p>
			<p> 		  
				<strong>CLAUSULA VIGÉSIMA TERCERA. FUERZA MAYOR:</strong> las partes no serán responsables del incumplimiento de las obligaciones aquí establecidas en la medida en que tal incumplimiento sea debido a causas razonablemente fuera de control de la parte incumplidora, tales como, sin carácter limitativo, incendios, inundaciones, huelgas, conflictos laborales u otros desórdenes sociales, escasez o indisponibilidad de combustible o energía eléctrica, indisponibilidad o funcionamiento anómalo de las redes de comunicaciones, accidentes, guerras (declaradas o no declaradas), embargos comerciales, bloqueos o disturbios.
			</p>
			<p> 		  
				<strong>CLAUSULA VIGÉSIMA CUARTA. SUBSISTENCIA DE LAS CLÁUSULAS:</strong> si cualquier cláusula fuese declarada, total o parcialmente, nula o ineficaz, tal nulidad o ineficacia afectará tan sólo a dicha disposición o parte de la misma que resulte nula o ineficaz, las demás condiciones subsistirán en todo lo demás, teniéndose tal disposición o la parte de la misma que resulte afectada por no puesta. a tales efectos, las condiciones aquí establecidas solo dejarán de tener validez exclusivamente respecto a la disposición nula o ineficaz, y ninguna otra parte o disposición quedará anulada, invalidada, perjudicada o afectada por tal nulidad o ineficacia, salvo que, por resultar esencial hubiese de afectarlas de forma integral.
			</p>
			<p> 		  
				<strong>CLAUSULA VIGÉSIMA QUINTA.- MODIFICACIÓN DE LAS CONDICIONES.</strong> <strong><?= $sadmin->Getp_nombre(); ?></strong> se reserva el derecho a modificar estas condiciones o sus políticas relativas a <em><?= HOMEDIR ?></em> en cualquier momento, haciéndose efectivas tales modificaciones una vez publicada una versión actualizada de estas condiciones generales en <em><?= HOMEDIR ?></em>. El usuario será responsable de la revisión frecuente regularidad de este documento. El uso continuado de <em><?= PROJECTNAME ?></em> después de dichas modificaciones constituirá su conformidad con las modificaciones.
			</p>
			<p> 		  
				<strong>VIGÉSIMA SEXTA.- LEY APLICABLE:</strong> cualquier controversia surgida de la interpretación o ejecución del presente contrato o de cualquiera de sus eventuales modificaciones, así como cualquier incumplimiento de las mismas, se interpretará de conformidad con la legislación colombiana.
			</p>

		</div>
	</div>
</div>


<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});
</script>
<style type="text/css">
	p{
		text-align: justify;
	}
</style>