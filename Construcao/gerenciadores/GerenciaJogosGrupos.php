<?php

/**
 * Gera os Jogos do Grupo especificado
 *
 * @author RAMONox
 */
class GerenciaJogosGrupos {
    private $grupo;
    private $primeiraRodada;
    private $segundaRodada;
    private $terceiraRodada;

    public function GerenciaJogosGrupos(){
    }
    public function setGrupo($grupo){
        $this->grupo = $grupo;        
    }
    public function getGrupo(){        
        return $this->grupo->getIdGrupo();
    }
    public function geraPrimeiraRodada(){        
        $this->primeiraRodada = new ArrayObject();
        $this->primeiraRodada->offsetSet("jogo1Time1", $this->grupo->getTime1());
        $this->primeiraRodada->offsetSet("jogo1Time2", $this->grupo->getTime2());
        $this->primeiraRodada->offsetSet("jogo2Time1", $this->grupo->getTime3());
        $this->primeiraRodada->offsetSet("jogo2Time2", $this->grupo->getTime4());
        $this->primeiraRodada->offsetSet("rodada", "1");
    }
    public function getPrimeiraRodada(){        
        return $this->primeiraRodada;
    }
    public function geraSegundaRodada(){
        $this->segundaRodada = new ArrayObject();
        $this->segundaRodada->offsetSet("jogo1Time1", $this->grupo->getTime1());
        $this->segundaRodada->offsetSet("jogo1Time2", $this->grupo->getTime3());
        $this->segundaRodada->offsetSet("jogo2Time1", $this->grupo->getTime2());
        $this->segundaRodada->offsetSet("jogo2Time2", $this->grupo->getTime4());
        $this->segundaRodada->offsetSet("rodada", "2");
    }
    public function getSegundaRodada(){
        return $this->segundaRodada;
    }
    public function geraTerceiraRodada(){
        $this->terceiraRodada = new ArrayObject();
        $this->terceiraRodada->offsetSet("jogo1Time1", $this->grupo->getTime4());
        $this->terceiraRodada->offsetSet("jogo1Time2", $this->grupo->getTime1());
        $this->terceiraRodada->offsetSet("jogo2Time1", $this->grupo->getTime3());
        $this->terceiraRodada->offsetSet("jogo2Time2", $this->grupo->getTime2());
        $this->terceiraRodada->offsetSet("rodada", "3");
    }
    public function getTerceiraRodada(){
        return $this->terceiraRodada;
    }

    public function getJogosGrupos(){
        $jogoBanco = new JogoGrupoDao();
        return $jogoBanco->getJogosGrupo($this->grupo->getIdGrupo());
    }
}
?>
