<div id="cabecalhoAbas">
    <div id="listaMenu">
        <ul>
            <li id="classificacao" class="selecionada" campeonato="<?echo $_GET['campeonato'];?>">Classificacao</li>
            <li id="tabela"> Tabela</li>
            <li id="finais" campeonato="<?echo $_GET['campeonato'];?>"> 2ª Fase</li>
        </ul>
    </div>
</div>
<div id="conteudoCampeonato">
    <div id="conteudoClassificacao" class="conteudos">
        <?
            include "geraClassificacao.php";
        ?>                
    </div>
    <div id="conteudoTabela" class="conteudos">
        <?
            include "geraTabela.php";
        ?>
    </div>
    <div id="conteudoFinais" class="conteudos">
        <?
           // include "paginaMataMata.php";
        ?>
    </div>
</div>