<?php
if (isset($_POST["v1"])) { 
require "vendor/autoload.php";
$url="http://localhost/webservice/ws.php?wsdl";
$cliente=new nusoap_client($url,"wsdl");
$error=$cliente->getError();
if ($error) {
    echo "error de conexion con el webservice: $error";
}
$parametros=array("v1"=>$_POST["v1"],"v2"=>$_POST["v2"]);
$resultado=$cliente->call('sumatoria',$parametros);
print_r($resultado);
echo "<h1>  el resultado de la sumatoriaes {$parametros["v1"]} con {$parametros["v2"]} es {$resultado}</h1>";


}else {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">

    digite v1 <input type="int" name="v1" id="v1">
    digite v2 <input type="int" name="v2" id="v2">
    <input type="submit" value="enviar">

    </form>
    
</body>
</html>
<?php
}
?>