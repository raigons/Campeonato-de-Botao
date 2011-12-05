<?php
/**
 * Description of GeradorJogosGrupo
 *
 * @author RAMONox
 */

class GeradorJogosGrupo {
    private $jogoBanco;
    private $matrizRodada;
    private $grupoId;
    public function GeradorJogosGrupo(){
        $this->jogoBanco = new JogoGrupoDao();
    }

    public function armazenaRodadas($r1, $r2, $r3, $grupo){
        $this->grupoId = $grupo;
        $this->matrizRodada = new ArrayObject();
        $this->matrizRodada->append($r1);
        $this->matrizRodada->append($r2);
        $this->matrizRodada->append($r3);
        $this->salvaRodadas();
    }

    private function salvaRodadas(){        
        foreach($this->matrizRodada as $rodada){
            $g = 1; 
            foreach($rodada as $i => $j){
                if($g == 2){
                    $jogo = new JogoGrupo($this->grupoId);
                    $jogo->setTime1($rodada["jogo1Time1"]);
                    $jogo->setTime2($rodada["jogo1Time2"]);
                    $jogo->setRodada($rodada["rodada"]);
                    $this->jogoBanco->setNovoJogoGrupo($jogo);
                   // echo "<br/>".$rodada["jogo1Time1"]. " x ".$rodada["jogo1Time2"]."<br />";
                }
                elseif($g == 4){
                    $jogo = new JogoGrupo($this->grupoId);
                    $jogo->setTime1($rodada["jogo2Time1"]);
                    $jogo->setTime2($rodada["jogo2Time2"]);
                    $jogo->setRodada($rodada["rodada"]);                    
                    $this->jogoBanco->setNovoJogoGrupo($jogo);
                   // echo "<br />".$rodada["jogo2Time1"] . " x ".$rodada["jogo2Time2"];
                }
               $g++;
            }
        }
    }
    public function getJogos($grupo){
        return $this->jogoBanco->getJogosGrupo($grupo);
    }
    public function setPlacarJogo($jogo, $grupo, $golTime1, $golTime2){
        return $this->jogoBanco->setPlacarJogo($jogo, $grupo, $golTime1, $golTime2);
    }
}
?>
