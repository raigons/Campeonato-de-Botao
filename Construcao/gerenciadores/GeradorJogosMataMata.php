<?php
/**
 * Classe que é responsável por criar os jogos no mata-mata de acordo com os 
 * grupos que se enfrentarão. Apenas inicializa os jogos no banco, sem definir
 * os confrontos
 */
class GeradorJogosMataMata {
    private $jogoBanco;

    public function GeradorJogosMataMata(){
        $this->jogoBanco = new JogoMataMataDao();
    }
    public function inicializaMataMata($camp, $grupos){
        //print_r($grupos);
        $i = 0;
        $idJogosQuartas = new ArrayObject();
        $idJogosSemi = new ArrayObject();
        foreach($this->getFases() as $fases){
            if($i == 0){
                $this->inicializaQuartasDeFinal($fases['id'], $camp, $grupos, $idJogosQuartas);
            }elseif($i == 1){
                $this->inicializaSemiFinal($fases['id'], $camp, $idJogosQuartas, $idJogosSemi);
            }elseif($i == 2){
                $this->inicializaFinal($fases['id'], $camp, $idJogosSemi);
            }
            $i++;
        }
    }
    public function setPlacar($time1, $time2, $golT1, $golT2, $idJogo, $fase, $campeonato, $tipo){
        return $this->jogoBanco->setPlacarJogoMataMata($time1, $time2, $golT1, $golT2, $idJogo, $fase, $campeonato, $tipo);
    }
    private function getFases(){
        return $this->jogoBanco->getFases();
    }
    private function inicializaQuartasDeFinal($fase, $camp, $grupos, $idJogosQuartas){
        $a = 0;
        $sqlMore = "VALUES " . $this->jogoBanco->getSqlMore();
        foreach($grupos as $grupo){            
            switch($a){
                case 0:                    
                    $idJogosQuartas->append($this->jogoBanco->iniciaMataMata($sqlMore, $fase, $camp, $grupo->getIdGrupo(), $grupos[1]->getIdGrupo()));                    
                break;
                case 1:                    
                    $idJogosQuartas->append($this->jogoBanco->iniciaMataMata($sqlMore, $fase, $camp, $grupo->getIdGrupo(), $grupos[0]->getIdGrupo()));                break;
                case 2:                     
                    $idJogosQuartas->append($this->jogoBanco->iniciaMataMata($sqlMore, $fase, $camp, $grupo->getIdGrupo(), $grupos[3]->getIdGrupo()));
                break;
                case 3:                    
                    $idJogosQuartas->append($this->jogoBanco->iniciaMataMata($sqlMore, $fase, $camp, $grupo->getIdGrupo(), $grupos[2]->getIdGrupo()));
                break;
            }
            $a++;
        }                
    }
    private function inicializaSemiFinal($fase, $camp, $idJogosQuartas, $idJogosSemi){
        $sqlMore = "VALUES " . $this->jogoBanco->getSqlMore();
        $a = 0;
        foreach($idJogosQuartas as $jogosQuartas){
            switch($a){
                case 0:
                    $idJogosSemi->append($this->jogoBanco->iniciaMataMata($sqlMore, $fase, $camp, $jogosQuartas, $idJogosQuartas->offSetGet(1)));
                break;
                case 2:
                    $idJogosSemi->append($this->jogoBanco->iniciaMataMata($sqlMore, $fase, $camp, $jogosQuartas, $idJogosQuartas->offSetGet(3)));
                break;
            }
            $a++;
        }
    }
    private function inicializaFinal($fase, $camp, $idJogosSemi){
        $sqlMore = "VALUES " . $this->jogoBanco->getSqlMore();
        $this->jogoBanco->iniciaMataMata($sqlMore, $fase, $camp, $idJogosSemi->offSetGet(0), $idJogosSemi->offSetGet(1));
    }
}
?>
