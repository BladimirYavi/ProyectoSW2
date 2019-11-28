<?php
class Conexion{

    public function conectar(){
        $host		= "ec2-174-129-255-106.compute-1.amazonaws.com";
        $dbname 	= "d32br04ka132tr";
        $usuario 	= "syujivhbfoulgi";
        $password	= "8e5ceb4085d0ab99c9ee8e607885d2ea41b8870fca2c0f241534c6bc7599c0ad";

        $link = new PDO("pgsql:host=$host;dbname=$dbname",$usuario,$password);
        return $link;
    }

}