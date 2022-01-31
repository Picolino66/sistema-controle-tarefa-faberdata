<?php
namespace App\Controller;
use App\Entity\Tarefa;
use App\Model\TarefaModel;

class TarefaController{

  private $tarefaModel;

  public function __construct(){
    $this->tarefaModel = new TarefaModel();
  }
  //POST - Cria uma novo tarefa
  function create($data = null){
    $tarefa = $this->convertType($data);
    $result = $this->validate($tarefa);

    if($result != ""){
      return json_encode(["result" => $result]);
    }

    return json_encode(["result" =>$this->tarefaModel->create($tarefa)]);
  }

  //PUT - Altera uma tarefa
  function update($id = 0, $data = null){
    $tarefa = $this->convertType($data);
    $tarefa->setId($id);

    $result = $this->validate($tarefa, true);

    if($result != ""){
      return json_encode(["result" => $result]);
    }

    return  json_encode(["result" => $this->tarefaModel->update($tarefa)]);
  }

  //DELETE - Remove uma tarefa
  function delete($id = 0){
    $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);

    if($id <= 0)
      return json_encode(["result" => "invalid id"]);

    $result =  $this->tarefaModel->delete($id);

    return  json_encode(["result" => $result]);
  }

  //GET - Retorna uma tarefa pelo ID
  function getById($id = 0){
    $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);

    if($id <= 0)
      return json_encode(["result" => "invalid id"]);

      return $this->tarefaModel->getById($id);
  }

  //GET - Retorna todos as tarefas
  function getAll(){
    return $this->tarefaModel->getAll();
  }

  private function convertType($data){
    return new Tarefa(
      null,
      (isset($data['titulo']) ? filter_var($data['titulo'], FILTER_SANITIZE_STRING) : null),
      (isset($data['descricao']) ? filter_var($data['descricao'], FILTER_SANITIZE_STRING) : null),
      (isset($data['concluido']) ? filter_var($data['concluido'], FILTER_SANITIZE_NUMBER_INT) : null)
    );
  }

  private function validate(Tarefa $tarefa, $update = false){
    if($update && $tarefa->getId() <=0)
    return "invalid id";

    if(strlen($tarefa->getTitulo()) < 4 || strlen($tarefa->getTitulo()) > 100)
    return "invalid titulo";

    if(strlen($tarefa->getDescricao()) < 10 || strlen($tarefa->getDescricao()) > 250)
    return  "invalid descricao";

    return "";
  }
}