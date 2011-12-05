<?php
    require("BancoDeDados/Conexao.php");
    require_once("Construcao/gerenciadores/GerenciaJogosGrupos.php");
    require_once("Construcao/Grupo.php");
    $grupo = new Grupo("Grupo A");
    $grupo->setIdGrupo("1");
    $grupo->setTime1("1");
    $grupo->setTime2("5");
    $grupo->setTime3("3");
    $grupo->setTime4("11");
    $grupo->setIdCampeonato("1");
    
    $gerencia = new GerenciaJogosGrupos();
    $gerencia->setGrupo($grupo);
    $gerencia->geraPrimeiraRodada();
    $gerencia->geraSegundaRodada();
    $gerencia->geraTerceiraRodada();

    
    $r1 = $gerencia->getPrimeiraRodada();    
    $r2 = $gerencia->getSegundaRodada();
    $r3 = $gerencia->getTerceiraRodada();
    $grupoId = $gerencia->getGrupo();  

    require_once("Construcao/JogoGrupo.php");
    require_once("BancoDeDados/JogoGrupoDao.php");
    require_once("Construcao/gerenciadores/GeradorJogosGrupo.php");

    $geraJogosGrupo = new GeradorJogosGrupo();
    $geraJogosGrupo->armazenaRodadas($r1, $r2, $r3, $grupoId);
    echo "<br />";
    
    foreach($gerencia->getJogosGrupos() as $jogos){
        echo "<br />";
        echo $jogos['t1']. " $jogos[golTime1] x $jogos[golTime2] ".$jogos['t2']."<br />";
    }
?>
