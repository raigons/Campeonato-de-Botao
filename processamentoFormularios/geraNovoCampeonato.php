<?php
    require_once("../BancoDeDados/Conexao.php");
    require_once("../Construcao/Campeonato.php");
    require_once("../BancoDeDados/CampeonatoDao.php");
    require_once("../Construcao/gerenciadores/GerenciaJogosGrupos.php");
    require_once("../Construcao/Grupo.php");
    require_once("../Construcao/JogoGrupo.php");
    require_once("../BancoDeDados/JogoGrupoDao.php");
    require_once("../Construcao/gerenciadores/GeradorJogosGrupo.php");
    require_once("../BancoDeDados/GrupoDao.php");
    require_once("../Construcao/gerenciadores/GerenciadorClassificacao.php");
    require_once("../BancoDeDados/ClassificacaoDao.php");

    $campeonatoNome = $_REQUEST['nomeCampeonato'];
    $campeonato = new Campeonato();
    $campeonato->setCampeonato($campeonatoNome);
    $campeonatoBanco = new CampeonatoDao();
    $campeonatoBanco->setNovoCampeonato($campeonato);
    
    $grupo1 = new Grupo("A");
    $grupo1->setIdCampeonato($campeonato->getIdCampeonato());
    $grupo1->setTime1($_REQUEST['grupo1Time1']);
    $grupo1->setTime2($_REQUEST['grupo1Time2']);
    $grupo1->setTime3($_REQUEST['grupo1Time3']);
    $grupo1->setTime4($_REQUEST['grupo1Time4']);

    $grupo2 = new Grupo("B");
    $grupo2->setIdCampeonato($campeonato->getIdCampeonato());
    $grupo2->setTime1($_REQUEST['grupo2Time1']);
    $grupo2->setTime2($_REQUEST['grupo2Time2']);
    $grupo2->setTime3($_REQUEST['grupo2Time3']);
    $grupo2->setTime4($_REQUEST['grupo2Time4']);

    $grupo3 = new Grupo("C");
    $grupo3->setIdCampeonato($campeonato->getIdCampeonato());
    $grupo3->setTime1($_REQUEST['grupo3Time1']);
    $grupo3->setTime2($_REQUEST['grupo3Time2']);
    $grupo3->setTime3($_REQUEST['grupo3Time3']);
    $grupo3->setTime4($_REQUEST['grupo3Time4']);

    $grupo4 = new Grupo("D");
    $grupo4->setIdCampeonato($campeonato->getIdCampeonato());
    $grupo4->setTime1($_REQUEST['grupo4Time1']);
    $grupo4->setTime2($_REQUEST['grupo4Time2']);
    $grupo4->setTime3($_REQUEST['grupo4Time3']);
    $grupo4->setTime4($_REQUEST['grupo4Time4']);

    $listaGrupos = new ArrayObject();
    $listaGrupos->append($grupo1);
    $listaGrupos->append($grupo2);
    $listaGrupos->append($grupo3);
    $listaGrupos->append($grupo4);

    $salvaGrupos = new GrupoDao();
    $gerenciaJogosGrupos = new GerenciaJogosGrupos();
    $gerador = new GeradorJogosGrupo();
    $classificacao = new GerenciadorClassificacao();
    
    foreach($listaGrupos as $gr){
        $salvaGrupos->setNovoGrupo($gr);
        $gerenciaJogosGrupos->setGrupo($gr);
        $gerenciaJogosGrupos->geraPrimeiraRodada();
        $gerenciaJogosGrupos->geraSegundaRodada();
        $gerenciaJogosGrupos->geraTerceiraRodada();
        $r1 = $gerenciaJogosGrupos->getPrimeiraRodada();
        $r2 = $gerenciaJogosGrupos->getSegundaRodada();
        $r3 = $gerenciaJogosGrupos->getTerceiraRodada();
        $gerador->armazenaRodadas($r1, $r2, $r3, $gerenciaJogosGrupos->getGrupo());
        $classificacao->inicializaClassificacao($gr);
    }
    require_once("../Construcao/gerenciadores/GeradorJogosMataMata.php");
    require_once("../BancoDeDados/JogoMataMataDao.php");
    $inicializaMataMata = new GeradorJogosMataMata();
    $inicializaMataMata->inicializaMataMata($campeonato->getIdCampeonato(), $listaGrupos);
    echo 'Jogos gerados com sucesso';
    /*$salvaGrupos = new GrupoDao();
    $salvaGrupos->setNovoGrupo($grupo1);
    $salvaGrupos->setNovoGrupo($grupo2);
    $salvaGrupos->setNovoGrupo($grupo3);
    $salvaGrupos->setNovoGrupo($grupo4);*/

    /**gerando jogos**/

    /*$jogo1Grupo1 = new JogoGrupo();
    $jogo1Grupo1->setTime1($grupo1->getTime1());
    $jogo1Grupo1->setTime2($grupo1->getTime2());

    $gerenciaJogo = new GerenciaJogosGrupos();
    /************gerando os jobos de cada grupo*************/
    /**grupo 1**/
    /*$gerenciaJogo->setGrupo($grupo1);
    $gerenciaJogo->geraPrimeiraRodada();
    $gerenciaJogo->geraSegundaRodada();
    $gerenciaJogo->geraTerceiraRodada();/
    
    $primeira = $gerenciaJogo->getPrimeiraRodada();
    $jogo = new JogoGrupo($gerenciaJogo->getGrupo());


    
    //jogo 1 da primeira rodada
    $jogo->setTime1($primeira->offSetGet("jogo1Time1"));
    $jogo->setTime2($primeira->offSetGet("jogo1Time2"));
    $jogoBanco->setNovoJogoGrupo($jogo);
    */

?>
