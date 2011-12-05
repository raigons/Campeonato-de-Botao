<?php
/**
 * Description of GerenciadorSemiFinal
 *
 * @author RAMONox
 */
class GerenciadorSemiFinal {
    private $jogo1;
    private $jogo2;

    public function GerenciadorSemiFinal(){
        $this->jogo1 = new ArrayObject();
        $this->jogo2 = new ArrayObject();
    }
    
    public function geraConfrontos($times, $jogo){
        $i = 1;
        foreach($times as $t) {
            $t1 = new Time();
            $t1->setId($t['time1']['id']);
            $t1->setNome(utf8_encode($t['time1']['nome']));
            $t1->setEscudo($t['time1']['escudo']);
            $t2 = new Time();
            $t2->setId($t['time2']['id']);
            $t2->setNome(utf8_encode($t['time2']['nome']));
            $t2->setEscudo($t['time2']['escudo']);
            switch($i){
                case 1:
                    $this->jogo1->offSetSet("jogo", $jogo[$i]["idJogo"]);
                    $this->jogo1->offsetSet("golT1", $jogo[$i]["golTime1"]);
                    $this->jogo1->offsetSet("golT2", $jogo[$i]["golTime2"]);
                    $this->jogo1->offSetSet("t1", $t1->getNome());
                    $this->jogo1->offSetSet("idT1", $t1->getId());
                    $this->jogo1->offSetSet("escudoT1", $t1->getEscudo());
                    $this->jogo1->offSetSet("t2", $t2->getNome());
                    $this->jogo1->offSetSet("idT2", $t2->getId());
                    $this->jogo1->offSetSet("escudoT2", $t2->getEscudo());
                break;
                case 2:
                    $this->jogo2->offSetSet("jogo", $jogo[$i]["idJogo"]);
                    $this->jogo2->offsetSet("golT1", $jogo[$i]["golTime1"]);
                    $this->jogo2->offsetSet("golT2", $jogo[$i]["golTime2"]);
                    $this->jogo2->offSetSet("t1", $t1->getNome());
                    $this->jogo2->offSetSet("idT1", $t1->getId());
                    $this->jogo2->offSetSet("escudoT1", $t1->getEscudo());
                    $this->jogo2->offSetSet("t2", $t2->getNome());
                    $this->jogo2->offSetSet("idT2", $t2->getId());
                    $this->jogo2->offSetSet("escudoT2", $t2->getEscudo());
                break;
            }
            $i++;
        }
    }
    private function getJogo1(){
        return $this->jogo1;
    }
    private function getJogo2(){
        return $this->jogo2;
    }
    public function getJogo($i){
        switch($i){
            case 1: return $this->getJogo1(); break;
            case 2: return $this->getJogo2(); break;
        }
    }
}
?>
