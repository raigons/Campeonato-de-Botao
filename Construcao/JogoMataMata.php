<?php
/**
 * Cria jogo das fases finais
 *
 * @author RAMONox
 */
class JogoMataMata extends Jogo{
    private $idaVolta;    
    
    public function JogoMataMata($fase){
        parent::Jogo($fase);
    }
    public function setPartidaIdaVolta($iV){
        $this->idaVolta = $iV;
    }
    public function getPartidaIdaVolta(){
        return $this->idaVolta;
    }
}
?>
