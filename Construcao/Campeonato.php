<?php
/**
 * Classe que gera um novo Campeonato, quando se desejar criar um novo
 *
 * @author RAMONox
 */
class Campeonato {
    private $edicao;
    private $idCampeonato;

    public function Campeonato(){}

    public function setCampeonato($ed){
        $this->edicao = $ed;
    }
    public function getCampeonato(){
        return $this->edicao;
    }
    public function setIdCampeonato($idCamp){
        $this->idCampeonato = $idCamp;
    }
    public function getIdCampeonato(){
        return $this->idCampeonato;
    }
    
}
?>
