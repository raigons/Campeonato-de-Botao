<?php
/**
 * Description of GerenciadorClassificacao
 *
 * @author RAMONox
 */
class GerenciadorClassificacao {
    private $classificacaoBanco;
    private $grupo;
    public function GerenciadorClassificacao(){
        $this->classificacaoBanco = new ClassificacaoDao();
    }

    public function inicializaClassificacao($grupo){
        $this->grupo = $grupo;
        $this->salvaClassificacaoTimes();
    }

    private function salvaClassificacaoTimes(){
        $this->classificacaoBanco->inicializaClassificao($this->grupo);        
    }
    public function getClassificacao($grupo){
        return $this->classificacaoBanco->getClassificacaoGrupo($grupo);
    }
    public function atualizaClassificacao($grupo, $time, $time2, $golsT1, $golsT2, $golsOldT1 = '', $golsOldT2 = ''){
        if($golsOldT1 != '' && $golsOldT2 != ''){
            $this->classificacaoBanco->atualizaClassificacao($grupo, $time, $time2, $golsT1, $golsT2, $golsOldT1, $golsOldT2);
        }else{
            $this->classificacaoBanco->atualizaClassificacao($grupo, $time, $time2, $golsT1, $golsT2);
        }
    }    
}
?>
