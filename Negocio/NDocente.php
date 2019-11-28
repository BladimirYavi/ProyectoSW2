<?php 
require_once "../Dato/DDocente.php";

class NDocente {
    public $DDocente;

    public function __construct(){
        $this->DDocente = new DDocente();
    }

    public function mostrar(){
        return $this->DDocente->mostrar();
    }

    public function registrar($nombre, $telefono, $email, $password, $estado){
        $salt = substr(base64_encode(openssl_random_pseudo_bytes('30')), 0, 22);
        // A Crypt no le gustan los '+' así que los vamos a reemplazar por puntos.
        $salt = strtr($salt, array('+' => '.')); 
        // Generamos el hash
        $hash = crypt($password, '$2y$10$'.$salt);
        $this->DDocente->setNombre($nombre);
        $this->DDocente->setTelefono($telefono);
        $this->DDocente->setEmail($email);
        $this->DDocente->setPassword($hash);
        $this->DDocente->setEstado($estado);
        return $this->DDocente->registrar();
    }

    public function editar($idDocente){
        return $this->DDocente->editar($idDocente);
    }

    public function actualizar($nombre, $telefono, $email, $password, $idDocente){
        $salt = substr(base64_encode(openssl_random_pseudo_bytes('30')), 0, 22);
        // A Crypt no le gustan los '+' así que los vamos a reemplazar por puntos.
        $salt = strtr($salt, array('+' => '.')); 
        // Generamos el hash
        $hash = crypt($password, '$2y$10$'.$salt);
        $this->DDocente->setNombre($nombre);
        $this->DDocente->setTelefono($telefono);
        $this->DDocente->setEmail($email);
        $this->DDocente->setPassword($hash);
        return $this->DDocente->actualizar($idDocente);
    }

    public function borrar($idDocente){
        return $this->DDocente->borrar($idDocente);
    }

    public function mostrarAlumnos($idGrupo){
        return $this->DDocente->mostrarAlumnos($idGrupo);
    }

    public function mostrarGrupos($idDocente){
        return $this->DDocente->mostrarGrupos($idDocente);
    }

    public function login($email, $password){
        $this->DDocente->setEmail($email);
        $this->DDocente->setPassword($password);
        return $this->DDocente->login();
    }

}

// $docente =new DDocente();
// $respuesta = $docente->mostrar();
// var_dump($respuesta);