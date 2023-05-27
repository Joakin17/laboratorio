<?php
require "vendor/autoload.php";
$server=new nusoap_server;
$server->configureWSDL('server','urn:server');
$server->wsdl->schemaTargetNamespace='urn:server';
$server->register('hola',
                array('usuario'=>'xsd:string'),
                array('return'=>'xsd:string'),
                'urn:server',
                'urn:server#holaServer',
                'rpc',
                'encoded',
                'funcion hola mundo en un web service'
);
$server->register('sumatoria',
                array('v1'=>'xsd:int','v2'=>'xsd:int'),
                array('resultado'=>'xsd:int'),
                'urn:server',
                'urn:server#sumatoriaServer',
                'rpc',
                'encoded',
                'funcion para calcular la sumatoria de dos numeros'
);

$server->wsdl->addComplexType(
    'Persona',
    'complexType',
    'struct',
    'all',
    '',
    array(
        "id_user"=>array('name'=>'id_user','type'=>'xsd:int'),
        'fullname'=>array('name'=>'fullname','type'=>'xsd:string'),
        'email'=>array('name'=>'email','type'=>'xsd:string'),
        'msg'=>array('name'=>'msg','type'=>'xsd:string'),
        'level'=>array('name'=>'level','type'=>'xsd:int')
    )
);

$server->register('login',
                array('username'=>'xsd:int','password'=>'xsd:int'),
                array('return'=>'tns:Persona'),
                'urn:server',
                'urn:server#loginserver',
                'rpc',
                'encoded',
                'funcion para validar credenciales'
);
function login($username,$password){
   if(($username=="admin") && ($password=="catolica")) {
    $valor=array(
        'id_user'=>1,
        'fullname'=>'juan de lopez',
        'email'=>'juan@gmail.com',
        'msg'=>'usuario correcto',
        'level'=>1

    );
   }else {
    $valor=array(
        'id_user'=>0,
        'fullname'=>'',
        'email'=>'',
        'msg'=>'usuario incorrecto',
        'level'=>0

        );

   }
   return $valor;
}

function hola($usuario){
    return "Bienvenido $usuario";
}

function sumatoria($v1,$v2){
    $total=0;
   for ($l=$v1;$l<=$v2;$l++){
    $total+=$l;
   }
   return $total;
}


$server->service(file_get_contents("php://input"));


