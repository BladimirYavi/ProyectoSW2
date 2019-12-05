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
//  new ClarifaiFileImage(file_get_contents($target_dir))

$client->addConcepts([new Concept('fff')])
    ->executeSync();

$client->addInputs([
    (new ClarifaiFileImage(file_get_contents('images/119242587_1570609166.jpg')))
    // (new ClarifaiURLImage('https://actualidadfitness.com/wp-content/uploads/2018/12/fff-en-ayunas-3-1.jpg'))
        ->withPositiveConcepts([new Concept('fff')]),
    (new ClarifaiURLImage('https://images-na.ssl-images-amazon.com/images/I/61951YPTr7L._SX466_.jpg'))
        ->withNegativeConcepts([new Concept('fff')])
])
    ->executeSync();

$client->modifyModel('persona')          ////modifyModel(idModel) ->modifica el modelo en el cual se le agrega el nuevo concepto  . SI se usa createModel no te lo va a agregar el nuevo concepto  al modelo para eso usas el modifyModel.
    ->withConcepts([new Concept('fff')])
    ->executeSync();

$response = $client->trainModel(ModelType::concept(), 'persona')
    ->executeSync();

if ($response->isSuccessful()) {
    echo "Response is successful.\n";
} else {
    echo "Response is not successful. Reason: \n";
    echo $response->status()->description() . "\n";
    echo $response->status()->errorDetails() . "\n";
    echo "Status code: " . $response->status()->statusCode();
}

