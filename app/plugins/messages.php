<?
	class Messages{
	
		function ResetPassword($pid, $mail){
			$path = '<p>Hemos recibido una solicitud para cambiar la contrase&ntilde;a para la cuenta: '.$mail.'<br>Su nueva clave es</p> 
					 <p><strong>'.$pid.'</strong> </p>
					 <p>Por su seguridad se le recomienda eliminar este mensaje y posteriormente cambiar su clave al iniciar sesion.</p>
					 <p>Cordialmente, <br><strong><span style="color:#0072C6">El equipo de Demandas en Linea</span></strong></p>';
					 
			return $path;		 
		}

		function NewBook($titulo, $usuario){
			$path = '<p>Estimado '.$usuario.' Hemos recibido una solicitud para la compra de un nuevo libro </p> 
			 <p>Muchas gracias por habernos preferido como su plataforma de estudio favorita, estamos seguros que esta herramienta ser&aacute; de gran utilidad para usted y lo dejar&aacute; de la mano con las nuevas tecnolog&iacute;as que entrar&aacute;n en vigencia con el plan de justicia digital</p> 
			 <p>A continuaci&oacute;n la informaci&oacute;n referente a su nueva compra:</p>
				<br>
			 <p>Audio Libro Adquirido: <strong>'.$titulo.'</strong></p>
				<br>
			 </p>
			 <p>
				S&iacute;rvase consignar el valor en la cuenta de ahorros n&uacute;mero:
				016001006267 Banco Davivienda a nombre  Jimajo Tecnolog&iacute;a Jur&iacute;dica S.A.S. el tiempo para realizar su pago es de 24 horas.
			 </p>
			 <p>				
			 	Env&iacute;e copia escaneada de la consignaci&oacute;n al correo electr&oacute;nico <strong><A HREF="mailto:ventas@audiosjuridicos.com">ventas@audiosjuridicos.com</A></strong>
			 </p>
			 <p>				
				De no realizar este procedimiento su compra ser&aacute; desactivada y no podr&aacute; disfrutar de todos los beneficios que obtendr&iacute;a con este libro hasta realizar su pago			 	
			 </p>
			 <p>
				Cordialmente, <br><strong><span style="color:#0072C6">Equipo de Audios Juridicos</span></strong>
			 </p>';
			 
				return $path;		 	 	
		}

		function NewBookClient($titulo, $nombre, $username){
			$path = '<p>El usuario '.$nombre.' con direccion de correo electronico  '.$username.' ha comprado </p> 
				<br>
			 <p>Audio Libro Adquirido: <strong>'.$titulo.'</strong></p>
				<br>
			 </p>';
			 
			return $path;		 	 	
		}

		function SesionAbierta($m){
			#nombre , email, so, browser, version

			$mensaje = "Hola, ".$m['nombre']."<br><br>Su cuenta ".$m['email']." se ha usado recientemente para iniciar sesión en ".$m['browser']." con un dispositivo ".$m['so'].".";
			
			$mensaje .= "<div style='font-size:16px;padding-top:38px;font-weight:normal;margin-bottom:20px'>PENDIENTES</div>";
			$mensaje .= "<div style='margin-left:10px;'>";

			$mensaje .= "<div style='margin-top:20px; '><a style='color:#1579C4' href='".HOMEDIR."/login/' target='_blank'>Ver Todas...</a></div>";
			$mensaje .= "</div>";

			return $mensaje;

		}

		function GetMensajeSegundaClave($nombre, $clave, $expiracion){
			
			$mensaje = "Hola, ".$nombre."<br><br>Esta es su segunda clave y podrá ser utilizada para firmar documentos";
			$mensaje .= "<p>Esta clave expira el $expiracion</p>";
			$mensaje .= " <div style='font-size:16px;padding-top:18px;padding-bottom:18px;font-weight:normal;margin-bottom:20px; background-color:#FFF; text-align:center; border: 2px solid #CCC;'>
								".$clave."
						  </div>";
			$mensaje .= "<div style='margin-left:10px;'>";
			$mensaje .= "</div>";

			return $mensaje;

		}
	
	}

	

?>
