<?php
	//Llamar a la librería que corresponde
require_once "lib/nusoap.php"; //Librería de NuSoap
include('adodb/adodb.inc.php'); //Librería de Base de datos

    //Declaramos el NameSpace
$namespace = "urn:EjWS5_Server";

	//Creamos el servidor con el que vamos a trabajar
$server = new soap_server();

	//Configuramos el WSDL 
$server->configureWSDL("EjWS5_Server");

	//Asignamos nuestro NameSpace
$server->wsdl->schemaTargetNameSpace = $namespace;

	//Registramos el método para que sea léido por el sistema
	//El formato es register(nombreMetodo, parametrosEntrada, parametrosSalida, namespace, soapaction, style, uso, descripcion)
	//nombreMetodo: Es el nombre el método.
	//parametrosEntrada: Van dentro de un arreglo, así: array('param1'=>'xsd:string', 'param2'=>'xsd:int')
	//parametrosSalida: Van igual que los parametros de Entrada. Por defecto: array('return'=>'xsd:string')
	//namespace: Colocamos el namespace que obtuvimos anteriormente.
	//soapaction: Ocupamos la por defecto: false
	//style: Estilo, tenemos rpc o document.
	//use: encoded o literal.
	//description: Descripción del método.
$server->register(
	'funcionEjWS5',
	array("nroTramiteASD" => "xsd:int",
		"idTramiteEE" => "xsd:int", 
		"idNuevoEstado" => "xsd:int"),
	array("return" => "xsd:string"),
	$namespace,
	false,
	'rpc',
	'encoded',
	'Descripcion Ejemplo Tres');

//creamos el metodo, el nombre del método debe calzar con lo que colocamos anteriormente en register.
function funcionEjWS5($nroTramiteASD, $idTramiteEE, $idNuevoEstado)
{

	//CONEXION A LA BASE DE DATOS
	//Preparación de Datos de Conexión
	$ConexionTipoDB = "postgres";
	$ConexionHost = "localhost";
	$ConexionPuerto = "5433";
	$ConexionNombreDB = "EEMINSAL";
	$ConexionUsuario = "postgres";
	$ConexionPass = "admin";
	$ConexionStringCompleto = "host=$ConexionHost port=$ConexionPuerto dbname=$ConexionNombreDB user=$ConexionUsuario password=$ConexionPass";
	
	//La conexión en si:
	$conn = &ADONewConnection($ConexionTipoDB);
	$conn->PConnect($ConexionStringCompleto);

	//Comando a Ejecutar:


	$cliente22 = new nusoap_client("EjWS5_WebService_Interior.wsdl", true);
	$error22 = $cliente22->getError();
	if ($error22) {
		return $error22;
	}


    // insert de consulta

	$result22 = $cliente22->call("funcionEjWS5_Interior", array("nroTramiteASD22" => 11, "idTramiteEE22" => 22, "idNuevoEstado22" => 33));

    // insert respues
	$each_string = explode('charset=ISO-8859-1',htmlspecialchars($cliente22->response, ENT_QUOTES));
	foreach ($each_string as $key2 => $value2) {
		$dobleexplosion = explode(": ", trim($value2));
		foreach ($dobleexplosion as $key3 => $value3) {
			$tripleexplosion = explode("\n", $value3);
			foreach ($tripleexplosion as $key4 => $value4) {
				if (strpos($value4,'xml version') !== false) {
					$rs = $conn->Execute("INSERT INTO sch_minsal.mensajes(id_msg, id_app_origen, id_app_destino, msg, boo_msg_enviado, fecha_envio, fecha_respuesta, id_evento, id_servicio) VALUES (10, 1, 2,'$value4', true, '10-10-2010', '10-10-2010', 1, 1);");
				}
			}
		}
	}




	if ($cliente22->fault) {
		return $result22;
	}
	else {
		$error22 = $cliente22->getError();
		if ($error22) {
			return $error22;
		}
		else {
			//echo "<h2>Resultado Llamada:</h2><pre>";
			
				// insert de consulta
			//$rs = $conn->Execute("INSERT INTO sch_minsal.mensajes(id_msg, id_app_origen, id_app_destino, msg, boo_msg_enviado, fecha_envio, fecha_respuesta, id_evento, id_servicio) VALUES (8, 1, 2,'$result22', true, '10-10-2010', '10-10-2010', 1, 1);");	
			return $result22;
			//echo "</pre>";
		}
	}
}

	// Se envía la data del servicio en caso de que este siendo consumido por un cliente.
$POST_DATA = isset($GLOBALS['HTTP_RAW_POST_DATA']) ? $GLOBALS['HTTP_RAW_POST_DATA'] : '';

	// Enviamos la data a través de SOAP
$server->service($POST_DATA);
exit(); 

?>