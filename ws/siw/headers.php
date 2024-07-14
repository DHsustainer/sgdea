<?

    require_once ("lib/nusoap/nusoap.php");

    if (!isset($_SESSION['VAR_SESSIONES'])) {

        $cliente = new nusoap_client("http://laws.com.co/ws/GetDetailSuscriptorKeys.wsdl", true);

        $error = $cliente->getError();

        if ($error) {

            echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";

        }

        $array = array("id" => $_SERVER['HTTP_HOST'], "key" => $_SESSION['user_key']);

        $result = $cliente->call("GetDataSesion", $array);

        if ($cliente->fault) {

            echo "<h2>Fault</h2><pre>";

            echo "</pre>";

        }else{

            $error = $cliente->getError();

            if ($error) {

                echo "<h2>Error</h2><pre>" . $error . "</pre>";

            }else {

                if ($result == "") {

                    echo "No se creo el WS";

                }else{

                    $x  = explode(",", $result);



                    if ($x[0] != 'errno') {

                        $_SESSION["pzhkCSC0XMwpGMT"] = desencriptar($x[0], $_SESSION['user_key']);

                        $_SESSION["kYg8omRSc1EDj3u"] = desencriptar($x[1], $_SESSION['user_key']);

                        $_SESSION["1oKU35BSbQ7CG5Q"] = desencriptar($x[2], $_SESSION['user_key']);

                        $_SESSION["71c029wus3yJWEN"] = desencriptar($x[3], $_SESSION['user_key']);

                        $_SESSION['VAR_SESSIONES'] = true;

                    }else{

                        $_SESSION['VAR_SESSIONES'] = false;

                    }

                }

            }

        }

    }



    function desencriptar($cadena, $key){

        $decrypted = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($cadena), MCRYPT_MODE_CBC, md5(md5($key))), "\0");

        return $decrypted;  //Devuelve el string desencriptado

    }



    include_once('../../app/basePaths.inc.php');

    include_once(ROOT.DS.'DALC'.DS.'/mySql.php');

    include_once('../../app/controller/consultas.php');

    include_once('../../app/controller/funciones.php');

    $con = new ConexionBaseDatos;

    $con->Connect($con);

    $c = new Consultas;

    $f = new Funciones;





/*

    public function  MyFunction($key, $type) {



        global $con;

        global $c;



        try {



            $checkKey = $c->wscontrol($key);

            $output = array();



            if ($checkKey) {

                $output['0'] = "logged";



                #CODE STARTS HERE



                return join(",", $output );

            }else{

                $output[0] = "invalid Key";

                return join(",", $output );

            }

            

        }catch(Exception $e){

            $output[0] = "some Exception $e";

            return join(",", $output );

        }



    }



*/

?>