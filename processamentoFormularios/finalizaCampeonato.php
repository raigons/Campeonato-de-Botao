<?php
    require_once("../BancoDeDados/CampeonatoDao.php");

    $camp = new CampeonatoDao();
    if($camp->finalizaCampeonato($_POST['campeonato']) > 0){
        echo "{'message' : 'Campeonato finalizado!', 'campeonato': '".$_POST['campeonato']."'}";
    }
?>
