<?php
	//Llamar a la librería que corresponde
    require_once "lib/nusoap.php";

    //Declaramos el NameSpace
    $namespace = "urn:EjWS6_Server";
	
	//Creamos el servidor con el que vamos a trabajar
	$server = new soap_server();
	
	//Configuramos el WSDL 
	$server->configureWSDL("EjWS6_Server");

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
		'funcionEjWS6',
		array("nroTramiteASD" => "xsd:int",
			 "idTramiteEE" => "xsd:int", 
			 "idNuevoEstado" => "xsd:int",
			 "resolucionAdjunta" => "xsd:boolean"),
        array("return" => "xsd:boolean"),
        $namespace,
        false,
        'rpc',
        'encoded',
        'Descripcion Ejemplo Tres');

//creamos el metodo, el nombre del método debe calzar con lo que colocamos anteriormente en register.
	function funcionEjWS6($nroTramiteASD, $idTramiteEE, $idNuevoEstado, $resolucionAdjunta)
	{
		return true;
	}

	// Se envía la data del servicio en caso de que este siendo consumido por un cliente.
	$POST_DATA = isset($GLOBALS['HTTP_RAW_POST_DATA']) ? $GLOBALS['HTTP_RAW_POST_DATA'] : '';
 
	// Enviamos la data a través de SOAP
	$server->service($POST_DATA);
	exit(); 

	?>