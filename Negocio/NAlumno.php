<?php 
require_once "../Dato/DAlumno.php";
require_once "../Dato/DFoto.php";
require_once "../Recursos/ApiClarifai/agregarAlumnoApi.php";

class NAlumno {
    public $DAlumno;

    public function __construct(){
        $this->DAlumno = new DAlumno();
        $this->DFoto = new DFoto();
    }

    public function mostrar(){
        return $this->DAlumno->mostrar();
    }

    public function registrar($ci, $nombre, $telefono, $estado, $fotos){
        $this->DAlumno->setCi($ci);
        $this->DAlumno->setNombre($nombre);
        $this->DAlumno->setTelefono($telefono);
        $this->DAlumno->setEstado($estado);
        $this->DAlumno->registrar();

        $idAlumno = $this->DAlumno->getIdAlumno();
        foreach ($fotos as $key => $imagen) {
            $path = "../Recursos/images";
            $path = $path."/".rand()."_".time().".jpeg";
            $img = str_replace('data:image/jpeg;base64,', '',$imagen);
            $img = str_replace(' ', '+', $img);
            if(file_put_contents($path,base64_decode($img))){
                $this->registrarFoto($path, 1, $idAlumno);
                // agregarAlumnoApi($path, $nombre);
            } 
        }
        return 1;
    }

    public function editar($idAlumno){
        return $this->DAlumno->editar($idAlumno);
    }

    public function actualizar($ci, $nombre, $telefono, $idAlumno){
        $this->DAlumno->setCi($ci);
        $this->DAlumno->setNombre($nombre);
        $this->DAlumno->setTelefono($telefono);
        return $this->DAlumno->actualizar($idAlumno);
    }

    public function borrar($idAlumno){
        return $this->DAlumno->borrar($idAlumno);
    }

    public function getIdAlumno(){
        return $this->DAlumno->getIdAlumno();
    }

    public function registrarFoto($foto, $estado, $idAlumno){
        $this->DFoto->setFoto($foto);
        $this->DFoto->setEstado($estado);
        $this->DFoto->setIdalumno($idAlumno);
        $this->DFoto->registrar();
    }
    

}


// $alumno = new NAlumno();
// echo json_encode($alumno->borrar(9));