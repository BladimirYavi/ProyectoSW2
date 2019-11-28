<?php
header("Access-Control-Allow-Origin: *");

 require_once "../Negocio/NAsistencia.php";
 $NAsistencia = new NAsistencia();

 if($_SERVER['REQUEST_METHOD']=='GET'){
    if (isset($_GET['accion'])) {

        $accion = $_GET['accion'];
        if($accion == 'mostrar'){
            if(isset($_GET['idGrupo'])){
                $identificador = $_GET['idGrupo'];
                $respuesta = $NAsistencia->mostrar($identificador);
                echo json_encode(['resultado'=>'correcto','datos'=>$respuesta]);
            }else{
                echo json_encode(array('resultado' => 'Falta el identificador'));
            }	
        
        }else if($accion == 'mostrarDetalle'){
            if(isset($_GET['idAsistencia'])){
                $idAsistencia = $_GET['idAsistencia'];
                $idGrupo = $_GET['idGrupo'];
                $respuesta = $NAsistencia->mostrarDetalle($idAsistencia, $idGrupo);
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
        $idGrupo = $datos['idGrupo'];
        $respuesta = $NAsistencia->registrar($fecha, 1, $idGrupo);
        if($respuesta==1){
            $idAsistencia =$NAsistencia->getIdAsistencia();
			echo json_encode(['resultado' => 'Se registro correctamente','idAsistencia'=>$idAsistencia]);
		}else{
			echo json_encode(['resultado' => 'Ocurrio un error']);
        }
        
    }else if($accion == 'actualizarDetalle') {  
        $respuesta = $NAsistencia->actualizarDetalle($datos['marcacion'],$datos['idAsistencia'],$datos['idInscripcion'],$datos['idGrupo']);
        if($respuesta==1){
			echo json_encode(['resultado' => 'Se registro correctamente']);
		}else{
			echo json_encode(['resultado' => 'Ocurrio un error']);
        }

    }else if($accion == 'actualizarDetalleMultiple'){
        $respuesta= $NAsistencia->actualizarDetalleMultiple($datos["alumnos"]);
        if($respuesta==1){
			echo json_encode(['resultado' => 'Se registro correctamente']);
		}else{
			echo json_encode(['resultado' => 'Ocurrio un error']);
        }

    }else{
        echo json_encode(['resultado' => 'No se definio la accion']);
    }


  
}





 





