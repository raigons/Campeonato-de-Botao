<?php
/**
 * Description of Time
 *
 * @author RAMONox
 */
class Time {
    private $id;
    private $nome;
    private $escudo;
    
    public function Time(){}

    public function setId($id){
        $this->id = $id;
    }
    public function getId(){
        return $this->id;
    }
    public function setNome($nome){
        $this->nome = $nome;
    }
    public function getNome(){
        return $this->nome;
    }
    public function setEscudo($escudo){
        $this->escudo = $escudo;
    }
    public function getEscudo(){
        return $this->escudo;
    }
}
?>
