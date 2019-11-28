<?php
header("Access-Control-Allow-Origin: *");

 require_once "../Negocio/NMateria.php";
 $NMateria = new NMateria();

 if($_SERVER['REQUEST_METHOD']=='GET'){
    if (isset($_GET['accion'])) {

        $accion = $_GET['accion'];
        if($accion == "mostrar"){
            $respuesta = $NMateria->mostrar();
            echo json_encode(['resultado'=>'correcto','datos'=>$respuesta]);
     
        }else if($accion == 'editar'){
            if(isset($_GET['idMateria'])){
                $idMateria =  $_GET["idMateria"];
                $respuesta = $NMateria->editar($idMateria);
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
        $sigla = $datos['sigla'];
        $nombre = $datos['nombre'];
        $nivel = $datos['nivel'];
        $respuesta = $NMateria->registrar($sigla, $nombre, $nivel, 1);
        if($respuesta==1){
			echo json_encode(['resultado' => 'Se registro correctamente']);
		}else{
			echo json_encode(['resultado' => 'Ocurrio un error']);
        }
        
    }else if($accion == 'actualizar'){
        $sigla = $datos['sigla'];
        $nombre = $datos['nombre'];
        $nivel = $datos['nivel'];
        $idMateria = $datos["idMateria"];
        $respuesta = $NMateria->actualizar($sigla, $nombre, $nivel, $idMateria);
        if($respuesta==1){
			echo json_encode(['resultado' => 'Se registro correctamente']);
		}else{
			echo json_encode(['resultado' => 'Ocurrio un error']);
        }

    }else if($accion == 'borrar') {
        $idMateria = $datos['idMateria'];
        $respuesta = $NMateria->borrar($idMateria);
        if($respuesta==1){
			echo json_encode(['resultado' => 'Se registro correctamente']);
		}else{
			echo json_encode(['resultado' => 'Ocurrio un error']);
        }

    }else{
        echo json_encode(['resultado' => 'No se definio la accion']);
    }


  
}





 





