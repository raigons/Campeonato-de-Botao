<?php
    require_once("../BancoDeDados/Conexao.php");
    require_once("../Construcao/gerenciadores/GeradorJogosGrupo.php");
    require_once("../BancoDeDados/JogoGrupoDao.php");

    $jogoId = $_REQUEST['jogo'];
    $grupoId = $_REQUEST['grupo'];
    $golT1 = $_REQUEST['golTime1'];
    $golT2 = $_REQUEST['golTime2'];
    $time1 = $_REQUEST['time1'];
    $time2 = $_REQUEST['time2'];

    $gerador = new GeradorJogosGrupo();
    if($gerador->setPlacarJogo($jogoId, $grupoId, $golT1, $golT2) <= 0){        
        echo "Falha ao armazenar o placar! Verifique se digitou os dados corretamente";
    }else{
        require_once("../Construcao/gerenciadores/GerenciadorClassificacao.php");
        require_once("../BancoDeDados/ClassificacaoDao.php");
        $gerenciador = new GerenciadorClassificacao();
        $gerenciador->atualizaClassificacao($grupoId, $time1, $time2, $golT1, $golT2);
    }
    
?>
