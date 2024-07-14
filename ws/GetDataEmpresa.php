<?php
    require_once "lib/nusoap.php";
    include_once('../app/basePaths.inc.php');
    include_once(MODELS.DS.'Super_adminM.php');
    include_once(ROOT.DS.'DALC'.DS.'/mySql.php');
      
    $con = new ConexionBaseDatos;
    $con->Connect($con);

    function GetUserData($id) {

        global $con;

        $object = new MSuper_admin;
        $object->CreateSuper_admin("cedula", $id);

        if ($object->GetP_nombre() != "") {
            return join(",", array( 
                                    "Getp_nombre"               => $object->Getp_nombre(),
                                    "Getcedula"                 => $object->Getcedula(),
                                    "Getexp_identificacion"     => $object->Getexpedicion_identificacion(),
                                    "Getemail"                  => $object->Getemail(),
                                    "Gettelefono"               => $object->Gettelefono(),
                                    "Getcelular"                => $object->Getcelular(),
                                    "Getdepartamento"           => $object->Getdepartamento(),
                                    "Getciudad"                 => $object->Getciudad(),
                                    "Getdireccion"              => $object->Getdireccion(),
                                    "Getnombre_representante"   => $object->Getnombre_representante(),
                                    "Getcedula_representante"   => $object->Getcedula_representante(),
                                    "Getexpedicion_cedula"      => $object->Getexpedicion_cedula(),
                                    "Getciudad_residencia"      => $object->Getciudad_residencia()

                                   )
                        );

        }
        else {
            return "el Usuario '$id' no se encuentra registrado";
        }
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