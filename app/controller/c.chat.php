<?
#·error_reporting(E_ALL);
#ini_set('display_errors', '1');

date_default_timezone_set("America/Bogota");

	include_once('app/basePaths.inc.php');

	include_once('consultas.php');

	include_once('funciones.php');	
	include_once(MODELS.DS.'UsuariosM.php');


	include_once(ROOT.DS.'DALC'.DS.'/mySql.php');

	$con = new ConexionBaseDatos;

	$con->Connect($con);

	$c = new Consultas;

	$f = new Funciones;

	if ($c->sql_quote($_REQUEST['action']) == "chatheartbeat") { chatHeartbeat();} 

	if ($c->sql_quote($_REQUEST['action']) == "sendchat") {  sendChat(); } 

	if ($c->sql_quote($_REQUEST['action']) == "closechat") {  closeChat(); } 

	if ($c->sql_quote($_REQUEST['action']) == "startchatsession") { startChatSession(); }

	if ($c->sql_quote($_REQUEST['action']) == "GetDataUser") { GetDataUser($c->sql_quote($_REQUEST['id'])); }

	if ($c->sql_quote($_REQUEST['action']) == "SendMessageToAll") { SendMessageToAll(); }
/* NUEVO CHAT */
	if ($c->sql_quote($_REQUEST['action']) == "LoadChat") { IniciarChat($c->sql_quote($_REQUEST['id'])); }
	if ($c->sql_quote($_REQUEST['action']) == "enviarmensaje") { EnviarChat($c->sql_quote($_REQUEST['message']), $c->sql_quote($_REQUEST['to_message'])); }
	if ($c->sql_quote($_REQUEST['action']) == "GetHistoryChat") { GetHistoryChat($c->sql_quote($_REQUEST['id'])); }
	if ($c->sql_quote($_REQUEST['action']) == "LoadConversaciones") { LoadConversaciones(); }

/* NUEVO CHAT */
	

	if (!isset($_SESSION['chatHistory'])) {

		$_SESSION['chatHistory'] = array();

	}

	if (!isset($_SESSION['openChatBoxes'])) {

		$_SESSION['openChatBoxes'] = array();

	}

function chatHeartbeat() {

	global $con;

	global $c;

	global $f;

	$sql = "select * from chat where (chat.to = '".$c->sql_quote($_SESSION['cedula'])."' AND recd = 0) order by id ASC";

	$query = $con->Query($sql);

	$items = '';

	$chatBoxes = array();

	while ($chat = $con->FetchArray($query)) {

		$qr = $con->Query("select * from usuarios where cedua = '$chat[from]'");

		$n = $con->Result($qr, 0, "p_nombre")." ".$con->Result($qr, 0, "p_apellido");

		if (!isset($_SESSION['openChatBoxes'][$chat['from']]) && isset($_SESSION['chatHistory'][$chat['from']])) {

			$items = $_SESSION['chatHistory'][$chat['from']];

		}

		$chat['message'] = $chat['message'];

		$message = utf8_decode($chat['message']);

		$items .= <<<EOD

					   {

			"s": "0",

			"f": "{$chat['from']}",

			"m": "{$message}",

			"n": "{$n}",

	   },

EOD;

	if (!isset($_SESSION['chatHistory'][$chat['from']])) {

		$_SESSION['chatHistory'][$chat['from']] = '';

	}

	$_SESSION['chatHistory'][$chat['from']] .= <<<EOD

						   {

			"s": "0",

			"f": "{$chat['from']}",

			"m": "{$message}",

			"n": "{$n}",

	   },

EOD;

		unset($_SESSION['tsChatBoxes'][$chat['from']]);

		$_SESSION['openChatBoxes'][$chat['from']] = $chat['sent'];

	}

	if (!empty($_SESSION['openChatBoxes'])) {

	foreach ($_SESSION['openChatBoxes'] as $chatbox => $time) {

		if (!isset($_SESSION['tsChatBoxes'][$chatbox])) {

			$now = time()-strtotime($time);

			$time = date('Y-m-d H:i:s');

			$message = "Enviado ".$f->nicetime($time);

			if ($now > 180) {

				$items .= <<<EOD

{

"s": "2",

"f": "$chatbox",

"m": "{$message}",

"n": ""

},

EOD;

	if (!isset($_SESSION['chatHistory'][$chatbox])) {

		$_SESSION['chatHistory'][$chatbox] = '';

	}

	$_SESSION['chatHistory'][$chatbox] .= <<<EOD

		{

"s": "2",

"f": "$chatbox",

"m": "{$message}",

"n": ""

},

EOD;

			$_SESSION['tsChatBoxes'][$chatbox] = 1;

		}

		}

	}

}

	$sql = "update chat set recd = 1 where chat.to = '".$c->sql_quote($_SESSION['cedula'])."' and recd = 0";

	$query = $con->Query($sql);

	if ($items != '') {

		$items = substr($items, 0, -1);

	}

#header('Content-type: application/json');

?>

{

		"items": [

			<?php echo $items;?>

        ]

}

<?php

			exit(0);

}

