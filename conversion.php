<?php
require "vendor/autoload.php";
$url="https://www.w3schools.com/xml/tempconvert.asmx?WSDL";
$cliente=new nusoap_client($url,"wsdl");
$error=$cliente->getError();
if ($error) {
    echo "error de conexion con el webservice: $error";
}
$parametros=array("Fahrenheit"=>80);
$grados=$cliente->call('FahrenheitToCelsius',$parametros);
echo "<h1> {$parametros["Fahrenheit"]} grados Fahrenheit equivalen a {$grados["FahrenheitToCelsiusResult"]} celsius </h1>";
$parametro=array("Celsius"=>35);
$grados=$cliente->call('CelsiusToFahrenheit',$parametro);
echo "<h1> {$parametro["Celsius"]} grados Fahrenheit equivalen a {$grados["CelsiusToFahrenheitResult"]} celsius </h1>";

