<?php
if (isset($_POST["laboratorio1"])) { 
require "vendor/autoload.php";
$url="http://192.168.56.103/webservice/wslab.php?wsdl";

$cliente=new nusoap_client($url,"wsdl");
$error=$cliente->getError();
if ($error) {
    echo "error de conexion con el webservice: $error";
}

$parametros=array("Idalu"=>$_POST["Idalu"],"nombre"=>$_POST["nombre"],"laboratorio1"=>$_POST["laboratorio1"],"laboratorio2"=>$_POST["laboratorio2"],"parcial"=>$_POST["parcial"]);
$resultado=$cliente->call('calcularnotas',$parametros);
echo $cliente->getError();

echo "
        <h1>ID:{$resultado["Idalu"]}</h1>
        <h1>nombre:{$resultado["nombre"]}</h1>
        <h1>laboratorio1:{$resultado["laboratorio1"]}</h1>
        <h1>laboratorio2:{$resultado["laboratorio2"]}</h1>
        <h1>parcial:{$resultado["parcial"]}</h1>
        <h1>promedio:{$resultado["promedio"]}</h1>

    ";
    
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

    ID<input type="int" name="Idalu" id="Idalu">
    nombre<input type="string" name="nombre" id="nombre">
    laboratorio1 <input type="float" name="laboratorio1" id="laboratorio1">
    laboratorio2 <input type="float" name="laboratorio2" id="laboratorio2">
    parcial<input type="float" name="parcial" id="parcial">
    <input type="submit" value="enviar">

    </form>
    
</body>
</html>
<?php
}
?>