<?php
    require_once("BancoDeDados/GrupoDao.php");
    require_once("BancoDeDados/JogoGrupoDao.php");
    require_once("Construcao/gerenciadores/GeradorJogosGrupo.php");
    require_once("BancoDeDados/CampeonatoDao.php");
    $camp = $_GET['campeonato'];
    $campeonato = new CampeonatoDao();
    $status = $campeonato->isFinalizado($camp);    

    $grupos = new GrupoDao();
    $arrayGrupos = $grupos->getGruposCampeonato($camp);

    $jogosTabela = new GeradorJogosGrupo();
    $matrizJogos = new ArrayObject();


    foreach($arrayGrupos as $grupo){
        $_SESSION['grupo'.$grupo['id']] = 0;
        $matrizJogos->append($jogosTabela->getJogos($grupo['id']));
    }
    $tables = "";
    foreach($matrizJogos as $jogos){
        $tables .= "<table class='tabelaClassificacao' border='1' cellpadding='2' cellspacing='2'>";
        $tables .="
            <thead>
                <tr>
                    <th colspan='5'>Grupo ".$jogos[0]['grupo']."</th>
                </tr>
            </thead>
            <tbody>
        ";
        foreach($jogos as $jogo){
            if($jogo['golTime1'] != '' && $jogo['golTime2'] != ''){
                $_SESSION['grupo'.$jogo['idGrupo']] += 1;
            }
            $tables .= "
                <tr>
                    <td style='text-align: right'>"
                        .utf8_encode($jogo['t1']).
                    "&nbsp;<img src='$jogo[escudoT1]'/>&nbsp;</td>
                    <td class='placar golTime1' status='$status' alt='$jogo[idJogo]|$jogo[idGrupo]|$jogo[idT1]|$jogo[idT2]'>$jogo[golTime1]</td>
                    <td>x</td>
                    <td class='placar golTime2' alt='$jogo[idJogo]|$jogo[idGrupo]|$jogo[idT1]|$jogo[idT2]'>$jogo[golTime2]</td>
                    <td style='text-align: left'>&nbsp;<img src='$jogo[escudoT2]'/>&nbsp;".utf8_encode($jogo['t2'])."</td>
                </tr>
            ";
        }
        $tables .= "</tbody></table>";
    }
    echo $tables;
    //print_r($_SESSION);
?>
