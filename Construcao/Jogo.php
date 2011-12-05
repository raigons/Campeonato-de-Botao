<?php
/**
 * Classe que gera um novo jogo de um determinado grupo
 *
 * @author RAMONox
 */
abstract class Jogo {
    private $time1;
    private $time2;    
    private $fase;  
    
    public function Jogo($fase){
        $this->fase = $fase;
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
    public function setFase($fase){
        $this->fase = $fase;
    }
    public function getFase(){
        return $this->fase;
    }
}
?>
