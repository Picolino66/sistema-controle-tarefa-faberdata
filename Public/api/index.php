<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require_once("../../vendor/autoload.php");
use App\Controller\TarefaController;

$controller = null;
$param = null;
$data = null;
$method = $_SERVER["REQUEST_METHOD"];
$uri = $_SERVER["REQUEST_URI"];

$data = file_get_contents("php://input");
$request = json_decode($data);
//parse_str(file_get_contents('php://input'), $data);

/*Tratamento de URL*/
$unsetCount = 3;
$ex = explode("/", $uri);
for($i = 0; $i < $unsetCount; $i++){
  unset($ex[$i]);
}

$ex = array_filter(array_values($ex));
if(isset($ex[0])){
  $controller = $ex[0];
}

if(isset($ex[1])){
  $param = $ex[1];
}

/*Rotas*/
if ($controller == 'Tarefa'){
    $tarefaController = new TarefaController();
}
switch($method) {
  case 'GET':
  if($controller != null && $param == null){
    echo $tarefaController->getAll();
  }elseif($controller != null && $param != null){
    echo $tarefaController->getById($param);
  }else{
    echo json_encode(["result" => "invalparam"]);
  }
  break;

  case 'POST':
  if($controller != null && $param == null){
    echo $tarefaController->create($request);
  }else{
    echo json_encode(["result" => "invalparam"]);
  }
  break;

  case 'PUT':
  if($controller != null && $param != null){
    echo $tarefaController->update($param, $request);
  }else{
    echo json_encode(["result" => "invalparam"]);
  }
  break;

  case 'DELETE':
    if($controller != null && $param != null){
      echo $tarefaController->delete($param);
    }else{
      echo json_encode(["result" => "invalparam"]);
    }
  break;

  default:
    echo json_encode(["result" => "invalparam resquest"]);
  break;
}
