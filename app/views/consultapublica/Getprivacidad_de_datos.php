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
	          <h2>Privacidad de Datos</h2>
	        </header>
		
			<p>	    
		   	Es interés de <strong><?= $sadmin->Getp_nombre(); ?></strong> la protección de la privacidad de la información personal del Usuario obtenida a través del aplicativo web, comprometiéndose a adoptar una política de confidencialidad y seguridad según lo que se establece a continuación. </p>
	      	<p>
				Nuestra Política de Privacidad describe cómo <strong><?= $sadmin->Getp_nombre(); ?></strong> manejará y gestionara la información personal de sus clientes, de sus bases de datos y de la de navegación anónima, la cual se aplica a sus agentes y representantes. 
			</p>
	      	<p>
			El Usuario reconoce que el ingreso de información personal, lo realiza de manera voluntaria y teniendo en cuenta las características del Portal y las facultades de uso por parte de <strong><?= $sadmin->Getp_nombre(); ?></strong> y en el entendido que tal información hará parte de un archivo y/o base de datos que contenderá su perfil, la cual podrá ser usado por <strong><?= $sadmin->Getp_nombre(); ?></strong> en los términos aquí establecidos. El Usuario podrá modificar o actualizar la información suministrada en cualquier momento. <strong><?= $sadmin->Getp_nombre(); ?></strong> aconseja que el Usuario mantenga actualizada la información para optimizar el beneficio que puede recibir del aplicativo web. </p>
	      	<p>
			Al lograr información personal en línea a través de <em><?= HOMEDIR ?></em>  <strong><?= $sadmin->Getp_nombre(); ?></strong> actualiza la política de privacidad constantemente, la versión más reciente estará siempre publicada en nuestra página <em><?= HOMEDIR ?></em> </p>
	      		<ol>
	      			<li>
			      		<strong>PROCESO DE LOS DATOS DE CARÁCTER PERSONAL DE LOS USUARIOS Y/O CLIENTES</strong>
						<p>
							como se captura la información:
					    <strong><?= $sadmin->Getp_nombre(); ?></strong> ofrece a sus clientes la posibilidad de adquirir sus productos a través de sus canales de venta, a saber; agentes comerciales, puntos de venta, centro de interacción con el cliente  y distribuidores autorizados, los cuales reciben la información personal acerca del usuario y/o cliente cuando se realiza una compra o cuando el cliente se registra en alguno de los sitios o utiliza  nuestra herramienta en la web. </p>
				      	<p>
						Qué información personal es almacenada por <strong><?= $sadmin->Getp_nombre(); ?></strong> Los datos almacenados por <strong><?= $sadmin->Getp_nombre(); ?></strong> dependen de la relación del cliente con <strong><?= $sadmin->Getp_nombre(); ?></strong>, el medio o canal utilizado y los productos, servicios y beneficios ofrecidos. Necesitamos capturar información de contacto, a saber, nombre, dirección, número telefónico, dirección de residencia, correo electrónico, entre otras para proporcionar su producto. La razón principal por la que recopilamos esta información es para poder prestar un mejor servicio y hacer seguimiento de la usabilidad y recomendaciones de nuestros usuarios y/o clientes, así como para tener la información de contacto necesaria para poder comunicarnos con usted en el caso de una falla o de nuevo producto de su interés. </p>
				      	<p>
							También podemos recoger información personal para ayudarnos a identificar formas en que podemos ofrecerle un mejor servicio, tales como proporcionarle información sobre nuestros productos y servicios con mayor eficacia. 
						</p>
				      	<p>						 
						A menos que usted nos indique lo contrario, <strong><?= $sadmin->Getp_nombre(); ?></strong> puede utilizar la información personal sobre usted para fines de marketing y de investigación. Puede informarnos sobre esto en cualquier momento, todo lo que tiene que hacer es ponerse en contacto con <strong><?= $sadmin->Getp_nombre(); ?></strong> si ya no desea recibir material de marketing. Tenga en cuenta que todavía podemos utilizar su información personal para ofrecerle los productos que ha solicitado como cliente. </p>
				      	<p>
							Cómo es usada y divulgada la información personal.
						Procesamiento y administración de sus transacciones como cliente o miembro de <strong><?= $sadmin->Getp_nombre(); ?></strong>. Proveerle los productos y servicios que requiere de nosotros. Estaremos en contacto con usted en el caso de una falla del sistema o de nuevas herramientas en la web para un mejor desarrollo de sus productos. <strong><?= $sadmin->Getp_nombre(); ?></strong> no suministra su información personal sin su consentimiento, pero si podrá divulgar su información personal en ciertas circunstancias limitadas como La divulgación y el uso por terceros y proveedores de servicios que nos ayuden a operar nuestro negocio o proporcionar un servicio a usted. <strong><?= $sadmin->Getp_nombre(); ?></strong> divulga su información personal a terceros contratistas y proveedores de servicios que nos ayudan a operar nuestros sistemas informáticos, enviar nuestro correo físico o correo electrónico y empresas que realizan análisis de datos para atributos de grupo demográfico de las personas, tales como "géneros de interés”. La divulgación de sus datos de contacto a escenarios y promotores para que puedan ofrecerle material promocional sobre nuestros productos y servicios, a menos que usted nos indique lo contrario. Tenga en cuenta que <strong><?= $sadmin->Getp_nombre(); ?></strong> a veces extrae la información de los registros recogidos para obtener datos colectivos. Estos datos colectivos no identifican a los clientes, los cuales se utilizan para fines de investigación y puede compartir los datos con terceros. </p>
				      	<p>
							<strong><?= $sadmin->Getp_nombre(); ?></strong>, es titular del dominio "<em><?= HOMEDIR ?></em>".
						De acuerdo con la regulación legal vigente en materia de protección de datos, así como en materia de las TIC y de comercio electrónico, el usuario acepta expresamente que los datos personales aportados en el momento de su registro, o cualquier otro facilitado a <strong><?= $sadmin->Getp_nombre(); ?></strong> a través de sus diferentes herramientas o a cualquiera de sus distribuidores para su acceso a algunos de los servicios del sitio web, sean incorporados a la base de datos titularidad de esta empresa. En el caso de comunicaciones comerciales a través de correo electrónico o medio equivalente, el usuario presta su consentimiento expreso para el envío de publicidad a través de dicho medio. </p>
				      	<p>
						La recolección y procedimiento sistematizado de los datos personales tiene como objetivo el mantenimiento, seguimiento y análisis de la relación contractual establecida con <strong><?= $sadmin->Getp_nombre(); ?></strong>, así como la gestión, administración, prestación, ampliación y mejora de los servicios en los que decida suscribirse, darse de alta, o utilizar, la adecuación de dichos servicios a las preferencias y gustos de los usuarios, la realización de estudios estadísticos, el estudio del grado de éxito de las búsquedas en el sistema, la supervisión y estudio de la utilización de los servicios por parte de los usuarios, el diseño de nuevos servicios relacionados con dichos servicios, el envío de actualizaciones de los servicios, el envío, por medios tradicionales y electrónicos, de información técnica, operativa y comercial acerca de productos y servicios ofrecidos por <strong><?= $sadmin->Getp_nombre(); ?></strong>, sus filiales y distribuidores autorizados, respetando, en todo caso, la legislación vigente sobre protección de los datos de carácter personal. </p>
				      	<p>
						<strong><?= $sadmin->Getp_nombre(); ?></strong> se compromete al cumplimiento de su obligación de secreto de los datos de carácter personal y de su deber de tratarlos con confidencialidad, y asume, a estos efectos, las medidas de índole técnica, organizacional y de seguridad necesarias para evitar su alteración, pérdida, tratamiento o acceso no autorizado, de acuerdo con lo establecido en la normatividad colombiana vigente. </p>
				      	<p>
							El usuario se compromete a usar de forma adecuada y responsable sus claves de acceso, ya que su uso es de exclusiva responsabilidad del usuario, así mismo se compromete a mantener actualizados los datos como usuario registrado o cliente, respondiendo, en cualquier caso, de la veracidad de los datos facilitados. Para ello podrá usar su usuario y contraseña y actualizar estos datos por sí mismo. 
						</p>
				      	<p>
							Cualquier usuario registrado puede en cualquier momento ejercer el derecho a acceder, rectificar y, en su caso, cancelar sus datos de carácter personal suministrados, mediante petición escrita, adjuntando fotocopia legible de su identificación. Dicha comunicación deberá ser dirigida a <?= $sadmin->GetEmail() ?> o a la dirección <?= $sadmin->GetDireccion() ?>, <?= $sadmin->GetCiudad() ?>.		
						</p>
	      			</li>
	      			<li>
						<strong>DATOS DE CARÁCTER PERSONAL INCLUIDOS EN LAS BASES DE DATOS DE <strong><?= $sadmin->Getp_nombre(); ?></strong></strong>
						<p>
						<strong><?= $sadmin->Getp_nombre(); ?></strong> puede darle usos comerciales a los datos de los usuarios o clientes, previa autorización de los mismos de conformidad con la ley de habeas data. </p>
				      	<p>
							Sin embargo, si usted considera que, por error, no se ha eliminado un dato personal que debía ser eliminado, o que un documento cita su nombre u otro dato personal, y que ello le causa un perjuicio, le invitamos a que se ponga en contacto con el Departamento de Privacidad y estudiaremos su caso con la máxima diligencia atendiendo, entre otros criterios,  la legislación vigente del país en el que se encuentre. Información de contacto, <?= $sadmin->GetEmail() ?> o a la dirección <?= $sadmin->GetDireccion() ?>, <?= $sadmin->GetCiudad() ?>.
						</p>
	      			</li>
	      			<li>
						<strong>TRANSACCIONES ANÓNIMAS</strong>
						<p>
							Los clientes pueden realizar transacciones con <strong><?= $sadmin->Getp_nombre(); ?></strong> sin proporcionar información personal. Los clientes que deseen comprar sin proporcionar información personal pueden hacer una transacción en efectivo en cualquiera de los puntos de venta de <strong><?= $sadmin->Getp_nombre(); ?></strong>. 
					    <strong><?= $sadmin->Getp_nombre(); ?></strong> utiliza cookies, bases de datos que se generan en el ordenador del usuario y que nos permiten obtener, entre otras, información acerca de la fecha y hora de la última visita, así como información estadística sobre el uso de las diferentes funcionalidades de las aplicaciones. El usuario tiene la opción de impedir la generación de cookies, mediante la selección de la correspondiente opción en su programa navegador. Sin embargo, la empresa no se responsabiliza de que la desactivación de los mismos impida el buen funcionamiento de la página. </p>
				      	<p>
				    </li>
				    <li>
						<strong>SEGURIDAD DE LA INFORMACIÓN PERSONAL</strong>
						</p>
				      	<p>
							<strong><?= $sadmin->Getp_nombre(); ?></strong> protege la información personal que recoge en una base de datos segura, en formato de datos de su propiedad, que sólo se pueden leer con herramientas especiales para dicho fin.
						</p>
				      	<p>
				    </li>
				    <li>
						<strong>ACCESO Y CORRECCIONES DE LA INFORMACIÓN </strong>
						</p>
				      	<p>
						Bajo la Ley de Privacidad, usted tiene derecho a solicitar el acceso a la información que <strong><?= $sadmin->Getp_nombre(); ?></strong> tiene sobre usted. Usted también tiene el derecho de pedirnos que corrijamos la información sobre usted que es incorrecta, incompleta o desactualizada. Si usted es un cliente en línea, puede acceder o corregir la información personal accediendo a nuestro sitio web. Por favor incluya su número de teléfono y adjunte una copia de su identificación. Nuestra política considera todas las peticiones de acceso a información o corrección con un plazo de 30 días hábiles para responder. </p>
				      	<p>
							En la medida en que esta Política de Privacidad se aplica a las cuestiones de privacidad en línea, este debe ser leído como parte de los términos de uso de nuestro sitio web. Cuando usted ingresa a los sitios web de <strong><?= $sadmin->Getp_nombre(); ?></strong>.
					    <strong><?= $sadmin->Getp_nombre(); ?></strong> toma en serio sus obligaciones de privacidad. Este apartado está destinado a proporcionar más información acerca de la privacidad de los usuarios de nuestro sitio web. En general, <strong><?= $sadmin->Getp_nombre(); ?></strong> se encargará de la información personal recopilada en línea coherente con el modo en que se trata la información personal recopilada personalmente. </p>
				      	<p>
						La información personal recopilada en línea la utilizamos para ofrecerle nuestros productos y servicios, nuevas herramientas, seminarios, y si está de acuerdo, para propósitos de comercialización. Si <strong><?= $sadmin->Getp_nombre(); ?></strong> proporciona su información personal a terceros, requerimos que estos se comprometan a cumplir con estas disposiciones expuestas como Políticas de Privacidad y con condiciones estrictas que regulan la cantidad de información personal a ser manipulada. </p>
				      	<p>
							La información personal proporcionada por el Usuario, está asegurada por una clave de acceso a la cual sólo el Usuario podrá acceder y que sólo él conoce. El Usuario es el único responsable de mantener en secreto, dicha clave y la información incluida .<strong><?= $sadmin->Getp_nombre(); ?></strong> se compromete a no intentar tener acceso ni pretender conocer dicha clave. Debido a que ninguna transmisión por Internet es absolutamente segura ni puede garantizarse dicho extremo, el Usuario asume el hipotético riesgo que ello implica, el cual acepta y conoce. 
						</p>
				      	<p>
						<strong><?= $sadmin->Getp_nombre(); ?></strong> no se responsabiliza por cualquier consecuencia derivada del ingreso indebido de terceros a la base de datos y/o por alguna falla técnica en el funcionamiento y/ o conservación de datos en el sistema en cualquiera de los capítulos de la aplicación web. </p>
	      			</li>
	      		</ol>
				
				Oficina <strong><?= $sadmin->Getp_nombre(); ?></strong>:  <?= $sadmin->GetDireccion() ?>, <?= $sadmin->GetCiudad() ?>
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