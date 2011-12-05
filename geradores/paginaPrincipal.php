<?
    require_once("BancoDeDados/CampeonatoDao.php");
    require_once("Construcao/gerenciadores/GerenciaCampeonatos.php");
?>

<h2>Campeonatos Finalizados</h2>
<ul class="listaCampeonatos">
    <li></li>
    <? echo GerenciaCampeonatos::getCampeonatosFinalizados();?>
</ul>
<h2>Campeonatos em Andamento</h2>
    <ul class="listaCampeonatos">
        <li></li>
        <?
            echo GerenciaCampeonatos::getCampeonatosAndamento();
        ?>
    </ul>