function chatBoxSession($chatbox) {

	global $con;

	$items = '';

	if (isset($_SESSION['chatHistory'][$chatbox])) {

		$items = $_SESSION['chatHistory'][$chatbox];

	}

	return $items;

}

function startChatSession() {

	global $con;

	global $c;

	$items = '';

	if (!empty($_SESSION['openChatBoxes'])) {

		foreach ($_SESSION['openChatBoxes'] as $chatbox => $void) {

			$items .= chatBoxSession($chatbox);

		}

	}

	if ($items != '') {

		$items = substr($items, 0, -1);

	}

//header('Content-type: application/json');

$q = "select p_nombre, p_apellido from usuarios where id = ".$_SESSION['cedula']." ";

$q = $con->Query($q);

$q = $con->FetchAssoc($q);

?>

{

		"username": "<?= $q['p_nombre'].' '.$q['p_apellido'];?>",

		"items": [<?php echo $items;?> ]

}

<?php

	exit(0);

}

function sendChat() {

	global $con;

	global $c;

	$from = $_SESSION['cedula'];

	$to = $c->sql_quote($_POST['to']);

	$message = $c->sql_quote($_POST['message']);

	$n = $con->Result($con->Query("select * from usuarios where cedula = '$to'"), 0, "nombres_usuario");

	$_SESSION['openChatBoxes'][$to] = date('Y-m-d H:i:s', time());

	$time = date('Y-m-d H:i:s');

	$messagesan = sanitize($message);

	if (!isset($_SESSION['chatHistory'][$to])) {

		$_SESSION['chatHistory'][$to] = '';

	}

	$_SESSION['chatHistory'][$to] .= <<<EOD

					   {

			"s": "1",

			"f": "{$to}",

			"m": "{$messagesan}",

			"n": "{$n}",

	   },

EOD;

	unset($_SESSION['tsChatBoxes'][$to]);

	$sql = "insert into chat (chat.from,chat.to,message,sent) values ('".$c->sql_quote($from)."', '".$c->sql_quote($to)."','".$message."',NOW())";

	$query = $con->Query($sql);

	echo "1";

	exit(0);

}

function closeChat() {

	unset($_SESSION['openChatBoxes'][$_POST['chatbox']]);

	echo "1";

	exit(0);

}

function sanitize($text) {

	#$text = htmlspecialchars($text, ENT_QUOTES);

	#$text = str_replace("\n\r","\n",$text);

	#$text = str_replace("\r\n","\n",$text);

	#$text = str_replace("\n","<br>",$text);

	return $text;

}

function GetDataUser($id){

	global $con;

	global $c;

	$query = "select * from usuarios where cedula = '$id'";

	$query = $con->Query($query);

	$query = $con->FetchAssoc($query);

	#$ar = array("nombre" => $query['p_nombre, p_apellido'], "estado" => $query['estado_chat']);

	#print_r($query);

	echo $query["p_nombre"]." ".$query["p_apellido"];

	echo ";".HOMEDIR."/app/plugins/thumbnails/".$query['foto_perfil'];

}

