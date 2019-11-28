<?php
header("Access-Control-Allow-Origin: *");

 require_once "../Negocio/NInscripcion.php";
 $NInscripcion = new NInscripcion();

 if($_SERVER['REQUEST_METHOD']=='GET'){
    if (isset($_GET['accion'])) {

        $accion = $_GET['accion'];
        if($accion == "mostrar"){
            $respuesta = $NInscripcion->mostrar();
            echo json_encode(['resultado'=>'correcto','datos'=>$respuesta]);
     
        }else if($accion == 'mostrarDetalle'){
            if(isset($_GET['idInscripcion'])){
                $identificador = $_GET['idInscripcion'];
                $respuesta = $NInscripcion->mostrarDetalle($identificador);
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
        $fecha = $datos['fecha'];
        $cantidad = $datos['cantidad'];
        $idAlumno = $datos['idAlumno'];
        $grupos = $datos['grupos'];
        $respuesta = $NInscripcion->registrar($fecha, $cantidad, 1, $idAlumno, $grupos);
        if($respuesta==1){
			echo json_encode(['resultado' => 'Se registro correctamente']);
		}else{
			echo json_encode(['resultado' => 'Ocurrio un error']);
        }
        
    }else if($accion == 'actualizar'){
        $fecha = $datos['fecha'];
        $cantidad = $datos['cantidad'];
        $idAlumno = $datos['idAlumno'];
        $idIncripcion = $datos["idIncripcion"];
        $respuesta = $NInscripcion->actualizar($fecha, $cantidad, $idAlumno, $idInscripcion);
        if($respuesta==1){
			echo json_encode(['resultado' => 'Se registro correctamente']);
		}else{
			echo json_encode(['resultado' => 'Ocurrio un error']);
        }

    }else if($accion == 'borrar') {
        $idInscripcion = $datos['idInscripcion'];
        $respuesta = $NInscripcion->borrar($idInscripcion);
        if($respuesta==1){
			echo json_encode(['resultado' => 'Se registro correctamente']);
		}else{
			echo json_encode(['resultado' => 'Ocurrio un error']);
        }

    }else{
        echo json_encode(['resultado' => 'No se definio la accion']);
    }


  
}





 





