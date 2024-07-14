<?php
    require_once "lib/nusoap.php";
    
    function GetUserData($id) {

        return join(",", array(
                                "nombre"        => "Sander Cadena", 
                                "telefono"      => "3158009300", 
                                "email"         => "sanderkdna@gmail.com", 
                                 
                               )
                    );

    }
      
    #ESTA FUNCION NOS GENERA EL ARCHIVO WSDL QUE ES EL ARCHIVO DE CONFIGURACION DEL SEBSER
    $server = new soap_server();
    $server->configureWSDL("producto", "urn:producto");
    $server->register("GetUserData",
        array("id" => "xsd:string"),
        array("return" => "xsd:string"),
        "urn:producto",
        "urn:producto#GetUserData",
        "rpc",
        "encoded",
        "Nos da una lista de productos de cada categoría");
      

    $server->service($HTTP_RAW_POST_DATA);
?>