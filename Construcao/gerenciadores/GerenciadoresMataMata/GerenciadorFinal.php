<?php

/**
 * Description of GerenciadorFinal
 *
 * @author RAMONox
 */
class GerenciadorFinal {
    private $jogo;
    public function GerenciadorFinal() {
        $this->jogo = new ArrayObject();
    }
    public function geraConfronto($times, $jogo) {
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

            $this->jogo->offSetSet("jogo", $jogo[$i]["idJogo"]);
            $this->jogo->offsetSet("golT1", $jogo[$i]["golTime1"]);
            $this->jogo->offsetSet("golT2", $jogo[$i]["golTime2"]);
            $this->jogo->offSetSet("t1", $t1->getNome());
            $this->jogo->offSetSet("idT1", $t1->getId());
            $this->jogo->offSetSet("escudoT1", $t1->getEscudo());
            $this->jogo->offSetSet("t2", $t2->getNome());
            $this->jogo->offSetSet("idT2", $t2->getId());
            $this->jogo->offSetSet("escudoT2", $t2->getEscudo());
        }
    }
    public function getJogo(){
        return $this->jogo;
    }
}
?>
