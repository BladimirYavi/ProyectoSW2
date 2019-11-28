<?php
class Conexion{

    public function conectar(){
        $host		= "ec2-174-129-253-1.compute-1.amazonaws.com";
        $dbname 	= "d2qoekql14tmvk";
        $usuario 	= "lfilrbxbydspcq";
        $password	= "c467d996ccc04d2c41876e32cb889dfc1989f85b21ed97e9424e63749a298133";

        $link = new PDO("pgsql:host=$host;dbname=$dbname",$usuario,$password);
        return $link;
    }

}