<?php
	//Llamar a la librería que corresponde
require_once "lib/nusoap.php"; //Librería de NuSoap
include('adodb/adodb.inc.php'); //Librería de Base de datos


	//INSERT EN LA DB

        // $dbdriver = 'postgres';
      //   $db = ADONewConnection($dbdriver); # eg 'mysql' or 'postgres'


    //     $db->debug = true;
    //    $user =  'postgres';
    //     $password = 'admin';
    //     $database  = 'EEMINSAL';

       // $db->Connect($server, $user, $password, $database);


       // $conn = ADONewConnection('postgres');
		//$conn->PConnect('host=localhost port=5432 dbname=mary');
//$conn = &ADONewConnection('postgres');
//$conn->PConnect('host=localhost port=5433 dbname=EEMINSAL user=postgres password=admin');
//$conn->debug = true;
//$rs = $conn->Execute("SELECT * FROM sch_minsal.mensajes;");

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
//$conn->PConnect('host=localhost port=5433 dbname=EEMINSAL user=postgres password=admin');
$conn->PConnect($ConexionStringCompleto);

	//Comando a Ejecutar:
$rs = $conn->Execute("SELECT * FROM sch_minsal.mensajes;");
//$rs = $conn->Execute("INSERT INTO sch_minsal.mensajes(id_msg, id_app_origen, id_app_destino, msg, boo_msg_enviado, fecha_envio, fecha_respuesta, id_evento, id_servicio) VALUES (4, 1, 2, 'holahola', true, '10-10-2010', '10-10-2010', 1, 1);");
//$respuestaInsert = $conn->getOne("INSERT INTO sch_minsal.mensajes(id_msg, id_app_origen, id_app_destino, msg, boo_msg_enviado, fecha_envio, fecha_respuesta, id_evento, id_servicio) VALUES (3, 1, 2, 'holahola', true, '10-10-2010', '10-10-2010', 1, 1) RETURNING id_msg;");	


print "<pre>";
print_r($rs->GetRows());
print "</pre>";

?>