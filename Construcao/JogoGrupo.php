<?php
/**
 * Cria um jogo da fase de grupos
 *
 * @author RAMONox
 */
 require_once("Jogo.php");
class JogoGrupo extends Jogo{
    private $rodada;
    
    public function JogoGrupo($fase){
        parent::Jogo($fase);
    }
    public function setRodada($rodada){
        $this->rodada = $rodada;
    }
    public function getRodada(){
        return $this->rodada;
    }
}
?>
