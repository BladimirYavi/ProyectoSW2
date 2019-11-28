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

//// Omita el argumento para obtener la clave del entorno CLARIFAI_API_KEY. variable 
// Skip the argument to fetch the key from the CLARIFAI_API_KEY env. variable
$client = new ClarifaiClient('f1095b8a786a45ee9096f369ffa2b658');

//HACER PREDICCION//

// $model = $client->publicModels()->generalModel();

// $input = new ClarifaiURLImage("https://www.purina.es/gato/purina-one/sites/g/files/mcldtz1856/files/2018-06/Mi_gato_no_come%20%282%29.jpg");
// $response = $model->predict($input)
//     ->withModelVersionID("aa7f35c01e0642fda5cf400f543e7c40")
//     ->executeSync();


//mansana verde : https://dqzrr9k4bjpzk.cloudfront.net/images/7045371/832667742.jpg
$response = $client->predict(ModelType::concept(), 'persona',
new ClarifaiFileImage(file_get_contents('images/adan02.jpg')))
    ->executeSync();

    // $response = $client->publicModels()->generalModel()->predict(
    //     new ClarifaiFileImage(file_get_contents('/home/user/image.jpeg')))
    // ->executeSync();

if ($response->isSuccessful()) {
    /** @var ClarifaiOutput $output */
    $output = $response->get();

    echo "Predicted concepts:\n";$resultado='No esta registrado';
    /** @var Concept $concept */
    foreach ($output->data() as $concept) {
        echo $concept->name() . ': ' . $concept->value() . "\n";
    }

    if($output->data()[0]->value() >0.5 and $output->data()[0]->value()<1){
        $resultado=$output->data()[0]->name();
    }

    echo $resultado;

} else {
    echo "Response is not successful. Reason: \n";
    echo $response->status()->description() . "\n";
    echo $response->status()->errorDetails() . "\n";
    echo "Status code: " . $response->status()->statusCode();
}

//CREAR MODELO//

// $client->addConcepts([new Concept('banana')])
//     ->executeSync();

// $client->addInputs([
//     (new ClarifaiURLImage('https://ep00.epimg.net/elpais/imagenes/2014/05/04/contrapuntos/1399183757_139918_1399183757_noticia_normal.jpg'))
//         ->withPositiveConcepts([new Concept('banana')]),
//     (new ClarifaiURLImage('https://www.sqm.com/wp-content/uploads/2018/04/tomate-992x550.jpg'))
//         ->withNegativeConcepts([new Concept('banana')])
// ])
//     ->executeSync();

// $client->createModel('fruta')
//     ->withConcepts([new Concept('banana')])
//     ->executeSync();

// $response = $client->trainModel(ModelType::concept(), 'fruta')
//     ->executeSync();

// if ($response->isSuccessful()) {
//     echo "Response is successful.\n";
// } else {
//     echo "Response is not successful. Reason: \n";
//     echo $response->status()->description() . "\n";
//     echo $response->status()->errorDetails() . "\n";
//     echo "Status code: " . $response->status()->statusCode();
// }

