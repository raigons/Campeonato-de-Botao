<?php
/**
 * Description of GerenciadorQuartasDeFinal
 *
 * @author RAMONox
 */
class GerenciadorQuartasDeFinal {
    private $jogo1;
    private $jogo2;
    private $jogo3;
    private $jogo4;
    public function GerenciadorQuartasDeFinal() {
        $this->jogo1 = new ArrayObject();
        $this->jogo2 = new ArrayObject();
        $this->jogo3 = new ArrayObject();
        $this->jogo4 = new ArrayObject();
    }
    public function geraConfrontos($times, $jogo) {
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
                case 3:
                    $this->jogo3->offSetSet("jogo", $jogo[$i]["idJogo"]);
                    $this->jogo3->offsetSet("golT1", $jogo[$i]["golTime1"]);
                    $this->jogo3->offsetSet("golT2", $jogo[$i]["golTime2"]);
                    $this->jogo3->offSetSet("t1", $t1->getNome());
                    $this->jogo3->offSetSet("idT1", $t1->getId());
                    $this->jogo3->offSetSet("escudoT1", $t1->getEscudo());
                    $this->jogo3->offSetSet("t2", $t2->getNome());
                    $this->jogo3->offSetSet("idT2", $t2->getId());
                    $this->jogo3->offSetSet("escudoT2", $t2->getEscudo());
                break;
                case 4:
                    $this->jogo4->offSetSet("jogo", $jogo[$i]["idJogo"]);
                    $this->jogo4->offsetSet("golT1", $jogo[$i]["golTime1"]);
                    $this->jogo4->offsetSet("golT2", $jogo[$i]["golTime2"]);
                    $this->jogo4->offSetSet("t1", $t1->getNome());
                    $this->jogo4->offSetSet("idT1", $t1->getId());
                    $this->jogo4->offSetSet("escudoT1", $t1->getEscudo());
                    $this->jogo4->offSetSet("t2", $t2->getNome());
                    $this->jogo4->offSetSet("idT2", $t2->getId());
                    $this->jogo4->offSetSet("escudoT2", $t2->getEscudo());
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
    private function getJogo3(){
        return $this->jogo3;
    }
    private function getJogo4(){
        return $this->jogo4;
    }
    public function getJogo($i){
        switch($i){
            case 1: return $this->getJogo1(); break;
            case 2: return $this->getJogo2(); break;
            case 3: return $this->getJogo3(); break;
            case 4: return $this->getJogo4(); break;
        }
    }
}
?>
