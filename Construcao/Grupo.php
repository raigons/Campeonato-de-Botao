<?php
/**
 * Classe que gera um novo grupo para o campeonato
 *
 * @author RAMONox
 */
class Grupo {
    private $nomeGrupo;
    private $time1;
    private $time2;
    private $time3;
    private $time4;
    private $idCampeonato;
    private $idGrupo;
    
    public function Grupo($nomeGrupo){
        $this->nomeGrupo = $nomeGrupo;
    }
    public function getNomeGrupo(){
        return $this->nomeGrupo;
    }
    public function setIdGrupo($id){        
        $this->idGrupo = $id;
    }
    public function getIdGrupo(){
        return $this->idGrupo;
    }
    public function setTime1($time1){
        $this->time1 = $time1;
    }
    public function getTime1(){
        return $this->time1;
    }
    public function setTime2($time2){
        $this->time2 = $time2;
    }
    public function getTime2(){
        return $this->time2;
    }
    public function setTime3($time3){
        $this->time3 = $time3;
    }
    public function getTime3(){
        return $this->time3;
    }
    public function setTime4($time4){
        $this->time4 = $time4;
    }
    public function getTime4(){
        return $this->time4;
    }
    public function setIdCampeonato($idCampeonato){
        $this->idCampeonato = $idCampeonato;
    }
    public function getIdCampeonato(){
        return $this->idCampeonato;
    }
}
?>
