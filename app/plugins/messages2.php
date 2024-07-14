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
			 	Env&iacute;e copia escaneada de la consignaci&oacute;n al correo electr&oacute;nico <strong><A HREF="mailto:ventas@audiocodigosjuridicos.com">ventas@audiocodigosjuridicos.com</A></strong>
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

		function CreateAccount($pid, $mail){
			$path = '<p>Hemos recibido una solicitud para creacion de una cuenta en <strong><a href="'.HOMEDIR.'">'.HOMEDIR.'</a></strong></p> 
					 <p>Muchas gracias por registrarse en carpeta ciudadana.</p> 
					 <p>Sus datos para ingresar a <strong>'.PROJECTNAME.'</strong> son:</p>
					 <br>
					 <p>Nombre de usuario: <strong>'.$mail.'</strong></p>
					 <p>Contraseña: <strong>'.$pid.'</strong> 
					 <br>
					 </p>
					 <p>
						Por su seguridad se le recomienda eliminar este mensaje y posteriormente cambiar su clave al iniciar sesion.
					 </p>
					 <p>
						Cordialmente, <br><strong><span style="color:#0072C6">Equipo de Carpeta Ciudadana</span></strong>
					 </p>';
					 
			return $path;		 
		}
	
	}

?>