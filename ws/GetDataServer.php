<?php
    require_once "lib/nusoap.php";
    include_once('../app/basePaths.inc.php');
    include_once('../app/controller/consultas.php');
    include_once('../app/controller/funciones.php');

    include_once(ROOT.DS.'DALC'.DS.'/mySql.php');
    #include_once(ROOT.DS.'models'.DS.'/Events_gestionM.php');
    include_once(MODELS.DS.'Events_gestionM.php');
      
    $con = new ConexionBaseDatos;
    $con->Connect($con);

    $c = new Consultas;
    $f = new Funciones;

    function GetDataServer($domain) {

        global $con;
        global $f; 

        echo "Servidor: ".$domain."<br>";
        # ESTO VENDRÍA SIENDO EL SERVIDOR DEL CLIENTE
        echo "Nombre Encriptado:".encriptar($domain, "hola")."<br>";

        $enc = encriptar($domain, "hola");

        echo "Nombre Desencriptado:".desencriptar($enc, "hola");

    }

   function encriptar($cadena, $key){
        $encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $cadena, MCRYPT_MODE_CBC, md5(md5($key))));
        return $encrypted; //Devuelve el string encriptado
 
    }
     
    function desencriptar($cadena, $key){
        $decrypted = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($cadena), MCRYPT_MODE_CBC, md5(md5($key))), "\0");
        return $decrypted;  //Devuelve el string desencriptado
    }

    GetDataServer($_SERVER['HTTP_HOST']);
      
    #ESTA FUNCION NOS GENERA EL ARCHIVO WSDL QUE ES EL ARCHIVO DE CONFIGURACION DEL SEBSER
    $server = new soap_server();
    $server->configureWSDL("Obtener Informaci&oacute;n del Servidor", "urn:producto");
    $server->register("GetDataServer",
        array("id" => "xsd:string", "guia" => "xsd:string", "estado" => "xsd:string", "observacion" => "xsd:string"),
        array("return" => "xsd:string"),
        "urn:producto",
        "urn:producto#GetDataServer",
        "rpc",
        "encoded",
        "Nos da una lista de productos de cada categoría");
      
    $server->service($HTTP_RAW_POST_DATA);
?>