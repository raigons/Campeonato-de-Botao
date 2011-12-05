<?php
/**
 * Gerencia a atualização e classificação para as quartas, semi e final
 *
 * @author RAMONox
 */
class GerenciaJogosMataMata {
    private $jogoDao;
    public function GerenciaJogosMataMata(){
        $this->jogoDao = new JogoMataMataDao();
    }
    public function setClassificadosPrimeiraFase($classificados, $fase){
        $a = 1;
        foreach($classificados as $time){
            $this->jogoDao->setTimeJogoMataMata($a, $time['idTime'], $time['idGrupo'], $fase, $time['idCampeonato']);
            $a++;
        }
    }
    public function getConfrontosMataMata($campeonato, $fase){
        $confrontos = new ArrayObject($this->jogoDao->getJogo($fase, $campeonato));
        $confrontosSeted = new ArrayObject();
        $confrontosTime = new ArrayObject();
        require_once("../BancoDeDados/TimeDao.php");
        $time = new TimeDao();
        $i = 1;
        foreach($confrontos as $c){            
            $confrontosSeted->offsetSet($i, $c);            
            $confrontosTime->offsetSet($i++, array("time1" => $time->getTime($c['idT1']), "time2" => $time->getTime($c['idT2'])));
        }
        return array($confrontosSeted, $confrontosTime);
    }
    public function geraTabelaJogos($fase, $nJogos, &$p, $idFase, $campeonato, $status){
            $g = 1;
            $j = 1;
            while($j <= $nJogos){
                if($g == 3){
                    $g = 1;
                }
                if($fase->getJogo($j)->offSetGet('t1') != ''){
                    $time1 = $fase->getJogo($j)->offSetGet('t1');
                    $escudoT1 = "<img src=\"".$fase->getJogo($j)->offSetGet('escudoT1')."\"/>";
                    $golT1 = $fase->getJogo($j)->offSetGet('golT1');
                }else{
                    $time1 = $this->vencedorT1($fase, $j);
                    $escudoT1 = "";
                    $golT1 = "";
                }
                if($fase->getJogo($j)->offSetGet('t2') != ''){
                    $time2 = $fase->getJogo($j)->offSetGet('t2');
                    $escudoT2 = "<img src=\"".$fase->getJogo($j)->offSetGet('escudoT2')."\"/>";
                    $golT2 = $fase->getJogo($j)->offSetGet('golT2');
                }else{
                    $time2 = $this->vencedorT2($fase, $j);
                    $escudoT2 = "";
                    $golT2 = "";
                }?>
                <tr style="font-size: 11px;">
                     <td style="font-size: 11px; width: 20%;">Jogo <?echo $p++;?></td>
                    <td style="text-align:right; font-weight: bold"><?echo $time1;?> &nbsp;<?echo $escudoT1;?>&nbsp;</td>
                    <td class="placar golTime1" status="<?echo $status;?>" tipo="<?echo $g++;?>" alt="<?echo $campeonato."|".$idFase."|".$fase->getJogo($j)->offSetGet('jogo')."|".$fase->getJogo($j)->offSetGet('idT1')."|".$fase->getJogo($j)->offSetGet('idT2');?>">
                    <?echo $golT1;?></td>
                    <td class="versus"> x </td>
                    <td class="placar golTime2" alt="<?echo $campeonato."|".$idFase."|".$fase->getJogo($j)->offSetGet('jogo')."|".$fase->getJogo($j)->offSetGet('idT1')."|".$fase->getJogo($j)->offSetGet('idT2');?>">
                    <?echo $golT2;?></td>
                    <td style="text-align:left; font-weight: bold">&nbsp;<?echo $escudoT2;?>&nbsp;<?echo $time2;?></td>
                </tr>
        <?
                $j++;
            }        
    }
    private function vencedorT1($fase, $j){
        if($fase instanceof GerenciadorQuartasDeFinal){
            return $this->jogoNaoDefinidoT1($j);
        }elseif($fase instanceof GerenciadorSemiFinal){
            return $this->vencedorQuartasT1($j);
        }elseif($fase instanceof GerenciadorFinal){
            return "Vencedor do jogo 29";
        }
    }
    private function vencedorT2($fase, $j){
        if($fase instanceof GerenciadorQuartasDeFinal){
            return $this->jogoNaoDefinidoT2($j);
        }elseif($fase instanceof GerenciadorSemiFinal){
            return $this->vencedorQuartasT2($j);
        }elseif($fase instanceof GerenciadorFinal){
            return "Vencedor do jogo 30";
        }
    }
    private function jogoNaoDefinidoT1($j){
        switch($j){
            case 1: $t1 = "1º grupo A"; break;
            case 2: $t1 = "1º grupo B"; break;
            case 3: $t1 = "1º grupo C"; break;
            case 4: $t1 = "1º grupo D"; break;
        }
       return $t1;
    }
    private function jogoNaoDefinidoT2($j){
        switch($j){
            case 1: $t2 = "2º grupo B"; break;
            case 2: $t2 = "2º grupo A"; break;
            case 3: $t2 = "2º grupo D"; break;
            case 4: $t2 = "2º grupo C"; break;
        }
        return $t2;
    }
    private function vencedorQuartasT1($j){
        switch($j){
            case 1: $t1 = "Vencedor do jogo 25"; break;
            case 2: $t1 = "Vencedor do jogo 27"; break;
        }
        return $t1;
    }
    private function vencedorQuartasT2($j){
        switch($j){
            case 1: $t2 = "Vencedor do jogo 26"; break;
            case 2: $t2 = "Vencedor do jogo 28"; break;
        }
        return $t2;
    }
}
?>
