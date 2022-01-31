<?php
namespace App\Model;
use App\Entity\Tarefa;
use App\Util\Serialize;

class TarefaModel{
  private $fileName;
  private $listTarefa = []; //Object type Tarefa

  public function __construct(){
    $this->fileName = "../database/tarefa.db";
    $this->load();
  }

  public function getAll(){
    return (new Serialize())->serialize($this->listTarefa);
  }

  public function getById($id){

    foreach($this->listTarefa as $g){
      if($g->getId() == $id)
      return (new Serialize())->serialize($g);
    }

    return json_encode([]);
  }

  public function create(Tarefa $tarefa){
    $tarefa->setId($this->getLastId());
    $tarefa->setConcluido(0);
    $this->listTarefa[] = $tarefa;
    $this->save();

    return "ok";
  }

  public function update(Tarefa $tarefa){
    $result = "not found";

    for($i = 0; $i < count($this->listTarefa); $i++){
      if($this->listTarefa[$i]->getId() == $tarefa->getId()){
        $this->listTarefa[$i] = $tarefa;
        $result = "ok";
      }
    }

    $this->save();

    return $result;
  }

  public function delete($id){
    $result = "not found";
    for($i = 0; $i < count($this->listTarefa); $i++){
      if($this->listTarefa[$i]->getId() == $id){
        unset($this->listTarefa[$i]);
        $result = "ok";
      }
    }

    $this->listTarefa = array_filter(array_values($this->listTarefa));
    
    $this->save();
    return $result;
  }
  //Internal Method
  private function save(){
    $temp = [];

    foreach($this->listTarefa as $g){
      $temp[]       = [
        "id"        => $g->getId(),
        "titulo"    => $g->getTitulo(),
        "descricao" => $g->getDescricao(),
        "concluido"   => $g->getConcluido()
      ];

      $fp = fopen($this->fileName, "w");
      fwrite($fp, json_encode($temp));
      fclose($fp);
    }
  }

  private function getLastId(){
    $lastId = 0;

    foreach($this->listTarefa as $g){
      if($g->getId() > $lastId)
      $lastId = $g->getId();
    }

    return ($lastId + 1);
  }

  private function load(){
    if(!file_exists($this->fileName) || filesize($this->fileName) <= 0)
    return [];

    $fp = fopen($this->fileName, "r");
    $str = fread($fp, filesize($this->fileName));
    fclose($fp);

    $arrayTarefa = json_decode($str);

    foreach($arrayTarefa as $g){
      $this->listTarefa[] = new Tarefa(
        $g->id,
        $g->titulo,
        $g->descricao,
        $g->concluido
      );
    }
  }
}