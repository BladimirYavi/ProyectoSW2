<?php
header("Access-Control-Allow-Origin: *");

 require_once "../Negocio/NAlumno.php";
 $NAlumno = new NAlumno();

 if($_SERVER['REQUEST_METHOD']=='GET'){
    if (isset($_GET['accion'])) {

        $accion = $_GET['accion'];
        if($accion == "mostrar"){
            $respuesta = $NAlumno->mostrar();
            echo json_encode(['resultado'=>'correcto','datos'=>$respuesta]);
     
        }else if($accion == 'editar'){
            if(isset($_GET['idAlumno'])){
                $idAlumno =  $_GET["idAlumno"];
                $respuesta = $NAlumno->editar($idAlumno);
                echo json_encode(['resultado'=>'correcto','datos'=>$respuesta]);
            }else{
                echo json_encode(array('resultado' => 'Falta el identificador'));
            }	

        }else{
            echo json_encode(array('resultado' => 'No existe accion'));
        }	
 
    }else{
         echo json_encode(array('resultado' => 'No se definio la accion'));
    }
    
} else if($_SERVER['REQUEST_METHOD']=='POST'){
    $datos = json_decode(file_get_contents("php://input"),true);
    $accion = $datos["accion"];

    if($accion == 'registrar') {
        $ci = $datos['ci'];
        $nombre = $datos['nombre'];
        $telefono = $datos['telefono'];
        $fotos = $datos['fotos'];
        $respuesta = $NAlumno->registrar($ci, $nombre, $telefono, 1, $fotos);
        if($respuesta==1){
			echo json_encode(['resultado' => 'Se registro correctamente']);
		}else{
			echo json_encode(['resultado' => 'Ocurrio un error']);
        }
        
    }else if($accion == 'actualizar'){
        $ci = $datos['ci'];
        $nombre = $datos['nombre'];
        $telefono = $datos['telefono'];
        $idAlumno = $datos["idAlumno"];
        $respuesta = $NAlumno->actualizar($ci, $nombre, $telefono, $idAlumno);
        if($respuesta==1){
			echo json_encode(['resultado' => 'Se registro correctamente']);
		}else{
			echo json_encode(['resultado' => 'Ocurrio un error']);
        }

    }else if($accion == 'borrar') {
        $idAlumno = $datos['idAlumno'];
        $respuesta = $NAlumno->borrar($idAlumno);
        if($respuesta==1){
			echo json_encode(['resultado' => 'Se registro correctamente']);
		}else{
			echo json_encode(['resultado' => 'Ocurrio un error']);
        }

    }else{
        echo json_encode(['resultado' => 'No se definio la accion']);
    }


  
}





 





