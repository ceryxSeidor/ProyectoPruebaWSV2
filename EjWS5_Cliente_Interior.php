<?php
    
    //SEIDOR

    require_once "lib/nusoap.php";
	
    $cliente = new nusoap_client("EjWS5_WebService.wsdl", true);
      
    $error = $cliente->getError();
    if ($error) {
        echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";
    }
    

    // insert de consulta

    $result = $cliente->call("funcionEjWS5", array("nroTramiteASD" => 11, "idTramiteEE" => 22, "idNuevoEstado" => 33));

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
            echo $result;
            echo "</pre>";
        }
    }
?>