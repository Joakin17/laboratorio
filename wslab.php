<?php
require "vendor/autoload.php";
$server=new nusoap_server;
$server->configureWSDL('server','urn:server');
$server->wsdl->schemaTargetNamespace='urn:server';
$server->wsdl->addComplexType(
    'Persona',
    'complexType',
    'struct',
    'all',
    '',
    array(
        "Idalu"=>array('name'=>'Idalu','type'=>'xsd:int'),
        'nombre'=>array('name'=>'nombre','type'=>'xsd:string'),
        'laboratorio1'=>array('name'=>'laboratorio1','type'=>'xsd:float'),
        'laboratorio2'=>array('name'=>'laboratorio2','type'=>'xsd:float'),
        'parcial'=>array('name'=>'parcial','type'=>'xsd:float'),
        'promedio'=>array('name'=>'promedio','type'=>'xsd:float')
    
        
    )
);
$server->register('calcularnotas',
                array('Idalu'=>'xsd:int','nombre'=>'xsd:string','laboratorio1'=>'xsd:float','laboratorio2'=>'xsd:float','parcial'=>'xsd:float'),
                array('return'=>'tns:Persona'),
                'urn:server',
                'urn:server#calcularnotasserver',
                'rpc',
                'encoded',
                'funcion para calcular notas'
);


function calcularnotas($Idalu,$nombre,$laboratorio1,$laboratorio2,$parcial){
    $total=(($laboratorio1*0.25)+($laboratorio2*0.25)+($parcial*0.5));
    $conexion= new mysqli("localhost","root","catolica","registro_joaquin");
    $conexion->query("insert into alumnos_joaquin values (null, '$nombre', '$laboratorio1', '$laboratorio2','$parcial')");
    
     $valor=array(
         'Idalu'=>$Idalu,
         'nombre'=>$nombre,
         'laboratorio1'=>$laboratorio1,
         'laboratorio2'=>$laboratorio2,
         'parcial'=>$parcial,
         'promedio'=>$total
         
         );
 

    return $valor;
 }

$server->service(file_get_contents("php://input"));