function SendMessageToAll(){

	global $con;

	global $c;

    $usuario = "sander";

    $result = $con->Query("select * from usuarios ");

    $message = "Mensaje Importante: Señor usuario, el modulo de anexos va a estar inhabilitado hasta las 18:00 del dia 05-05-2015 mientras se realizan cambios tecnicos.";

    while ($row = $con->FetchAssoc($result)) {

		$amigo = $row["id"];    

		    echo "Mensaje enviado a: ".$row[p_nombre]." ".$row[p_apellido]."<br>";

		    $sql = "insert into chat (chat.from,chat.to,message,sent) values ('18923104', '".$amigo."','".$c->sql_quote($message)."',NOW())";

		    $query = $con->Query($sql);

    }

}

function IniciarChat($id){

	global $con;
	global $c;
	global $f;

	

	include_once(VIEWS.DS.'chat/hilo.php');
}


function EnviarChat($message, $id){
	global $con;

	$sql = "insert into chat (from_name,to_name,message,sent) values ('".$_SESSION['usuario']."', '".$id."','".$message."',NOW())";
	echo $sql;
	$query = $con->Query($sql);

}

function GetHistoryChat($id){
	global $con;
	global $c;
	global $f;

	include_once(VIEWS.DS.'chat/GetSolohilo.php');	
}

function LoadConversaciones(){
	global $con;
	global $c;
	global $f;

	$mensaje = "";
	$result = $con->Query("select from_name, to_name from chat where to_name = '".$_SESSION['usuario']."' or  from_name = '".$_SESSION['usuario']."' group by from_name, to_name order by id desc");

	#echo "select from_name, to_name from chat where to_name = '".$_SESSION['usuario']."' or  from_name = '".$_SESSION['usuario']."' group by from_name, to_name order by id desc";

    $conversaciones = array();                            
    for($i=0;$i<$con->NumRows($result);$i++){
        $amigo = $con->Result($result,$i,"from_name");
        array_push($conversaciones, $amigo);
        
        if ($amigo != $_SESSION['usuario']) {
        	if (!in_array($amigo, $conversaciones)) {
        		$mensaje .= UserChat($amigo);
        		# code...
        	}

        }else{
        	$amigo = $con->Result($result,$i,"to_name");
        	if (!in_array($amigo, $conversaciones)) {
        		$mensaje .= UserChat($amigo);
        		# code...
        	}
        }


        
    }


    echo $mensaje;

}

function UserChat($amigo){

	global $con;
	global $c;
	global $f;

    $userchat = new MUsuarios();
    $userchat->CreateUsuarios("user_id", $amigo);

    $nomamigo = substr($userchat->GetP_nombre()." ".$userchat->GetP_apellido(), 0, 20);

    $avatar = $userchat->GetFoto_perfil();
    $estadochat = $userchat->GetEstadochat();

    $badge = "";


    $q = $con->Query("select count(*) as t from chat where from_name = '".$amigo."' and to_name='".$_SESSION['usuario']."' and recd = '0'");
    $consulta = $con->FetchAssoc($q);


    if($consulta["t"] >= 1)
    	$badge = "<span class='badge'>".$consulta["t"]."</span>";

    $status =  array('0' => '<span class="usuariodesconectado">Desconectado</span>' , '1' => '<span class="usuarioenlinea">En linea</span>' , '2' => '<span class="usuarioausente">Ausente</span>' , '3' => '<span class="usuarioocupado">Ocupado</span>');
#
    return ' 
     		<a href="#" class="list-group-item" onClick="AbrirChatbox(\'chatwith'.$userchat->GetA_i().'\', \''.$userchat->GetUser_id().'\', \''.$userchat->GetP_nombre().' '.$userchat->GetP_apellido().' \')" id="chatwith'.$userchat->GetA_i().'"> 
				<div style="float:left; width:40px">
					<img src="'.HOMEDIR.DS.'app/plugins/thumbnails/'.$avatar.'" style="border-radius:25px" border="0" width="30" height="30" " alt="">
				</div>

				<div style="float:left; width:160px" class="textoamigonombre">
                	'.strtolower($nomamigo).'
					<br>'.$status[$estadochat].'
				</div>

				<div style="float:left; width:30px" class="textobadge">
                	'.$badge.'
				</div>
                <div style="clear:both"></div>
                
                
            </a>';

}
?>