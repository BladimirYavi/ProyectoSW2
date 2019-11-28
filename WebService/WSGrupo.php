<?php
header("Access-Control-Allow-Origin: *");

 require_once "../Negocio/NGrupo.php";
 $NGrupo = new NGrupo();

 if($_SERVER['REQUEST_METHOD']=='GET'){
    if (isset($_GET['accion'])) {

        $accion = $_GET['accion'];
        if($accion == "mostrar"){
            $respuesta = $NGrupo->mostrar();
            echo json_encode(['resultado'=>'correcto','datos'=>$respuesta]);
     
        }else if($accion == 'editar'){
            if(isset($_GET['idGrupo'])){
                $idGrupo =  $_GET["idGrupo"];
                $respuesta = $NGrupo->editar($idGrupo);
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
        $nombre = $datos['nombre'];
        $idMateria = $datos['idMateria'];
        $idDocente = $datos['idDocente'];
        $respuesta = $NGrupo->registrar($nombre, 1, $idMateria, $idDocente);
        if($respuesta==1){
			echo json_encode(['resultado' => 'Se registro correctamente']);
		}else{
			echo json_encode(['resultado' => 'Ocurrio un error']);
        }
        
    }else if($accion == 'actualizar'){
        $nombre = $datos['nombre'];
        $idMateria = $datos['idMateria'];
        $idDocente = $datos['idDocente'];
        $idGrupo = $datos["idGrupo"];
        $respuesta = $NGrupo->actualizar($nombre, $idMateria, $idDocente, $idGrupo);
        if($respuesta==1){
			echo json_encode(['resultado' => 'Se registro correctamente']);
		}else{
			echo json_encode(['resultado' => 'Ocurrio un error']);
        }

    }else if($accion == 'borrar') {
        $idGrupo = $datos['idGrupo'];
        $respuesta = $NGrupo->borrar($idGrupo);
        if($respuesta==1){
			echo json_encode(['resultado' => 'Se registro correctamente']);
		}else{
			echo json_encode(['resultado' => 'Ocurrio un error']);
        }

    }else{
        echo json_encode(['resultado' => 'No se definio la accion']);
    }


  
}





 





