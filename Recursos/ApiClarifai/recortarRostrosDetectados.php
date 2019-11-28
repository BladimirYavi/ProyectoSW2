<?php
require_once('vendor/autoload.php');

use Clarifai\API\ClarifaiClient;
use Clarifai\DTOs\Inputs\ClarifaiURLImage;
use Clarifai\DTOs\Outputs\ClarifaiOutput;
use Clarifai\DTOs\Predictions\Concept;
use Clarifai\DTOs\Searches\SearchBy;
use Clarifai\DTOs\Searches\SearchInputsResult;
use Clarifai\DTOs\Models\ModelType;
use Clarifai\DTOs\Inputs\ClarifaiFileImage;

$client = new ClarifaiClient('f1095b8a786a45ee9096f369ffa2b658');//f1095b8a786a45ee9096f369ffa2b658


$target_dir="images";
if(!file_exists($target_dir)){
	mkdir($target_dir,0777,true);
}

$target_dir=$target_dir."/".rand().'_'.time().".jpeg";    ///set random image file name with time

if(move_uploaded_file($_FILES['image']['tmp_name'],$target_dir)){
    //HACER PREDICCION//
    $url=$target_dir;
    $model = $client->publicModels()->faceDetectionModel();

    $input = new ClarifaiFileImage(file_get_contents($url));
    $response = $model->predict($input)
        // ->withModelVersionID("aa7f35c01e0642fda5cf400f543e7c40")
        ->executeSync();

    if ($response->isSuccessful()) {
        $output = $response->get();  $resultadoProceso=[];
        foreach ($output->data() as $concept) {  //    echo $concept->name() . ': ' . $concept->value() . "\n";
            $coordenada= $concept->crop()->serializeAsArrayProperty();
            $target_dir="images";
            $infoImage=getimagesize($url);
            $infoWith=$infoImage[0];
            $infoHeight=$infoImage[1];
            $infoType=$infoImage['mime'];

            $src_img=imagecreatefromjpeg($url);  ///abrir la foto original
            $src_x= $coordenada['left']*$infoWith; ///empieza desde el punto 0.0  en el eje x  (el eje x se mide en pixeles)
            $src_y= $coordenada['top']*$infoHeight;  ///empieza desde el punto 0.0 en el eje y
            $src_w=$coordenada['right']*$infoWith-$src_x;  //ancho original que se tomara del original partiendo del eje x (ej si x=10 y w=100 entonses recorrera 10 pixeles y desde ahi se tomara el ancho de 100)
            $src_h=$coordenada['bottom']*$infoHeight-$src_y;  //alto original que se tomara del original partiendo del eje y
            $dst_x=0; // el eje x del destino en donde se pega (por preferencia siempre 0)
            $dst_y=0; //el eje y del destino en donde se pega  (por preferencia siempre 0)
            $dst_w= $src_w;  //ancho nuevo
            $dst_h= $src_h;  ///alto nuevo
            /// creo el lienzo vacio para la copia original con el ancho y el alto nuevo
            $dst_img=imagecreatetruecolor($dst_w,$dst_h); 
            //copiar original al lienzo
            imagecopyresampled($dst_img, $src_img, $dst_x, $dst_y, $src_x, $src_y, $dst_w, $dst_h, $src_w, $src_h);
            //exportar/guardar imagen     
            $target_dir=$target_dir."/".rand().'_'.time().".jpg";    ///set random image file name with time
            imagejpeg($dst_img, $target_dir,100);
            imagedestroy($src_img);
            imagedestroy($dst_img);

            $response = $client->predict(ModelType::concept(), 'persona',
            new ClarifaiFileImage(file_get_contents($target_dir)))
            ->executeSync();

            if ($response->isSuccessful()) {
                $output = $response->get();
                $conceptos=[]; $resultado='No esta registrado';
                foreach ($output->data() as $concept) {
                    array_push($conceptos,['concepto'=>$concept->name(),'valor'=>$concept->value()]);
                }

                if($output->data()[0]->value() >0.7 and $output->data()[0]->value()<1){
                    $resultado=$output->data()[0]->name();
                }
                array_push($resultadoProceso,['resultado'=>$resultado,'path'=>$target_dir]);
                // echo json_encode(array("mensaje"=>"La imagen se proceso correctamente", "conceptos"=>$conceptos,"status"=>"OK","path"=>$target_dir,'resultado'=>$resultado));
            } else {
                echo json_encode(array("mensaje"=>"Lo siendo, error al procesar la imagen","status"=>"Error"));
            }
        }
        echo json_encode(array("mensaje"=>"La imagen se proceso correctamente","status"=>"OK",'resultados'=>$resultadoProceso));
    } else {
        echo "Response is not successful. Reason: \n";
        echo $response->status()->description() . "\n";
        echo $response->status()->errorDetails() . "\n";
        echo "Status code: " . $response->status()->statusCode();
    }

}else{
	echo json_encode(array("mensaje"=>"Lo siendo, error al subir imagen","status"=>"Error"));
}

