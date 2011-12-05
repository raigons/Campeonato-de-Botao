<?php
    require_once("../BancoDeDados/Conexao.php");
    require_once("../BancoDeDados/JogoMataMataDao.php");
    require_once("../Construcao/gerenciadores/GerenciaJogosMataMata.php");
    require_once("../Construcao/Jogo.php");
    require_once("../Construcao/JogoMataMata.php");
    require_once("../Construcao/Time.php");
    require_once("../Construcao/gerenciadores/GerenciadoresMataMata/GerenciadorQuartasDeFinal.php");
    require_once("../Construcao/gerenciadores/GerenciadoresMataMata/GerenciadorSemiFinal.php");
    require_once("../Construcao/gerenciadores/GerenciadoresMataMata/GerenciadorFinal.php");
    require_once("../BancoDeDados/CampeonatoDao.php");
    $campeonato = new CampeonatoDao();
    $status = $campeonato->isFinalizado($_POST['campeonato']);
    $gJMM = new GerenciaJogosMataMata();
?>
<script language="javascript" type="text/javascript">
    $("#conteudoFinais table.tabelaclassificacao tbody td.golTime1").livequery('click', function(){
        if($(this).attr("status") != 1){
            if(verificaVazio($(this).attr('alt').split("|")))
                fazEditavelMataMata($(this));
            $(this).unbind('click');
            $(this).next().next().unbind('click');
            $(this).focus().select();
        }
    });
    $("#finalizaCampeonato").bind('click', function(){
        $.post('processamentoFormularios/finalizaCampeonato.php', {
            'campeonato' : $(this).attr('alt')
        }, function(data){
            alert(data.message);
            $("#conteudoFinais").load("geradores/paginaMataMata.php", {
                "campeonato" : data.campeonato
            });
        }, 'json');
    });
    atualizaFinais();    
    function verificaVazio(array){
        for(var i = 0; i < array.length;i++){
            if(array[i] == ''){
                return false;
            }            
        }
        return true;
    }
</script>
<table id="quartas" class="tabelaClassificacao" border="1" cellpadding="2" cellspacing="2">
    <thead>
        <tr>
            <th colspan="6">Quartas-de-Final</th>
        </tr>
    </thead>
    <tbody>
        <?
            $p = 25;
            $jogos = $gJMM->getConfrontosMataMata($_POST['campeonato'], 1);
            $jogo = $jogos[0];
            $time = $jogos[1];
            $quartas = new GerenciadorQuartasDeFinal();
            $quartas->geraConfrontos($time, $jogo);
            
            $gJMM->geraTabelaJogos($quartas, sizeof($time), $p, 1, $_POST['campeonato'], $status);
           ?>
    </tbody>
</table>
<table id="semi" class="tabelaClassificacao" border="1" cellpadding="2" cellspacing="2">
    <thead>
        <tr>
            <th colspan="6">Semi-Final</th>
        </tr>
    </thead>
    <tbody>
        <?
            $jogos = $gJMM->getConfrontosMataMata($_POST['campeonato'], 2);
            $jogo = $jogos[0];
            $time = $jogos[1];

            $semi = new GerenciadorSemiFinal();
            $semi->geraConfrontos($time, $jogo);
            $gJMM->geraTabelaJogos($semi, sizeof($time), $p, 2, $_POST['campeonato'], $status);
        ?>
    </tbody>
</table>

<table id="final" class="tabelaClassificacao" border="1" cellpadding="2" cellspacing="2">
    <thead>
        <tr>
            <th colspan="6">FINAL</th>
        </tr>
    </thead>
    <tbody>
        <?
            $jogos = $gJMM->getConfrontosMataMata($_POST['campeonato'], 3);
            $jogo = $jogos[0];
            $time = $jogos[1];
            $final = new GerenciadorFinal();
            $final->geraConfronto($time, $jogo);
            $gJMM->geraTabelaJogos($final, sizeof($time), $p, 3, $_POST['campeonato'], $status);
        ?>
    </tbody>
</table>
<?
    if($final->getJogo()->offSetGet('t1') != ''){
        if($final->getJogo()->offSetGet('golT1') > $final->getJogo()->offSetGet('golT2')){
            $escudoCampeao = "<img src=\"".$final->getJogo()->offSetGet('escudoT1')."\"/>";
        }elseif($final->getJogo()->offSetGet('golT2') > $final->getJogo()->offSetGet('golT1')){
            $escudoCampeao = "<img src=\"".$final->getJogo()->offSetGet('escudoT2')."\"/>";
        }else{
            $escudoCampeao = "";
        }
    }else{
        $escudoCampeao = "";
    }
?>
<h2>Campeão: <? echo $escudoCampeao;?> </h2>
<?
    if($escudoCampeao != "" && !$status){
        echo "<button id='finalizaCampeonato' alt='".$_POST['campeonato']."'>Encerrar campeonato</button>";
    }
?>

