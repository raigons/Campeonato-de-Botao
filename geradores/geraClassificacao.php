<?php
if(strpos($_SERVER['HTTP_REFERER'], 'verCampeonato?campeonato') === false){
    require_once("BancoDeDados/GrupoDao.php");
    require_once("BancoDeDados/ClassificacaoDao.php");
    require_once("Construcao/gerenciadores/GerenciadorClassificacao.php");
    require_once("BancoDeDados/JogoGrupoDao.php");
    require_once("Construcao/gerenciadores/GeradorJogosGrupo.php");
}else{
    require_once("../BancoDeDados/GrupoDao.php");
    require_once("../BancoDeDados/ClassificacaoDao.php");
    require_once("../Construcao/gerenciadores/GerenciadorClassificacao.php");
    require_once("../BancoDeDados/JogoGrupoDao.php");
    require_once("../Construcao/gerenciadores/GeradorJogosGrupo.php");
}

$camp = $_REQUEST['campeonato'];
$grupos = new GrupoDao();
$arrayGrupos = $grupos->getGruposCampeonato($camp);

$classificacao = new GerenciadorClassificacao();

$matrizClassificacao = new ArrayObject();
$g = array();
$k = 0;
foreach($arrayGrupos as $grupo) {
    $g[$k++] = $grupo['id'];
    $matrizClassificacao->append($classificacao->getClassificacao($grupo['id']));
}
$tables = "";
$tablesJogos = "";
$k = 0;
foreach($matrizClassificacao as $classGrupo) {
    $tables .= "<div id='cabecaSepara'>
                    <h3>Grupo ".$classGrupo[0]['grupo']."</h3>
                </div>";
    $tables .= "<table class='tabelaClassificacao' border='1' cellpadding='2' cellspacing='2'>";
    $tables .="
            <thead>
                <tr>
                    <th id='coluna1'>Time</th><th>P</th><th>V</th><th>E</th><th>D</th><th>GP</th><th>GC</th><th>S</th>
                </tr>
            </thead>
            <tbody>";       
    foreach($classGrupo as $grupo) {
        $tables .= "
                <tr>
                    <td class='primeira'><img src='".$grupo['escudo']."' alt='$grupo[nome]'/>
            ".utf8_encode($grupo['nome'])."
                    </td>
                    <td>$grupo[pontos]</td>
                    <td>$grupo[vitoria]</td>
                    <td>$grupo[empate]</td>
                    <td>$grupo[derrota]</td>
                    <td>$grupo[gp]</td>
                    <td>$grupo[gc]</td>
                    <td>$grupo[saldo]</td>
                </tr>";
    }
    $tables .= "</tbody></table>";
    $tables .= geraTabelaJogos($camp, $g[$k++]);
}
echo $tables;
?>

<?
function geraTabelaJogos($camp, $grupo) {

    $jogosTabela = new GeradorJogosGrupo();
    $matrizJogos = new ArrayObject();

    $matrizJogos->append($jogosTabela->getJogos($grupo));
    $tab = "";
    foreach($matrizJogos as $jogos) {
        $tab .= "<table class='tabelaClassificacao' border='1' cellpadding='2' cellspacing='2'>";
        $tab .="
            <thead>
                <tr>
                    <!--<th colspan='5'>Grupo ".$jogos[0]['grupo']."</th>-->
                    <th colspan='5'>Jogos</th>
                </tr>
            </thead>
            <tbody>
        ";
        foreach($jogos as $jogo) {
            $tab .= "
                <tr>
                    <td style='text-align: right'>"
                .utf8_encode($jogo['t1']).
                "&nbsp;<img src='$jogo[escudoT1]'/>&nbsp;</td>
                    <td class='placar'>$jogo[golTime1]</td>
                    <td>x</td>
                    <td class='placar'>$jogo[golTime2]</td>
                    <td style='text-align: left'>&nbsp;<img src='$jogo[escudoT2]'/>&nbsp;".utf8_encode($jogo['t2'])."</td>
                </tr>
            ";
        }
        $tab .= "</tbody></table>";
    }
    return $tab;
}

?>