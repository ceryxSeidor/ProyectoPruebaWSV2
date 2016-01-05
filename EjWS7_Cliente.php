<?php

    //SEIDOR

require_once "lib/nusoap.php";

$cliente = new nusoap_client("EjWS7_WebService.wsdl", true);

$error = $cliente->getError();
if ($error) {
    echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";
}


    // insert de consulta

$result = $cliente->call("funcionEjWS7", array("nroTramite" => 11));

    // insert respues


if ($cliente->fault) {
    echo "<h2>Fault</h2><pre>";
    print_r($result);
    echo "</pre>";
}
else {
    $error = $cliente->getError();
    if ($error) {
        echo "<h2>Error</h2><pre>" . $error . "</pre>";
    }
    else {
        echo "<h2>Resultado Llamada:</h2><pre>";
        foreach ($result as $key => $value) {
            echo "Llave: $key, Valor: $value\n";
        }
        echo "</pre>";
    }


    // show soap request and response
    echo '<h2>Request</h2>';
    echo '<pre>' . htmlspecialchars($cliente->request, ENT_QUOTES) . '</pre>';
    echo '<h2>Response</h2>';
    echo '<pre>' . htmlspecialchars($cliente->response, ENT_QUOTES) . '</pre>';
    echo '<h2>Response Explode</h2>';
    $each_string = explode('charset=ISO-8859-1',htmlspecialchars($cliente->response, ENT_QUOTES));
    //$newString = explode(': ', $each_string);
    echo "<h2>Explosion:</h2><pre>";
    foreach ($each_string as $key2 => $value2) {
        //echo "$key2: $value2\n";

        $dobleexplosion = explode(": ", trim($value2));
        foreach ($dobleexplosion as $key3 => $value3) {
            //echo "$key3: $value3\n";
            $tripleexplosion = explode("\n", $value3);
            foreach ($tripleexplosion as $key4 => $value4) {
                echo "$key4: $value4\n";
            }
        }


    }
    echo "</pre>";
    echo '<h2>seis</h2>';
}
?>