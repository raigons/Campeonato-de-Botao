<?php
    require_once("../BancoDeDados/Conexao.php");
    require_once("../Construcao/gerenciadores/GeradorJogosGrupo.php");
    require_once("../BancoDeDados/JogoGrupoDao.php");

    $jogoId = $_REQUEST['jogo'];
    $grupo = $_REQUEST['grupo'];
    $golsOldT1 = $_REQUEST['golOldT1'];
    $golsOldT2 = $_REQUEST['golOldT2'];
    $golsT1 = $_REQUEST['golTime1'];
    $golsT2 = $_REQUEST['golTime2'];
    $time1 = $_REQUEST['time1'];
    $time2 = $_REQUEST['time2'];

    $gerador = new GeradorJogosGrupo();
    if($gerador->setPlacarJogo($jogoId, $grupo, $golsT1, $golsT2) > 0){
        require_once("../Construcao/gerenciadores/GerenciadorClassificacao.php");
        require_once("../BancoDeDados/ClassificacaoDao.php");
        $gerenciador = new GerenciadorClassificacao();
        $gerenciador->atualizaClassificacao($grupo, $time1, $time2, $golsT1, $golsT2, $golsOldT1, $golsOldT2);
    }    
?>
