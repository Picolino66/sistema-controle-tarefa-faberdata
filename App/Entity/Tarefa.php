<?php
namespace App\Entity;

class Tarefa{

	private $id;
	private $titulo;
	private $descricao;
	private $concluido;

	//Constructor

    // $tarefa = new Tarefa();
	public function __construct($id = 0, $titulo = '', $descricao = '', $concluido = ''){
		$this->id = $id;
		$this->titulo = $titulo;
		$this->descricao = $descricao;
		$this->concluido = $concluido;
	}

	//Setters
	public function setId($id){
		$this->id = $id;
	}

	public function setTitulo($titulo){
		$this->titulo = $titulo;
	}

	public function setDescricao($descricao){
		$this->descricao = $descricao;
	}

	public function setConcluido($concluido){
		$this->concluido = $concluido;
	}

	//Getter
	public function getId(){
		return $this->id;
	}

	public function getTitulo(){
		return $this->titulo;
	}

	public function getDescricao(){
		return $this->descricao;
	}

	public function getConcluido(){
		return $this->concluido;
	}
}