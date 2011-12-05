<?php
    require_once("../BancoDeDados/Conexao.php");
    require_once("../BancoDeDados/JogoMataMataDao.php");
    require_once("../Construcao/gerenciadores/GeradorJogosMataMata.php");

    $jogoId = $_REQUEST['jogo'];
    $idFase = $_REQUEST['fase'];
    $golT1 = $_REQUEST['golTime1'];
    $golT2 = $_REQUEST['golTime2'];
    $time1 = $_REQUEST['time1'];
    $time2 = $_REQUEST['time2'];
    $campeonato = $_REQUEST['campeonato'];
    $tipo = $_REQUEST['tipo'];
    
    $geradorMM = new GeradorJogosMataMata();

    if($geradorMM->setPlacar($time1, $time2, $golT1, $golT2, $jogoId, $idFase, $campeonato, $tipo) > 0){
        echo "true";
    }else{
        echo "false";
    }

    
?>
