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
			  	<h2>Terminos y Condiciones</h2>
			</header>

			<p>
			Al ingresar a la página <em><?= HOMEDIR ?></em> el USUARIO acepta expresamente los términos de uso, políticas de privacidad y derechos de autor de esta Aplicación los cuales pueden ser modificados sin previo aviso en cualquier momento por <strong><?= $sadmin->Getp_nombre(); ?></strong>. </p>
			<p>
			De acuerdo con los presentes términos y condiciones se entiende por USUARIO a cualquier persona natural que tenga la facultad de ingresar a los sitios y/o publicaciones de <strong><?= $sadmin->Getp_nombre(); ?></strong>, con el objeto de consultar y/o buscar información contenida en estos. </p>
			<p>  
			Esta página y su contenido pertenecen a <strong><?= $sadmin->Getp_nombre(); ?></strong>, empresa propietaria de la de la Información. Por esta razón, se prohíbe la reproducción total o parcial, traducción, inclusión, transmisión, transformación, almacenamiento o acceso a través de medios analógicos, digitales o de cualquier otro sistema o tecnología creada, o por crearse, de cualquiera de sus contenidos sin autorización previa y escrita de <strong><?= $sadmin->Getp_nombre(); ?></strong>. </p>
			<p>  
			Así mismo, los contenidos de este sitio, sus componentes, links y menciones no podrán, de manera enunciativa, pero no limitativa copiarse, ni venderse, rentarse, duplicarse, publicarse, distribuirse por cualquier medio, almacenarse, retransmitirse o transferirse de cualquier otra forma, independientemente de que sea de forma onerosa o gratuita, sin contar con la previa y expresa autorización escrita de <strong><?= $sadmin->Getp_nombre(); ?></strong>. </p>
			<p>        
			La identificación y la clave de acceso son personales e intransferibles, y el USUARIO será el único responsable por su uso adecuado. Cualquier violación a esta disposición dará lugar a que <strong><?= $sadmin->Getp_nombre(); ?></strong> pueda terminar la correspondiente licencia, sin perjuicio del cobro de las indemnizaciones a las que hubiere lugar.
			Esta página web no podrá utilizarse con fines inmorales o ilegales. Los datos que se ingresen para dichos fines serán eliminados inmediatamente a través de un filtro automático de contenido, el cual está configurado para dichos fines. </p>
			<p> 
			  	<strong>AUTORIZACIONES</strong>
			</p>
			<p>
			El USUARIO autoriza, de manera voluntaria y expresa, a <strong><?= $sadmin->Getp_nombre(); ?></strong> para recolectar, registrar, procesar, difundir y comercializar todos los datos e información que el USUARIO de forma voluntaria suministre en el momento del registro. Con base en lo anterior, <strong><?= $sadmin->Getp_nombre(); ?></strong> podrá reproducir, publicar, traducir, adaptar, extraer o compendiar los datos o la información suministrada, así como disponer de los datos o la información a título oneroso o gratuito de acuerdo y bajo los términos de la Ley 1266 de 2008. </p>
			<p>
			<strong>RESPONSABILIDAD</strong>
			</p>
			<p>  
			La información que aparece en <em><?= HOMEDIR ?></em> así como los servicios que se prestan en ella, son proporcionados únicamente para fines educativos e informativos, por lo tanto no constituye asesoría legal ni consejo profesional alguno. Por ello, <strong><?= $sadmin->Getp_nombre(); ?></strong> no asume ninguna responsabilidad por las decisiones que el USUARIO tome con fundamento en la información publicada en nuestra aplicación web. </p>
			<p>
			<strong><?= $sadmin->Getp_nombre(); ?></strong> no se hace responsable por el contenido de las notas publicadas por otros usuarios y que pudieran resultar ofensivas o dañinas para otros usuarios. </p>
			<p>
			El USUARIO que acepta los presentes términos y condiciones legales y que utiliza las herramientas de personalización de <strong><?= $sadmin->Getp_nombre(); ?></strong> (de manera enunciativa pero no taxativa), tales como la red de conocimiento, mis favoritos, notas y demás herramientas existentes o futuras, manifiesta por medio del presente documento que se le han informado las condiciones y consecuencias de pertenecer y utilizar dichas herramientas y permite que al entrar a las herramientas antes mencionadas, otros usuarios que utilizan dichas herramientas puedan ubicarlo virtualmente, solicitarle formar parte de su red, compartir información y comentarios. No obstante lo anterior, es importante resaltar que cada USUARIO podrá administrar los permisos y restricciones que se presentan en dicha herramienta, siendo el USUARIO el único responsable de las actuaciones que tome sobre el particular. Sin embrago, es importante resaltar que una vez compartida dicha información esta podrá ser del conocimiento de la red y/o de sus herramientas.
			</p>
			<p>
			<strong><?= $sadmin->Getp_nombre(); ?></strong> se reserva el derecho de aceptar y excluir usuarios que no hagan buen uso de la red de conocimiento; también puede retirar al USUARIO y sus comentarios si fuere necesario debido a las quejas constantes de otros usuarios de la red o, simplemente, a causa de las limitaciones propias de la herramienta.
			</p>
			<p>
			<strong><?= $sadmin->Getp_nombre(); ?></strong> no asume ninguna responsabilidad por la utilización, eventuales pérdidas, costos, perjuicios o daños que pueda sufrir el USUARIO por el uso o la imposibilidad de uso de dicha herramienta. Así mismo, <strong><?= $sadmin->Getp_nombre(); ?></strong> no otorga garantía alguna sobre la exactitud, confiabilidad u oportunidad de la información, los servicios, los textos, el software, las gráficas y los vínculos a otras páginas.
			</p>
			<p>
			<strong><?= $sadmin->Getp_nombre(); ?></strong> no garantiza que la conexión y la operación del sitio estén exentas de errores, y el USUARIO manifiesta expresamente que conoce estas circunstancias y que en el evento de un error, la responsabilidad de <strong><?= $sadmin->Getp_nombre(); ?></strong> se limitará exclusivamente a corregirlo en un tiempo prudencial. 
			</p>
			<p>
			<strong><?= $sadmin->Getp_nombre(); ?></strong> no será responsable por daños que los programas sobre los cuales corren sus sitios, ocasionen en el equipo o los archivos del USUARIO, ni por los archivos que se bajen de estos, incluyendo virus. <strong><?= $sadmin->Getp_nombre(); ?></strong> no será responsable por los perjuicios que el USUARIO pueda causar a terceros en la utilización del sitio <em><?= HOMEDIR ?></em> o cualquiera de sus sitios.
			</p>
			<p>
			<strong><?= $sadmin->Getp_nombre(); ?></strong> se exime expresamente de cualquier responsabilidad por los materiales que se encuentran en esta página, los cuales puedan considerarse inapropiados según la legislación de otros países o terceros. Quienes accedan a esta página desde otros países o territorios lo hacen bajo su propia iniciativa y serán responsables del estricto cumplimiento de las leyes locales y/o internacionales que les sean aplicables.  
			</p>
			<p>
			La información y opiniones expresadas en la red de conocimiento de <strong><?= $sadmin->Getp_nombre(); ?></strong>, los mensajes, comentarios, foros o cualquier otro espacio pertenecen al USUARIO, pero de ninguna manera representan el pensamiento de <strong><?= $sadmin->Getp_nombre(); ?></strong> o de cualquiera de sus marcas. Por esta razón, <strong><?= $sadmin->Getp_nombre(); ?></strong> no ofrece ninguna representación o garantía con respecto a dicha información o dichas opiniones. <strong><?= $sadmin->Getp_nombre(); ?></strong> no es responsable de cualquier pérdida, daño (ya sea real, a consecuencia, punitivo u otro), perjuicio, reclamo, responsabilidad u otra causa de clase o carácter alguno basado en, o resultante de, cualquier información u opiniones proporcionadas en el sitio <em><?= HOMEDIR ?></em> o  cualquiera de los sitios de <strong><?= $sadmin->Getp_nombre(); ?></strong>. 
			</p>
			<p>
			<strong>RESTRICCIONES</strong>
			</p>
			<p>  
			El USUARIO únicamente podrá ingresar a las secciones que le sean autorizadas por <strong><?= $sadmin->Getp_nombre(); ?></strong>, por lo tanto se abstendrá de utilizar cualquier medio para violar la seguridad y las restricciones, así como cualquier medida tecnológica. La sola intención de hacerlo, evidenciada por <strong><?= $sadmin->Getp_nombre(); ?></strong>, será causal suficiente para dar por terminada esta licencia e informar a las autoridades correspondientes de este hecho. El USUARIO no podrá reproducir, adaptar, distribuir, alquilar, vender, otorgar licencia o ejecutar cualquier otra forma de transferencia del sitio <em><?= HOMEDIR ?></em> ni de los demás sitios, ni cualquiera de sus partes, incluyendo los códigos de programación. El USUARIO no podrá reversar la ingeniería, descompilar, desensamblar, modificar, crear trabajos derivados, traducir la información o usar la información publicada en el sitio con fines comerciales o de lucro. El USUARIO no podrá remover u ocultar los derechos de autor, las marcas o cualquier otra información o leyenda relacionada con la propiedad y derechos de <strong><?= $sadmin->Getp_nombre(); ?></strong> o de sus proveedores de información y de servicios.
			</p>
			<p>
			El acceso no autorizado de manera escrita a los contenidos, bases de datos o servicios de <em><?= HOMEDIR ?></em> será considerado como una intromisión ilícita, y <strong><?= $sadmin->Getp_nombre(); ?></strong> podrá iniciar todas aquellas acciones legales que la legislación nacional e internacional puedan conferirle. 
			</p>
			<p>
			<strong> DERECHOS DE AUTOR</strong>
			</p>
			<p>
			De conformidad con las disposiciones legales vigentes (Ley 23 de 1982 y Decisión 351 del Acuerdo de Cartagena y demás que puedan considerarse complementarias), los diseños, redacciones y contenidos de cada uno de los documentos e información aquí presentados, están protegidos por las leyes de derechos de autor, según las cuales, salvo licencia o autorización de su titular, no pueden ser fotocopiadas, reproducidas digital o físicamente, modificadas total o parcialmente o comunicadas públicamente, so pena de ser responsable civil y penalmente de infracción de derechos patrimoniales y/o morales de autor.
			</p>
			<p>
			Así mismo, los contenidos que el USUARIO realice en la herramienta de la red de conocimiento de <strong><?= $sadmin->Getp_nombre(); ?></strong> son de su exclusiva propiedad, de tal manera que cualquier autorización, permiso o reenvío de sus contenidos a terceras personas lo hace bajo su única y estricta responsabilidad. 
			</p>
			<p>
			<strong>MARCAS Y PROPIEDAD INTELECTUAL</strong>
			</p>
			<p>
			La información que aparece en demandasenlinea. así como el diseño gráfico, la presentación de los contenidos, las marcas comerciales y los logotipos, son propiedad exclusiva de <strong><?= $sadmin->Getp_nombre(); ?></strong> o de terceros que han autorizado su inclusión o uso y están protegidos por las normas sobre derechos de autor nacionales y por los tratados internacionales que sobre la materia ha suscrito y ratificado la República de Colombia.
			EL USUARIO no podrá utilizar, comercializar, explotar o modificar de ninguna forma las marcas de <strong><?= $sadmin->Getp_nombre(); ?></strong>, de los proveedores de información y de servicios o de terceros, y se obliga a informar a <strong><?= $sadmin->Getp_nombre(); ?></strong> cualquier hecho sobre el cual tenga conocimiento y que pueda considerarse como lesivo de los derechos que legalmente este tiene. 
			</p>
			<p>
			<strong>CONDICIONES DE USO  DE LA APLICACIÓN WEB</strong>
			</p>
			<p>
			 Por ingresar a la red de conocimiento de <strong><?= $sadmin->Getp_nombre(); ?></strong>, el USUARIO autoriza a <strong><?= $sadmin->Getp_nombre(); ?></strong> para: 
			<ul>
			    <li> Modificar en cualquier tiempo y por cualquier razón sin previo aviso los términos y condiciones de la aplicación.</li>
			    <li> Negar el registro a cualquier persona, en cualquier momento y por cualquier razón.</li>
			    <li> Incluir o no el material recibido de los usuarios a su criterio. En caso de incluirlo, podrá mantener este material por el tiempo que considere pertinente o modificarlo.</li>
			    <li> Remover los contenidos que considere ilegales, ofensivos, difamatorios, pornográficos, amenazantes, obscenos o que de cualquier otra forma violen los términos y condiciones.</li>
			    <li> Utilizar la información personal y/o contenidos suministrados por los usuarios, de acuerdo con los términos y condiciones dela aplicación.</li>
			    <li> <strong><?= $sadmin->Getp_nombre(); ?></strong> no es responsable por los contenidos publicados en la red de conocimiento. Cada USUARIO se hace responsable de sus contenidos, de los permisos que dé a otros usuarios sobre sus contenidos y de las claves de acceso. El USUARIO entiende y acepta que no publicará en dichos foros, o en cualquier espacio cualquier contenido que:</li>
			    <li> Difame, invada la privacidad o sea obscena, pornográfica, abusiva o amenazadora. </li>
			    <li> Infrinja los derechos de propiedad intelectual o vulnere cualquier otro derecho de cualquier entidad o persona.</li>
			    <li> Viole la ley.</li>
			    <li> Promueva actividades ilegales.</li>
			    <li> Publicite o solicite fondos, bienes o servicios.</li>
			    <li> Publicite servicios legales, contables o cualquier otro de manera evidente o subrepticia. </li>

			  </ul>
			 
			</p>
			<p>
			<strong>AUTORIZACIÓN DE USO DATOS DE REGISTRO</strong>
			</p>
			<p>
			El USUARIO acepta que los datos personales aportados en el momento de su registro, o cualquier otro facilitado a <strong><?= $sadmin->Getp_nombre(); ?></strong>  para su acceso a algunos de los servicios de <em><?= HOMEDIR ?></em> sean utilizados con la finalidad de facilitar la prestación de los servicios solicitados, para la correcta identificación de los usuarios que solicitan servicios personalizados, para la realización de estudios estadísticos de los usuarios que permitan diseñar mejoras en los servicios prestados, para la gestión de tareas básicas de administración, así como para mantenerle informado, bien por correo electrónico bien por cualquier otro medio de novedades, productos y servicios relacionados con <strong><?= $sadmin->Getp_nombre(); ?></strong>.
			</p>
			<p>  
			En el caso de comunicaciones comerciales a través de correo electrónico o medio equivalente, al momento de registrarse en <em><?= HOMEDIR ?></em>, el USUARIO elegirá a su voluntad sobre prestar su consentimiento expreso para el envío de publicidad a través de dicho medio. Así mismo, al registrarse en <em><?= HOMEDIR ?></em> y demás sitios <strong><?= $sadmin->Getp_nombre(); ?></strong>, el USUARIO acepta que sus datos de registro puedan ser proporcionados a otras terceras personas para marketing, publicidad u otros usos. <strong><?= $sadmin->Getp_nombre(); ?></strong> utilizará los correos electrónicos o cualquier otra información personal para contactar a los usuarios, y podrá dirigirlos con fines específicos a los usuarios. 
			</p>
			<p>
			La información de identificación personal podrá transferirse como parte de los activos de <strong><?= $sadmin->Getp_nombre(); ?></strong> en caso de que la compañía o partes del negocio fuesen vendidas, fusionadas o adquiridas por terceros.
			</p>
			<p>
			<strong><?= $sadmin->Getp_nombre(); ?></strong> se compromete a cumplir con su obligación de mantener en secreto los datos de carácter privado, así como su deber de tratarlos con confidencialidad, y asume las medidas de índole técnica, organizativa y de seguridad necesarias para evitar su alteración, pérdida, tratamiento o acceso no autorizado, de acuerdo con lo establecido en la ley y en los tratados internacionales suscritos por Colombia que rigen la materia.
			</p>
			<p>
			El USUARIO responderá, en cualquier caso, por la veracidad de los datos facilitados. <strong><?= $sadmin->Getp_nombre(); ?></strong> podrá excluir de los servicios registrados a todo USUARIO que haya facilitado datos falsos, sin perjuicio de las demás acciones que procedan.
			</p>
			<p> 
			Cualquier USUARIO registrado puede solicitar la cancelación de sus datos o ejercer el derecho a acceder o rectificar estos, mediante correo electrónico enviado <?= $sadmin->GetEmail() ?>
			</p>
			<p>
			<strong>TERMINACIÓN </strong>
			</p>
			<p>
			<strong><?= $sadmin->Getp_nombre(); ?></strong> se reserva el derecho, a su exclusiva discreción, de borrar toda la información que el USUARIO ha incluido en <em><?= HOMEDIR ?></em>, de negar el acceso a esta página, ante el incumplimiento por parte del USUARIO de estos términos y condiciones.
			</p>
			<p>
			Oficina <strong><?= $sadmin->Getp_nombre(); ?></strong> <?= $sadmin->GetDireccion() ?>, <?= $sadmin->GetCiudad() ?>
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