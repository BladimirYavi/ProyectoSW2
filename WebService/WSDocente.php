<?php
header("Access-Control-Allow-Origin: *");

 require_once "../Negocio/NDocente.php";
 $NDocente = new NDocente();

 if($_SERVER['REQUEST_METHOD']=='GET'){
    if (isset($_GET['accion'])) {

        $accion = $_GET['accion'];
        if($accion == "mostrar"){
            $respuesta = $NDocente->mostrar();
            echo json_encode(['resultado'=>'correcto','datos'=>$respuesta]);
     
        }else if($accion == 'editar'){
            if(isset($_GET['idDocente'])){
                $idDocente =  $_GET["idDocente"];
                $respuesta = $NDocente->editar($idDocente);
                echo json_encode(['resultado'=>'correcto','datos'=>$respuesta]);
            }else{
                echo json_encode(array('resultado' => 'Falta el identificador'));
            }	

        }else if($accion == 'mostrarAlumnos'){
            if(isset($_GET['idGrupo'])){
                $identificador = $_GET['idGrupo'];
                $respuesta = $NDocente->mostrarAlumnos($identificador);
                echo json_encode(['resultado'=>'correcto','datos'=>$respuesta]);
            }else{
                echo json_encode(array('resultado' => 'Falta el identificador'));
            }	
        
        }else if($accion == 'mostrarGrupos'){
            if(isset($_GET['idDocente'])){
                $identificador = $_GET['idDocente'];
                $respuesta = $NDocente->mostrarGrupos($identificador);
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
        $telefono = $datos['telefono'];
        $email = $datos['email'];
        $password = $datos['password'];
        $respuesta = $NDocente->registrar($nombre, $telefono, $email, $password, 1);
        if($respuesta==1){
			echo json_encode(['resultado' => 'Se registro correctamente']);
		}else{
			echo json_encode(['resultado' => 'Ocurrio un error']);
        }
        
    }else if($accion == 'actualizar'){
        $nombre = $datos['nombre'];
        $telefono = $datos['telefono'];
        $email = $datos['email'];
        $password = $datos['password'];
        $idDocente = $datos["idDocente"];
        $respuesta = $NDocente->actualizar($nombre, $telefono, $email, $password, $idDocente);
        if($respuesta==1){
			echo json_encode(['resultado' => 'Se registro correctamente']);
		}else{
			echo json_encode(['resultado' => 'Ocurrio un error']);
        }

    }else if($accion == 'borrar') {
        $idDocente = $datos['idDocente'];
        $respuesta = $NDocente->borrar($idDocente);
        if($respuesta==1){
			echo json_encode(['resultado' => 'Se registro correctamente']);
		}else{
			echo json_encode(['resultado' => 'Ocurrio un error']);
        }

    }else if($accion == 'login'){
        $respuesta= $NDocente->login($datos["email"], $datos["password"]);
        echo json_encode($respuesta);

    }else{
        echo json_encode(['resultado' => 'No se definio la accion']);
    }


  
}





 





