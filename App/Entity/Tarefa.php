<?php

namespace App\Entity;

class Tarefa{
    private $id;
    private $titulo;
    private $descricao;

    public function __construct ($id = '', $titulo = '', $descricao = ''){
        $this->id = $id;
        $this->titulo = $titulo;
        $this->descricao = $descricao;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function setTitulo($titulo){
        $this->titulo = $titulo;
    }

    public function setDescricao($descricao){
        $this->descricao = $descricao;
    }

    public function getId(){
        return $this->id;
    }

    public function getTitulo(){
        return $this->titulo;
    }

    public function getDescricao(){
        return $this->descricao;
    }
}